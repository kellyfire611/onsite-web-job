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
    $id = $_POST['txtid'];
    $username = $_POST['txtusername'];
    $password = $_POST['txtpassword'];
    $pass=password_hash($password,PASSWORD_DEFAULT);
    $last_name = $_POST['txtlastname'];
    $first_name = $_POST['txtfirstname'];
    $email = $_POST['txtemail'];
    $company = $_POST['txtcompany'];
    $phone = $_POST['txtphone'];
    $billing_address = $_POST['txtbillingaddress'];
    $shipping_address = $_POST['txtshippingaddress'];
    $city = $_POST['txtcity'];
    $state = $_POST['txtstate'];
    $postal_code = $_POST['txtpostalcode'];
    $country = $_POST['txtcountry'];
    $remember_token = $_POST['txtremembertoken'];
    $active_code = $_POST['txtactivecode'];
    $status = $_POST['txtstatus'];
    $created_at = $_POST['txtcreatedat'];
    $updated_at = $_POST['txtupdatedat'];
    
	
	// Nếu người dùng có chọn file để upload
$target_dir = "../../assets/uploads/customers/avatars/";
$target = $target_dir . basename( $_FILES['txtavatar']['name']);
$link="customers/avatars/";
if(move_uploaded_file($_FILES['txtavatar']['tmp_name'], $target))
{
//Tells you if its all ok
echo "The file ".$link.basename( $_FILES['txtavatar']['name']);
// . " has been uploaded, and your information has been added to the directory";
}
else {
//Gives and error if its not
// echo "Sorry, there was a problem uploading your file.";
}
$avatar=($link.$_FILES['txtavatar']['name']);

//     var_dump($avatar);

//  die();
if(empty($status)){
    echo "<script>alert('Trạng thái không được rỗng')</script>";
       header('location:create.php');
    return false;
}if($status !=1 && $status !=0){
    echo "<script>alert('Nhập Sai giá trị của trạng thái')</script>";
       header('location:create.php');
    return false; 
}
    // Câu lệnh INSERT
    $sql = "INSERT INTO `shop_customers`
    (`id`,`username`,`password`,`last_name`,`first_name`,`email`,`avatar`,`company`,`phone`,`billing_address`,`shipping_address`,`city`,`state`,`postal_code`,`country`,`remember_token`,`active_code`,`status`,`created_at`,`updated_at`)
     VALUES ('" . $id . "', '". $username ."','".$pass."','".$last_name."','".$first_name."','".$email."','".$avatar."','".$company."','".$phone."','".$billing_address."','".$shipping_address."','".$city."','".$state."','".$postal_code."','".$country."','".$remember_token."','".$active_code."','".$status."','".$created_at."','".$updated_at."');";

    // Thực thi INSERT
    
    mysqli_query($conn,$sql);
    //  var_dump($sql);    
    //  echo "<pre>";
      
    // var_dump($result);
    // echo "</pre>";
    // die();
    // Đóng kết nối
    mysqli_close($conn);

    // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
    header('location:index.php');
}

// Yêu cầu `Twig` vẽ giao diện được viết trong file `backend/loaisanpham/create.html.twig`
echo $twig->render('backend/shop_customers/create.html.twig');