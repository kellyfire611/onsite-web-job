<?php
require_once __DIR__ . '/../../../bootstrap.php';
require_once __DIR__ . '/../../../utils/regex.php';
require_once __DIR__ . '/../../../utils/array.php';
require_once __DIR__ . '/../../../dbconnect.php';

$shop_categories = [];
$shop_suppliers  = [];

try {
  // Get categories
  $result = $conn->query(<<<query
      select
        id as value,
        concat(category_code, ' - ', category_name) as text
      from shop_categories
    query);
  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $shop_categories[] = $row;
  }

  // Get suppliers
  $result = $conn->query(<<<query
      select
        id as value,
        concat(supplier_code, ' - ', supplier_name) as text
      from shop_suppliers
    query);
  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $shop_suppliers[] = $row;
  }
} catch (mysqli_sql_exception $exception) {
  $conn->close();
  echo 'Xin lỗi, không thể truy vấn cơ sở dữ liệu.';
}

$template = 'backend/pages/san-pham/them.html.twig';
$el       = 'form-create';
$regex    = [
  'product_code'      => [
    'pattern' => Regex::$PATTERN['code'],
    'min'     => 1,
    'max'     => 25,
  ],
  'product_name'      => [
    'pattern' => Regex::$PATTERN['vietnamese_name'],
    'min'     => 1,
    'max'     => 50,
  ],
  'short_description' => [
    'pattern' => Regex::$PATTERN['any'],
    'min'     => 0,
    'max'     => 250,
  ],
  'quantity_per_unit' => [
    'pattern' => Regex::$PATTERN['number_pos'],
    'min'     => 1,
    'max'     => 50,
  ],
  'discontinued'      => [
    'pattern' => Regex::$PATTERN['number_pos'],
    'min'     => 1,
    'max'     => 4,
  ],
  'is_featured'       => [
    'pattern' => Regex::$PATTERN['number_pos'],
    'min'     => 1,
    'max'     => 1,
  ],
  'is_new'            => [
    'pattern' => Regex::$PATTERN['number_pos'],
    'min'     => 1,
    'max'     => 1,
  ],
  'category_id'       => [
    'pattern' => Regex::$PATTERN['number_pos'],
    'min'     => 1,
    'max'     => 20,
  ],
  'supplier_id'       => [
    'pattern' => Regex::$PATTERN['number_pos'],
    'min'     => 1,
    'max'     => 20,
  ],
];

