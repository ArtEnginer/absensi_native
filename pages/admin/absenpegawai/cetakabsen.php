<?php
include 'database/sql.php';

$tanggal = date("d-m-Y");

$id = $_SESSION['id_pegawai'];

$query = $mysqli->query("SELECT * FROM tb_absen WHERE id_pegawai='$_SESSION[id_pegawai]' AND tanggal='$tanggal'");
$query2 = $mysqli->query("SELECT * FROM tb_absen WHERE tanggal LIKE '%" . date('m-Y') . "'");
$data = $query->fetch_assoc();

if (isset($_POST['export'])) {
    $queryexport = "SELECT * FROM tb_absen WHERE tanggal LIKE '%" . $_POST['export_tahun'] . "'";
    if ($_POST['export_bulan'] > 0) {
        $queryexport = "SELECT * FROM tb_absen WHERE tanggal LIKE '%" . $_POST['export_bulan'] . "-" . $_POST['export_tahun'] . "'";
        echo 'Bulan Lebih Besar Dari 0';
    }
    if ($_POST['export_id'] > 0) {
        $queryexport .= " AND id_pegawai='$_POST[export_id]'";
        echo 'Pegawai Lebih Besar Dari 0';
    }
    $exportdata = $mysqli->query($queryexport);
}

?>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="col-sm-10">Export Custom Data Absen</h3>
        </div>
        <div class="card-body">
            <div class="container my-4 text-center">
                <div class="row">
                    <form method="post" class="form-inline">
                        <label class="my-1 mr-2" for="pegawai">Pilih Pegawai</label>
                        <select class="custom-select my-1 mr-sm-2" id="pegawai" name="export_id" required>
                            <option value="">Pilih Pegawai</option>
                            <option value="0">Semua Pegawai</option>
                            <?php $parapegawai = $mysqli->query("SELECT * FROM pegawai") ?>
                            <?php while ($pgw = $parapegawai->fetch_object()) : ?>
                                <option value="<?= $pgw->id_pegawai ?>"><?= "$pgw->id_pegawai - $pgw->nm_pegawai" ?>
                                </option>
                            <?php endwhile ?>
                        </select>
                        <label class="my-1 mr-2" for="pegawai">Pilih Bulan</label>
                        <select class="custom-select my-1 mr-sm-2" id="pegawai" name="export_bulan" required>
                            <option value="">Pilih Bulan</option>
                            <option value="0">Semua Bulan</option>
                            <?php foreach ($bulanku as $bl => $bln) : ?>
                                <option value="<?= $bl ?>"><?= $bln ?></option>
                            <?php endforeach ?>
                        </select>
                        <label class="my-1 mr-2" for="pegawai">Pilih Tahun</label>
                        <select class="custom-select my-1 mr-sm-2" id="pegawai" name="export_tahun" required>
                            <option value="">Pilih Tahun</option>
                            <?php for ($i = 2015; $i <= date('Y'); $i++) : ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor ?>
                        </select>
                </div>
                <div class="row">
                    <button type="submit" name="export" class="btn btn-success">Ambil Data</button>
                    </form>
                </div>
            </div>
            <?php if (isset($_POST['export'])) : ?>
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
                        <?php while ($custom = $exportdata->fetch_object()) : ?>
                            <?php $custom2 = $mysqli->query("SELECT * FROM pegawai WHERE id_pegawai='$custom->id_pegawai'")->fetch_object() ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $custom2->nm_pegawai ?></td>
                                <td><?= $custom->jam_masuk ?></td>
                                <td><?= $custom->jam_pulang ?></td>
                                <td><?= $custom->tanggal ?></td>
                            </tr>
                            <?php ++$no ?>
                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php endif ?>
        </div>
    </div>
</section>

<?php include_once "partials/scripts.php" ?>