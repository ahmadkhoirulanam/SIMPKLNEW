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
<title>SIPRIN : Sistem Informasi Prakerin - Nilai</title>
</head>
<body>
<div class="well">
<?php
if (!isset($_GET['id'])){
$ident=$Id;
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

$q=mysql_query("SELECT * FROM tblnilai INNER JOIN tblmastermahasiswa
ON tblmastermahasiswa.NIS = tblnilai.NIS
INNER JOIN tbluser
ON tblmastermahasiswa.NIS = tbluser.KdUser
WHERE tbluser.Id='$ident'");
$dt=mysql_fetch_array($q);
$num = mysql_num_rows($q);

if ($num == NULL) {
header('location:404.php');
exit;
}
?>
<?php if ($cek<>'' OR $rststop['Verified']=='S'){
if (isset($_SESSION['notice'])){ ?>
	<br>
	<div class="alert alert-info"><?php echo $_SESSION['notice'];?></div>
	<?php }
	unset($_SESSION['notice']);
	?>
<h5>Nilai selama Prakerin di <?php 
if ($rststop['Verified']=='S') {
echo xss_cleaner($rststop['NmDudi']); 
} elseif ($rst['Verified']=='T') { 
echo xss_cleaner($rst['NmDudi']); 
}
?>: </h5>
<?php if ($_SESSION['Level']=='pembimbingdudi') {?>
<a href="inputnilai.php?id=<?php echo xss_cleaner($dt['Id'])?>"><div class="btn">Input Nilai <span class="icon-edit"></span></div></a>
<?php } ?>
<br><br>
<table class="table table-bordered" style="width:700px;margin-left:auto;margin-right:auto;">
<tr bgcolor="lightblue"><th>NIS</th><th>Nama</th><th>Nilai A</th><th>Nilai B</th><th>Nilai C</th><th>Nilai D</th>

<?php 
$i=0;    // COunter 
if ($num == NULL) {
echo "<tr><td colspan=6><div align=center><font color=gray>TIDAK ADA DATA</font></div></td></tr>";
}
?>
<tr bgcolor="white">
<td><?php echo xss_cleaner($dt['NIS']);?></td>
<td><?php echo xss_cleaner($dt['NmSiswa']);?></td>
<td><?php echo xss_cleaner($dt['NilaiA']);?></td>
<td><?php echo xss_cleaner($dt['NilaiB']);?></td>
<td><?php echo xss_cleaner($dt['NilaiC']);?></td>
<td><?php echo xss_cleaner($dt['NilaiD']);?></td>
<?php 
?>

 
</table><br>
<?php if ($num <> NULL) { ?>
*Nilai akan diinput oleh Pembimbing DU/DI siswa yang bersangkutan
<?php } } else {
echo "Maaf, Anda belum boleh melihat isi konten halaman ini";
} ?>
</div> 

<div class="line"></div>
</body>
</html>