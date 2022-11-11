<?php error_reporting(0); ?>
<!-- HTML and semi PHP code -->
<?php //here it goes!!
if (isset($_SESSION['Level'])) 
if ($_SESSION['Level']=='admin')
{

?>

<!-- VIEW DATA POKJA-->

<?php if (!isset($_GET['a'])) {   
if (isset($_SESSION['notice'])){
echo "<div class='alert alert-info'>" . $_SESSION['notice'] ."</div>";	
unset($_SESSION['notice']);
}
echo "<h3>Input Data POKJA</h3>";
?>
	<a href="pengaturan.php?v=pj&a=input"><div class="btn">Tambah <span class="icon-plus"></span></div></a>
	<a href="pengaturan.php">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	
	<tr style="background-color:#c3eac8;"><th>ID</th><th>Nama</th><th>Username</th><th>Password</th><th>Pengaturan</th></tr>
	
	<?php
	$SqlString=mysql_query("SELECT * FROM tbluser
	INNER JOIN pokja
	ON tbluser.KdUser = pokja.Id
	ORDER BY CAST(SUBSTRING(pokja.Id, 3) AS UNSIGNED) ASC");
	while($DataPokja=mysql_fetch_array($SqlString)) {
	?>
	
	<tr style="background-color:#f7cd89;"><td><?php echo "<font color=crimson><b>" . $DataPokja['Id']."</font></b>";?></td><td><?php echo xss_cleaner($DataPokja['Nama']);?></td><td><i><?php echo xss_cleaner($DataPokja['Username']);?></i></td><td><?php echo xss_cleaner($DataPokja['Password']);?>
	<td>
	<a href="pengaturan.php?v=pj&a=edit&id=<?php echo $DataPokja['Id'];?>"><div class="btn btn-warning"><span class="icon-edit"></span></div></a>
	<a href="pengaturan.php?v=pj&a=delete&id=<?php echo $DataPokja['Id'];?>"><div class="btn btn-danger" onClick="Confirm()"><span class="icon-remove"></span></div></a>
	</td>
	</tr>
	<?php 
	}
	}	
?>

<!-- EDIT DATA POKJA-->

<?php if (isset($_GET['a']) AND isset($_GET['id'])){
if ($_GET['a']=='edit') {

// --------------- PROSES PENGEDITAN DATA FORM ------------------------->
if (isset($_POST['simpanpokja'])) {
$encrypted = e($_POST['password']);
$SimpanData=mysql_query("UPDATE tbluser
INNER JOIN pokja
ON tbluser.KdUser = pokja.Id
SET Nama = '$_POST[nama]',
Username = '$_POST[username]',
Password = '$encrypted'
WHERE pokja.Id = '$_GET[id]'");
$_SESSION['notice']="Berhasil Disimpan!";
header("location:pengaturan.php?v=pj");
}
// ------------------------------------------------------------------->


	$SqlString=mysql_query("SELECT * FROM tbluser 
	INNER JOIN pokja 
	ON tbluser.KdUser = pokja.Id
	WHERE pokja.Id= '$_GET[id]'");
	
	$num = mysql_num_rows($SqlString);
	if ($num==0){
	header('location:404.php');
	exit;
	}
	
echo "<h3>Edit Data POKJA</h3>";

	while($DataPokja=mysql_fetch_array($SqlString)) {
	?>
	<form action="pengaturan.php?v=pj&a=edit&id=<?php echo $DataPokja['Id']?>" name="simpanpokja" method="POST">
	<input type="submit" name="simpanpokja" class="btn btn-success" value="Simpan">
	<a href="pengaturan.php?v=pj">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	
	<tr>
	<th>NO. ID / USR</th>
	<td style="background-color:tan;"><?php echo "<font color=crimson><b>" . $DataPokja['Id'] . " / " .$DataPokja['0']."</font></b>";?></td>
	</tr>
	<tr><th>Nama Lengkap</th><td><input type="text" style="height:25px;" name="nama" value="<?php echo xss_cleaner($DataPokja['Nama']);?>"></td></td></tr>
	<tr><th>Nama User</th><td><input type="text" style="height:25px;" name="username" value="<?php echo xss_cleaner($DataPokja['Username']);?>"></td></tr>
	<tr><th>Kata Sandi</th><td><input type="text" style="height:25px;" name="password" value="<?php echo xss_cleaner(d($DataPokja['Password']));?>"></td></tr>
	</form>
	</td></tr></tr>
	<?php 
	} 
	}
	}
?>

<!-- INPUT DATA POKJA-->

<?php if (isset($_GET['a'])) { 
if ($_GET['a']=='input') {

	$SqlString=mysql_query("SELECT * FROM tbluser
	ORDER BY CAST(SUBSTRING(Id, 4) AS UNSIGNED) DESC");
	$DataUser=mysql_fetch_array($SqlString);
	$UserId = "USR" . (substr($DataUser['Id'], 3) + 1);

	$SqlStringDudi=mysql_query("SELECT * FROM pokja
	ORDER BY CAST(SUBSTRING(Id, 3) AS UNSIGNED) DESC");
	$DataPokja=mysql_fetch_array($SqlStringDudi);
	$MasterPokja = "PO" . (substr($DataPokja['Id'], 2) + 1);
	
// --------------- PROSES SAVING DATA FORM ------------------------->

if (isset($_POST['inputsimpanpokja'])) {
$encrypted = e($_POST['password']);
$SimpanData=mysql_query("INSERT INTO pokja (`Id`, `Nama`) VALUES ('$MasterPokja',
'$_POST[nama]')");
$SimpanDataUser=mysql_query("INSERT INTO tbluser (`Id`, `Username`, `Password`, `Level`, `AktifUser`, `KdUser`) VALUES ('$UserId',
'$_POST[username]',
'$encrypted',
'pokja',
'n',
'$MasterPokja')");
$_SESSION['notice']="Berhasil Disimpan!!";
header("location:pengaturan.php?v=pj");
}
// ------------------------------------------------------------------->
?>

<?php
echo "<h3>Input Data POKJA</h3>";
?>
	
	<form action="pengaturan.php?v=pj&a=input" name="inputsimpanpokja" method="POST">
	<input type="submit" name="inputsimpanpokja" class="btn btn-success" value="Simpan">
	<a href="pengaturan.php?v=pj&">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	
	<tr>
	<th>NO. ID / USR</th>
	<td style="background-color:orange;"><?php echo "<font color=crimson><b>" . xss_cleaner($MasterPokja) . " / " .$UserId  ."<font></b>";?></td>
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

<!-- DELETE DATA POKJA-->

<?php if (isset($_GET['a']) AND isset($_GET['id'])) { 
	if ($_GET['a']=='delete') {
	$deletepoja=mysql_query("DELETE FROM `pokja` WHERE `pokja`.`Id` = '$_GET[id]'");
	$deleteuser=mysql_query("DELETE FROM tbluser 
	WHERE tbluser.KdUser ='$_GET[id]'");
	$_SESSION['notice']="Berhasil Dihapus!";
	header('location:pengaturan.php?v=pj');
	} 
	}
?>
	
</table>
<?php 
}
?>
