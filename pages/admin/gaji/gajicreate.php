<?php include "database/sql.php";?>
<?php
$pegawai = [];
if ($result = $mysqli->query("SELECT id_pegawai,nm_pegawai FROM pegawai")) {
    while ($obj = $result->fetch_object()) {
        $pegawai[] = $obj;
    }
    $result->free_result();
}

$bulanini = date("Y-m");

if (isset($_POST['cetak'])):

    unset($_POST['cetak']);
    $database = new Database();

    $cekkk = $mysqli->query("SELECT * FROM gaji WHERE id_pegawai = '$_POST[id_pegawai]' AND tanggal LIKE '$bulanini%'")->fetch_row();
    if ($cekkk): ?>
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
    <h5><i class="icon fas fa-ban"> Gagal</i></h5>
    Gaji Pegawai Bulan ini Sudah dicetak
</div>
<?php
else:
    $insertSql = "INSERT INTO gaji (rekening_no, rekening_bank, kehadiran, gaji_pokok, gaji_bonus, gaji_lembur, bpjs_kesehatan, bpjs_tenaker, pinjaman, biaya_transfer, id_pegawai, tanggal) value (:rekening_no, :rekening_bank, :kehadiran, :gaji_pokok, :gaji_bonus, :gaji_lembur, :bpjs_kesehatan, :bpjs_tenaker, :pinjaman, :biaya_transfer, :id_pegawai, :tanggal)";
    $db = $database->getConnection();
    $stmt = $db->prepare($insertSql);
    if ($stmt->execute($_POST)) {
        $_SESSION['hasil'] = true;
        $_SESSION['pesan'] = "Berhasil Simpan Data";
    } else {
        $_SESSION['hasil'] = false;
        $_SESSION['pesan'] = "Gagal Simpan Data";
    }
    echo "<meta http-equiv='refresh' content='0;url=?page=gaji'>";
endif;
endif;
?>


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb2">
            <div class="col-sm-6">
                <h1>Cetak Gaji</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                    <li class="breadcrumb-item"><a href="?page=gaji"> Gaji</a></li>
                    <li class="breadcrumb-item active">Cetak Gaji</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Cetak Gaji</h3>
        </div>

        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="id">Gaji Untuk</label>
                    <select name="id_pegawai" id="id_pegawai" class="form-control" required>
                        <option value="">Pilih Pegawai</option>
                        <?php foreach ($pegawai as $pg): ?>
                        <option value="<?=$pg->id_pegawai?>"><?=$pg->nm_pegawai?></option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="rekening_no">Nomor Rekening</label>
                    <input type="text" class="form-control" name="rekening_no" required>
                </div>
                <div class="form-group">
                    <label for="rekening_bank">Rekening Bank</label>
                    <input type="text" class="form-control" name="rekening_bank" required>
                </div>
                <div class="form-group">
                    <label for="kehadiran">Jumlah Kehadiran</label>
                    <input type="number" class="form-control" name="kehadiran" required>
                </div>
                <div class="form-group">
                    <label for="gaji_pokok">Gaji Pokok</label>
                    <input type="number" class="form-control" name="gaji_pokok" required>
                </div>
                <div class="form-group">
                    <label for="gaji_bonus">Uang Makan / Transport</label>
                    <input type="number" class="form-control" name="gaji_bonus" required>
                </div>
                <div class="form-group">
                    <label for="gaji_lembur">Uang Lembur</label>
                    <input type="number" class="form-control" name="gaji_lembur" required>
                </div>
                <div class="form-group">
                    <label for="bpjs_kesehatan">BPJS Kesehatan</label>
                    <input type="number" class="form-control" name="bpjs_kesehatan" required>
                </div>
                <div class="form-group">
                    <label for="bpjs_tenaker">BPJS Ketenagakerjaan</label>
                    <input type="number" class="form-control" name="bpjs_tenaker" required>
                </div>
                <div class="form-group">
                    <label for="pinjaman">Pinjaman</label>
                    <input type="number" class="form-control" name="pinjaman" required>
                </div>
                <div class="form-group">
                    <label for="biaya_transfer">Biaya Transfer</label>
                    <input type="number" class="form-control" name="biaya_transfer" required>
                </div>
                <input type="hidden" name="tanggal" value="<?=date('Y-m-d H:i:s')?>">

                <a href="?page=gaji" class="btn btn-danger btn-sm float-right">
                    <i class="fa fa-times"></i> Batal
                </a>
                <button type="submit" name="cetak" class="btn btn-success btn-sm float-right">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>

</section>
<?php include_once "partials/scripts.php"?>