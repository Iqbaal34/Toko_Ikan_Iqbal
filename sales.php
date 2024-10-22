<?php
include 'koneksi.php';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Data Transaksi - Toko Ikan Iqbal</title>
</head>
<body>
    <center>
        <img src="banner IKAN.jpg" height="200px" width="100%">
        <br>
        <h3>Data Transaksi</h3>
        <br>
        <form method="post" action="">
            <select name="urutan">
                <option>Urutkan Berdasarkan</option>
                <option value="sale_id_asc">ID Transaksi (naik)</option>
                <option value="sale_id_desc">ID Transaksi (turun)</option>
                <option value="customer_asc">Nama Customer (A - Z)</option>
                <option value="customer_desc">Nama Customer (Z - A)</option>
            </select>
            <input type="submit" name="tombol_urutan" value="Urutkan" class="btn btn-info btn-sm">
        </form>
        <br>
        <form method="post" action="">
            <input name="cari" placeholder="Cari nama customer..." class="form-control" style="width: 300px; display: inline;">
            <input type="submit" name="tombol_cari" value="Cari" class="btn btn-info btn-sm">
        </form>
        <br>
        <table class="table table-hover">
            <tr>
                <td>ID Transaksi</td>
                <td>Nama Customer</td>
                <td>Nama Ikan</td>
                <td>Jumlah (KG)</td>
                <td>Tanggal</td>
            </tr>

            <?php
            $kueri = "SELECT sales.*, customers.name AS customer_name, fish.fish_name 
                    FROM sales 
                    JOIN customers ON sales.customer_id = customers.customer_id 
                    JOIN fish ON sales.fish_id = fish.fish_id";

if (isset($_POST['tombol_cari'])) {
                $cari = $_POST['cari'];
                $kueri .= " WHERE customers.name LIKE '%$cari%'";
            }

            if (isset($_POST['tombol_urutan'])) {
                $urutan = $_POST['urutan'];
                if ($urutan == 'sale_id_asc') {
                    $kueri .= " ORDER BY sale_id ASC";
                } elseif ($urutan == 'sale_id_desc') {
                    $kueri .= " ORDER BY sale_id DESC";
                } elseif ($urutan == 'customer_asc') {
                    $kueri .= " ORDER BY customers.name ASC";
                } elseif ($urutan == 'customer_desc') {
                    $kueri .= " ORDER BY customers.name DESC";
                }
            }

            $go = mysqli_query($koneksi, $kueri);
            while ($kolom = mysqli_fetch_array($go)) {
                echo '<tr>';
                echo '<td>' . $kolom['sale_id'] . '</td>';
                echo '<td>' . $kolom['customer_name'] . '</td>';
                echo '<td>' . $kolom['fish_name'] . '</td>';
                echo '<td>' . $kolom['quantity_kg'] . '</td>';
                echo '<td>' . $kolom['sale_date'] . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
        <br>
        <a href="index.php" class="btn btn-primary">Kembali ke Halaman Utama</a>
    </center>
</body>
</html>
