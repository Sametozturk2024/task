Kurulum Talimatları<br>
Projeyi klonlayın: git clone https://github.com/Sametozturk2024/task.git<br>
cd task <br>
.env dosyasını ayarlayın:<br>
.env.example dosyasını kopyalayıp .env olarak adlandırın.<br>
Bağımlılıkları yükleyin:<br>
composer install<br>
npm install<br>
npm run dev<br>
Veritabanı işlemlerini gerçekleştirin:<br>
php artisan migrate<br>
php artisan db:seed --class=UsersTableSeeder<br>
Projeyi başlatın:
php artisan serve <br>
Admin Giriş Bilgileri<br>
Email: admin@admin.com
<br>
Şifre: admin
