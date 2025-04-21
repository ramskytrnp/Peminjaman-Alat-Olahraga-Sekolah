<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';
$user_result = mysqli_query($conn, "SELECT * FROM users");
$peminjaman = [
    ['nama' => 'Andi', 'barang' => 'Bola Voli', 'status' => 'Dipinjam'],
    ['nama' => 'Budi', 'barang' => 'Bola Basket', 'status' => 'Dikembalikan'],
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #f4f4f4;
            min-height: 100vh;
            padding-top: 20px;
            position: fixed;
            box-shadow: 2px 0 8px rgba(0,0,0,0.1);
        }

        .sidebar h2 {
            color: #1e3c72;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 15px 20px;
            color: #1e3c72;
            text-decoration: none;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background-color: #ddd;
        }

        .main-content {
            margin-left: 250px;
            padding: 40px;
            width: 100%;
        }

        table {
            width: 100%;
            background-color: white;
            color: #1e3c72;
            border-radius: 10px;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table th, table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #e6e6e6;
        }

        .btn-hapus {
            background-color: #c0392b;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-hapus:hover {
            background-color: #e74c3c;
        }

        .section {
            display: none;
        }

        .section.active {
            display: block;
        }
    </style>
    <script>
        function showSection(id) {
            document.querySelectorAll('.section').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(id).classList.add('active');
        }
    </script>
</head>
<body>
    <div class="sidebar">
        <h2>Halo, Admin!</h2>
        <a href="#" onclick="showSection('peminjaman')">Data Peminjaman</a>
        <a href="#" onclick="showSection('kelolauser')">Kelola User</a>
        <a href="dashboard.php">Kembali ke Dashboard</a>
    </div>

    <div class="main-content">
        <div id="peminjaman" class="section active">
            <h4>Data Peminjaman</h4>
            <table>
                <thead>
                    <tr>
                        <th>Nama Pengguna</th>
                        <th>Barang</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($peminjaman as $pinjam): ?>
                        <tr>
                            <td><?= $pinjam['nama'] ?></td>
                            <td><?= $pinjam['barang'] ?></td>
                            <td><?= $pinjam['status'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div id="kelolauser" class="section">
            <h4>Kelola User</h4>
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($user = mysqli_fetch_assoc($user_result)): ?>
                        <tr>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <td><button class="btn-hapus" onclick="return confirm('Hapus user ini?')">Hapus</button></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
