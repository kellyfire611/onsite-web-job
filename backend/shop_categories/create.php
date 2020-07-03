<?php
//define('UPLOAD_PATH',realpath(__DIR__.'/../../'));
// Include file cấu hình ban đầu của `Twig`
require_once __DIR__ . '/../../bootstrap.php';

// Truy vấn database
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__ . '/../../dbconnect.php');

// 2. Người dùng mới truy cập trang lần đầu tiên (người dùng chưa gởi dữ liệu `btnSave` - chưa nhấn nút Save) về Server
// có nghĩa là biến $_POST['btnSave'] chưa được khởi tạo hoặc chưa có giá trị
// => hiển thị Form nhập liệu
if (isset($_POST['btnSave'])) {
        // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
        $category_name = $_POST['category_name'];
        $description = $_POST['description'];
    
        // Câu lệnh INSERT
        $sql = "INSERT INTO `shop_categories` (category_name, description) VALUES ('" . $category_name . "', '". $description ."');";
    
        // Thực thi INSERT
        mysqli_query($conn, $sql);
    
        // Đóng kết nối
        mysqli_close($conn);
    
        // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
        header('location:index.php');
}
// Yêu cầu `Twig` vẽ giao diện được viết trong file `backend/shop_suppliers/create.html.twig`
echo $twig->render('backend/shop_categories/create.html.twig');
return;
// 3. Nếu người dùng có bấm nút `Lưu dữ liệu` thì thực thi câu lệnh INSERT
// Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST

