<?php
require_once __DIR__ . '/../../bootstrap.php';
include_once __DIR__ . '/../../dbconnect.php';

$query = <<<query
select
  id,
  username,
  last_name,
  first_name,
  email,
  avatar,
  job_title,
  department,
  manager_id,
  phone,
  address1,
  address2,
  city,
  state,
  postal_code,
  country,
  remember_token,
  active_code,
  status,
  created_at,
  updated_at
from acl_users
query;

$result = mysqli_query($conn, $query);

$items = [];
$index = 0;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  $items[] = [
    'no'             => ++$index,
    'id'             => $row['id'],
    'username'       => $row['username'],
    'first_name'     => $row['first_name'],
    'last_name'      => $row['last_name'],
    'email'          => $row['email'],
    'avatar'         => $row['avatar'],
    'job_title'      => $row['job_title'],
    'department'     => $row['department'],
    'manager_id'     => $row['manager_id'],
    'phone'          => $row['phone'],
    'address1'       => $row['address1'],
    'address2'       => $row['address2'],
    'city'           => $row['city'],
    'state'          => $row['state'],
    'postal_code'    => $row['postal_code'],
    'country'        => $row['country'],
    'remember_token' => $row['remember_token'],
    'active_code'    => $row['active_code'],
    'status'         => $row['status'],
    'created_at'     => $row['created_at'],
    'updated_at'     => $row['updated_at'],
  ];
}

$fields = [
  0  => [
    'key'      => 'no',
    'label'    => 'Stt',
    'sortable' => true,
    'class'    => 'align-middle text-md-right',
  ],
  1  => [
    'key'      => 'id',
    'label'    => 'ID',
    'sortable' => true,
    'class'    => 'align-middle',
  ],
  2  => [
    'key'      => 'username',
    'label'    => 'Tài khoản',
    'sortable' => true,
    'class'    => 'align-middle',
  ],
  3  => [
    'key'      => 'name',
    'label'    => 'Họ và tên',
    'sortable' => true,
    'class'    => 'align-middle',
  ],
  4  => [
    'key'      => 'last_name',
    'label'    => 'Họ',
    'sortable' => true,
    'class'    => 'd-none',
  ],
  5  => [
    'key'      => 'first_name',
    'label'    => 'Tên',
    'sortable' => true,
    'class'    => 'd-none',
  ],
  6  => [
    'key'      => 'email',
    'label'    => 'Email',
    'sortable' => true,
    'class'    => 'align-middle d-block d-md-none d-xl-table-cell',
  ],
  7  => [
    'key'   => 'avatar',
    'label' => 'Ảnh đại diện',
    'class' => 'd-none',
  ],
  8  => [
    'key'      => 'job_title',
    'label'    => 'Công việc',
    'sortable' => true,
    'class'    => 'align-middle d-block d-md-none',
  ],
  9  => [
    'key'      => 'department',
    'label'    => 'Bộ phận',
    'sortable' => true,
    'class'    => 'align-middle d-block d-md-none d-xl-table-cell',
  ],
  10 => [
    'key'      => 'manager_id',
    'label'    => 'Mã quản lý',
    'sortable' => true,
    'class'    => 'align-middle d-block d-md-none',
  ],
  11 => [
    'key'      => 'phone',
    'label'    => 'Điện thoại',
    'sortable' => true,
    'class'    => 'align-middle d-block d-md-none',
  ],
  12 => [
    'key'      => 'address1',
    'label'    => 'Địa chỉ 1',
    'sortable' => true,
    'class'    => 'align-middle d-block d-md-none',
  ],
  13 => [
    'key'      => 'address2',
    'label'    => 'Địa chỉ 2',
    'sortable' => true,
    'class'    => 'align-middle d-block d-md-none',
  ],
  14 => [
    'key'      => 'city',
    'label'    => 'Thành phố',
    'sortable' => true,
    'class'    => 'align-middle d-block d-md-none',
  ],
  15 => [
    'key'      => 'state',
    'label'    => 'Bang',
    'sortable' => true,
    'class'    => 'align-middle d-block d-md-none',
  ],
  16 => [
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
  18 => [
    'key'      => 'remember_token',
    'label'    => 'Mã ghi nhớ',
    'sortable' => true,
    'class'    => 'align-middle d-block d-md-none',
  ],
  19 => [
    'key'      => 'active_code',
    'label'    => 'Mã kích hoạt',
    'sortable' => true,
    'class'    => 'align-middle d-block d-md-none',
  ],
  20 => [
    'key'      => 'status',
    'label'    => 'Trạng thái',
    'sortable' => true,
    'class'    => 'align-middle d-block d-md-none',
  ],
  21 => [
    'key'      => 'created_at',
    'label'    => 'Ngày tạo',
    'sortable' => true,
    'class'    => 'align-middle d-block d-md-none',
  ],
  22 => [
    'key'      => 'updated_at',
    'label'    => 'Ngày sửa đổi',
    'sortable' => true,
    'class'    => 'align-middle d-block d-md-none',
  ],
  23 => [
    'key'   => 'actions',
    'label' => 'Actions',
    'class' => 'align-middle',
  ],
];

echo $twig->render('backend/acl_users/index.html.twig', [
  'el'   => 'vue-table-users',
  'data' => json_encode([
    'items'  => $items,
    'fields' => $fields,
  ]),
]);
