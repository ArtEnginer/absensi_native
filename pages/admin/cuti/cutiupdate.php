<?php
include 'database/sql.php';

if (isset($_GET['id_cuti'])) {
        $id = ($_GET["id_cuti"]);

        $query = "SELECT * FROM surat_cuti WHERE id_cuti='$id'";
        $result = mysqli_query($konek, $query);

        if (!$result) {
                die("Query Error: " . mysqli_errno($konek) .
                        " - " . mysqli_error($konek));
        }
        $row = mysqli_fetch_assoc($result);
        if (!count($row)) {
                echo "<script>alert('Data tidak ditemukan pada database');window.location='?page=cutiread';</script>";
        }
} else {
        echo "<script>alert('Masukkan data id.');window.location='?page=cutiread';</script>";
}
?>

<section class="content-header">
        <div class="container-fluid">
                <div class="row mb2">
                        <div class="col-sm-6">
                                <h1>Update Data Cuti</h1>
                        </div>
                        <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                                        <li class="breadcrumb-item"><a href="?page=cutiread">Cuti</a></li>
                                        <li class="breadcrumb-item active">Update Data</li>
                                </ol>
                        </div>
                </div>
        </div>
</section>
<section class="content">
        <div class="card">
                <div class="card-header">
                        <h3 class="card-title">Update cuti</h3>
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
                                        <input type="date" value="<?php echo $row['awal_cuti'] ?>" class="form-control" name="awal_cuti" required>
                                </div>
                                <div class="form-group">
                                        <label for="akhir_cuti">Tanggal Akhir</label>
                                        <input type="date" value="<?php echo $row['awal_cuti'] ?>" class="form-control" name="akhir_cuti" required>
                                </div>
                                <div class="form-group">
                                        <label for="file">file</label>
                                        <input type="file" class="form-control" name="file" required>
                                </div>

                                <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" class="form-control" name="status1" value="Pending" hidden>
                                        <input type="text" class="form-control" name="keterangan" value="<?php echo $row['keterangan'] ?>" required>
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
        <?php
        if (isset($_POST['button_update'])) {
                $id = $_GET['id_cuti'];

                $awc = $_POST['awal_cuti'];
                $akc   = $_POST['akhir_cuti'];
                $idp = $_POST['id_pegawai'];
                $ket = $_POST['keterangan'];
                $sts = $_POST['status1'];

                $file_data = $_FILES['file']['name'];

                if ($file_data != "") {
                        $ekstensi_diperbolehkan = array('pdf', 'xls', 'pptx', 'docx', 'jpg'); //ekstensi file gambar yang bisa diupload 
                        $x = explode('.', $file_data); //memisahkan nama file dengan ekstensi yang diupload
                        $ekstensi = strtolower(end($x));
                        $file_tmp = $_FILES['file']['tmp_name'];
                        $angka_acak     = rand(1, 999);
                        $file_baru = $angka_acak . '-' . $file_data; //menggabungkan angka acak dengan nama file sebenarnya
                        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                                move_uploaded_file($file_tmp, 'pages/admin/cuti/upload/' . $file_baru); //memindah file gambar ke folder gambar

                                // jalankan query UPDATE berdasarkan ID yang produknya kita edit
                                $query  = "UPDATE surat_cuti SET awal_cuti='$awc',akhir_cuti='$akc',id_pegawai='$idp',keterangan='$ket',file='$file_baru',status1='$sts'";
                                $query .= "WHERE id_cuti = '$id'";
                                $result = mysqli_query($konek, $query);
                                // periska query apakah ada error
                                if (!$result) {
                                        die("Query gagal dijalankan: " . mysqli_errno($konek) .
                                                " - " . mysqli_error($konek));
                                } else {
                                        $_SESSION['hasil'] = true;
                                        $_SESSION['pesan'] = "Data Berhasil Diubah";
                                        echo "<script>window.location='?page=cutiread';</script>";
                                }
                        } else {
                                $_SESSION['hasil'] = false;
                                $_SESSION['pesan'] = "Extention tidak Valid / file terlalu besar";
                                echo "<script>window.location='?page=cutiread';</script>";
                        }
                } else {
                        // jalankan query UPDATE berdasarkan ID yang produknya kita edit
                        $query  = "UPDATE surat_cuti SET awal_cuti='$awc',akhir_cuti='$akc',id_pegawai='$idp',keterangan='$ket',file='$file_baru',status1='$sts'";
                        $query .= "WHERE id_cuti = '$id'";
                        $result = mysqli_query($konek, $query);
                        // periska query apakah ada error
                        if (!$result) {
                                die("Query gagal dijalankan: " . mysqli_errno($konek) .
                                        " - " . mysqli_error($konek));
                        } else {
                                $_SESSION['hasil'] = true;
                                $_SESSION['pesan'] = "Data Berhasil Diubah";
                                echo "<script>window.location='?page=cutiread';</script>";
                        }
                }
        }
        ?>
</section>
<?php include_once "partials/scripts.php" ?>