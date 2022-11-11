
<!-- HTML and semi PHP code -->

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIPRIN : Sistem Informasi Prakerin - Edit Profil</title>
<?php include('include/header.php'); //	  include header ?>
	<script type="text/javascript">
		function showPass()
		{
			var Pass, TextPass, TextButton, TextPassNew;
			Pass=document.getElementById('pass');
			TextButton=document.getElementById('TextButton');
			TextPass=document.getElementById('TextPass');
			TextPassNew=document.getElementById('TextPassNew');
			if (TextButton.innerHTML == 'Ubah?') 
			{
				Pass.style.display = "none";
				TextPass.style.display = "inline";
				TextButton.innerHTML ='Batal?';
			}   else  {
				Pass.style.display = "inline";
				TextPass.style.display = "none";
				TextButton.innerHTML ='Ubah?';
			}
		}
	</script>
</head>
<body>
<div class='well'>
<?php 
$rq=mysql_query("SELECT * FROM tbluser INNER JOIN tblmasterdudi
ON tbluser.Id = tblmasterdudi.KdOwner
WHERE tbluser.Id = '$_SESSION[Id]'");
$r=mysql_fetch_array($rq);
if (isset($_GET['id'])) {
if ($_GET['id']==$r['Id'] AND $_SESSION['Level']=='dudiowner') {
?>
<form name='edit' id='edit' action='editprofil.php?id=<?php echo $r['Id']; ?>' method='POST'>
<?php
}
} else {
?>
<form name="edit" id="edit" action="editprofil.php" method="POST">
<?php } ?>
<table class="table table-striped table-bordered table-hover">
<?php //here it goes!!
if (isset($_SESSION['Level']))
{
	// SISWA

if($_SESSION['Level']=='siswa'){
	$sql = mysql_query("SELECT * FROM tbluser 
	INNER JOIN tblmastermahasiswa 
	ON tbluser.KdUser = tblmastermahasiswa.NIS 
	WHERE Id = '$_SESSION[Id]'"); //query
	$data = mysql_fetch_array($sql); //eksekusi query
 	$user_nama = $data['Username']; //register array
	$password = $data['Password'];
 	$level = $data['Level'];
 	$Id = $data['Id'];
 	$email = $data['Email'];
 	$namalengkap = $data['NmSiswa'];
 	$NIS= $data['KdUser'];
 	$TglLhr=$data['TglLhr'];
 	$TmptLhr=$data['TmptLhr'];
 	$alamat=$data['Almt'];
 	$telp=$data['NoTelp'];
 	$Kls=$data['Kls'];
 	$Jur=$data['Jur'];
	?>
	
<!----------- editprofil-action-form.php --------------->

	<?php
	if ($_SESSION['Level']=='siswa') {
	if (isset($_POST['edit']) OR isset($_POST['username']))
	{
	if ($_POST['username']=='a') {
	$_SESSION['notice']='Username tidak boleh kosong';
	header('editprofils.php');
	}
	$encrypted=e($_POST['password']);
	$query=mysql_query("UPDATE tblmastermahasiswa SET Almt = '$_POST[alamat]' WHERE NIS =$NIS");
	$query=mysql_query("UPDATE tbluser SET Username = '$_POST[username]' WHERE KdUser =$NIS");
	$query=mysql_query("UPDATE tblmastermahasiswa SET Email = '$_POST[email]' WHERE NIS =$NIS");
	$query=mysql_query("UPDATE tblmastermahasiswa SET NoTelp = '$_POST[telp]' WHERE NIS =$NIS");
	if (isset($_POST['password'])){
	$query=mysql_query("UPDATE tbluser SET Password = '$encrypted' WHERE KdUser =$NIS");
	}
	header('location:profil.php');
	$_SESSION['notice'] = 'Data sudah tersimpan';
	}
	}
	?>

<!------------ END ---------------------------------------->

<script type="text/javascript">
</script>
	<h3>Sunting Profil Siswa</h3>
	<tr><td>Username:</td><td><b><input onKeydown=keydown(); name="username" value="<?php echo xss_cleaner($user_nama) ; ?>"> </b> </td>
	<tr><td>Password:</td><td>
	<div id="pass" style="display:inline-block">********</div>
	<div id="TextPass" style="display:none;"><br><input type="password" name="password" value="<?php echo xss_cleaner(d($password))?>"></div>
	<a id="TextButton" href="#" class="text-primary" style="font-size:11;" onClick="showPass();">Ubah?</a></td>
	<tr><td>Status:</td><td><?php echo $level; ?> </td>
	<tr><td>Nama Lengkap:</td><td><?php echo xss_cleaner($namalengkap) ; ?> </td>
	<tr><td>TTL: </td><td><?php echo $TmptLhr ?>, <?php echo $TglLhr ; ?> </td>
	<tr><td>Alamat: </td><td><textarea maxlength="255" onKeyDown="charLimit(this.form.limitedtextarea,this.form.countdown,255);" name="alamat"><?php echo xss_cleaner($alamat) ; ?></textarea> </td>
	<tr><td>E-mail: </td><td><input name="email" value="<?php echo xss_cleaner($email) ; ?>"> </td>
	<tr><td>NIS: </td><td><?php echo xss_cleaner($NIS) ; ?> </td>
	<tr><td>No. Telp: </td><td>+62 <input name="telp" id="telp" value="<?php echo xss_cleaner($telp); ?>"> </td>
	<tr><td>Kelas: </td><td><?php echo xss_cleaner($Kls) ; ?> </td>
	<?php
	$skl = mysql_query("SELECT * FROM tblmastermahasiswa
	INNER JOIN tbljurusan
	ON tbljurusan.Id = tblmastermahasiswa.Jur
	WHERE Id = '$Jur'");
	$data = mysql_fetch_array($skl);
	$Jurz = $data['Jur']; 
	?>
	<tr><td> Jurusan: </td><td><?php echo xss_cleaner($Jurz); ?> </td>
	<?php 
	}
	
	// PEMBIMBING
	
	
if($_SESSION['Level']=='pembimbing'){
	$sql = mysql_query("SELECT * FROM tbluser 
	INNER JOIN tblmasterpembimbing
	ON tbluser.KdUser = tblmasterpembimbing.NIP
	WHERE tbluser.Id = '$_SESSION[Id]'"); //query
	$data = mysql_fetch_array($sql); //eksekusi query
 	?>
	<h3>Profil Pembimbing dari Sekolah</h3>
	<tr><td>Username:</td><td><b><input onKeydown=keydown(); name="username" value="<?php echo xss_cleaner($data['Username']);?>"> </b> </td>
	<tr><td>Password:</td><td>
	<div id="pass" style="display:inline-block">********</div>
	<div id="TextPass" style="display:none;"><br><input type="password" name="password" value="<?php echo xss_cleaner(d($data['Password']))?>"></div>
	<a id="TextButton" href="#" class="text-primary" style="font-size:11;" onClick="showPass();">Ubah?</a></td>
	<tr><td>Status:</td><td>Pembimbing dari Sekolah</td>
	<tr><td>Nama Lengkap:</td><td><input name="nama" value="<?php echo xss_cleaner($data['NmPmbgI']); ?>"> </td>
	<tr><td>Alamat:</td><td><textarea name="alamat"><?php echo xss_cleaner($data['Almt']); ?></textarea> </td>
	<tr><td>No. Telp:</td><td>+62<input name="telp" id="telp" value="<?php echo xss_cleaner($data['NoTelp']); ?>"> </td>
	<?php 
	} ?>
	<?php	
	if (isset($_POST['submit']) OR isset($_POST['username'])){
	$a=mysql_query("UPDATE tbluser SET Username = '$_POST[username]' WHERE KdUser ='$data[KdUser]'");
	$b=mysql_query("UPDATE tbluser INNER JOIN tblmasterpembimbing ON tbluser.KdUser = tblmasterpembimbing.NIP SET NmPmbgI = '$_POST[nama]' WHERE KdUser ='$data[KdUser]'");
	$c=mysql_query("UPDATE tbluser INNER JOIN tblmasterpembimbing ON tbluser.KdUser = tblmasterpembimbing.NIP SET NoTelp = '$_POST[telp]' WHERE KdUser ='$data[KdUser]'");
	$alamat=mysql_query("UPDATE tbluser INNER JOIN tblmasterpembimbing ON tbluser.KdUser = tblmasterpembimbing.NIP SET Almt= '$_POST[alamat]' WHERE KdUser ='$data[KdUser]'");
	$_SESSION['notice']='Berhasil Disimpan';
	header("location:profil.php");
	if (isset($_POST['password'])){
	$encrypted=e($_POST['password']);
	$query=mysql_query("UPDATE tbluser SET Password = '$encrypted' WHERE KdUser ='$data[KdUser]'");
	}
}
if ($_SESSION['Level']=='admin'){
$sql = mysql_query("SELECT * FROM tbluser 
	WHERE tbluser.Id = '$_SESSION[Id]'"); //query
	$data = mysql_fetch_array($sql); //eksekusi query
 	?>
	<h3>Profil Admin</h3>
	<tr><td>Username:</td><td><b><input onKeydown=keydown(); name="username" value="<?php echo xss_cleaner($data['Username']);?>"> </b> </td>
	<tr><td>Password:</td><td>
	<div id="pass" style="display:inline-block">********</div>
	<div id="TextPass" style="display:none;"><br><input type="password" name="password" value="<?php echo d($data['Password'])?>"></div>
	<a id="TextButton" href="#" class="text-primary" style="font-size:11;" onClick="showPass();">Ubah?</a></td>
	<tr><td>Status:</td><td>ADMINISTRATOR</td>
	<?php 
	} ?>
	<?php	
	if (isset($_POST['submit']) OR isset($_POST['username'])){
	$a=mysql_query("UPDATE tbluser SET Username = '$_POST[username]' WHERE KdUser ='$data[KdUser]'");
	$_SESSION['notice']='Berhasil Disimpan';
	header("location:profil.php");
	if (isset($_POST['password'])){
	$encrypted=e($_POST['password']);
	$query=mysql_query("UPDATE tbluser SET Password = '$encrypted' WHERE KdUser ='$data[KdUser]'");
	}
}
	
	//	DUDIOWNER
	
		if ($_SESSION['Level']=='dudiowner') {
		$sql = mysql_query("SELECT * FROM tbluser 
	INNER JOIN tblmasterdudi
	ON tblmasterdudi.Id = tbluser.KdUser
	WHERE tbluser.Id = '$_SESSION[Id]'"); //query
	$data = mysql_fetch_array($sql); //eksekusi query
 	$user_nama = $data['Username']; //register array
 	$level = $data['Level'];
 	$Id = $data['Id'];
 	$namalengkap = $data['NmPmpn'];
	$dudi=$data['NmDudi'];
	$alamat=$data['Alamat'];
 	$telp=$data['NoTelp'];
 	$password=$data['Password'];
	if (isset($_POST['submit']) OR isset($_POST['username']) AND !isset($_GET['id'])){
	$A=mysql_query("UPDATE tblmasterdudi SET Alamat = '$_POST[alamat]' WHERE Id='$Id'");
	$U=mysql_query("UPDATE tblmasterdudi SET NmDudi = '$_POST[namap]' WHERE Id='$Id'");
	$B=mysql_query("UPDATE tbluser SET Username = '$_POST[username]' WHERE KdUser ='$data[KdOwner]'");
	$C=mysql_query("UPDATE `tblmasterdudi` SET `NoTelp` = '$_POST[telp]' WHERE `tblmasterdudi`.`KdOwner` = '$data[KdOwner]'");
	$_SESSION['notice']='Berhasil Disimpan';	
	header('location:profil.php');
	if (isset($_POST['password'])){
	$encrypted=e($_POST['password']);
	$query=mysql_query("UPDATE tbluser SET Password = '$encrypted' WHERE KdUser ='$data[KdUser]'");
	}
	}
	}
		
if($_SESSION['Level']=='pembimbingdudi'){
$sql = mysql_query("SELECT * FROM tbluser 
	INNER JOIN tblmasterpembimbingdudi
	ON tbluser.KdUser = tblmasterpembimbingdudi.Id
	WHERE tbluser.Id = '$_SESSION[Id]'"); //query
	$data = mysql_fetch_array($sql); //eksekusi query
 	?>
	<h3>Profil Pembimbing dari DU/DI</h3>
	<tr><td>Username:</td><td><b><input onKeydown=keydown(); name="username" value="<?php echo $data['Username'];?>"> </b> </td>
	<tr><td>Password:</td><td>
	<div id="pass" style="display:inline-block">********</div>
	<div id="TextPass" style="display:none;"><br><input type="password" name="password" value="<?php echo xss_cleaner(d($data['Password']))?>"></div>
	<a id="TextButton" href="#" class="text-primary" style="font-size:11;" onClick="showPass();">Ubah?</a></td>
	<tr><td>Status:</td><td>Pembimbing Instansi</td>
	<tr><td>Nama Lengkap:</td><td><input name="nama" value="<?php echo xss_cleaner($data['NmPmbg']); ?>"> </td>
	<tr><td>No. Telp:</td><td>+62<input name="telp" id="telp" value="<?php echo xss_cleaner($data['NoTelp']); ?>"> </td>
	<?php 
	} ?>
	<?php	
	if (isset($_POST['submit']) OR isset($_POST['username'])){
	$a=mysql_query("UPDATE tbluser SET Username = '$_POST[username]' WHERE KdUser ='$data[KdUser]'");
	$b=mysql_query("UPDATE tbluser INNER JOIN tblmasterpembimbingdudi ON tbluser.KdUser = tblmasterpembimbingdudi.Id SET NmPmbg = '$_POST[nama]' WHERE KdUser ='$data[KdUser]'");
	$c=mysql_query("UPDATE tbluser INNER JOIN tblmasterpembimbingdudi ON tbluser.KdUser = tblmasterpembimbingdudi.Id SET NoTelp = '$_POST[telp]' WHERE KdUser ='$data[KdUser]'");
	$_SESSION['notice']='Berhasil Disimpan';
	header("location:profil.php");
	if (isset($_POST['password'])){
	$encrypted=e($_POST['password']);
	$query=mysql_query("UPDATE tbluser SET Password = '$encrypted' WHERE KdUser ='$data[KdUser]'");
	}
}
	
if($_SESSION['Level']=='pokja'){
	$sql = mysql_query("SELECT * FROM tbluser 
	INNER JOIN pokja
	ON tbluser.KdUser = pokja.Id 
	WHERE tbluser.Id = '$_SESSION[Id]'"); //query
	$data = mysql_fetch_array($sql); //eksekusi query
 	?>
	<h3>Profil POKJA</h3>
	<tr><td>Username:</td><td><b><input onKeydown=keydown(); name="username" value="<?php echo xss_cleaner($data['Username']);?>"> </b> </td>
	<tr><td>Password:</td><td>
	<div id="pass" style="display:inline-block">********</div>
	<div id="TextPass" style="display:none;"><br><input type="password" name="password" value="<?php echo d($data['Password'])?>"></div>
	<a id="TextButton" href="#" class="text-primary" style="font-size:11;" onClick="showPass();">Ubah?</a></td>
	<tr><td>Status:</td><td>POKJA Prakerin</td>
	<tr><td>Nama Lengkap:</td><td><input name="nama" value="<?php echo xss_cleaner($data['Nama']); ?>"> </td>
	<?php 
	} ?>
	<?php	
	if (isset($_POST['submit']) OR isset($_POST['username'])){
	$a=mysql_query("UPDATE tbluser SET Username = '$_POST[username]' WHERE KdUser ='$data[KdUser]'");
	$b=mysql_query("UPDATE pokja INNER JOIN tbluser ON tbluser.KdUser = pokja.Id SET Nama= '$_POST[nama]' WHERE KdUser ='$data[KdUser]'");
	$_SESSION['notice']='Berhasil Disimpan';
	header("location:profil.php");
	if (isset($_POST['password'])){
	$encrypted=e($_POST['password']);
	$query=mysql_query("UPDATE tbluser SET Password = '$encrypted' WHERE KdUser ='$data[KdUser]'");
	}
	}
	
if($_SESSION['Level']=='kepsek'){
	$sql = mysql_query("SELECT * FROM tbluser 
	INNER JOIN tblkepsek
	ON tblkepsek.NIP = tbluser.KdUser
	WHERE tbluser.Id = '$_SESSION[Id]'"); //query
	$data = mysql_fetch_array($sql); //eksekusi query
 	?>
	<h3>Profil Kepala Sekolah</h3>
	<tr><td>Nama Lengkap:</td><td><b><input name="nama" value="<?php echo xss_cleaner($data['Nama']);?>"> </b> </td>
	<tr><td>Username:</td><td><b><input onKeydown=keydown(); name="username" value="<?php echo xss_cleaner($data['Username']);?>"> </b> </td>
	<tr><td>Password:</td><td>
	<div id="pass" style="display:inline-block">********</div>
	<div id="TextPass" style="display:none;"><br><input type="password" name="password" value="<?php echo xss_cleaner(d($data['Password']))?>"></div>
	<a id="TextButton" href="#" class="text-primary" style="font-size:11;" onClick="showPass();">Ubah?</a></td>
	<tr><td>Status:</td><td>Kepala Sekolah</td>
	<?php 
	} ?>
	<?php	
	if (isset($_POST['submit']) OR isset($_POST['username'])){
	$a=mysql_query("UPDATE tbluser SET Username = '$_POST[username]' WHERE KdUser ='$data[KdUser]'");
	$b=mysql_query("UPDATE tblkepsek INNER JOIN tbluser ON tbluser.KdUser = tblkepsek.NIP SET Nama = '$_POST[nama]' WHERE KdUser ='$data[KdUser]'");
	$_SESSION['notice']='Berhasil Disimpan';
	header("location:profil.php");
	if (isset($_POST['password'])){
	$encrypted=e($_POST['password']);
	$query=mysql_query("UPDATE tbluser SET Password = '$encrypted' WHERE KdUser ='$data[KdUser]'");
	}
	}
	//  	DUDI OWNER
	
if($_SESSION['Level']=='dudiowner' AND !isset($_GET['id'])){
	?>
	
	<h3>Profil Pemilik Perusahaan</h3>
	<?
		?>
	<tr><td>Username:</td><td><b><input onKeydown=keydown(); name="username" value="<?php echo xss_cleaner($user_nama);?>"> </b> </td>
	<tr><td>Password:</td><td>
	<div id="pass" style="display:inline-block">********</div>
	<div id="TextPass" style="display:none;"><br><input type="password" name="password" value="<?php echo xss_cleaner(d($password))?>"></div>
	<a id="TextButton" href="#" class="text-primary" style="font-size:11;" onClick="showPass();">Ubah?</a></td>
	<tr><td>Status:</td><td>Pemilik Perusahaan</td>
	<tr><td>Pemilik:</td><td><?php echo xss_cleaner($namalengkap); ?> </td>
	<tr><td>Nama Perusahaan: </td><td><input name="namap" value="<?php echo xss_cleaner($dudi); ?>"></input> </td>
	<tr><td>Alamat: </td><td><textarea name="alamat"><?php echo xss_cleaner($alamat) ; ?></textarea> </td>
	<tr><td>No. Telp:</td><td>+62<input name="telp" id="telp" value="<?php echo xss_cleaner($telp); ?>"> </td>
	<?php 
	}
	
// PERUSAHAAN DUDI -========================================================================================	
if (isset($_GET['id'])){
if ($_SESSION['Level']=='dudiowner' AND $_GET['id']==$r['Id']) {
		$sql = mysql_query("SELECT * FROM tbluser 
	INNER JOIN tblmasterdudi
	ON tblmasterdudi.Id = tbluser.KdUser
	WHERE tbluser.Id = '$_SESSION[Id]'"); //query
	$data = mysql_fetch_array($sql); //eksekusi query
 	$user_nama = $data['Username']; //register array
 	$level = $data['Level'];
 	$Id = $data['Id'];
 	$namalengkap = $data['NmPmpn'];
	$dudi=$data['NmDudi'];
	$alamat=$data['Alamat'];
 	$telp=$data['NoTelp'];
 	$password=$data['Password'];
	if (isset($_POST['submit']) OR isset($_POST['username'])){
	$sqla=mysql_query("SELECT * FROM tbluser WHERE tbluser.Id='$Id'");
	$echo=mysql_fetch_array($sqla);
	$Username=mysql_query("UPDATE tbluser SET Username= '$echo[Username]' WHERE Id ='$Id'");
	$A=mysql_query("UPDATE tblmasterdudi SET Alamat = '$_POST[alamat]' WHERE Id='$Id'");
	$B=mysql_query("UPDATE tbluser INNER JOIN tblmasterdudi ON tbluser.Id = tblmasterdudi.KdOwner SET NmDudi = '$_POST[namap]' WHERE KdUser='$data[KdUser]'");
	$C=mysql_query("UPDATE `tblmasterdudi` SET `NoTelp` = '$_POST[telp]' WHERE `tblmasterdudi`.`KdOwner` = '$data[KdOwner]'");
	$D=mysql_query("UPDATE `tblmasterdudi` SET `tipe` = '$_POST[tipe]' WHERE `tblmasterdudi`.`KdOwner` = '$data[KdOwner]'");
	$_SESSION['notice']='Data Perusahaan Berhasil Disimpan';
	header("location:profil.php?id=$data[Id]&lvl=dudiowner");
	}
	}
	}
// ----------------------------------------------------------POST DUDI END -----------------------------------
	if (isset($_GET['id'])){
	$sqldudi=mysql_query("SELECT * FROM tbluser INNER JOIN tblmasterdudi 
	ON tbluser.Id = tblmasterdudi.KdOwner 
	WHERE tbluser.Id='$_SESSION[Id]'");
	$datadudi=mysql_fetch_array($sqldudi);
	$sqljur=mysql_query("SELECT * FROM tblmasterdudi INNER JOIN tbljurusan
	ON tbljurusan.Id = tblmasterdudi.tipe
	WHERE tblmasterdudi.Id = '$_GET[id]'");
	$datajur=mysql_fetch_array($sqljur);
	}
	if (isset($_GET['id'])) {
if ($_SESSION['Level']=='dudiowner' AND $_GET['id']==$datadudi['Id']){
$explode_jurusan=explode(",",$datadudi['tipe']);
$jumlah_jurusan=substr_count($datadudi['tipe'],',');
$i=0;
	?>
	<h3>Edit Profil Perusahaan</h3>
	<tr><td>Nama Perusahaan: </td><td><input name="namap" value="<?php echo xss_cleaner($dudi); ?>"></input> </td>
	<tr><td>Alamat: </td><td><textarea name="alamat"><?php echo xss_cleaner($alamat) ; ?></textarea> </td>
	<tr><td>No. Telp:</td><td>+62<input name="telp" id="telp" value="<?php echo xss_cleaner($telp); ?>"> </td>
	<tr><td>Jurusan:</td><td>
	<?php
	//while ($jumlah_jurusan >= $i) 
	//{
	//$sqlnya=mysql_query("SELECT * FROM tbljurusan
	//WHERE Id = '$explode_jurusan[$i]'");
	//$datanya=mysql_fetch_array($sqlnya);
	//echo $datanya['Jur']; 
	?>
	<?php
	//echo "<br>";
	//$i=$i+1;
	//} ?>
	<input name="tipe" value="<?php echo xss_cleaner($data['tipe']);?>">
	<br><br><font size=2><i>
	*Jurusan diisi angka berdasarkan sbb:
	<br><?php
	$ql=mysql_query("SELECT * FROM tbljurusan");
	while($dt=mysql_fetch_array($ql)) {
	echo $dt['0'] . " = " . $dt['1'] . "<br>";
	}
	?>
	Pisahkan dengan koma
	</i>
	</font>
	</td>
	<?php 
	}
	}
	}
	?>
</table>
<input type="submit" name="submit" class="btn btn-success" value="Simpan" id="submit" align="center">
</form>
</div>
</div>
<div class="line"></div>
</body>
</html>