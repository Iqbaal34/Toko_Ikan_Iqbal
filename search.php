<?php
include 'koneksi.php';

$cari = isset($_POST['cari']) ? mysqli_real_escape_string($koneksi, $_POST['cari']) : '';
$urutan = isset($_POST['urutan']) ? $_POST['urutan'] : '';

$kueri = "SELECT * FROM fish WHERE fish_name LIKE '%$cari%'";

if ($urutan == 'no_asc') {
    $kueri .= " ORDER BY fish_id ASC";
} else if ($urutan == 'no_desc') {
    $kueri .= " ORDER BY fish_id DESC";
} else if ($urutan == 'fish_asc') {
    $kueri .= " ORDER BY fish_name ASC";
} else if ($urutan == 'fish_desc') {
    $kueri .= " ORDER BY fish_name DESC";
} else if ($urutan == 'price_asc') {
    $kueri .= " ORDER BY price_per_kg ASC";
} else if ($urutan == 'price_desc') {
    $kueri .= " ORDER BY price_per_kg DESC";
} else if ($urutan == 'stock_asc') {
    $kueri .= " ORDER BY stock_kg ASC";
} else if ($urutan == 'stock_desc') {
    $kueri .= " ORDER BY stock_kg DESC";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Hasil Pencarian - Toko Ikan Iqbal</title>
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
            <input name="cari" placeholder="Kata kunci...." value="<?php echo $cari; ?>">
            <input type="submit" name="tombol_cari" value="Cari" class="btn btn-info btn-sm">
        </form>
        <br>

        <?php
        $go = mysqli_query($koneksi, $kueri);
        if (mysqli_num_rows($go) > 0) {
            echo "<table class='table table-hover'>
                    <tr>
                        <td>No</td>
                        <td>Ikan</td>
                        <td>Harga /KG</td>
                        <td>Stok</td>
                    </tr>";
            while ($kolom = mysqli_fetch_array($go)) {
                echo '<tr>';
                echo '<td>' . $kolom['fish_id'] . '</td>';
                echo '<td>' . $kolom['fish_name'] . '</td>';
                echo '<td>' . $kolom['price_per_kg'] . '</td>';
                echo '<td>' . $kolom['stock_kg'] . '</td>';
                echo '</tr>';
            }
            echo "</table>";
        } else {
            echo "<p>Tidak ada hasil untuk kata kunci '$cari'</p>";
        }
        ?>
        <br>
    </center>
</body>
</html>
