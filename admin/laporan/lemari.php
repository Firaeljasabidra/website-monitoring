<?php
include ('../../config/koneksi.php');
include ('../part/akses.php');
include ('../part/header.php');
?>
<style>
    .table-actions {
        display: flex;
        gap: 10px;
    }

    .table-actions .btn {
        padding: 5px;
    }

    /* Membuat tabel dapat di-scroll ke samping jika diperlukan */
    .table-responsive {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* Mengatur agar teks dapat dibungkus dan tidak terpotong */
    .table td {
        white-space: normal; /* Membiarkan teks tampil dalam beberapa baris */
        word-wrap: break-word; /* Memungkinkan pembungkusan kata */
        overflow: visible; /* Pastikan teks tampil penuh */
    }

    /* Optional: Beri padding lebih untuk memperjelas */
    .table th, .table td {
        padding: 10px;
    }
</style>

<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <?php  
          if(isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator')) {
            echo '<img src="../../assets/img/ava-admin-female.png" class="img-circle" alt="User Image">';
          } else if(isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'user')) {
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
        <a href="../dashboard/">
          <i class="fas fa-tachometer-alt"></i> <span>&nbsp;&nbsp;Dashboard</span>
        </a>
      </li>
      <li>
        <a href="../monitoring/index.php">
          <i class="fa fa-users"></i> <span>Monitoring</span>
        </a>
      </li>
      <li class="treeview">
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
      <li class="active">
        <a href="../laporan/lemari.php">
          <i class="fa fa-users"></i> <span> Data List Lemari</span>
        </a>
      </li>
      <?php
        if(isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator')) {
          // Tambahkan menu tambahan untuk Administrator jika diperlukan
        } else {
          // Tambahkan menu tambahan untuk user biasa jika diperlukan
        }
      ?>
    </ul>
  </section>
</aside>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Data List Lemari</h1>
    <ol class="breadcrumb">
      <li><a href="../dashboard/"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
      <li class="active">Laporan</li>
    </ol>
  </section>
  
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <form method="GET" action="">
          <div class="form-group col-md-3">
            <label>Pilih Lemari:</label>
            <select name="lemari" class="form-control" required>
              <option value="">-- Pilih Lemari --</option>
              <?php
                // Menampilkan semua lemari dari database
                $lemari_query = "SELECT DISTINCT no_lemari FROM monitoring";
                $lemari_result = mysqli_query($connect, $lemari_query);
                while ($row = mysqli_fetch_assoc($lemari_result)) {
                  echo "<option value='" . $row['no_lemari'] . "'>" . $row['no_lemari'] . "</option>";
                }
              ?>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label>Pilih Rak:</label>
            <select name="rak" class="form-control" required>
              <option value="">-- Pilih Rak --</option>
              <option value="-">-</option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
              <option value="D">D</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label>&nbsp;</label><br>
            <button type="submit" class="btn btn-primary">Filter</button>
          </div>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <table class="table table-striped table-bordered" id="data-table" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th style="text-align: center;">No</th>
              <th style="text-align: center;">Lemari</th>
              <th style="text-align: center;">Dokumen</th>
            </tr>
          </thead>
          <tbody>
            <?php
              if (isset($_GET['lemari']) && isset($_GET['rak'])) {
                $lemari = mysqli_real_escape_string($connect, $_GET['lemari']);
                $rak = mysqli_real_escape_string($connect, $_GET['rak']);
                $no_lemari_rak = $lemari . $rak; // Menggabungkan lemari dan rak

                // Query untuk mendapatkan data berdasarkan filter
                $query = "SELECT * FROM monitoring WHERE no_lemari = '$lemari' AND no_rak = '$rak' ORDER BY no_rks ASC";
                $result = mysqli_query($connect, $query);
                $no = 1;

                while ($row = mysqli_fetch_assoc($result)) {
                  // Memformat tanggal RKS dari format Y-m-d ke d/m/Y
                  $tgl_rks = date('d/m/Y', strtotime($row['tgl_rks']));

                  echo "<tr>";
                  echo "<td>" . $no++ . "</td>";
                  echo "<td>" . $no_lemari_rak . "</td>";
                  echo "<td>No. RKS: " . $row['no_rks'] . ", Tanggal RKS: " . $tgl_rks . "</td>";
                  echo "</tr>";
                }
              } else {
                echo "<tr><td colspan='3'>Silakan pilih filter untuk menampilkan data.</td></tr>";
              }
            ?>
          </tbody>
        </table>

        <?php if(isset($_GET['lemari']) && isset($_GET['rak'])): ?>
        <?php endif; ?>
      </div>
    </div>
  </section>
</div>

<?php include ('../part/footer.php'); ?>
