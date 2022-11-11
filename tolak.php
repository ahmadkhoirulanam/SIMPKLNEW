<?php include('include/header.php'); //	Include and load header

	// Execute sql query
	
$sql = mysql_query("SELECT * FROM tbluser WHERE Id = '$_SESSION[Id]'");
$data = mysql_fetch_array($sql);
$user_nama=$data['Username'];	//	Register sql array to variable
$_SESSION['name']=$user_nama;
$Id = $_SESSION['Id'];

if (!isset($_SESSION['Username']))
{
header('location:login.php');
}


	?>

<!-- HTML and semi PHP code -->

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIPRIN : Sistem Informasi Prakerin - Tolak</title>
</head>
<body>
<div class="well">
<?php
$query=mysql_query("SELECT * FROM tblpermohonan INNER JOIN tbluser
	ON tblpermohonan.Nama = tbluser.Id 
	INNER JOIN tblmasterdudi 
	ON tblpermohonan.Dudi = tblmasterdudi.Id
	INNER JOIN tblmastermahasiswa
	ON tblmastermahasiswa.NIS = tbluser.KdUser
	WHERE tblpermohonan.Id = '$_GET[id]'
	ORDER BY tblpermohonan.Id DESC");
	$data=mysql_fetch_array($query);
	$num = mysql_num_rows($query);
	if ($num==NULL){
	$_SESSION['notice']='Data Tidak Ditemukan';
	header('location:pokja.php');
	}
?>
Anda akan menolak <b><?php echo $data['NmSiswa'];?></b> untuk Prakerin di <b><?php echo $data['NmDudi'];?></b>
<br>
<form action="tolak.php?id=<?php echo $_GET['id']; ?>" method="POST">
Tentukan alasan penolakan: <br><br>

<input type='radio' name="alasan" checked class="form-control" value='Sudah Penuh'> Sudah penuh <br>
<input type='radio' name="alasan" class="form-control" value='Belum berkompeten untuk masuk ke Instansi bersangkutan'> Belum berkompeten untuk masuk ke Instansi bersangkutan <br>
<input type='radio' name="alasan" class="form-control" value='Anda dianjurkan untuk masuk ke Instansi lain'> Anda dianjurkan untuk masuk ke Instansi lain <br>
<input type='radio' name="alasan" class="form-control" value='Lainnya'> Lainnya <br>
<br>
<input type="submit" class="btn btn-success" value="Lanjutkan">
</form>
</div> 
<div class="line"></div>
</body>
</html>
<?php
if (isset($_POST['alasan'])){
	$sql=mysql_query("INSERT INTO `tblreason` (`ReasId`, `UserId`,`IdDudi`, `Reason`, `Terima`,`Penolak`) VALUES ('', '$data[Nama]', '$data[Dudi]', '$_POST[alasan]', '0','0')");
	$id=$_GET['id'];
	$sql2=mysql_query("DELETE FROM `tblpermohonan` WHERE `tblpermohonan`.`Id` = $id");
	header('location:pokja.php');
}
?>