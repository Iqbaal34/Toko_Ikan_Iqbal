<?php
include 'koneksi.php';
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Toko Ikan Iqbal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="fish.php">Data Ikan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sales.php">Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="customers.php">Data Customer</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Data Customer - Toko Ikan Iqbal</title>
</head>
<body>
    <center>
        <img src="banner IKAN.jpg" height="200px" width="100%">
        <br>
        <h3>Data Customer</h3>
        <br>
        <form method="post" action="">
            <select name="urutan">
                <option>Urutkan Berdasarkan</option>
                <option value="customer_id_asc">ID (naik)</option>
                <option value="customer_id_desc">ID (turun)</option>
                <option value="name_asc">Nama (A - Z)</option>
                <option value="name_desc">Nama (Z - A)</option>
            </select>
            <input type="submit" name="tombol_urutan" value="Urutkan" class="btn btn-info btn-sm">
        </form>
        <br>
        <form method="post" action="">
            <input name="cari" placeholder="Cari nama..." class="form-control" style="width: 300px; display: inline;">
            <input type="submit" name="tombol_cari" value="Cari" class="btn btn-info btn-sm">
        </form>
        <br>
        <table class="table table-hover">
            <tr>
                <td>ID</td>
                <td>Nama</td>
                <td>Telepon</td>
                <td>Alamat</td>
            </tr>

            <?php
            $kueri = "SELECT * FROM customers";

            if (isset($_POST['tombol_cari'])) {
                $cari = $_POST['cari'];
                $kueri .= " WHERE name LIKE '%$cari%'";
            }

            if (isset($_POST['tombol_urutan'])) {
                $urutan = $_POST['urutan'];
                if ($urutan == 'customer_id_asc') {
                    $kueri .= " ORDER BY customer_id ASC";
                } elseif ($urutan == 'customer_id_desc') {
                    $kueri .= " ORDER BY customer_id DESC";
                } elseif ($urutan == 'name_asc') {
                    $kueri .= " ORDER BY name ASC";
                } elseif ($urutan == 'name_desc') {
                    $kueri .= " ORDER BY name DESC";
                }
            }

            $go = mysqli_query($koneksi, $kueri);
            while ($kolom = mysqli_fetch_array($go)) {
                echo '<tr>';
                echo '<td>' . $kolom['customer_id'] . '</td>';
                echo '<td>' . $kolom['name'] . '</td>';
                echo '<td>' . $kolom['phone'] . '</td>';
                echo '<td>' . $kolom['address'] . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
        <br>
        <a href="index.php" class="btn btn-primary">Kembali ke Halaman Utama</a>
    </center>
</body>
</html>
