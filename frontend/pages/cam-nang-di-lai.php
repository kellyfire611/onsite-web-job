<?php
// Include file cấu hình ban đầu của `Twig`
require_once __DIR__.'/../../bootstrap.php';

// Truy vấn database để lấy danh sách
$newsList = [
    0 => [
        'name'         => 'ti1',
        'category'     => 'TIỆN ÍCH HAY',
        'title'        => 'XE BUS CHẤT LƯỢNG CAO ĐI SÂN BAY NỘI BÀI GIÁ CHỈ 30.000ĐỒNG/LƯỢT',
        'shortContent' => 'Tại Nhà ga sân bay quốc tế T2, Tổng công ty vận tải khai trương xe bus chất lượng cao số 86 từ ga Hà Nội đi sân bay Nội Bài và ngược lại.',
    ],
    1 => [
        'name'         => 'ti2',
        'category'     => 'TIỆN ÍCH HAY',
        'title'        => 'SỐ ĐIỆN THOẠI VÀ GIÁ CƯỚC TAXI ĐÀ NẴNG 2020',
        'shortContent' => 'Thông tin số điện thoại và giá cước các hãng taxi Đà Nẵng giá rẻ cập nhật mới nhất tháng 1/2019 của DichungTaxi.',
    ],
    2 => [
        'name'         => 'ti3',
        'category'     => 'TIỆN ÍCH HAY',
        'title'        => 'ĐI CHUNG XE VỀ QUÊ TẾT ĐINH DẬU 2017',
        'shortContent' => 'Chương trình Đi chung Xe về quê ăn Tết Đinh Dậu 2017 của DichungTaxi mang đến cho bạn hành trình như ý.',
    ],
    3 => [
        'name'         => 'ti4',
        'category'     => 'TIỆN ÍCH HAY',
        'title'        => '[MỚI NHẤT] TỔNG HỢP BẢNG GIÁ CƯỚC TAXI 2020',
        'shortContent' => 'Bảng giá cước taxi của các hãng taxi lớn như Taxi Mai Linh, Taxi VinaSun, Taxi Group Hà Nội, Taxi Ba Sao, Taxi Thành Công, Taxi Sông Nhuệ,...',
    ],
    4 => [
        'name'         => 'ti5',
        'category'     => 'TIỆN ÍCH HAY',
        'title'        => 'SỐ ĐIỆN THOẠI CÁC HÃNG TAXI GIÁ RẺ HÀ NỘI 2019',
        'shortContent' => 'Danh bạ taxi, số điện thoại taxi các hãng taxi giá rẻ trên khu vực Hà Nội cập nhật 01/2019. Đặt taxi giá rẻ của DiChungTaxi.com',
    ],
    5 => [
        'name'         => 'ti6',
        'category'     => 'TIỆN ÍCH HAY',
        'title'        => 'NHỮNG MẪU CÂU TIẾNG ANH GIAO TIẾP CƠ BẢN KHI ĐI MÁY BAY',
        'shortContent' => 'Cẩm nang bỏ túi “những mẫu câu tiếng anh giao tiếp cơ bản khi đi máy bay”, du khách có thể chuẩn bị dễ dàng hơn.',
    ],
    6 => [
        'name'         => 'cn1',
        'category'     => 'CẨM NANG DU LỊCH',
        'title'        => 'BẢN ĐỒ ĐÀ NẴNG - BẢN ĐỒ DU LỊCH ĐÀ NẴNG 2019',
        'shortContent' => 'Bản đồ Đà Nẵng, Bản đồ Du lịch Đà Nẵng, Bản đồ tp Đà Nẵng, Map Đà Nẵng, Bản đồ thành phố Đà Nẵng update mới nhất 2019.',
    ],
    7 => [
        'name'         => 'cn2',
        'category'     => 'CẨM NANG DU LỊCH',
        'title'        => 'ĐƯA NHAU ĐI TRỐN VỚI 4 ĐỊA ĐIỂM DU LỊCH GIÁ RẺ GẦN HÀ NỘI',
        'shortContent' => 'Với 4 địa điểm du lịch gần Hà Nội, bạn chẳng cần phải đắn đo mà có thể lên đường ngay, phù hợp với những ngày nghỉ cuối tuần.',
    ],
    8 => [
        'name'         => 'cn3',
        'category'     => 'CẨM NANG DU LỊCH',
        'title'        => 'TOP 10 NGÔI CHÙA NỔI TIẾNG NHẤT MIỀN BẮC NÊN ĐI LỄ ĐẦU NĂM 2020',
        'shortContent' => 'Đi Chung Taxi giới thiêu cho bạn top 10 ngôi chùa nổi tiếng hàng đầu miền Bắc nhất định phải đi lễ đầu năm.',
    ],
    9 => [
        'name'         => 'cn4',
        'category'     => 'CẨM NANG DU LỊCH',
        'title'        => 'TAXI HẢI PHÒNG - SỐ ĐIỆN THOẠI TAXI HẢI PHÒNG GIÁ RẺ',
        'shortContent' => 'Taxi Hải Phòng uy tín-giá rẻ. Khi bạn sử dụng taxi Mai Linh Hải Phòng khi đi chung bạn sẽ chủ động đặt xe trước.',
    ],
    10 => [
        'name'         => 'cn5',
        'category'     => 'CẨM NANG DU LỊCH',
        'title'        => 'SỐ ĐIỆN THOẠI TAXI VINH NGHỆ AN GIÁ RẺ 2019',
        'shortContent' => 'Thông tin ngắn gọn – chính xác về giá , số điện thoại taxi Vinh Nghệ An mới nhất 2018. Tìm hiểu ngay!',
    ],
    11 => [
        'name'         => 'cn6',
        'category'     => 'CẨM NANG DU LỊCH',
        'title'        => '5 CÁCH DI CHUYỀN TỪ HÀ NỘI ĐI SAPA',
        'shortContent' => '5 cách di chuyển từ Hà Nội đi Sapa bao gồm: xe máy, xe limousine, tàu hỏa, xe khách, xe taxi 4,7 chỗ.',
    ],
    
];
// Tạo mảng có điều kiện lọc là tiện ích
$mang2 = [];  
for($i=0;$i<count($newsList);$i++){
    if($newsList[$i]['category']=='TIỆN ÍCH HAY'){
        array_push($mang2,$newsList[$i]);
    };
};
// Tạo mảng có điều kiện lọc là cẩm nang du lịch
$mang3 = [];  
for($i=0;$i<count($newsList);$i++){
    if($newsList[$i]['category']=='CẨM NANG DU LỊCH'){
        array_push($mang3,$newsList[$i]);
    };
};

echo $twig->render( 'frontend/pages/cam-nang-di-lai.html.twig', [
    'newsList' => $newsList,
    'mang2' => $mang2,
    'mang3' => $mang3
    ] );
