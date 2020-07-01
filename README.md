$git clone https://github.com/hakkuns/skelton.git
$cd skelton
$composer install

--
- データベースの作成
- .envファイルの作成とデータベースの設定

--

$php artisan migrate --seed
$php artisan storage:link
$php artisan key:generate
$php artisan serve



