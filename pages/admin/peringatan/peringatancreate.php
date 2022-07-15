<?php
if (isset($_POST['button_create'])) {

        $database = new Database();
        $db = $database->getConnection();

        $validasiSqql = "SELECT * FROM tb_peringatan WHERE id_sp = ?";
        $stmt = $db->prepare($validasiSqql);
        $stmt->bindParam(1, $_POST['id_sp']);
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
                $insertSql = "INSERT INTO tb_peringatan SET id_sp = NULL, tgl_surat= ?, sp= ?, no_surat = ?, pelanggaran=?, id_pegawai = ?";
                $stmt = $db->prepare($insertSql);
                $stmt->bindParam(1, $_POST['tgl_surat']);
                $stmt->bindParam(2, $_POST['sp']);
                $stmt->bindParam(3, $_POST['no_surat']);
                $stmt->bindParam(4, $_POST['pelanggaran']);
                $stmt->bindParam(5, $_POST['id_pegawai']);
                if ($stmt->execute()) {
                        $_SESSION['hasil'] = true;
                        $_SESSION['pesan'] = "Berhasil Simpan Data";
                } else {
                        $_SESSION['hasil'] = false;
                        $_SESSION['pesan'] = "Gagal Simpan Data";
                }
                echo "<meta http-equiv='refresh' content='0;url=?page=pread'>";
        }
}
?>


<section class="content-header">
        <div class="container-fluid">
                <div class="row mb2">
                        <div class="col-sm-6">
                                <h1>Tambah peringatan</h1>
                        </div>
                        <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                                        <li class="breadcrumb-item"><a href="?page=pread">Peringatan</a></li>
                                        <li class="breadcrumb-item active">Tambah Data</li>
                                </ol>
                        </div>
                </div>
        </div>
</section>
<section class="content">
        <div class="card">
                <div class="card-header">
                        <h3 class="card-title">Tambah Peringatan</h3>
                </div>

                <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                        <label for="no_agenda">Nomor</label>
                                        <?php
                                        $database = new Database();
                                        $db = $database->getConnection();
                                        $sql = "SELECT * FROM tb_peringatan ORDER BY id_sp DESC LIMIT 1";
                                        $stmt = $db->prepare($sql);
                                        $stmt->execute();
                                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                        // count
                                        $count = $stmt->rowCount();
                                        if ($count == 0) {
                                                $no_surat = "SKP-0001";
                                        } else {
                                                $no_surat = $row['no_surat'];
                                                $no_surat = explode("-", $no_surat);
                                                $no_surat = $no_surat[1] + 1;
                                                $no_surat = "SKP-" . $no_surat;
                                        }

                                        ?>
                                        <input type="text" class="form-control" name="no_surat" value="<?php echo $no_surat ?>" readonly>
                                </div>

                                <div class="form-group">
                                        <label for="id_pegawai">Penanggung Jawab</label>
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
                                        <label for="tgl_surat">Tanggal Surat</label>
                                        <input type="date" class="form-control" name="tgl_surat" required>
                                </div>
                                <div class="form-group">
                                        <label for="">Surat Peringatan</label>
                                        <input type="text  " class="form-control" name="sp" required>
                                </div>
                                <div class="form-group">
                                        <label for="">Pelanggaran</label>
                                        <input type="text" class="form-control" name="pelanggaran" required>
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