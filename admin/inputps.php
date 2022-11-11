<?php error_reporting(0); ?>
<!-- HTML and semi PHP code -->
<?php //here it goes!!
if (isset($_SESSION['Level'])) 
if ($_SESSION['Level']=='admin')
{

?>

<!-- VIEW DATA KEPALA SEKOLAH-->

<?php if (!isset($_GET['a'])) {   
if (isset($_SESSION['notice'])){
echo "<div class='alert alert-info'>" . $_SESSION['notice'] ."</div>";	
unset($_SESSION['notice']);
}
echo "<h3>Input Data Kepala Sekolah</h3>";
?>
	<a href="pengaturan.php?v=ps&a=input"><div class="btn">Tambah <span class="icon-plus"></span></div></a>
	<a href="pengaturan.php">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	
	<tr style="background-color:#c3eac8;"><th>NIP / USR</th><th>Nama Lengkap</th><th>Username</th><th>Password</th><th>Pengaturan</th></tr>
	
	<?php
	$SqlString=mysql_query("SELECT * FROM tbluser
	INNER JOIN tblkepsek
	ON tbluser.KdUser = tblkepsek.NIP
	WHERE Level = 'kepsek'
	ORDER BY CAST(SUBSTRING(Id, 4) AS UNSIGNED) ASC");
	while($DataKepsek=mysql_fetch_array($SqlString)) {
	?>
	
	<tr style="background-color:#f7cd89;"><td><?php echo "<font color=crimson><b>" . xss_cleaner($DataKepsek['KdUser']). " / " . "$DataKepsek[0] </font></b>";?></td><td><?php echo xss_cleaner($DataKepsek['Nama']);?></td><td><?php echo xss_cleaner($DataKepsek['Username']);?></td><td><?php echo xss_cleaner($DataKepsek['Password']);?></td>
	<td>
	<a href="pengaturan.php?v=ps&a=edit&nip=<?php echo xss_cleaner($DataKepsek['KdUser']);?>"><div class="btn btn-warning"><span class="icon-edit"></span></div></a>
	<a href="pengaturan.php?v=ps&a=delete&nip=<?php echo xss_cleaner($DataKepsek['KdUser']);?>"><div class="btn btn-danger" onClick="Confirm()"><span class="icon-remove"></span></div></a>
	</td>
	</tr>
	<?php 
	}
	}	
?>

<!-- EDIT DATA PEMBIMBING INSTANSI-->

<?php if (isset($_GET['a']) AND isset($_GET['nip'])){
if ($_GET['a']=='edit') {
$encrypted=e($_POST['password']);

// --------------- PROSES PENGEDITAN DATA FORM ------------------------->
if (isset($_POST['simpankepsek'])) {
$SimpanData=mysql_query("UPDATE tbluser
INNER JOIN tblkepsek
ON tbluser.KdUser = tblkepsek.NIP
SET Nama = '$_POST[nama]',
Username = '$_POST[username]',
Password = '$encrypted'
WHERE tblkepsek.NIP = '$_GET[nip]'");
$_SESSION['notice']="Berhasil Disimpan!";
header("location:pengaturan.php?v=ps");
}
// ------------------------------------------------------------------->


	$SqlString=mysql_query("SELECT * FROM tbluser 
	INNER JOIN tblkepsek
	ON tbluser.KdUser = tblkepsek.NIP
	WHERE tblkepsek.NIP= '$_GET[nip]'");
	
	$num = mysql_num_rows($SqlString);
	if ($num==0){
	header('location:404.php');
	exit;
	}
	

echo "<h3>Edit Data Kepala Sekolah</h3>";

	while($DataKepsek=mysql_fetch_array($SqlString)) {
	?>
	<form action="pengaturan.php?v=ps&a=edit&nip=<?php echo xss_cleaner($DataKepsek['NIP'])?>" name="simpankepsek" method="POST">
	<input type="submit" name="simpankepsek" class="btn btn-success" value="Simpan">
	<a href="pengaturan.php?v=ps">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	
	<tr>
	<th>NIP / USR</th>
	<td style="background-color:tan;"><?php echo "<font color=crimson><b>" . $DataKepsek['NIP'] . " / " .$DataKepsek['0']."</font></b>";?></td>
	</tr>
	<tr><th>Nama Lengkap</th><td><input type="text" style="height:25px;" name="nama" value="<?php echo xss_cleaner($DataKepsek['Nama']);?>"></td></td></tr>
	<tr><th>Nama User</th><td><input type="text" style="height:25px;" name="username" value="<?php echo xss_cleaner($DataKepsek['Username']);?>"></td></tr>
	<tr><th>Kata Sandi</th><td><input type="text" style="height:25px;" name="password" value="<?php echo xss_cleaner(d($DataKepsek['Password']));?>"></td></tr>
	</form>
	</td></tr></tr>
	<?php 
	} 
	}
	}
?>

<!-- INPUT DATA PEMBIMBING INSTANSI-->

<?php if (isset($_GET['a'])) { 

if ($_GET['a']=='input') {

	$SqlString=mysql_query("SELECT * FROM tbluser
	ORDER BY CAST(SUBSTRING(Id, 4) AS UNSIGNED) DESC");
	$DataUser=mysql_fetch_array($SqlString);
	$UserId = "USR" . (substr($DataUser['Id'], 3) + 1);
	
// --------------- PROSES SAVING DATA FORM ------------------------->

if (isset($_POST['inputsimpankepsek'])) {
$CekRow = mysql_query("SELECT * FROM tblkepsek");
$NumRow = mysql_num_rows($CekRow);
if ($NumRow<>0) {
$_SESSION['notice']='Maaf, Anda tidak dapat menginput Data Kepala Sekolah lebih dari satu';
header("location:pengaturan.php?v=ps");
} else {
$encrypted=e($_POST['password']);
$SimpanData=mysql_query("INSERT INTO tblkepsek (`NIP`, `Nama`) VALUES ('$_POST[nip]',
'$_POST[nama]')");
$SimpanDataUser=mysql_query("INSERT INTO tbluser (`Id`, `Username`, `Password`, `Level`, `AktifUser`, `KdUser`) VALUES ('$UserId',
'$_POST[username]',
'$encrypted',
'kepsek',
'n',
'$_POST[nip]')");
$_SESSION['notice']="Berhasil Disimpan!!";
header("location:pengaturan.php?v=ps");

}
}
// ------------------------------------------------------------------->
?>

<?php
echo "<h3>Input Data Kepala Sekolah</h3>";
?>
	
	<form action="pengaturan.php?v=ps&a=input" name="inputsimpankepsek" method="POST">
	<input type="submit" name="inputsimpankepsek" class="btn btn-success" value="Simpan">
	<a href="pengaturan.php?v=ps&">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	
	<tr>
	<th>NIP / USR</th>
	<td style="background-color:orange;"><?php echo "<input type=text style=height:25px; name=nip style='width:170px'> / " .$UserId  ."<font></b>";?></td>
	</tr>
	<tr><th>Nama Lengkap</th><td><input type="text" style="height:25px;" name="nama"></td></td></tr>
	<tr><th>Nama User</th><td><input type="text" style="height:25px;" name="username"></td></tr>
	<tr><th>Kata Sandi</th><td><input type="text" style="height:25px;" name="password"></td></tr>
	</form>
	</td></tr></tr>
	<?php 
	} elseif ($_GET['a']<>'input' AND $_GET['a']<>'delete' AND $_GET['a']<>'edit') {
	header('location:404.php');
	exit;
	}
	}
	
?>

<!-- DELETE DATA KEPALA SEKOLAH-->

<?php if (isset($_GET['a']) AND isset($_GET['nip'])) { 
	if ($_GET['a']=='delete') {
	$deletekepsek=mysql_query("DELETE FROM `tblkepsek` WHERE `tblkepsek`.`NIP` = '$_GET[nip]'");
	$deleteuser=mysql_query("DELETE FROM tbluser 
	WHERE tbluser.KdUser ='$_GET[nip]'");
	$_SESSION['notice']="Berhasil Dihapus!";
	header('location:pengaturan.php?v=ps');
	} 
	}
?>
	
</table>
<?php 
}
?>
