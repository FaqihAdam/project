<?php
include "sesi_admin.php";
if(isset($_GET['id_tim'])){
	include "../koneksi.php";
	$id=$_GET['id_tim'];
	
		$sql1   = "DELETE FROM tb_tim WHERE id_tim= '$id'";
	
		
	$hapus1 = mysqli_query($koneksi,$sql1);
	if($hapus1){
//			echo 'Data Kelas Berhasil di Hapus ';
//			echo '<a href="index.php">Kembali</a>';
		header("Location: ?m=tim&s=awal");
	}else{
		echo 'Data Kelas GAGAL di Hapus';
		echo '<a href="index.php">Kembali</a>';
	}
}
?>
