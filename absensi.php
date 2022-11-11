<?php include('include/header.php'); //	Include and load header

	// Execute sql query TBLUSER
	
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
<title>SIPRIN : Sistem Informasi Prakerin - Absensi</title>
</head>
<body>
<div class="well">
<?php
if (!isset($_GET['id'])){
$ident=$_SESSION['Id'];
}
else
{
$ident=$_GET['id'];
}

$cekUdahPKLApaBelum=mysql_query("SELECT * FROM tblforwardd INNER JOIN tbluser
ON tbluser.Id = tblforwardd.UserF 
INNER JOIN tblmasterdudi
ON tblmasterdudi.Id = tblforwardd.DudiF
WHERE tbluser.Id='$ident' AND tblforwardd.Verified = 'T' AND tblforwardd.Confirmed= 'T'");
$rst=mysql_fetch_array($cekUdahPKLApaBelum);
$cek=$rst[2];

$cekstop=mysql_query("SELECT * FROM tblforwardd INNER JOIN tbluser
	ON tbluser.Id = tblforwardd.UserF 
	INNER JOIN tblmasterdudi
	ON tblmasterdudi.Id = tblforwardd.DudiF
	WHERE tbluser.Id='$Id' AND tblforwardd.Verified = 'S' AND tblforwardd.Confirmed= 'S'");
	$rststop = mysql_fetch_array($cekstop);
	
if ($cek<>'' OR $rststop['Verified']=='S'){
$q=mysql_query("SELECT * FROM tblnilai INNER JOIN tblmastermahasiswa
ON tblmastermahasiswa.NIS = tblnilai.NIS
INNER JOIN tbluser
ON tblmastermahasiswa.NIS = tbluser.KdUser
INNER JOIN tblabsensiswa
ON tblmastermahasiswa.NIS = tblabsensiswa.Nis
WHERE tbluser.Id='$ident'"); 
$dt=mysql_fetch_array($q);
$num = mysql_num_rows($q);
if ($num == NULL) {
header('location:404.php');
exit;
}
?>

<h5>Absensi kehadiran sdr. <?php echo xss_cleaner($dt['NmSiswa']); ?>: </h5><br>
<table class="table table-striped table-bordered table-hover" style="width:700px;margin-left:auto;margin-right:auto;">
<?php $q2=mysql_query("SELECT * FROM tblnilai INNER JOIN tblmastermahasiswa
ON tblmastermahasiswa.NIS = tblnilai.NIS
INNER JOIN tbluser
ON tblmastermahasiswa.NIS = tbluser.KdUser
INNER JOIN tblabsensiswa
ON tblmastermahasiswa.NIS = tblabsensiswa.Nis
WHERE tbluser.Id='$ident' ORDER BY tglabsen ASC"); ?>
<tr><th>NIS</th><th>Nama</th><th>Tanggal</th><th>Alasan</th>
<?php 
$i=0;    // COunter 
while ($dt=mysql_fetch_array($q2)) { ?>
<tr>
<?php if ($i>=1) {?>
<td></td>
<td></td>
<?php } else {?>
<td><?php echo xss_cleaner($dt['NIS']);?></td>
<td><?php echo xss_cleaner($dt['NmSiswa']); }?></td>
<td><?php echo xss_cleaner($dt['TglAbsen']);?></td>
<td><?php echo xss_cleaner($dt['Absensi']);?></td>
<?php $i=$i+1; }?>
<?php } else {
header('location:404.php');
} ?>
</table><br>
</div> 

<div class="line"></div>
</body>
</html>