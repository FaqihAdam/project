<?php
include '../koneksi.php';

if (!isset($_SESSION["idinv"])) {
  header("Location: login.php");
  exit();
}
// Query untuk mengambil data ajuan yang menunggu persetujuan
$sql_ajuan = "SELECT * FROM tb_ajuan WHERE val = 1";
$query_ajuan = mysqli_query($koneksi, $sql_ajuan);
$jumlah_ajuan = mysqli_num_rows($query_ajuan);

// Mengambil data admin
$id = $_SESSION['idinv'];
$sql = "SELECT * FROM tb_admin WHERE id_admin = '$id'";
$query = mysqli_query($koneksi, $sql);
$r = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo isset($judul) ? $judul : 'SIPA'; ?></title>

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="hold-transition sidebar-mini">
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
      <!-- Left navbar links (opsional) -->
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Menu Pengguna -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <img src="../images/admin/<?php echo $r['foto']; ?>" class="img-circle" alt="User Image"
              style="height:35px;"> <?php echo $r['nama']; ?>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="logout.php" class="dropdown-item" onclick="return confirm('Yakin ingin logout?');">
              <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Sidebar Kiri -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Logo Brand -->
      <a href="?m=awal.php" class="brand-link">
        <span class="brand-text font-weight-light">Inventory</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Menu Sidebar-->
        <nav class="mt-2">
          <!-- Item Menu -->
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
            <li class="nav-item">
              <a href="?m=awal.php" class="nav-link">
                <i class="nav-icon fas fa-dashboard"></i>
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
              <a href="logout.php" class="nav-link" onclick="return confirm('Yakin ingin logout?');">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
              </a>
            </li>
          </ul>
          <!-- /.Item Menu -->
        </nav>
        <!-- /.Menu Sidebar -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <!-- /.Sidebar Kiri -->

    <!-- Konten Halaman -->
    <div class="content-wrapper">
      <!-- Header Halaman -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <h1>Selamat Datang, <?php echo $r['nama']; ?></h1>
            </div>
          </div>
        </div>
      </section>
      <!-- /.Header Halaman -->

      <!-- Konten Utama -->
      <section class="content">
        <div class="container-fluid">
          <!-- Notifikasi -->
          <?php if ($jumlah_ajuan > 0): ?>
            <div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class="icon fas fa-info-circle"></i>
              Terdapat <?php echo $jumlah_ajuan; ?> ajuan yang menunggu persetujuan. Silakan ke Menu <b><a
                  href="?m=barangKeluar&s=awal">Barang Keluar</a></b> untuk memprosesnya.
            </div>
          <?php endif; ?>

          <!-- Statistik -->
          <div class="row">
            <!-- Jumlah Admin -->
            <div class="col-lg-3 col-6">
              <div class="small-box bg-yellow">
                <div class="inner">
                  <?php
                  $sql = "SELECT count(id_admin) as jadmin FROM tb_admin";
                  $query = mysqli_query($koneksi, $sql);
                  $r_admin = mysqli_fetch_assoc($query);
                  echo "<h3>" . $r_admin['jadmin'] . "</h3>";
                  ?>
                  <p>Jumlah Admin</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="?m=admin&s=awal" class="small-box-footer">
                  View Details <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>

            <!-- Jumlah Petugas -->
            <div class="col-lg-3 col-6">
              <div class="small-box bg-yellow">
                <div class="inner">
                  <?php
                  $sql = "SELECT count(id_petugas) as jpetugas FROM tb_petugas";
                  $query = mysqli_query($koneksi, $sql);
                  $r_petugas = mysqli_fetch_assoc($query);
                  echo "<h3>" . $r_petugas['jpetugas'] . "</h3>";
                  ?>
                  <p>Jumlah Petugas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="?m=petugas&s=awal" class="small-box-footer">
                  View Details <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>

            <!-- Jumlah UAKPB -->

            <!-- Jumlah TIM -->
            <div class="col-lg-3 col-6">
              <div class="small-box bg-red">
                <div class="inner">
                  <?php
                  $sql = "SELECT count(id_tim) as jtim FROM tb_tim";
                  $query = mysqli_query($koneksi, $sql);
                  $r_tim = mysqli_fetch_assoc($query);
                  echo "<h3>" . $r_tim['jtim'] . "</h3>";
                  ?>
                  <p>Jumlah Tim</p>
                </div>
                <div class="icon">
                  <i class="fa fa-cubes"></i>
                </div>
                <a href="?m=tim&s=awal" class="small-box-footer">
                  View Details <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>

            <!-- Jumlah Barang -->
            <div class="col-lg-3 col-6">
              <div class="small-box bg-red">
                <div class="inner">
                  <?php
                  $sql = "SELECT count(kode_brg) as jbrg FROM tb_barang";
                  $query = mysqli_query($koneksi, $sql);
                  $r_barang = mysqli_fetch_assoc($query);
                  echo "<h3>" . $r_barang['jbrg'] . "</h3>";
                  ?>
                  <p>Jumlah Barang</p>
                </div>
                <div class="icon">
                  <i class="fa fa-archive"></i>
                </div>
                <a href="?m=barang&s=awal" class="small-box-footer">
                  View Details <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>

            <!-- Jumlah Barang Masuk -->
            <div class="col-lg-3 col-6">
              <div class="small-box bg-red">
                <div class="inner">
                  <?php
                  $sql = "SELECT count(id_brg_in) as jbrg_in FROM tb_barang_in";
                  $query = mysqli_query($koneksi, $sql);
                  $r_brg_in = mysqli_fetch_assoc($query);
                  echo "<h3>" . $r_brg_in['jbrg_in'] . "</h3>";
                  ?>
                  <p>Jumlah Barang Masuk</p>
                </div>
                <div class="icon">
                  <i class="fa fa-cart-plus"></i>
                </div>
                <a href="?m=barangMasuk&s=awal" class="small-box-footer">
                  View Details <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>

            

            <!-- Jumlah Barang Keluar -->
            <div class="col-lg-3 col-6">
              <div class="small-box bg-red">
                <div class="inner">
                  <?php
                  $sql = "SELECT count(no_brg_out) as jbrg_out FROM tb_barang_out";
                  $query = mysqli_query($koneksi, $sql);
                  $r_brg_out = mysqli_fetch_assoc($query);
                  echo "<h3>" . $r_brg_out['jbrg_out'] . "</h3>";
                  ?>
                  <p>Jumlah Barang Keluar</p>
                </div>
                <div class="icon">
                  <i class="fa fa-cart-arrow-down"></i>
                </div>
                <a href="?m=barangKeluar&s=awal" class="small-box-footer">
                  View Details <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>

          </div>
          <!-- /.Statistik -->
        </div>
      </section>
      <!-- /.Konten Utama -->
    </div>
    <!-- /.Konten Halaman -->

    <!-- Footer -->
    <footer class="main-footer text-center">
      <strong>&copy; <?php echo date('Y'); ?> Sistem Inventory</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- Script yang Dibutuhkan -->
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>