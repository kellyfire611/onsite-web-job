<?php
require_once __DIR__ . '/../../../bootstrap.php';

$regex = [
  'username'    => [
    'pattern' => Config::$REGEX_PATTERN['username'],
    'min'     => 5,
    'max'     => 191,
  ],
  'last_name'   => [
    'pattern' => Config::$REGEX_PATTERN['vietnamese_name'],
    'min'     => 1,
    'max'     => 255,
  ],
  'first_name'  => [
    'pattern' => Config::$REGEX_PATTERN['vietnamese_name'],
    'min'     => 1,
    'max'     => 255,
  ],
  'email'       => [
    'pattern' => Config::$REGEX_PATTERN['email'],
    'min'     => 12,
    'max'     => 191,
  ],
  'job_title'   => [
    'pattern' => Config::$REGEX_PATTERN['any'],
    'min'     => 0,
    'max'     => 255,
  ],
  'department'  => [
    'pattern' => Config::$REGEX_PATTERN['any'],
    'min'     => 0,
    'max'     => 255,
  ],
  'phone'       => [
    'pattern' => Config::$REGEX_PATTERN['phone'],
    'min'     => 10,
    'max'     => 25,
  ],
  'address1'    => [
    'pattern' => Config::$REGEX_PATTERN['any'],
    'min'     => 0,
    'max'     => 500,
  ],
  'address2'    => [
    'pattern' => Config::$REGEX_PATTERN['any'],
    'min'     => 0,
    'max'     => 500,
  ],
  'city'        => [
    'pattern' => Config::$REGEX_PATTERN['vietnamese_name'],
    'min'     => 0,
    'max'     => 255,
  ],
  'state'       => [
    'pattern' => Config::$REGEX_PATTERN['vietnamese_name'],
    'min'     => 0,
    'max'     => 255,
  ],
  'postal_code' => [
    'pattern' => Config::$REGEX_PATTERN['number'],
    'min'     => 0,
    'max'     => 15,
  ],
  'country'     => [
    'pattern' => Config::$REGEX_PATTERN['vietnamese_name'],
    'min'     => 0,
    'max'     => 255,
  ],
];

if (isset($_POST['submit'])) {
  include_once __DIR__ . '/../../../dbconnect.php';

$target_dir    = "uploads/";
$target_file   = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk      = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}
} else {
  echo $twig->render('backend/auth/acl_users/create.html.twig', [
    'el'   => 'form-create',
    'data' => json_encode($regex),
  ]);
}