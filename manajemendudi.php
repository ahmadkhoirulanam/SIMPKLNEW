<?php include('include/header.php'); //	Include and load header

	// Execute sql query
	
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
<title>SIPRIN : Sistem Informasi Prakerin - Manajemen DU/DI</title>
</head>
<body>
<div class="well" style="min-height:320px">
<?php if (isset($_SESSION['notice'])) { ?>
<div class="alert alert-info"><?php echo $_SESSION['notice'];?></div>
<?php } unset($_SESSION['notice']) ?>
<table class="table table-striped table-bordered table-hover" style="width:700px;margin-left:auto;margin-right:auto;">
<tr><th>No</th><th>Manajemen</th><th>Lama Kontrak</th><th>Pembimbing</th><th>Action</th>

<?php 
$i=0;
if ($_SESSION['Level']=='dudiowner') {
$query=mysql_query("SELECT * FROM tblforwardd INNER JOIN tbluser
	ON tblforwardd.UserF = tbluser.Id 
	INNER JOIN tblmasterdudi 
	ON tblforwardd.DudiF = tblmasterdudi.Id 
	INNER JOIN tblmastermahasiswa
	ON tblmastermahasiswa.NIS = tbluser.KdUser
	INNER JOIN tbljurusan
	ON tbljurusan.Id = tblmastermahasiswa.Jur
	WHERE tblmasterdudi.KdOwner='$Id' AND tblforwardd.Verified='T'
	ORDER BY tblforwardd.IdF DESC");
$num = mysql_num_rows($query);
if($num==NULL) {
echo "<tr><td colspan=5><div align=center><font color=gray>TIDAK ADA DATA</font></div></td></tr>";
} else {
while ($data=mysql_fetch_array($query))
{ 
?>
<form name="submiting<?php echo $i;?>" method="POST" action="manajemendudi.php?id=<?php echo $data['0']; ?>">
<tr>
<td><?php $i=$i+1; echo $i;?> </td>
<td><b><?php echo xss_cleaner($data['NmSiswa']);?></b> <br><div class="help-block" style="font-size:12;"><?php echo xss_cleaner($data['Jur']);?></div>
<a href="profil.php?id=<?php echo xss_cleaner($data['UserF']);?>&lvl=siswa"><font size='2'>Lihat Profil</font></a> | 
<a href="nilai.php?id=<?php echo xss_cleaner($data['UserF']);?>"><font size='2'>Lihat Nilai</font></a> | 
<a href="absensi.php?id=<?php echo xss_cleaner($data['UserF']); ?>"><font size='2'>Lihat Absensi</font></a>
</td>
<td>


<?php 
$Now = date("Y-m-d");
$PKL = substr($data['TimestampF'],0,10);
//echo "Sudah PKL selama ".date("Y/m/d", $lama);
$pecah1 = explode("-", $Now);
$date1 = $pecah1['2']; 
$month1 = $pecah1['1']; 
$year1 = $pecah1['0']; 

$pecah2 = explode("-", $PKL);
$date2 = $pecah2['2']; 
$month2 = $pecah2['1']; 
$year2 = $pecah2['0']; 

$jd1=GregorianToJD($month1,$date1,$year1);
$jd2=GregorianToJD($month2,$date2,$year2);
$diff = $jd1-$jd2;
echo $diff . " Hari";
?>


</td>
<td>
<?php
if ($data['PembimbingD']==''){
?>
<select name="pembimbing" id="pembimbing">
<?php 
$que=mysql_query("SELECT * FROM tblmasterdudi WHERE KdOwner='$Id'");
$dt=mysql_fetch_array($que);
$tblpemdudi=mysql_query("SELECT * FROM tblmasterpembimbingdudi WHERE IdDudi='$dt[Id]'");
while ($hasil=mysql_fetch_array($tblpemdudi)){
echo "<option value='$hasil[Id]'>";
echo $hasil['NmPmbg'];
echo "</option>";
}
} else {
$queryz=mysql_query("SELECT * FROM tblforwardd INNER JOIN tbluser
	ON tblforwardd.UserF = tbluser.Id 
	INNER JOIN tblmasterdudi 
	ON tblforwardd.DudiF = tblmasterdudi.Id 
	INNER JOIN tblmastermahasiswa
	ON tblmastermahasiswa.NIS = tbluser.KdUser
	INNER JOIN tbljurusan
	ON tbljurusan.Id = tblmastermahasiswa.Jur
	INNER JOIN tblmasterpembimbingdudi
	ON tblmasterpembimbingdudi.Id = tblforwardd.PembimbingD
	WHERE tblmasterdudi.KdOwner='$Id' AND tblforwardd.Verified='T'
	ORDER BY tblforwardd.IdF DESC");
$res=mysql_fetch_array($queryz);
echo "-".$res['NmPmbg'] . " (Inner)";
if ($data['PembimbingS']==NULL){
echo "<br>-Belum Ada (Outter)";
} else {
$queryz=mysql_query("SELECT * FROM tblforwardd INNER JOIN tbluser
	ON tblforwardd.UserF = tbluser.Id 
	INNER JOIN tblmasterdudi 
	ON tblforwardd.DudiF = tblmasterdudi.Id 
	INNER JOIN tblmastermahasiswa
	ON tblmastermahasiswa.NIS = tbluser.KdUser
	INNER JOIN tbljurusan
	ON tbljurusan.Id = tblmastermahasiswa.Jur
	INNER JOIN tblmasterpembimbing
	ON tblmasterpembimbing.NIP = tblforwardd.PembimbingS
	WHERE tblmasterdudi.KdOwner='$Id' AND tblforwardd.Verified='T'
	ORDER BY tblforwardd.IdF DESC");
$res=mysql_fetch_array($queryz);
echo "<br>-" . $res['NmPmbgI'] . " (Outter)";
}
} 
?>
</select></td><td>
<?php if ($data['PembimbingD']==''){ ?>
<input class="btn btn-primary" type="submit" name="submit" value="Tambahkan"></input></td>
<?php } else{ ?>
<input class='btn btn-danger' type=submit name=delete value='Berhentikan'>
<?php } ?></form><? } } } else {
header('location:404.php');
}?>
</table>
</div> 
<div class="line"></div></div>
</body>
</html>

<?php
if (isset($_POST['pembimbing'])){
echo "hai";
echo $_POST['pembimbing'];
echo $_GET['id'];
$pembimbing=$_POST['pembimbing'];
$masukkandata=mysql_query("UPDATE `tblforwardd` SET `PembimbingD` = '$pembimbing' WHERE `tblforwardd`.`IdF` ='$_GET[id]'");
header('location:manajemendudi.php');
}
if (isset($_POST['delete'])){
echo "hai";
$del=$_GET['id'];
$query = mysql_query("SELECT * FROM tblmasterdudi INNER JOIN tblforwardd ON tblforwardd.DudiF = tblmasterdudi.Id WHERE tblforwardd.IdF = '$del'");
$magangcount = mysql_fetch_array($query);
if ($magangcount['magang']==0){
$dikurangi = 0;
} else {
$dikurangi = $magangcount['magang']-1;
}
$update=mysql_query("UPDATE tblforwardd INNER JOIN tblmasterdudi ON tblmasterdudi.Id  = tblforwardd.DudiF 
SET tblmasterdudi.magang = '$dikurangi'
WHERE tblforwardd.IdF = '$del'");
$delete=mysql_query("UPDATE tblforwardd SET Verified = 'S', Confirmed = 'S' WHERE IdF='$del'");
$update=mysql_query("UPDATE tblforwardd INNER JOIN tblmasterdudi ON tblmasterdudi.Id  = tblforwardd.DudiF 
SET tblmasterdudi.magang = '$dikurangi'
WHERE tblforwardd.IdF = '$del'");
$_SESSION['notice']='Berhasil Diberhentikan!';
header('location:manajemendudi.php');
}
?>