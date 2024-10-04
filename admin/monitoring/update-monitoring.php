<?php
include('../../config/koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $no_rks = $_POST['fno_rks'];
    $tgl_rks = $_POST['ftgl_rks'];
    // Format akuntansi untuk 'hpe', 'rab_awal', dan 'rab_akhir'
    $hpe = str_replace(',', '', $_POST['fhpe']); // Menghapus koma sebelum menyimpan ke database
    $no_nd_rendan = $_POST['fnd'];
    $tgl_nd_rendan = $_POST['ftgl_nd'];
    $no_add = $_POST['fadd'];
    $tgl_add = $_POST['ftgl_add'];
    $revisi_nd_rks = $_POST['frevisi_nd'];
    $revisi_tgl_rks = $_POST['frevisi_tgl_nd'];
    $no_lemari = $_POST['fLemari'];
    $no_rak = $_POST['fRak'];
    $user = $_POST['fUser'];
    $pekerjaan = $_POST['fpekerjaan'];
    $nd_user = $_POST['fnd_user'];
    $tgl_user = $_POST['ftgl_nd_user'];
    $no_skki = $_POST['fSKKI/O'];
    $no_prk = $_POST['fPRK'];
    $rab_awal = str_replace(',', '', $_POST['fRAB_awal']); // Menghapus koma sebelum menyimpan
    $rab_akhir = str_replace(',', '', $_POST['fRAB_akhir']); // Menghapus koma sebelum menyimpan
    $metode = $_POST['fmetode'];
    $waktu = $_POST['fwktu'];
    $revisi_nd_user = $_POST['frevisind_user'];
    $revisi_tgl_user = $_POST['frevisitgl_user'];


/// Menghapus karakter selain angka dan titik sebelum disimpan
$hpe = preg_replace('/[^\d.]/', '', $hpe);
$rab_awal = ($rab_awal === '-' || $rab_awal === '') ? NULL : preg_replace('/[^\d.]/', '', $rab_awal);
$rab_akhir = ($rab_akhir === '-' || $rab_akhir === '') ? NULL : preg_replace('/[^\d.]/', '', $rab_akhir);

    // Cek apakah nomor RKS sudah ada
    $queryCek = "SELECT * FROM monitoring WHERE no_rks = ?";
    $stmtCek = $connect->prepare($queryCek);
    $stmtCek->bind_param("s", $no_rks);
    $stmtCek->execute();
    $resultCek = $stmtCek->get_result();

    if ($resultCek->num_rows > 0) {
        // Jika no_rks sudah ada, lakukan update
        $qUpdate = "UPDATE monitoring SET
            tgl_rks = ?, hpe = ?, no_nd_rendan = ?, tgl_nd_rendan = ?, no_add = ?, tgl_add = ?, revisi_nd_rks = ?,
            revisi_tgl_rks = ?, no_lemari = ?, no_rak = ?, user = ?, pekerjaan = ?, nd_user = ?, tgl_user = ?, 
            no_skki = ?, no_prk = ?, rab_awal = ?, rab_akhir = ?, metode = ?, waktu = ?, revisi_nd_user = ?, 
            revisi_tgl_user = ?
            WHERE no_rks = ?";
        
        // Prepare statement
        $stmtUpdate = $connect->prepare($qUpdate);
        
        // Bind parameters
        $stmtUpdate->bind_param(
            "sssssssssssssssssssssss", 
            $tgl_rks, $hpe, $no_nd_rendan, $tgl_nd_rendan, $no_add, $tgl_add, $revisi_nd_rks, 
            $revisi_tgl_rks, $no_lemari, $no_rak, $user, $pekerjaan, $nd_user, $tgl_user, $no_skki, 
            $no_prk, $rab_awal, $rab_akhir, $metode, $waktu, $revisi_nd_user, $revisi_tgl_user, $no_rks
        );
        
        if ($stmtUpdate->execute()) {
            // Jika berhasil mengupdate data, arahkan ke halaman index
            header("Location: index.php?pesan=sukses-update");
            exit();
        } else {
            // Jika gagal mengupdate data, arahkan kembali dengan pesan error
            header("Location: index.php?pesan=gagal-update");
            exit();
        }
    } else {
        // Jika no_rks belum ada, arahkan kembali ke halaman index dengan pesan error
        header('Location: index.php?pesan=gagal-menambah');
        exit();
    }

    $stmtCek->close();
    $stmtUpdate->close();
    $connect->close();
}
?>
