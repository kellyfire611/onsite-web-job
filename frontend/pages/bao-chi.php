<?php
require_once __DIR__ . '/../../bootstrap.php';
// include_once __DIR__ . '/../../dbconnect.php';

$newsList = [
  0 => [
    'title'        => '[VTV1] Chia sẻ lộ trình với người khác',
    'shortContent' => 'Hiện thực hóa 1 ý tưởng đã thành công không dễ khi thị trường có nhiều sự khác biệt. Cùng tìm hiểu ngay!',
    'url'          => 'cafe-khoi-nghiep-vtv1-08-05-2019',
  ],
  2 => [
    'title'        => 'Hành trình đi chung taxi về quê',
    'shortContent' => 'Chương trình "Hành trình 24h" được phát xong (12h55) ngày 03/02/2016 đề cập đến vấn đề đi chung taxi về quê.',
    'url'          => 've-que-chuong-trinh-hanh-trinh-24h-cua-vtv1',
  ],
  3 => [
    'title'        => '[VTC2] Phóng sự đi chung xe taxi Nội Bài',
    'shortContent' => 'Đi chung xe ngoài việc giảm ùn tắc, tiết kiệm chi phí, bảo vệ môi trường, đi chung xe còn là cơ hội để tìm kiếm bạn bè, đối tác...',
    'url'          => 'phong-su-di-chung-xe-noi-bai-chuyen-muc-xa-hoi-thong-tin-vtc2',
  ],
  4 => [
    'title'        => '[VTC10] Lợi ích từ việc đi chung xe',
    'shortContent' => 'Chuyên mục Nhịp sống mới - VTC10 có phóng sự về hình thức đi chung xe và những lợi ích từ việc đi chung xe mang lại cho mỗi cá nhân.',
    'url'          => 'phong-su-ve-di-chung-xe-chuyen-muc-nhip-song-moi-vtc10',
  ],
  5 => [
    'title'        => '[VTV1] Đi Chung xe taxi tiết kiệm chi phí',
    'shortContent' => 'Phóng sự về đi chung taxi chuyên tuyến Hà Nội - Nội Bài do Ban thời sự - VTV1 thực hiện. Phát sóng lúc 17h45 ngày 26/11/2013.',
    'url'          => 'tiet-kiem-chi-phi-dai-truyen-hinh-viet-nam-vtv1',
  ],
  6 => [
    'title'        => '[HTV1] Đi chung taxi Hà Nội - Nội Bài',
    'shortContent' => 'Phóng sự về đi chung xe được phát trên chuyên mục "7 Ngày công nghệ" do VTV2 - Ban khoa giáo, Đài truyền hình Việt Nam thực hiện.',
    'url'          => 'nhip-dieu-ngay-moi-htv1-san-bay-ha-noi-noi-bai',
  ],
];

// render template
echo $twig->render('frontend/pages/bao-chi.html.twig', [
  'newsList' => $newsList,
]);