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
<title>SIPRIN : Sistem Informasi Prakerin - Input Nilai</title>
</head>
<body>
<div class="well" style="min-height:330px;">
<?php
if ($_SESSION['Level']=='pembimbingdudi') {
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

$q=mysql_query("SELECT * FROM tblnilai INNER JOIN tblmastermahasiswa
ON tblmastermahasiswa.NIS = tblnilai.NIS
INNER JOIN tbluser
ON tblmastermahasiswa.NIS = tbluser.KdUser
WHERE tbluser.Id='$ident'");
$dt=mysql_fetch_array($q);
$num = mysql_num_rows($q);
if ($num==NULL) {
header('location:404.php');
}
?>
<?php if ($cek<>''){?>
<form name="form" action="inputnilai.php?id=<?php echo xss_cleaner($dt['Id'])?>" method="POST">
<h5>Nilai selama Prakerin di <?php echo xss_cleaner($rst['NmDudi']); ?>: </h5><br>
<table class="table table-striped table-bordered" style="width:700px;margin-left:auto;margin-right:auto;">
<tr><td>NIS</td><td><?php echo xss_cleaner($dt['NIS']);?></td>
<tr><td>Nama</td><td><?php echo xss_cleaner($dt['NmSiswa']);?></td>
<tr><td>Nilai A</td><td><input type="text" style="height:25px;" name="A" value="<?php echo xss_cleaner($dt['NilaiA']);?>"></td>
<tr><td>Nilai B</td><td><input type="text" style="height:25px;" name="B" value="<?php echo xss_cleaner($dt['NilaiB']);?>"></td>
<tr><td>Nilai C</td><td><input type="text" style="height:25px;" name="C" value="<?php echo xss_cleaner($dt['NilaiC']);?>"></td>
<tr><td>Nilai D</td><td><input type="text" style="height:25px;" name="D" value="<?php echo xss_cleaner($dt['NilaiD']);?>"></td></tr>


</table><br>
<input class="btn btn-success" type="submit" name="input" value="Simpan Data">
</form>
<?php
if (isset($_POST['A']))
{
$q2=mysql_query("SELECT * FROM tblnilai INNER JOIN tblmastermahasiswa
ON tblmastermahasiswa.NIS = tblnilai.NIS
INNER JOIN tbluser
ON tblmastermahasiswa.NIS = tbluser.KdUser
WHERE tbluser.Id='$ident'");
$dt2=mysql_fetch_array($q2);
$A=$_POST['A'];
$B=$_POST['B'];
$C=$_POST['C'];
$D=$_POST['D'];
$ins=mysql_query("UPDATE `tblnilai` SET `NilaiA` = '$A',
`NilaiB` = '$B',
`NilaiC` = '$C',
`NilaiD` = '$D' WHERE `tblnilai`.`Nis` = '$dt2[NIS]'");
$usr=$_GET['id'];
$_SESSION['notice']='Berhasil di input!';
header('location:nilai.php?id=' . $usr);
}
?>



<?php } else {
header('location:404.php');
}
} else {
header('location:404.php');
} ?>
</div> 

<div class="line"></div>
</body>
</html>
