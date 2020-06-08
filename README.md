# [https://onsite-web-job.nentang.vn](onsite-web-job.nentang.vn)
- Các bài học miễn phí về Lập trình
- Học web PHP - onsite-web-job PHP
- Xem nhiều hơn tại [https://nentang.vn](https://nentang.vn)

# Các chương trình cần thiết để lập trình web
- [Git for window](https://git-scm.com/download/win)
- XAMPP với PHP 7+, MySQL 5.6+ - [XAMPP](https://www.apachefriends.org/download.html)
- Composer - trình quản lý các gói package PHP - [Composer](https://getcomposer.org/download/)
- HeidiSQL - quản lý thực thi câu truy vấn SQL - [HeidiSQL](https://www.heidisql.com/download.php)
- Visual Studio Code IDE - trình gõ code - [Visual Studio Code](https://code.visualstudio.com/)
- TortoiseGIT - [TortoiseGIT](https://tortoisegit.org/download/)

# Cách clone source thiết lập dự án
## Step 1: clone source về máy
- Các bạn có thể clone source đặt bất cứ đâu trong máy các bạn. Tuy nhiên, muốn chạy được ở nơi khác ngoài `htdocs` thì các bạn phải cấu hình `virtual host` đối với `XAMPP hay WAMPP` nhé.
- Để đơn giản, các bạn nên clone source về thư mục `htdocs`
- Chạy câu lệnh
```
cd D:/dnpcuong/onsite-web-job.nentang.vn
git clone https://github.com/kellyfire611/onsite-web-job.nentang.vn.git
```

## Step 2: tạo tên miền ảo trên máy cục bộ (virtual host on localhost) bằng XAMPP
### 1. Thêm tên miền ảo cho XAMPP
- Hiệu chỉnh file `C:xampp/apache/conf/extra/httpd-vhosts.conf`
- Bổ sung thêm đoạn script sau vào cuối file:
```
<VirtualHost *:80>
    #Thay thế bằng email của Quản trị web của bạn
	  ServerAdmin webmaster@onsite-web-job
	
	  #Thay thế bằng đường dẫn đến source của bạn
    DocumentRoot "D:/dnpcuong/onsite-web-job.nentang.vn"
	
	  #Thay thế bằng tên trang web bạn mong muốn
    ServerName  onsite-web-job.local
	
	  #Thay thế bằng tên file log bạn mong muốn
    ErrorLog "logs/onsite-web-job-error.log"
    CustomLog "logs/onsite-web-job-access.log" common
	
	  #Thay thế bằng đường dẫn đến source của bạn
    <Directory "D:/dnpcuong/onsite-web-job.nentang.vn">
        Options FollowSymLinks
        AllowOverride All
        DirectoryIndex index.php
        Require all granted
    </Directory>
</VirtualHost>
```
### 2. Add host cho tên miền `onsite-web-jon.local`
- Lưu ý: để hiệu chỉnh file hệ thống, bạn cần quyền Administrator
- Hiệu chỉnh file `C:/Windows/System32/drivers/etc/hosts`
```
#Bổ sung địa chỉ IP ánh xạ với tên miền bạn mong muốn (Tương ứng với tên miền bạn đặt trong host ảo)
127.0.0.1		onsite-web-job.local
```

## Step 3: install các thư viện (package) cần thiết thông qua `composer`
- Trỏ đường dẫn vào thư mục `D:/dnpcuong/onsite-web-job.nentang.vn`, chạy câu lệnh sau để cài đặt
```
cd D:/dnpcuong/onsite-web-job.nentang.vn
composer install
```

## Step 3: thử nghiệm
- Start service Apache của XAMPP hay WAMPP
- Chạy đường dẫn sau để kiểm tra trên Local: [http://onsite-web-job.local/](http://onsite-web-job.local/)
- Chạy đường dẫn sau để kiểm tra trên môi trường Production: [http://onsite-web-job.nentang.vn/](http://onsite-web-job.nentang.vn/)