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
$sql_define_user=mysql_query("SELECT * FROM tbluser INNER JOIN tblmasterpembimbing 
ON tblmasterpembimbing.NIP = tbluser.KdUser
WHERE tbluser.Id = '$Id'");
$sqluser=mysql_fetch_array($sql_define_user);
	?>

<!-- HTML and semi PHP code -->

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIPRIN : Sistem Informasi Prakerin - Bimbingan</title>
</head>
<body>
<div class="well"  style="min-height:330px;">
<?php if ($_SESSION['Level']=='pembimbing') { ?>
<table class="table table-striped table-bordered table-hover" style="width:700px;margin-left:auto;margin-right:auto;">
<tr><th>No</th><th>Manajemen</th><th>Pembimbing</th><th>Action</th>

<?php 
$i=0;
$sql_pembimbing="";
$query=mysql_query("SELECT * FROM tblforwardd INNER JOIN tbluser
	ON tblforwardd.UserF = tbluser.Id 
	INNER JOIN tblmasterdudi 
	ON tblforwardd.DudiF = tblmasterdudi.Id 
	INNER JOIN tblmastermahasiswa
	ON tblmastermahasiswa.NIS = tbluser.KdUser
	INNER JOIN tbljurusan
	ON tbljurusan.Id = tblmastermahasiswa.Jur 
	INNER JOIN tblmasterpembimbing
	ON tblmasterpembimbing.NIP = tblforwardd.PembimbingS
	WHERE tblforwardd.Verified='T' AND tblforwardd.PembimbingS='$sqluser[NIP]'
	ORDER BY tblforwardd.IdF DESC");
while ($data=mysql_fetch_array($query))
{ 
?>
<form name="submiting" method="POST" action="manajemenpembs.php?id=<?php echo xss_cleaner($data['0']); ?>">
<tr>
<td><?php $i=$i+1; $i; ?> </td>
<td><b><a href="profil.php?id=<?php echo xss_cleaner($data['UserF'])?>&lvl=<?php echo xss_cleaner($data['Level'])?>"><?php echo xss_cleaner($data['NmSiswa']);?></a></b> <br><div class="help-block" style="font-size:12;"><?php echo xss_cleaner($data['Jur']);?> (<a href="profil.php?id=<?php echo xss_cleaner($data['DudiF']);?>&lvl=dudiowner"><?php echo xss_cleaner($data['NmDudi']);?>)</a></div></td>
<td>
<?php
if ($data['PembimbingS']==NULL){
?>
<select name="pmbg" id="pmbg">
<?php 
$tblpemdudi=mysql_query("SELECT * FROM tblmasterpembimbing");
while ($hasil=mysql_fetch_array($tblpemdudi)){
echo "<option value='$hasil[NIP]'>";
echo $hasil['NmPmbgI'];
echo "</option>";
}
} else {
$tblpemdudi=mysql_query("SELECT * FROM tblforwardd INNER JOIN tbluser
	ON tblforwardd.UserF = tbluser.Id 
	INNER JOIN tblmasterdudi 
	ON tblforwardd.DudiF = tblmasterdudi.Id 
	INNER JOIN tblmastermahasiswa
	ON tblmastermahasiswa.NIS = tbluser.KdUser
	INNER JOIN tbljurusan
	ON tbljurusan.Id = tblmastermahasiswa.Jur
	INNER JOIN tblmasterpembimbing
	ON tblmasterpembimbing.NIP = tblforwardd.PembimbingS 	
	WHERE tblforwardd.Verified='T' AND tblforwardd.UserF='$data[UserF]'
	ORDER BY tblforwardd.IdF DESC");
$hasil2=mysql_fetch_array($tblpemdudi);
echo "-".xss_cleaner($hasil2['NmPmbgI']) . " (Inner)";
if ($data['PembimbingD']==NULL){
echo "<br>-Belum Ada (Outter)";
} else {
$tblpemdudi=mysql_query("SELECT * FROM tblforwardd INNER JOIN tbluser
	ON tblforwardd.UserF = tbluser.Id 
	INNER JOIN tblmasterdudi 
	ON tblforwardd.DudiF = tblmasterdudi.Id 
	INNER JOIN tblmastermahasiswa
	ON tblmastermahasiswa.NIS = tbluser.KdUser
	INNER JOIN tbljurusan
	ON tbljurusan.Id = tblmastermahasiswa.Jur
	INNER JOIN tblmasterpembimbingdudi
	ON tblmasterpembimbingdudi.Id = tblforwardd.PembimbingD 	
	WHERE tblforwardd.Verified='T' AND tblforwardd.UserF='$data[UserF]'
	ORDER BY tblforwardd.IdF DESC");
$pem=mysql_query("SELECT *
FROM tblmasterpembimbingdudi
WHERE `Id` ='$data[PembimbingD]'");
$fetch=mysql_fetch_array($pem);
echo "<br>-" . xss_cleaner($fetch['NmPmbg']) . " (Outter)";
}
} 
?>
</select></td><td>
<?php if ($data['PembimbingS']==NULL){ ?>
<input class="btn btn-primary" type="submit" name="submit" value="Tambahkan"></input></td>
<?php } else{echo "-"; } } } else {
header('location:404.php');
}?>
</table>
</form>
</div> 
<div class="line"></div>
</body>
</html>

<?php
if (isset($_POST['pmbg'])){
$pembimbing=$_POST['pmbg'];
$masukkandata=mysql_query("UPDATE `tblforwardd` SET `PembimbingS` = '$pembimbing' WHERE `tblforwardd`.`IdF` ='$_GET[id]'");
header('location:manajemenpembs.php');
}
?>