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
<title>SIPRIN : Sistem Informasi Prakerin - Terima</title>
</head>
<body>
<div class="well">
<?php
$query=mysql_query("SELECT * FROM tblpermohonan INNER JOIN tbluser
	ON tblpermohonan.Nama = tbluser.Id 
	INNER JOIN tblmasterdudi 
	ON tblpermohonan.Dudi = tblmasterdudi.Id
	WHERE tblpermohonan.Id = '$_GET[id]'
	ORDER BY tblpermohonan.Id DESC");
	$data=mysql_fetch_array($query);
if ($data['magang']>=$data['dayatampung'] AND $data<>NULL){
$id=$_GET['id'];
$updateData = mysql_query("INSERT INTO `tblreason` (`ReasId` ,
`UserId` ,
`IdDudi` ,
`Reason` ,
`Terima` ,
`Penolak`)VALUES (NULL, '$data[Nama]', '$data[Dudi]', 'Sudah Penuh', '0', '0')");
$_SESSION['notice']='Yang bersangkutan ditolak karena daya tampung perusahaan baru saja penuh';
$dilet=mysql_query("DELETE FROM `tblpermohonan` WHERE `tblpermohonan`.`Id` = $id");	
header('location:pokja.php');
exit;
}
$masukinData=mysql_query("INSERT INTO `tblforwardd` (`IdF`, `UserF`, `DudiF`, `TimestampF`, `Verified`) VALUES (NULL, '$data[Nama]', '$data[Dudi]', CURRENT_TIMESTAMP, 'F')");
$UpdatedMagang=$data[magang]+1;
//$UpdateDayaTampung=mysql_query("UPDATE `tblmasterdudi` SET `magang` = '$UpdatedMagang' WHERE `tblmasterdudi`.`Id` = '$data[Dudi]';");
$id=$_GET['id'];
$sql2=mysql_query("DELETE FROM `tblpermohonan` WHERE `tblpermohonan`.`Id` = $id");	
header('location:pokja.php');
?>
