# E-Commerce
## <p style="color:green">CÀI ĐẶT PROJECT </p>
https://getcomposer.org/download/
### Cách Cài Đặt Composer:
Link hướng dẫn :https://hocwebchuan.com/tutorial/laravel/install_composer.php
#### Kiểm tra bằng câu lệnh :
composer -v
### Cài Laravel Debug Bar : 
https://github.com/barryvdh/laravel-debugbar <br>
Dùng câu lệnh: composer require barryvdh/laravel-debugbar --dev

## MÔ TẢ PROJECT
- Mỗi lần edit .evn nên:  composer dump-autoload <br>

## VỀ MIGRATION
#### Chúng ta cần quan tâm là 2 function up() và down():

public function up() dùng để thêm, bớt, thay đổi, ... nội dung bảng cơ sở dữ liệu - để thực thi ta cần sử dụng lệnh php artisan migrate
public function down() dùng phục hồi hay xóa bảng, ... - để thực thi ta cần sử dụng lệnh php artisan migrate:rollback
- cấu hình xong ta chạy php artisan migrate để build database cho toàn bộ các file trong database/migrations/<br>
#### Để Xoá Table: <br>
1. trong function down(){ Schema::dropIfExists('table xoá');}<br>
2. Dùng php artisan migrate:rollback để chạy down<br>
3. Dùng php artisan migrate:refresh để chạy xoá xong chạy tạo db . ta có thể hiểu<br> => php artisan migrate:refresh = php artisan migrate:rollback + php artisan migrate.<br>
#### Các table có sẵn (default)
Lúc này đã có 4 bảng được tạo trong Database myproject:<br>
migrations: chứa dữ liệu của Migration, lưu trữ thông tin các bảng dữ liệu được tạo trong Migration.<br>
password_resets: bảng reset password có sẵn trong thư mục /database/migrations/, đây là table tồn tại sẵn của Laravel<br>
users: bảng user có sẵn trong thư mục /database/migrations/, đây là table tồn tại sẵn của Laravel<br>

### Cách Xoá 1 db có sẵn:
php artisan migrate:rollback --path=/database/migrations/your-specific-migration.php<br>
Trong đó: your-specific-migration.php là file (table) cần DROP.<br>
####       php artisan make:model --migration  images
###         php artisan db:seed --class=user

### Tạo Data Tự Đông Cho Databases
Sử dụng factories:<br>
1.https://onlinewebtutorblog.com/seeder-with-faker-library-concept-in-laravel-8/



### VNPAY
USER: minhtrung4367@gmail.com<br>
PASS: Minhtrung0110
#### Acc Test: 
NCB -
9704198526191432198 -
NGUYEN VAN A -
07/15 -
123456-


### tạo liên kết storage cho ảnh khi admin thêm uploads file mỗi khi clone project mới về
trường hợp khi ảnh upload lên nhưng k thấy hiện ra view thì cách fix như sau
trong thư mục public xóa thư mục storage (nếu có).
sau khi xóa chạy câu lệnh "php artisan storage:link" nếu hiện thông báo đã liên kết thành thì đã fix xong

#### Date parsing
date ('d-m-Y', strtotime($staff->end_date)) 