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

$data  = [];
$index = 0;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  $data[] = [
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

echo $twig->render('backend/acl_users/index.html.twig', [
  'data' => json_encode($data),
]);