if (isset($_POST['submit'])) {
  if (Regex::test('code', 1, 25, $_POST['product_code'])) {
    // Check exist code
    try {
      $statement = $conn->prepare(<<<query
        select id
        from shop_products
        where product_code = ?
      query);

      $statement->bind_param('s', $_POST['product_code']);
      $statement->execute();
      if ($statement->get_result()->num_rows) {
        $conn->close();
        die($twig->render($template, [
          'el'   => $el,
          'data' => json_encode([
            'regex'           => $regex,
            'form'            => $_POST,
            'response'        => [
              'title'   => 'Tạo mới không thành công',
              'variant' => 'danger',
              'content' => 'Mã sản phẩm này đã tồn tại',
            ],
            'shop_categories' => $shop_categories,
            'shop_suppliers'  => $shop_suppliers,
          ]),
        ]));
      }
    } catch (mysqli_sql_exception $exception) {
      $conn->close();
      die('Xin lỗi, không thể truy vấn cơ sở dữ liệu.');
    }

    // Check category_id
    if ($_POST['category_id'] != '') {
      if (Regex::test('number_pos', 1, 20, $_POST['category_id']) && !ArrayUtil::deepInArray($_POST['category_id'], $shop_categories)) {
        $conn->close();
        die($twig->render($template, [
          'el'   => $el,
          'data' => json_encode([
            'regex'           => $regex,
            'form'            => $_POST,
            'response'        => [
              'title'   => 'Tạo mới không thành công',
              'variant' => 'danger',
              'content' => 'Loại sản phẩm không hợp lệ',
            ],
            'shop_categories' => $shop_categories,
            'shop_suppliers'  => $shop_suppliers,
          ]),
        ]));
      }
      $category_id = $_POST['category_id'];
    } else {
      $category_id = null;
    }

    // Check supplier_id
    if ($_POST['supplier_id'] != '') {
      if (Regex::test('number_pos', 1, 20, $_POST['supplier_id']) && !ArrayUtil::deepInArray($_POST['supplier_id'], $shop_suppliers)) {
        $conn->close();
        die($twig->render($template, [
          'el'   => $el,
          'data' => json_encode([
            'regex'           => $regex,
            'form'            => $_POST,
            'response'        => [
              'title'   => 'Tạo mới không thành công',
              'variant' => 'danger',
              'content' => 'Nhà cung cấp sản phẩm không hợp lệ',
            ],
            'shop_categories' => $shop_categories,
            'shop_suppliers'  => $shop_suppliers,
          ]),
        ]));
      }
      $supplier_id = $_POST['supplier_id'];
    } else {
      $supplier_id = null;
    }

    // Upload image
    $isUploaded = false;
    if ($_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {
      $image = '/assets/shared/img/no-image.png';
    } elseif ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
      if (getimagesize($_FILES["image"]["tmp_name"])) {
        $temp       = explode(".", $_FILES['image']["name"]);
        $image      = '/assets/uploads/products/images/' . $_POST['product_code'] . '.' . end($temp);
        $isUploaded = move_uploaded_file($_FILES['image']["tmp_name"], __DIR__ . "/../../..$image");
        if (!$isUploaded) {
          $conn->close();
          die($twig->render($template, [
            'el'   => $el,
            'data' => json_encode([
              'regex'           => $regex,
              'form'            => $_POST,
              'response'        => [
                'title'   => 'Tạo mới không thành công',
                'variant' => 'danger',
                'content' => 'Đã có lỗi xảy ra trong quá trình tải lên ảnh sản phẩm',
              ],
              'shop_categories' => $shop_categories,
              'shop_suppliers'  => $shop_suppliers,
            ]),
          ]));
        }
      } else {
        $conn->close();
        die($twig->render($template, [
          'el'   => $el,
          'data' => json_encode([
            'regex'           => $regex,
            'form'            => $_POST,
            'response'        => [
              'title'   => 'Tạo mới không thành công',
              'variant' => 'danger',
              'content' => 'Ảnh sản phẩm không hợp lệ',
            ],
            'shop_categories' => $shop_categories,
            'shop_suppliers'  => $shop_suppliers,
          ]),
        ]));
      }
    } else {
      $conn->close();
      die($twig->render($template, [
        'el'   => $el,
        'data' => json_encode([
          'regex'           => $regex,
          'form'            => $_POST,
          'response'        => [
            'title'   => 'Tạo mới không thành công',
            'variant' => 'danger',
            'content' => 'Không thể tải lên ảnh sản phẩm',
          ],
          'shop_categories' => $shop_categories,
          'shop_suppliers'  => $shop_suppliers,
        ]),
      ]));
    }

    if (
      Regex::test('vietnamese_name', 1, 50, $_POST['product_name']) &&
      (strlen($_POST['short_description']) == 0 || Regex::test('any', 0, 250, $_POST['short_description'])) &&
      (is_numeric($_POST['standard_cost']) && $_POST['standard_cost'] >= 0) &&
      (is_numeric($_POST['list_price']) && $_POST['list_price'] >= 0) &&
      Regex::test('number_pos', 1, 50, $_POST['quantity_per_unit']) &&
      Regex::test('number_pos', 1, 4, $_POST['discontinued']) &&
      Regex::test('number_pos', 1, 1, $_POST['is_featured']) &&
      Regex::test('number_pos', 1, 1, $_POST['is_new']) &&
      strlen($_POST['description']) <= 5000
    ) {
      try {
        $password  = password_hash('user@123', PASSWORD_DEFAULT);
        $statement = $conn->prepare(<<<query
          insert into shop_products values (
            null, -- id
            ?, -- product_code
            ?, -- product_name
            ?, -- image
            ?, -- short_description
            ?, -- description
            ?, -- standard_cost
            ?, -- list_price
            ?, -- quantity_per_unit
            ?, -- discontinued
            ?, -- is_featured
            ?, -- is_new
            ?, -- category_id
            ?, -- supplier_id
            current_timestamp(), -- created_at
            null -- updated_at
          )
        query);

        $statement->bind_param('sssssddiiiiii',
          $_POST['product_code'],
          $_POST['product_name'],
          $image,
          $_POST['short_description'],
          $_POST['description'],
          $_POST['standard_cost'],
          $_POST['list_price'],
          $_POST['quantity_per_unit'],
          $_POST['discontinued'],
          $_POST['is_featured'],
          $_POST['is_new'],
          $category_id,
          $supplier_id,
        );
        $statement->execute();
        $conn->close();
        header('location: ./');
      } catch (mysqli_sql_exception $exception) {
        $conn->close();
        if ($isUploaded) {
          unlink(__DIR__ . "/../../..$image");
        }
        echo 'Xin lỗi, không thể truy vấn cơ sở dữ liệu.';
      }
    } else {
      $conn->close();
      die($twig->render($template, [
        'el'   => $el,
        'data' => json_encode([
          'regex'           => $regex,
          'form'            => $_POST,
          'response'        => [
            'title'   => 'Tạo mới không thành công',
            'variant' => 'danger',
            'content' => 'Dữ liệu không hợp lệ',
          ],
          'shop_categories' => $shop_categories,
          'shop_suppliers'  => $shop_suppliers,
        ]),
      ]));
    }
  } else {
    $conn->close();
    die($twig->render($template, [
      'el'   => $el,
      'data' => json_encode([
        'regex'           => $regex,
        'form'            => $_POST,
        'response'        => [
          'title'   => 'Tạo mới không thành công',
          'variant' => 'danger',
          'content' => 'Dữ liệu không hợp lệ',
        ],
        'shop_categories' => $shop_categories,
        'shop_suppliers'  => $shop_suppliers,
      ]),
    ]));
  }
} else {
  $conn->close();
  echo $twig->render($template, [
    'el'   => $el,
    'data' => json_encode([
      'regex'           => $regex,
      'shop_categories' => $shop_categories,
      'shop_suppliers'  => $shop_suppliers,
    ]),
  ]);
}
