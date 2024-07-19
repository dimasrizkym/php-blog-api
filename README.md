# Blog API

Blog API adalah RESTful API sederhana untuk mengelola pengguna, berita, dan kategori pada aplikasi blog. API ini dibangun menggunakan PHP dan MySQL. Dibuat untuk memenuhi tugas kuliah.

## Struktur Proyek

```
blog-api/
├── config/
│   └── Database.php
├── controllers/
│   ├── UserController.php
│   ├── NewsController.php
│   └── CategoryController.php
├── models/
│   ├── User.php
│   ├── News.php
│   └── Category.php
├── routes/
│   └── api.php
├── index.php
└── .htaccess
```

## Persiapan

1. **Clone Repository**

    ```sh
    git clone https://github.com/dimasrizkym/php-blog-api.git
    ```

2. **Konfigurasi Database**

    Buat database MySQL baru dengan nama `blog_db`, dan sesuaikan pengaturan database pada file `config/Database.php`.

    ```php
    private $host = 'localhost';
    private $db_name = 'blog_db';
    private $username = 'root';
    private $password = '';
    ```

3. **Buat Tabel-tabel di Database**

    Buat tabel-tabel yang diperlukan di database `blog_db`.

    ```sql
    CREATE TABLE user (
        id_user INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL
    );

    CREATE TABLE kategori (
        id_kategori INT AUTO_INCREMENT PRIMARY KEY,
        nama_kategori VARCHAR(100) NOT NULL
    );

    CREATE TABLE news (
        id_news INT AUTO_INCREMENT PRIMARY KEY,
        penulis VARCHAR(50) NOT NULL,
        tgl_posting DATE NOT NULL,
        title VARCHAR(100) NOT NULL,
        text_berita TEXT NOT NULL,
        id_kategori INT,
        FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
    );
    ```

4. **Jalankan Server**

    Gunakan server lokal seperti Laragon atau XAMPP, dan arahkan root directory ke `php-blog-api`.

5. **Menyesuaikan Base URI**

    Sesuaikan base URI di file `index.php` dengan base URI yang sesuai dengan proyek Anda. Ganti `/blog-api/` dengan base URI yang sesuai.

    ```php
    $base_uri = '/blog-api/'; // Ubah sesuai dengan base URI
    ```

## Penggunaan API

### Pengguna

- **Buat Pengguna**

    ```
    POST /blog-api/user
    ```

    Data:

    ```json
    {
        "username": "example",
        "password": "password123"
    }
    ```

- **Baca Semua Pengguna**

    ```
    GET /blog-api/user
    ```

- **Baca Pengguna Berdasarkan ID**

    ```
    GET /blog-api/user/{id_user}
    ```

- **Perbarui Pengguna**

    ```
    PUT /blog-api/user
    ```

    Data:

    ```json
    {
        "id_user": 1,
        "username": "updated_example",
        "password": "newpassword123"
    }
    ```

- **Hapus Pengguna**

    ```
    DELETE /blog-api/user/{id_user}
    ```

### Berita

- **Buat Berita**

    ```
    POST /blog-api/news
    ```

    Data:

    ```json
    {
        "penulis": "author",
        "tgl_posting": "2023-07-18",
        "title": "News Title",
        "text_berita": "News content",
        "id_kategori": 1
    }
    ```

- **Baca Semua Berita**

    ```
    GET /blog-api/news
    ```

- **Baca Berita Berdasarkan ID**

    ```
    GET /blog-api/news/{id_news}
    ```

- **Perbarui Berita**

    ```
    PUT /blog-api/news
    ```

    Data:

    ```json
    {
        "id_news": 1,
        "penulis": "updated_author",
        "tgl_posting": "2023-07-19",
        "title": "Updated News Title",
        "text_berita": "Updated news content",
        "id_kategori": 2
    }
    ```

- **Hapus Berita**

    ```
    DELETE /blog-api/news/{id_news}
    ```

### Kategori

- **Buat Kategori**

    ```
    POST /blog-api/category
    ```

    Data:

    ```json
    {
        "nama_kategori": "category name"
    }
    ```

- **Baca Semua Kategori**

    ```
    GET /blog-api/category
    ```

- **Baca Kategori Berdasarkan ID**

    ```
    GET /blog-api/category/{id_kategori}
    ```

- **Perbarui Kategori**

    ```
    PUT /blog-api/category
    ```

    Data:

    ```json
    {
        "id_kategori": 1,
        "nama_kategori": "updated category name"
    }
    ```

- **Hapus Kategori**

    ```
    DELETE /blog-api/category/{id_kategori}
    ```

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

Selamat mencoba! Jika ada pertanyaan atau masalah, jangan ragu untuk menghubungi kami.
