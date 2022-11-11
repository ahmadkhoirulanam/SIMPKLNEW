<?php error_reporting(0); ?>
<!-- HTML and semi PHP code -->

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIPRIN : Sistem Informasi Prakerin - Pengaturan</title>
<?php include('include/header.php'); //	  include header ?>
</head>
<body>
<div class='well' style='min-height:320px;'>
<?php //here it goes!!
if (isset($_SESSION['Level']))
if ($_SESSION['Level']=='admin')
{
	if (!isset($_GET['v'])) {
	echo "<h3>Pengaturan Admin</h3>";
	include('admin/menu.php');
	}
		if (isset($_GET['v'])){
			if ($_GET['v']=='sw'){
			include('admin/inputsw.php'); //INPUT DATA SISWA
			}
			if ($_GET['v']=='dd'){
			include('admin/inputdd.php'); //INPUT DATA SISWA
			}
			if ($_GET['v']=='pj'){
			include('admin/inputpj.php'); //INPUT DATA SISWA
			}
			if ($_GET['v']=='ks'){
			include('admin/inputks.php'); //INPUT DATA SISWA
			}
			if ($_GET['v']=='pi'){
			include('admin/inputpi.php'); //INPUT DATA SISWA
			}
			if ($_GET['v']=='ps'){
			include('admin/inputps.php'); //INPUT DATA SISWA
			}
			if ($_GET['v']=='jr'){
			include('admin/inputjr.php'); //INPUT DATA SISWA
			} elseif ($_GET['v'] <> 'jr' AND $_GET['v'] <> 'ps' AND $_GET['v'] <> 'pi' AND $_GET['v'] <> 'ks' AND $_GET['v'] <> 'pj' AND $_GET['v'] <> 'dd' AND $_GET['v'] <> 'sw') {	
			header('location:404.php');
			exit;
			}
		}

} else {
	header('location:404.php');
}
?>
</div>
</div>
<div class="line"></div>
</body>
</html>