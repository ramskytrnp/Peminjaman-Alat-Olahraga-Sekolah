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

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['edit_user'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "UPDATE users SET username='$username', password='$password' WHERE id=$id";
    mysqli_query($conn, $query);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <style>
        body {
            margin: 0;
            font-family: 'Poppins';
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

        .btn-edit {
            background-color: #2980b9;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-edit:hover {
            background-color: #3498db;
        }

        .section {
            display: none;
        }

        .section.active {
            display: block;
        }

        /* Modal styling */
        #editModal {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
        }

        #editModal .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            color: #1e3c72;
        }

        #editModal input {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        #editModal button {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
        }
    </style>
    <script>
        function showSection(id) {
            document.querySelectorAll('.section').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(id).classList.add('active');
        }

        function openEditModal(id, username) {
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-username').value = username;
            document.getElementById('editModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
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
                    <?php
                    mysqli_data_seek($user_result, 0); 
                    while($user = mysqli_fetch_assoc($user_result)): ?>
                        <tr>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <td>
                                <button class="btn-hapus" onclick="return confirm('Hapus user ini?')">Hapus</button>
                                |
                                <button class="btn-edit" onclick="openEditModal('<?= $user['id'] ?>', '<?= $user['username'] ?>')">Edit</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="editModal">
        <div class="modal-content">
            <h3>Edit User</h3>
            <form method="POST">
                <input type="hidden" name="id" id="edit-id">
                <input type="text" name="username" id="edit-username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password Baru" required>
                <button type="submit" name="edit_user" style="background-color:#1e3c72; color:white;">Simpan</button>
                <button type="button" onclick="closeModal()">Batal</button>
            </form>
        </div>
    </div>
</body>
</html>
