<?php
include koneksi.php;
$sqllink = mysql_query("INSERT INTO tblpost VALUES('','','$_SESSION[name]','','','USR1')");
header('location:index.php');
?>