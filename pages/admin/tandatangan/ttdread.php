<?php include_once "partials/cssdatatables.php" ?>
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
                                <h1 class="m-0"> Tanda Tangan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item">
                                                <a href="?page=home"> Home</a>
                                        </li>
                                        <li class="breadcrumb-item"> Tanda Tangan</li>
                                </ol>
                        </div><!-- /.col -->
                </div><!-- /.row -->
        </div><!-- /.container-fluid -->
</div>
<div class="content">
        <div class="card">
                <div class="card-header">
                        <h3 class="card-title"> Data Tanda Tangan</h3>
                        <a href="?page=ttdcreate" class="btn btn-success btn-sm float-right">
                                <i class="fa fa-plus-circle"></i> Tambah Data</a>
                </div>
                <div class="card-body">
                        <table id="mytable" class="table table-bordered table-hover">
                                <thead>
                                        <tr class="text-center">
                                                <th>No</th>
                                                <th>Nip</th>
                                                <th>Nama Pegawai</th>
                                                <th>File</th>
                                                <th>Tindakan</th>
                                        </tr>
                                </thead>
                                <tfoot>
                                        <tr class="text-center">
                                                <th>No</th>
                                                <th>Nip</th>
                                                <th>Nama Pegawai</th>
                                                <th>File</th>
                                                <th>Tindakan</th>
                                        </tr>
                                </tfoot>
                                <tbody>
                                        <?php
                                        $database = new Database();
                                        $db = $database->getConnection();

                                        $selectSql = "SELECT * FROM tanda_tangan
                                        INNER JOIN pegawai ON tanda_tangan.id = pegawai.id ";
                                        $stmt = $db->prepare($selectSql);
                                        $stmt->execute();
                                        $no = 1;
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                                <tr class="text-center">
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $row['nip'] ?></td>
                                                        <td><?php echo $row['nm_pegawai'] ?></td>
                                                        <td><?php echo $row['barcode'] ?></td>
                                                        <td>
                                                                <a href="?page=ttdupdate&id_ttd=<?php echo $row['id_ttd'] ?>" class="btn btn-primary btn-sm mr-1">
                                                                        <i class="fa fa-edit"></i> Ubah
                                                                </a>
                                                                <a href="?page=ttddelete&id_ttd=<?php echo $row['id_ttd'] ?>" class="btn btn-danger btn-sm" onClick="javascript: return confirm('Konfirmasi data akan dihapus?');">
                                                                        <i class="fa fa-trash"></i> Hapus
                                                                </a>
                                                        </td>
                                                </tr>
                                        <?php
                                        }
                                        ?>
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