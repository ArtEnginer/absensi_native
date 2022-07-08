<?php
if (isset($_GET['id_jabatan'])) {
        $database = new Database();
        $db = $database->getConnection();

        $id = $_GET['id_jabatan'];
        $findSql = "SELECT * FROM jabatan WHERE id_jabatan = ?";
        $stmt = $db->prepare($findSql);
        $stmt->bindParam(1, $_GET['id_jabatan']);
        $stmt->execute();
        $row = $stmt->fetch();
        if (isset($row['id_jabatan'])) {
                if (isset($_POST['button_update'])) {

                        $database = new Database();
                        $db = $database->getConnection();

                        $id = $_GET['id_jabatan'];
                        $ValidateSql = "SELECT * FROM jabatan WHERE nm_jabatan = ? AND id_jabatan != ?";
                        $stmt = $db->prepare($ValidateSql);
                        $stmt->bindParam(1, $_GET['nm_jabatan']);
                        $stmt->bindParam(2, $_GET['id_jabatan']);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
?>
                                <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                        <h5><i class="icon fas fa-ban"> Gagal</i></h5>
                                        Nama Pangkat/ Jabatan Sudah Ada
                                </div>
        <?php
                        } else {
                                $updateSql = "UPDATE jabatan SET nm_jabatan = ? WHERE id_jabatan = ?";
                                $stmt = $db->prepare($updateSql);
                                $stmt->bindParam(1, $_POST['nm_jabatan']);
                                $stmt->bindParam(2, $_POST['id_jabatan']);
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
        }
        ?>

        <section class="content-header">
                <div class="container-fluid">
                        <div class="row mb2">
                                <div class="col-sm-6">
                                        <h1>Update Data Pangkat/ Jabatan</h1>
                                </div>
                                <div class="col-sm-6">
                                        <ol class="breadcrumb float-sm-right">
                                                <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                                                <li class="breadcrumb-item"><a href="?page=jabatanread"> Jabatan</a></li>
                                                <li class="breadcrumb-item active">Update Data</li>
                                        </ol>
                                </div>
                        </div>
                </div>
        </section>
        <section class="content">
                <div class="card">
                        <div class="card-header">
                                <h3 class="card-title">Update Pangkat/ Jabatan</h3>
                        </div>

                        <div class="card-body">
                                <form method="POST">
                                        <div class="form-group">
                                                <label for="nama_lokasi">Nama Pangkat/ Jabatan</label>
                                                <input type="hidden" class="form-control" name="id_jabatan" value="<?php echo $row['id_jabatan'] ?>">
                                                <input type="text" class="form-control" name="nm_jabatan" value="<?php echo $row['nm_jabatan'] ?>" required>
                                        </div>
                                        <a href="?page=jabatanread" class="btn btn-danger btn-sm float-right">
                                                <i class="fa fa-times"></i> Batal
                                        </a>
                                        <button type="submit" name="button_update" class="btn btn-success btn-sm float-right">
                                                <i class="fa fa-save"></i> Simpan
                                        </button>
                                </form>
                        </div>
                </div>
        </section>
<?php } ?>
<?php include_once "partials/scripts.php" ?>