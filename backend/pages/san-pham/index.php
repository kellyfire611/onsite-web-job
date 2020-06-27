<?php
require_once __DIR__ . '/../../../bootstrap.php';
require_once __DIR__ . '/../../../dbconnect.php';

try {
  $result = $conn->query(<<<query
    select
      shop_products.id,
      shop_products.product_code,
      shop_products.product_name,
      shop_products.image,
      shop_products.standard_cost,
      shop_products.list_price,
      shop_products.quantity_per_unit,
      shop_products.discontinued,
      case when shop_products.discontinued = 1 then 'Đúng' else 'Sai' end as discontinued_name,
      shop_products.is_featured,
      case when shop_products.is_featured = 1 then 'Đúng' else 'Sai' end as is_featured_name,
      shop_products.is_new,
      case when shop_products.is_new = 1 then 'Đúng' else 'Sai' end as is_new_name,
      shop_suppliers.supplier_code,
      shop_suppliers.supplier_name,
      shop_categories.category_code,
      shop_categories.category_name,
      shop_products.created_at,
      shop_products.updated_at
    from shop_products
      left outer join shop_suppliers on shop_products.supplier_id = shop_suppliers.id
      left outer join shop_categories on shop_products.category_id = shop_categories.id
  query);

  $items = [];
  $index = 0;
  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $items[] = [
      'no'                => ++$index,
      'id'                => $row['id'],
      'product_code'      => $row['product_code'],
      'product_name'      => $row['product_name'],
      'image'             => $row['image'],
      'standard_cost'     => $row['standard_cost'],
      'list_price'        => $row['list_price'],
      'quantity_per_unit' => $row['quantity_per_unit'],
      'discontinued'      => $row['discontinued'],
      'discontinued_name' => $row['discontinued_name'],
      'is_featured'       => $row['is_featured'],
      'is_featured_name'  => $row['is_featured_name'],
      'is_new'            => $row['is_new'],
      'is_new_name'       => $row['is_new_name'],
      'supplier_code'     => $row['supplier_code'],
      'supplier_name'     => $row['supplier_name'],
      'category_code'     => $row['category_code'],
      'category_name'     => $row['category_name'],
      'created_at'        => $row['created_at'],
      'updated_at'        => $row['updated_at'],
    ];
  }

  $fields = [
    [
      'key'      => 'no',
      'label'    => 'Stt',
      'sortable' => true,
      'class'    => 'align-middle text-md-right fit',
    ],
    [
      'key'   => 'id',
      'label' => 'ID',
      'class' => 'd-none',
    ],
    [
      'key'      => 'product_code',
      'label'    => 'Mã',
      'sortable' => true,
      'class'    => 'align-middle fit',
    ],
    [
      'key'      => 'product_name',
      'label'    => 'Tên',
      'sortable' => true,
      'class'    => 'align-middle',
    ],
    [
      'key'   => 'image',
      'label' => 'Ảnh',
      'class' => 'd-none',
    ],
    [
      'key'       => 'standard_cost',
      'label'     => 'Giá nhập',
      'sortable'  => true,
      'class'     => 'align-middle text-md-right d-block d-md-none d-lg-table-cell',
      'formatter' => 'return Formatter.Number.separate(value);',
    ],
    [
      'key'       => 'list_price',
      'label'     => 'Giá niêm yết',
      'sortable'  => true,
      'class'     => 'align-middle text-md-right d-block d-md-none d-lg-table-cell',
      'formatter' => 'return Formatter.Number.separate(value);',
    ],
    [
      'key'       => 'quantity_per_unit',
      'label'     => 'Số lượng trên mỗi đơn vị',
      'sortable'  => true,
      'class'     => 'align-middle text-md-right',
      'formatter' => 'return Formatter.Number.separate(value);',
    ],
    [
      'key'      => 'discontinued_name',
      'label'    => 'Là sản phẩm ngừng bán?',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    [
      'key'      => 'is_featured_name',
      'label'    => 'Là sản phẩm nổi bật?',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    [
      'key'      => 'is_new_name',
      'label'    => 'Là sản phẩm mới nhất?',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    [
      'key'   => 'supplier_code',
      'label' => 'Mã nhà cung cấp',
      'class' => 'd-none',
    ],
    [
      'key'      => 'supplier_name',
      'label'    => 'Nhà cung cấp',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none d-xl-table-cell',
    ],
    [
      'key'   => 'category_code',
      'label' => 'Mã loại',
      'class' => 'd-none',
    ],
    [
      'key'      => 'category_name',
      'label'    => 'Loại',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none d-xl-table-cell',
    ],
    [
      'key'      => 'created_at',
      'label'    => 'Ngày tạo',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    [
      'key'      => 'updated_at',
      'label'    => 'Ngày sửa đổi',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    [
      'key'   => 'actions',
      'label' => 'Hành động',
      'class' => 'align-middle fit',
    ],
  ];

  $url      = '/backend/pages/san-pham';
  $rowClass = <<<code
    let className = '';
    if (item.discontinued == 1) {
      className += 'text-secondary bg-light font-weight-light ';
    } else {
      if (item.is_featured == 1) {
        className += 'font-weight-bold ';
      }
      if (item.is_new == 1) {
        className += 'text-primary ';
      }
    }
    return className.slice(0, -1);
  code;
  $notes = [
    [
      'class'   => 'text-secondary bg-light font-weight-light',
      'content' => 'Ngừng bán',
    ],
    [
      'class'   => 'font-weight-bold',
      'content' => 'Nổi bật',
    ],
    [
      'class'   => 'text-primary',
      'content' => 'Mới nhất',
    ],
  ];

  echo $twig->render('backend/pages/san-pham/index.html.twig', [
    'el'   => 'table-users',
    'data' => json_encode([
      'url'      => $url,
      'items'    => $items,
      'fields'   => $fields,
      'rowClass' => $rowClass,
      'notes'    => $notes,
    ]),
  ]);
} catch (mysqli_sql_exception $exception) {
  echo 'Xin lỗi, không thể truy vấn cơ sở dữ liệu.';
} finally {
  $conn->close();
}
