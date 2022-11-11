<?php

session_start();
    include "koneksi.php";
    $fileName = $_FILES['foto']['name']; //nama file
    $fileSize = $_FILES['foto']['size']; //ukuran file
    $fileError = $_FILES['foto']['error']; //
    $uploaddir='img/foto/';
    $lokasi=$uploaddir.$fileName;
    if($fileSize > 0 || $fileError == 0){ //Check jika error
   $move = move_uploaded_file($_FILES['foto']['tmp_name'],$lokasi); //save gambar ke folder
    if($move){
    echo "<h3>Success! </h3>";
	$_SESSION['notice']='Upload foto berhasil!';
	?>
	
	<?php
	if (isset($_SESSION['DUDI']) AND $_SESSION['Level']=='dudiowner') {
	$z=mysql_query("UPDATE `tblmasterdudi` INNER JOIN tbluser
	ON tbluser.Id = tblmasterdudi.KdOwner
	SET `FotoD` = '$fileName',`PathD` = 'img/foto/$fileName' WHERE `tbluser`.`Id` ='$_SESSION[Id]'"); //memasukkan 	data ke database
	$sqlq=mysql_query("SELECT tblmasterdudi.Id, tbluser.Level FROM tblmasterdudi INNER JOIN tbluser
	ON tbluser.Id = tblmasterdudi.KdOwner
	WHERE tbluser.Id='$_SESSION[Id]'");
	$data=mysql_fetch_array($sqlq);
	echo"<meta http-equiv='refresh'content='0;url=profil.php?id=$data[Id]&lvl=$data[Level]'>";// mengarahkan ke file tampil foto
	unset($_SESSION['DUDI']);
	} else {
	$z=mysql_query("UPDATE `tbluser`
	SET `Foto` = '$fileName',`Path` = 'img/foto/$fileName' WHERE `tbluser`.`Id` ='$_SESSION[Id]'"); //memasukkan data ke database
	 echo"<meta http-equiv='refresh'content='0;url=profil.php'>";// mengarahkan ke file tampil foto
	}

   


} else{
    $_SESSION['notice']='Ada kesalahan dalam mengunggah data!';
    echo "<h3>Failed! </h3>";
    header('location:index.php');
    }
    } else {
    echo "Failed to Upload : ".$fileError;
    }
?>