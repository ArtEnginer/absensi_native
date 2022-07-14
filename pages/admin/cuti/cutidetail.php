<?php include_once "partials/cssdatatables.php" ?>
<div class="content-header">
        <div class="container-fluid">

                <div class="row mb-2">
                        <div class="col-sm-6">
                                <h1 class="m-0">Detail Surat Cuti</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item">
                                                <a href="?page=home"> Home</a>
                                        </li>
                                        <li class="breadcrumb-item"> Detail Surat Cuti</li>
                                </ol>
                        </div><!-- /.col -->
                </div><!-- /.row -->
        </div><!-- /.container-fluid -->
</div>
<?php
include 'database/sql.php';

$id = $_GET['id_cuti'];
$join = mysqli_query($konek, "SELECT * FROM surat_cuti
INNER JOIN pegawai ON pegawai.id_pegawai = surat_cuti.id_pegawai
INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan
WHERE id_cuti = $id");

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
                                                        <td width='120px'>Alamat</td>
                                                        <td width='20px'>:</td>
                                                        <td><?php echo $row['alamat']; ?></td>
                                                </tr>
                                                <tr>
                                                        <td width='120px'>Awal Cuti</td>
                                                        <td width='20px'>:</td>
                                                        <td><?php echo $row['awal_cuti']; ?></td>
                                                </tr>
                                                <tr>
                                                        <td width='120px'>Akhir Cuti</td>
                                                        <td width='20px'>:</td>
                                                        <td><?php echo $row['akhir_cuti']; ?></td>
                                                </tr>
                                                <tr>
                                                        <td width='120px'>Keterangan</td>
                                                        <td width='20px'>:</td>
                                                        <td><?php echo $row['keterangan']; ?></td>
                                                </tr>
                                                <tr>
                                                        <td width='120px'>File</td>
                                                        <td width='20px'>:</td>
                                                        <td><?php echo $row['file']; ?> <a href="pages/admin/cuti/upload/<?php echo $row['file'] ?>" class="btn btn-primary btn-sm mr-1">
                                                                        <i class="fa fa-download" title="Unduh"></i>
                                                                </a> </td>
                                                </tr>
                                                <tr>
                                                        <td width='120px'>Status</td>
                                                        <td width='20px'>:</td>
                                                        <td><?php echo $row['status1']; ?></td>

                                                </tr>
                                                <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td><a href="?page=cutiread" class="btn btn-primary btn-sm">
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