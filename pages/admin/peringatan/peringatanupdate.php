<?php
if (isset($_GET['id_sp'])) {
        $database = new Database();
        $db = $database->getConnection();

        $id = $_GET['id_sp'];
        $findSql = "SELECT * FROM tb_peringatan WHERE id_sp = ?";
        $stmt = $db->prepare($findSql);
        $stmt->bindParam(1, $_GET['id_sp']);
        $stmt->execute();
        $row = $stmt->fetch();
        if (isset($row['id_sp'])) {
                if (isset($_POST['button_update'])) {


                        $updateSql = "UPDATE tb_peringatan SET tgl_surat = ?, sp = ?, no_surat = ?, pelanggaran = ?, id_pegawai = ?  WHERE id_sp = $id";
                        $stmt = $db->prepare($updateSql);
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
                                        <h1>Update Data Pelanggaran</h1>
                                </div>
                                <div class="col-sm-6">
                                        <ol class="breadcrumb float-sm-right">
                                                <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                                                <li class="breadcrumb-item"><a href="?page=jabatanread"> Pelanggaran</a></li>
                                                <li class="breadcrumb-item active">Update Data</li>
                                        </ol>
                                </div>
                        </div>
                </div>
        </section>
        <section class="content">
                <div class="card">
                        <div class="card-header">
                                <h3 class="card-title">Update Pelanggaran</h3>
                        </div>

                        <div class="card-body">
                                <form method="POST">

                                        <div class="form-group">
                                                <label for="no">No Surat</label>
                                                <input type="text" class="form-control" name="no_surat" value="<?php echo $row['no_surat'] ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                                <label for="id_sp">Tanggal Surat</label>
                                                <input type="hidden" class="form-control" name="id_sp" value="<?php echo $row['id_sp'] ?>">
                                                <input type="date" class="form-control" name="tgl_surat" value="<?php echo $row['tgl_surat'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                                <label for="sp">SP</label>
                                                <input type="text" class="form-control" name="sp" value="<?php echo $row['sp'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                                <label for="pelanggaran">Pelanggaran</label>
                                                <input type="text" class="form-control" name="pelanggaran" value="<?php echo $row['pelanggaran'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                                <label for="id">Pegawai</label>
                                                <select class="form-control" name="id_pegawai">
                                                        <option value="">--Pilih Pegawai--</option>
                                                        <?php
                                                        $database = new Database();
                                                        $db = $database->getConnection();

                                                        $selectSql = "SELECT * FROM pegawai";
                                                        $stmt_karyawan = $db->prepare($selectSql);
                                                        $stmt_karyawan->execute();

                                                        while ($row_karyawan = $stmt_karyawan->fetch(PDO::FETCH_ASSOC)) {
                                                                echo "<option value=\"" . $row_karyawan["id_pegawai"] . "\">" . $row_karyawan["nm_pegawai"] . "</option>";
                                                        }
                                                        ?>
                                                </select>
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