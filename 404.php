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
<title>Prakerin - 404 NOT FOUND</title>
</head>
<body>
<div class="well"  style="min-height:330px;">
<tr><td><div align=center><h3>Error 404 : Halaman Tidak Ditemukan</h3></div></td></tr>
<div align=center><img style="box-shadow:3px 2px 3px gray" src='img/ups.jpg'></div><br>
<div align=center><a href="index.php">Kembali ke Home</a></div>
</div> 
<div class="line"></div>
</body>
</html>