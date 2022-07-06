<?php
if (isset($_GET['id_pangkat'])) {
        $database = new Database();
        $db = $database->getConnection();

        $id = $_GET['id_pangkat'];
        $findSql = "SELECT * FROM pangkat WHERE id_pangkat = ?";
        $stmt = $db->prepare($findSql);
        $stmt->bindParam(1, $_GET['id_pangkat']);
        $stmt->execute();
        $row = $stmt->fetch();
        if (isset($row['id_pangkat'])) {
                if (isset($_POST['button_update'])) {

                        $database = new Database();
                        $db = $database->getConnection();

                        $id = $_GET['id_pangkat'];
                        $ValidateSql = "SELECT * FROM pangkat WHERE nm_pangkat = ? AND id_pangkat != ?";
                        $stmt = $db->prepare($ValidateSql);
                        $stmt->bindParam(1, $_GET['nm_pangkat']);
                        $stmt->bindParam(2, $_GET['id_pangkat']);
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
                                $updateSql = "UPDATE pangkat SET nm_pangkat = ? WHERE id_pangkat = ?";
                                $stmt = $db->prepare($updateSql);
                                $stmt->bindParam(1, $_POST['nm_pangkat']);
                                $stmt->bindParam(2, $_POST['id_pangkat']);
                                if ($stmt->execute()) {
                                        $_SESSION['hasil'] = true;
                                        $_SESSION['pesan'] = "Berhasil Simpan Data";
                                } else {
                                        $_SESSION['hasil'] = false;
                                        $_SESSION['pesan'] = "Gagal Simpan Data";
                                }
                                echo "<meta http-equiv='refresh' content='0;url=?page=pangkatread'>";
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
                                                <li class="breadcrumb-item"><a href="?page=pangkatread">Pangkat/ Jabatan</a></li>
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
                                                <input type="hidden" class="form-control" name="id_pangkat" value="<?php echo $row['id_pangkat'] ?>">
                                                <input type="text" class="form-control" name="nm_pangkat" value="<?php echo $row['nm_pangkat'] ?>" required>
                                        </div>
                                        <a href="?page=pangkatread" class="btn btn-danger btn-sm float-right">
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