# Car_Rent

Aplikasi ini merupakan aplikasi laravel sederhana 
Berikut merupakan petunjuk intalasi aplikasi ini
1. Klon repository ini atau file aplikasi peminjaman_mobil ke penyimpanan lokal
2. pergi ke folder aplikasi dengan command cd di cmd atau terminal
3. masukan command 'composer install'
4. copy file .env.example ke file .env pada folder root
5. buka file .env lalu ganti database name (DB_DATABASE) menjadi 'peminjaman_mobil' lalu pastikan password kosong
6. jalankan perintah php artisan key:generate
7. jalankan perintah php artisan migrate:fresh
8. jalankan perintah php artisan serve
