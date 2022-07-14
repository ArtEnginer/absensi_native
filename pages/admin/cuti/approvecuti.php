<?php
if (isset($_GET['id_cuti'])) {
        $database = new Database();
        $db = $database->getConnection();

        $id = $_GET['id_cuti'];
        $findSql = "SELECT * FROM surat_cuti
        INNER JOIN pegawai ON pegawai.id_pegawai = surat_cuti.id_pegawai
        INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan  WHERE id_cuti = ?";
        $stmt = $db->prepare($findSql);
        $stmt->bindParam(1, $_GET['id_cuti']);
        $stmt->execute();
        $row = $stmt->fetch();
        if (isset($row['id_cuti'])) {
                if (isset($_POST['button_update'])) {

                        $updateSql = "UPDATE surat_cuti SET awal_cuti = ?, akhir_cuti = ?, id_pegawai= ?, keterangan = ?,file = ?, status1= ? WHERE id_cuti = $id";
                        $stmt = $db->prepare($updateSql);
                        $stmt->bindParam(1, $_POST['awal_cuti']);
                        $stmt->bindParam(2, $_POST['akhir_cuti']);
                        $stmt->bindParam(3, $_POST['id_pegawai']);
                        $stmt->bindParam(4, $_POST['keterangan']);
                        $stmt->bindParam(5, $_POST['file']);
                        $stmt->bindParam(6, $_POST['status1']);
                        if ($stmt->execute()) {
                                $_SESSION['hasil'] = true;
                                $_SESSION['pesan'] = "Berhasil Update Data";
                        } else {
                                $_SESSION['hasil'] = false;
                                $_SESSION['pesan'] = "Gagal Update Data";
                        }
                        echo "<meta http-equiv='refresh' content='0;url=?page=cutiread'>";
                }
        }

?>

        <section class="content-header">
                <div class="container-fluid">
                        <div class="row mb2">
                                <div class="col-sm-6">
                                        <h1>Approve Data Surat Cuti</h1>
                                </div>
                                <div class="col-sm-6">
                                        <ol class="breadcrumb float-sm-right">
                                                <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                                                <li class="breadcrumb-item"><a href="?page=cutiread">Surat Cuti</a></li>
                                                <li class="breadcrumb-item active">Approve Data</li>
                                        </ol>
                                </div>
                        </div>
                </div>
        </section>
        <section class="content">
                <div class="card">
                        <div class="card-header">
                                <h3 class="card-title">Approve Surat Cuti</h3>
                        </div>

                        <div class="card-body">
                                <form method="POST">
                                        <div class="form-group">
                                                <label>Nip | Nama</label>
                                                <input type="text" class="form-control" value="<?php echo $row['nip']; ?> | <?php echo $row['nm_pegawai']; ?>" readonly>
                                                <input type="text" class="form-control" name="awal_cuti" value="<?php echo $row['awal_cuti']; ?>" hidden>
                                                <input type="text" class="form-control" name="akhir_cuti" value="<?php echo $row['akhir_cuti']; ?>" hidden>
                                                <input type="text" class="form-control" name="id_pegawai" value="<?php echo $row['id_pegawai']; ?>" hidden>
                                                <input type="text" class="form-control" name="keterangan" value="<?php echo $row['keterangan']; ?>" hidden>
                                                <input type="text" class="form-control" name="file" value="<?php echo $row['file']; ?>" hidden>
                                        </div>
                                        <div class="form-group">
                                                <label for="status1">Status</label>
                                                <select class="form-control" name="status1">
                                                        <option value="">--Pilih Status--</option>
                                                        <option value="Disetujui">Disetujui</option>
                                                        <option value="Ditolak">Ditolak</option>
                                                </select>
                                        </div>

                                        <a href="?page=cutiread" class="btn btn-danger btn-sm float-right">
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