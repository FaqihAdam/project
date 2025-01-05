<?php
date_default_timezone_set("Asia/Jakarta");
$tanggalSekarang = date("Y-m-d");
$jamSekarang = date("h:i a");
$nomor_barang_keluar = mt_rand(1000, 9999);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $judul; ?></title>

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light bg-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Home</a>
        </li>
      </ul>
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
            <img src="../images/admin/<?php echo $r['foto']; ?>" class="img-circle elevation-2" alt="User Image" height="35">
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

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">Inventory</span>
      </a>
      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item"><a href="?m=awal.php" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p>Beranda</p></a></li>
            <li class="nav-item"><a href="?m=admin&s=awal" class="nav-link"><i class="nav-icon fas fa-user"></i><p>Data Admin</p></a></li>
            <li class="nav-item"><a href="?m=petugas&s=awal" class="nav-link"><i class="nav-icon fas fa-users"></i><p>Data Petugas</p></a></li>
            <li class="nav-item"><a href="?m=uakpb&s=awal" class="nav-link"><i class="nav-icon fas fa-building"></i><p>Data UAKPB</p></a></li>
            <li class="nav-item"><a href="?m=tim&s=awal" class="nav-link"><i class="nav-icon fas fa-cubes"></i><p>Data TIM</p></a></li>
            <li class="nav-item"><a href="?m=barang&s=awal" class="nav-link"><i class="nav-icon fas fa-archive"></i><p>Data Barang</p></a></li>
            <li class="nav-item"><a href="?m=barangMasuk&s=awal" class="nav-link"><i class="nav-icon fas fa-cart-plus"></i><p>Data Barang Masuk</p></a></li>
            <li class="nav-item"><a href="?m=barangKeluar&s=awal" class="nav-link"><i class="nav-icon fas fa-cart-arrow-down"></i><p>Data Barang Keluar</p></a></li>
            <li class="nav-item"><a href="?m=laporan&s=awal" class="nav-link"><i class="nav-icon fas fa-file"></i><p>Laporan</p></a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link" onclick="return confirm('yakin ingin logout?')"><i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p></a></li>
          </ul>
        </nav>
      </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
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
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Barang Keluar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="?m=barangKeluar&s=simpan" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="exampleInputEmail1">No Barang Keluar</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="no_brg_out" aria-describedby="emailHelp" value="<?php echo $nomor_barang_keluar; ?>">
            <small id="emailHelp" class="form-text text-muted">Nomor Barang Keluar</small>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Nomor Ajuan</label>
            <?php
            include ("../koneksi.php");
            $query = "SELECT a.*, b.stok FROM tb_ajuan a INNER JOIN tb_barang b ON a.kode_brg = b.kode_brg WHERE a.val = '1'";
            $result = mysqli_query($koneksi, $query);
            $jsArray = "var prdName = new Array();";

            echo '<select name="no_ajuan" onchange="changeValue(this.value)">';
            echo '<option>--- PILIH ---</option>';
            while ($row = mysqli_fetch_array($result)) {
              echo '<option value="' . $row['no_ajuan'] . '">' . $row['no_ajuan'] . '</option>';
              $jsArray .= "prdName['" . $row['no_ajuan'] . "'] = {
                tanggal_ajuan:'" . addslashes($row['tanggal']) . "',
                petugas:'" . addslashes($row['petugas']) . "',
                kode_brg:'" . addslashes($row['kode_brg']) . "',
                nama_brg:'" . addslashes($row['nama_brg']) . "',
                stok:'" . addslashes($row['stok']) . "',
                jml_ajuan:'" . addslashes($row['jml_ajuan']) . "',
                keterangan:'" . addslashes($row['keterangan']) . "',
                val:'" . addslashes($row['val']) . "'
              };";
            }
            echo '</select>';
            ?>
            <script type="text/javascript">
              <?php echo $jsArray; ?>
              function changeValue(id) {
                document.getElementById('prd_tanggal').value = prdName[id].tanggal_ajuan;
                document.getElementById('prd_petugas').value = prdName[id].petugas;
                document.getElementById('prd_kodebrng').value = prdName[id].kode_brg;
                document.getElementById('prd_namabrg').value = prdName[id].nama_brg;
                document.getElementById('prd_stokbrga').value = prdName[id].stok;
                document.getElementById('prd_jmlajuan').value = prdName[id].jml_ajuan;
                document.getElementById('prd_keterangan').value = prdName[id].keterangan;
              }
            </script>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Tanggal Ajuan</label>
            <input type="text" readonly class="form-control" id="prd_tanggal" name="tanggal_ajuan" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">Tanggal Ajuan</small>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Tanggal Keluar</label>
            <input type="date" class="form-control" name="tanggal_out" value="<?php echo $tanggalSekarang; ?>" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">Masukkan Tanggal Keluar</small>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Petugas</label>
            <input type="text" readonly class="form-control" id="prd_petugas" name="petugas" aria-describedby="emailHelp">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Kode Barang</label>
            <input type="text" readonly class="form-control" id="prd_kodebrng" name="kode_brg" aria-describedby="emailHelp">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Nama Barang</label>
            <input type="text" readonly class="form-control" id="prd_namabrg" name="nama_brg">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Stok</label>
            <input type="text" readonly class="form-control" id="prd_stokbrga" name="stok" aria-describedby="emailHelp">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Jumlah Ajuan</label>
            <input type="text" readonly class="form-control" id="prd_jmlajuan" name="jml_ajuan" aria-describedby="emailHelp">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Jumlah Keluar</label>
            <input type="text" class="form-control" name="jml_keluar" aria-describedby="emailHelp" placeholder="Masukkan Jumlah Keluar">
            <small id="emailHelp" class="form-text text-muted">Masukkan Jumlah Keluar</small>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Keterangan</label>
            <input type="text" class="form-control" id="prd_keterangan" name="keterangan" aria-describedby="emailHelp" readonly>
            <small id="emailHelp" class="form-text text-muted">Keterangan</small>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Admin</label>
            <input type="text" class="form-control" value="<?php echo $r['nama']; ?>" readonly name="admin" aria-describedby="emailHelp">
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
            <div class="card-body table-responsive">
              <table id="brgoutTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No Barang Keluar</th>
                    <th>No Ajuan</th>
                    <th>Tanggal Ajuan</th>
                    <th>Tanggal Keluar</th>
                    <th>Petugas</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Jumlah Ajuan</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include("../koneksi.php");
                  $query = "SELECT * FROM tb_barang_out";
                  $result = mysqli_query($koneksi, $query);
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['no_brg_out']}</td>";
                    echo "<td>{$row['no_ajuan']}</td>";
                    echo "<td>{$row['tanggal_ajuan']}</td>";
                    echo "<td>{$row['tanggal_out']}</td>";
                    echo "<td>{$row['petugas']}</td>";
                    echo "<td>{$row['kode_barang']}</td>";
                    echo "<td>{$row['nama_barang']}</td>";
                    echo "<td>{$row['stok']}</td>";
                    echo "<td>{$row['jml_ajuan']}</td>";
                    echo "<td>{$row['keterangan']}</td>";
                    echo "<td>
                            <a href='?m=barangKeluar&s=hapus&no_brg_out={$row['no_brg_out']}' onclick=\"return confirm('Apakah Anda yakin ingin menghapus?');\" class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a>
                          </td>";
                    echo "</tr>";
                  }
                  ?>
                </tbody>
              </table>
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
            <p class="text-muted mb-0">Copyright &copy; <script>document.write(new Date().getFullYear());</script> Sistem Inventory Barang BPS. All rights reserved</p>
          </div>
        </div>
      </div>
    </footer>
  </div><!-- ./wrapper -->

  <script>
    $(document).ready(function() {
      $('#brgoutTable').DataTable();
    });
  </script>

</body>
</html>
