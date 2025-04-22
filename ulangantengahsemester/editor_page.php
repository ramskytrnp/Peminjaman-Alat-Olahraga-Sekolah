<?php
session_start();
if ($_SESSION['role'] !== 'editor') {
    header("Location: login.php");
    exit;
}

$stok = [
    ['nama' => 'Bola Voli', 'jumlah' => 5, 'gambar' => 'assets/voli.png'],
    ['nama' => 'Bola Kaki', 'jumlah' => 7, 'gambar' => 'assets/sepakbola.png'],
    ['nama' => 'Bola Basket', 'jumlah' => 4, 'gambar' => 'assets/basket.png'],
    ['nama' => 'Bola Kasti', 'jumlah' => 11, 'gambar' => 'assets/bolakasti.png'],
    ['nama' => 'Cones', 'jumlah' => 56, 'gambar' => 'assets/cones.png'],
    ['nama' => 'Matras', 'jumlah' => 24, 'gambar' => 'assets/matras.png'],
    ['nama' => 'Raket Badminton', 'jumlah' => 16, 'gambar' => 'assets/raket.png'],
    ['nama' => 'Stik dan Bola Tenis Meja', 'jumlah' => 6, 'gambar' => 'assets/stikbolatenismeja.png'],
    ['nama' => 'Stik Kasti', 'jumlah' => 2, 'gambar' => 'assets/stikkasti.png']
];
?>

<!DOCTYPE html>
<head>
    <title>Petugas</title>
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            font-family: 'Poppins';
            padding: 40px;
            color: white;
            margin: 0;
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
        }

        h4 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: normal;
        }

        table {
            width: 100%;
            background-color: white;
            color: #1e3c72;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            margin: 0 auto;
            max-width: 1000px;
        }

        table thead {
            background-color: #e3e3e3;
        }

        table th, table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        .btn-update {
            background-color: #1e3c72;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
            font-size: 16px;
        }

        .btn-update:hover {
            background-color: #2a5298;
        }

        img {
            width: 80px;
            height: 60px;
            object-fit: contain;
        }

        .back-link {
            display: block;
            width: fit-content;
            margin: 30px auto 0;
            padding: 10px 20px;
            background-color: #1e3c72;
            color: white;
            border-radius: 10px;
            text-decoration: none;
            text-align: center;
        }

        .back-link:hover {
            background-color: #2a5298;
        }
    </style>
</head>
<body>
    <h1>Halo, <?= $_SESSION['username'] ?></h1>
    <h4>Kelola Stok Alat Olahraga</h4>

    <table>
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama Barang</th>
                <th>Stok Sekarang</th>
                <th>Tambah</th>
                <th>Kurangi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stok as $item): ?>
                <tr>
                    <td><img src="<?= $item['gambar'] ?>" alt="<?= $item['nama'] ?>"></td>
                    <td><?= $item['nama'] ?></td>
                    <td><?= $item['jumlah'] ?></td>
                    <td><button class="btn-update">+</button></td>
                    <td><button class="btn-update">-</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a class="back-link" href="dashboard.php">Kembali ke Dashboard</a>
</body>
</html>
