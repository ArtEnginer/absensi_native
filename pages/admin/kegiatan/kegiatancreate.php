<?php
if (isset($_POST['button_create'])) {

        $database = new Database();
        $db = $database->getConnection();

        $validasiSqql = "SELECT * FROM kegiatan WHERE judul = ?";
        $stmt = $db->prepare($validasiSqql);
        $stmt->bindParam(1, $_POST['judul']);
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
                $insertSql = "INSERT INTO kegiatan SET id_kegiatan = NULL, nomor = ?, judul= ?,id_pegawai = ?, lokasi = ?, waktu = ?, dana = ?";
                $stmt = $db->prepare($insertSql);
                $stmt->bindParam(1, $_POST['nomor']);
                $stmt->bindParam(2, $_POST['judul']);
                $stmt->bindParam(3, $_POST['id_pegawai']);
                $stmt->bindParam(4, $_POST['lokasi']);
                $stmt->bindParam(5, $_POST['waktu']);
                $stmt->bindParam(6, $_POST['dana']);
                if ($stmt->execute()) {
                        $_SESSION['hasil'] = true;
                        $_SESSION['pesan'] = "Berhasil Simpan Data";
                } else {
                        $_SESSION['hasil'] = false;
                        $_SESSION['pesan'] = "Gagal Simpan Data";
                }
                echo "<meta http-equiv='refresh' content='0;url=?page=kread'>";
        }
}
?>


<section class="content-header">
        <div class="container-fluid">
                <div class="row mb2">
                        <div class="col-sm-6">
                                <h1>Tambah kegiatan</h1>
                        </div>
                        <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                                        <li class="breadcrumb-item"><a href="?page=kread">Kegiatan</a></li>
                                        <li class="breadcrumb-item active">Tambah Data</li>
                                </ol>
                        </div>
                </div>
        </div>
</section>
<section class="content">
        <div class="card">
                <div class="card-header">
                        <h3 class="card-title">Tambah Kegiatan</h3>
                </div>
                <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                        <label for="no_agenda">Nomor</label>
                                        <?php
                                        $database = new Database();
                                        $db = $database->getConnection();

                                        $sql = $db->prepare("SELECT max(nomor) as nomor FROM kegiatan");
                                        $sql->execute();
                                        $hasil = $sql->fetch();
                                        $kode = $hasil["nomor"];
                                        $noUrut = (int) substr($kode, 3);
                                        $noUrut++;
                                        $char = "K-";
                                        $noAgenda = $char . sprintf("%04s", $noUrut);
                                        ?>
                                        <input type="text" class="form-control" name="nomor" value="<?php echo $noAgenda ?>" readonly>
                                </div>

                                <div class="card-body">
                                        <form method="POST">
                                                <div class="form-group">
                                                        <label for="judul">Judul</label>
                                                        <input type="text" class="form-control" name="judul">
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
                                                        <label for="lokasi">Lokasi</label>
                                                        <input type="text" class="form-control" name="lokasi" required>
                                                </div>
                                                <div class="form-group">
                                                        <label for="waktu">Waktu Pelaksanaan</label>
                                                        <input type="date" class="form-control" name="waktu" required>
                                                </div>
                                                <div class="form-group">
                                                        <label for="dana">Sumber Dana</label>
                                                        <input type="text" class="form-control" name="dana" required>
                                                </div>
                                                <a href="?page=kread" class="btn btn-danger btn-sm float-right">
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