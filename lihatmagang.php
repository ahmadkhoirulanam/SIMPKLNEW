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
<title>SIPRIN : Sistem Informasi Prakerin - Magang</title>
</head>
<body>
<div class="well">
<?php
$q=mysql_query("SELECT * FROM tbljurusan WHERE Id like '%$_GET[id]%'");
$dt2=mysql_fetch_array($q);
if ($_SESSION['Level']=='kepsek') {
?>
<h5><a href="instansi.php">Data</a> > <b>Daftar Perusahaan</b></h5> <?php } ?>
<h5>Daftar Perusahaan yang berjurusan <?php echo xss_cleaner($dt2['Jur']); ?>: </h5><br>
<table class="table table-striped table-bordered table-hover" style="width:700px;margin-left:auto;margin-right:auto;">
<tr><th>No</th><th>Jurusan</th><th>Lihat Daftar</th>
<?php
$i=1; 
$q=mysql_query("SELECT * FROM tbljurusan INNER JOIN tblmasterdudi
ON tbljurusan.Id = tblmasterdudi.tipe
WHERE tblmasterdudi.tipe like '%$_GET[id]%'");
$num = mysql_num_rows($q);

if ($num==0){
echo "<tr><td colspan=3><div align=center><font color=gray>TIDAK ADA DATA</font></div></td></tr>";
}

while($dt=mysql_fetch_array($q)){
?>
<?php    // COunter 
?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo xss_cleaner($dt['NmDudi']);?></td>
<?php if($dt['magang']<>0){ ?>
<td><a href="lihatsiswamagang.php?id=<?php echo $dt['Id'];?>&jur=<?php echo $dt2['0']?>">Lihat Daftar Mahasiswa</a></td>
<?php } 
else 
{ 
echo "<td>-</td>";
}?>
<?php 
$i=$i+1; } ?>

</table><br>
</div> 

<div class="line"></div>
</body>
</html>
