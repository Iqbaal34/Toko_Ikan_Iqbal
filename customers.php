<?php
include 'koneksi.php';
?>

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
