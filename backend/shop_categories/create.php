<?php
//define('UPLOAD_PATH',realpath(__DIR__.'/../../'));
// Include file cấu hình ban đầu của `Twig`
require_once __DIR__ . '/../../bootstrap.php';

// Truy vấn database
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__ . '/../../dbconnect.php');

// Include thư viện các hàm tiện ích
//include_once(__DIR__ . '/../../app/helpers.php');

// Kiểm tra có đăng nhập hay chưa? (Xác thực Authentication)
// Nếu trong SESSION có giá trị của key 'email' <-> người dùng đã đăng nhập thành công
// Nếu chưa đăng nhập thì chuyển hướng về trang đăng nhập của Backend
/*if (!isset($_SESSION['backend']['email'])) {
    header('location:../auth/login.php');
    return;
}*/

// Kiểm tra có Quyền vào chức năng này không? (Xác thực Authorization)
//$email = $_SESSION['backend']['email'];

// 2. Chuẩn bị câu truy vấn $sql
// Gọi hàm Kiểm tra email đã đăng nhập có quyền truy cập chức năng XEM hay không?
//$allow_permission_backend_shop_suppliers_view = backend_check_email_has_permission($email, StaticData::$PERMISSION_BACKEND_SHOP_SUPPLIERS_VIEW);
// dd($allow_permission_backend_shop_suppliers_view);

// Nếu không có quyền thì chuyển hướng sang trang 403
/*if(!$allow_permission_backend_shop_suppliers_view) {
    // Yêu cầu `Twig` vẽ giao diện được viết trong file `backend/errors/403.html.twig`
    // với dữ liệu truyền vào file giao diện được đặt tên là `error`
    $error = [
        'msg' => 'Xin lỗi. Bạn không có quyền truy cập vào chức năng này.',
        'previous_url' => '/backend/pages/dashboard.php',
    ];
    echo $twig->render('backend/errors/403.html.twig', ['error' => $error]);
    return;
}
*/
// 2. Người dùng mới truy cập trang lần đầu tiên (người dùng chưa gởi dữ liệu `btnSave` - chưa nhấn nút Save) về Server
// có nghĩa là biến $_POST['btnSave'] chưa được khởi tạo hoặc chưa có giá trị
// => hiển thị Form nhập liệu
if (!isset($_POST['btnSave'])) {
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
    // Yêu cầu `Twig` vẽ giao diện được viết trong file `backend/shop_suppliers/create.html.twig`
    echo $twig->render('backend/shop_categories/create.html.twig');
    return;
}

// 3. Nếu người dùng có bấm nút `Lưu dữ liệu` thì thực thi câu lệnh INSERT
// Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST

