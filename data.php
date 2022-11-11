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
<title>SIPRIN : Sistem Informasi Prakerin - Data</title>
</head>
<body>
<div class="well">
<h5>Nilai Prakerin Siswa: </h5><br>
<table class="table table-striped table-bordered table-hover" style="width:700px;margin-left:auto;margin-right:auto;">
<tr><th>NIS</th><th>Nama</th><th>Jurusan</th><th>Nilai A</th><th>Nilai B</th><th>Nilai C</th><th>Nilai D</th>
<?php
$q=mysql_query("SELECT * FROM tblnilai INNER JOIN tblmastermahasiswa
ON tblmastermahasiswa.NIS = tblnilai.NIS
INNER JOIN tbluser
ON tblmastermahasiswa.NIS = tbluser.KdUser
INNER JOIN tbljurusan
ON tbljurusan.Id = tblmastermahasiswa.Jur
ORDER BY tblmastermahasiswa.Jur ASC");
while($dt=mysql_fetch_array($q)){
?>

<?php 
$i=0;    // COunter 
?>
<tr>
<td><?php echo xss_cleaner($dt['NIS']);?></td>
<td><?php echo xss_cleaner($dt['NmSiswa']);?></td>
<td><?php echo xss_cleaner($dt['Jur']);?></td>
<td><?php echo xss_cleaner($dt['NilaiA']);?></td>
<td><?php echo xss_cleaner($dt['NilaiB']);?></td>
<td><?php echo xss_cleaner($dt['NilaiC']);?></td>
<td><?php echo xss_cleaner($dt['NilaiD']);?></td>
<?php 
}?>

 
</table><br>
</div> 

<div class="line"></div>
</body>
</html>