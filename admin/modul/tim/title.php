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

<body>
  <!-- Menu -->
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
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
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
      <div class="content">
        <div class="container-fluid">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Tambah data
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Tambah data Tim</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="?m=tim&s=simpan" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Tim</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="nama_tim"
                        aria-describedby="emailHelp" placeholder="Masukkan Nama Tim">
                      <small id="emailHelp" class="form-text text-muted">Masukkan Nama Tim</small>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" name="simpan" class="btn btn-primary">Save changes</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Table -->
        <div class="card">
          <div class="card-body">
            <table id="petugasTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id Tim</th>
                  <th>Nama</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include '../koneksi.php';
                $sql = "SELECT * FROM tb_tim";
                $query = mysqli_query($koneksi, $sql);
                while ($data = mysqli_fetch_array($query)) {
                  echo "<tr>
                                            <td>{$data['id_tim']}</td>
                                            <td>{$data['nama_tim']}</td>
                                            <td>
                                                <a href='?m=tim&s=hapus&id_tim={$data['id_tim']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Delete</a>
                                            </td>
                                        </tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </div><!-- /.content -->
  </div><!-- /.content-wrapper -->

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
  </div><!-- ./wrapper -->
  <script>
    $(document).ready(function () {
      $('#petugasTable').DataTable();
    });
  </script>
</body>

</html>