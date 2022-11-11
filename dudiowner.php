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
<title>SIPRIN : Sistem Informasi Prakerin - DU/DI</title>
</head>
<body>
<div class="well"  style="min-height:330px;">
<?php
if (isset($_SESSION['notice'])){ 
if (isset($_SESSION['alert'])) {
if ($_SESSION['alert']=='danger') {
$alert = "danger";
} elseif ($_SESSION['alert']=='success') {
$alert = "success";
}
} else {
$alert = "info";
}
?>
	<br>
	<div class="alert alert-<?php echo $alert; ?>"><?php echo $_SESSION['notice'];?></div>
	<?php }
	unset($_SESSION['notice']);
	unset($_SESSION['alert']);
	
if ($_SESSION['Level']=='dudiowner') {
?>
<table class="table table-striped table-bordered table-hover" style="width:700px;margin-left:auto;margin-right:auto;">
<tr><th>No</th><th>Permohonan</th><th>Action</th>

<?php 
$i=0;
$query=mysql_query("SELECT * FROM tblforwardd INNER JOIN tbluser
	ON tblforwardd.UserF = tbluser.Id 
	INNER JOIN tblmasterdudi 
	ON tblforwardd.DudiF = tblmasterdudi.Id 
	INNER JOIN tblmastermahasiswa
	ON tblmastermahasiswa.NIS = tbluser.KdUser
	INNER JOIN tbljurusan
	ON tbljurusan.Id = tblmastermahasiswa.Jur
	WHERE tblmasterdudi.KdOwner='$Id' AND tblforwardd.Verified='F'
	ORDER BY tblforwardd.IdF DESC");

$query2=mysql_query("SELECT * FROM tblforwardd INNER JOIN tbluser
	ON tblforwardd.UserF = tbluser.Id 
	INNER JOIN tblmasterdudi 
	ON tblforwardd.DudiF = tblmasterdudi.Id 
	INNER JOIN tblmastermahasiswa
	ON tblmastermahasiswa.NIS = tbluser.KdUser
	INNER JOIN tbljurusan
	ON tbljurusan.Id = tblmastermahasiswa.Jur
	WHERE tblmasterdudi.KdOwner='$Id' AND tblforwardd.Verified='F'
	ORDER BY tblforwardd.IdF DESC");

$i=0;    // COunter
$num = mysql_num_rows($query);
$magang = mysql_fetch_array($query2);
if ($num==0 or $magang['magang']>=$magang['dayatampung']) {
echo "<tr><td colspan=3><div align=center style=color:gray>TIDAK ADA DATA</div></td></tr>";
$deletecurrent = mysql_query("DELETE FROM tblforwardd WHERE DudiF = '$rst[0]' AND Verified = 'F'");
$_SESSION['alert']='danger';
$_SESSION['notice']='Daya tampung siswa prakerin dari perusahaan Anda sudah penuh';
} else {
while ($data=mysql_fetch_array($query))
{ 
?>

<tr><td><?php $i=$i+1; echo $i; ?> </td>
<td><b><a href="profil.php?id=<?php echo xss_cleaner($data['UserF'])?>&lvl=siswa"><?php echo xss_cleaner($data['NmSiswa']);?></a></b> mengirim permohonan prakerin di <b><?php echo xss_cleaner($data['NmDudi']);?> </b>dengan jurusan <b><?php echo xss_cleaner($data['Jur']);?></b><br><div class="help-block" style="font-size:12;"><?php echo $data['TimestampF'];?></div></td>
<td><a href="terimaf.php?id=<?php echo $data['0']; ?>"><div class="btn btn-primary"><span class="icon-hdd"></span> Terima</div></a>  <a href="tolakf.php?id=<?php echo $data['0']; ?>"><div class="btn btn-danger"><span class="icon-hdd"></span> Tolak</div></a></td>
<?php } } } else {
header('location:404.php');
}?>
</table>
</div> 
<div class="line"></div>
</body>
</html>
<?php

	unset($_SESSION['notice']);
?>