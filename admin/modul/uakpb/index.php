<?php 
include 'sesi_admin.php';
$modul = (isset($_GET['s']))?$_GET['s']:"awal";
switch($modul){
	case 'awal': default: include "modul/uakpb/title.php"; break;
	case 'simpan': include "modul/uakpb/simpan.php"; break;
	case 'hapus': include "modul/uakpb/hapus.php"; break;
	case 'ubah': include "modul/uakpb/ubah.php"; break;
	case 'update': include "modul/uakpb/update.php"; break;
	
}
 ?>