<?php
// Include file cấu hình ban đầu của `Twig`
require_once __DIR__.'/../../bootstrap.php';

// Truy vấn database
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__.'/../../dbconnect.php');

// 2. Nếu người dùng có bấm nút Đăng ký thì thực thi câu lệnh UPDATE
if(isset($_POST['btnSave'])) 
{
    // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
    $name = $_POST['name'];
    $display_name = $_POST['display_name'];
    $guard_name = $_POST['guard_name'];
    $created_at = $_POST['created_at'];
    $updated_at = $_POST['updated_at'];
    // Câu lệnh INSERT
    $sql = "INSERT INTO `acl_roles` (name, display_name,guard_name,created_at,updated_at) 
    VALUES ('" . $name . "', '". $display_name ."', '". $guard_name ."', '". $created_at ."', '". $updated_at ."');";

    // Thực thi INSERT
    mysqli_query($conn, $sql);

    // Đóng kết nối
    mysqli_close($conn);

    // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
    header('location:index.php');
}

// Yêu cầu `Twig` vẽ giao diện được viết trong file `backend/loaisanpham/create.html.twig`
echo $twig->render('backend/vaitro/create.html.twig');