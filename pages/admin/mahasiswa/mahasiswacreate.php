<?php
if (isset($_POST['button_create'])) {

        $database = new Database();
        $db = $database->getConnection();

        $validasiSqql = "SELECT * FROM mahasiswa WHERE nim = ?";
        $stmt = $db->prepare($validasiSqql);
        $stmt->bindParam(1, $_POST['nim']);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
?>
                <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <h5><i class="icon fas fa-ban"> Gagal</i></h5>
                        nim Sudah Ada
                </div>
                <?php
        } else {
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
<?php
                        } else {
                                $md5Password = md5($_POST['password']);

                                $insertSql = "INSERT INTO tb_user VALUES (NULL,? ,? ,?)";
                                $stmt = $db->prepare($insertSql);
                                $stmt->bindParam(1, $_POST['username']);
                                $stmt->bindParam(2, $md5Password);
                                $stmt->bindParam(3, $_POST['peran']);

                                if ($stmt->execute()) {
                                        $id_user = $db->lastInsertId();

                                        // var_dump($_POST);
                                        // die();

                                        $insertpg = "INSERT INTO mahasiswa VALUES (NULL, ?,?,?,?,?,?,?)";
                                        $stmtmahasiswa = $db->prepare($insertpg);
                                        $stmtmahasiswa->bindParam(1, $_POST['nama_mahasiswa']);
                                        $stmtmahasiswa->bindParam(2, $_POST['jk']);
                                        $stmtmahasiswa->bindParam(3, $_POST['nim']);
                                        $stmtmahasiswa->bindParam(4, $_POST['alamat']);
                                        $stmtmahasiswa->bindParam(5, $id_user);
                                        $stmtmahasiswa->bindParam(6, $_POST['no_hp']);
                                        $stmtmahasiswa->bindParam(7, $_POST['email']);

                                        if ($stmtmahasiswa->execute()) {
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
        }
}
?>


<section class="content-header">
        <div class="container-fluid">
                <div class="row mb2">
                        <div class="col-sm-6">
                                <h1>Tambah Data mahasiswa</h1>
                        </div>
                        <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                                        <li class="breadcrumb-item"><a href="?page=mahasiswaread">mahasiswa</a></li>
                                        <li class="breadcrumb-item active">Tambah Data</li>
                                </ol>
                        </div>
                </div>
        </div>
</section>
<section class="content">
        <div class="card">
                <div class="card-header">
                        <h3 class="card-title">Tambah mahasiswa</h3>
                </div>

                <div class="card-body">
                        <form method="POST">
                                <div class="form-group">
                                        <label for="nama_lokasi">nim</label>
                                        <input type="text" class="form-control" name="nim" required>
                                </div>
                                <div class="form-group">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="nama_mahasiswa" required>
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
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" required>

                                </div>
                                <div class="form-group">
                                        <label for="no_hp">No HP</label>
                                        <input type="text" class="form-control" name="no_hp" required>
                                </div>
                                <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea type="text" class="form-control" name="alamat" required cols="30" rows="10"></textarea>

                                </div>


                                <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" required>
                                </div>
                                <div class="form-group">
                                        <label for="password">password</label>
                                        <input type="text" class="form-control" name="password" required>
                                </div>
                                <div class="form-group">
                                        <label for="password_ulangi">password(Ulangi)</label>
                                        <input type="text" class="form-control" name="password_ulangi" required>
                                </div>
                                <div class="form-group">
                                        <label for="peran">Peran</label>
                                        <select class="form-control" name="peran">
                                                <option value="">--Pilih Peran--</option>
                                                <option value="admin">admin</option>
                                                <option value="pimpinan">pimpinan</option>
                                                <option value="user">user</option>
                                        </select>
                                </div>

                                <a href="?page=lokasiread" class="btn btn-danger btn-sm float-right">
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