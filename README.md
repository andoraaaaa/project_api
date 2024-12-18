# API Project | Streaming Film Sederhana Menggunakan API

Website ini adalah sebuah website layanan streaming film sederhana. Pada web ini terdapat database yang menyimpan data film-film. Selanjutnya, backend menyediakan API dalam bentuk API_KEY untuk dapat digunakan oleh frontend dalam membuat halaman website dan mengambil data dari database (data film-film)

## How to use
Anda bisa mendownload repo ini dan langsung jalankan setelah upload .sql ke phpmyadmin dan konfigurasi db.php di api/db.php sesuai dengan konfigurasi anda

```
git clone https://github.com/andoraaaaa/project_api.git project_api
```
* Upload movie_api.sql to phpmyadmin
* Configure db.php in api/db.php
```
$host = 'localhost';
$dbname = 'movie_api';
$username = 'root'; // Sesuaikan dengan konfigurasi MySQL Anda
$password = '';
```
* Run laragon/wampp/xampp server
* Go to 127.0.0.1/project_api

Jika anda menggunakan nama folder yang berbeda, harap konfigurasi api.php

```
$apiKey = '1234567890abcdef'; // Ganti dengan API key Anda
$apiUrl = "http://localhost/FOLDER_NAME/api/index.php?api_key=$apiKey";
```
^Ganti $apiUrl dengan alamat anda

### Use available API (Public API)
Atau anda bisa menggunakan API saja yang sudah di publish public.

* Gunakan endpoint untuk mendapatkan data film
```
API_KEY : 1234567890abcdef
GET http://andramaulana.my.id/api/api/index.php?api_key=YOUR_API_KEY
```
Response example :
```
    [
        {
            "id": 1,
            "title": "Movie 1",
            "description": "Description for movie 1",
            "release_year": 2023,
            "genre1": "Action",
            "genre2": "Action",
            "genre3": "Action",
            "views": 123123,
            "total_like": 123123,
            "total_dislike": 123123,
            "video_filename": "movie.mp4",
            "image_url": "https://example.com/image1.jpg",
        },
        ...
    ]
```
Example index.php :
```
<?php
$apiKey = '1234567890abcdef'; // Ganti dengan API key valid Anda
$apiUrl = "https://andramaulana.my.id/api/api/index.php?api_key=$apiKey";

// Ambil respons dari API
$response = file_get_contents($apiUrl);

// Cek jika respons valid
if ($response === false) {
    die("Error: Unable to fetch data from the API.");
}

// Decode JSON ke array
$data = json_decode($response, true);

if ($data === null) {
    die("Error: Failed to decode the JSON response.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menampilkan Data JSON</title>
</head>
<body>
    
    <h2>Response JSON:</h2>
    <pre><?php echo json_encode($data, JSON_PRETTY_PRINT); ?></pre>

</body>
</html>

```

