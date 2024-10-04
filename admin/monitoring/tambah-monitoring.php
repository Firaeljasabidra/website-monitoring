<?php 
  include ('../part/akses.php');
  include ('../part/header.php');
  include ('../../config/koneksi.php');
?> 
<script>
        // Fungsi untuk memeriksa format tanggal
        function validateDate(dateString) {
            // Regex untuk format DD/MM/YYYY
            const regex = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/;
            return regex.test(dateString);
        }

        // Fungsi untuk validasi form
        function validateForm() {
            const dateInput = document.querySelector('input[name="ftgl_add"]').value;
            if (!validateDate(dateInput)) {
                alert("Format tanggal tidak valid. Harap masukkan tanggal dalam format DD/MM/YYYY.");
                return false; // Mencegah pengiriman form
            }
            return true; // Mengizinkan pengiriman form
        }
    </script>
    
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
 				<a href="../dashboard/index.php">
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
    <h1>&nbsp;</h1>
    <ol class="breadcrumb">
      <li><a href="../dashboard/index.php"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
      <li class="active">Monitoring Dokumen Rendan</li>
    </ol>
  </section>
  <section class="content">      
    <div class="row">
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-file-upload"></i> Tambah Dokumen Baru</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
          <div class="box-body">
            <div class="row">
              <form class="form-horizontal" method="post" action="simpan-monitoring.php">
                <div class="col-md-6">
                  <div class="box-body">
                    <h4>Dokumen Rendan</h4>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">No.RKS</label>
                      <div class="col-sm-8">
                        <input type="text" name="fno_rks" class="form-control" style="text-transform: capitalize;" placeholder="No.RKS" required>
                        <!-- <script>
                          function hanyaAngka(evt){
                            var charCode = (evt.which) ? evt.which : event.keyCode
                            if (charCode > 31 && (charCode < 48 || charCode > 57))
                            return false;
                            return true;
                          }
                        </script> -->
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Tanggal RKS</label>
                      <div class="col-sm-8">
                        <input type="date" name="ftgl_rks" class="form-control"  placeholder="tgl/bln/thn" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Nilai HPE</label>
                      <div class="col-sm-8">
                        <input type="text" id="nilaiHPE" name="fhpe" class="form-control" placeholder="jika tidak ada mohon isi 0" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">NO. ND RKS</label>
                      <div class="col-sm-8">
                      <input type="text" name="fnd" class="form-control" style="text-transform: capitalize;" placeholder="NO. ND Rks" required> 
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Tanggal ND Rendan</label>
                      <div class="col-sm-8">
                      <input type="text" name="ftgl_nd" class="form-control"  style="text-transform: capitalize;" placeholder="tgl/bln/thn" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">NO. ADD RKS</label>
                      <div class="col-sm-8">
                        <input type="text" name="fadd" class="form-control" style="text-transform: capitalize;" placeholder="NO. ADD RKS" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Tanggal ADD</label>
                      <div class="col-sm-8">
                      <input type="text" name="ftgl_add" class="form-control"  style="text-transform: capitalize;" placeholder="tgl/bln/thn" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Revisi No. ND </label>
                      <div class="col-sm-8">
                      <input type="text" name="frevisi_nd" class="form-control" style="text-transform: capitalize;" placeholder="Revisi No. ND " required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Revisi Tanggal ND </label>
                      <div class="col-sm-8">
                      <input type="text" name="frevisi_tgl_nd" class="form-control"  style="text-transform: capitalize;" placeholder="tgl/bln/thn" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">No. Lemari</label>
                      <div class="col-sm-8">
                        <select name="fLemari" class="form-control" required>
                          <option value="">-- Nomor Lemari --</option>
                          <option value="-">-</option>
                          <option value="L1">L1</option>
                          <option value="L2">L2</option>
                          <option value="L3">L3</option>
                          <option value="L4">L4</option>
                          <option value="L5">L5</option>
                          <option value="L6">L6</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">No. Rak</label>
                      <div class="col-sm-8">
                        <select name="fRak" class="form-control" required>
                          <option value="">-- Nomor Rak --</option>
                          <option value="-">-</option>
                          <option value="A">A</option>
                          <option value="B">B</option>
                          <option value="C">C</option>
                          <option value="D">D</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="box-body">
                  <h4>Dokumen User</h4>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">User</label>
                      <div class="col-sm-8">
                      <input type="text" name="fUser" class="form-control" style="text-transform: capitalize;" placeholder="User" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Pekerjaan</label>
                      <div class="col-sm-8">
                      <input type="textarea" name="fpekerjaan" class="form-control" style="text-transform: capitalize;" placeholder="Pekerjaan" rows="4" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Nota Dinas User</label>
                      <div class="col-sm-8">
                      <input type="text" name="fnd_user" class="form-control" style="text-transform: capitalize;" placeholder="Nota Dinas User" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Tanggal Nota Dinas User</label>
                      <div class="col-sm-8">
                      <input type="text" name="ftgl_nd_user" class="form-control"  style="text-transform: capitalize;" placeholder="tgl/bln/thn" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">NO. SKKI/O</label>
                      <div class="col-sm-8">
                        <input type="text" name="fSKKI/O" class="form-control" style="text-transform: capitalize;" placeholder="NO. SKKI/O" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">NO. PRK</label>
                      <div class="col-sm-8">
                      <input type="text" name="fPRK" class="form-control" style="text-transform: capitalize;" placeholder="NO. PRK" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Nilai RAB Awal</label>
                      <div class="col-sm-8">
                        <input type="text"  name="fRAB_awal" class="form-control" placeholder="jika tidak ada mohon isi 0" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Nilai RAB Akhir</label>
                      <div class="col-sm-8">
                        <input type="text"  name="fRAB_akhir" class="form-control" placeholder="jika tidak ada mohon isi 0" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Metode Pengadaan</label>
                      <div class="col-sm-8">
                      <select name="fmetode" class="form-control" required>
                          <option value="">-- Metode Pengadaan --</option>
                          <option value="Pengadaan Langsung">Pengadaan Langsung</option>
                          <option value="Penunjukan Langsung">Penunjukan Langsung</option>
                          <option value="Tender Terbuka">Tender Terbuka</option>
                          <option value="Tender Terbatas">Tender Terbatas</option>
                          <option value="Repeat Order">Repeat Order</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Waktu Pelaksanaan</label>
                      <div class="col-sm-8">
                        <input type="text" name="fwktu" class="form-control" style="text-transform: capitalize;" placeholder="Waktu Pelaksanaan" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Revisi ND User</label>
                      <div class="col-sm-8">
                        <input type="text" name="frevisind_user" class="form-control" style="text-transform: capitalize;" placeholder="Revisi ND User" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Revisi Tanggal ND User</label>
                      <div class="col-sm-8">
                      <input type="text" name="frevisitgl_user" class="form-control"  style="text-transform: capitalize;" placeholder="tgl/bln/thn" required>
                      </div>
                    </div>
                  </div> 
                  <div class="box-footer pull-right">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    <a href="index.php" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Batal</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="box-footer">
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


<?php 
  include ('../part/footer.php');
?>