<?php
include 'database/sql.php';

if (isset($_GET['id_ttd'])) {
        $id = ($_GET["id_ttd"]);

        $query = "SELECT * FROM tanda_tangan WHERE id_ttd='$id'";
        $result = mysqli_query($konek, $query);

        if (!$result) {
                die("Query Error: " . mysqli_errno($konek) .
                        " - " . mysqli_error($konek));
        }
        $row = mysqli_fetch_assoc($result);
        if (!count($row)) {
                echo "<script>alert('Data tidak ditemukan pada database');window.location='?page=ttdread';</script>";
        }
} else {
        echo "<script>alert('Masukkan data id.');window.location='?page=ttdread';</script>";
}
?>

<section class="content-header">
        <div class="container-fluid">
                <div class="row mb2">
                        <div class="col-sm-6">
                                <h1>Update Data Tanda Tangan</h1>
                        </div>
                        <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                                        <li class="breadcrumb-item"><a href="?page=ttdread"> Tanda Tangan</a></li>
                                        <li class="breadcrumb-item active">Update Data</li>
                                </ol>
                        </div>
                </div>
        </div>
</section>
<section class="content">
        <div class="card">
                <div class="card-header">
                        <h3 class="card-title">Update Tanda Tangan</h3>
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
                                <a href="?page=pangkatread" class="btn btn-danger btn-sm float-right">
                                        <i class="fa fa-times"></i> Batal
                                </a>
                                <button type="submit" name="button_update" class="btn btn-success btn-sm float-right">
                                        <i class="fa fa-save"></i> Simpan
                                </button>
                        </form>
                </div>
        </div>
        <?php
        if (isset($_POST['button_update'])) {
                $idp = $_POST['id'];

                $file_data = $_FILES['file']['name'];

                if ($file_data != "") {
                        $ekstensi_diperbolehkan = array('png','jpg'); //ekstensi file gambar yang bisa diupload 
                        $x = explode('.', $file_data); //memisahkan nama file dengan ekstensi yang diupload
                        $ekstensi = strtolower(end($x));
                        $file_tmp = $_FILES['file']['tmp_name'];
                        $angka_acak     = rand(1, 999);
                        $file_baru = $angka_acak . '-' . $file_data; //menggabungkan angka acak dengan nama file sebenarnya
                        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                                move_uploaded_file($file_tmp, 'pages/admin/tandatangan/upload/' . $file_baru); //memindah file gambar ke folder gambar

                                // jalankan query UPDATE berdasarkan ID yang produknya kita edit
                                $query  = "UPDATE tanda_tangan SET id='$idp',file='$file_baru'";
                                $query .= "WHERE id_ttd = '$id'";
                                $result = mysqli_query($konek, $query);
                                // periska query apakah ada error
                                if (!$result) {
                                        die("Query gagal dijalankan: " . mysqli_errno($konek) .
                                                " - " . mysqli_error($konek));
                                } else {
                                        $_SESSION['hasil'] = true;
                                        $_SESSION['pesan'] = "Data Berhasil Diubah";
                                        echo "<script>window.location='?page=ttdread';</script>";
                                }
                        } else {
                                $_SESSION['hasil'] = false;
                                $_SESSION['pesan'] = "Extention tidak Valid / file terlalu besar";
                                echo "<script>window.location='?page=ttdread';</script>";
                        }
                } else {
                        // jalankan query UPDATE berdasarkan ID yang produknya kita edit
                        $query  = "UPDATE tanda_tangan SET id='$idp',file='$file_baru'";
                        $query .= "WHERE id_ttd = '$id'";
                        $result = mysqli_query($konek, $query);
                        // periska query apakah ada error
                        if (!$result) {
                                die("Query gagal dijalankan: " . mysqli_errno($konek) .
                                        " - " . mysqli_error($konek));
                        } else {
                                $_SESSION['hasil'] = true;
                                $_SESSION['pesan'] = "Data Berhasil Diubah";
                                echo "<script>window.location='?page=ttdread';</script>";
                        }
                }
        }
        ?>
</section>

<?php include_once "partials/scripts.php" ?>