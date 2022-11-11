<?php error_reporting(0); ?>
<!-- HTML and semi PHP code -->
<?php //here it goes!!
if (isset($_SESSION['Level'])) 
if ($_SESSION['Level']=='admin')
{

?>

<!-- VIEW DATA PEMBIMBING-->

<?php if (!isset($_GET['a'])) {   
if (isset($_SESSION['notice'])){
echo "<div class='alert alert-info'>" . $_SESSION['notice'] ."</div>";	
unset($_SESSION['notice']);
}
echo "<h3>Input Data Pembimbing Sekolah</h3>";
?>
	<a href="pengaturan.php?v=ks&a=input"><div class="btn">Tambah <span class="icon-plus"></span></div></a>
	<a href="pengaturan.php">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	
	<tr style="background-color:#c3eac8;"><th>NIP/USR</th><th>Nama Lengkap</th><th>Username</th><th>Password</th><th>Alamat</th><th>No. Telp</th><th>Pengaturan</th></tr>
	
	<?php
	$SqlString=mysql_query("SELECT * FROM tbluser
	INNER JOIN tblmasterpembimbing
	ON tbluser.KdUser = tblmasterpembimbing.NIP
	WHERE Level = 'pembimbing'
	ORDER BY CAST(SUBSTRING(Id, 3) AS UNSIGNED) ASC");
	while($DataPemb=mysql_fetch_array($SqlString)) {
	?>
	
	<tr style="background-color:#f7cd89;"><td><?php echo "<font color=crimson><b>" . $DataPemb['NIP']. " / " . "$DataPemb[Id] </font></b>";?></td><td><?php echo xss_cleaner($DataPemb['NmPmbgI']);?></td><td><?php echo xss_cleaner($DataPemb['Username']);?></td><td><?php echo xss_cleaner($DataPemb['Password']);?></td><td><i><?php echo xss_cleaner($DataPemb['Almt']);?></i></td><td>+62<?php echo xss_cleaner($DataPemb['NoTelp']);?></td>
	<td>
	<a href="pengaturan.php?v=ks&a=edit&nip=<?php echo xss_cleaner($DataPemb['NIP']);?>"><div class="btn btn-warning"><span class="icon-edit"></span></div></a>
	<a href="pengaturan.php?v=ks&a=delete&nip=<?php echo xss_cleaner($DataPemb['NIP']);?>"><div class="btn btn-danger" onClick="Confirm()"><span class="icon-remove"></span></div></a>
	</td>
	</tr>
	<?php 
	}
	}	
?>

<!-- EDIT DATA PEMBIMBING-->

<?php if (isset($_GET['a']) AND isset($_GET['nip'])){
if ($_GET['a']=='edit') {

// --------------- PROSES PENGEDITAN DATA FORM ------------------------->
if (isset($_POST['simpanpembimbing'])) {
$encrypted = e($_POST['password']);
$SimpanData=mysql_query("UPDATE tbluser
INNER JOIN tblmasterpembimbing
ON tbluser.KdUser = tblmasterpembimbing.NIP
SET NmPmbgI = '$_POST[nama]',
Username = '$_POST[username]',
Password = '$encrypted',
Almt = '$_POST[alamat]',
NoTelp = '$_POST[telp]'
WHERE tblmasterpembimbing.NIP = '$_GET[nip]'");
$_SESSION['notice']="Berhasil Disimpan!";
header("location:pengaturan.php?v=ks");
}
// ------------------------------------------------------------------->


	$SqlString=mysql_query("SELECT * FROM tbluser 
	INNER JOIN tblmasterpembimbing 
	ON tbluser.KdUser = tblmasterpembimbing.NIP
	WHERE tblmasterpembimbing.NIP= '$_GET[nip]'");
	
	$num = mysql_num_rows($SqlString);
	if ($num==0){
	header('location:404.php');
	exit;
	}

echo "<h3>Edit Data Pembimbing Sekolah</h3>";	
	
	while($DataPemb=mysql_fetch_array($SqlString)) {
	?>
	<form action="pengaturan.php?v=ks&a=edit&nip=<?php echo xss_cleaner($DataPemb['NIP'])?>" name="simpanpembimbing" method="POST">
	<input type="submit" name="simpanpembimbing" class="btn btn-success" value="Simpan">
	<a href="pengaturan.php?v=ks">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	
	<tr>
	<th>NO. ID / USR</th>
	<td style="background-color:tan;"><?php echo "<font color=crimson><b>" . $DataPemb['Id'] . " / " .$DataPemb['0']."</font></b>";?></td>
	</tr>
	<tr><th>Nama Lengkap</th><td><input type="text" style="height:25px;" name="nama" value="<?php echo xss_cleaner($DataPemb['NmPmbgI']);?>"></td></td></tr>
	<tr><th>Nama User</th><td><input type="text" style="height:25px;" name="username" value="<?php echo xss_cleaner($DataPemb['Username']);?>"></td></tr>
	<tr><th>Kata Sandi</th><td><input type="text" style="height:25px;" name="password" value="<?php echo xss_cleaner(d($DataPemb['Password']));?>"></td></tr>
	<tr><th>Alamat</th><td><textarea name="alamat"><?php echo xss_cleaner($DataPemb['Almt']);?></textarea></td></td></tr>
	<tr><th>No. Telp</th><td>+62<input type="text" style="height:25px;" name="telp" value="<?php echo xss_cleaner($DataPemb['NoTelp']);?>"></td></td></tr>
	</form>
	</td></tr></tr>
	<?php 
	} 
	}
	}
?>

<!-- INPUT DATA PEMBIMBING-->

<?php if (isset($_GET['a'])) { 
if ($_GET['a']=='input') {

	$SqlString=mysql_query("SELECT * FROM tbluser
	ORDER BY CAST(SUBSTRING(Id, 4) AS UNSIGNED) DESC");
	$DataUser=mysql_fetch_array($SqlString);
	$UserId = "USR" . (substr($DataUser['Id'], 3) + 1);
	
// --------------- PROSES SAVING DATA FORM ------------------------->

if (isset($_POST['inputsimpanpembimbing'])) {
$encrypted=e($_POST['password']);
$SimpanData=mysql_query("INSERT INTO tblmasterpembimbing (`NIP`, `NmPmbgI`, `Almt`, `NoTelp`) VALUES ('$_POST[nip]',
'$_POST[nama]', '$_POST[alamat]', '$_POST[telp]')");
$SimpanDataUser=mysql_query("INSERT INTO tbluser (`Id`, `Username`, `Password`, `Level`, `AktifUser`, `KdUser`) VALUES ('$UserId',
'$_POST[username]',
'$encrypted',
'pembimbing',
'n',
'$_POST[nip]')");
$_SESSION['notice']="Berhasil Disimpan!!";
header("location:pengaturan.php?v=ks");
}
// ------------------------------------------------------------------->
?>

<?php
echo "<h3>Input Data Pembimbing Sekolah</h3>";
?>
	
	<form action="pengaturan.php?v=ks&a=input" name="inputsimpanpembimbing" method="POST">
	<input type="submit" name="inputsimpanpembimbing" class="btn btn-success" value="Simpan">
	<a href="pengaturan.php?v=ks&">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	
	<tr>
	<th>NO. ID / USR</th>
	<td style="background-color:orange;"><?php echo "<font color=crimson><b><input type=text style=height:25px; name=nip style='width:150px'> / " .$UserId  ."<font></b>";?></td>
	</tr>
	<tr><th>Nama Lengkap</th><td><input type="text" style="height:25px;" name="nama"></td></td></tr>
	<tr><th>Nama User</th><td><input type="text" style="height:25px;" name="username"></td></tr>
	<tr><th>Kata Sandi</th><td><input type="text" style="height:25px;" name="password"></td></tr>
	<tr><th>Alamat</th><td><textarea type="text" name="alamat"></textarea></td></tr>
	<tr><th>No. Telp</th><td>+62<input type="text" style="height:25px;" name="telp"></td></tr>
	</form>
	</td></tr></tr>
	<?php 
	} elseif ($_GET['a']<>'input' AND $_GET['a']<>'delete' AND $_GET['a']<>'edit') {
	header('location:404.php');
	exit;
	}
	}
	
?>

<!-- DELETE DATA POKJA-->

<?php if (isset($_GET['a']) AND isset($_GET['nip'])) { 
	if ($_GET['a']=='delete') {
	$deletepoja=mysql_query("DELETE FROM `tblmasterpembimbing` WHERE `tblmasterpembimbing`.`NIP` = '$_GET[nip]'");
	$deleteuser=mysql_query("DELETE FROM tbluser 
	WHERE tbluser.KdUser ='$_GET[nip]'");
	$updateforwardd=mysql_query("UPDATE tblforwardd 
	SET PembimbingS = '' 
	WHERE PembimbingS ='$_GET[nip]'");
	$_SESSION['notice']="Berhasil Dihapus!";
	header('location:pengaturan.php?v=ks');
	} 
	}
?>
	
</table>
<?php 
}
?>
