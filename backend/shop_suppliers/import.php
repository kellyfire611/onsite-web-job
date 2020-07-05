<?php
// Include file cấu hình ban đầu của `Twig`
require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/../../bootstrap.php';
require __DIR__ . '/../../vendor/PHPOffice/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__ . '/../../dbconnect.php');

if (isset($_POST['btnImport'])) {
    // Kiểm tra file import đã được upload hay chưa?
    if (!empty($_FILES['taptindulieu']['name'])) {
        // lấy đuôi file để tạo class READER tương ứng
        $extension = pathinfo($_FILES['taptindulieu']['name'], PATHINFO_EXTENSION);

        if ($extension == 'csv') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } elseif ($extension == 'xlsx') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        }

        // Đọc tất cả dữ liệu từ file import
        $spreadsheet = $reader->load($_FILES['taptindulieu']['tmp_name']);
        $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true, null, null, null);

        // Kiểm tra các cột dữ liệu có đúng mẫu hay không?
        $arrayCount = count($allDataInSheet);
        $flag = 0;
        $createArray = array('ncc_code', 'ncc_ten', 'ncc_mota', 'ncc_anh', 'ncc_ngaytao', 'ncc_ngaycapnhat');
        $makeArray = array('ncc_code' => 'ncc_code', 'ncc_ten' => 'ncc_ten', 'ncc_mota' => 'ncc_mota', 'ncc_anh' => 'ncc_anh', 'ncc_ngaytao' => 'ncc_ngaytao', 'ncc_ngaycapnhat' => 'ncc_ngaycapnhat');
        $SheetDataKey = array();
        foreach ($allDataInSheet as $dataInSheet) {
            foreach ($dataInSheet as $key => $value) {
                if (in_array(trim($value), $createArray)) {
                    $value = preg_replace('/\s+/', '', $value);
                    $SheetDataKey[trim($value)] = $key;
                }
            }
        }
        $dataDiff = array_diff_key($makeArray, $SheetDataKey);
        if (empty($dataDiff)) {
            $flag = 1;
        }
        // Thực thi Import dữ liệu
        if ($flag == 1) {
            // Đọc dữ liệu từ dòng số 2 (do dòng 1 đã lấy làm tiêu đề cột)
            for ($i = 2; $i <= $arrayCount; $i++) {
                $supplier_code = $SheetDataKey['ncc_code'];
                $supplier_name = $SheetDataKey['ncc_ten'];
                $description = $SheetDataKey['ncc_mota'];
                $image = $SheetDataKey['ncc_anh'];
                $created_at = $SheetDataKey['ncc_ngaytao']; 
                $updated_at = $SheetDataKey['ncc_ngaycapnhat'];
                $supplier_code = filter_var(trim($allDataInSheet[$i][$supplier_code]), FILTER_SANITIZE_STRING);
                $supplier_name = filter_var(trim($allDataInSheet[$i][$supplier_name]), FILTER_SANITIZE_STRING);
                $description = filter_var(trim($allDataInSheet[$i][$description]), FILTER_SANITIZE_STRING);
                $image = filter_var(trim($allDataInSheet[$i][$image]), FILTER_SANITIZE_STRING);
                $created_at = filter_var(trim($allDataInSheet[$i][$created_at]), FILTER_SANITIZE_STRING);
                $updated_at = filter_var(trim($allDataInSheet[$i][$updated_at]), FILTER_SANITIZE_STRING);               
                $fetchData[] = array('ncc_code' => $supplier_code, 'ncc_ten' => $supplier_name, 'ncc_mota' => $description, 'ncc_anh' => $image, 'ncc_ngaytao' => $created_at, 'ncc_ngaycapnhat' => $updated_at);
            }
            $data['dataInfo'] = $fetchData;
            
            // dd($fetchData);
            foreach($fetchData as $row) {
                // Câu lệnh INSERT
                $ncc_code = $row['ncc_code'];
                $ncc_ten = $row['ncc_ten'];
                $ncc_mota = $row['ncc_mota'];
                $ncc_anh = $row['ncc_anh'];
                $ncc_ngaytao = $row['ncc_ngaytao'];
                $ncc_ngaycapnhat = $row['ncc_ngaycapnhat'];
                $sql = "INSERT INTO `shop_suppliers` (`supplier_code`, `supplier_name`, `description`, `image`, created_at, updated_at) VALUES (?,?,?,?,?,?)";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("ssssss",$ncc_code,$ncc_ten,$ncc_mota,$ncc_anh,$ncc_ngaytao,$ncc_ngaycapnhat);
               
                // Thực thi INSERT
                $stmt->execute();
                //mysqli_query($conn, $sql);
            }
        } else {
            echo "Các cột Excel không đúng mẫu. Vui lòng download mẫu Import từ trang web và nhập liệu chính xác.";
        }
        header('location:index.php');
    }
} else {
    // Yêu cầu `Twig` vẽ giao diện được viết trong file `backend/loaisanpham/loaisanpham.html.twig`
    // với dữ liệu truyền vào file giao diện được đặt tên là `ds_loaisanpham`
    echo $twig->render('backend/shop_suppliers/import.html.twig');
}
