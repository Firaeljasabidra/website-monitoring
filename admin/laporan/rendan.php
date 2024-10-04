<?php
include ('../../config/koneksi.php');
include ('../part/akses.php');
include ('../part/header.php');
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

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
        <!-- Sidebar content -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php  
                    if (isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator')) {
                        echo '<img src="../../assets/img/ava-admin-female.png" class="img-circle" alt="User Image">';
                    } elseif (isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'user')) {
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
                    <li class="active">
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
            <?php if (isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator')) { ?>
                <!-- Tambahan opsi khusus untuk Administrator jika diperlukan -->
            <?php } ?>
        </ul>
    </section>
</aside>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Data Dokumen Rendan</h1>
        <ol class="breadcrumb">
            <li><a href="../dashboard/"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="active">Data Dokumen Rendan</li>
        </ol>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <form method="GET" action="">
                    <div class="form-group col-md-3">
                        <label>Filter Tahun:</label>
                        <select name="tahun" class="form-control" required>
                            <option value="">-- Pilih Tahun --</option>
                            <?php
                                // Menampilkan daftar tahun dari database
                                $tahunQuery = "SELECT DISTINCT YEAR(tgl_rks) AS tahun FROM monitoring ORDER BY tahun DESC";
                                $tahunResult = mysqli_query($connect, $tahunQuery);
                                while($tahunRow = mysqli_fetch_assoc($tahunResult)){
                                    echo "<option value='".$tahunRow['tahun']."'>".$tahunRow['tahun']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>&nbsp;</label><br>
                        <button type="submit" class="btn btn-primary">Cari</button>
                        <!-- <button type="button" class="btn btn-success btn-print" onclick="window.print()">Cetak</button> -->
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="data-table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="text-align: center;">No</th>
                                <th style="text-align: center;">No. RKS</th>
                                <th style="text-align: center;">Tanggal RKS</th>
                                <th style="text-align: center;">Pekerjaan</th>
                                <th style="text-align: center;">HPE</th>
                                <th style="text-align: center;">Metode</th>
                                <th style="text-align: center;">No. ND Rendan</th>
                                <th style="text-align: center;">Tanggal ND Rendan</th>
                                <th style="text-align: center;">No. ADD</th>
                                <th style="text-align: center;">Tanggal ADD</th>
                                <th style="text-align: center;">Revisi ND RKS</th>
                                <th style="text-align: center;">Revisi Tanggal RKS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                function format_date($date_str) {
                                    // Mengonversi tanggal dari VARCHAR ke format yang diinginkan
                                    return !empty($date_str) && strtotime($date_str) ? date('d/m/Y', strtotime($date_str)) : 'Tanggal Tidak Ada';
                                }

                                if (isset($_GET['tahun'])) {
                                    $tahun = $_GET['tahun'];

                                    // Query untuk mendapatkan data berdasarkan tahun
                                    $query = "SELECT * FROM monitoring WHERE YEAR(tgl_rks) = '$tahun' ORDER BY tgl_rks ASC";
                                    $result = mysqli_query($connect, $query);
                                    $no = 1;

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . htmlspecialchars($row['no_rks']) . "</td>";
                                        echo "<td>" . format_date($row['tgl_rks']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['pekerjaan']) . "</td>";
                                        // Cek apakah nilai 'hpe' adalah angka sebelum diformat
                                        if (is_numeric($row['hpe'])) {
                                            echo "<td style='text-align: right;'>" . number_format($row['hpe'], 2, ',', '.') . "</td>";
                                        } else {
                                            echo "<td style='text-align: right;'>-</td>"; // Jika tidak angka, tampilkan tanda '-'
                                            }
                                        echo "<td>" . htmlspecialchars($row['metode']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['no_nd_rendan']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['tgl_nd_rendan']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['no_add']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['tgl_add']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['revisi_nd_rks']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['revisi_tgl_rks']) . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='12'>Silakan pilih tahun untuk menampilkan data.</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include ('../part/footer.php'); ?>
