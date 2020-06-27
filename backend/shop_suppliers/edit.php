<?php
// Include file cấu hình ban đầu của `Twig`
require_once __DIR__ . '/../../bootstrap.php';

// Truy vấn database
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__ . '/../../dbconnect.php');

// 2. Chuẩn bị câu truy vấn $sqlSelect, lấy dữ liệu ban đầu của record cần update
// Lấy giá trị khóa chính được truyền theo dạng QueryString Parameter key1=value1&key2=value2...
//if(isset($_GET['id']))
$id = $_GET['id'];

$sqlSelect = "SELECT * FROM `shop_suppliers` WHERE id=?;";
$stmt=$conn->prepare($sqlSelect);
$stmt->bind_param("i",$id);
$stmt->execute();
$resultSelect=$stmt->get_result();
$updateRow=$resultSelect->fetch_assoc();
//var_dump($updateRow);
//var_dump($stmt->execute());		
// 3. Người dùng mới truy cập trang lần đầu tiên (người dùng chưa gởi dữ liệu `btnSave` - chưa nhấn nút Save) về Server
// có nghĩa là biến $_POST['btnSave'] chưa được khởi tạo hoặc chưa có giá trị
// => hiển thị Form nhập liệu
if (!isset($_POST['btnSave'])) {
    // Thực thi câu truy vấn SQL để lấy về dữ liệu ban đầu của record cần update
    //$resultSelect = mysqli_query($conn, $sqlSelect);
    //$updateRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC); // 1 record
    
    // Nếu không tìm thấy dòng dữ liệu thì chuyển sang trang báo lỗi không tìm thấy (404 status code)
    if(empty($updateRow)) {
        // Yêu cầu `Twig` vẽ giao diện được viết trong file `backend/errors/404.html.twig`
        // với dữ liệu truyền vào file giao diện được đặt tên là `error`
        $error = [
            'msg' => 'Không tìm thấy dòng dữ liệu bạn muốn hiệu chỉnh. Vui lòng kiểm tra lại giá trị ID !!!',
            'previous_url' => 'index.php',
        ];
        echo $twig->render('backend/errors/404.html.twig', ['error' => $error]);
    }
    /*
    $rowNum = 1;
    $suppliersRow = [];
    while($updateRow=$resultSelect->fetch_assoc()){
        $suppliersRow = array(
                'id' => $updateRow['id'],
                'supplier_code' => $updateRow['supplier_code'],
                'supplier_name' => $updateRow['supplier_name'],
                'description' => $updateRow['description'],
                'image' => $updateRow['image'],
                'updated_at' => $updateRow['updated_at']
        );
        $rowNum++;
    }
    */
    // Yêu cầu `Twig` vẽ giao diện được viết trong file `backend/shop_suppliers/edit.html.twig`
    // với dữ liệu truyền vào file giao diện được đặt tên là `shop_suppliers`
    echo $twig->render('backend/shop_suppliers/edit.html.twig', [
        'suppliers' => $updateRow
    ]);
    return;
}

// 4. Nếu người dùng có bấm nút edit thì thực thi câu lệnh UPDATE
// Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
$supplier_code = $_POST['ncc_code'];
$supplier_name = $_POST['ncc_ten'];
$description = $_POST['ncc_mota'];

$image = $_POST['ncc_anh'];
//$created_at = date('Y-m-d H:i:s'); // Lấy ngày giờ hiện tại theo định dạng `Năm-Tháng-Ngày Giờ-Phút-Giây`. Vd: 2020-02-18 09:12:12
$updated_at = date('Y-m-d H:i:s');
//$supplier_code = $updateRow['supplier_code'];
//$supplier_name = $updateRow['supplier_name'];
//$description = $updateRow['description'];
//var_dump($supplier_code);
//$image = $_POST['ncc_anh'];
//$created_at = date('Y-m-d H:i:s'); // Lấy ngày giờ hiện tại theo định dạng `Năm-Tháng-Ngày Giờ-Phút-Giây`. Vd: 2020-02-18 09:12:12
//$updated_at = date('Y-m-d H:i:s');

//$anh='./../../';
$oldimage=$_POST['ncc_anhcu'];
$newimage="./../../assets/uploads/suppliers/".$_FILES['ncc_anh']['name'];
//var_dump($oldimage);
if(isset($_FILES['ncc_anh']['name'])&&($_FILES['ncc_anh']['name']!="")){
    
    if(file_exists($oldimage)){
        unlink($oldimage);
    }
    
    move_uploaded_file($_FILES['ncc_anh']['tmp_name'], $newimage);
}
else{
    $newimage=$oldimage;
}
// 5. Kiểm tra ràng buộc dữ liệu (Validation)
// Tạo biến lỗi để chứa thông báo lỗi
$errors = [];


