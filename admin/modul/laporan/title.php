<?php
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

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light bg-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Home</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <?php
      $id = $_SESSION['idinv'];
      include '../koneksi.php';
      $sql = "SELECT * FROM tb_admin WHERE id_admin = '$id'";
      $query = mysqli_query($koneksi, $sql);
      $r = mysqli_fetch_array($query);
      ?>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <img src="../images/admin/<?php echo $r['foto']; ?>" class="img-circle elevation-2" alt="User Image"
              height="35">
            <?php echo $r['nama']; ?>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="logout.php" class="dropdown-item" onclick="return confirm('yakin ingin logout?');">
              <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">Inventory</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="?m=awal.php" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Beranda</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?m=admin&s=awal" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>Data Admin</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?m=petugas&s=awal" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Data Petugas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?m=uakpb&s=awal" class="nav-link">
                <i class="nav-icon fas fa-building"></i>
                <p>Data UAKPB</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?m=tim&s=awal" class="nav-link">
                <i class="nav-icon fas fa-cubes"></i>
                <p>Data TIM</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?m=barang&s=awal" class="nav-link">
                <i class="nav-icon fas fa-archive"></i>
                <p>Data Barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?m=barangMasuk&s=awal" class="nav-link">
                <i class="nav-icon fas fa-cart-plus"></i>
                <p>Data Barang Masuk</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?m=barangKeluar&s=awal" class="nav-link">
                <i class="nav-icon fas fa-cart-arrow-down"></i>
                <p>Data Barang Keluar</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?m=laporan&s=awal" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>Laporan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="logout.php" class="nav-link" onclick="return confirm('yakin ingin logout?')">
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
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Laporan Barang Keluar dan Masuk</h1>
            </div>
          </div>
        </div>
      </div>

      <div class="content">
        <div class="container-fluid">
          
          <div class="card">
            <div class="card-body">
              <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Stok Terakhir</th>
                    <th>Stok Terkini</th>
                    <th>Jumlah Masuk</th>
                    <th>Jumlah Keluar</th>
                    <th>Keterangan</th>
                    <th>Petugas</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../koneksi.php';

                  // Query untuk mendapatkan data
                  $sql_out = "SELECT tanggal_out AS tanggal, kode_brg, nama_brg, stok, NULL AS jml_masuk, jml_keluar, keterangan, petugas 
                              FROM tb_barang_out
                              UNION ALL
                              SELECT tanggal, kode_brg, nama_brg, stok, jml_masuk, NULL AS jml_keluar, keterangan, petugas 
                              FROM tb_barang_in
                              ORDER BY tanggal, nama_brg";

                  $query_out = mysqli_query($koneksi, $sql_out);

                  // Menampilkan data
                  while ($row = mysqli_fetch_array($query_out)) {
                    // Menghitung stok terakhir
                    $stok_terakhir = $row['stok'] + ($row['jml_masuk'] ?? 0) - ($row['jml_keluar'] ?? 0);

                    echo "<tr>";
                    echo "<td>" . $row['tanggal'] . "</td>";
                    echo "<td>" . $row['kode_brg'] . "</td>";
                    echo "<td>" . $row['nama_brg'] . "</td>";
                    echo "<td>" . $stok_terakhir . "</td>"; // Menampilkan stok terakhir
                    echo "<td>" . $row['stok'] . "</td>";
                    echo "<td>" . ($row['jml_masuk'] ?? '-') . "</td>";
                    echo "<td>" . ($row['jml_keluar'] ?? '-') . "</td>";
                    echo "<td>" . $row['keterangan'] . "</td>";
                    echo "<td>" . $row['petugas'] . "</td>";
                    echo "</tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div><!-- /.content -->
    <!-- Footer -->
    <footer class="main-footer">
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <p class="text-muted mb-0">Copyright &copy;
              <script>document.write(new Date().getFullYear());</script> Sistem Inventory Barang BPS. All rights reserved
            </p>
          </div>
        </div>
      </div>
    </footer>
  </div><!-- /.content-wrapper -->
  </div><!-- ./wrapper -->

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
  <!-- DataTables Export Buttons JS -->
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
    });
  </script>
</body>

</html>