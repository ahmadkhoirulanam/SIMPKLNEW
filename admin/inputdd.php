<?php error_reporting(0); ?>
<!-- HTML and semi PHP code -->
<?php //here it goes!!
if (isset($_SESSION['Level']))
if ($_SESSION['Level']=='admin')
{

?>

<!-- VIEW DATA INSTANSI-->

<?php if (!isset($_GET['a'])) {   
if (isset($_SESSION['notice'])){
echo "<div class='alert alert-info'>" . $_SESSION['notice'] ."</div>";	
unset($_SESSION['notice']);
}
echo "<h3>Input Data Instansi</h3>";
?>
	<a href="pengaturan.php?v=dd&a=input"><div class="btn">Tambah <span class="icon-plus"></span></div></a>
	<a href="pengaturan.php">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	
	<tr style="background-color:#aadac8;"><th>NO. ID</th><th>Nama</th><th>Alamat</th><th>No. Telp</th><th>Pemimpin</th><th>Jumlah Magang</th><th>Daya Tampung</th><th>Jurusan</th><th>Pengaturan</th></tr>
	
	<?php
	$SqlString=mysql_query("SELECT * FROM tblmasterdudi
	ORDER BY CAST(SUBSTRING(Id, 2) AS UNSIGNED) ASC");
	while($DataDudi=mysql_fetch_array($SqlString)) {
	?>
	
	<tr style="background-color:#f7cd89;"><td><?php echo "<font color=crimson><b>" . $DataDudi['0']."</font></b>";?></td><td><?php echo xss_cleaner($DataDudi['NmDudi']);?></td><td><i><?php echo xss_cleaner($DataDudi['Alamat']);?></i></td><td>+62<?php echo xss_cleaner($DataDudi['NoTelp']);?></td><td><?php echo xss_cleaner($DataDudi['NmPmpn'])?><td><?php echo xss_cleaner($DataDudi['magang']);?></td><td><?php echo xss_cleaner($DataDudi['dayatampung']);?></td><td><?php echo xss_cleaner($DataDudi['tipe']);?></td>
	
	<td>
	<a href="pengaturan.php?v=dd&a=edit&id=<?php echo xss_cleaner($DataDudi['Id']);?>"><div class="btn btn-warning"><span class="icon-edit"></span></div></a>
	<a href="pengaturan.php?v=dd&a=delete&id=<?php echo xss_cleaner($DataDudi['Id']);?>"><div class="btn btn-danger" onClick="Confirm()"><span class="icon-remove"></span></div></a>
	</td>
	</tr>
	<?php 
	} 
	}
?>

<!-- EDIT DATA DUDI-->

<?php if (isset($_GET['a']) AND isset($_GET['id'])) { 
if ($_GET['a']=='edit') {

// --------------- PROSES PENGEDITAN DATA FORM ------------------------->
if (isset($_POST['simpandudi'])) {
if (empty($_POST['jur'])) {
$checkbox1 = NULL;
} else {
$checkbox1 = $_POST['jur'];
foreach($_POST['jur'] as $array) {
$papapoy=$array;
if ($ultrapapapoy=="") {
$ultrapapapoy=$array[0];
} else {
$ultrapapapoy=$ultrapapapoy . ",". $papapoy;
}
}
echo $ultrapapapoy;
$UPDATE=mysql_query("UPDATE tblmasterdudi 
SET tipe = '$ultrapapapoy'
WHERE tblmasterdudi.Id = '$_GET[id]'");
}
$Str=mysql_query("SELECT * FROM tbljurusan WHERE Id = '$_POST[jur]'");
$NoJur = mysql_fetch_array($Str);
$encrypted=e($_POST['password']);
$SimpanData=mysql_query("UPDATE tblmasterdudi 
INNER JOIN tbluser
ON tbluser.Id = tblmasterdudi.KdOwner
SET NmDudi = '$_POST[nama]',
Username = '$_POST[username]',
Password = '$encrypted',
NmPmpn = '$_POST[owner]',
Alamat = '$_POST[alamat]',
NoTelp= '$_POST[telp]',
dayatampung = '$_POST[dayatampung]'
WHERE tblmasterdudi.Id = '$_GET[id]'");
$_SESSION['notice']="Berhasil Disimpan!!";
header("location:pengaturan.php?v=dd");
}
// ------------------------------------------------------------------->
?>

<!-------- SECURITY ---------------->
<script>
function Tetot() {
var thn, bln, tgl;
tgl = document.getElementById('tgl').value;
thn = document.getElementById('thn').value;
bln = document.getElementById('bln').value;
kls = document.getElementById('kls').value;
jur = document.getElementById('jur').value;
no = document.getElementById('no').value;
if (tgl == '--' || bln == '--' || thn == '--' || kls == '--' || jur == '--' || no == '--')
	{
	alert("Data belum benar.");
	}
else 
	{
	
	}
}
</script>
<!----------------------------------->

<?php

	$SqlString=mysql_query("SELECT * FROM tbluser 
	INNER JOIN tblmasterdudi 
	ON tbluser.Id = tblmasterdudi.KdOwner
	WHERE tblmasterdudi.Id= '$_GET[id]'");
	$num = mysql_num_rows($SqlString);
	if ($num==0){
	header('location:404.php');
	exit;
	}
echo "<h3>Edit Data Instansi</h3>";
?>

<?php
	while($DataDudi=mysql_fetch_array($SqlString)) {
	?>
	<form action="pengaturan.php?v=dd&a=edit&id=<?php echo xss_cleaner($DataDudi['Id'])?>" name="simpandudi" method="POST">
	<input type="submit" name="simpandudi" class="btn btn-success" value="Simpan">
	<a href="pengaturan.php?v=dd">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	
	<tr>
	<th>NO. ID / USR</th>
	<td style="background-color:orange;"><?php echo "<font color=crimson><b>" . $DataDudi['Id'] . " / " .$DataDudi['0']."</font></b>";?></td>
	</tr>
	<tr><th>Nama Instansi</th><td><input type="text" style="height:25px;" name="nama" value="<?php echo xss_cleaner($DataDudi['NmDudi']);?>"></td></td></tr>
	<tr><th>Alamat</th><td><textarea name="alamat"><?php echo xss_cleaner($DataDudi['Alamat'])?></textarea></td></tr>
	<tr><th>Nama Owner</th><td><input type="text" style="height:25px;" name="owner" value="<?php echo xss_cleaner($DataDudi['NmPmpn']);?>"></td></td></tr>
	<tr><th>User Owner</th><td><input type="text" style="height:25px;" name="username" value="<?php echo xss_cleaner($DataDudi['Username']);?>"></td></tr>
	<tr><th>Pass Owner</th><td><input type="text" style="height:25px;" name="password" value="<?php echo xss_cleaner(d($DataDudi['Password']));?>"></td></tr>
	<tr><th>No. Telp Kantor</th><td>+62<input type="text" style="height:25px;" name="telp" value="<?php echo xss_cleaner($DataDudi['NoTelp']);?>"></td></tr>
	<tr><th>Daya Tampung</th><td><input type="text" style="height:25px;" name="dayatampung" value="<?php echo xss_cleaner($DataDudi['dayatampung']);?>"></td></tr>
	<tr><td><b>Bidang Jurusan</b><br><i>(pilih min. satu)</i></td><td>
	
	<?php
	$StrJurusan=mysql_query("SELECT * FROM tbljurusan");
	$StrCurrJur=mysql_query("SELECT * FROM tbljurusan WHERE Sngktn='$jur'");
	$CurrJur=mysql_fetch_array($StrCurrJur);
	?>
	
	<?php
	echo pos($DataDudi['tipe']);
	while ($DataJurusan=mysql_fetch_array($StrJurusan)) {
	$JCheck = "";
	if (strpos($DataDudi['tipe'],$DataJurusan['0'])<>"" OR strpos($DataDudi['tipe'],$DataJurusan['0'])=="0000") {
	$JCheck = "checked";
	}
	?>
	
	<input type="checkbox" name="jur[]" <?php echo $JCheck;?> value="<?php echo $DataJurusan['0']?>" /> <?php echo xss_cleaner($DataJurusan['1'])?>
	<br/>
	<?php 
	$i=$i+(1/7);
	} ?>
	</form>
	</td></tr></tr>
	<?php 
	} 
	}
	}
?>

<!-- INPUT DATA DUDI-->

<?php if (isset($_GET['a'])) { 
if ($_GET['a']=='input') {

	$SqlString=mysql_query("SELECT * FROM tbluser
	ORDER BY CAST(SUBSTRING(Id, 4) AS UNSIGNED) DESC");
	$DataUser=mysql_fetch_array($SqlString);
	$UserId = "USR" . (substr($DataUser['Id'], 3) + 1);
			
	$SqlStringDudi=mysql_query("SELECT * FROM tblmasterdudi
	ORDER BY CAST(SUBSTRING(Id, 2) AS UNSIGNED) DESC");
	$DataDudi=mysql_fetch_array($SqlStringDudi);
	$MasterDudi = "D" . (substr($DataDudi['Id'], 1) + 1);
// --------------- PROSES SAVING DATA FORM ------------------------->

if (isset($_POST['inputsimpandudi'])) {
if (empty($_POST['jur'])) {
$checkbox1 = NULL;
} else {
$checkbox1 = $_POST['jur'];
foreach($_POST['jur'] as $array) {
$papapoy=$array;
if ($ultrapapapoy=="") {
$ultrapapapoy=$array[0];
} else {
$ultrapapapoy=$ultrapapapoy . ",". $papapoy;
}
}
echo xss_cleaner($ultrapapapoy);
$UPDATE=mysql_query("UPDATE tblmasterdudi 
SET tipe = '$ultrapapapoy'
WHERE tblmasterdudi.Id = '$_GET[id]'");
}
$Str=mysql_query("SELECT * FROM tbljurusan WHERE Id = '$_POST[jur]'");
$NoJur = mysql_fetch_array($Str);
$encrypted = e($_POST['password']);
$SimpanData=mysql_query("INSERT INTO tblmasterdudi (`Id`, `NmDudi`, `Alamat`, `NoTelp`, `NmPmpn`, `magang`, `dayatampung`, `tipe`, `KdOwner`) VALUES ('$MasterDudi',
'$_POST[nama]',
'$_POST[alamat]',
'$_POST[telp]',
'$_POST[owner]',
'0',
'$_POST[dayatampung]',
'$ultrapapapoy',
'$UserId')");
$SimpanDataUser=mysql_query("INSERT INTO tbluser (`Id`, `Username`, `Password`, `Level`, `AktifUser`, `KdUser`) VALUES ('$UserId',
'$_POST[username]',
'$encrypted',
'dudiowner',
'n',
'$MasterDudi')");
$_SESSION['notice']="Berhasil Disimpan!!";
header("location:pengaturan.php?v=dd");
}
// ------------------------------------------------------------------->
?>

<?php
echo "<h3>Input Data Instansi</h3>";
?>
	
	<form action="pengaturan.php?v=dd&a=input" name="inputsimpandudi" method="POST">
	<input type="submit" name="inputsimpandudi" class="btn btn-success" value="Simpan">
	<a href="pengaturan.php?v=dd&">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	
	<tr>
	<th>NO. ID / USR</th>
	<td style="background-color:orange;"><?php echo "<font color=crimson><b>" . $MasterDudi . " / " .$UserId  ."<font></b>";?></td>
	</tr>
	<tr><th>Nama Instansi</th><td><input type="text" style="height:25px;" name="nama"></td></td></tr>
	<tr><th>Alamat</th><td><textarea name="alamat"></textarea></td></tr>
	<tr><th>Nama Owner</th><td><input type="text" style="height:25px;" name="owner"></td></td></tr>
	<tr><th>User Owner</th><td><input type="text" style="height:25px;" name="username"></td></tr>
	<tr><th>Pass Owner</th><td><input type="text" style="height:25px;" name="password"></td></tr>
	<tr><th>No. Telp Kantor</th><td>+62<input type="text" style="height:25px;" name="telp"></td></tr>
	<tr><th>Daya Tampung</th><td><input type="text" style="height:25px;" style="width:50px;" name="dayatampung"></td></tr>
	<tr><td><b>Bidang Jurusan</b><br><i>(pilih min. satu)</i></td><td>
	
	<?php
	$StrJurusan=mysql_query("SELECT * FROM tbljurusan");
	$StrCurrJur=mysql_query("SELECT * FROM tbljurusan WHERE Sngktn='$jur'");
	$CurrJur=mysql_fetch_array($StrCurrJur);
	?>
	
	<?php
	echo pos($DataDudi['tipe']);
	while ($DataJurusan=mysql_fetch_array($StrJurusan)) {
	?>
	
	<input type="checkbox" name="jur[]" value="<?php echo $DataJurusan['0']?>" /> <?php echo $DataJurusan['1']?>
	<br/>
	<?php 
	} ?>
	</form>
	</td></tr></tr>
	<?php 
	} elseif ($_GET['a']<>'input' AND $_GET['a']<>'delete' AND $_GET['a']<>'edit') {
	header('location:404.php');
	exit;
	}
	}
	
?>

<!-- DELETE DATA INSTANSI-->

<?php if (isset($_GET['a']) AND isset($_GET['id'])) { 
		if ($_GET['a']=='delete') {
	$deletedudi=mysql_query("DELETE FROM `tblmasterdudi` WHERE `tblmasterdudi`.`Id` = '$_GET[id]'");
	$deleteuser=mysql_query("DELETE FROM tbluser 
	WHERE tbluser.KdUser ='$_GET[id]'");
	$deleteuserpembimbing=mysql_query("DELETE FROM tblmasterpembimbingdudi 
	INNER JOIN tbluser 
	ON tblmasterpembimbingdudi.Id = tbluser.KdUser
	WHERE tblmasterpembimbingdudi.IdDudi ='$_GET[id]'");
	$deletepembimbingdudi=mysql_query("DELETE FROM tblmasterpembimbingdudi 
	WHERE tblmasterpembimbingdudi.IdDudi ='$_GET[id]'");
	$deletepkl=mysql_query("DELETE FROM tblforwardd 
	WHERE tblforwardd.DudiF ='$_GET[id]'");
	$deletepermohonan=mysql_query("DELETE FROM tblpermohonan
	WHERE tblpermohonan.Dudi ='$_GET[id]'");
	$deletepost=mysql_query("DELETE FROM tblpost
	INNER JOIN tbluser
	ON tbluser.Id = tblpost.Usrid
	WHERE tbluser.KdUser ='$_GET[id]'");
	$deletepost2=mysql_query("DELETE FROM tblpost
	INNER JOIN tbluser
	ON tbluser.KdUser = tblmasterpembimbing.Id
	INNER JOIN tblpost
	ON tbluser.Id = tblpost.Usrid
	WHERE tbluser.KdUser ='$_GET[id]'");
	$deletereason=mysql_query("DELETE FROM tblreason
	WHERE tblreason.IdDudi='$_GET[id]'");
	$_SESSION['notice']="Berhasil Dihapus!";
	header('location:pengaturan.php?v=dd');
	} 
	}
?>
	
</table>
<?php 
}
?>
