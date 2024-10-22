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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Toko Ikan Raku</title>
    </head>
    <body>
        <center>
            <img src="banner IKAN.jpg" height="200px" width="100%">
            <br>
                <h3>Toko Ikan Iqbal</h3>
            <br>
            <form method="post" action="">
                <select name="urutan">
                    <option>Urutkan Berdasarkan</option>
                    <option value="no_asc">No (naik)</option>
                    <option value="no_desc">No (turun)</option>
                    <option value="fish_asc">Nama Ikan (A - Z)</option>
                    <option value="fish_desc">Nama Ikan (Z - A)</option>
                    <option value="price_asc">Harga (Rendah ke Tinggi)</option>
                    <option value="price_desc">Harga (Tinggi ke Rendah)</option>
                    <option value="stock_asc">Stok (Sedikit ke Banyak)</option>
                    <option value="stock_desc">Stok (Banyak ke Sedikit)</option>
                </select>
                <input type="submit" name="tombol_urutan" value="Urutkan" class="btn btn-info btn-sm">
            </form>
            <br>
            <form method="post" action="search.php">
                <input name="cari" placeholder="Kata kunci....">
                <input type="submit" name="tombol_cari" value="Cari" class="btn btn-info btn-sm">
            </form>

            <br>
            <table class="table table-hover">
                <tr>
                    <td>No</td>
                    <td>Ikan</td>
                    <td>Harga /KG</td>
                    <td>Stok</td>
                </tr>

                <?php
                if (isset($_POST['tombol_urutan'])) { // jika tombol urutkan ditekan
                    $urutan = $_POST['urutan'];

                    if ($urutan == 'no_asc') {
                        $kueri = "SELECT * FROM fish ORDER BY fish_id ASC";
                    } else if ($urutan == 'no_desc') {
                        $kueri = "SELECT * FROM fish ORDER BY fish_id DESC";
                    } else if ($urutan == 'fish_asc') {
                        $kueri = "SELECT * FROM fish ORDER BY fish_name ASC";
                    } else if ($urutan == 'fish_desc') {
                        $kueri = "SELECT * FROM fish ORDER BY fish_name DESC";
                    } else if ($urutan == 'price_asc') {
                        $kueri = "SELECT * FROM fish ORDER BY price_per_kg ASC";
                    } else if ($urutan == 'price_desc') {
                        $kueri = "SELECT * FROM fish ORDER BY price_per_kg DESC";
                    } else if ($urutan == 'stock_asc') {
                        $kueri = "SELECT * FROM fish ORDER BY stock_kg ASC";
                    } else if ($urutan == 'stock_desc') {
                        $kueri = "SELECT * FROM fish ORDER BY stock_kg DESC";
                    } else {
                        $kueri = "SELECT * FROM fish"; // default query jika tidak ada urutan
                    }
                } else {
                    $kueri = "SELECT * FROM fish"; // default query saat pertama kali load
                }

                $go = mysqli_query($koneksi, $kueri);
                while ($kolom = mysqli_fetch_array($go)) {
                    echo '<tr>';
                    echo '<td>' . $kolom['fish_id'] . '</td>';
                    echo '<td>' . $kolom['fish_name'] . '</td>';
                    echo '<td>' . $kolom['price_per_kg'] . '</td>';
                    echo '<td>' . $kolom['stock_kg'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </table>
            <br>
            <a href="index.php" class="btn btn-primary">Kembali ke Halaman Utama</a>
        </center>
    </body>
</html>