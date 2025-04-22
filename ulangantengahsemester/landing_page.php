<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Sekolah</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: url('assets/background.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 30px;
        }

        .login-button {
            position: absolute;
            top: 30px;
            left: 30px;
            background-color: #1e3c72;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 16px;
            text-decoration: none;
            font-weight: bold;
        }

        .login-button:hover {
            background-color: #2a5298;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 15px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.9);
        }

        h2 {
            font-size: 28px;
            margin-bottom: 15px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.9);
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            max-width: 700px;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.4);
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 28px;
            }

            p {
                font-size: 16px;
            }

            .login-button {
                padding: 8px 16px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <a href="login.php" class="login-button">Login</a>
    <h1>SKY Boarding School</h1>
    <h2>Selamat datang di Website Peminjaman alat Olahrga Sekolah</h2>
</body>
</html>
