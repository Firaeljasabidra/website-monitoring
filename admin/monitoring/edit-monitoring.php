<?php 
include ('../part/akses.php');
include ('../../config/koneksi.php');
include ('../part/header.php');

$id = $_GET['id'];
$qCek = mysqli_query($connect, "SELECT * FROM monitoring WHERE id_rendan='$id'");
while ($row = mysqli_fetch_array($qCek)) {
?>

<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <?php  
                if (isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator')) {
                    echo '<img src="../../assets/img/ava-admin-female.png" class="img-circle" alt="User Image">';
                } elseif (isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Kepala Desa')) {
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
 			<li>
 				<a href="#">
   				<i class="fas fa-tachometer-alt"></i> <span>&nbsp;&nbsp;Dashboard</span>
 				</a>
 			</li>
       <li class="active">
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
        <h1>&nbsp;</h1>
        <ol class="breadcrumb">
            <li><a href="../dashboard/"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="active">Data Dokumen Rendan</li>
        </ol>
    </section>

    <section class="content">      
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fas fa-edit"></i> Edit Data Dokumen Rendan</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="update-monitoring.php">
              <input type="hidden" name="id" value="<?php echo $row['id_rendan']; ?>">
              <div class="row">
                <div class="col-md-6">
                <h4>Dokumen Rendan</h4>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">No. RKS</label>
                    <div class="col-sm-8">
                      <input type="text" name="fno_rks" class="form-control" placeholder="No. RKS" value="<?php echo $row['no_rks']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Tanggal RKS</label>
                    <div class="col-sm-8">
                      <input type="date" name="ftgl_rks" class="form-control" placeholder="Tanggal RKS" value="<?php echo $row['tgl_rks']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Nilai HPE</label>
                    <div class="col-sm-8">
                      <input type="text" name="fhpe" class="form-control" placeholder="jika tidak ada mohon isi 0" value="<?php echo $row['hpe']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">No. ND Rendan</label>
                    <div class="col-sm-8">
                      <input type="text" name="fnd" class="form-control" placeholder="No. ND Rendan" value="<?php echo $row['no_nd_rendan']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Tanggal ND Rendan</label>
                    <div class="col-sm-8">
                      <input type="text" name="ftgl_nd" class="form-control" placeholder="Tanggal ND Rendan" value="<?php echo $row['tgl_nd_rendan']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">No. ADD RKS</label>
                    <div class="col-sm-8">
                      <input type="text" name="fadd" class="form-control" placeholder="No. ADD RKS" value="<?php echo $row['no_add']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Tanggal ADD</label>
                    <div class="col-sm-8">
                      <input type="text" name="ftgl_add" class="form-control" placeholder="Tanggal ADD" value="<?php echo $row['tgl_add']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Revisi No. ND</label>
                    <div class="col-sm-8">
                      <input type="text" name="frevisi_nd" class="form-control" placeholder="Revisi No. ND" value="<?php echo $row['revisi_nd_rks']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Revisi Tanggal ND</label>
                    <div class="col-sm-8">
                      <input type="text" name="frevisi_tgl_nd" class="form-control" placeholder="Revisi Tanggal ND" value="<?php echo $row['revisi_tgl_rks']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">No. Lemari</label>
                    <div class="col-sm-8">
                      <select name="fLemari" class="form-control"required>
                        <option value="">-- Nomor Lemari --</option>
                        <option <?php if($row['no_lemari'] == '-'){ echo 'selected'; } ?> value="-">-</option>
                        <option <?php if($row['no_lemari'] == 'L1'){ echo 'selected'; } ?> value="L1">L1</option>
                        <option <?php if($row['no_lemari'] == 'L2'){ echo 'selected'; } ?> value="L2">L2</option>
                        <option <?php if($row['no_lemari'] == 'L3'){ echo 'selected'; } ?> value="L3">L3</option>
                        <option <?php if($row['no_lemari'] == 'L4'){ echo 'selected'; } ?> value="L4">L4</option>
                        <option <?php if($row['no_lemari'] == 'L5'){ echo 'selected'; } ?> value="L5">L5</option>
                        <option <?php if($row['no_lemari'] == 'L6'){ echo 'selected'; } ?> value="L6">L6</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">No. Rak Lemari</label>
                    <div class="col-sm-8">
                      <select name="fRak" class="form-control" required>
                      <option value="">-- Nomor Rak --</option>
                      <option <?php if($row['no_rak'] == '-'){ echo 'selected'; } ?> value="-">-</option>
                      <option <?php if($row['no_rak'] == 'A'){ echo 'selected'; } ?> value="A">A</option>
                      <option <?php if($row['no_rak'] == 'B'){ echo 'selected'; } ?> value="B">B</option>
                      <option <?php if($row['no_rak'] == 'C'){ echo 'selected'; } ?> value="C">C</option>
                      <option <?php if($row['no_rak'] == 'D'){ echo 'selected'; } ?> value="D">D</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <h4>Dokumen User</h4>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">User</label>
                    <div class="col-sm-8">
                      <input type="text" name="fUser" class="form-control" placeholder="User" value="<?php echo $row['user']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Pekerjaan</label>
                    <div class="col-sm-8">
                      <textarea name="fpekerjaan" class="form-control" rows="4"  placeholder="Pekerjaan" required><?php echo $row['pekerjaan']; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Nota Dinas User</label>
                    <div class="col-sm-8">
                      <input type="text" name="fnd_user" class="form-control" placeholder="Nota Dinas User" value="<?php echo $row['nd_user']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Tanggal Nota Dinas</label>
                    <div class="col-sm-8">
                      <input type="text" name="ftgl_nd_user" class="form-control" placeholder="Tanggal Nota Dinas" value="<?php echo $row['tgl_user']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">NO. SKKI/O</label>
                    <div class="col-sm-8">
                      <input type="text" name="fSKKI/O" class="form-control" placeholder="NO. SKKI/O" value="<?php echo $row['no_skki']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">NO. PRK</label>
                    <div class="col-sm-8">
                      <input type="text" name="fPRK" class="form-control" placeholder="NO. PRK" value="<?php echo $row['no_prk']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Nilai RAB Awal</label>
                    <div class="col-sm-8">
                      <input type="text" name="fRAB_awal" class="form-control" placeholder="jika tidak ada mohon isi 0" value="<?php echo $row['rab_awal']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Nilai RAB Akhir</label>
                    <div class="col-sm-8">
                      <input type="text" name="fRAB_akhir" class="form-control" placeholder="jika tidak ada mohon isi 0" value="<?php echo $row['rab_akhir']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Metode Pengadaan</label>
                    <div class="col-sm-8">
                    <select name="fmetode" class="form-control" required>
                      <option value="">-- Metode Pengadaan --</option>
                      <option <?php if($row['metode'] == 'Pengadaan Langsung'){ echo 'selected'; } ?> value="Pengadaan Langsung">Pengadaan Langsung</option>
                      <option <?php if($row['metode'] == 'Penunjukan Langsung'){ echo 'selected'; } ?> value="Penunjukan Langsung">Penunjukan Langsung</option>
                      <option <?php if($row['metode'] == 'Tender Terbuka'){ echo 'selected'; } ?> value="Tender Terbuka">Tender Terbuka</option>
                      <option <?php if($row['metode'] == 'Tender Terbatas'){ echo 'selected'; } ?> value="Tender Terbatas">Tender Terbatas</option>
                      <option <?php if($row['metode'] == 'Repeat Order'){ echo 'selected'; } ?> value="Repeat Order">Repeat Order</option>
                    </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Waktu Pelaksanaan</label>
                    <div class="col-sm-8">
                      <input type="text" name="fwktu" class="form-control" placeholder="Waktu Pelaksanaan" value="<?php echo $row['waktu']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Revisi ND User</label>
                    <div class="col-sm-8">
                      <input type="text" name="frevisind_user" class="form-control" placeholder="Revisi ND User" value="<?php echo $row['revisi_nd_user']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Revisi Tanggal ND User</label>
                    <div class="col-sm-8">
                      <input type="text" name="frevisitgl_user" class="form-control" placeholder="Revisi Tanggal ND User" value="<?php echo $row['revisi_tgl_user']; ?>" required>
                    </div>
                                        <div class="box-footer pull-right">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                                         <a href="index.php" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Batal</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                    <div class="box-footer"></div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
}
include ('../part/footer.php');
?>
