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
                                <h1 class="m-0">Kegiatan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item">
                                                <a href="?page=home"> Home</a>
                                        </li>
                                        <li class="breadcrumb-item">Kegiatan</li>
                                </ol>
                        </div><!-- /.col -->
                </div><!-- /.row -->
        </div><!-- /.container-fluid -->
</div>
<div class="content">
        <div class="card">
                <div class="card-header">
                        <h3 class="card-title">Data Kegiatan</h3>
                        <a href="?page=kcreate" class="btn btn-success btn-sm float-right">
                                <i class="fa fa-plus-circle"></i> Tambah Data</a>
                        <a href="?page=kgview" class="btn btn-primary btn-sm float-right mr-2">
                                <i class="fa fa-print"></i> Cetak Laporan</a>
                </div>

                <div class="card-body">
                        <table id="mytable" class="table table-bordered table-hover">
                                <thead>
                                        <tr class="text-center">
                                                <th>No</th>
                                                <th>Nomor</th>
                                                <th>Judul Kegiatan</th>
                                                <th>Nama Pegawai</th>
                                                <th>Jabatan</th>
                                                <th>Lokasi</th>
                                                <th>Waktu</th>
                                                <th>Sumber Dana</th>
                                                <th>Tindakan</th>
                                        </tr>
                                </thead>
                                <tfoot>
                                        <tr class="text-center">
                                                <th>No</th>
                                                <th>Nomor</th>
                                                <th>Judul Kegiatan</th>
                                                <th>Nama Pegawai</th>
                                                <th>Jabatan</th>
                                                <th>Lokasi</th>
                                                <th>Waktu</th>
                                                <th>Sumber Dana</th>
                                                <th>Tindakan</th>
                                        </tr>
                                </tfoot>
                                <tbody>
                                        <?php
                                        $database = new Database();
                                        $db = $database->getConnection();
                                        $selectSql = "SELECT * FROM kegiatan
                                        INNER JOIN pegawai ON pegawai.id_pegawai = kegiatan.id_pegawai
                                        INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan";
                                        $stmt = $db->prepare($selectSql);
                                        $stmt->execute();
                                        $no = 1;
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                                <tr class="text-center">
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $row['nomor'] ?></td>
                                                        <td><?php echo $row['judul'] ?></td>
                                                        <td><?php echo $row['nm_pegawai'] ?></td>
                                                        <td><?php echo $row['nm_jabatan'] ?></td>
                                                        <td><?php echo $row['lokasi'] ?></td>
                                                        <td><?php echo $row['waktu'] ?></td>
                                                        <td><?php echo $row['dana'] ?></td>
                                                        <td>
                                                                <a href="?page=kgcetak&id_kegiatan=<?php echo $row['id_kegiatan'] ?>" class="btn btn-primary btn-sm mr-1">
                                                                        <i class="fa fa-print" title="Cetak"></i>
                                                                </a>
                                                                <a href="?page=kgpdate&id_kegiatan=<?php echo $row['id_kegiatan'] ?>" class="btn btn-primary btn-sm mr-1">
                                                                        <i class="fa fa-edit"></i> Ubah
                                                                </a>
                                                                <a href="?page=kgelete&id_kegiatan=<?php echo $row['id_kegiatan'] ?>" class="btn btn-danger btn-sm" onClick="javascript: return confirm('Konfirmasi data akan dihapus?');">
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