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
<title>SIPRIN : Sistem Informasi Prakerin - Kelompok Kerja</title>
</head>
<body>
<div class="well"  style="min-height:330px;">
<?php
if ($_SESSION['Level']=='pokja') {
if (isset($_SESSION['notice'])){ ?>
	<br>
	<div class="alert alert-danger"><?php echo $_SESSION['notice'];?></div>
	<?php }
	unset($_SESSION['notice']);

	$query=mysql_query("SELECT * FROM tblpermohonan INNER JOIN tbluser
	ON tblpermohonan.Nama = tbluser.Id 
	INNER JOIN tblmastermahasiswa
	ON tblmastermahasiswa.NIS = tbluser.KdUser
	INNER JOIN tblmasterdudi 
	ON tblpermohonan.Dudi = tblmasterdudi.Id ORDER BY tblpermohonan.Id DESC");
?>
<table class="table table-striped table-bordered table-hover" style="width:700px;margin-left:auto;margin-right:auto;">
<tr><th>No</th><th>Permohonan</th><th>Action</th>
<?php 
$i=0;
$qtest=mysql_num_rows($query);
if ($qtest==0){
echo "<tr><td colspan=3><font color='grey'><div align=center>TIDAK ADA PERMOHONAN</div></font></td></tr>";
}
while ($data=mysql_fetch_array($query))
{ 
?>

<tr><td><?php $i=$i+1; echo $i; ?> </td>
<td><b><?php echo xss_cleaner($data['NmSiswa']);?></b> mengirim permohonan Prakerin di <b><?php echo xss_cleaner($data['NmDudi']);?></b><br><div class="help-block" style="font-size:12;"><?php echo xss_cleaner($data['Stamp']);?></div></td>
<td><a href="terima.php?id=<?php echo $data['0']; ?>"><div class="btn btn-primary"><span class="icon-hdd"></span> Terima</div></a>  <a href="tolak.php?id=<?php echo $data['0']; ?>"><div class="btn btn-danger"><span class="icon-hdd"></span> Tolak</div></a></td>
<?php } } else {
header('location:404.php');
}?>
</table>
</div> 
<div class="line"></div>
</body>
</html>