<?php
// Memulai sesi jika diperlukan
session_start();

// Menyertakan file konfigurasi dan autoload jika ada
require_once 'config/Database.php';

// Mengatur header untuk JSON
header("Content-Type: application/json; charset=UTF-8");

// Mengatur method request
$method = $_SERVER['REQUEST_METHOD'];

// Set Up Base URI 
$base_uri = '/blog-api/'; // Ubah sesuai dengan base URI
$uri = $_SERVER['REQUEST_URI'];
$endpoint = "";
$regex = '#^' . $base_uri . '(.*)$#';

// Regex untuk mencari endpoint yang diminta
if (preg_match($regex, $uri, $matches)) {
    // $matches[1]
    $endpoint = $matches[1];

    // hapus garis miring di belakang atau depan
    $endpoint = trim($endpoint, '/');
} 

if ($endpoint === '') {
    // URI match, return a 200 OK response
    http_response_code(200);
    echo json_encode(["message" => "Selamat datang di Blog API."]);
}

require_once './routes/api.php';
