<?php
// Include file cấu hình ban đầu của `Twig`
require_once __DIR__.'/../../bootstrap.php';

// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__.'/../../dbconnect.php');

// 2. Chuẩn bị câu truy vấn $sql
$stt=1;
$sql = "select * from `shop_customers`";

// 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
$result = mysqli_query($conn, $sql);

// 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
// Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
// Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
$data = [];
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $data[] = array(
        'id' => $row['id'],
        'username' => $row['username'],
        'password' => $row['password'],
        'last_name' => $row['last_name'],
        'first_name' => $row['first_name'],
        'email' => $row['email'],
        'avatar' => $row['avatar'],
        'company' => $row['company'],
        'phone' => $row['phone'],
        'billing_address' => $row['billing_address'],
        'shipping_address' => $row['shipping_address'],
        'city' => $row['city'],
        'state' => $row['state'],
        'postal_code' => $row['postal_code'],
        'country' => $row['country'],
        'remember_token' => $row['remember_token'],
        'active_code' => $row['active_code'],
        'status' => $row['status'],
        'created_at' => $row['created_at'],
        'updated_at' => $row['updated_at']
    );
}

// Yêu cầu `Twig` vẽ giao diện được viết trong file `backend/loaisanpham/loaisanpham.html.twig`
// với dữ liệu truyền vào file giao diện được đặt tên là `ds_loaisanpham`
echo $twig->render('backend/shop_customers/index.html.twig', ['customers' => $data] );