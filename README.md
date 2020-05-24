# barcode-and-qrcode-scanner
This repository consists of barcode scanner, QRcode scanner, and barcode and QRcode generator that will generate automatically when data available. The data is added using excel
## Tools Used
- [Maatwebsite/Laravel-Excel](https://github.com/Maatwebsite/Laravel-Excel)
- [milon/barcode](https://github.com/milon/barcode)
- [SimpleSoftwareIO/simple-qrcode](https://github.com/SimpleSoftwareIO/simple-qrcode)
- [nimiq/qr-scanner](https://github.com/nimiq/qr-scanner)
- [serratus/quaggaJS](https://github.com/serratus/quaggaJS)

## Requirements
- PHP >= 7.1.3
- [php-gd](https://www.php.net/manual/en/image.installation.php) 
- laravel 5.8
## Instalation
- configuration
    ```bash
    git clone https://github.com/glayOne23/barcode-and-qrcode-scanner.git
    cd scanner
    composer install
    cp .env.example .env
    php artisan key:generate
    ```
- create database
- in .env, change database name, user, and password based on yours 
    ```
    DB_DATABASE= your_db_name
    DB_USERNAME= your_username
    DB_PASSWORD= your_username_password
    ```
- php artisan migrate
## Uses
- to add data :
    1. go to 127.0.0.1/members
    2. Add Data with Calc or Excel
    3. choose example.ods (this file available in scanner directory)


