<?php
session_start();

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jadwal_kegiatan";  // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form login
$user = $_POST['username'];
$pass = $_POST['password'];

// Query untuk memeriksa user dan password
$sql = "SELECT * FROM admin WHERE username = '$user' AND password = '$pass'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Jika login berhasil, simpan informasi user ke session
    $_SESSION['username'] = $user;
    header("Location: admin.php"); // Redirect ke halaman dashboard
} else {
    // Jika login gagal, kembali ke halaman login dengan pesan error
    echo "Username atau Password salah";
}

$conn->close();
?>
