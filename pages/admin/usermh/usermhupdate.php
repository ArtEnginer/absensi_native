<?php
if (isset($_GET['id_user'])) {
        $database = new Database();
        $db = $database->getConnection();

        $id = $_GET['id_user'];
        // get data from tabel tb_user and pegawai where id_user = $id
        $query = "SELECT * FROM tb_user,mahasiswa WHERE tb_user.id_user = $id AND tb_user.id_user = mahasiswa.id_user";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // var_dump($data);
        // die();

        // $findSql = "SELECT * FROM tb_user WHERE id_user = ?";
        // $stmt = $db->prepare($findSql);
        // $stmt->bindParam(1, $_GET['id_user']);
        // $stmt->execute();
        // $row = $stmt->fetch();

        if (isset($row['id_user'])) {
                if (isset($_POST['button_update'])) {

                        $validasiSql = "SELECT * FROM tb_user WHERE username = ?";
                        $stmt = $db->prepare($validasiSql);
                        $stmt->bindParam(1, $_POST['username']);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
?>
                                <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                        <h5><i class="icon fas fa-ban"> Gagal</i></h5>
                                        Username Sudah Ada
                                </div>
                                <?php
                        } else {
                                if ($_POST['password'] != $_POST['password_ulangi']) {
                                ?>
                                        <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                                <h5><i class="icon fas fa-ban"> Gagal</i></h5>
                                                Password Tidak Sama
                                        </div>
        <?php } else {
                                        $md5Password = md5($_POST['password']);

                                        // update data from post data in tb_user and mahasiswa

                                        $insertSql = "UPDATE tb_user, mahasiswa SET username = ?, password = ?, peran = ?, nm_mahasiswa=? WHERE tb_user.id_user = mahasiswa.id_user AND tb_user.id_user = $id";

                                        $stmt = $db->prepare($insertSql);
                                        $stmt->bindParam(1, $_POST['username']);
                                        $stmt->bindParam(2, $md5Password);
                                        $stmt->bindParam(3, $_POST['peran']);
                                        $stmt->bindParam(4, $_POST['nama']);



                                        if ($stmt->execute()) {
                                                $_SESSION['hasil'] = true;
                                                $_SESSION['pesan'] = "Berhasil Simpan Data";
                                        } else {
                                                $_SESSION['hasil'] = false;
                                                $_SESSION['pesan'] = "Gagal Simpan Data";
                                        }
                                        echo "<meta http-equiv='refresh' content='0;url=?page=usermhread'>";
                                }
                        }
                }
        } ?>


        <section class="content-header">
                <div class="container-fluid">
                        <div class="row mb2">
                                <div class="col-sm-6">
                                        <h1>Update Data </h1>
                                </div>
                                <div class="col-sm-6">
                                        <ol class="breadcrumb float-sm-right">
                                                <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                                                <li class="breadcrumb-item"><a href="?page=usermhread"></a></li>
                                                <li class="breadcrumb-item active">Update Data</li>
                                        </ol>
                                </div>
                        </div>
                </div>
        </section>
        <section class="content">
                <div class="card">
                        <div class="card-header">
                                <h3 class="card-title">Update </h3>
                        </div>

                        <div class="card-body">
                                <form method="POST">
                                        <div class="form-group">
                                                <label for="nama">nama</label>

                                                <input type="text" class="form-control" value="<?php echo $row['nm_mahasiswa'] ?>" name="nama" required>
                                        </div>
                                        <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" value="<?php echo $row['username'] ?>" name="username" required>
                                        </div>
                                        <div class="form-group">
                                                <label for="password">password</label>
                                                <input type="text" class="form-control" placeholder="Masukan Password Baru" name="password" required>
                                        </div>
                                        <div class="form-group">
                                                <label for="password_ulangi">password(Ulangi)</label>
                                                <input type="text" class="form-control" placeholder="Ulangi Password Baru" name="password_ulangi" required>
                                                <input type="text" class="form-control" value="Mahasiswa" name="peran" hidden>
                                        </div>



                                        <a href="?page=usermhread" class="btn btn-danger btn-sm float-right">
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