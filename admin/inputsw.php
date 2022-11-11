<?php error_reporting(0); ?>
<!-- HTML and semi PHP code -->
<?php //here it goes!!
if (isset($_SESSION['Level']))
if ($_SESSION['Level']=='admin')
{

?>

<!-- VIEW DATA SISWA-->

<?php if (!isset($_GET['a'])) {   
if (isset($_SESSION['notice'])){
echo "<div class='alert alert-info'>" . $_SESSION['notice'] ."</div>";	
unset($_SESSION['notice']);
}
echo "<h3>Input Data Siswa</h3>";
?>
	<a href="pengaturan.php?v=sw&a=input"><div class="btn">Tambah <span class="icon-plus"></span></div></a>
	<a href="pengaturan.php">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	
	<tr style="background-color:lightblue;"><th>NIS/USR</th><th>Nama</th><th>Nama User</th><th>Tempat & Tanggal Lahir</th><th>Alamat</th><th>No. Telp</th><th>Kelas</th><th>Pengaturan</th></tr>
	
	<?php
	$SqlString=mysql_query("SELECT * FROM tbluser 
	INNER JOIN tblmastermahasiswa 
	ON tbluser.KdUser = tblmastermahasiswa.NIS
	WHERE tbluser.Level = 'siswa'
	ORDER BY CAST(SUBSTRING(Id, 4) AS UNSIGNED) ASC");
	while($DataSiswa=mysql_fetch_array($SqlString)) {
	?>
	
	<tr style="background-color:lightyellow;"><td><?php echo "<font color=crimson><b>" .xss_cleaner($DataSiswa['NIS']) . "/" . $DataSiswa['0']."</font></b>";?></td><td><?php echo xss_cleaner($DataSiswa['NmSiswa']);?></td><td><?php echo xss_cleaner($DataSiswa['Username']);?></td><td><?php echo xss_cleaner($DataSiswa['TmptLhr']) . ", " . xss_cleaner($DataSiswa['TglLhr']);?></td><td><?php echo xss_cleaner($DataSiswa['Almt']);?></td><td>+62<?php echo xss_cleaner($DataSiswa['NoTelp']);?></td><td><?php echo xss_cleaner($DataSiswa['Kls']);?></td>
	
	<td>
	<a href="pengaturan.php?v=sw&a=edit&nis=<?php echo $DataSiswa['NIS'];?>"><div class="btn btn-warning"><span class="icon-edit"></span></div></a>
	<a href="pengaturan.php?v=sw&a=delete&nis=<?php echo $DataSiswa['NIS'];?>"><div class="btn btn-danger" onClick="Confirm()"><span class="icon-remove"></span></div></a>
	</td>
	</tr>
	<?php 
	} 
	}
?>

<!-- EDIT DATA SISWA-->

<?php if (isset($_GET['a']) AND isset($_GET['nis'])) { 
if ($_GET['a']=='edit') {

// --------------- PROSES PENGEDITAN DATA FORM ------------------------->
if (isset($_POST['simpan'])) {

	if ($_POST['nama'] == '' OR $_POST['username'] == '' OR $_POST['password'] == '' OR $_POST['ttl'] == '' OR $_POST['thn'] == '--' OR $_POST['bln'] == '--' OR $_POST['tgl'] == '--' OR $_POST['alamat'] == '' OR $_POST['email'] == '' OR $_POST['telp'] == '' OR $_POST['kls'] == '--' OR $_POST['no'] == '--' OR $_POST['jur'] == '--') {
	header('pengaturan.php?v=sw&a=edit&nis=' . $_GET['nis']);
	}

$Str=mysql_query("SELECT * FROM tbljurusan WHERE Id = '$_POST[jur]'");
$NoJur = mysql_fetch_array($Str);
$encrypted=e($_POST['password']);
$SimpanData=mysql_query("UPDATE tblmastermahasiswa 
INNER JOIN tbluser
ON tbluser.KdUser = tblmastermahasiswa.NIS
INNER JOIN tblnilai
ON tblmastermahasiswa.NIS = tblnilai.Nis
SET tblnilai.NmSiswa = '$_POST[nama]',
tblmastermahasiswa.NmSiswa = '$_POST[nama]',
Username = '$_POST[username]',
Password = '$encrypted',
TmptLhr = '$_POST[ttl]',
TglLhr = '$_POST[thn]-$_POST[bln]-$_POST[tgl]',
Almt = '$_POST[alamat]',
Email = '$_POST[email]',
NoTelp= '$_POST[telp]',
Kls = '$_POST[kls] $NoJur[2] $_POST[no]',
Jur = '$NoJur[0]'
WHERE tblmastermahasiswa.NIS = '$_GET[nis]'");
$_SESSION['notice']="Berhasil Disimpan!";
header("location:pengaturan.php?v=sw");
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
	INNER JOIN tblmastermahasiswa 
	ON tbluser.KdUser = tblmastermahasiswa.NIS
	WHERE tblmastermahasiswa.NIS = '$_GET[nis]'");
	
	
$num = mysql_num_rows($SqlString);
	if ($num==0){
	echo "<h3><div align=center>ERROR 404: PAGE NOT FOUND</div></h3>";
	exit;
	}
	
echo "<h3>Edit Data Siswa</h3>";
?>

<?php
	while($DataSiswa=mysql_fetch_array($SqlString)) {
	?>
	<form action="pengaturan.php?v=sw&a=edit&nis=<?php echo $DataSiswa['NIS']?>" name="simpan" method="POST">
	<input type="submit" name="simpan" class="btn btn-success" value="Simpan">
	<a href="pengaturan.php?v=sw">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	
<?php

?>

	<tr>
	<th>NIS/USR</th>
	<td style="background-color:orange;"><?php echo "<font color=crimson><b>" .$DataSiswa['NIS'] . "/" . $DataSiswa['0']."</font></b>";?></td>
	</tr>
	<tr><th>Nama Lengkap</th><td><input type="text" style="height:25px;" name="nama" value="<?php echo $DataSiswa['NmSiswa'];?>"></td></td></tr>
	<tr><th>Nama User</th><td><input type="text" style="height:25px;" name="username" value="<?php echo $DataSiswa['Username'];?>"></td></tr>
	<tr><th>Kata Sandi</th><td><input type="text" style="height:25px;" name="password" value="<?php echo d($DataSiswa['Password']);?>"></td></tr>
	<tr><th>Tempat Lahir</th><td><input type="text" style="height:25px;" name="ttl" value="<?php echo $DataSiswa['TmptLhr']?>"></td></tr>
	<tr><th>Tanggal Lahir</th><td>
	
	<?php
	$date=substr($DataSiswa['TglLhr'],5,2);
	?>
	
	<select name="tgl" id="tgl" style="width:50px">
	<option value="<?php echo $date;?>"><?php echo $date;?></option>
	<!-- <option>--</option> -->
	<option value="01">01</option>
	<option value="02">02</option>
	<option value="03">03</option>
	<option value="04">04</option>
	<option value="05">05</option>
	<option value="06">06</option>
	<option value="07">07</option>
	<option value="08">08</option>
	<option value="09">09</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	<option value="13">13</option>
	<option value="14">14</option>
	<option value="15">15</option>
	<option value="16">16</option>
	<option value="17">17</option>
	<option value="18">18</option>
	<option value="19">19</option>
	<option value="20">20</option>
	<option value="21">21</option>
	<option value="22">22</option>
	<option value="23">23</option>
	<option value="24">24</option>
	<option value="25">25</option>
	<option value="26">26</option>
	<option value="27">27</option>
	<option value="28">28</option>
	<option value="29">29</option>
	<option value="30">30</option>
	<option value="31">31</option>
	</select>
	
	<?php
	$month=substr($DataSiswa['TglLhr'],8,2);
	?>
	
	<select name="bln" id="bln" style="width:50px">
	<option value="<?php echo $month;?>"><?php echo $month;?></option>
	<!-- <option>--</option> -->
	<option value="01">01</option>
	<option value="02">02</option>
	<option value="03">03</option>
	<option value="04">04</option>
	<option value="05">05</option>
	<option value="06">06</option>
	<option value="07">07</option>
	<option value="08">08</option>
	<option value="09">09</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	</select>
	
	<?php
	$thn=substr($DataSiswa['TglLhr'],0,4);
	?>
	
	<select name="thn" id="thn" style="width:90px">
	<option value="<?php echo $thn ?>"><?php echo $thn ?></option>
	<!-- <option>--</option> -->
	<?php
	$thn=1990; 
	while ($thn<>2005) { ?>
	<option value="<?php echo $thn ?>"><?php echo $thn ?></option>
	<?php 
	$thn=$thn+1;
	} ?>
	</select> 
	
	</td></tr>
	<tr><th>Alamat</th><td><textarea name="alamat"><?php echo $DataSiswa['Almt'];?></textarea></td></tr>
	<tr><th>Email</th><td><input type="text" style="height:25px;" name="email" value="<?php echo $DataSiswa['Email'];?>"></td></tr>
	<tr><th>No. Telp</th><td>+62<input type="text" style="height:25px;" name="telp" value="<?php echo $DataSiswa['NoTelp'];?>"></td></tr>
	<tr><th>Kelas</th><td>
	
	<?php
	$ArrKls=explode(" ",$DataSiswa['Kls']);
	$kls=$ArrKls[0];
	$jur=$ArrKls[1];
	$no=$ArrKls[2];
	?>
	
	<select name="kls" id="kls" style="width:50px">
	<option value="<?php echo $kls;?>"><?php echo $kls;?></option>
	<!-- <option>--</option> -->
	<option value="X">X</option>
	<option value="XI">XI</option>
	<option value="XII">XII</option>
	</select>
	
	<?php
	$StrJurusan=mysql_query("SELECT * FROM tbljurusan");
	$StrCurrJur=mysql_query("SELECT * FROM tbljurusan WHERE Sngktn='$jur'");
	$CurrJur=mysql_fetch_array($StrCurrJur);
	?>
	
	<select name="jur" id="jur" style="width:200px">
	<option value="<?php echo $CurrJur['0'];?>"><?php echo xss_cleaner($CurrJur['1']);?></option>
	<!-- <option>--</option> -->
	
	<?php
	while ($DataJurusan=mysql_fetch_array($StrJurusan)) {
	?>
	<option value="<?php echo $DataJurusan['0']?>"><?php echo $DataJurusan['1']?></option>
	<?php } ?>
	
	</select>
	
	<select name="no" id="no" style="width:50px">
	<option value="<?php echo $no?>"><?php echo $no?></option>
	<!-- <option>--</option> -->
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	</select>
	</form>
	</td></tr></tr>
	<?php 
	} 
	} 
	} 
?>

<!-- INPUT DATA SISWA-->

<?php if (isset($_GET['a'])) { 
if ($_GET['a']=='input') {

	$SqlString=mysql_query("SELECT * FROM tbluser
	ORDER BY CAST(SUBSTRING(Id, 4) AS UNSIGNED) DESC");
	$DataUser=mysql_fetch_array($SqlString);
	$UserId = "USR" . (substr($DataUser['Id'], 3) + 1);

	$SqlString=mysql_query("SELECT * FROM tblnilai
	ORDER BY CAST(SUBSTRING(Id, 4) AS UNSIGNED) DESC");
	$DataNilai=mysql_fetch_array($SqlString);
	$NilaiId = "NIL" . (substr($DataNilai['Id'], 3) + 1);

	/* Auto Increment by checking existing data in database*/

// --------------- PROSES SAVING DATA FORM ------------------------->
if (isset($_POST['savedata'])) {

	if ($_POST['nama'] == '' OR $_POST['username'] == '' OR $_POST['password'] == '' OR $_POST['ttl'] == '' OR $_POST['thn'] == '--' OR $_POST['bln'] == '--' OR $_POST['tgl'] == '--' OR $_POST['alamat'] == '' OR $_POST['email'] == '' OR $_POST['telp'] == '' OR $_POST['kls'] == '--' OR $_POST['no'] == '--' OR $_POST['jur'] == '--') {
	header('pengaturan.php?v=sw');
	}
$encrypted=e($_POST['password']);
$Str=mysql_query("SELECT * FROM tbljurusan WHERE Id = '$_POST[jur]'");
$NoJur = mysql_fetch_array($Str);
$Nilai=mysql_query("INSERT INTO `tblnilai` (`Id`, `Nis`, `NmSiswa`, `NilaiA`, `NilaiB`, `NilaiC`, `NilaiD`) VALUES ('$NilaiId', '$_POST[nis]', '$_POST[nama]', '0', '0', '0', '0')");
$Save1=mysql_query("INSERT INTO `tbluser` (`Id`, `Username`, `Password`, `Level`, `AktifUser`, `KdUser`, `Foto`, `Path`) VALUES ('$UserId', '$_POST[username]', '$encrypted', 'siswa', 'n', '$_POST[nis]', 'noface.jpg', 'img/foto/noface.jpg')");
$Save2=mysql_query("INSERT INTO `tblmastermahasiswa` (`NIS`, `NmSiswa`, `TglLhr`, `TmptLhr`, `Almt`, `Email`, `NoTelp`, `Kls`, `Jur`) VALUES ('$_POST[nis]', '$_POST[nama]', '$_POST[thn]-$_POST[bln]-$_POST[tgl]', '$_POST[ttl]', '$_POST[alamat]', '$_POST[email]', '$_POST[telp]', '$_POST[kls] $NoJur[2] $_POST[no]', '$NoJur[0]')");

//$SimpanData=mysql_query("INSERT INTO tblmastermahasiswa ('NmSiswa', 'NIS', 'TmptLhr', 'TglLhr', 'Almt', 'Email', //'NoTelp', 'Kls', 'Jur') VALUES (
//'$_POST[nama]',
//'$_POST[nis]',
//'$_POST[ttl]',
//'$_POST[thn]-$_POST[bln]-$_POST[tgl]',
//'$_POST[alamat]',
//'$_POST[email]',
//'$_POST[telp]',
//'$_POST[kls] $NoJur[2] $_POST[no]',
//'$NoJur[0]')");
$_SESSION['notice']="Berhasil Disimpan!";
header("location:pengaturan.php?v=sw");
}
// ------------------------------------------------------------------->

?>

<?php
echo "<h3>Tambah Data Siswa</h3>";
?>

	<form action="pengaturan.php?v=sw&a=input" name="savedata" method="POST">
	<input type="submit" name="savedata" class="btn btn-success" value="Simpan">
	<a href="pengaturan.php?v=sw">Kembali</a>
	<br><br>
	<table class="table table-condensed">
	
	<tr>
	<th>NIS/USR</th>
	<td style="background-color:orange;"><font color=crimson><b><input style="width:100px;" type="text" name="nis"> / <?php echo $UserId; ?></font></b></td>
	</tr>
	<tr><th>Nama Lengkap</th><td><input type="text" style="height:25px;" name="nama" value="<?php echo $DataSiswa['NmSiswa'];?>"></td></td></tr>
	<tr><th>Nama User</th><td><input type="text" style="height:25px;" name="username" value="<?php echo $DataSiswa['Username'];?>"></td></tr>
	<tr><th>Kata Sandi</th><td><input type="text" style="height:25px;" name="password" value="<?php echo $DataSiswa['Password'];?>"></td></tr>
	<tr><th>Tempat Lahir</th><td><input type="text" style="height:25px;" name="ttl" value="<?php echo $DataSiswa['TmptLhr']?>"></td></tr>
	<tr><th>Tanggal Lahir</th><td>
	
	<?php
	$date=substr($DataSiswa['TglLhr'],5,2);
	?>
	
	<select name="tgl" id="tgl" style="width:50px">
	<!-- <option>--</option> -->
	<option value="01">01</option>
	<option value="02">02</option>
	<option value="03">03</option>
	<option value="04">04</option>
	<option value="05">05</option>
	<option value="06">06</option>
	<option value="07">07</option>
	<option value="08">08</option>
	<option value="09">09</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	<option value="13">13</option>
	<option value="14">14</option>
	<option value="15">15</option>
	<option value="16">16</option>
	<option value="17">17</option>
	<option value="18">18</option>
	<option value="19">19</option>
	<option value="20">20</option>
	<option value="21">21</option>
	<option value="22">22</option>
	<option value="23">23</option>
	<option value="24">24</option>
	<option value="25">25</option>
	<option value="26">26</option>
	<option value="27">27</option>
	<option value="28">28</option>
	<option value="29">29</option>
	<option value="30">30</option>
	<option value="31">31</option>
	</select>
	
	<?php
	$month=substr($DataSiswa['TglLhr'],8,2);
	?>
	
	<select name="bln" id="bln" style="width:50px">
	<!-- <option>--</option> -->
	<option value="01">01</option>
	<option value="02">02</option>
	<option value="03">03</option>
	<option value="04">04</option>
	<option value="05">05</option>
	<option value="06">06</option>
	<option value="07">07</option>
	<option value="08">08</option>
	<option value="09">09</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	</select>
	
	<?php
	$thn=substr($DataSiswa['TglLhr'],0,4);
	?>
	
	<select name="thn" id="thn" style="width:90px">
	<!-- <option>--</option> -->
	<?php
	$thn=1990; 
	while ($thn<>2005) { ?>
	<option value="<?php echo $thn ?>"><?php echo $thn ?></option>
	<?php 
	$thn=$thn+1;
	} ?>
	</select> 
	
	</td></tr>
	<tr><th>Alamat</th><td><textarea name="alamat"><?php echo $DataSiswa['Almt'];?></textarea></td></tr>
	<tr><th>Email</th><td><input type="text" style="height:25px;" name="email" value="<?php echo $DataSiswa['Email'];?>"></td></tr>
	<tr><th>No. Telp</th><td>+62<input type="text" style="height:25px;" name="telp" value="<?php echo $DataSiswa['NoTelp'];?>"></td></tr>
	<tr><th>Kelas</th><td>
	
	<?php
	$ArrKls=explode(" ",$DataSiswa['Kls']);
	$kls=$ArrKls[0];
	$jur=$ArrKls[1];
	$no=$ArrKls[2];
	?>
	
	<select name="kls" id="kls" style="width:50px">
	<!-- <option>--</option> -->
	<option value="X">X</option>
	<option value="XI">XI</option>
	<option value="XII">XII</option>
	</select>
	
	<?php
	$StrJurusan=mysql_query("SELECT * FROM tbljurusan");
	$StrCurrJur=mysql_query("SELECT * FROM tbljurusan WHERE Sngktn='$jur'");
	$CurrJur=mysql_fetch_array($StrCurrJur);
	?>
	
	<select name="jur" id="jur" style="width:200px">
	<!-- <option>--</option> -->
	
	<?php
	while ($DataJurusan=mysql_fetch_array($StrJurusan)) {
	?>
	<option value="<?php echo $DataJurusan['0']?>"><?php echo $DataJurusan['1']?></option>
	<?php } ?>
	
	</select>
	
	<select name="no" id="no" style="width:50px">
	<!-- <option>--</option> -->
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	</select>
	</form>
	</td></tr></tr>
	<?php 
	} elseif ($_GET['a']<>'input' AND $_GET['a']<>'delete' AND $_GET['a']<>'edit') {
	header('location:404.php');
	exit;
	}
	}
?>

<!-- DELETE DATA SISWA-->

<script>
</script>

<?php if (isset($_GET['a']) AND isset($_GET['nis'])) { 
		if ($_GET['a']=='delete') {
	$deletesiswa=mysql_query("DELETE FROM `tblmastermahasiswa` WHERE `tblmastermahasiswa`.`NIS` = '$_GET[nis]'");
	$deleteuser=mysql_query("DELETE FROM `tbluser` WHERE `tbluser`.`KdUser` = '$_GET[nis]'");
	$deletepost=mysql_query("DELETE FROM tbluser INNER JOIN tblpost ON tbluser.Id = tblpost.Usrid INNER JOIN tblmastermahasiswa ON tblmastermahasiswa.NIS = tbluser.KdUser WHERE KdUser = '$_GET[nis]'");
	$deletepkl=mysql_query("DELETE FROM tbluser INNER JOIN tblpost ON tbluser.Id = tblpost.Usrid WHERE KdUser = '$_GET[nis]'");
	$deleteabsensiswa=mysql_query("DELETE FROM tblabsensiswa WHERE Nis= '$_GET[nis]'");
	$deletefor=mysql_query("DELETE FROM tbluser INNER JOIN tblforwardd ON tbluser.Id = tblforwardd.UserF INNER JOIN tblmastermahasiswa ON tblmastermahasiswa.NIS = tbluser.KdUser WHERE KdUser = '$_GET[nis]'");
	$deletenil=mysql_query("DELETE FROM tblnilai WHERE Nis = '$_GET[nis]'");
	$deletepermo=mysql_query("DELETE FROM tbluser INNER JOIN tblpermohonan ON tbluser.Id = tblpost.Nama INNER JOIN tblmastermahasiswa ON tblmastermahasiswa.NIS = tbluser.KdUser WHERE KdUser = '$_GET[nis]'");
	$deletereason=mysql_query("DELETE FROM tbluser INNER JOIN tblreason ON tbluser.Id = tblreason.UserId INNER JOIN tblmastermahasiswa ON tblmastermahasiswa.NIS = tbluser.KdUser WHERE KdUser = '$_GET[nis]'");
	$_SESSION['notice']="Berhasil Dihapus!";
	header('location:pengaturan.php?v=sw');
	} 
	}
?>
	
</table>
<?php 
}
?>
