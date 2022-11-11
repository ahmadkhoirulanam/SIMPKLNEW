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
<title>SIPRIN : Sistem Informasi Prakerin - Presensi</title>
</head>
<body>
<div class="well" style="min-height:340px;">
<?php
if ($_SESSION['Level']=='pembimbingdudi') {
if (!isset($_GET['id'])){
$ident=$Id;
}
else
{
$ident=$_GET['id'];
}
$date=date('Y-m-d');

$q=mysql_query("SELECT * FROM tbluser INNER JOIN tblmastermahasiswa
ON tblmastermahasiswa.NIS = tbluser.KdUser
WHERE tbluser.Id='$ident'");
$sis=mysql_fetch_array($q);
$link = $sis[0];
$tgl = date('Y-m-d');
if (isset($_POST['insert'])) {
$ABSENSI = mysql_query("INSERT INTO `tblabsensiswa` (`Id`, `Nis`, `NmSiswa`, `TglAbsen`, `Absensi`, `absent`) VALUES (NULL, '$sis[NIS]', '$sis[NmSiswa]', '$tgl', '$_POST[alasan]', 'Absent');");
header('location:callaroll.php?id=' . $link);
}

if (isset($_SESSION['notice'])) {
?> 
<div class="alert alert-info"><?php echo $_SESSION['notice'];?></div>

<?php } ?>

<h5>Absensi kehadiran sdr. <?php echo xss_cleaner($sis['NmSiswa']); ?>: </h5><br>
<table class="table table-striped table-bordered" style="width:700px;margin-left:auto;margin-right:auto;">
<tr><th>NIS</th><th>Nama</th><th>Tanggal</th><th>Status</th>

<?php 
unset($_SESSION['notice']);
$i=0;    // COunter 
$q2=mysql_query("SELECT * FROM tblnilai INNER JOIN tblmastermahasiswa
ON tblmastermahasiswa.NIS = tblnilai.NIS
INNER JOIN tbluser
ON tblmastermahasiswa.NIS = tbluser.KdUser
INNER JOIN tblabsensiswa
ON tblmastermahasiswa.NIS = tblabsensiswa.Nis
WHERE tbluser.Id='$ident'");
$num=mysql_num_rows($q2);
if ($num==NULL){
$q2=mysql_query("SELECT * FROM tbluser INNER JOIN tblmastermahasiswa
ON tblmastermahasiswa.NIS = tbluser.KdUser
WHERE tbluser.Id='$ident'");
}
while ($dt=mysql_fetch_array($q2)){ ?>
<tr>
<?php if($i==0) { ?>
<td><?php echo xss_cleaner($dt['NIS']);?></td>
<td><?php echo xss_cleaner($dt['NmSiswa']);?></td>
<?php } else { ?>
<td colspan='2' ><div align=center>-</div></td>
<?php } 
if ($dt['TglAbsen']<>'') {?>
<td><?php echo xss_cleaner($dt['TglAbsen']);?></td>
<td><?php echo xss_cleaner($dt['Absensi']);?></td>
<?php $i=$i+1;
} else {echo "<td colspan=2><div align=center>-</div></td>"; }
} 
?>
 
</table><br>
<?php
$desc=mysql_query("SELECT * FROM tblnilai INNER JOIN tblmastermahasiswa
ON tblmastermahasiswa.NIS = tblnilai.NIS
INNER JOIN tbluser
ON tblmastermahasiswa.NIS = tbluser.KdUser
INNER JOIN tblabsensiswa
ON tblmastermahasiswa.NIS = tblabsensiswa.Nis
WHERE tbluser.Id='$ident' ORDER BY tblabsensiswa.Id DESC");
$dtz=mysql_fetch_array($desc);

if ($dtz['TglAbsen']<>date('Y-m-d')) { ?>
Hari ini: <?php echo date("Y-m-d");?>
<br>Apakah <b><?php echo xss_cleaner($sis['NmSiswa'])?></b> hadir di kantor untuk hari ini?
<form name="form1" action="callaroll.php?id=<?php echo $sis[0];?>" method="POST">
<br>
<input type="radio" checked name="alasan" value="Hadir"> Hadir 
<input type="radio" name="alasan" value="Sakit"> Sakit 
<input type="radio" name="alasan" value="Izin"> Izin  
<input type="radio" name="alasan" value="Lainnya"> Lainnya 
<br><br>
<input type="submit" name="insert" value="Kirim"
 class="btn btn-primary">
</form>
<?php } else { ?>
<b>Siswa sudah absen hari ini</b>
 <?php }
} else {
header('location:404.php');
} ?>
</div> 

<div class="line"></div>
</body>
</html>