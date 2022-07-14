<?php
if (isset($_GET['id_mahasiswa'])) {
        $database = new Database();
        $db = $database->getConnection();

        $id = $_GET['id_mahasiswa'];
        $findSql = "SELECT * FROM mahasiswa WHERE id_mahasiswa = ?";
        $stmt = $db->prepare($findSql);
        $stmt->bindParam(1, $_GET['id_mahasiswa']);
        $stmt->execute();
        $row = $stmt->fetch();
        if (isset($row['id_mahasiswa'])) {
                if (isset($_POST['button_update'])) {

                        $database = new Database();
                        $db = $database->getConnection();

                        $id = $_GET['id_mahasiswa'];
                        $ValidateSql = "SELECT * FROM mahasiswa WHERE nim = ? AND id_mahasiswa != ?";
                        $stmt = $db->prepare($ValidateSql);
                        $stmt->bindParam(1, $_GET['nim']);
                        $stmt->bindParam(2, $_GET['id_mahasiswa']);

                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
?>
                                <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                        <h5><i class="icon fas fa-ban"> Gagal</i></h5>
                                        Nip mahasiswa Sudah Ada
                                </div>
        <?php
                        } else {
                                $updateSql = "UPDATE mahasiswa SET nim = ?, nama_mahasiswa = ?, jk = ?,alamat = ?,id_user = ?, no_hp = ?, email = ? WHERE id_mahasiswa = $id";
                                $stmt = $db->prepare($updateSql);
                                $stmt->bindParam(1, $_POST['nim']);
                                $stmt->bindParam(2, $_POST['nama_mahasiswa']);
                                $stmt->bindParam(3, $_POST['jk']);
                                $stmt->bindParam(4, $_POST['alamat']);
                                $stmt->bindParam(5, $_POST['id_user']);
                                $stmt->bindParam(6, $_POST['no_hp']);
                                $stmt->bindParam(7, $_POST['email']);

                                if ($stmt->execute()) {
                                        $_SESSION['hasil'] = true;
                                        $_SESSION['pesan'] = "Berhasil Simpan Data";
                                } else {
                                        $_SESSION['hasil'] = false;
                                        $_SESSION['pesan'] = "Gagal Simpan Data";
                                }
                                echo "<meta http-equiv='refresh' content='0;url=?page=mahasiswaread'>";
                        }
                }
        }
        ?>
        <section class="content-header">
                <div class="container-fluid">
                        <div class="row mb2">
                                <div class="col-sm-6">
                                        <h1>Update Data Mahasiwa</h1>
                                </div>
                                <div class="col-sm-6">
                                        <ol class="breadcrumb float-sm-right">
                                                <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                                                <li class="breadcrumb-item"><a href="?page=mahasiswaread">mahasiswa</a></li>
                                                <li class="breadcrumb-item active">Update Data</li>
                                        </ol>
                                </div>
                        </div>
                </div>
        </section>
        <section class="content">
                <div class="card">
                        <div class="card-header">
                                <h3 class="card-title">Update mahasiswa</h3>
                        </div>

                        <div class="card-body">
                                <form method="POST">
                                        <div class="form-group">
                                                <label for="nama_lokasi">NIM</label>
                                                <input type="text" class="form-control" name="id_user" value="<?php echo $row['id_user'] ?>" hidden>
                                                <input type="text" class="form-control" name="nim" value="<?php echo $row['nim'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                                <label for="nama_lengkap">Nama Lengkap</label>
                                                <input type="text" class="form-control" value="<?php echo $row['nama_mahasiswa'] ?>" name="nama_mahasiswa" required>
                                        </div>
                
                                        <div class="form-group">
                                                <label for="jk">Jenis Kelamin</label>
                                                <select class="form-control" name="jk">
                                                        <option value="">--Pilih Jenis Kelamin--</option>
                                                       <?php 
                                                //        select jk from mahasiswa where id_mahasiswa = $id
                                                        $jk = $row['jk'];
                                                        if ($jk == "L") {
                                                                echo "<option value='L' selected>Laki-Laki</option>";
                                                                echo "<option value='P'>Perempuan</option>";
                                                        } else {
                                                                echo "<option value='L'>Laki-Laki</option>";
                                                                echo "<option value='P' selected>Perempuan</option>";
                                                        }
                                                        ?>
                                                       ?>
                                                </select>
                                        </div>

                                        <div class="form-group">
                                                <label for="no_hp">No Hp</label>
                                                <input type="text" class="form-control" value="<?php echo $row['no_hp'] ?>" name="no_hp" required>
                                        </div>
                                        <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" value="<?php echo $row['email'] ?>" name="email" required>
                                        </div>

                                        <a href="?page=mahasiswaread" class="btn btn-danger btn-sm float-right">
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