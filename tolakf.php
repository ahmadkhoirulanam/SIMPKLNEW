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
<title>SIPRIN : Sistem Informasi Prakerin - Tolak </title>
</head>
<body>
<div class="well">
<?php
$query=mysql_query("SELECT * FROM tblforwardd INNER JOIN tbluser
	ON tblforwardd.UserF = tbluser.Id 
	INNER JOIN tblmasterdudi 
	ON tblforwardd.DudiF = tblmasterdudi.Id
	WHERE tblforwardd.IdF = '$_GET[id]'
	ORDER BY tblforwardd.IdF DESC");
	$data=mysql_fetch_array($query);
?>
Anda akan menolak <b><?php echo $data['Username'];?></b> untuk Prakerin di <b><?php echo $data['NmDudi'];?></b>
<br>
<form action="tolakf.php?id=<?php echo $_GET['id']; ?>" method="POST">
Tulis alasan penolakan: <br><br><textarea id="alasan" name="alasan" class="form-control"></textarea><br>
<input type="submit" class="btn btn-success" value="Lanjutkan">
</form>
</div> 
<div class="line"></div>
</body>
</html>
<?php
if (isset($_POST['alasan'])){
	$sql=mysql_query("INSERT INTO `tblreason` (`ReasId`, `UserId`,`IdDudi`, `Reason`, `Terima`, `Penolak`) VALUES ('', '$data[UserF]', '$data[DudiF]', '$_POST[alasan]', '0','1')");
	$id=$_GET['id'];
	$sql2=mysql_query("DELETE FROM `tblforwardd` WHERE `tblforwardd`.`IdF` = $id");
	header('location:dudiowner.php');
} else {
	$_SESSION['notice']="Data Tidak Ditemukan";
	header('location:pokja.php');
}
?>