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
                                <h1 class="m-0">Peringatan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item">
                                                <a href="?page=home"> Home</a>
                                        </li>
                                        <li class="breadcrumb-item">Peringatan</li>
                                </ol>
                        </div><!-- /.col -->
                </div><!-- /.row -->
        </div><!-- /.container-fluid -->
</div>
<div class="content">
        <div class="card">
                <div class="card-header">
                        <h3 class="card-title">Data Peringatan</h3>
                        <a href="?page=pcreate" class="btn btn-success btn-sm float-right">
                                <i class="fa fa-plus-circle"></i> Tambah Data</a>
                        <a href="?page=pview" class="btn btn-primary btn-sm float-right mr-2">
                                <i class="fa fa-print"></i> Cetak Laporan</a>
                </div>

                <div class="card-body">
                        <table id="mytable" class="table table-bordered table-hover">
                                <thead>
                                        <tr class="text-center">
                                                <th>No</th>
                                                <th>Nomor</th>
                                                <th>Nama Pegawai</th>
                                                <th>Tanggal Lahir </th>
                                                <th>Kelamin</th>
                                                <th>Alamat</th>
                                                <th>Telpon</th>
                                                <th>Tindakan</th>
                                        </tr>
                                </thead>
                                <tfoot>
                                        <tr class="text-center">
                                                <th>No</th>
                                                <th>Nomor</th>
                                                <th>Nama Pegawai</th>
                                                <th>Tanggal Lahir </th>
                                                <th>Kelamin</th>
                                                <th>Alamat</th>
                                                <th>Telpon</th>
                                                <th>Tindakan</th>
                                        </tr>
                                </tfoot>
                                <tbody>
                                        <?php
                                        $database = new Database();
                                        $db = $database->getConnection();
                                        $selectSql = "SELECT * FROM tb_peringatan
                                        INNER JOIN pegawai ON pegawai.id_pegawai = tb_peringatan.id_pegawai ";
                                        $stmt = $db->prepare($selectSql);
                                        $stmt->execute();
                                        $no = 1;
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                                <tr class="text-center">
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $row['no_surat'] ?></td>
                                                        <td><?php echo $row['tgl_surat'] ?></td>
                                                        <td><?php echo $row['nm_pegawai'] ?></td>
                                                        <td><?php echo $row['jk'] ?></td>
                                                        <td><?php echo $row['alamat'] ?></td>
                                                        <td><?php echo $row['no_hp'] ?></td>

                                                        <td>
                                                                <a href="?page=pdetail&id_sp=<?php echo $row['id_sp'] ?>" class="btn btn-primary btn-sm mr-1">
                                                                        <i class="fa fa-eye" title="Detail"></i>
                                                                </a>
                                                                <a href="?page=pcetak&id_sp=<?php echo $row['id_sp'] ?>" class="btn btn-primary btn-sm mr-1">
                                                                        <i class="fa fa-print" title="Cetak"></i>
                                                                </a>
                                                                <a href="?page=pupdate&id_sp=<?php echo $row['id_sp'] ?>" class="btn btn-primary btn-sm mr-1">
                                                                        <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a href="?page=kdelete&id_sp=<?php echo $row['id_sp'] ?>" class="btn btn-danger btn-sm" onClick="javascript: return confirm('Konfirmasi data akan dihapus?');">
                                                                        <i class="fa fa-trash"></i>
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