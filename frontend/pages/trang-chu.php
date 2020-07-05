<?php
require_once __DIR__ . '/../../bootstrap.php';

$peopleAirport           = 16;
$peopleLongRoad          = 16;
$durationTourRentals     = [2, 4, 6, 8, 10, 12];
$carCategoriesTourRental = ['Tất cả loại xe', 'Xe 4 chỗ cốp rộng', 'Xe 7 chỗ', 'Xe 16 chỗ'];

$moneySave    = '27.13 tỷ';
$tripsSuccess = '1.33 triệu';
$co2          = '2.44 nghìn';

$tripsPopular = [
  [
    'from'  => 'Hà Nội',
    'to'    => 'Nội Bài',
    'price' => 110,
  ],
  [
    'from'  => 'Lien Khuong Airport',
    'to'    => 'Da Lat',
    'price' => 120,
  ],
  [
    'from'  => 'Cam Ranh Airport',
    'to'    => 'Nha Trang',
    'price' => 150,
  ],
  [
    'from'  => 'Phu Quoc Airport',
    'to'    => 'Duong Dong',
    'price' => 100,
  ],
  [
    'from'  => 'Phu Bai Airport',
    'to'    => 'Hue City',
    'price' => 100,
  ],
  [
    'from'  => 'SB Nội Bài',
    'to'    => 'Hà Nội',
    'price' => 159,
  ],
];

$newsList = [
  [
    'name'         => 'cafe-khoi-nghiep-vtv1-08-05-2019',
    'title'        => '[VTV1] Chia sẻ lộ trình với người khác',
    'shortContent' => 'Hiện thực hóa 1 ý tưởng đã thành công không dễ khi thị trường có nhiều sự khác biệt. Cùng tìm hiểu ngay!',
  ],
  [
    'name'         => 've-que-chuong-trinh-hanh-trinh-24h-cua-vtv1',
    'title'        => 'Hành trình đi chung taxi về quê',
    'shortContent' => 'Chương trình "Hành trình 24h" được phát xong (12h55) ngày 03/02/2016 đề cập đến vấn đề đi chung taxi về quê.',
  ],
  [
    'name'         => 'phong-su-di-chung-xe-noi-bai-chuyen-muc-xa-hoi-thong-tin-vtc2',
    'title'        => '[VTC2] Phóng sự đi chung xe taxi Nội Bài',
    'shortContent' => 'Đi chung xe ngoài việc giảm ùn tắc, tiết kiệm chi phí, bảo vệ môi trường, đi chung xe còn là cơ hội để tìm kiếm bạn bè, đối tác...',
  ],
];

$saleList = [
  [
    'name'         => 'hop-tac-mobifone',
    'title'        => 'ƯU ĐÃI LỚN CHO KHÁCH HÀNG MOBIFONE KHI ĐẶT XE SÂN BAY',
    'shortContent' => 'Onsite Web Job hợp tác cùng Mobifone, giảm ngay 100k/chuyến các tuyến sân bay trên toàn quốc cho khách hàng sử dụng dịch vụ Mobifone.',
  ],
  [
    'name'         => 'du-lich-chung-doi',
    'title'        => 'DU LỊCH CHUNG ĐÔI, TIẾT KIỆM SUNG SƯỚNG',
    'shortContent' => 'Nay với Onsite Web Job, du lịch couple vừa tiện vừa vui lại không lo cháy túi. Dưới đây là bảng giá taxi sân bay dành cho các cặp đôi sử dụng  dịch vụ Đi Ghép cực kì ưu đãi cho một mùa du lịch tấp nập không tốn kém. ',
  ],
  [
    'name'         => 'uu-dai-doc-quyen-danh-cho-doi-tac',
    'title'        => 'CHƯƠNG TRÌNH ƯU ĐÃI ĐỘC QUYỀN DÀNH CHO ĐỐI TÁC ONSITE WEB JOB',
    'shortContent' => 'Chương trình ưu đãi độc quyền, dành riêng cho các chủ homestay, Airbnb, quản lý khách sạn, đơn vị phòng vé và các công ty lữ hành!',
  ],
];

$comments = [
  [
    'star'    => 5,
    'date'    => '2019-05-13',
    'content' => 'Chị tài xế cực kì dễ thương, thân thiện và tử tế. Mình cảm thấy rất vui khi có duyên gặp chị, 1 nữ tài xế người gốc Đà Lạt hiền hòa và kể cho bọn mình nghe nhiều câu chuyện. Cám ơn chị rất nhiều.',
    'auth'    => 'Lưu Hoàng Kiếm',
  ],
  [
    'star'    => 5,
    'date'    => '2019-05-12',
    'content' => 'Anh tài xế nói chuyện thân thiện và vui vẻ. Cám ơn anh nhiều nhen.',
    'auth'    => 'Lưu Hoàng Kiếm',
  ],
  [
    'star'    => 5,
    'date'    => '2019-05-11',
    'content' => 'Cảm ơn Onsite Web Job đã đồng hành cùng gia đình tôi trong chuyến đi này. Tôi sẽ tiếp tục lựa chọn Onsite Web Job trong những chuyến đi sắp tới. Thanks',
    'auth'    => 'Bùi Ngọc Nguyên',
  ],
  [
    'star'    => 5,
    'date'    => '2019-05-10',
    'content' => 'Lái xe cẩn thận . Chạy êm, nhiệt tình vui vẻ. Giới thiệu như hướng dẫn viên. Chở đi ăn cũng không lấy thêm tiền Chân thành cám ơn công ty',
    'auth'    => 'Nguyễn Xuân Hoàng',
  ],
  [
    'star'    => 5,
    'date'    => '2019-05-09',
    'content' => 'Đặt xe nhanh chóng, tài xế cả hai lượt đi và về đều rất thân thiện nhiệt tình, tôi rất hài lòng chuyến đi của mình với dịch vụ Onsite Web Job. Cám ơn các bạn.',
    'auth'    => 'Nguyễn Thị Thảo Diệp',
  ],
  [
    'star'    => 5,
    'date'    => '2019-05-09',
    'content' => 'Tài xế thân thiện, đón đúng giờ. Tôi rất hài lòng chuyến đi',
    'auth'    => 'Hằng',
  ],
  [
    'star'    => 5,
    'date'    => '2019-05-08',
    'content' => 'Chị tài xế cực kì dễ thương, thân thiện và tử tế. Mình cảm thấy rất vui khi có duyên gặp chị, 1 nữ tài xế người gốc Đà Lạt hiền hòa và kể cho bọn mình nghe nhiều câu chuyện. Cám ơn chị rất nhiều.',
    'auth'    => 'Lưu Hoàng Kiếm',
  ],
];

echo $twig->render('frontend/pages/trang-chu.html.twig', [
  'peopleAirport'           => $peopleAirport,
  'peopleLongRoad'          => $peopleLongRoad,
  'durationTourRentals'     => $durationTourRentals,
  'carCategoriesTourRental' => $carCategoriesTourRental,
  'moneySave'               => $moneySave,
  'tripsSuccess'            => $tripsSuccess,
  'co2'                     => $co2,
  'tripsPopular'            => $tripsPopular,
  'newsList'                => $newsList,
  'saleList'                => $saleList,
  'comments'                => $comments,
]);