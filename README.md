<h2> Instalasi: </h2>
1. Pastikan Anda telah menginstal Laravel dan mengatur lingkungan pengembangan lokal seperti server web dan database (mysql) <br/>
2. Buka terminal atau command prompt di direktori proyek yang telah di-clone. <br/>
3. Jalankan perintah "composer install" untuk menginstal semua dependensi yang diperlukan oleh proyek Laravel. <br/>
4. Salin file .env.example menjadi .env dengan perintah cp .env.example .env (untuk sistem Unix/Linux) atau copy .env.example .env (untuk Windows). <br/>
5. Buatlah kunci aplikasi baru dengan menjalankan perintah "php artisan key:generate". <br/>
6. Konfigurasikan file .env sesuai dengan pengaturan lingkungan pengembangan Anda, seperti pengaturan database dan konfigurasi lainnya. <br/>
7. Jalankan migrasi database dengan perintah "php artisan migrate" untuk membuat tabel yang diperlukan di database. <br/>
8. Jalankan "php artisan serve" untuk menjalankan live server lokal <br/>
