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
      <!-- Content Header -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Data Ajuan</h1>
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

        <!-- Modal for Tambah Data -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Ajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- Form untuk menambahkan data ajuan -->
                <form action="?m=ajuan&s=simpan" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="no_ajuan">No Ajuan</label>
                    <input type="text" class="form-control" id="no_ajuan" name="no_ajuan" readonly
                      value="<?php echo $nomor_ajuan; ?>">
                  </div>
                  <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal"
                      value="<?php echo $tanggalSekarang; ?>">
                  </div>
                  <div class="form-group">
                    <label for="kode_brg">Kode Barang</label>
                    <select name="kode_brg" class="form-control select2" id="kode_brg"
                      onchange="changeValue(this.value)">
                      <option>--- PILIH ---</option>
                      <?php
                      include("../koneksi.php");
                      $supp = ("SELECT * FROM tb_barang");
                      $result = mysqli_query($koneksi, $supp);
                      $jsArray = "var prdName = new Array();";
                      while ($row = mysqli_fetch_array($result)) {
                        echo '<option value="' . $row['kode_brg'] . '">' . $row['kode_brg'] . '</option>';
                        $jsArray .= "prdName['" . $row['kode_brg'] . "'] = {
                          nama_brg:'" . addslashes($row['nama_brg']) . "',
                          stok:'" . addslashes($row['stok']) . "',
                          supplier:'" . addslashes($row['supplier']) . "'};";
                      }
                      ?>
                    </select>
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
                    <label for="prd_nmbrg">Nama Barang</label>
                    <input type="text" class="form-control" id="prd_nmbrg" name="nama_brg" readonly>
                  </div>
                  <div class="form-group">
                    <label for="prd_stk">Stok</label>
                    <input type="text" class="form-control" id="prd_stk" name="stok" readonly>
                  </div>
                  <div class="form-group">
                    <label for="jml_ajuan">Jumlah Ajuan Permintaan</label>
                    <input type="text" class="form-control" id="jml_ajuan" name="jml_ajuan"
                      placeholder="Masukkan Jumlah Permintaan">
                  </div>
                  <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan"
                      placeholder="Masukkan Keterangan Pengajuan">
                  </div>
                  <div class="form-group">
                    <label for="petugas">Nama Petugas</label>
                    <select class="form-control select2" id="petugas" name="petugas">
                      <option value="">Silakan pilih nama Petugas</option>
                      <option value="Maibu Barwis Sugiharto, S.ST., M.Si.">Maibu Barwis Sugiharto, S.ST., M.Si.</option>
                      <option value="Kismia Hartatik, SST">Kismia Hartatik, SST</option>
                      <option value="Urip Puji Raharjo, SST, MAP">Urip Puji Raharjo, SST, MAP</option>
                      <option value="Ir. Nuringtijas Priharjani, M.M">Ir. Nuringtijas Priharjani, M.M</option>
                      <option value="Aufarul Faroh, SE., M.Sc">Aufarul Faroh, SE., M.Sc</option>
                      <option value="Eko Sujadi, SE, M.M.">Eko Sujadi, SE, M.M.</option>
                      <option value="Okris Jubaidi, SST, Msi">Okris Jubaidi, SST, Msi</option>
                      <option value="Sri Mulyati, SST, M.M">Sri Mulyati, SST, M.M</option>
                      <option value="Arif Muttaqin, SST">Arif Muttaqin, SST</option>
                      <option value="Rani Kirnawati, SST">Rani Kirnawati, SST</option>
                      <option value="Suko Prayogi, SP.,M.E">Suko Prayogi, SP.,M.E</option>
                      <option value="Sari Dewi Mashunah, A.Md">Sari Dewi Mashunah, A.Md</option>
                      <option value="Mutiara Salsabella, A.P.Kb.N.">Mutiara Salsabella, A.P.Kb.N.</option>
                      <option value="Intan Puspita Dewi, A.Md">Intan Puspita Dewi, A.Md</option>
                      <option value="Andhika Misriyanto, A.Md">Andhika Misriyanto, A.Md</option>
                      <option value="Trubus Setiabudi A.Md">Trubus Setiabudi A.Md</option>
                      <option value="Aprilia Ummi Mujahidah, A. Md. Stat">Aprilia Ummi Mujahidah, A. Md. Stat</option>
                      <option value="Anita Rokhawati, SST">Anita Rokhawati, SST</option>
                      <option value="Abdul Khamid, A.Md">Abdul Khamid, A.Md</option>
                      <option value="Windya Nugroho, A.Md.">Windya Nugroho, A.Md.</option>
                      <option value="Novy Febriana, SST">Novy Febriana, SST</option>
                      <option value="Ita Rokhaini, A.Md">Ita Rokhaini, A.Md</option>
                      <option value="April Nugroho Sri H, SE">April Nugroho Sri H, SE</option>
                      <option value="Munir, A.Md">Munir, A.Md</option>
                      <option value="Saifudin Zuhri, SE, M.Acc">Saifudin Zuhri, SE, M.Acc</option>
                      <option value="Harjito">Harjito</option>
                      <option value="Hayati Sriwigati, A.Md">Hayati Sriwigati, A.Md</option>
                      <option value="Achmad Subchan, A.Md">Achmad Subchan, A.Md</option>
                      <option value="Mochamad Habibi,S,Si">Mochamad Habibi,S,Si</option>
                      <option value="Ibnu Utomo, A.Md">Ibnu Utomo, A.Md</option>
                      <option value="Arinda Purbeni, A.Md">Arinda Purbeni, A.Md</option>
                      <option value="Arif Santoso, SST,M.Ak">Arif Santoso, SST,M.Ak</option>
                      <option value="Akhmad Ghozien, SST">Akhmad Ghozien, SST</option>
                      <option value="Risa Bella Rosanti, A.Md">Risa Bella Rosanti, A.Md</option>
                      <!-- Add more options as needed -->
                    </select>
                  </div>
                  <!-- Penutup form harus tepat sebelum modal-footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Save changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Table for Data Ajuan -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Ajuan Barang Keluar</h3>
              </div>
              <div class="card-body">
                <table id="ajuanTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No Ajuan</th>
                      <th>Tanggal</th>
                      <th>Kode Barang</th>
                      <th>Nama Barang</th>
                      <th>Jumlah Permintaan</th>
                      <th>Keterangan</th>
                      <th>Petugas</th>
                      <th>Validasi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include 'paging.php';
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- DataTables Initialization -->
        <script>
          $(document).ready(function () {
            $('#ajuanTable').DataTable();
          });
        </script>
      </section>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
      <strong>Copyright &copy;
        <script>document.write(new Date().getFullYear());</script> Sistem Inventory Barang BPS.
      </strong>
      All rights reserved.
    </footer>
  </div>
</body>

</html>