<?php
include 'database/sql.php';

$tanggal = date("d-m-Y");


$query2 = $mysqli->query("SELECT * FROM tb_absenmhs WHERE tanggal LIKE '%" . date('m-Y') . "'");
// $data = $query->fetch_assoc();

if (isset($_POST['export'])) {
    $queryexport = "SELECT * FROM tb_absenmhs WHERE tanggal LIKE '%" . $_POST['export_tahun'] . "'";
    if ($_POST['export_bulan'] > 0) {
        $queryexport = "SELECT * FROM tb_absenmhs WHERE tanggal LIKE '%" . $_POST['export_bulan'] . "-" . $_POST['export_tahun'] . "'";
        echo 'Bulan Lebih Besar Dari 0';
    }
    if ($_POST['export_id'] > 0) {
        $queryexport .= " AND id_mahasiswa='$_POST[export_id]'";
        echo 'mahasiswa Lebih Besar Dari 0';
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
                        <label class="my-1 mr-2" for="mahasiswa">Pilih mahasiswa</label>
                        <select class="custom-select my-1 mr-sm-2" id="mahasiswa" name="export_id" required>
                            <option value="">Pilih mahasiswa</option>
                            <option value="0">Semua mahasiswa</option>
                            <?php $paramahasiswa = $mysqli->query("SELECT * FROM mahasiswa") ?>
                            <?php while ($pgw = $paramahasiswa->fetch_object()) : ?>
                                <option value="<?= $pgw->id_mahasiswa ?>"><?= "$pgw->id_mahasiswa - $pgw->nama_mahasiswa" ?>
                                </option>
                            <?php endwhile ?>
                        </select>
                        <label class="my-1 mr-2" for="mahasiswa">Pilih Bulan</label>
                        <select class="custom-select my-1 mr-sm-2" id="mahasiswa" name="export_bulan" required>
                            <option value="">Pilih Bulan</option>
                            <option value="0">Semua Bulan</option>
                            <?php foreach ($bulanku as $bl => $bln) : ?>
                                <option value="<?= $bl ?>"><?= $bln ?></option>
                            <?php endforeach ?>
                        </select>
                        <label class="my-1 mr-2" for="mahasiswa">Pilih Tahun</label>
                        <select class="custom-select my-1 mr-sm-2" id="mahasiswa" name="export_tahun" required>
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
                            <?php $custom2 = $mysqli->query("SELECT * FROM mahasiswa WHERE id_mahasiswa='$custom->id_mahasiswa'")->fetch_object() ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $custom2->nama_mahasiswa ?></td>
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