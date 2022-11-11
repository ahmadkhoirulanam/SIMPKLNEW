<?php
include('include/header.php'); 	//	Open koneksi
$username=$_POST['user']; 	//	Register variabel dari form
$password=$_POST['pass'];
$encrypted=e($password);
$login=	mysql_query("SELECT * FROM tbluser WHERE Username='$username' AND Password='$encrypted'"); //bikin query
$hasil=mysql_num_rows($login); 		//menghitung jumlah baris query
$rst=mysql_fetch_array($login); 	//mendapatkan array
if ($hasil > 0) 		//cek jumlah bener gk
{
	  session_start(); //session di open
	  $_SESSION['Id']     = $rst[Id]; //register session
      $_SESSION['Username']     = $rst[Username];
      $_SESSION['Password']     = $rst[Password];
      $_SESSION['Level']    = $rst[Level];
	  $_SESSION['Email']    = $rst[Email];
	  $_SESSION['KdUser']    = $rst[KdUser];
	  $_SESSION['AktifUser'] = 'y';
	  $Execute = mysql_query("UPDATE tbluser SET AktifUser = '$_SESSION[AktifUser]' WHERE Id='$_SESSION[Id]'");
      header('location:index.php'); //redirek
}
else{  //klo cek salah
	session_start(); //session start
	header("location:login.php"); //pergi ke login.php lg
	$_SESSION['notice']='Login Gagal, coba lagi!';  //register session buat notice gagal
}

		$sql=mysql_query("SELECT *
		FROM tblmastermahasiswa WHERE NIS='$_SESSION[KdUser]'");
		$data=mysql_fetch_array($sql);
		$_SESSION['Jurusan'] = $data['Jur'];
?>