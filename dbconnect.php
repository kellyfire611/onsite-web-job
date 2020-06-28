<?php
include_once __DIR__ . '/config.php';

$driver              = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

try {
  $conn = new mysqli(
    Config::$DB_CONNECTION_HOST,
    Config::$DB_CONNECTION_USERNAME,
    Config::$DB_CONNECTION_PASSWORD,
    Config::$DB_CONNECTION_DATABASE_NAME
  );
} catch (mysqli_sql_exception $exception) {
  die('Xin lỗi, không thể kết nối cơ sở dữ liệu.');
}

try {
  $conn->query('set names utf8mb4');
  $conn->query('set character set utf8mb4');
  $conn->query('set session collation_connection = utf8mb4_unicode_ci');
} catch (mysqli_sql_exception $exception) {
  $conn->close();
  die('Xin lỗi, không thể truy vấn cơ sở dữ liệu.');
}
