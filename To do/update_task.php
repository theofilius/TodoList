<?php
// Mulai sesi untuk mengidentifikasi pengguna yang login
session_start();
$user_id = $_SESSION['user_id']; // Dapatkan user_id pengguna yang login

// Ambil ID tugas dari formulir
$id = $_POST['id'];

$conn = new mysqli('localhost', 'root', '', 'task_tracker');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Perbarui status tugas tanpa memeriksa izin pengguna
$new_status = $_POST['new_status'];

$sql = "UPDATE tasks SET status = '$new_status' WHERE id = $id";
$conn->query($sql);

header("Location: index.php"); // Redirect kembali ke halaman tugas setelah pembaruan

$conn->close();
?>
