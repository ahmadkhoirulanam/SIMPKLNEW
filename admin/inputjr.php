<?php error_reporting(0); ?>
<!-- HTML and semi PHP code -->
<?php //here it goes!!
if (isset($_SESSION['Level'])) 
if ($_SESSION['Level']=='admin')
{

?>

<!-- VIEW DATA JURUSAN-->

<?php if (!isset($_GET['a'])) {   
if (isset($_SESSION['notice'])){
echo "<div class='alert alert-info'>" . $_SESSION['notice'] ."</div>";	
unset($_SESSION['notice']);
}
echo "<h3>Input Data Jurusan</h3>";
?>
	<a href="pengaturan.php?v=jr&a=input"><div class="btn">Tambah <span class="icon-plus"></span></div></a>
	<a href="pengaturan.php">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	
	<tr style="background-color:#c3eac8;"><th>NO. ID</th><th>Nama Lengkap</th><th>Singkatan</th><th>Pengaturan</th></tr>
	
	<?php
	$SqlString=mysql_query("SELECT * FROM tbljurusan
	ORDER by Id ASC");
	while($DataJur=mysql_fetch_array($SqlString)) {
	?>
	
	<tr style="background-color:#f7cd89;"><td><?php echo "<font color=crimson><b>" . "$DataJur[0] </font></b>";?></td><td><?php echo xss_cleaner($DataJur['Jur']);?></td><td><?php echo xss_cleaner($DataJur['Sngktn']);?></td>
	<td>
	<a href="pengaturan.php?v=jr&a=edit&id=<?php echo xss_cleaner($DataJur['Id']);?>"><div class="btn btn-warning"><span class="icon-edit"></span></div></a>
	<a href="pengaturan.php?v=jr&a=delete&id=<?php echo xss_cleaner($DataJur['Id']);?>"><div class="btn btn-danger" onClick="Confirm()"><span class="icon-remove"></span></div></a>
	</td>
	</tr>
	<?php 
	}
	}	
?>

<!-- EDIT DATA PEMBIMBING INSTANSI-->

<?php if (isset($_GET['a']) AND isset($_GET['id'])){
if ($_GET['a']=='edit') {

// --------------- PROSES PENGEDITAN DATA FORM ------------------------->
if (isset($_POST['simpanjur'])) {
$SimpanData=mysql_query("UPDATE tbljurusan
SET Jur = '$_POST[jur]',
Sngktn = '$_POST[singkatan]'
WHERE Id = '$_GET[id]'");
$_SESSION['notice']="Berhasil Disimpan!";
header("location:pengaturan.php?v=jr");
}
// ------------------------------------------------------------------->

	$SqlString=mysql_query("SELECT * FROM tbljurusan
	WHERE Id = '$_GET[id]'");
	
	$num = mysql_num_rows($SqlString);
	if ($num==0){
	header('location:404.php');
	exit;
	}
	
echo "<h3>Edit Data Jurusan</h3>";


	while($DataJur=mysql_fetch_array($SqlString)) {
	?>
	<form action="pengaturan.php?v=jr&a=edit&id=<?php echo xss_cleaner($DataJur['Id'])?>" name="simpanjur" method="POST">
	<input type="submit" name="simpanjur" class="btn btn-success" value="Simpan">
	<a href="pengaturan.php?v=jr">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	
	<tr>
	<th>NO. ID</th>
	<td style="background-color:tan;"><?php echo "<font color=crimson><b>" . $DataJur['Id']."</font></b>";?></td>
	</tr>
	<tr><th>Nama Jurusan</th><td><input type="text" style="height:25px;" name="jur" value="<?php echo $DataJur['Jur'];?>"></td></td></tr>
	<tr><th>Singkatan</th><td><input type="text" style="height:25px;" name="singkatan" value="<?php echo $DataJur['Sngktn'];?>"></td></td></tr>
	</form>
	</td></tr></tr>
	<?php 
	} 
	}
	}
?>

<!-- INPUT DATA JURUSAN-->

<?php if (isset($_GET['a'])) { 

if ($_GET['a']=='input') {

	$SqlString=mysql_query("SELECT * FROM tbljurusan
	ORDER BY Id DESC");
	$DataUser=mysql_fetch_array($SqlString);
	
// --------------- PROSES SAVING DATA FORM ------------------------->

if (isset($_POST['inputsimpanjur'])) {
$SimpanData=mysql_query("INSERT INTO tbljurusan (`Id`, `Jur`, `Sngktn`) VALUES ('',
'$_POST[jur]', '$_POST[singkatan]')");
$_SESSION['notice']="Berhasil Disimpan!!";
header("location:pengaturan.php?v=jr");
}
// ------------------------------------------------------------------->
?>

<?php
echo "<h3>Input Data Jurusan</h3>";
?>
	
	<form action="pengaturan.php?v=jr&a=input" name="inputsimpanjur" method="POST">
	<input type="submit" name="inputsimpanjur" class="btn btn-success" value="Simpan">
	<a href="pengaturan.php?v=jr&">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	<tr><th>Nama Jurusan</th><td><input type="text" style="height:25px;" name="jur"></td></td></tr>
	<tr><th>Singkatan</th><td><input type="text" style="height:25px;" name="singkatan"></td></tr>
	</form>
	</td></tr></tr>
	<?php 
	} elseif ($_GET['a']<>'input' AND $_GET['a']<>'delete' AND $_GET['a']<>'edit') {
	header('location:404.php');
	exit;
	}
	}
	
?>

<!-- DELETE DATA JURUSAN-->

<?php if (isset($_GET['a']) AND isset($_GET['id'])) { 
	if ($_GET['a']=='delete') {
	$deletekepsek=mysql_query("DELETE FROM `tbljurusan` WHERE Id = '$_GET[id]'");
	$_SESSION['notice']="Berhasil Dihapus!";
	header('location:pengaturan.php?v=jr');
	} 
	}
?>
	
</table>
<?php 
}
?>
