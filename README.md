saat awal deploy ke ubuntu server, jalankan command2 berikut :

php artisan user:create-admin

chmod -R 775 storage
chmod -R 775 bootstrap/cache

php artisan storage:link