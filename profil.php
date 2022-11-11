<?php error_reporting(0); ?>
<!-- HTML and semi PHP code -->

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIPRIN : Sistem Informasi Prakerin - Profil Siswa</title>
<?php include('include/header.php'); //	  include header ?>
</head>
<body>
<div class='well' style="min-height:330px;"> <?php if (isset($_SESSION['notice'])) { ?>
<div class="alert alert-info"><?php echo $_SESSION['notice'];?></div>
<?php } unset($_SESSION['notice']) ?>
<table class="table table-striped table-bordered table-hover">
<?php //here it goes!!
if (isset($_SESSION['Level']))
{

	// SISWA

if($_SESSION['Level']=='siswa' AND !isset($_GET['id']) OR $_GET['lvl']=='siswa'){
	if (isset($_GET['id'])){
	$ident=$_GET['id'];
	} else {
	$ident=$_SESSION['Id'];
	}
	$sql = mysql_query("SELECT * FROM tbluser 
	INNER JOIN tblmastermahasiswa 
	ON tbluser.KdUser = tblmastermahasiswa.NIS 
	WHERE Id = '$ident'"); //query
	$data = mysql_fetch_array($sql); //eksekusi query
	$datanumrow=mysql_num_rows($sql);
 	$user_nama = $data['Username']; //register array
 	$level = $data['Level'];
 	$Id = $data['Id'];
 	$email = $data['Email'];
 	$namalengkap = $data['NmSiswa'];
 	$NIS= $data['KdUser'];
 	$TglLhr=$data['TglLhr'];
 	$TmptLhr=$data['TmptLhr'];
 	$alamat=$data['Almt'];
 	$telpon=$data['NoTelp'];
 	$Kls=$data['Kls'];
 	$Jur=$data['Jur'];
	$indikator=$data['AktifUser'];
	?>
	<h3>Profil Siswa</h3>
	<?php
	if (isset($_SESSION['notice']))
	{
		echo "<div class='alert alert-success'>";
		echo $_SESSION['notice']; 
		unset($_SESSION['notice']);  		
		echo '</div>';
	} 
	if ($datanumrow==NULL){
	header('location:404.php');
	} else {
	?>
	<?php
	$cekUdahPKLApaBelum=mysql_query("SELECT * FROM tblforwardd INNER JOIN tbluser
	ON tbluser.Id = tblforwardd.UserF 
	INNER JOIN tblmasterdudi
	ON tblmasterdudi.Id = tblforwardd.DudiF
	WHERE tbluser.Id='$Id' AND tblforwardd.Verified = 'T' AND tblforwardd.Confirmed= 'T'");
	$rst=mysql_fetch_array($cekUdahPKLApaBelum);
	$cek=$rst[2];
	
	$cekstop=mysql_query("SELECT * FROM tblforwardd INNER JOIN tbluser
	ON tbluser.Id = tblforwardd.UserF 
	INNER JOIN tblmasterdudi
	ON tblmasterdudi.Id = tblforwardd.DudiF
	WHERE tbluser.Id='$Id' AND tblforwardd.Verified = 'S' AND tblforwardd.Confirmed= 'S'");
	$rststop = mysql_fetch_array($cekstop);
	
	if ($cek<>'' OR $rststop['Verified']=='S') {
	if (!isset($_GET['id'])){?>
	<a href="absensi.php"><div class="btn">Absensi <span class="icon-book"></span></div></a>
	<a href="nilai.php"><div class="btn">Nilai <span class="icon-pencil"></span></div></a>
	<?php } else { ?>
	<a href="absensi.php?id=<?php echo $_GET['id'];?>"><div class="btn">Absensi <span class="icon-book"></span></div></a>
	<a href="nilai.php?id=<?php echo $_GET['id'];?>"><div class="btn">Nilai <span class="icon-pencil"></span></div></a>
	<?php }
	}
	if (!isset($_GET['id'])){?>
	<a href="editprofil.php"><div class="btn">Edit <span class="icon-edit"></span></div></a>
	<?php } ?>
	<br><br>
	<tr><td>Foto: </td><td><font color="crimson"><img class="img-polaroid" width="240px" height="480px" src="<?php echo $data['Path']; ?>"/>
	<?php if (!isset($_GET['id']) OR $_GET['id']==$_SESSION['Id']) { ?>
  <form id="form1" name="form1" enctype="multipart/form-data" method="post" action="upload.php">
  <label><br>
  <input name="foto" type="file" id="foto" /><br><br>
  <input class="btn btn-primary" type="submit" name="upload" id="upload" value="Upload"/>
 </label>
	</form>
	<? } ?>
 </font></td>
	<tr><td>Username:</td><td><b><?php echo xss_cleaner($user_nama) ; ?> </b> </td>
	<tr><td>Status:</td><td><?php echo $level; ?> </td>
	<tr><td>Nama Lengkap:</td><td><?php echo xss_cleaner($namalengkap) ; ?> </td>
	<tr><td>TTL: </td><td><?php echo xss_cleaner($TmptLhr) ?>, <?php echo $TglLhr ; ?> </td>
	<tr><td>Alamat: </td><td><?php echo xss_cleaner($alamat) ; ?> </td>
	<tr><td>E-mail: </td><td><?php echo xss_cleaner($email) ; ?> </td>
	<tr><td>NIS: </td><td><?php echo xss_cleaner($NIS) ; ?> </td>
	<tr><td>No. Telp: </td><td>+62<?php echo xss_cleaner($telpon); ?> </td>
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
	$sql=mysql_query("SELECT * FROM tblforwardd INNER JOIN tbluser
	ON tblforwardd.UserF = tbluser.Id
	INNER JOIN tblmasterdudi 
	ON tblforwardd.DudiF = tblmasterdudi.Id 
	INNER JOIN tblmastermahasiswa
	ON tblmastermahasiswa.NIS = tbluser.KdUser
	INNER JOIN tbljurusan
	ON tbljurusan.Id = tblmastermahasiswa.Jur
	INNER JOIN tblmasterpembimbingdudi
	ON tblmasterpembimbingdudi.Id=tblforwardd.PembimbingD
	INNER JOIN tblmasterpembimbing
	ON tblmasterpembimbing.NIP=tblforwardd.PembimbingS
	WHERE tblforwardd.UserF='$Id' AND tblforwardd.Verified='T'
	ORDER BY tblforwardd.IdF DESC");
	$rst=mysql_fetch_array($sql);
	if ($rst['NmDudi']<>''){ 
	$qdudi=mysql_query("SELECT * FROM tbluser INNER JOIN tblmasterdudi ON tbluser.Id = tblmasterdudi.KdOwner WHERE KdOwner='$rst[KdOwner]'");
	$dt=mysql_fetch_array($qdudi);?>
	<tr><td>Prakerin di: </td><td><a href="profil.php?id=<?php echo xss_cleaner($rst['DudiF']);?>&lvl=<?php echo xss_cleaner($dt['Level']);?>"><?php echo xss_cleaner($rst['NmDudi']);?></a></td>
	<?php
	$qpdudi=mysql_query("SELECT * FROM tbluser INNER JOIN tblmasterpembimbingdudi ON tbluser.KdUser=tblmasterpembimbingdudi.Id WHERE KdUser='$rst[Id]'");
	$dt=mysql_fetch_array($qpdudi);
	?>
	<tr><td>Pembimbing: </td><td><a href="profil.php?id=<?php echo $dt['0'];?>&lvl=<?php echo $dt['Level'];?>"><?php echo xss_cleaner($rst['NmPmbg']);?></a><br>
	<?php
	$qpdudi=mysql_query("SELECT * FROM tbluser INNER JOIN tblmasterpembimbing ON tbluser.KdUser=tblmasterpembimbing.NIP WHERE KdUser='$rst[NIP]'");
	$dt=mysql_fetch_array($qpdudi);
	?>
	<a href="profil.php?id=<?php echo $dt['0'];?>&lvl=<?php echo $dt['Level'];?>"><?php echo xss_cleaner($rst['NmPmbgI']);?></a></td>
	<?php } } }
	?>
	<?php 
	
	
	// PEMBIMBING
	
	
if($_SESSION['Level']=='pembimbing' AND !isset($_GET['id']) or $_GET['lvl']=='pembimbing'){
	if (isset($_GET['id'])){
	$ident=$_GET['id'];
	} else {
	$ident=$_SESSION['Id'];
	}
	$sql = mysql_query("SELECT * FROM tbluser 
	INNER JOIN tblmasterpembimbing
	ON tblmasterpembimbing.NIP = tbluser.KdUser
	WHERE tbluser.Id = '$ident'"); //query
	$data = mysql_fetch_array($sql); //eksekusi query
	$num = mysql_num_rows($sql);
	if ($num==NULL){
	header('location:404.php');
	}
	$indikator=$data['AktifUser'];
 	?>
	<h3>Profil Pembimbing</h3>
	<?
	if (!isset($_GET['id'])){?>
	<a href="editprofil.php"><div class="btn">Edit <span class="icon-edit"></span></div></a>
	<?php } ?>
	<br><br>
	<tr><td>Foto: </td><td><font color="crimson"><img class="img-polaroid" width="240px" height="480px" src="<?php echo $data['Path']; ?>"/>
	<?php if (!isset($_GET['id'])) { ?>
  <form id="form1" name="form1" enctype="multipart/form-data" method="post" action="upload.php">
  <label><br>
  <input name="foto" type="file" id="foto" /><br><br>
  <input class="btn btn-primary" type="submit" name="upload" id="upload" value="Upload"/>
 </label>
	</form>
	<? } ?>
	<tr><td>NIP:</td><td><font color="crimson"><?php echo xss_cleaner($data['NIP']); ?></font> </td>
	<tr><td>Username:</td><td><b><?php echo xss_cleaner($data['Username']);  ?></b> </td>
	<tr><td>Nama:</td><td><?php echo xss_cleaner($data['NmPmbgI']);  ?> </td>
	<tr><td>Alamat:</td><td><?php echo xss_cleaner($data['Almt']);  ?> </td>
	<tr><td>Status:</td><td>Pembimbing dari Sekolah</td>
	<tr><td>:</td><td>+62<?php echo xss_cleaner($data['NoTelp']);?></td>
	<?php }
	
	//	PEMBIMBING DUDI
		
if($_SESSION['Level']=='pembimbingdudi' AND !isset($_GET['id']) or $_GET['lvl']=='pembimbingdudi'){
	if (isset($_GET['id'])){
	$ident=$_GET['id'];
	} else {
	$ident=$_SESSION['Id'];
	}
	$sql = mysql_query("SELECT * FROM tbluser 
	INNER JOIN tblmasterpembimbingdudi
	ON tblmasterpembimbingdudi.Id = tbluser.KdUser
	INNER JOIN tblmasterdudi
	ON tblmasterdudi.Id = tblmasterpembimbingdudi.IdDudi
	WHERE tbluser.Id = '$ident'"); //query
	$data = mysql_fetch_array($sql); //eksekusi query
	$num = mysql_num_rows($sql);
	if ($num==NULL){
	header('location:404.php');
	}
	$indikator=$data['AktifUser'];
 	?>
	<h3>Profil Pembimbing DU/DI</h3>
	<?
	if (!isset($_GET['id'])){?>
	<a href="editprofil.php"><div class="btn">Edit <span class="icon-edit"></span></div></a>
	<?php } ?>
	<br><br>
	<tr><td>Foto: </td><td><font color="crimson"><img class="img-polaroid" width="240px" height="480px" src="<?php echo $data['Path']; ?>"/>
	<?php if (!isset($_GET['id'])) { ?>
  <form id="form1" name="form1" enctype="multipart/form-data" method="post" action="upload.php">
  <label><br>
  <input name="foto" type="file" id="foto" /><br><br>
  <input class="btn btn-primary" type="submit" name="upload" id="upload" value="Upload"/>
 </label>
	</form>
	<? } ?>
	<tr><td>Nomor User:</td><td><font color="crimson"><?php echo $data['Id']; ?></font> </td>
	<tr><td>Username:</td><td><b><?php echo xss_cleaner($data['Username']);  ?></b> </td>
	<tr><td>Nama:</td><td><b><?php echo xss_cleaner($data['NmPmbg']);  ?></b> </td>
	<tr><td>Status:</td><td>Pembimbing dari DU/DI</td>
	<tr><td>Instansi:</td><td><?php echo xss_cleaner($data['NmDudi']);?></td>
	<tr><td>No. Telp:</td><td>+62<?php echo xss_cleaner($data['11']);?></td>
	<?php }
	
	// KEPSEK
	
	
if($_SESSION['Level']=='kepsek' AND !isset($_GET['id']) or $_GET['lvl']=='kepsek'){
	if (isset($_GET['id'])){
	$ident=$_GET['id'];
	} else {
	$ident=$_SESSION['Id'];
	}
	$sql = mysql_query("SELECT * FROM tbluser 
	INNER JOIN tblkepsek
	ON tblkepsek.NIP = tbluser.KdUser
	WHERE tbluser.Id = '$ident'"); //query
	$data = mysql_fetch_array($sql); //eksekusi query
	$num=mysql_num_rows($sql);
	if ($num==NULL){
	header('location:404.php');
	}
	$indikator=$data['AktifUser'];
 	?>
	<h3>Profil Kepala Sekolah</h3>
	<?
	if (!isset($_GET['id'])){?>
	<a href="editprofil.php"><div class="btn">Edit <span class="icon-edit"></span></div></a>
	<?php } ?>
	<br><br>
	<tr><td>Foto: </td><td><font color="crimson"><img class="img-polaroid" width="240px" height="480px" src="<?php echo $data['Path']; ?>"/>
	<?php if (!isset($_GET['id'])) { ?>
  <form id="form1" name="form1" enctype="multipart/form-data" method="post" action="upload.php">
  <label><br>
  <input name="foto" type="file" id="foto" /><br><br>
  <input class="btn btn-primary" type="submit" name="upload" id="upload" value="Upload"/>
 </label>
	</form>
	<? } ?>
	<tr><td>NIP:</td><td><font color=crimson><?php echo xss_cleaner($data['NIP']); ?></font> </td>
	<tr><td>Nama Lengkap:</td><td><?php echo xss_cleaner($data['Nama']); ?> </td>
	<tr><td>Username:</td><td><b><?php echo xss_cleaner($data['Username']);  ?></b> </td>
	<tr><td>Status:</td><td>Kepala Sekolah</td>
	<?php }
	
	//pokja
	
if($_SESSION['Level']=='pokja' AND !isset($_GET['id']) or $_GET['lvl']=='pokja'){
	if (isset($_GET['id'])){
	$ident=$_GET['id'];
	} else {
	$ident=$_SESSION['Id'];
	}
	$sql = mysql_query("SELECT * FROM tbluser 
	INNER JOIN pokja
	ON pokja.Id = tbluser.KdUser
	WHERE tbluser.Id = '$ident'"); //query
	$data = mysql_fetch_array($sql); //eksekusi query
	$num = mysql_num_rows($sql);
	$indikator=$data['AktifUser'];
	if ($num=='NULL'){
	header('location:404.php');
	}
 	?>
	<h3>Profil POKJA</h3>
	<?
	if (!isset($_GET['id'])){?>
	<a href="editprofil.php"><div class="btn">Edit <span class="icon-edit"></span></div></a>
	<?php } ?>
	<br><br>
	<tr><td>Foto: </td><td><font color="crimson"><img class="img-polaroid" width="240px" height="480px" src="<?php echo $data['Path']; ?>"/>
	<?php if (!isset($_GET['id'])) { ?>
  <form id="form1" name="form1" enctype="multipart/form-data" method="post" action="upload.php">
  <label><br>
  <input name="foto" type="file" id="foto" /><br><br>
  <input class="btn btn-primary" type="submit" name="upload" id="upload" value="Upload"/>
 </label>
	</form>
	<? } ?>
	<tr><td>Nama:</td><td><b><?php echo xss_cleaner($data['Nama']);  ?></b> </td>
	<tr><td>Username:</td><td><b><?php echo xss_cleaner($data['Username']);  ?></b> </td>
	<tr><td>Status:</td><td>Kelompok Kerja Prakerin</td>
	<?PHP 
	$qdatapokja=mysql_query("SELECT * FROM tbluser INNER JOIN pokja ON tbluser.KdUser = pokja.Id WHERE tbluser.Id='$ident'");
	$datapokja=mysql_fetch_array($qdatapokja);
	?>
	<tr><td>Nama Lengkap</td><td><?php echo xss_cleaner($datapokja['Nama']);?></td>
	<?php }
	
if ($_SESSION['Level']=='admin' AND !isset($_GET['id'])) {
if (isset($_GET['id'])){
	$ident=$_GET['id'];
	} else {
	$ident=$_SESSION['Id'];
	}
	$sql = mysql_query("SELECT * FROM tbluser 
	WHERE tbluser.Id = '$ident'"); //query
	$data = mysql_fetch_array($sql); //eksekusi query
	$num = mysql_num_rows($sql);
	$indikator=$data['AktifUser'];
	if ($num=='NULL'){
	header('location:404.php');
	}
 	?>
	<h3>Profil ADMIN</h3>
	<?
	if (!isset($_GET['id'])){?>
	<a href="editprofil.php"><div class="btn">Edit <span class="icon-edit"></span></div></a>
	<?php } ?>
	<br><br>
	<tr><td>Foto: </td><td><font color="crimson"><img class="img-polaroid" width="240px" height="480px" src="<?php echo $data['Path']; ?>"/>
	<?php if (!isset($_GET['id'])) { ?>
  <form id="form1" name="form1" enctype="multipart/form-data" method="post" action="upload.php">
  <label><br>
  <input name="foto" type="file" id="foto" /><br><br>
  <input class="btn btn-primary" type="submit" name="upload" id="upload" value="Upload"/>
 </label>
	</form>
	<? } ?>
	<tr><td>Username:</td><td><b><?php echo xss_cleaner($data['Username']);  ?></b> </td>
	<tr><td>Status:</td><td>ADMINISTRATOR</td>
	<?PHP 
	$qdatapokja=mysql_query("SELECT * FROM tbluser WHERE tbluser.Id='$ident'");
	$datapokja=mysql_fetch_array($qdatapokja);
	?>
	<?php
}
	//  	DUDI OWNER
	
if($_SESSION['Level']=='dudiowner' AND !isset($_GET['id']) or $_GET['lvl']=='dudiowner'){
	if (isset($_GET['id'])){
	$ident=$_GET['id'];
	} else {
	$ident=$_SESSION['Id'];
	}
	?>
	<?php
	if (isset($_SESSION['notice']))
	{
		echo "<div class='alert alert-success'>";
		echo $_SESSION['notice']; 
		unset($_SESSION['notice']);  		
		echo '</div>';
		unset($_SESSION['notice']);
	} 
	?>
	<?
	if (substr($_GET['id'],0,1)=='D'){
	$sql = mysql_query("SELECT * FROM tblmasterdudi INNER JOIN tbljurusan
	ON tbljurusan.Id=tblmasterdudi.tipe
	WHERE tblmasterdudi.Id = '$ident'"); //query
	$data = mysql_fetch_array($sql); //eksekusi query
	$num = mysql_num_rows($sql);
	$sqli = mysql_query("SELECT * FROM tblmasterdudi INNER JOIN tbljurusan
	ON tbljurusan.Id=tblmasterdudi.tipe
	INNER JOIN tbluser
	ON tbluser.Id = tblmasterdudi.KdOwner
	WHERE tblmasterdudi.Id = '$ident'"); //query
	$datai = mysql_fetch_array($sqli); //eksekusi query
	$skl = mysql_query("SELECT * FROM tblmasterdudi INNER JOIN tbljurusan
	ON tbljurusan.Id=tblmasterdudi.tipe
	WHERE tblmasterdudi.Id = '$ident' AND tblmasterdudi.tipe LIKE '%$data[Id]%'"); //query
	$data1 = mysql_fetch_array($skl); //eksekusi query
	if ($num==0) {
	header('location:404.php');
	}
	?> 
	
	<h3>Profil Perusahaan</h3>
	<ul class="nav nav-pills">
	<li class="active"><a href="profil.php?id=<?php echo $data1['0'];?>&lvl=dudiowner">Profil</a></li>
	<?php 
	$exp=explode(",",$data1['tipe']); 
	$count=substr_count($data1['tipe'],',');
	$i=0;
	$active="";
	while ($count>=$i) {
	$sql2 = mysql_query("SELECT * FROM tblmasterdudi INNER JOIN tbljurusan
	ON tbljurusan.Id = $exp[$i]");
	$data2=mysql_fetch_array($sql2);?> 
	<li <?php echo $active;?>><a href="lihatsiswamagang.php?id=<?php echo $data1[0]; ?>&jur=<?php echo xss_cleaner($exp[$i]);?>"><?php echo xss_cleaner($data2['Jur']);?></a></li> <?php
	$i=$i+1;
	}
	if ($_GET['id']==$data[0] AND $_SESSION['Level']=='dudiowner'){?>
	<br><br>
	<a href="editprofil.php"><div class="btn">Edit <span class="icon-edit"></span></div></a>
	<?php } ?>
</ul>
	<?php
	$profil=1;
	$sqlq=mysql_query("SELECT * FROM tblmasterdudi INNER JOIN tbluser
	ON tbluser.Id = tblmasterdudi.KdOwner
	WHERE tblmasterdudi.Id='$ident'");
	$dataq=mysql_fetch_array($sqlq);
	?>
	<tr><td>Foto: </td><td><font color="crimson"><img class="img-polaroid" width="240px" height="480px" src="<?php echo $dataq['PathD']; ?>"/>
	<?php if ($_GET['id']==$data[0] OR $_SESSION['Level']=='dudiowner') { ?>
	<?php
	if($profil==1){
	$_SESSION['DUDI']=1;
	}
	?>
  <?php if ($_SESSION['Level']=='dudiowner') { ?>
  <form id="form1" name="form1" enctype="multipart/form-data" method="post" action="upload.php">
  <label><br>
  <input name="foto" type="file" id="foto" /><br><br>
  <input class="btn btn-primary" type="submit" name="upload" id="upload" value="Upload"/>
 </label>
	</form>
	<? } }?>
	<tr><td>Nama Perusahaan:</td><td><b><?php echo xss_cleaner($data['NmDudi']);  ?></b> </td>
	<tr><td>Alamat:</td><td><?php echo xss_cleaner($data['Alamat']);  ?> </td>
	<tr><td>No. Telp:</td><td>+62<?php echo xss_cleaner($data['NoTelp']);  ?> </td>
	<tr><td>Pemimpin Perusahaan</td><td><a href="profil.php?id=<?php echo xss_cleaner($data['KdOwner']);?>&lvl=<?php echo $datai['Level'];?>"><?php echo xss_cleaner($data['NmPmpn']);  ?> </a></td>
	<tr><td>Status:</td><td>Perusahaan</td>
	<?php
	} else {
	$sql = mysql_query("SELECT * FROM tbluser INNER JOIN tblmasterdudi
	ON tbluser.Id = tblmasterdudi.KdOwner
	WHERE tbluser.Id = '$ident'"); //query
	$data = mysql_fetch_array($sql); //eksekusi query
	$indikator=$data['AktifUser'];
	$num = mysql_num_rows($sql);
	if ($num=="NULL"){
	header('location:404.php');
	}
 	?>
	<h3>Profil Pemilik Perusahaan</h3>
	<?php
	if (!isset($_GET['id']) OR $_SESSION['Level']=='dudiowner'){?>
	<a href="editprofil.php"><div class="btn">Edit <span class="icon-edit"></span></div></a>
	<?php } ?>
	<br><br>
	<tr><td>Foto: </td><td><font color="crimson"><img class="img-polaroid" width="240px" height="480px" src="<?php echo $data['Path']; ?>"/>
	<?php if (!isset($_GET['id']) OR $_GET['id']==$_SESSION['Id'] ) { ?>
  <form id="form1" name="form1" enctype="multipart/form-data" method="post" action="upload.php">
  <label><br>
  <input name="foto" type="file" id="foto" /><br><br>
  <input class="btn btn-primary" type="submit" name="upload" id="upload" value="Upload"/>
 </label>
	</form>
	<? } ?>
	<tr><td>Username:</td><td><b><?php echo xss_cleaner($data['Username']);  ?></b> </td>
	<tr><td>Nama:</td><td><?php echo xss_cleaner($data['NmPmpn']);  ?> </td>
	<tr><td>No. Telp:</td><td>+62<?php echo xss_cleaner($data['NoTelp']);  ?> </td>
	<tr><td>Status:</td><td>Pimpinan DU/DI</td>
	<tr><td>Perusahaan:</td><td><a href="profil.php?id=<?php echo $data['Id'];?>&lvl=<?php echo xss_cleaner($data['Level']);?>"><?php echo xss_cleaner($data['NmDudi']);?></a></td>
	<?php } } elseif ($_GET['lvl']<>'dudiowner' AND $_GET['lvl']<>'siswa' AND $_GET['lvl']<>'pembimbing' AND $_GET['lvl']<>'pembimbingdudi' AND $_GET['lvl']<>'kepsek' AND $_GET['lvl']<>'pokja' AND isset($_GET['lvl'])) {
		if ($num==NULL){
	header('location:404.php');
	}}
	}?>

<?php if ($indikator=='y')
{ 
	$warna="img/on.png";
} else {
	$warna="img/off.png";
}
if ($data<>NULL AND substr($_GET['id'],0,1)<>'D') {
echo "<tr><td>Aktif User:</td><td><img src='$warna' width='16px height='16px'></td></td></tr>";
}
?>
</table>
</div>
</div>
<div class="line"></div>
</body>
</html>