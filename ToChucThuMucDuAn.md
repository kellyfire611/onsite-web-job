# Tổ chức Thư mục Dự án

```
onsite-web-job
|   bootstrap.php
|   config.php
|   dbconnect.php
|   index.php
|   Paginator.php
|   README.md
|   server.php
|   start-server-dev.bat
|   StaticData.php
|   ThuMucDuAn.txt
|   
+---.auto-deploy
|       auto-pull-github.php
|       
+---assets
|   +---backend
|   |   +---css
|   |   |       style-print.css
|   |   |       style.css
|   |   |       
|   |   \---js
|   |           app.js
|   |           
|   +---frontend
|   |   +---css
|   |   |       style.css
|   |   |       
|   |   +---img
|   |   |       icon-1.png
|   |   |       icon-2.png
|   |   |       icon-3.png
|   |   |       marketing-1.png
|   |   |       marketing-2.png
|   |   |       slider-1.jpg
|   |   |       slider-2.jpg
|   |   |       slider-3.jpg
|   |   |       
|   |   \---js
|   |           app.js
|   |           
|   +---img
|   |   \---hoa
|   +---shared
|   |   \---img
|   |           default-image_600.png
|   |           logo-nentang.jpg
|   |           no-avatar.png
|   |           
|   +---uploads
|   |   |   .gitignore
|   |   |   
|   |   +---customers
|   |   |   \---avatars
|   |   |           kellyfire_20200217161335.jpg
|   |   |           
|   |   +---products
|   |   |       
|   |   \---templates
|   |           
|   \---vendor
|       +---bootstrap
|       +---Chart.js
|       +---feather
|       +---flatpickr
|       +---font-awesome
|       +---jquery
|       +---jquery-validation
|       +---paper-css
|       +---popperjs
|       \---slick
| 
+---backend
|   +---pages
|   |       dashboard.php
|   |       
|   \---shop_suppliers
|           create.php
|           delete.php
|           edit.php
|           index.php
|           
+---db
+---frontend
|   +---auth
|   |       dang-ky.php
|   |       dang-nhap.php
|   |       
|   \---pages
|           bao-chi.php
|           boi-thuong.php
|           chinh-sach-van-tai.php
|           huong-dan-su-dung.php
|           lien-he.php
|           trang-chu.php
|           tuyen-dung.php
|           Van-chuyen.php
|           ve-chung-toi.php
|           
\---templates
    +---backend
    |   +---errors
    |   |       401.html.twig
    |   |       403.html.twig
    |   |       404.html.twig
    |   |       
    |   +---layouts
    |   |   |   layout-fullpage.html.twig
    |   |   |   layout-print.html.twig
    |   |   |   layout.html.twig
    |   |   |   
    |   |   \---includes
    |   |           footer.html.twig
    |   |           header.html.twig
    |   |           sidebar.html.twig
    |   |           
    |   \---pages
    |           dashboard.html.twig
    |           
    +---compilation_cache
    |       .gitignore
    |       
    +---frontend
    |   +---errors
    |   |       401.html.twig
    |   |       403.html.twig
    |   |       404.html.twig
    |   |       
    |   +---layouts
    |   |   |   layout.html.twig
    |   |   |   
    |   |   \---includes
    |   |           footer.html.twig
    |   |           header.html.twig
    |   |           
    |   \---pages
    \---shared
        \---pagination
                index.html.twig
                
```