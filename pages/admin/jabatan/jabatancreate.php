<?php
if (isset($_POST['button_create'])) {

        $database = new Database();
        $db = $database->getConnection();

        $validasiSqql = "SELECT * FROM jabatan WHERE nm_jabatan = ?";
        $stmt = $db->prepare($validasiSqql);
        $stmt->bindParam(1, $_POST['nm_jabatan']);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
?>
                <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <h5><i class="icon fas fa-ban"> Gagal</i></h5>
                        Nama Jabatan Sudah Ada
                </div>
<?php
        } else {
                $insertSql = "INSERT INTO jabatan SET id_jabatan= NULL, nm_jabatan= ?";
                $stmt = $db->prepare($insertSql);
                $stmt->bindParam(1, $_POST['nm_jabatan']);
                if ($stmt->execute()) {
                        $_SESSION['hasil'] = true;
                        $_SESSION['pesan'] = "Berhasil Simpan Data";
                } else {
                        $_SESSION['hasil'] = false;
                        $_SESSION['pesan'] = "Gagal Simpan Data";
                }
                echo "<meta http-equiv='refresh' content='0;url=?page=jabatanread'>";
        }
}
?>


<section class="content-header">
        <div class="container-fluid">
                <div class="row mb2">
                        <div class="col-sm-6">
                                <h1>Tambah Data Jabatan</h1>
                        </div>
                        <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                                        <li class="breadcrumb-item"><a href="?page=jabatanread"> Jabatan</a></li>
                                        <li class="breadcrumb-item active">Tambah Data</li>
                                </ol>
                        </div>
                </div>
        </div>
</section>
<section class="content">
        <div class="card">
                <div class="card-header">
                        <h3 class="card-title">Tambah Jabatan</h3>
                </div>

                <div class="card-body">
                        <form method="POST">
                                <div class="form-group">
                                        <label for="nm_jabatan">Nama Jabatan</label>
                                        <input type="text" class="form-control" name="nm_jabatan" required>
                                </div>

                                <a href="?page=jabatanread" class="btn btn-danger btn-sm float-right">
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