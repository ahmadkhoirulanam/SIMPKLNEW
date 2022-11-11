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

if ($_SESSION['Level']<>'kepsek') { header('location:404.php');}?>

<!-- HTML and semi PHP code -->

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIPRIN : Sistem Informasi Prakerin - Daftar Nilai</title>
</head>
<body>
<div class="well">
<h5>Nilai Prakerin Siswa: </h5>

<?php


if (isset($_POST['sort'])) {
$sort = $_POST['sort'];
} else {
$sort = "tblmastermahasiswa.NIS";
}

$z="SELECT tblforwardd.TimestampF, tblmastermahasiswa.NIS, tblmastermahasiswa.NmSiswa, tblmasterdudi.NmDudi, tblnilai.NilaiA, tblnilai.NilaiB, tblnilai.NilaiC, tblnilai.NilaiD, tblmastermahasiswa.Kls FROM tblmastermahasiswa INNER JOIN tbluser
ON tbluser.KdUser = tblmastermahasiswa.NIS
INNER JOIN tblforwardd
ON tblforwardd.UserF = tbluser.Id
INNER JOIN tblnilai
ON tblnilai.Nis = tblmastermahasiswa.NIS
INNER JOIN tblmasterdudi
ON tblmasterdudi.Id = tblforwardd.DudiF
ORDER BY $sort ASC";
$q=mysql_query($z);
if (isset($_GET['xls'])) {
if ($_GET['xls']=='yes') {
$select = $z;

$export = mysql_query ( $select ) or die ( "Sql error : " . mysql_error( ) );

$fields = mysql_num_fields ( $export );

for ( $i = 0; $i < $fields; $i++ )
{
    $header .= mysql_field_name( $export , $i ) . "\t";
}

while( $row = mysql_fetch_row( $export ) )
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim( $line ) . "\n";
}

if ( $data == "" )
{
    $data = "\n(0) Records Found!\n";                        
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Daftar_Nilai_Prakerin.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
}
}
?>

<a href="daftarnilai.php?xls=yes"><div class=btn>Export Data to XLS</div></a>
<br><br>
<div style="background-color:lightgreen;width:30px;float:left;margin-right:5px">&nbsp;</div><i><font size=2px> = Masih Prakerin</font></i>
<br><br><div align=center>
<form name=sortir method=post action=daftarnilai.php>

Sort By: 

<select name=sort>
<option <?php if ($sort=='tblmastermahasiswa.NIS') { echo "selected ";} ?>value="tblmastermahasiswa.NIS">NIS</option>
<option <?php if ($sort=='tblmastermahasiswa.NmSiswa') { echo "selected ";} ?>value="tblmastermahasiswa.NmSiswa">Nama</option>
<option <?php if ($sort=='tblmastermahasiswa.Kls') { echo "selected ";} ?>value="tblmastermahasiswa.Kls">Kelas</option>
<option <?php if ($sort=='tblmasterdudi.NmDudi') { echo "selected ";} ?>value="tblmasterdudi.NmDudi">Prakerin di</option>
</select><br>

<input class=btn type=submit name=sortir value="Sortir"></div>
</form>
<br>
<table class="table table-condensed table-bordered" style="width:700px;margin-left:auto;margin-right:auto;">
<tr><th>NIS</th><th>Nama</th><th>Kelas</th><th>Prakerin di</th><th>Lama PKL</th><th>Nilai A</th><th>Nilai B</th><th>Nilai C</th><th>Nilai D</th>
<?php
$i=1; 

while($dt=mysql_fetch_array($q)){
?>
<?php    // COunter 
if ($dt['Verified']=='S' AND $dt['Confirmed']=='S'){
$style="";
} else {
$style="background-color:lightgreen";
} 
?>
<tr style="<?php echo $style?>">
<td><?php echo $i; ?></td>
<td><?php echo xss_cleaner($dt['NmSiswa']); ?></td>
<td><?php echo xss_cleaner($dt['Kls']); ?></td>
<td><?php echo xss_cleaner($dt['NmDudi']); ?></td>
<?php
$Now = date("Y-m-d");
$PKL = substr($dt['TimestampF'],0,10);
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
?>
<td><?php echo $diff . " hari" ?></td>
<td><?php echo $dt['NilaiA']; ?></td>
<td><?php echo $dt['NilaiB']; ?></td>
<td><?php echo $dt['NilaiC']; ?></td>
<td><?php echo $dt['NilaiD']; ?></td>
<?php 
$i=$i+1; } ?>

</table><br>
</div> 

<div class="line"></div>
</body>
</html>