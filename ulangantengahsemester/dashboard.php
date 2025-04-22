<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<head>
    <title>Dashboard</title>
    <style>
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

        .dashboard-box {
            background: #fff;
            color: #1e3c72;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 500px;
        }

        .dashboard-box h2 {
            margin-bottom: 15px;
            font-weight: bold;
        }

        .dashboard-box p {
            margin-bottom: 25px;
        }

        .dashboard-box a {
            display: block;
            margin: 10px 0;
            padding: 12px;
            background-color: #1e3c72;
            color: #fff;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .dashboard-box a:hover {
            background-color: #2a5298;
        }
    </style>
</head>
<body>

    <div class="dashboard-box">
        <h2>Selamat Datang, <?php echo $_SESSION['username']; ?>!</h2>
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="admin_page.php">Menu Admin</a>
        <?php elseif ($_SESSION['role'] === 'editor'): ?>
            <a href="editor_page.php">Menu Editor</a>
        <?php elseif ($_SESSION['role'] === 'user'): ?>
            <a href="user_page.php">Menu Siswa</a>
        <?php endif; ?>

        <a href="logout.php">Logout</a>
    </div>

</body>
</html>
