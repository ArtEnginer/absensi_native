<?php
include 'database/sql.php';
if (isset($_POST['button_create'])) {
        $awc = $_POST['awal_cuti'];
        $akc   = $_POST['akhir_cuti'];
        $idp = $_POST['id_pegawai'];
        $ket = $_POST['keterangan'];
        $st = $_POST['status1'];

        // upload file
        $ekstensi_diperbolehkan    = array('pdf', 'xls', 'pptx', 'docx', 'jpg');
        $nama = $_FILES['file']['name'];
        $x = explode('.', $nama);
        $ekstensi = strtolower(end($x));
        $ukuran    = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                if ($ukuran < 1044070) {
                        move_uploaded_file($file_tmp, 'pages/admin/cuti/upload/' . $nama);
                        $sql = "INSERT INTO surat_cuti  VALUES(NULL,'$awc','$akc','$idp','$ket','$nama','$st')";
                        $query = mysqli_query($konek, $sql);
                        if ($query) {
                                $_SESSION['hasil'] = true;
                                $_SESSION['pesan'] = "Berhasil Simpan Data";

                                echo "<script>window.location='?page=cutiread';</script>";
                        } else {
                                $_SESSION['hasil'] = false;
                                $_SESSION['pesan'] = "Gagal Simpan Data";

                                echo "<script>window.location='?page=cutiread';</script>";
                        }
                } else {
                        echo "<script>alert('Data Terlalu Besar!');</script>";
                }
        } else {
                echo "<script>alert('Ekstensi tidak perbolehkan!');</script>";
        }
}

?>


<section class="content-header">
        <div class="container-fluid">
                <div class="row mb2">
                        <div class="col-sm-6">
                                <h1>Tambah Surat cuti</h1>
                        </div>
                        <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                                        <li class="breadcrumb-item"><a href="?page=cutiread">Cuti</a></li>
                                        <li class="breadcrumb-item active">Tambah Data</li>
                                </ol>
                        </div>
                </div>
        </div>
</section>
<section class="content">
        <div class="card">
                <div class="card-header">
                        <h3 class="card-title">Tambah Cuti</h3>
                </div>

                <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
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
                                <div class="form-group">
                                        <label for="awal_cuti">Tanggal Awal</label>
                                        <input type="date" class="form-control" name="awal_cuti" required>
                                        <input type="text" class="form-control" name="status1" value="Pending" hidden>
                                </div>
                                <div class="form-group">
                                        <label for="akhir_cuti">Tanggal Akhir</label>
                                        <input type="date" class="form-control" name="akhir_cuti" required>
                                </div>

                                <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan" required>
                                </div>
                                <div class="form-group">
                                        <label for="file">file</label>
                                        <input type="file" class="form-control" name="file" required>
                                </div>
                                <a href="?page=cutiread" class="btn btn-danger btn-sm float-right">
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