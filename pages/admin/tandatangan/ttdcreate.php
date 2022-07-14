<?php
include 'database/sql.php';
if (isset($_POST['button_create'])) {
        $idp = $_POST['id'];

        // upload file
        $ekstensi_diperbolehkan    = array('jpg', 'png');
        $nama = $_FILES['file']['name'];
        $x = explode('.', $nama);
        $ekstensi = strtolower(end($x));
        $ukuran    = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];

        $cek =  mysqli_num_rows(mysqli_query($konek, "SELECT * FROM tanda_tangan WHERE id = $idp"));
        if ($cek > 0) {
                echo "<script>alert('Id Pegawai sudah digunakan.');window.location='?page=ttdcreate';</script>";
        } else {
                if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                        if ($ukuran < 1044070) {
                                move_uploaded_file($file_tmp, 'pages/admin/tandatangan/upload/' . $nama);
                                $sql = "INSERT INTO tanda_tangan  VALUES(NULL,'$idp','$nama')";
                                $query = mysqli_query($konek, $sql);

                                if ($query) {
                                        $_SESSION['hasil'] = true;
                                        $_SESSION['pesan'] = "Berhasil Simpan Data";

                                        echo "<script>window.location='?page=ttdread';</script>";
                                } else {
                                        $_SESSION['hasil'] = false;
                                        $_SESSION['pesan'] = "Gagal Simpan Data";

                                        echo "<script>window.location='?page=ttdread';</script>";
                                }
                        } else {
                                echo "<script>alert('Data Terlalu Besar!');</script>";
                        }
                } else {
                        echo "<script>alert('Ekstensi tidak perbolehkan!');</script>";
                }
        }
}
?>


<section class="content-header">
        <div class="container-fluid">
                <div class="row mb2">
                        <div class="col-sm-6">
                                <h1>Tambah Data Tanda Tangan</h1>
                        </div>
                        <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                                        <li class="breadcrumb-item"><a href="?page=pangkatread"> Tanda Tangan</a></li>
                                        <li class="breadcrumb-item active">Tambah Data</li>
                                </ol>
                        </div>
                </div>
        </div>
</section>
<section class="content">
        <div class="card">
                <div class="card-header">
                        <h3 class="card-title">Tambah Tanda Tangan</h3>
                </div>

                <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                        <label for="id"> Nama Pegawai</label>
                                        <select class="form-control" name="id">
                                                <option value="">--Pilih Pegawai--</option>
                                                <?php
                                                $database = new Database();
                                                $db = $database->getConnection();

                                                $selectSql = "SELECT * FROM kenaikan_pangkat 
                                                INNER JOIN pegawai ON pegawai.id = kenaikan_pangkat.id WHERE status='Disetujui'";
                                                $stmt_pegawai = $db->prepare($selectSql);
                                                $stmt_pegawai->execute();

                                                while ($row_pegawai = $stmt_pegawai->fetch(PDO::FETCH_ASSOC)) {
                                                        echo "<option value=\"" . $row_pegawai["id"] . "\">" . $row_pegawai["nm_pegawai"] . "</option>";
                                                }
                                                ?>
                                        </select>
                                </div>
                                <div class="form-group">
                                        <label for="file"> File</label>
                                        <input type="file" class="form-control" name="file" required>
                                </div>

                                <a href="?page=ttdread" class="btn btn-danger btn-sm float-right">
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