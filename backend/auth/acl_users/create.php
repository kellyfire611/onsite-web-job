<?php
require_once __DIR__ . '/../../../bootstrap.php';

if (isset($_POST['submit'])) {
  include_once __DIR__ . '/../../../dbconnect.php';

  // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
  $tenLoai = $_POST['lsp_ten'];
  $mota    = $_POST['lsp_mota'];

  // Câu lệnh INSERT
  $sql = "INSERT INTO `loaisanpham` (lsp_ten, lsp_mota) VALUES ('" . $tenLoai . "', '" . $mota . "');";

  // Thực thi INSERT
  mysqli_query($conn, $sql);

  // Đóng kết nối
  mysqli_close($conn);

  header('location:./');
} else {
  $fields = [
    0  => [
      'key'      => 'username',
      'label'    => 'Tài khoản',
      'sortable' => true,
      'class'    => 'align-middle',
    ],
    1 => [
      'key'      => 'last_name',
      'label'    => 'Họ',
      'sortable' => true,
      'class'    => 'd-none',
    ],
    2  => [
      'key'      => 'first_name',
      'label'    => 'Tên',
      'sortable' => true,
      'class'    => 'd-none',
    ],
    3  => [
      'key'      => 'email',
      'label'    => 'Email',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none d-xl-table-cell',
    ],
    4  => [
      'key'   => 'avatar',
      'label' => 'Ảnh đại diện',
      'class' => 'd-none',
    ],
    5  => [
      'key'      => 'job_title',
      'label'    => 'Công việc',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    6  => [
      'key'      => 'department',
      'label'    => 'Bộ phận',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none d-xl-table-cell',
    ],
    7 => [
      'key'      => 'phone',
      'label'    => 'Điện thoại',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    8 => [
      'key'      => 'address1',
      'label'    => 'Địa chỉ 1',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    9 => [
      'key'      => 'address2',
      'label'    => 'Địa chỉ 2',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    10 => [
      'key'      => 'city',
      'label'    => 'Thành phố',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    11 => [
      'key'      => 'state',
      'label'    => 'Bang',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    12 => [
      'key'      => 'postal_code',
      'label'    => 'Mã bưu điện',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    17 => [
      'key'      => 'country',
      'label'    => 'Quốc gia',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
  ];

  echo $twig->render('backend/auth/acl_users/create.html.twig', [
    'el'   => 'form-create',
    'data' => json_encode([])
  ]);
}