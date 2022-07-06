<?php
include 'database/sql.php';

date_default_timezone_set("Asia/Jakarta");
$tanggalSekarang = date("d-m-Y");
$jamSekarang = date('timestamp');


if (isset($_POST['simpan'])) {

        $id = $_POST['id_pegawai'];
        $tanggal = $_POST['tanggal'];
        $jam = $_POST['jam_masuk'];
        $pulang = "";

        // Validasi tanggal
        $select = mysqli_query($konek, "SELECT * FROM tb_absen WHERE id_pegawai='$id' AND tanggal='$tanggal'");
        $row = mysqli_num_rows($select);

        if ($row) {
                echo '<script>alert("anda sudah absen untuk hari ini, absen lagi besok!")</script>';
        } else {
                echo '<script>alert("terima kasih")</script>';
                $res =  mysqli_query($konek, "INSERT INTO tb_absen SET id_pegawai='$id', tanggal='$tanggal', jam_pulang= '$pulang'");
        }
}
if (isset($_POST['update'])) {

        $id = $_POST['id_pegawai'];
        $tanggal = $_POST['tanggal'];
        $jam = $_POST['jam_masuk'];
        $pulang = $_POST['jam_pulang'];
        // Validasi tanggal
        $select = mysqli_query($konek, "SELECT * FROM tb_absen WHERE id_pegawai='$id' AND pulang='$pulang'");
        $row = mysqli_num_rows($select);

        if ($row) {
                echo '<script>alert("anda sudah absen untuk hari ini, absen lagi besok!")</script>';
        } else {

                $res =  mysqli_query($koneksi, "UPDATE tb_absen SET id_pegawai='$id', tanggal='$tanggal', jam_masuk='$jam', jam_pulang= '$pulang' WHERE tanggal ='$tanggal' ");
        }
}

?>

<section class="content-header">
        <div class="container-fluid">
                <div class="row mb2">
                        <div class="col-sm-6">
                                <h1>Absen</h1>
                        </div>
                        <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                                        <li class="breadcrumb-item"><a href="?page=pangkatread">Absen</a></li>
                                </ol>
                        </div>
                </div>
        </div>
</section>
<section class="content">
        <div class="card">
                <h3 class="col-sm-10">Silahkan Absen, <?php echo $_SESSION['nm_pegawai'] ?>!</h3>
                <div class="card-body">
                        <form method="POST">
                                <tr>
                                        

                                        <!-- <input type="text" name="id_pegawai" hidden value="<?php echo $_SESSION['id_pegawai'] ?>"> -->
                                        <input type="text" name="tanggal" hidden value="<?= $tanggalSekarang; ?>">
                                        <input type="text" name="jam_masuk" hidden value="<?= $jamSekarang; ?>">
                                        </td>
                                        <td><button type="submit" name="simpan" class="btn btn-success" onclick="return confirm('ingin absen?')">Absen Masuk</button></td>
                                </tr>

                                <tr>
                                        <input type="text" name="id_pegawai" hidden value="<?php echo $_SESSION['id_pegawai'] ?>">
                                        <input type="text" name="tanggal" hidden value="<?= $tanggalSekarang; ?>">
                                        <input type="text" name="jam_pulang" hidden value="<?= $jamSekarang; ?>">
                                        </td>
                                </tr>

                                <tr>
                                        <td><button type="submit" name="update" class="btn btn-success" onclick="return confirm('ingin absen?')">Absen Pulang</button></td>

                                </tr>
                        </form>
                </div>
        </div>

</section>
<?php include_once "partials/scripts.php" ?>