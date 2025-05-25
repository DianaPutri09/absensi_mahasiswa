<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include "db.php";

$tanggal = date("Y-m-d");
$hari = date("l");

// Ambil data absensi
$result = $conn->query("SELECT * FROM absensi ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Absensi Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #60B5FF;
        }
        .card {
            border-radius: 2rem;
        }
        .table thead {
            background-color: #FF9149;
            color: white;
        }
        .btn-success {
            border-radius: 0.5rem;
        }
        .btn-danger {
            border-radius: 0.5rem;
        }
        .card-body{
            background-color: #AFDDFF;
            border-radius: 20px;
        }
    </style>
</head>
<body class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Form Absensi Mahasiswa</h2>
        <p class="text-muted"><strong>Tanggal:</strong> <?= $tanggal ?> (<?= $hari ?>)</p>
    </div>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ Terima kasih, data sudah berhasil disimpan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-5">
        <div class="card-body">
            <form action="simpan_absensi.php" method="POST">
                <input type="hidden" name="tanggal" value="<?= $tanggal ?>">
                <input type="hidden" name="hari" value="<?= $hari ?>">

                <div class="mb-3">
                    <label class="form-label">NIM</label>
                    <input type="text" name="nim" class="form-control" required maxlength="20" pattern="\d+" title="NIM harus angka">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Mahasiswa</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mata Kuliah</label>
                    <select name="matkul" class="form-select" required>
                        <option value="">-- Pilih Mata Kuliah --</option>
                        <option>Interaksi Manusia Komputer</option>
                        <option>Pemrograman Framework</option>
                        <option>Pengembangan Aplikasi Web</option>
                        <option>Kewarganegaraan</option>
                        <option>Sistem Cerdas</option>
                        <option>Analisis dan Desain Perangkat Lunak</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Kehadiran</label>
                    <select name="status" class="form-select" required>
                        <option value="Hadir">Hadir</option>
                        <option value="Izin">Izin</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Alpha">Alpha</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success px-4">Simpan</button>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </form>
        </div>
    </div><h4 class="mb-3">📋 Data Absensi Terbaru</h4>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped align-middle text-center shadow-sm" style="background-color: #ffffff;">
        <thead class="table-primary">
            <tr>
                <th class="text-nowrap">No</th>
                <th class="text-nowrap">NIM</th>
                <th class="text-nowrap">Nama</th>
                <th class="text-nowrap">Mata Kuliah</th>
                <th class="text-nowrap">Status</th>
                <th class="text-nowrap">Tanggal</th>
                <th class="text-nowrap">Hari</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = $result->fetch_assoc()):
            ?>
            <tr style="border-bottom: 2px solid #dee2e6;">
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nim']) ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['matkul']) ?></td>
                <td>
                    <?php
                        $status = htmlspecialchars($row['status']);
                        $badgeColor = match($status) {
                            'Hadir' => 'success',
                            'Izin' => 'primary',
                            'Sakit' => 'warning',
                            'Alpha' => 'danger',
                            default => 'secondary'
                        };
                    ?>
                    <span class="badge bg-<?= $badgeColor ?>"><?= $status ?></span>
                </td>
                <td><?= htmlspecialchars($row['tanggal']) ?></td>
                <td><?= htmlspecialchars($row['hari']) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