// --- Kiểm tra Mã nhà cung cấp (validate)
// required (bắt buộc nhập <=> không được rỗng)
if (empty($supplier_code)) {
    $errors['ncc_code'][] = [
        'rule' => 'required',
        'rule_value' => true,
        'value' => $supplier_code,
        'msg' => 'Vui lòng nhập Ký hiệu Nhà cung cấp'
    ];
}
// minlength 4 (tối thiểu 4 ký tự)
if (!empty($supplier_code) && strlen($supplier_code) < 4) {
    $errors['ncc_code'][] = [
        'rule' => 'minlength',
        'rule_value' => 4,
        'value' => $supplier_code,
        'msg' => 'Ký hiệu Nhà cung cấp phải có ít nhất 3 ký tự'
    ];
}
// maxlength 50 (tối đa 50 ký tự)
if (!empty($supplier_code) && strlen($supplier_code) > 50) {
    $errors['ncc_code'][] = [
        'rule' => 'maxlength',
        'rule_value' => 50,
        'value' => $supplier_code,
        'msg' => 'Ký hiệu Nhà cung cấp không được vượt quá 50 ký tự'
    ];
}

// --- Kiểm tra Tên nhà cung cấp (validate)
// required (bắt buộc nhập <=> không được rỗng)
if (empty($supplier_name)) {
    $errors['ncc_ten'][] = [
        'rule' => 'required',
        'rule_value' => true,
        'value' => $supplier_name,
        'msg' => 'Vui lòng nhập tên nhà cung cấp'
    ];
}
// minlength 3 (tối thiểu 3 ký tự)
if (!empty($supplier_name) && strlen($supplier_name) < 3) {
    $errors['ncc_ten'][] = [
        'rule' => 'minlength',
        'rule_value' => 3,
        'value' => $supplier_name,
        'msg' => 'Tên nhà cung cấp phải có ít nhất 4 ký tự'
    ];
}
// maxlength 255 (tối đa 255 ký tự)
if (!empty($supplier_name) && strlen($supplier_name) > 50) {
    $errors['ncc_ten'][] = [
        'rule' => 'maxlength',
        'rule_value' => 50,
        'value' => $supplier_name,
        'msg' => 'Tên nhà cung cấp không được vượt quá 50 ký tự'
    ];
}
// --- Kiểm tra mô tả nhà cung cấp (validate)
// required (bắt buộc nhập <=> không được rỗng)
if (empty($description)) {
    $errors['ncc_mota'][] = [
        'rule' => 'required',
        'rule_value' => true,
        'value' => $description,
        'msg' => 'Vui lòng nhập mô tả nhà cung cấp'
    ];
}
// minlength 3 (tối thiểu 3 ký tự)
if (!empty($description) && strlen($description) < 3) {
    $errors['ncc_mota'][] = [
        'rule' => 'minlength',
        'rule_value' => 3,
        'value' => $description,
        'msg' => 'Mô tả nhà cung cấp phải có ít nhất 4 ký tự'
    ];
}
// maxlength 255 (tối đa 255 ký tự)
if (!empty($description) && strlen($description) > 255) {
    $errors['ncc_mota'][] = [
        'rule' => 'maxlength',
        'rule_value' => 255,
        'value' => $description,
        'msg' => 'Mô tả nhà cung cấp không được vượt quá 255 ký tự'
    ];
}

// Câu lệnh UPDATE
/*
$sqlUpdate = <<<EOT
    UPDATE shop_suppliers
	SET
		supplier_code='$supplier_code',
		supplier_name='$supplier_name',
		description='$description',
		image='$image',
		updated_at='$updated_at'
	WHERE id=$id
EOT;
*/
$query="UPDATE `shop_suppliers` SET `supplier_code`=?, `supplier_name`=?, `description`=?, `image`=?, `updated_at`=? WHERE `id`=?";
$stmt=$conn->prepare($query);

$stmt->bind_param("sssssi",$supplier_code,$supplier_name,$description,$newimage,$updated_at,$id);
//var_dump($id);
$stmt->execute();
// Thực thi UPDATE
//mysqli_query($conn, $sqlUpdate);

// Đóng kết nối
mysqli_close($conn);

// Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
header('location:./');
