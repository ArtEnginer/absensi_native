<?php
include 'database/sql.php';

date_default_timezone_set("Asia/Jakarta");
$tanggal = date("d-m-Y");
$jamSekarang = date('H:i:s');
// Ambil data absensi
$id = $_SESSION['id_pegawai'];

$query = $mysqli->query("SELECT * FROM tb_absenmhs WHERE id_pegawai='$_SESSION[id_pegawai]' AND tanggal='$tanggal'");
$query2 = $mysqli->query("SELECT * FROM tb_absenmhs WHERE tanggal LIKE '%" . date('m-Y') . "'");
$data = $query->fetch_assoc();

if (isset($_POST['export'])) {
    $queryexport = "SELECT * FROM tb_absenmhs WHERE tanggal LIKE '%" . $_POST['export_tahun'] . "'";
    if ($_POST['export_bulan'] > 0) {
        $queryexport = "SELECT * FROM tb_absenmhs WHERE tanggal LIKE '%" . $_POST['export_bulan'] . "-" . $_POST['export_tahun'] . "'";
        echo 'Bulan Lebih Besar Dari 0';
    }
    if ($_POST['export_id'] > 0) {
        $queryexport .= " AND id_pegawai='$_POST[export_id]'";
        echo 'Pegawai Lebih Besar Dari 0';
    }
    $exportdata = $mysqli->query($queryexport);
}

if (isset($_POST['masuk'])) {
    if ($data) {
        echo '<script>alert("anda sudah absen masuk untuk hari ini, semangat sampai pulang ya");history.go(-1);</script></script>';
    } else {
        $res =  mysqli_query($konek, "INSERT INTO tb_absenmhs SET id_pegawai='$id', tanggal='$tanggal', jam_masuk= '$jamSekarang'");
        echo '<script>alert("terima kasih");history.go(-1);</script>';
    }
}
if (isset($_POST['pulang'])) {
    if ($data['jam_pulang']) {
        echo '<script>alert("anda sudah absen untuk hari ini, absen lagi besok!");history.go(-1);</script>';
    } else {
        $res =  mysqli_query($konek, "UPDATE tb_absenmhs SET jam_pulang='$jamSekarang' WHERE id_absenmhs ='" . $data['id_absenmhs'] . "' ");
        echo '<script>alert("terima kasih");history.go(-1);</script>';
    }
}

?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb2">
            <div class="col-sm-6">
                <h1>Absen</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                    <li class="breadcrumb-item"><a href="?page=pangkatread">Absen</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header d-flex justify-content-md-between">
            <h3 class="col-sm-10">Halo, <?php echo $_SESSION['nm_pegawai'] ?>!</h3>
            <p id="MyClockDisplay">Jam</p>
        </div>
        <div class="card-body text-center">
            <?php if ($data) : ?>
                <?php if ($data['jam_pulang']) : ?>
                    <p>Anda Sudah Absen masuk pada pukul <?= $data['jam_masuk'] ?> & Absen pulang pada pukul
                        <?= $data['jam_pulang'] ?>, Semangat untuk besok lagi :)</p>
                <?php else : ?>
                    <p>Anda Sudah Absen masuk pada pukul <?= $data['jam_masuk'] ?>, mau pulang ?</p>
                    <form method="POST">
                        <tr>
                            <td><button type="submit" name="pulang" class="btn btn-success" onclick="return confirm('ingin pulang?')">Absen Pulang</button></td>
                        </tr>
                    </form>
                <?php endif ?>
            <?php else : ?>
                <p>Anda Belum Absen hari ini, silahkan absen terlebih dahulu !</p>
                <form method="POST">
                    <tr>
                        <td><button type="submit" name="masuk" class="btn btn-success" onclick="return confirm('ingin absen?')">Absen Masuk</button></td>
                    </tr>
                </form>
            <?php endif ?>
        </div>
    </div>
</section>
<?php if ($_SESSION['peran'] == 'mahasiswa') : ?>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="col-sm-10">Data Absen Bulan <?= date('F') ?></h3>
            </div>
            <div class="card-body">
                <table class="table table-striped datatables-init" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Nama</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php while ($riwayat = $query2->fetch_object()) : ?>
                            <?php $pegawai = $mysqli->query("SELECT * FROM pegawai WHERE id_pegawai='$riwayat->id_pegawai'")->fetch_object() ?>
                            <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $pegawai->nm_pegawai ?></td>
                                    <td><?= $riwayat->jam_masuk ?></td>
                                    <td><?= $riwayat->jam_pulang ?></td>
                                    <td><?= $riwayat->tanggal ?></td>
                            </tr>
                            <?php ++$no ?>
                    <?php
                            endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<?php endif ?>
<?php include_once "partials/scripts.php" ?>