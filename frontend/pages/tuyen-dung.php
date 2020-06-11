<?php
require_once __DIR__ . '/../../bootstrap.php';
// include_once __DIR__ . '/../../dbconnect.php';

$jobs = [
  0 => [
    'position'   => 'Front-end developer',
    'department' => 'Developer',
    'location'   => 'Hà Nội',
  ],
  1 => [
    'position'   => 'Nhân viên kiểm thử (Tester)',
    'department' => 'Product',
    'location'   => 'Hà Nội',
  ], 2 => [
    'position'   => 'Performance Marketing Leader',
    'department' => 'Marketing',
    'location'   => 'Hà Nội',
  ], 3 => [
    'position'   => 'PHP developer',
    'department' => 'Developer',
    'location'   => 'Hà Nội',
  ], 4 => [
    'position'   => 'SEO Specialist',
    'department' => 'Marketing',
    'location'   => 'Hà Nội',
  ], 5 => [
    'position'   => 'Customer Supporter',
    'department' => 'Customer Success',
    'location'   => 'Hà Nội',
  ],
];

$departments = [
  'Developer',
  'Product',
  'Marketing',
  'Customer Success',
];

$locations = [
  'Hà Nội',
  'Đà Nẵng',
  'TP. Hồ Chí Minh',
  'Cần Thơ',
];

echo $twig->render('frontend/pages/tuyen-dung.html.twig', [
  'jobs'        => $jobs,
  'departments' => $departments,
  'locations'   => $locations,
]);