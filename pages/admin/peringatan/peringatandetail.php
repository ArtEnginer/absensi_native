<?php include_once "partials/cssdatatables.php" ?>
<div class="content-header">
        <div class="container-fluid">

                <div class="row mb-2">
                        <div class="col-sm-6">
                                <h1 class="m-0">Detail Kegaiatan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item">
                                                <a href="?page=home"> Home</a>
                                        </li>
                                        <li class="breadcrumb-item"> Detail Kegaiatan/li>
                                </ol>
                        </div><!-- /.col -->
                </div><!-- /.row -->
        </div><!-- /.container-fluid -->
</div>
<?php
include 'database/sql.php';

$id = $_GET['id_kegiatan'];
$join = mysqli_query($konek, "SELECT * FROM kegiatan
INNER JOIN pegawai ON pegawai.id_pegawai = kegiatan.id_pegawai
INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan
WHERE id_kegiatan = $id");

while ($row = mysqli_fetch_array($join)) {
?>
        <div class="content">
                <div class="card">
                        <div class="card-body">
                                <table>
                                        <tbody>
                                                <tr>
                                                        <td width='120px'>Nama</td>
                                                        <td width='20px'>:</td>
                                                        <td><?php echo $row['nm_pegawai']; ?></td>
                                                </tr>
                                                <tr>
                                                        <td width='120px'>Nomor</td>
                                                        <td width='20px'>:</td>
                                                        <td><?php echo $row['nomor']; ?></td>
                                                </tr>
                                                <tr>
                                                        <td width='120px'>Sumber Dana</td>
                                                        <td width='20px'>:</td>
                                                        <td><?php echo $row['dana']; ?></td>
                                                </tr>
                                                <tr>
                                                        <td width='120px'>Akhir Cuti</td>
                                                        <td width='20px'>:</td>
                                                        <td><?php echo $row['nm_pegawai']; ?></td>
                                                </tr>
                                                <tr>
                                                        <td width='120px'>jabatan</td>
                                                        <td width='20px'>:</td>
                                                        <td><?php echo $row['nm_jabatan']; ?></td>
                                                </tr>
                                                <tr>
                                                        <td width='120px'>Lokasi</td>
                                                        <td width='20px'>:</td>
                                                        <td><?php echo $row['lokasi']; ?></td>

                                                </tr>
                                                <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td><a href="?page=kread" class="btn btn-primary btn-sm">
                                                                        <i class="fa fa-times"></i> Kembali
                                                                </a></td>
                                                </tr>

                                        </tbody>
                                </table>
                        </div>
                </div>
        </div>
<?php } ?>
<?php include_once "partials/scripts.php" ?>
<?php include_once "partials/scripstdatatables.php" ?>
<script>
        $(function() {
                $('#mytable').DataTable()
        });
</script>