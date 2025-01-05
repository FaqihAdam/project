<?php 
include 'sesi_admin.php';
$modul = (isset($_GET['s']))?$_GET['s']:"awal";
switch($modul){
	case 'awal': default: include "modul/tim/title.php"; break;
	case 'simpan': include "modul/tim/simpan.php"; break;
	case 'hapus': include "modul/tim/hapus.php"; break;
	case 'ubah': include "modul/tim/ubah.php"; break;
	case 'update': include "modul/tim/update.php"; break;
	
}
 ?>