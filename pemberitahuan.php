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
<title>SIPRIN : Sistem Informasi Prakerin - Pemberitahuan</title>
</head>
<body>
<div class="well" style='min-height:320px;'>
<table class="table table-striped table-bordered table-hover" style="width:700px;margin-left:auto;margin-right:auto;">
<tr><th>Pemberitahuan</th>

<?php 
$i=0;
$query=mysql_query("SELECT * FROM tblreason INNER JOIN tblmasterdudi
ON tblmasterdudi.Id = tblreason.IdDudi
INNER JOIN tbluser
ON tbluser.Id=tblreason.UserId
WHERE UserId='$Id'");
$forward=mysql_query("SELECT * FROM tblforwardd INNER JOIN tblmasterdudi
ON tblmasterdudi.Id = tblforwardd.DudiF
WHERE UserF='$Id' AND Verified='T' AND Confirmed<>'T'");
$data=mysql_num_rows($query);
$hasilf=mysql_num_rows($forward);
if ($data==NULL AND $hasilf==NULL) {
echo "<tr><td colspan=2><div align=center><font color=gray>Tidak ada pemberitahuan</font></div></td></tr>";
}
while ($data=mysql_fetch_array($query))
{
$tolak=$data['Terima']=='0';
$terima=$data['Terima']=='1'; 
?>

<tr>
<td>Anda <?php if ($tolak){ echo "tidak diterima"; } else { echo "diterima"; } ?> Prakerin di <b><?php echo xss_cleaner($data['NmDudi']);?></b> <?php if ($tolak){echo "dengan sebab:";} ?> <i><?php echo xss_cleaner($data['Reason']);?></i><br></td>
<?php  } if (isset($forward)){?>
<?php while ($hasilf=mysql_fetch_array($forward))
{ ?>
<tr><td>
Selamat Anda diterima Prakerin di <b><?php echo $hasilf['NmDudi'];?> </b><br><font size=1>konfirmasi?</font>
<form method="POST" action="pemberitahuan.php?id=<?php echo $hasilf[0]; ?>">
<input class="btn btn-success" type="submit" name="ya" value="Ya"> <input class="btn btn-success" type="submit" name="tidak" value="Tidak">
</form>
</td></tr>
<? } }
?>
</table>
</div> 
<div class="line"></div>
</body>
</html>

<?php 
if (isset($_POST['ya']))
{
$requery=mysql_query("SELECT * FROM tblforwardd INNER JOIN tblmasterdudi
ON tblmasterdudi.Id = tblforwardd.DudiF
WHERE UserF='$Id' AND Verified='T'");
$result=mysql_fetch_array($requery);
$IdF=$_GET['id'];
$result['magang']=$result['magang']+1;
$add = $result['magang'];
$konfirmasi=mysql_query("UPDATE `tblforwardd` SET `Confirmed` = 'T' WHERE `tblforwardd`.`IdF` ='$IdF'");
$tgl=mysql_query("UPDATE `tblforwardd` SET `TimestampF` = CURRENT_TIMESTAMP WHERE `tblforwardd`.`IdF` ='$IdF'");
$update=mysql_query("UPDATE `tblmasterdudi` SET `magang` = '$add' WHERE `tblmasterdudi`.`Id` = '$result[DudiF]'");
header('location:pemberitahuan.php');
//removing current confirmation
$remove=mysql_query("DELETE FROM `tblforwardd` WHERE `tblforwardd`.`UserF` = '$Id' AND Verified<>'T' OR Confirmed<>'T'");
} elseif (isset($_POST['tidak']))
{
$IdF=$_GET['id'];
$konfirmasi=mysql_query("DELETE FROM `tblforwardd` WHERE `tblforwardd`.`IdF` = $IdF");
header('location:pemberitahuan.php');
}
?>