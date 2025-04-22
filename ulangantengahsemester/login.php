<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Login gagal. Coba lagi.";
    }
}
?>

<!DOCTYPE html>
<head>
    <title>Login</title>
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(42, 82, 152, 0.8)), url('assets/background.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins';
            margin: 0;
            padding: 0;
            height: 100vh;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container-box {
            display: flex;
            width: 900px;
            height: 500px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
            background-color: #fff;
        }

        .login-form {
            flex: 1;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form h2 {
            color: #1e3c72;
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 24px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #1e3c72;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #2a5298;
        }

        .info-panel {
            flex: 1;
            background: linear-gradient(to right, #1e3c72, #2a5298);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px;
            text-align: center;
        }

        .info-panel h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .info-panel p {
            font-size: 16px;
            line-height: 1.6;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }

        @media (max-width: 768px) {
            .container-box {
                flex-direction: column;
                height: auto;
                width: 90%;
            }

            .login-form, .info-panel {
                padding: 30px;
            }

            .info-panel {
                border-top: 1px solid rgba(255,255,255,0.2);
            }
        }
    </style>
</head>
<body>

    <div class="container-box">
        <div class="login-form">
            <h2>Login</h2>
            <?php if (isset($error)) : ?>
                <div class="error-message"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <button type="submit" class="btn-primary">Login</button>
            </form>
        </div>

        <div class="info-panel">
            <h2>Halo!</h2>
            <p>Selamat datang di sistem peminjaman alat olahraga sekolah.<br>Silakan login menggunakan akun Anda untuk mulai meminjam alat olahraga seperti bola voli, bola kaki, dan lain sebagainya.</p>
            <p><strong>Peraturan Peminjaman:</strong><br>
                1. Peminjaman hanya bisa dilakukan oleh siswa yang terdaftar.<br>
                2. Barang harus dikembalikan maksimal 1 hari setelah dipinjam.<br>
                3. Kerusakan atau kehilangan alat menjadi tanggung jawab peminjam.<br>
                4. Cek ketersediaan stok sebelum meminjam.</p>
        </div>
    </div>

</body>
</html>
