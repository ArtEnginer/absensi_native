<?php
include_once "partials/cssdatatables.php";
include 'database/sql.php';

$query = $mysqli->query("SELECT * FROM tb_pindahtugas JOIN pegawai ON tb_pindahtugas.id_pegawai = pegawai.id_pegawai");
// $data = $query->fetch_array();





?>
<div class="content-header">
    <div class="container-fluid">
        <?php
        if (isset($_SESSION["hasil"])) {
            if ($_SESSION["hasil"]) {
        ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                    <?php echo $_SESSION['pesan'] ?>
                </div>
            <?php } else { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h5><i class="icon fas fa-ban"></i> Gagal</h5>
                    <?php echo $_SESSION['pesan'] ?>
                </div>

        <?php
            }
            unset($_SESSION['hasil']);
            unset($_SESSION['pesan']);
        }
        ?>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pindah Tugas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="?page=home"> Home</a>
                    </li>
                    <li class="breadcrumb-item">Pindah Tugas</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Pindah Tugas</h3>
            <a href="?page=ptugascreate" class="btn btn-success btn-sm float-right">
                <i class="fa fa-plus-circle"></i> Tambah Data</a>

        </div>

        <div class="card-body">
            <table id="mytable" class="table table-bordered table-hover">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nomor</th>
                        <th>Nama Pegawai</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nomor</th>
                        <th>Nama Pegawai</th>
                        <th>Tindakan</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = $query->fetch_array()) {
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $no++ ?></td>
                            <td><?php echo $row['tanggal'] ?></td>
                            <td><?php echo $row['no_surat'] ?></td>
                            <td><?php echo $row['nm_pegawai'] ?></td>
                            <td class="text-center">
                                <a href="?page=ptugasdetail&id=<?php echo $row['id_pindah'] ?>" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="?page=ptugasupdate&id=<?php echo $row['id_pindah'] ?>" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="?page=ptugasdelete&id=<?php echo $row['id_pindah'] ?>" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include_once "partials/scripts.php" ?>
<?php include_once "partials/scripstdatatables.php" ?>
<script>
    $(function() {
        $('#mytable').DataTable()
    });
</script>