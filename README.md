# RajaOngkir API wrapper for PHP 8.0+
[![Latest Version](https://img.shields.io/github/v/release/dipantry/rajaongkir?label=Release&sort=semver)](https://github.com/dipantry/rajaongkir/releases)
[![Packagist Version](https://img.shields.io/packagist/v/dipantry/rajaongkir?label=Packagist)](https://packagist.org/packages/dipantry/rajaongkir)
![PHP Version](https://img.shileds.io/packagist/php-v/dipantry/rajaongkir?label=PHP)
[![MIT Licensed](https://img.shields.io/github/license/dipantry/rajaongkir?label=License&style=flat-square)](LICENSE)

Package Laravel atau Lumen yang menyimpan data provinsi, kota, kecamatan, dan negara yang terdaftar pada website [RajaOngkir](https://rajaongkir.com/). Package ini akan membantu Anda untuk mengambil informasi dari API RajaOngkir.

### Fitur
- [x] Data provinsi, kota, kecamatan, dan negara disimpan dalam database lokal anda.
- [x] Seeding data lokasi berdasarkan Api Key dan tipe akun yang terdaftar pada RajaOngkir
- [x] Mengambil biaya pengiriman (ongkir) untuk pengiriman lokal
- [x] Mengambil biaya pengiriman (ongkir) untuk pengiriman internasional
- [ ] Mengambil nilai tukar rupiah terhadap US dollar
- [ ] Mengambil atau melacak startus pengiriman berdasarkan nomor resi
- [x] Memasang exception khusus apabila terjadi kesalahan pada API RajaOngkir

### Support pada tipe akun
- [x] Starter
- [ ] Basic*
- [x] Pro

*Hingga package ini dibuat, akun basic sudah ditiadakan oleh RajaOngkir. (Informasi dari Raja Ongkir Support)

---
# Instalasi
```sh
composer require dipantry/rajaongkir
```

## Daftarkan Service Provider dan Facade untuk Lumen
Dalam file `bootstrap/app.php`, uncomment baris berikut
```php
$app->withFacades();
$app->withEloquent();
```
dan daftarkan service provider dan alias/facade dengan menambahkan kode berikut
```php
$app->register(Dipantry\Rajaongkir\ServiceProvider::class);

// class_aliases
class_alias(Dipantry\Rajaongkir\Facade::class, 'Rajaongkir');
```

## Konfigurasi
```sh
php artisan vendor:publish --provider="Dipantry\Rajaongkir\ServiceProvider"
```

File konfigurasi terletak pada `config/rajaongkir.php`
```php
return [
    'api_key' => 'Masukkan API Key Anda',
    'package' => 'Masukkan Tipe Akun Anda (Basic, Starter, Pro)',
    'table_prefix' => 'Untuk migrasi dan seeding data'
]
```

### Jalankan migrasi
```sh
php artisan migrate
```

### Jalankan seeder untuk mengisi data provinsi, kota, kecamatan, dan negara
```sh
php artisan rajaongkir:seed
```

---
# Cara menggunakan
Untuk mengambil data provinsi, kota, kecamatan, dan negara dapat menggunakan model yang sudah disediakan

```php
use Dipantry\Rajaongkir\Models\ROProvince;
use Dipantry\Rajaongkir\Models\ROCity;
use Dipantry\Rajaongkir\Models\ROSubDistrict;
use Dipantry\Rajaongkir\Models\ROCountry;

ROProvince::all();
ROCity::all();
ROSubDistrict::all();
ROCountry::all();
```

---


### Exception
Setiap kali sistem melakukan request ke API Raja Ongkir, jika terjadi kesalahan, maka sistem akan mengembalikan `APIResponseException` dengan pesan kesalahan yang diberikan oleh Raja Ongkir. Jika request berhasil, maka sistem akan mengembalikan hasil request yang diberikan oleh Raja Ongkir.
`APIResponseException` memiliki 2 informasi yaitu `code` dan `message`

#### Error Code
- <b>400 Bad Request</b><br>
Kode ini biasanya dikirim dari API Raja Ongkir apabila terjadi kesalahan pada request, baik kesalahan pada parameter, HTTP Method, hingga API Key yang tidak valid.
- <b>500 Internal Server Error</b><br>
Kode ini di generate otomatis oleh package ini ketika terjadi kesalahan pada server atau server tidak mengembalikan response yang valid.

---
# Testing
Jalankan testing dengan menjalankan perintah berikut ini
```sh
vendor/bin/phpunit
```