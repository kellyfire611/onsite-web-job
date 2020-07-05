<?php
require_once __DIR__ . '/../../../bootstrap.php';
require_once __DIR__ . '/../../../utils/regex.php';

$template = 'backend/auth/nguoi-dung/them.html.twig';
$el       = 'form-create';
$regex    = [
  'username'    => [
    'pattern' => Regex::$PATTERN['username'],
    'min'     => 5,
    'max'     => 191,
  ],
  'last_name'   => [
    'pattern' => Regex::$PATTERN['vietnamese_name'],
    'min'     => 1,
    'max'     => 255,
  ],
  'first_name'  => [
    'pattern' => Regex::$PATTERN['vietnamese_name'],
    'min'     => 1,
    'max'     => 255,
  ],
  'email'       => [
    'pattern' => Regex::$PATTERN['email'],
    'min'     => 12,
    'max'     => 191,
  ],
  'job_title'   => [
    'pattern' => Regex::$PATTERN['any'],
    'min'     => 0,
    'max'     => 255,
  ],
  'department'  => [
    'pattern' => Regex::$PATTERN['any'],
    'min'     => 0,
    'max'     => 255,
  ],
  'phone'       => [
    'pattern' => Regex::$PATTERN['phone'],
    'min'     => 10,
    'max'     => 25,
  ],
  'address1'    => [
    'pattern' => Regex::$PATTERN['any'],
    'min'     => 0,
    'max'     => 500,
  ],
  'address2'    => [
    'pattern' => Regex::$PATTERN['any'],
    'min'     => 0,
    'max'     => 500,
  ],
  'city'        => [
    'pattern' => Regex::$PATTERN['vietnamese_name'],
    'min'     => 0,
    'max'     => 255,
  ],
  'state'       => [
    'pattern' => Regex::$PATTERN['vietnamese_name'],
    'min'     => 0,
    'max'     => 255,
  ],
  'postal_code' => [
    'pattern' => Regex::$PATTERN['number_pos'],
    'min'     => 0,
    'max'     => 15,
  ],
  'country'     => [
    'pattern' => Regex::$PATTERN['vietnamese_name'],
    'min'     => 0,
    'max'     => 255,
  ],
];

