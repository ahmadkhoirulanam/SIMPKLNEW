<?php error_reporting(0); ?>
<!-- HTML and semi PHP code -->
<?php //here it goes!!
if (isset($_SESSION['Level'])) 
if ($_SESSION['Level']=='admin')
{

?>

<!-- VIEW DATA PEMBIMBING INSTANSI-->

<?php if (!isset($_GET['a'])) {   
if (isset($_SESSION['notice'])){
echo "<div class='alert alert-info'>" . $_SESSION['notice'] ."</div>";	
unset($_SESSION['notice']);
}
echo "<h3>Input Data Pembimbing Instansi</h3>";
?>
	<a href="pengaturan.php?v=pi&a=input"><div class="btn">Tambah <span class="icon-plus"></span></div></a>
	<a href="pengaturan.php">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	
	<tr style="background-color:#c3eac8;"><th>NO ID/USR</th><th>Nama Lengkap</th><th>Username</th><th>Password</th><th>Instansi</th><th>No. Telp</th><th>Pengaturan</th></tr>
	
	<?php
	$SqlString=mysql_query("SELECT * FROM tbluser
	INNER JOIN tblmasterpembimbingdudi
	ON tbluser.KdUser = tblmasterpembimbingdudi.Id
	INNER JOIN tblmasterdudi
	ON tblmasterdudi.Id = tblmasterpembimbingdudi.IdDudi
	WHERE Level = 'pembimbingdudi'
	ORDER BY CAST(SUBSTRING(tblmasterpembimbingdudi.Id, 3) AS UNSIGNED) ASC");
	while($DataPembDudi=mysql_fetch_array($SqlString)) {
	?>
	
	<tr style="background-color:#f7cd89;"><td><?php echo "<font color=crimson><b>" . xss_cleaner($DataPembDudi['KdUser']). " / " . "$DataPembDudi[0] </font></b>";?></td><td><?php echo xss_cleaner($DataPembDudi['NmPmbg']);?></td><td><?php echo xss_cleaner($DataPembDudi['Username']);?></td><td><?php echo xss_cleaner($DataPembDudi['Password']);?></td><td><i><?php echo xss_cleaner($DataPembDudi['NmDudi']);?></i></td><td>+62<?php echo xss_cleaner($DataPembDudi['11']);?></td>
	<td>
	<a href="pengaturan.php?v=pi&a=edit&id=<?php echo $DataPembDudi['KdUser'];?>"><div class="btn btn-warning"><span class="icon-edit"></span></div></a>
	<a href="pengaturan.php?v=pi&a=delete&id=<?php echo $DataPembDudi['KdUser'];?>"><div class="btn btn-danger" onClick="Confirm()"><span class="icon-remove"></span></div></a>
	</td>
	</tr>
	<?php 
	}
	}	
?>

<!-- EDIT DATA PEMBIMBING INSTANSI-->

<?php if (isset($_GET['a']) AND isset($_GET['id'])){
if ($_GET['a']=='edit') {
$encrypted=e($_POST['password']);

// --------------- PROSES PENGEDITAN DATA FORM ------------------------->
if (isset($_POST['simpanpembimbingdudi'])) {
$SimpanData=mysql_query("UPDATE tbluser
INNER JOIN tblmasterpembimbingdudi
ON tbluser.KdUser = tblmasterpembimbingdudi.Id
SET NmPmbg = '$_POST[nama]',
Username = '$_POST[username]',
Password = '$encrypted',
IdDudi = '$_POST[dudi]',
NoTelp = '$_POST[telp]'
WHERE tblmasterpembimbingdudi.Id = '$_GET[id]'");
$_SESSION['notice']="Berhasil Disimpan!";
header("location:pengaturan.php?v=pi");
}
// ------------------------------------------------------------------->

$SqlString=mysql_query("SELECT * FROM tbluser 
	INNER JOIN tblmasterpembimbingdudi 
	ON tbluser.KdUser = tblmasterpembimbingdudi.Id
	WHERE tblmasterpembimbingdudi.Id= '$_GET[id]'");
	
	$num = mysql_num_rows($SqlString);
	if ($num==0){
	header('location:404.php');
	exit;
	}
	

echo "<h3>Edit Data Pembimbing Instansi</h3>";

	while($DataPembDudi=mysql_fetch_array($SqlString)) {
	?>
	<form action="pengaturan.php?v=pi&a=edit&id=<?php echo $DataPembDudi['Id']?>" name="simpanpembimbingdudi" method="POST">
	<input type="submit" name="simpanpembimbingdudi" class="btn btn-success" value="Simpan">
	<a href="pengaturan.php?v=pi">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	
	<tr>
	<th>NO. ID / USR</th>
	<td style="background-color:tan;"><?php echo "<font color=crimson><b>" . $DataPembDudi['Id'] . " / " .$DataPembDudi['0']."</font></b>";?></td>
	</tr>
	<tr><th>Nama Lengkap</th><td><input type="text" style="height:25px;" name="nama" value="<?php echo $DataPembDudi['NmPmbg'];?>"></td></td></tr>
	<tr><th>Nama User</th><td><input type="text" style="height:25px;" name="username" value="<?php echo $DataPembDudi['Username'];?>"></td></tr>
	<tr><th>Kata Sandi</th><td><input type="text" style="height:25px;" name="password" value="<?php echo d($DataPembDudi['Password']);?>"></td></tr>
	<tr><th>Instansi</th><td>
	
	<select name="dudi">
	<?php
	$que=mysql_query("SELECT * FROM tbluser
	INNER JOIN tblmasterpembimbingdudi
	ON tbluser.KdUser = tblmasterpembimbingdudi.Id
	INNER JOIN tblmasterdudi
	ON tblmasterdudi.Id = tblmasterpembimbingdudi.IdDudi
	WHERE tblmasterpembimbingdudi.Id = '$_GET[id]'");
	$list = mysql_fetch_array($que);
	?>
	
	<option value="<?php echo $list['Id']?>"><?php echo $list['NmDudi']?>
	
	<?php
	$sqlinstansi=mysql_query("SELECT * FROM tblmasterdudi");
	while ($sqlrow=mysql_fetch_array($sqlinstansi)){
	?>
	
	<option value="<?php echo $sqlrow['Id'];?>"><?php echo $sqlrow['NmDudi'];?></option>
	<?php } ?>
	
	</select>
	
	</td></tr>
	<tr><th>No. Telp</th><td>+62<input type="text" style="height:25px;" name="telp" value="<?php echo $DataPembDudi['NoTelp'];?>"></td></td></tr>
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
	
	$SqlString=mysql_query("SELECT * FROM tblmasterpembimbingdudi
	ORDER BY CAST(SUBSTRING(Id, 3) AS UNSIGNED) DESC");
	$PembDudi=mysql_fetch_array($SqlString);
	$MasterPembDudi = "PD" . (substr($PembDudi['Id'], 2) + 1);

// --------------- PROSES SAVING DATA FORM ------------------------->

if (isset($_POST['inputsimpanpembimbingdudi'])) {
$encrypted=e($_POST['password']);
$SimpanData=mysql_query("INSERT INTO tblmasterpembimbingdudi (`Id`, `IdDudi`, `NmPmbg`, `NoTelp`) VALUES ('$MasterPembDudi',
'$_POST[dudi]', '$_POST[nama]', '$_POST[telp]')");
$SimpanDataUser=mysql_query("INSERT INTO tbluser (`Id`, `Username`, `Password`, `Level`, `AktifUser`, `KdUser`) VALUES ('$UserId',
'$_POST[username]',
'$encrypted',
'pembimbingdudi',
'n',
'$MasterPembDudi')");
$_SESSION['notice']="Berhasil Disimpan!!";
header("location:pengaturan.php?v=pi");
}
// ------------------------------------------------------------------->
?>

<?php
echo "<h3>Input Data Pembimbing Instansi</h3>";
?>
	
	<form action="pengaturan.php?v=pi&a=input" name="inputsimpanpembimbingdudi" method="POST">
	<input type="submit" name="inputsimpanpembimbingdudi" class="btn btn-success" value="Simpan">
	<a href="pengaturan.php?v=pi&">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	
	<tr>
	<th>NO. ID / USR</th>
	<td style="background-color:orange;"><?php echo "$MasterPembDudi / " .$UserId  ."<font></b>";?></td>
	</tr>
	<tr><th>Nama Lengkap</th><td><input type="text" style="height:25px;" name="nama"></td></td></tr>
	<tr><th>Nama User</th><td><input type="text" style="height:25px;" name="username"></td></tr>
	<tr><th>Kata Sandi</th><td><input type="text" style="height:25px;" name="password"></td></tr>
	<tr><th>Instansi</th><td>
	
	<select name="dudi">
	
	<?php
	$sqlinstansi=mysql_query("SELECT * FROM tblmasterdudi");
	while ($sqlrow=mysql_fetch_array($sqlinstansi)){
	?>
	
	<option value="<?php echo $sqlrow['Id'];?>"><?php echo $sqlrow['NmDudi'];?></option>
	<?php } ?>
	
	</select>
	
	</td></tr>
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

<!-- DELETE DATA PEMBIMBING DUDI-->

<?php if (isset($_GET['a']) AND isset($_GET['id'])) { 
	if ($_GET['a']=='delete') {
	$deletepoja=mysql_query("DELETE FROM `tblmasterpembimbingdudi` WHERE `tblmasterpembimbingdudi`.`Id` = '$_GET[id]'");
	$deleteuser=mysql_query("DELETE FROM tbluser 
	WHERE tbluser.KdUser ='$_GET[id]'");
	$updateforwardd=mysql_query("UPDATE tblforwardd 
	SET PembimbingD = '' 
	WHERE PembimbingD ='$_GET[id]'");
	$_SESSION['notice']="Berhasil Dihapus!";
	header('location:pengaturan.php?v=pi');
	} 
	}
?>
	
</table>
<?php 
}
?>
