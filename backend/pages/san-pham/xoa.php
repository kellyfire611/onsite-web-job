
<?php
if (!is_numeric($_GET['id'])) {
  die("ID sản phẩm không hợp lệ.");
}

require_once __DIR__ . '/../../../dbconnect.php';

// Check user
try {
  $statement = $conn->prepare(<<<query
      select image
      from shop_products
      where id = ?
    query);
  $statement->bind_param('i', $_GET['id']);
  $statement->execute();
  $result = $statement->get_result();
  if ($result->num_rows) {
    $image = $result->fetch_array(MYSQLI_ASSOC)['image'];
  } else {
    $conn->close();
    die('Xin lỗi, không tìm thấy người dùng.');
  }
} catch (mysqli_sql_exception $exception) {
  $conn->close();
  die('Xin lỗi, không thể truy vấn cơ sở dữ liệu.');
}

// Delete shop_order_details has deleted product_id (product) -> delete shop_product_images has deleted product_id (product) ->
// Delete acl_users has deleted id
try {
  $statement1 = $conn->prepare(<<<query
    delete from shop_order_details
    where product_id = ?
  query);
  $statement2 = $conn->prepare(<<<query
    delete from shop_product_images
    where product_id = ?
  query);
  $statement3 = $conn->prepare(<<<query
    delete from shop_product_reviews
    where product_id = ?
  query);
  $statement4 = $conn->prepare(<<<query
    delete from shop_product_vouchers
    where product_id = ?
  query);
  $statement5 = $conn->prepare(<<<query
    delete from shop_product_discounts
    where product_id = ?
  query);
  $statement6 = $conn->prepare(<<<query
    delete from shop_products
    where id = ?
  query);

  $statement1->bind_param('i', $_GET['id']);
  $statement2->bind_param('i', $_GET['id']);
  $statement3->bind_param('i', $_GET['id']);
  $statement4->bind_param('i', $_GET['id']);
  $statement5->bind_param('i', $_GET['id']);
  $statement6->bind_param('i', $_GET['id']);

  $statement1->execute();
  $statement2->execute();
  $statement3->execute();
  $statement4->execute();
  $statement5->execute();
  $statement6->execute();

  $conn->close();
  if ($image != '/assets/shared/img/no-image.png') {
    unlink(__DIR__ . "/../../..$image");
  }
  header('location: ./');
} catch (mysqli_sql_exception $exception) {
  $conn->close();
  die('Xin lỗi, không thể truy vấn cơ sở dữ liệu.');
}
