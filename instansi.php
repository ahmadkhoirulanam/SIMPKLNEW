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
<title>SIPRIN : Sistem Informasi Prakerin - Instansi</title>
</head>
<body>
<div class="well">
<h5>Nilai Prakerin Siswa: </h5><br>
<table class="table table-striped table-bordered table-hover" style="width:700px;margin-left:auto;margin-right:auto;">
<tr><th>No</th><th>Jurusan</th><th>Lihat Daftar</th>
<?php
$i=1; 
$q=mysql_query("SELECT * FROM tbljurusan");
while($dt=mysql_fetch_array($q)){
?>
<?php    // COunter 
?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo xss_cleaner($dt['Jur']);?></td>
<td><a href="lihatmagang.php?id=<?php echo xss_cleaner($dt['Id']);?>">Lihat Daftar Perusahaan</a></td>
<?php 
$i=$i+1; } ?>

</table><br>
</div> 

<div class="line"></div>
</body>
</html>