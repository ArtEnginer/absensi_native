<?php
if (isset($_POST['button_create'])) {

    $database = new Database();
    $db = $database->getConnection();

    $validasiSqql = "SELECT * FROM tb_pindahtugas WHERE id_pindah = ?";
    $stmt = $db->prepare($validasiSqql);
    $stmt->bindParam(1, $_POST['id_pindah']);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <h5><i class="icon fas fa-ban"> Gagal</i></h5>
            Judul Sudah Ada
        </div>
<?php
    } else {
        $insertSql = "INSERT INTO tb_pindahtugas SET id_pindah = NULL, id_pegawai= ?, alasan = ?, tanggal= ?,no_surat = ?";
        $stmt = $db->prepare($insertSql);
        $stmt->bindParam(1, $_POST['id_pegawai']);
        $stmt->bindParam(2, $_POST['alasan']);
        $stmt->bindParam(3, $_POST['tanggal']);
        $stmt->bindParam(4, $_POST['no_surat']);
        if ($stmt->execute()) {
            $_SESSION['hasil'] = true;
            $_SESSION['pesan'] = "Berhasil Simpan Data";
        } else {
            $_SESSION['hasil'] = false;
            $_SESSION['pesan'] = "Gagal Simpan Data";
        }
        echo "<meta http-equiv='refresh' content='0;url=?page=ptugas'>";
    }
}
?>


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb2">
            <div class="col-sm-6">
                <h1>Tambah pindah tugas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                    <li class="breadcrumb-item"><a href="?page=pread">pindah tugas</a></li>
                    <li class="breadcrumb-item active">Tambah Data</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah pindah tugas</h3>
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="no_agenda">Nomor</label>
                    <?php
                    $database = new Database();
                    $db = $database->getConnection();
                    $sql = "SELECT * FROM tb_pindahtugas ORDER BY id_pindah DESC LIMIT 1";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $id_pindah = $row['id_pindah'];
                    if($id_pindah == null){
                        $id_pindah ='SPT-' . 1;
                    }else{
                        $id_pindah ='SPT-' . ($id_pindah + 1);
                    }
                    ?>
                    <input type="text" class="form-control" name="no_surat" value="<?php echo $id_pindah ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="id_pegawai">Pegawai</label>
                    <select class="form-control" name="id_pegawai">
                        <option value="">--Pilih Pegawai--</option>
                        <?php
                        $database = new Database();
                        $db = $database->getConnection();

                        $selectSql = "SELECT * FROM pegawai";
                        $stmt_pegawai = $db->prepare($selectSql);
                        $stmt_pegawai->execute();

                        while ($row_pegawai = $stmt_pegawai->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=\"" . $row_pegawai["id_pegawai"] . "\">" . $row_pegawai["nm_pegawai"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal Surat</label>
                    <input type="date" class="form-control" name="tanggal" required>
                </div>
                <div class="form-group">
                    <label for="alasan">Alasan</label>
                    <textarea class="form-control" name="alasan" required></textarea>
                </div>

                <a href="?page=pread" class="btn btn-danger btn-sm float-right">
                    <i class="fa fa-times"></i> Batal
                </a>
                <button type="submit" name="button_create" class="btn btn-success btn-sm float-right">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>
</section>
<?php include_once "partials/scripts.php" ?>