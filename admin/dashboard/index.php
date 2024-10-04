<?php
  include ('../part/akses.php');
	include ('../part/header.php');
?>

<aside class="main-sidebar">
  <section class="sidebar">
		<div class="user-panel">
   		<div class="pull-left image">
        <?php  
          if(isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator')){
            echo '<img src="../../assets/img/ava-admin-female.png" class="img-circle" alt="User Image">';
          }else if(isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Kepala Desa')){
            echo '<img src="../../assets/img/ava-kades.png" class="img-circle" alt="User Image">';
          }
        ?>
   		</div>
   		<div class="pull-left info">
   			<p><?php echo $_SESSION['lvl']; ?></p>
   			<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
   		</div>
 		</div>
 		<ul class="sidebar-menu" data-widget="tree">
  		<li class="header">MAIN NAVIGATION</li>
 			<li class="active">
 				<a href="#">
   				<i class="fas fa-tachometer-alt"></i> <span>&nbsp;&nbsp;Dashboard</span>
 				</a>
 			</li>
       <li>
   			<a href="../monitoring/index.php">
     			<i class="fa fa-users"></i> <span>Monitoring</span>
   			</a>
   		</li>	<li class="treeview">
   			<a href="#">
     			<i class="fas fa-envelope-open-text"></i> <span>&nbsp;&nbsp;List Dokumen</span>
     			<span class="pull-right-container">
     				<i class="fa fa-angle-left pull-right"></i>
     			</span>
   			</a>
   			<ul class="treeview-menu">
    			<li>
     				<a href="../laporan/rendan.php"><i class="fa fa-circle-notch"></i>Dokumen Rendan</a>
     			</li>
     			<li>
     				<a href="../laporan/user.php"><i class="fa fa-circle-notch"></i>Dokumen User</a>
     			</li>
   			</ul>
   		</li>
   		<li>
   			<a href="../laporan/lemari.php">
     			<i class="fa fa-users"></i> <span> Data List Lemari</span>
   			</a>
   		</li>
      <?php
        if(isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator')){
      ?>
   		
      <?php 
        }else{
          
        }
      ?>
  	</ul>
  </section>
</aside>
<div class="content-wrapper">
  <section class="content-header">
  	<h1>Dashboard</h1>
     	<ol class="breadcrumb">
       	<li><a href="#"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
     	</ol>
  </section>
  <section class="content">
   	<div class="row">
      <?php 
        if(isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator')){
      ?>
     	<div class="col-lg-4 col-xs-6">
  <div class="small-box bg-blue">
    <div class="inner">
      <h3>
        <?php
          // Menghubungkan ke database
          include ('../../config/koneksi.php');

          // Query untuk menghitung semua dokumen yang ada di tabel monitoring
          $qTotalDocs = mysqli_query($connect, "SELECT * FROM monitoring");
          $totalDocs = mysqli_num_rows($qTotalDocs);
          
          // Menampilkan jumlah total dokumen
          echo $totalDocs;
        ?>
      </h3>
      <p>Total Dokumen Monitoring</p>
    </div>
    <div class="icon">
      <i class="fas fa-file-alt" style="font-size:70px"></i>
    </div>
    <a href="../monitoring/" class="small-box-footer">Lihat Semua Dokumen <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
      <div class="col-lg-1"></div>
      <?php  
        }
      ?>
   	</div>
   	<div class="container-fluid">
   		<div class="row">
   			<div class="box box-default">
     			<div class="box-header with-border">
     				<h3 class="box-title">Welcome Home!</h3>
       			<div class="box-tools pull-right">
         			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
       			</div>
      		</div>
      		<div class="box-body">
     				<div class="row">
       				<form class="form-horizontal" method="post" action="simpan-penduduk.php">
       					<div class="col-md-12">
                  <!-- <div class="col-md-4" style="text-align: center;">
                    <img style="max-width:300px; width:100%; height:auto;" src="../../assets/img/yaya.png"><br>
                  </div> -->
                  <div class="col-md-8">
                    <div class="pull-right">
                      <?php
                        $tanggal = date('D d F Y');
                        $hari = date('D', strtotime($tanggal));
                        $bulan = date('F', strtotime($tanggal));
                        $hariIndo = array(
                          'Mon' => 'Senin',
                          'Tue' => 'Selasa',
                          'Wed' => 'Rabu',
                          'Thu' => 'Kamis',
                          'Fri' => 'Jumat',
                          'Sat' => 'Sabtu',
                          'Sun' => 'Minggu',
                        );
                        $bulanIndo = array(
                          'January' => 'Januari',
                          'February' => 'Februari',
                          'March' => 'Maret',
                          'April' => 'April',
                          'May' => 'Mei',
                          'June' => 'Juni',
                          'July' => 'Juli',
                          'August' => 'Agustus',
                          'September' => 'September',
                          'October' => 'Oktober',
                          'November' => 'November',
                          'December' => 'Desember'
                        );
                        echo $hariIndo[$hari] . ', ' . date('d ') . $bulanIndo[$bulan] . date(' Y');
                      ?>
                    </div><br> <br> <br>
                    <div style="font-size: 35pt; font-weight: 500;"><p>Halo, <strong><?php echo $_SESSION['lvl']; ?></strong></div>
                    <div style="font-size: 15pt; font-weight: 500;"><p>Selamat datang di <a href="#" style="text-decoration:none"><strong>Web Aplikasi Monitoring Bagian Perencanaan Pengadaan.</strong></a></p></div><br><br>
                  </div>
        				</div>
              </form>
        		</div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php 
  include ('../part/footer.php');
?>