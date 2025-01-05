<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Edit Data Barang</title>

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <!-- jQuery UI CSS -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
          $id = $_SESSION['idinv'];
          include '../koneksi.php';
          $sql = "SELECT * FROM tb_admin WHERE id_admin = '$id'";
          $query = mysqli_query($koneksi, $sql);
          $r = mysqli_fetch_array($query);
          ?>
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
              <a href="?m=supplier&s=awal" class="nav-link">
                <i class="nav-icon fas fa-building"></i>
                <p>Data UAKPB</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?m=rak&s=awal" class="nav-link">
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
              <a href="logout.php" onclick="return confirm('yakin ingin logout?')" class="nav-link">
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
      <!-- Content Header -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Edit Data Barang</h1>
            </div>
          </div>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Form Edit Data Barang</h3>
                </div>
                <form action="?m=barang&s=update" method="POST" enctype="multipart/form-data">
                  <div class="card-body">
                    <?php
                    $id = $_GET['id_barang'];
                    include '../koneksi.php';
                    $sql = "SELECT * FROM tb_barang WHERE id_barang = '$id'";
                    $query = mysqli_query($koneksi, $sql);
                    $r = mysqli_fetch_array($query);
                    ?>
                    <input type="hidden" value="<?php echo $r['id_barang']; ?>" name="id_barang">
                    <div class="form-group">
                      <label for="kode_brg">Kode Barang</label>
                      <input type="text" class="form-control" id="kode_brg" name="kode_brg"
                        value="<?php echo $r['kode_brg']; ?>" placeholder="Masukkan Kode Barang">
                    </div>
                    <div class="form-group">
                      <label for="nama_brg">Nama Barang</label>
                      <input type="text" class="form-control" id="nama_brg" name="nama_brg"
                        value="<?php echo $r['nama_brg']; ?>" placeholder="Masukkan Nama Barang">
                    </div>
                    <div class="form-group">
                      <label for="satuan">Satuan</label>
                      <input type="text" class="form-control" id="satuan" name="satuan"
                        value="<?php echo $r['satuan']; ?>" placeholder="Masukkan Satuan">
                    </div>
                    <div class="form-group">
                      <label for="stok">Stok Barang</label>
                      <input type="text" class="form-control" id="stok" name="stok" value="<?php echo $r['stok']; ?>"
                        placeholder="Masukkan Stok Barang">
                    </div>
                    <div class="form-group">
                      <label for="tim">TIM</label>
                      <select class="form-control" id="tim" name="tim" required>
                        <?php
                        $sql = "SELECT * FROM tb_tim";
                        $hasil = mysqli_query($koneksi, $sql);
                        while ($data = mysqli_fetch_array($hasil)) {
                          echo "<option value='{$data['nama_tim']}'" . ($data['nama_tim'] == $r['tim'] ? " selected" : "") . ">{$data['nama_tim']}</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="supplier">Supplier</label>
                      <select class="form-control" id="supplier" name="supplier" required>
                        <?php
                        $sql = "SELECT * FROM tb_sup";
                        $hasil = mysqli_query($koneksi, $sql);
                        while ($data = mysqli_fetch_array($hasil)) {
                          echo "<option value='{$data['nama_sup']}'" . ($data['nama_sup'] == $r['supplier'] ? " selected" : "") . ">{$data['nama_sup']}</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" name="simpan" class="btn btn-primary">Save changes</button>
                    <a href="javascript:history.back()" class="btn btn-secondary">Close</a>
                  </div>
                </form>
              </div>
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
            <p class="text-muted mb-0">Copyright &copy;
              <script>document.write(new Date().getFullYear());</script> Sistem Pencatatan Aset BPS. All rights reserved
            </p>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>