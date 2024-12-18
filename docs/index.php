<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Dokumentasi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Dokumentasi API Streaming Film</h1>
    <p>Gunakan endpoint di bawah ini untuk mendapatkan data film:</p>
    <pre>
    GET http://yourdomain.com/api/index.php?api_key=YOUR_API_KEY
    </pre>

    <h2>Response Example:</h2>
    <pre>
    [
        {
            "id": 1,
            "title": "Movie 1",
            "description": "Description for movie 1",
            "release_year": 2023,
            "genre": "Action",
            "image_url": "https://example.com/image1.jpg"
        },
        ...
    ]
    </pre>
</body>
</html>
