<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIPRIN : Sistem Informasi Prakerin - LOGIN</title>
</head>
<?php include('include/header.php'); //include header ?>
<body>
<br>
<div class="well" style="min-height:330px">
<form id="login" action='proses.php' method='post' name='login'>
	  <?php
	  if (isset($_SESSION['notice'])) {		//cek session notice
	  echo "<div class='alert alert-warning'>" . $_SESSION['notice'] ."</div>";		//memangil session notice
	  session_destroy();
	  }		//tutup cek
	  ?>	
      <p>
	  
	    <label for="user"></label>
	    Nama User : 
	    <input type="text" style="height:25px;" style="height:25px;" class name="user" id="user" autocomplete="off" />
      </p>
	  <p>Kata Sandi : 
	    <input type="password" style="height:25px;" name="pass" class="textbox" id="pass" autocomplete="off" />
	  </p>
	  <p>
	    <input type="submit" class="btn" name="submit" value="Masuk"/>
      </p>
	</form>
</div>
<div class="line"></div>
</body>
</html>