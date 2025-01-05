<?php 
include '../koneksi.php';

if (!isset($_SESSION["idinv2"])) {
  header("Location: login_petugas.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $judul; ?></title>
  
   <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="../vendor/adminlte/plugins/bootstrap/css/bootstrap.min.css">
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
  
  <!-- Navbar -->
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light bg-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="index.php" class="nav-link">Home</a>
    </li>
  </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <?php 
          $id = $_SESSION['idinv2'];
          include '../koneksi.php';
          $sql = "SELECT * FROM tb_petugas WHERE id_petugas = '$id'";
          $query = mysqli_query($koneksi, $sql);
          $r = mysqli_fetch_array($query);
          echo $r['nama'];
          ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <form action="logout_petugas.php" method="post">
            <button class="dropdown-item" onclick="return confirm('yakin ingin logout?');">
              <i class="fas fa-sign-out-alt"></i> Keluar
            </button>
          </form>
        </div>
      </li>
    </ul>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link">
      <span class="brand-text font-weight-light">Inventory</span>
    </a>

    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
            <a href="logout.php" class="nav-link" onclick="return confirm('yakin ingin logout?');">
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
            <h1 class="m-0">Selamat Datang, <?php echo $r['nama']; ?></h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- Panel 1 -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <?php
                $sql = "SELECT count(id_brg_in) as jbrg_in FROM tb_barang_in";
                $query = mysqli_query($koneksi, $sql);
                $r = mysqli_fetch_assoc($query);
                echo "<h3>" . $r['jbrg_in'] . "</h3>";
                ?>
                <p>Jumlah Barang Masuk</p>
              </div>
              <div class="icon">
                <i class="fas fa-cart-plus"></i>
              </div>
              <a href="?m=barangMasuk&s=awal" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <!-- Panel 2 -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <?php
                $sql = "SELECT count(no_ajuan) as jajuan FROM tb_ajuan";
                $query = mysqli_query($koneksi, $sql);
                $r = mysqli_fetch_assoc($query);
                echo "<h3>" . $r['jajuan'] . "</h3>";
                ?>
                <p>Jumlah Ajuan Barang Keluar</p>
              </div>
              <div class="icon">
                <i class="fas fa-gift"></i>
              </div>
              <a href="?m=ajuan&s=awal" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- Tambahkan panel lainnya sesuai kebutuhan -->
        </div>
      </div>
    </section>
  </div>
  <!-- Footer -->
  <footer class="main-footer text-center">
      <strong>&copy; <?php echo date('Y'); ?> Sistem Inventory Barang BPS.</strong> All rights reserved.
    </footer>
</div>

<!-- Script yang Dibutuhkan -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>
