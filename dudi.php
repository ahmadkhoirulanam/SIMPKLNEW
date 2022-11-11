<?php include('include/header.php'); //	Include and load header

	// Execute sql query TBLUSER
	
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
<title>SIPRIN : Sistem Informasi Prakerin - Daftar DU/DI</title>
</head>
<body>
<div class="well">
<?php

if ($_SESSION['Level']<>'siswa') {
echo "<div style='background-color:lightyellow; padding:15px; border: 1px blue dashed'><i>Cara membaca kode jurusan: <br>"; 
$sqljur=mysql_query("SELECT * FROM tbljurusan");
while ($row=mysql_fetch_array($sqljur)) {
echo $row[0] . " = " . $row[1] . "<br>";
echo "</i>"; }
echo "</div><br><br>";
}

if (isset($_SESSION['notice'])){ ?>
	<br>
	<div class="alert alert-danger"><?php echo $_SESSION['notice'];?></div>
	<?php }
	unset($_SESSION['notice']);
$cekUdahPKLApaBelum=mysql_query("SELECT * FROM tblforwardd INNER JOIN tbluser
ON tbluser.Id = tblforwardd.UserF 
INNER JOIN tblmasterdudi
ON tblmasterdudi.Id = tblforwardd.DudiF
WHERE tbluser.Id='$Id' AND tblforwardd.Verified = 'T' AND tblforwardd.Confirmed= 'T'");
$rst=mysql_fetch_array($cekUdahPKLApaBelum);
$cek=$rst[2];
if ($cek<>NULL){
if ($_SESSION['Level']=='siswa'){
$fullsql=mysql_query("SELECT * FROM tbluser 
	INNER JOIN tblmastermahasiswa 
	ON tbluser.KdUser = tblmastermahasiswa.NIS
	INNER JOIN tblforwardd
	ON tbluser.Id = tblforwardd.UserF
	WHERE tbluser.Id = '$_SESSION[Id]' AND tblforwardd.Verified='T' AND tblforwardd.Confirmed='T'");
	$datasiswa=mysql_fetch_array($fullsql); 
$sqlpembimbing=mysql_query("SELECT * FROM tbluser
INNER JOIN tblforwardd
ON tbluser.Id = tblforwardd.UserF
INNER JOIN tblmasterpembimbingdudi
ON tblmasterpembimbingdudi.Id = tblforwardd.PembimbingD
WHERE tblmasterpembimbingdudi.Id = '$datasiswa[PembimbingD]'");
	if ($sqlpembimbing<>NULL){
	$datapembimbingdudi=mysql_fetch_array($sqlpembimbing);
	$dtpmbgd=$datapembimbingdudi['NmPmbg'];
	} else {
	$dtpmbgd="Belum Ada";
	}
$sqlpembimbing1=mysql_query("SELECT * FROM tbluser
INNER JOIN tblforwardd
ON tbluser.Id = tblforwardd.UserF
INNER JOIN tblmasterpembimbing
ON tblmasterpembimbing.NIP = tblforwardd.PembimbingS
WHERE tblmasterpembimbing.NIP = '$datasiswa[PembimbingS]'");
	if ($sqlpembimbing1<>NULL){
	$datapembimbing=mysql_fetch_array($sqlpembimbing1);
	$dtpmbg=$datapembimbing['NmPmbgI'];
	} else {
	$dtpmbg="Belum Ada";
	}
?>
<table class="table table-condensed" style="background-color:lightgreen;">
<tr>
<td>Nama</td><td>: <b><?php echo xss_cleaner($datasiswa['NmSiswa']);?></b><br></td>
</tr>
<tr>
<td>NIS</td><td>: <?php echo xss_cleaner($datasiswa['NIS']); ?><br></td>
</tr>
<tr>
<td>Kelas</td><td>: <?php echo xss_cleaner($datasiswa['Kls']); ?><br></td>
<td>Pembimbing</td><td>: <b><?php echo $dtpmbg; ?></b><br></td>
</tr>
<tr>
<td>Magang</td><td>: <?php echo xss_cleaner($rst['NmDudi']); ?><br></td>
<td>Pembimbing DU/DI</td><td>: <b><?php echo xss_cleaner($dtpmbgd);?></b><br></td>
</tr>
</table>
<br>
<?php
}
}
$query=mysql_query("SELECT * FROM tbljurusan WHERE tbljurusan.Id= '$_SESSION[Jurusan]'");
$datajurusan=mysql_fetch_array($query);
?>
<?php if (!isset($_GET['all']) AND $_SESSION['Level']=='siswa'){ ?>
Berikut daftar DU/DI yang bergerak di bidang <b><?php echo xss_cleaner($datajurusan['Jur']);?></b>:
<br>
<br>
<?php } ?>
<table class="table table-bordered" style="width:700px;margin-left:auto;margin-right:auto;">
<tr bgcolor="blue" style="color:white;"><th>No</th><th>Nama Perusahaan</th><th>Peserta</th><?php if ($cek==NULL AND !isset($_GET['all']) AND $_SESSION['Level']=='siswa') { echo"<th>Action</th>"; } elseif ($_SESSION['Level']<>'siswa') { echo"<th>Kode Jurusan</th>"; } ?>

<?php 
if (isset($_GET['all'])){
if ($_GET['all']=='yes') {
$ketdudi="Jurusan '$datajurusan[Jur]' saja";
$query=mysql_query("SELECT * FROM tblmasterdudi INNER JOIN tbljurusan 
	ON tbljurusan.Id = tblmasterdudi.tipe");
} else {
$_SESSION['notice']='Parameter Salah';
header('location:dudi.php');
}
} else {
$ketdudi="Semua Jurusan";
$query=mysql_query("SELECT * FROM tblmasterdudi INNER JOIN tbljurusan 
	ON tbljurusan.Id = tblmasterdudi.tipe WHERE tblmasterdudi.tipe like '%$_SESSION[Jurusan]%'");
}
$i=0;    // COunter 
while ($data=mysql_fetch_array($query))
{ 
$subCount=0;
?>

<tr bgcolor="white"><td><?php $i=$i+1; echo $i; ?> </td>
<td><a href="profil.php?id=<?php echo $data['0']?>&lvl=dudiowner"><?php echo $data['NmDudi'];?></a></td>
<td><font <?php if ($data['magang']<>0) { echo "color='green'"; } ?>><?php if ($data['magang']==0){echo "<div align=left style='color:green;'>0 / $data[dayatampung]</div>";}else { if ($data['dayatampung']==$data['magang']) {echo "<font color='red'><b>PENUH</b></font>" . " / " . $data['dayatampung'];} else {echo xss_cleaner($data['magang']) . " / " . xss_cleaner($data['dayatampung']);}}?> </font></td>
<?php if ($cek==NULL AND !isset($_GET['all'])) {
echo "<td><br>";
}?>
<?php 
$queryz=mysql_query("SELECT * FROM tblforwardd WHERE UserF='$Id' And DudiF='$data[0]' AND Verified='F'");
$dataz=mysql_fetch_array($queryz);
$Check= $dataz['DudiF'];
if ($Check<>Null AND $cek==NULL AND !isset($_GET['all'])) {
echo "Anda sudah mengirimkan permohonan, tunggu balasan";
}
$queryz2=mysql_query("SELECT * FROM tblpermohonan WHERE Nama='$Id' And Dudi='$data[0]'");
$dataz2=mysql_fetch_array($queryz2);
$Check2= $dataz2['Nama'];
if ($Check2<>Null AND $cek==NULL AND !isset($_GET['all'])) {
echo "Anda sudah mengirimkan permohonan, tunggu balasan";
}
$cektolakapabelum=mysql_query("SELECT * FROM tblreason WHERE IdDudi='$data[0]' AND UserId='$Id' AND Terima='0'");
$datacek=mysql_fetch_array($cektolakapabelum);
$kueri=mysql_query("SELECT * FROM tblforwardd WHERE UserF='$Id' AND DudiF='$data[0]' AND Confirmed<>'T'");
$datak=mysql_fetch_array($kueri);
$Ceklagi=$datak['0'];
// JIKA DITOLAK
if ($datacek[0]<>NULL AND $cek==NULL){
echo "<font color=red>Anda tidak dapat mengirimkan permohonan Prakerin ke pihak bersangkutan karena ditolak</font>";
} 
// BERARTI BELUM DITOLAK
elseif ($cek==NULL){
if ($Check==NULL){
if ($Ceklagi<>NULL and !isset($_GET['all']) and $datak['Verified']<>'S' and $datak['Confirmed']<>'S'){
echo "<font color=green>Anda diterima di DU/DI yang bersangkutan. Silakan konfirmasi lewat pemberitahuan</font>";
}else{ 
if (!isset($_GET['all']) AND $Check2==NULL AND $data['magang']<>$data['dayatampung'] AND $_SESSION['Level']=='siswa') { 
$sqlsql = mysql_query("SELECT * FROM tbluser INNER JOIN tblforwardd ON tblforwardd.UserF = tbluser.Id WHERE tbluser.Id = '$_SESSION[Id]'");
$rou = mysql_fetch_array($sqlsql);
if ($rou['Verified']=='S') {
echo "-";
} else {
?>
<a href="siswa/send.php?id=<?php echo $data['0']; ?>"><div class="btn btn-primary"><span class="icon-hdd"></span> Ajukan Permohonan</div></a></td>
<?php } }elseif ($_SESSION['Level']<>'siswa') {
echo xss_cleaner($data['tipe']);
}
$JurPieces=explode(",", $data['tipe']);       // Nilai explode array contoh Jurpieces [0] => 5, [1] => 6 ....
$JumlahJur=substr_count($data['tipe'],',');   // hitung jumlah KOMA  ( , )
if ($JumlahJur<>0) 
{
	while($subCount<=$JumlahJur)  // subcount awal 0, jumlahjur maksimal 6
	{
	$sql = mysql_query("SELECT * FROM tblmasterdudi INNER JOIN tbljurusan
	ON tbljurusan.Id = $JurPieces[$subCount]");
	$data=mysql_fetch_array($sql);
	// echo "-" . $data['Jur'] . "<br>";
	$subCount=$subCount+1;
	}
} else {
	// echo "-" . $data['Jur'];
}
?>
<?php } 
}}}
$query2=mysql_query("SELECT * FROM tblmasterdudi INNER JOIN tbljurusan 
	ON tbljurusan.Id = tblmasterdudi.tipe WHERE tblmasterdudi.tipe like '%$_SESSION[Jurusan]%'");
$data2 = mysql_fetch_array($query2);
if ($data2['0']==NULL) {
echo "<tr><td colspan=4><div align=center><font color=gray>TIDAK ADA DATA</font></div></td></tr>";
}
?>

</table>
<?php
if ($_SESSION['Level']=='siswa') {
?>
<a href="dudi.php<?php if (!isset($_GET['all'])) { echo "?all=yes"; } else { echo "";}; 
 ?>">[Lihat <?php echo $ketdudi;?>]</a>

<?php
} ?>
 </div> 
<div class="line"></div>
</body>
</html>