if (isset($_POST['submit'])) {
  if (Regex::test('username', 5, 191, $_POST['username']) && Regex::test('email', 12, 191, $_POST['email'])) {
    require_once __DIR__ . '/../../../dbconnect.php';

    // Check exist username
    try {
      $statement = $conn->prepare(<<<query
        select id
        from acl_users
        where username = ?
      query);

      $statement->bind_param('s', $_POST['username']);
      $statement->execute();
      if ($statement->get_result()->num_rows) {
        $conn->close();
        die($twig->render($template, [
          'el'   => $el,
          'data' => json_encode([
            'regex'    => $regex,
            'form'     => $_POST,
            'response' => [
              'title'   => 'Tạo mới không thành công',
              'variant' => 'danger',
              'content' => 'Tài khoản này đã tồn tại',
            ],
          ]),
        ]));
      }
    } catch (mysqli_sql_exception $exception) {
      $conn->close();
      die('Xin lỗi, không thể truy vấn cơ sở dữ liệu.');
    }

    // Check exist email
    try {
      $statement = $conn->prepare(<<<query
        select id
        from acl_users
        where email = ?
      query);

      $statement->bind_param('s', $_POST['email']);
      $statement->execute();
      if ($statement->get_result()->num_rows) {
        $conn->close();
        die($twig->render($template, [
          'el'   => $el,
          'data' => json_encode([
            'regex'    => $regex,
            'form'     => $_POST,
            'response' => [
              'title'   => 'Tạo mới không thành công',
              'variant' => 'danger',
              'content' => 'Email này đã được sử dụng',
            ],
          ]),
        ]));
      }
    } catch (mysqli_sql_exception $exception) {
      $conn->close();
      die('Xin lỗi, không thể truy vấn cơ sở dữ liệu.');
    }

    // Upload avatar
    $isUploaded = false;
    if ($_FILES['avatar']['error'] == UPLOAD_ERR_NO_FILE) {
      $avatar = '/assets/shared/img/no-avatar.png';
    } elseif ($_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
      if (getimagesize($_FILES["avatar"]["tmp_name"])) {
        $temp       = explode(".", $_FILES['avatar']["name"]);
        $avatar     = '/assets/uploads/users/avatars/' . $_POST['username'] . '.' . end($temp);
        $isUploaded = move_uploaded_file($_FILES['avatar']["tmp_name"], __DIR__ . "/../../..$avatar");
        if (!$isUploaded) {
          $conn->close();
          die($twig->render($template, [
            'el'   => $el,
            'data' => json_encode([
              'regex'    => $regex,
              'form'     => $_POST,
              'response' => [
                'title'   => 'Tạo mới không thành công',
                'variant' => 'danger',
                'content' => 'Đã có lỗi xảy ra trong quá trình tải lên ảnh đại diện',
              ],
            ]),
          ]));
        }
      } else {
        $conn->close();
        die($twig->render($template, [
          'el'   => $el,
          'data' => json_encode([
            'regex'    => $regex,
            'form'     => $_POST,
            'response' => [
              'title'   => 'Tạo mới không thành công',
              'variant' => 'danger',
              'content' => 'Ảnh đại diện không hợp lệ',
            ],
          ]),
        ]));
      }
    } else {
      $conn->close();
      die($twig->render($template, [
        'el'   => $el,
        'data' => json_encode([
          'regex'    => $regex,
          'form'     => $_POST,
          'response' => [
            'title'   => 'Tạo mới không thành công',
            'variant' => 'danger',
            'content' => 'Không thể tải lên ảnh đại diện',
          ],
        ]),
      ]));
    }

    // Insert user
    if (
      Regex::test('vietnamese_name', 1, 255, $_POST['last_name']) &&
      Regex::test('vietnamese_name', 1, 255, $_POST['first_name']) &&
      (strlen($_POST['job_title']) == 0 || Regex::test('any', 0, 255, $_POST['job_title'])) &&
      (strlen($_POST['department']) == 0 || Regex::test('any', 0, 255, $_POST['department'])) &&
      (strlen($_POST['phone']) == 0 || Regex::test('phone', 10, 25, $_POST['phone'])) &&
      (strlen($_POST['address1']) == 0 || Regex::test('any', 0, 500, $_POST['address1'])) &&
      (strlen($_POST['address2']) == 0 || Regex::test('any', 0, 500, $_POST['address2'])) &&
      (strlen($_POST['city']) == 0 || Regex::test('vietnamese_name', 0, 255, $_POST['city'])) &&
      (strlen($_POST['state']) == 0 || Regex::test('vietnamese_name', 0, 255, $_POST['state'])) &&
      (strlen($_POST['postal_code']) == 0 || Regex::test('number_pos', 0, 15, $_POST['postal_code'])) &&
      (strlen($_POST['country']) == 0 || Regex::test('vietnamese_name', 5, 255, $_POST['country']))
    ) {
      try {
        $password  = password_hash('user@123', PASSWORD_DEFAULT);
        $statement = $conn->prepare(<<<query
          insert into acl_users values (
            null, -- id
            ?, -- username
            ?, -- password
            ?, -- last_name
            ?, -- first_name
            ?, -- email
            ?, -- avatar
            ?, -- job_title
            ?, -- department
            null, -- manager_id
            ?, -- phone
            ?, -- address1
            ?, -- address2
            ?, -- city
            ?, -- state
            ?, -- postal_code
            ?, -- country
            null, -- remember_token
            null, -- active_code
            0, -- status
            current_timestamp(), -- created_at
            null -- updated_at
          )
        query);

        $statement->bind_param('sssssssssssssss',
          $_POST['username'],
          $password,
          $_POST['last_name'],
          $_POST['first_name'],
          $_POST['email'],
          $avatar,
          $_POST['job_title'],
          $_POST['department'],
          $_POST['phone'],
          $_POST['address1'],
          $_POST['address2'],
          $_POST['city'],
          $_POST['state'],
          $_POST['postal_code'],
          $_POST['country'],
        );
        $statement->execute();
        $conn->close();
        header('location: ./');
      } catch (mysqli_sql_exception $exception) {
        $conn->close();
        if ($isUploaded) {
          unlink(__DIR__ . "/../../..$avatar");
        }
        echo 'Xin lỗi, không thể truy vấn cơ sở dữ liệu.';
      }
    } else {
      $conn->close();
      echo $twig->render($template, [
        'el'   => $el,
        'data' => json_encode([
          'regex'    => $regex,
          'form'     => $_POST,
          'response' => [
            'title'   => 'Tạo mới không thành công',
            'variant' => 'danger',
            'content' => 'Dữ liệu không hợp lệ',
          ],
        ]),
      ]);
    }
  } else {
    echo $twig->render($template, [
      'el'   => $el,
      'data' => json_encode([
        'regex'    => $regex,
        'form'     => $_POST,
        'response' => [
          'title'   => 'Tạo mới không thành công',
          'variant' => 'danger',
          'content' => 'Dữ liệu không hợp lệ',
        ],
      ]),
    ]);
  }
} else {
  echo $twig->render($template, [
    'el'   => $el,
    'data' => json_encode(['regex' => $regex]),
  ]);
}
