<?php
require_once __DIR__ . '/../../bootstrap.php';
include_once __DIR__ . '/../../dbconnect.php';

$sql = "select * from `shop_suppliers`";
$result = mysqli_query($conn, $sql);

$data   = [];
$rowNum = 1;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  $data[] = array(
    'rowNum'        => $rowNum, // sử dụng biến tự tăng để làm dữ liệu cột STT
    'supplier_code' => $row['supplier_code'],
    'supplier_name' => $row['supplier_name'],
    'description'   => $row['description'],
    'image'         => $row['image'],
    'created_at'    => $row['created_at'],
    'updated_at'    => $row['updated_at'],
  );
  $rowNum++;
}

// Yêu cầu `Twig` vẽ giao diện được viết trong file `backend/shop_suppliers/index.html.twig`
// với dữ liệu truyền vào file giao diện được đặt tên là `suppliers`
echo $twig->render('backend/shop_suppliers/index.html.twig', [
  'suppliers' => $data,
]);
