<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "db.php";

    $nim = trim($_POST['nim'] ?? '');
    $nama = trim($_POST['nama'] ?? '');
    $matkul = $_POST['matkul'] ?? '';
    $status = $_POST['status'] ?? '';
    $tanggal = $_POST['tanggal'] ?? '';
    $hari = $_POST['hari'] ?? '';

    // Cek apakah nim sudah ada di database
    $cek = $conn->prepare("SELECT id FROM absensi WHERE nim = ?");
    $cek->bind_param("s", $nim);
    $cek->execute();
    $cek->store_result();

    if ($cek->num_rows > 0) {
        // NIM sudah pernah dipakai, tampilkan error
        echo "<script>
                alert('NIM sudah terdaftar, tidak boleh duplikat.');
                window.history.back();
              </script>";
        exit;
    }

    // Simpan data
    $stmt = $conn->prepare("INSERT INTO absensi (nim, nama, matkul, status, tanggal, hari) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nim, $nama, $matkul, $status, $tanggal, $hari);
    $stmt->execute();

    header("Location: absensi.php?success=1");
    exit;
} else {
    echo "Akses tidak sah.";
}
?>