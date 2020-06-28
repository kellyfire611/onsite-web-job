<?php
require_once __DIR__ . '/../../../bootstrap.php';
require_once __DIR__ . '/../../../dbconnect.php';

try {
  $result = $conn->query(<<<query
    select
      id,
      username,
      concat(last_name, ' ', first_name) as full_name,
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
      case when status = 1 then 'Đã kích hoạt' else 'Chưa kích hoạt' end as status_name,
      created_at,
      updated_at
    from acl_users
  query);

  $items = [];
  $index = 0;
  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $items[] = [
      'no'             => ++$index,
      'id'             => $row['id'],
      'username'       => $row['username'],
      'full_name'      => $row['full_name'],
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
      'status_name'    => $row['status_name'],
      'created_at'     => $row['created_at'],
      'updated_at'     => $row['updated_at'],
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
      'key'      => 'username',
      'label'    => 'Tài khoản',
      'sortable' => true,
      'class'    => 'align-middle',
    ],
    [
      'key'      => 'full_name',
      'label'    => 'Họ và tên',
      'sortable' => true,
      'class'    => 'align-middle',
    ],
    [
      'key'      => 'last_name',
      'label'    => 'Họ',
      'sortable' => true,
      'class'    => 'd-none',
    ],
    [
      'key'      => 'first_name',
      'label'    => 'Tên',
      'sortable' => true,
      'class'    => 'd-none',
    ],
    [
      'key'      => 'email',
      'label'    => 'Email',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none d-xl-table-cell',
    ],
    [
      'key'   => 'avatar',
      'label' => 'Ảnh đại diện',
      'class' => 'd-none',
    ],
    [
      'key'      => 'job_title',
      'label'    => 'Công việc',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    [
      'key'      => 'department',
      'label'    => 'Bộ phận',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none d-xl-table-cell',
    ],
    [
      'key'      => 'manager_id',
      'label'    => 'Mã quản lý',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    [
      'key'      => 'phone',
      'label'    => 'Điện thoại',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    [
      'key'      => 'address1',
      'label'    => 'Địa chỉ 1',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    [
      'key'      => 'address2',
      'label'    => 'Địa chỉ 2',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    [
      'key'      => 'city',
      'label'    => 'Thành phố',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    [
      'key'      => 'state',
      'label'    => 'Bang',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    [
      'key'      => 'postal_code',
      'label'    => 'Mã bưu điện',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    [
      'key'      => 'country',
      'label'    => 'Quốc gia',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    [
      'key'      => 'remember_token',
      'label'    => 'Mã ghi nhớ',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    [
      'key'      => 'active_code',
      'label'    => 'Mã kích hoạt',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
    ],
    [
      'key'      => 'status_name',
      'label'    => 'Trạng thái',
      'sortable' => true,
      'class'    => 'align-middle d-block d-md-none',
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

  $url      = '/backend/auth/nguoi-dung';
  $rowClass = 'if (item.status != 1) return "text-secondary bg-light font-weight-light"';
  $notes    = [
    [
      'class'   => 'text-secondary bg-light font-weight-light',
      'content' => 'Chưa kích hoạt',
    ],
  ];

  echo $twig->render('backend/auth/nguoi-dung/index.html.twig', [
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
