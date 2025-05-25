<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #60B5FF;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .card {
            background-color: #AFDDFF;
            width: 100%;
            max-width: 400px;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .card-title {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="card p-4">
    <h2 class="card-title text-center mb-4">Login Mahasiswa</h2>
    <form action="proses_login.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" id="username" name="username" required class="form-control">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" id="password" name="password" required class="form-control">
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="register.php" class="btn btn-outline-secondary">Belum punya akun?</a>
        </div>
    </form>
</div>

</body>
</html>
