<?php
$nomor_ajuan = mt_rand(1000, 9999);
date_default_timezone_set("Asia/Jakarta");
$tanggalSekarang = date("Y-m-d");
$jamSekarang = date("h:i a");
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php echo $judul; ?></title>
  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <!-- jQuery UI CSS -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<!-- Script yang Dibutuhkan -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<!-- jQuery UI JS -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<script>
    $(document).ready(function() {
      $('#barangMasukTable').DataTable({
        responsive: true
      });
    });
  </script>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <?php
          $id = $_SESSION['idinv2'];
          include '../koneksi.php';
          $sql = "SELECT * FROM tb_petugas WHERE id_petugas = '$id'";
          $query = mysqli_query($koneksi, $sql);
          $r = mysqli_fetch_array($query);
          ?>
          <a class="nav-link" data-toggle="dropdown" href="#">
            <?php echo $r['nama']; ?>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <form action="logout.php" onclick="return confirm('Yakin ingin logout?');" method="post">
              <button class="dropdown-item" type="submit" name="keluar"><i class="fas fa-sign-out-alt"></i>
                Logout</button>
            </form>
          </div>
        </li>
      </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">Inventory</span>
      </a>
      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="?m=awal.php" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Beranda</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?m=barangMasuk&s=awal" class="nav-link">
                <i class="nav-icon fas fa-cart-plus"></i>
                <p>Data Barang Masuk</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?m=ajuan&s=awal" class="nav-link">
                <i class="nav-icon fas fa-gift"></i>
                <p>Data Ajuan Barang Keluar</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="logout.php" onclick="return confirm('Yakin ingin logout?');" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"><?php echo $judul; ?></h1>
            </div>
          </div>
        </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                Tambah data
              </button>
            </div>
          </div>

          <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah barang masuk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Form with new action -->
        <form action="?m=barangMasuk&s=simpan" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" name="tanggal" placeholder="Masukkan Tanggal">
          </div>

          <div class="form-group">
            <label for="noinv">No. Invoice</label>
            <input type="text" class="form-control" name="noinv" placeholder="Masukkan Nomor Invoice">
          </div>

          <div class="form-group">
            <label for="kode_brg">Kode Barang</label>
            <?php
            include ("../koneksi.php");
            $supp = ("SELECT * FROM tb_barang");
            $result = mysqli_query($koneksi, $supp);
            $jsArray = "var prdName = new Array();";
            echo '<select name="kode_brg" onchange="changeValue(this.value)" class="form-control">';
            echo '<option>--- PILIH ---</option>';
            while ($row = mysqli_fetch_array($result)) {
              echo '<option value="' . $row['kode_brg'] . '">' . $row['kode_brg'] . '</option>';
              $jsArray .= "prdName['" . $row['kode_brg'] . "'] = {
                nama_brg:'" . addslashes($row['nama_brg']) . "',
                stok:'" . addslashes($row['stok']) . "',
                supplier:'" . addslashes($row['supplier']) . "'};";
            }
            echo '</select>';
            ?>
            <script type="text/javascript">
              <?php echo $jsArray; ?>
              function changeValue(id) {
                document.getElementById('prd_nmbrg').value = prdName[id].nama_brg;
                document.getElementById('prd_stk').value = prdName[id].stok;
                document.getElementById('prd_sup').value = prdName[id].supplier;
              }
            </script>
          </div>

          <div class="form-group">
            <label for="nama_brg">Nama Barang</label>
            <input type="text" class="form-control" id="prd_nmbrg" name="nama_brg" readonly>
          </div>

          <div class="form-group">
            <label for="supplier">Supplier</label>
            <input type="text" class="form-control" id="prd_sup" name="supplier" readonly>
          </div>

          <div class="form-group">
            <label for="stok">Stok</label>
            <input type="text" class="form-control" id="prd_stk" name="stok" readonly>
          </div>

          <div class="form-group">
            <label for="jml_masuk">Jumlah Masuk</label>
            <input type="text" class="form-control" name="jml_masuk" placeholder="Masukkan Jumlah Masuk">
          </div>

          <div class="form-group">
            <label for="jam">Jam</label>
            <input type="text" class="form-control" value="<?php echo date("h:i"); ?>" name="jam" readonly>
          </div>

          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan">
          </div>

          <div class="form-group">
            <label for="petugas">Petugas</label>
            <input type="text" class="form-control" value="<?php echo $r['nama']; ?>" name="petugas" readonly>
          </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
      </div>
      </form> <!-- End form -->
    </div>
  </div>
</div>


          <!-- Tabel data barang -->
          <div class="card mt-3">
            <div class="card-body table-responsive">
              <table id="barangMasukTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>No Invoice</th>
                    <th>UAKPB</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Jumlah Masuk</th>
                    <th>Keterangan</th>
                    <th>Petugas</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include "../koneksi.php";
                  $sql = "SELECT * FROM tb_barang_in";
                  $query = mysqli_query($koneksi, $sql);
                  $no = 0;
                  while ($data = mysqli_fetch_array($query)) {
                    $no++;
                    echo "<tr>
                            <td>$no</td>
                            <td>$data[tanggal]</td>
                            <td>$data[noinv]</td>
                            <td>$data[supplier]</td>
                            <td>$data[kode_brg]</td>
                            <td>$data[nama_brg]</td>
                            <td>$data[stok]</td>
                            <td>$data[jml_masuk]</td>
                            <td>$data[keterangan]</td>
                            <td>$data[petugas]</td>
                            <td>
                              <a href='?m=barangMasuk&s=hapus&id_brg_in={$data['id_brg_in']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Delete</a>
                            </td>
                          </tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <p class="text-muted mb-0">Copyright &copy; <script>document.write(new Date().getFullYear());</script> Sistem Inventory. All rights reserved</p>
          </div>
        </div>
      </div>
    </footer>
  </div><!-- ./wrapper -->
</body>

</html>