<?php
// Include file cấu hình ban đầu của `Twig`
require_once __DIR__.'/../../bootstrap.php';

// Truy vấn database
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__.'/../../dbconnect.php');

// 2. Chuẩn bị câu truy vấn $sqlSelect, lấy dữ liệu ban đầu của record cần update
// Lấy giá trị khóa chính được truyền theo dạng QueryString Parameter key1=value1&key2=value2...
$id = $_GET['id'];
$sqlSelect = "SELECT * FROM `shop_customers` WHERE id=$id;";

// 3. Thực thi câu truy vấn SQL để lấy về dữ liệu ban đầu của record cần update
$resultSelect = mysqli_query($conn, $sqlSelect);
$customersRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC); // 1 record

// 4. Nếu người dùng có bấm nút Đăng ký thì thực thi câu lệnh UPDATE
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
    //$avatar = $_POST['lsp_mota'];
    // Câu lệnh UPDATE
    $link="customers/avatars/";
    $avatarcu=$_POST['txtavatarcu'];
    $newimage=($link.$_FILES['txtavatar']['name']);
   $newimage="../../assets/uploads/".$link.$_FILES['txtavatar']['name'];
    //var_dump($avatarcu);
    if(isset($_FILES['txtavatar']['name'])&&($_FILES['txtavatar']['name']!="")){
        
        
        move_uploaded_file($_FILES['txtavatar']['tmp_name'], $newimage);
    }
    else{
        $newimage=$avatarcu;
    }
     
    
    $sql = "UPDATE `shop_customers` SET username='$username', password='$pass', last_name='$last_name', first_name='$first_name', email='$email', avatar='$newimage', company='$company', phone='$phone', billing_address='$billing_address', shipping_address='$shipping_address', city='$city',state='$state', postal_code='$postal_code', country='$country', remember_token='$remember_token', active_code='$active_code', status='$status', created_at='$created_at', updated_at='$updated_at' WHERE id='$id';";
     
        //     var_dump($sql);
        //      var_dump($newimage);
        // die();

    // Thực thi UPDATE
    mysqli_query($conn, $sql);

    // Đóng kết nối
    mysqli_close($conn);

    // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
    header('location:index.php');
}

// Yêu cầu `Twig` vẽ giao diện được viết trong file `backend/loaisanpham/edit.html.twig`
// với dữ liệu truyền vào file giao diện được đặt tên là `loaisanpham`
echo $twig->render('backend/shop_customers/edit.html.twig', ['shop_customers' => $customersRow] );

die();