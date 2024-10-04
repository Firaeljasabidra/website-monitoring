<?php
include('../part/akses.php');
include('../part/header.php');
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
                if (isset($_SESSION['lvl'])) {
                    if ($_SESSION['lvl'] == 'Administrator') {
                        echo '<img src="../../assets/img/ava-admin-female.png" class="img-circle" alt="User Image">';
                    } elseif ($_SESSION['lvl'] == 'user') {
                        echo '<img src="../../assets/img/ava-kades.png" class="img-circle" alt="User Image">';
                    }
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
                <a href="../dashboard/index.php">
                    <i class="fas fa-tachometer-alt"></i> <span>&nbsp;&nbsp;Dashboard</span>
                </a>
            </li>
            <li class="active">
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
            <li>
                <a href="../laporan/lemari.php">
                    <i class="fa fa-users"></i> <span> Data List Lemari</span>
                </a>
            </li>
            <?php
            if (isset($_SESSION['lvl']) && ($_SESSION['lvl'] == 'Administrator')) {
            ?>

            <?php
            } else {
            }
            ?>
        </ul>
    </section>
</aside>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Monitoring Dokumen Rendan</h1>
        <ol class="breadcrumb">
            <li><a href="../dashboard/"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="active">Monitoring Dokumen Rendan</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?php
                if (isset($_GET['pesan'])) {
                    if ($_GET['pesan'] == "gagal-menambah") {
                        echo "<div class='alert alert-danger'><center>Tidak dapat menambahkan data. Nomor RKS yang dimasukkan sudah digunakan karena terdapat duplikasi data. Mohon periksa kembali data yang dimasukkan</center></div>";
                    } elseif ($_GET['pesan'] == "gagal-menghapus") {
                        echo "<div class='alert alert-danger'><center>Anda tidak bisa menghapus data tersebut.</center></div>";
                    }
                }
                ?>
                <?php if (isset($_SESSION['lvl']) && $_SESSION['lvl'] == 'Administrator') { ?>
                    <a class="btn btn-success btn-md" href='tambah-monitoring.php'><i class="fa fa-user-plus"></i> Tambah Data Dokumen Baru</a>
                <?php } ?>
                <br><br>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="data-table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="text-align: center;"><strong>No</strong></th>
                                <th style="text-align: center;"><strong>Lemari</strong></th>
                                <th style="text-align: center;"><strong>Rak</strong></th>
                                <th style="text-align: center;"><strong>Nama Pekerjaan</strong></th>
                                <th style="text-align: center;"><strong>No. Rks</strong></th>
                                <th style="text-align: center;"><strong>Tanggal RKS</strong></th>
                                <th style="text-align: center;"><strong>No. ADD</strong></th>
                                <th style="text-align: center;"><strong>Tanggal ADD</strong></th>
                                <?php if (isset($_SESSION['lvl']) && $_SESSION['lvl'] == 'Administrator') { ?>
                                    <th style="text-align: center;"><strong>Aksi</strong></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('../../config/koneksi.php');

                            $no = 1;
                            $qTampil = mysqli_query($connect, "SELECT * FROM monitoring");

                            foreach ($qTampil as $row) {
                                // Format tanggal untuk RKS dan ADD
                                $tanggal_rks = date('d', strtotime($row['tgl_rks']));
                                $bulan_rks = date('n', strtotime($row['tgl_rks']));
                                $tahun_rks = date('Y', strtotime($row['tgl_rks']));
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['no_lemari']; ?></td>
                                    <td><?php echo $row['no_lemari'] . $row['no_rak']; ?></td>
                                    <td><?php echo $row['pekerjaan']; ?></td>
                                    <td><?php echo $row['no_rks']; ?></td>
                                    <td><?php echo "$tanggal_rks/$bulan_rks/$tahun_rks"; ?></td>
                                    <td><?php echo $row['no_add']; ?></td>
                                    <td><?php echo $row['tgl_add']; ?></td>
                                    <?php if (isset($_SESSION['lvl']) && $_SESSION['lvl'] == 'Administrator') { ?>
                                        <td>
                                            <div class="table-actions">
                                                <a class="btn btn-success btn-sm" href='edit-monitoring.php?id=<?php echo $row["id_rendan"]; ?>'>
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-danger btn-sm" href='hapus-monitoring.php?id=<?php echo $row["id_rendan"]; ?>' onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include('../part/footer.php');
?>
