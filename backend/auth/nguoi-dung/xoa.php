<?php
if (!is_numeric($_GET['id'])) {
  die("ID người dùng không hợp lệ.");
}

require_once __DIR__ . '/../../../dbconnect.php';

// Check user
try {
  $statement = $conn->prepare(<<<query
      select avatar
      from acl_users
      where id = ?
    query);
  $statement->bind_param('i', $_GET['id']);
  $statement->execute();
  $result = $statement->get_result();
  if ($result->num_rows) {
    $avatar = $result->fetch_array(MYSQLI_ASSOC)['avatar'];
  } else {
    $conn->close();
    die('Xin lỗi, không tìm thấy người dùng.');
  }
} catch (mysqli_sql_exception $exception) {
  $conn->close();
  die('Xin lỗi, không thể truy vấn cơ sở dữ liệu.');
}

// Delete shop_order_details has deleted employee_id (user) -> delete shop_orders has deleted employee_id (user) -> delete acl_users has deleted id
try {
  $statement1 = $conn->prepare(<<<query
    delete from shop_order_details
    where order_id in (
      select id
      from shop_orders
      where employee_id = ?
    )
  query);
  $statement2 = $conn->prepare(<<<query
    delete from shop_orders
    where employee_id = ?
  query);
  $statement3 = $conn->prepare(<<<query
    delete from acl_users
    where id = ?
  query);

  $statement1->bind_param('i', $_GET['id']);
  $statement2->bind_param('i', $_GET['id']);
  $statement3->bind_param('i', $_GET['id']);

  $statement1->execute();
  $statement2->execute();
  $statement3->execute();

  $conn->close();
  if ($avatar != '/assets/shared/img/no-avatar.png') {
    unlink(__DIR__ . "/../../..$avatar");
  }
  header('location: ./');
} catch (mysqli_sql_exception $exception) {
  $conn->close();
  die('Xin lỗi, không thể truy vấn cơ sở dữ liệu.');
}
