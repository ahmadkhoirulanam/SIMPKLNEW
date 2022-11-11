<?php
include 'include/header.php';
session_start();
$query=mysql_query("UPDATE `tbluser` SET `AktifUser` = 'n' WHERE `tbluser`.`Id` = '$_SESSION[Id]'");
session_destroy();
header('location:login.php');
?>