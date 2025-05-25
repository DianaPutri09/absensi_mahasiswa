<?php
include "db.php";

$username = $_POST['username'];
$password = $_POST['password'];
$retype_password = $_POST['retype_password'];

if ($password !== $retype_password) {
    echo "<script>
        alert('Password dan retype password tidak cocok!');
        window.location.href = 'register.php';
    </script>";
    exit;
}

// Hash password sebelum simpan
$hashed = password_hash($password, PASSWORD_DEFAULT);

// Simpan ke database (tanpa kolom role)
$sql = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$sql->bind_param("ss", $username, $hashed);

if ($sql->execute()) {
    echo "<script>
        alert('Registrasi berhasil! Silakan login.');
        window.location.href = 'login.php';
    </script>";
} else {
    echo "<script>
        alert('Registrasi gagal: " . $conn->error . "');
        window.location.href = 'register.php';
    </script>";
}
?>
