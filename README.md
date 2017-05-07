# CI Installer

GUI Installer untuk CodeIgniter

## Contoh penempatan folder

- codeigniter
  - application
  - system
  - install
    - class
    - config
    - index.php

## Cara menggunakan

- Buat folder install di folder root web anda
- Download dan copy semua ke folder install (bisa dilihat pada contoh penempatan folder)
- Buka file config/config.php pada folder install dan atur sesuai keinginan

```php
// Pengaturan letak folder application
$config['application'] = '';

// Pengaturan letak file database yang akan diinstal
$config['db_file'] = '';
```

- Buka file default codeigniter config.php dan database.php dan ganti menjadi seperti ini

> Pada file config.php

```php
$config['base_url'] = '%BASE_URL%';
```

> Pada file database.php

```php
$db['default'] = array(
	...
	'hostname' => '%HOSTNAME%',
	'username' => '%USERNAME%',
	'password' => '%PASSWORD%',
	'database' => '%DATABASE%',
	...
);
```

> Sesuaikan sama yang ada di file config/config.php folder install

```php
// Pengaturan nama yang akan diganti
$config['base_url'] = '%BASE_URL%';
$config['hostname'] = '%HOSTNAME%';
$config['username'] = '%USERNAME%';
$config['password'] = '%PASSWORD%';
$config['database'] = '%DATABASE%';
```

- Setelah semuanya selesai, akses ke http://domain.com/install
