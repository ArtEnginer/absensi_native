<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT * FROM gaji WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $row = $stmt->fetch();
    // var_dump($row);
    // die();
}

$idmahasiswa = $row['id_mahasiswa'];
// get data from database mahasiswa
$query = "SELECT * FROM mahasiswa WHERE id_mahasiswa = $idmahasiswa";
$stmt = $db->prepare($query);
$stmt->execute();
$mahasiswa = $stmt->fetch();

if(isset($_POST['update'])){
    $id = $_GET['id'];
    $rekening_no = $_POST['rekening_no'];
    $rekening_bank = $_POST['rekening_bank'];
    $kehadiran = $_POST['kehadiran'];
    $gaji_pokok = $_POST['gaji_pokok'];
    $gaji_bonus = $_POST['gaji_bonus'];
    $gaji_lembur = $_POST['gaji_lembur'];
    $bpjs_kesehatan = $_POST['bpjs_kesehatan'];
    $bpjs_tenaker = $_POST['bpjs_tenaker'];
    $pinjaman = $_POST['pinjaman'];
    $biaya_transfer = $_POST['biaya_transfer'];
    $tanggal = $_POST['tanggal'];
    $database = new Database();
    $db = $database->getConnection();
    $query = "UPDATE gaji SET rekening_no = :rekening_no, rekening_bank = :rekening_bank, kehadiran = :kehadiran, gaji_pokok = :gaji_pokok, gaji_bonus = :gaji_bonus, gaji_lembur = :gaji_lembur, bpjs_kesehatan = :bpjs_kesehatan, bpjs_tenaker = :bpjs_tenaker, pinjaman = :pinjaman, biaya_transfer = :biaya_transfer, tanggal = :tanggal WHERE id = :id";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':rekening_no', $rekening_no);
    $stmt->bindParam(':rekening_bank', $rekening_bank);
    $stmt->bindParam(':kehadiran', $kehadiran);
    $stmt->bindParam(':gaji_pokok', $gaji_pokok);
    $stmt->bindParam(':gaji_bonus', $gaji_bonus);
    $stmt->bindParam(':gaji_lembur', $gaji_lembur);
    $stmt->bindParam(':bpjs_kesehatan', $bpjs_kesehatan);
    $stmt->bindParam(':bpjs_tenaker', $bpjs_tenaker);
    $stmt->bindParam(':pinjaman', $pinjaman);
    $stmt->bindParam(':biaya_transfer', $biaya_transfer);
    $stmt->bindParam(':tanggal', $tanggal);
    $stmt->bindParam(':id', $id);
    if($stmt->execute()){
        $_SESSION['hasil'] = true;
        $_SESSION['pesan'] = "Berhasil diubah";
    } else {
        $_SESSION['hasil'] = false;
        $_SESSION['pesan'] = "Gagal diubah";
    }
    echo "<meta http-equiv='refresh' content='0;url=?page=gajimahasiswa'>";

    
}


// var_dump($mahasiswa['nm_mahasiswa']);
// die();



?>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Gaji</h3>
        </div>

        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="id">Gaji Untuk</label>
                    <input type="text" class="form-control" value="<?php echo $mahasiswa['nama_mahasiswa'] ?>" readonly>
                    <input type="text" class="form-control" name="id_mahasiswa" hidden readonly value="<?= $mahasiswa['id_mahasiswa'] ?>">
                </div>
                <div class="form-group">
                    <label for="rekening_no">Nomor Rekening</label>
                    <input type="text" class="form-control" name="rekening_no" value="<?= $row['rekening_no'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="rekening_bank">Rekening Bank</label>
                    <input type="text" class="form-control" name="rekening_bank" value="<?= $row['rekening_bank'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="kehadiran">Jumlah Kehadiran</label>
                    <input type="number" class="form-control" name="kehadiran" value="<?= $row['kehadiran'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="gaji_pokok">Gaji Pokok</label>
                    <input type="number" class="form-control" name="gaji_pokok" value="<?= $row['gaji_pokok'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="gaji_bonus">Uang Makan / Transport</label>
                    <input type="number" class="form-control" name="gaji_bonus" value="<?= $row['gaji_bonus'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="gaji_lembur">Uang Lembur</label>
                    <input type="number" class="form-control" name="gaji_lembur" value="<?= $row['gaji_lembur'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="bpjs_kesehatan">BPJS Kesehatan</label>
                    <input type="number" class="form-control" name="bpjs_kesehatan" value="<?= $row['bpjs_kesehatan'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="bpjs_tenaker">BPJS Ketenagakerjaan</label>
                    <input type="number" class="form-control" name="bpjs_tenaker" value="<?= $row['bpjs_tenaker'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="pinjaman">Pinjaman</label>
                    <input type="number" class="form-control" name="pinjaman" value="<?= $row['pinjaman'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="biaya_transfer">Biaya Transfer</label>
                    <input type="number" class="form-control" name="biaya_transfer" value="<?= $row['biaya_transfer'] ?>" required>
                </div>
                <input type="hidden" name="tanggal" value="<?= date('Y-m-d H:i:s') ?>">

                <a href="?page=gajimahasiwa" class="btn btn-danger btn-sm float-right">
                    <i class="fa fa-times"></i> Batal
                </a>
                <button type="submit" name="update" class="btn btn-success btn-sm float-right btn-update">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>

</section>

<?php include_once "partials/scripts.php" ?>