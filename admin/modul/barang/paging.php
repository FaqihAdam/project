<head>

</head>
<?php
include '../koneksi.php';

$batas = 20;
$halaman = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
$previous = $halaman - 1;
$next = $halaman + 1;

// Hapus inisialisasi nomor urut di sini
$data = mysqli_query($koneksi, "SELECT * FROM tb_barang ORDER BY kode_brg ASC");
$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);
//$nomor = $halaman_awal + 1; // Hapus baris ini
$no = ($halaman * $batas) - ($batas - 1); // Tambahkan variabel nomor urut ini

if (isset($_POST['go'])) {
    $cari = $_POST['cari'];

    $data_rak = mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE nama_brg LIKE '%" . $cari . "%'");
} else {
    $data_rak = mysqli_query($koneksi, "SELECT * FROM tb_barang LIMIT $halaman_awal, $batas");
}

foreach ($data_rak as $row):
?>
    <tr>
        <td>
            <?php echo $no++; ?>
        </td>
        <td>
            <?php echo $row['kode_brg']; ?>
        </td>
        <td>
            <?php echo $row['nama_brg']; ?>
        </td>
        <td>
            <?php echo $row['satuan']; ?>
        </td>
        <td>
            <?php echo $row['stok']; ?>
        </td>
        <td>
            <?php echo $row['tim']; ?>
        </td>
        <td>
            <?php echo $row['supplier']; ?>
        </td>
        <td><a href="index.php?m=barang&s=hapus&id_barang=<?php echo $row['id_barang']; ?>"
                onclick="return confirm('Yakin Akan dihapus?')"><button class="btn btn-danger">Hapus</button></a> | <a
                href="index.php?m=barang&s=ubah&id_barang=<?php echo $row['id_barang']; ?>"><button
                    class="btn btn-primary">Ubah</button></a></td>
    </tr>
<?php endforeach; ?>
