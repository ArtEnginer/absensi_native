<?php
if (isset($_GET['id_pegawai'])) {
        $database = new Database();
        $db = $database->getConnection();

        $id = $_GET['id_pegawai'];
        $findSql = "SELECT * FROM pegawai WHERE id_pegawai = ?";
        $stmt = $db->prepare($findSql);
        $stmt->bindParam(1, $_GET['id_pegawai']);
        $stmt->execute();
        $row = $stmt->fetch();
        if (isset($row['id_pegawai'])) {
                if (isset($_POST['button_update'])) {

                        $database = new Database();
                        $db = $database->getConnection();

                        $id = $_GET['id_pegawai'];
                        $ValidateSql = "SELECT * FROM pegawai WHERE nip = ? AND id_pegawai != ?";
                        $stmt = $db->prepare($ValidateSql);
                        $stmt->bindParam(1, $_GET['nip']);
                        $stmt->bindParam(2, $_GET['id_pegawai']);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
?>
                                <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                        <h5><i class="icon fas fa-ban"> Gagal</i></h5>
                                        Nip Pegawai Sudah Ada
                                </div>
        <?php
                        } else {
                                $updateSql = "UPDATE pegawai SET id_jabatan = ?,nip = ?, nm_pegawai = ?, jk = ?,alamat = ?, agama = ?, no_hp = ?, email = ?, id_user = ? WHERE id_pegawai = $id";
                                $stmt = $db->prepare($updateSql);
                                $stmt->bindParam(1, $_POST['id_jabatan']);
                                $stmt->bindParam(2, $_POST['nip']);
                                $stmt->bindParam(3, $_POST['nm_pegawai']);
                                $stmt->bindParam(4, $_POST['jk']);
                                $stmt->bindParam(5, $_POST['alamat']);
                                $stmt->bindParam(6, $_POST['agama']);
                                $stmt->bindParam(7, $_POST['no_hp']);
                                $stmt->bindParam(8, $_POST['email']);
                                $stmt->bindParam(9, $_POST['id_user']);
                                if ($stmt->execute()) {
                                        $_SESSION['hasil'] = true;
                                        $_SESSION['pesan'] = "Berhasil Simpan Data";
                                } else {
                                        $_SESSION['hasil'] = false;
                                        $_SESSION['pesan'] = "Gagal Simpan Data";
                                }
                                echo "<meta http-equiv='refresh' content='0;url=?page=pegawairead'>";
                        }
                }
        }
        ?>
        <section class="content-header">
                <div class="container-fluid">
                        <div class="row mb2">
                                <div class="col-sm-6">
                                        <h1>Update Data Pegawai</h1>
                                </div>
                                <div class="col-sm-6">
                                        <ol class="breadcrumb float-sm-right">
                                                <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                                                <li class="breadcrumb-item"><a href="?page=pegawairead">Pegawai</a></li>
                                                <li class="breadcrumb-item active">Update Data</li>
                                        </ol>
                                </div>
                        </div>
                </div>
        </section>
        <section class="content">
                <div class="card">
                        <div class="card-header">
                                <h3 class="card-title">Update Pegawai</h3>
                        </div>

                        <div class="card-body">
                                <form method="POST">
                                        <div class="form-group">
                                                <label for="nama_lokasi">Nip</label>
                                                <input type="text" class="form-control" name="id_user" value="<?php echo $row['id_user'] ?>" hidden>
                                                <input type="text" class="form-control" name="nip" value="<?php echo $row['nip'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                                <label for="nama_lengkap">Nama Lengkap</label>
                                                <input type="text" class="form-control" value="<?php echo $row['nm_pegawai'] ?>" name="nm_pegawai" required>
                                        </div>
                                        <div class="form-group">
                                                <label for="id_jabatan">Jabatan</label>
                                                <select class="form-control" name="id_jabatan">
                                                        <option value="">--Pilih Jabatan--</option>
                                                        <?php
                                                        $database = new Database();
                                                        $db = $database->getConnection();

                                                        $selectSql = "SELECT * FROM jabatan";
                                                        $stmt_pegawai = $db->prepare($selectSql);
                                                        $stmt_pegawai->execute();

                                                        while ($row_pegawai = $stmt_pegawai->fetch(PDO::FETCH_ASSOC)) {
                                                                echo "<option value=\"" . $row_pegawai["id_jabatan"] . "\">" . $row_pegawai["nm_jabatan"] . "</option>";
                                                        }
                                                        ?>
                                                </select>
                                        </div>
                                        <div class="form-group">
                                                <label for="jk">Jenis Kelamin</label>
                                                <select class="form-control" name="jk">
                                                        <option value="">--Pilih Jenis Kelamin--</option>
                                                        <option value="L">Laki-Laki</option>
                                                        <option value="P">Perempuan</option>
                                                </select>
                                        </div>
                                        <div class="form-group">
                                                <label for="agama">Agama</label>
                                                <input type="text" class="form-control" value="<?php echo $row['agama'] ?>" name="agama" required>
                                        </div>
                                        <div class="form-group">
                                                <label for="no_hp">No Hp</label>
                                                <input type="text" class="form-control" value="<?php echo $row['no_hp'] ?>" name="no_hp" required>
                                        </div>
                                        <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" value="<?php echo $row['email'] ?>" name="email" required>
                                        </div>

                                        <a href="?page=pegawairead" class="btn btn-danger btn-sm float-right">
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