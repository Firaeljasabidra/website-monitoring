<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="shortcut icon" href="assets/img/mini-logo.png"> -->
	<title>e-monitoring</title>
  	<link rel="stylesheet" href="assets/fontawesome-5.10.2/css/all.css">
	<link rel="stylesheet" href="assets/bootstrap-4.3.1/dist/css/bootstrap.min.css">
	<style type="text/css">
		body{
			background:skyblue;
			height: 100%;
		    background-position: center;
		    background-repeat: no-repeat;
		    background-size: cover;
		    background-attachment:fixed;
		}
	</style>
</head>
<body>
<div class="container" style="max-height:cover; padding-top:50px; padding-bottom:120px" align="center">
	<img src="assets/img/fct.png"><hr>
	<a class="text-dark" style="font-size:18pt"><strong>WEB APLIKASI MONITORING</strong></a><br>
	<!-- <?php  
		// include('config/koneksi.php');

        // $qTampilDesa = mysqli_query($connect, "SELECT * FROM profil_desa WHERE id_profil_desa = '1'");
        // foreach($qTampilDesa as $row){
    ?> -->
	<!-- <a class="text-light" style="font-size:15pt; text-transform: uppercase;"><strong></strong><br> -->
	<a class="text-dark" style="font-size:15pt; text-transform: uppercase;"><strong>BAGIAN PERENCANAAN PENGADAAN</strong></a><hr>
	<?php  
		
	?>
	<!-- <a href="login/" class="btn btn-outline-light" style="font-size:15pt"><i class="fas fa-envelope"></i>Login</a> -->
	<?php
	session_start();
	if(empty($_SESSION['username'])){
		echo '<a class="btn btn-light" href="login/"><i class="fas fa-sign-in-alt"></i>&nbsp;Login</a>';
	}else if(isset($_SESSION['lvl'])){
		echo '<a class="btn btn-transparent text-light" href="admin/dashboard/"><i class="fa fa-user-cog"></i> '; echo $_SESSION['lvl']; echo '</a>';
		echo '<a class="btn btn-transparent text-light" href="login/logout.php"><i class="fas fa-power-off"></i></a>';
}
					?>
</div>
</body>
</html>