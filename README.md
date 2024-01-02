1. clone repository dari github.

2. jalankan perintah :

    ```
    composer install
    ```

3. Duplikat file `.env.example` kemudian ubah namanya menjadi `.env`.

4. jalankan perintah :

    ```
    php artisan key:generate
    ```

5. buat database dengan nama : `sport_venue_rental`.

6. Ubah konfigurasi database pada file `.env`
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=sport_venue_rental
    DB_USERNAME=root
    DB_PASSWORD=
    ```
7. jalankan perintah :
    ```
    php artisan migrate:fresh --seed
    ```
8. jalankan perintah :
    ```
    npm install
    ```
9. jalankan perintah :

    ```
    php artisan serve
    ```

    / pakai valet bila ada

10. buka browser `http://127.0.0.1:8000`

11. masuk admin dengan :

    ```
    Username : admin001@gmail.com
    Password : test123