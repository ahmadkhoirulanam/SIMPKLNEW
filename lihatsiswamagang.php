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
<title>SIPRIN : Sistem Informasi Prakerin - Daftar Pemagang</title>
</head>
<body>
<div class="well">
<?php
?>
<?php
$qdudi=mysql_query("SELECT * FROM tblmasterdudi
WHERE tblmasterdudi.Id = '$_GET[id]'");
$rst=mysql_fetch_array($qdudi);
$qjur=mysql_query("SELECT * FROM tbljurusan
WHERE tbljurusan.Id = '$_GET[jur]'");
$rst2=mysql_fetch_array($qjur);
 if ($_SESSION['Level']=='kepsek') {?>
<h5><a href="instansi.php">Data</a> > <a href="lihatmagang.php?id=<?php echo xss_cleaner($_GET['jur'])?>">Daftar Perusahaan</a> > <b>Daftar Mahasiswa</b></h5> 
<?php } ?>
<h5>Daftar Mahasiswa PKL di <a href="profil.php?id=<?php echo $rst['0'];?>&lvl=dudiowner"><?php echo xss_cleaner($rst['NmDudi']); ?></a> jurusan <?php echo xss_cleaner($rst2['Jur']); ?> : </h5><br>
<table class="table table-striped table-bordered table-hover" style="width:700px;margin-left:auto;margin-right:auto;">
<tr><th>No</th><th>NIS</th><th>Nama</th><th>Kelas</th>
<?php
$i=1; 
$q=mysql_query("SELECT * FROM tblforwardd
INNER JOIN tbluser
ON tbluser.Id=tblforwardd.UserF
INNER JOIN tblmastermahasiswa
ON tbluser.KdUser=tblmastermahasiswa.NIS
INNER JOIN tblmasterdudi
ON tblmasterdudi.Id=tblforwardd.DudiF
INNER JOIN tbljurusan
ON tbljurusan.Id = tblmastermahasiswa.Jur
WHERE tblforwardd.DudiF = '$_GET[id]' AND tbljurusan.Id = '$_GET[jur]' 
ORDER BY Kls");
$cek=mysql_num_rows($q);
if ($cek=='0') {
?> <tr><td colspan="4"><div align="center"><font color="gray">BELUM ADA DATA PESERTA</font></div></td></tr><?php }
while($dt=mysql_fetch_array($q)){
?>
<?php    // COunter 

?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo xss_cleaner($dt['NIS']);?></td>
<td><a href="profil.php?id=<?php echo $dt['UserF'];?>&lvl=<?php echo xss_cleaner($dt['Level']); ?>"><?php echo xss_cleaner($dt['NmSiswa']);?></a></td>
<td><?php echo xss_cleaner($dt['Kls']);?></td>
<?php 
$i=$i+1; } ?>

</table><br>
</div> 

<div class="line"></div>
</body>
</html>
