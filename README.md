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

### Use available API 
Atau anda bisa menggunakan API saja yang sudah di publish public.

* Gunakan endpoint untuk mendapatkan data film
```
API_KEY : 1234567890abcdef
GET http://andramaulana.my.id/api/index.php?api_key=YOUR_API_KEY
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
$apiKey = '1234567890abcdef';
$apiUrl = "http://andramaulana.my.id/api/index.php?api_key=$apiKey";

$response = file_get_contents($apiUrl);
$movies = json_decode($response, true);

<?php echo json_encode($data, JSON_PRETTY_PRINT); ?>
```

