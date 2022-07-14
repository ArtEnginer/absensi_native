<?php
include "database/sql.php";

$id = $_GET['id'];
$querydata = $mysqli->query("SELECT * FROM tb_pindahtugas JOIN pegawai ON tb_pindahtugas.id_pegawai = pegawai.id_pegawai WHERE id_pindah = $id");
$data = $querydata->fetch_array();

// var_dump($data);
// die();

if (isset($_POST['button_create'])) {
    $id_pegawai = $_POST['id_pegawai'];
    $tanggal = $_POST['tanggal'];
    $alasan = $_POST['alasan'];
    $tanggal = date('Y-m-d', strtotime($tanggal));
   $update = $mysqli->query("UPDATE tb_pindahtugas SET id_pegawai = '$id_pegawai', tanggal = '$tanggal', alasan = '$alasan' WHERE id_pindah = $id");
    if ($update) {
         $_SESSION['hasil'] = true;
         $_SESSION['pesan'] = "Berhasil diubah";
    } else {
         $_SESSION['hasil'] = false;
         $_SESSION['pesan'] = "Gagal diubah";
    }
    echo "<meta http-equiv='refresh' content='0;url=?page=ptugas'>";
}
?>


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb2">
            <div class="col-sm-6">
                <h1>Tambah pindah tugas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                    <li class="breadcrumb-item"><a href="?page=pread">pindah tugas</a></li>
                    <li class="breadcrumb-item active">Tambah Data</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah pindah tugas</h3>
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="no_surat">Nomor</label>

                    <input type="text" class="form-control" name="no_surat" value="<?= $data['no_surat'] ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="id_pegawai">Pegawai</label>
                    <select class="form-control" name="id_pegawai">
                        <option value="">--Pilih Pegawai--</option>
                        <?php
                        // ifdata not empty use data from database and select the data from database
                        if ($data['id_pegawai'] != "") {
                            $querypegawai = $mysqli->query("SELECT * FROM pegawai");
                            while ($pegawai = $querypegawai->fetch_array()) {
                                if ($pegawai['id_pegawai'] == $data['id_pegawai']) {
                                    echo "<option value='$pegawai[id_pegawai]' selected>$pegawai[nm_pegawai]</option>";
                                } else {
                                    echo "<option value='$pegawai[id_pegawai]'>$pegawai[nm_pegawai]</option>";
                                }
                            }
                        } else {
                            $querypegawai = $mysqli->query("SELECT * FROM pegawai");
                            while ($pegawai = $querypegawai->fetch_array()) {
                                echo "<option value='$pegawai[id_pegawai]'>$pegawai[nm_pegawai]</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal Surat</label>
                    <input type="date" class="form-control" name="tanggal" value="<?= $data['tanggal'] ?>">
                </div>
                <div class="form-group">
                    <label for="alasan">Alasan</label>
                    <textarea class="form-control" name="alasan" required>
                        <?= $data['alasan'] ?>
                    </textarea>
                </div>

                <a href="?page=pread" class="btn btn-danger btn-sm float-right">
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