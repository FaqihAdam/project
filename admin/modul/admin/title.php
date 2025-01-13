<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $judul; ?></title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
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
                        <img src="../images/admin/<?php echo $r['foto']; ?>" class="img-circle elevation-2"
                            alt="User Image" height="35">
                        <?php echo $r['nama']; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <form action="logout.php" method="post">
                            <button class="dropdown-item" type="submit" name="keluar"
                                onclick="return confirm('yakin ingin logout?');">
                                <i class="fa fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <span class="brand-text font-weight-light">Inventory</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="?m=awal.php" class="nav-link">
                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>Beranda</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?m=admin&s=awal" class="nav-link">
                                <i class="nav-icon fa fa-user"></i>
                                <p>Data Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?m=petugas&s=awal" class="nav-link">
                                <i class="nav-icon fa fa-users"></i>
                                <p>Data Petugas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?m=barang&s=awal" class="nav-link">
                                <i class="nav-icon fa fa-archive"></i>
                                <p>Data Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?m=barangMasuk&s=awal" class="nav-link">
                                <i class="nav-icon fa fa-cart-plus"></i>
                                <p>Data Barang Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?m=barangKeluar&s=awal" class="nav-link">
                                <i class="nav-icon fa fa-cart-arrow-down"></i>
                                <p>Data Barang Keluar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?m=laporan&s=awal" class="nav-link">
                                <i class="nav-icon fa fa-file"></i>
                                <p>Laporan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link" onclick="return confirm('yakin ingin logout?')">
                                <i class="nav-icon fa fa-warning"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Data Admin</h1>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Tambah data
                </button>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Tambah data admin</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="?m=admin&s=simpan" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" id="username" name="username"
                                                    placeholder="Masukkan Username" required>
                                                <small class="form-text text-muted">Masukkan username</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password"
                                                    name="password" placeholder="Masukkan Password" required>
                                                <small class="form-text text-muted">Masukkan Password</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                    placeholder="Masukkan Nama" required>
                                                <small class="form-text text-muted">Masukkan Nama</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="telepon">Telepon</label>
                                                <input type="text" class="form-control" id="telepon" name="telepon"
                                                    placeholder="Masukkan Nomor Telepon" required>
                                                <small class="form-text text-muted">Masukkan Nomor Telepon</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="foto">Foto</label>
                                                <input type="file" class="form-control" id="foto" name="foto">
                                                <small class="form-text text-muted">Masukkan Foto</small>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" name="simpan" class="btn btn-primary">Save
                                                    changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="card">
                            <div class="card-body">
                                <table id="adminTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id Admin</th>
                                            <th>Username</th>
                                            <th>Nama</th>
                                            <th>Telepon</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include '../koneksi.php';
                                        $sql = "SELECT * FROM tb_admin";
                                        $query = mysqli_query($koneksi, $sql);
                                        while ($data = mysqli_fetch_array($query)) {
                                            echo "<tr>
                                            <td>{$data['id_admin']}</td>
                                            <td>{$data['username']}</td>
                                            <td>{$data['nama']}</td>
                                            <td>{$data['telepon']}</td>
                                            <td><img src='../images/admin/{$data['foto']}' height='50'></td>
                                            <td>
                                                <a href='?m=admin&s=ubah&id_admin={$data['id_admin']}' class='btn btn-warning btn-sm'>Edit</a>
                                                <a href='?m=admin&s=hapus&id_admin={$data['id_admin']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Delete</a>
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
        </section>
        <!-- /.content -->
        <!-- Footer -->
        <footer class="main-footer text-center">
            <strong>&copy; <?php echo date('Y'); ?> Sistem Inventory</strong> All rights reserved.
        </footer>
    </div>
    <!-- /.content-wrapper -->
    <!-- /.wrapper -->
    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function () {
            $('#adminTable').DataTable();
        });
    </script>
</body>

</html>