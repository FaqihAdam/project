<?php
session_start();
include_once "sesi_admin.php";
$modul=(isset($_GET['m']))?$_GET['m']:"awal";
$jawal="Admin || INV Admin";
switch($modul){
    case 'awal': default: $aktif="Beranda"; $judul="Beranda $jawal"; include "awal.php"; break;
    case 'admin': $aktif="Admin"; $judul="Modul $jawal"; include "modul/admin/index.php"; break;
    case 'petugas': $aktif="Petugas"; $judul="Modul Petugas "; include "modul/petugas/index.php"; break;
    case 'uakpb': $aktif="uakpb"; $judul="Modul UAKPB "; include "modul/uakpb/index.php"; break;
    case 'tim': $aktif="tim"; $judul="Modul TIM "; include "modul/tim/index.php"; break;
    case 'barang': $aktif="Barang"; $judul="Modul Barang"; include "modul/barang/index.php"; break;
    case 'barangKeluar': $aktif="Barang Keluar"; $judul="Modul Barang Keluar "; include "modul/barangKeluar/index.php"; break;
    case 'barangMasuk': $aktif="Barang Masuk"; $judul="Modul Barang Masuk "; include "modul/barangMasuk/index.php"; break;
    case 'laporan': $aktif="Laporan"; $judul="Cetak Laporan "; include "modul/laporan/index.php"; break;
}

?>
