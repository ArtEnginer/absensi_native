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
                                <h1 class="m-0"> Surat Cuti</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item">
                                                <a href="?page=home"> Home</a>
                                        </li>
                                        <li class="breadcrumb-item"> Surat Cuti</li>
                                </ol>
                        </div><!-- /.col -->
                </div><!-- /.row -->
        </div><!-- /.container-fluid -->
</div>
<div class="content">
        <div class="card">
                <div class="card-header">
                        <h3 class="card-title">Data Surat Cuti</h3>
                        <a href="?page=tambahcuti" class="btn btn-success btn-sm float-right">
                                <i class="fa fa-plus-circle"></i> Tambah Data</a>
                        <a href="?page=cutiview" class="btn btn-primary btn-sm float-right mr-2">
                                <i class="fa fa-print"></i> Cetak Laporan</a>
                </div>
                <div class="card-body">
                        <table id="mytable" class="table table-bordered table-hover">
                                <thead>
                                        <tr class="text-center">
                                                <th>No</th>
                                                <th>Nip</th>
                                                <th>Nama</th>
                                                <th>Ket</th>
                                                <th>File</th>

                                                <th>Status</th>

                                                <th>Tindakan</th>
                                        </tr>
                                </thead>
                                <tfoot>
                                        <tr class="text-center">
                                                <th>No</th>
                                                <th>Nip</th>
                                                <th>Nama</th>
                                                <th>Ket</th>
                                                <th>File</th>

                                                <th>Status</th>

                                                <th>Tindakan</th>
                                        </tr>
                                </tfoot>
                                <tbody>
                                        <?php
                                        $database = new Database();
                                        $db = $database->getConnection();
                                        $selectSql = "SELECT * FROM surat_cuti
                                        INNER JOIN pegawai ON pegawai.id_pegawai = surat_cuti.id_pegawai
                                        INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan";
                                        $stmt = $db->prepare($selectSql);
                                        $stmt->execute();
                                        $no = 1;
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                                <tr class="text-center">
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $row['nip'] ?></td>
                                                        <td><?php echo $row['nm_pegawai'] ?></td>
                                                        <td><?php echo $row['keterangan'] ?></td>
                                                        <td><?php echo $row['file'] ?> <a href="pages/admin/cuti/upload/<?php echo $row['file'] ?>" class="btn btn-primary btn-sm mr-1">
                                                                        <i class="fa fa-download" title="Unduh"></i>
                                                                </a> </td>

                                                        <?php if ($row['status1'] == "Pending") : ?>
                                                                <td><a href="?page=cutiapprove&id_cuti=<?php echo $row['id_cuti'] ?>" class="btn btn-primary btn-sm mr-1"> <?php echo $row['status1'] ?></a>
                                                                </td>
                                                        <?php elseif ($row['status1'] == "Disetujui") : ?>
                                                                <td><a href="?page=cutiapprove&id_cuti=<?php echo $row['id_cuti'] ?>" class="btn btn-success btn-sm mr-1"> <?php echo $row['status1'] ?></a>
                                                                </td>
                                                        <?php elseif ($row['status1'] == "Ditolak") : ?>
                                                                <td><a href="?page=cutiapprove&id_cuti=<?php echo $row['id_cuti'] ?>" class="btn btn-danger btn-sm mr-1"> <?php echo $row['status1'] ?></a>
                                                                </td>
                                                        <?php endif; ?>
                                                        <td>
                                                                <a href="?page=cutidetail&id_cuti=<?php echo $row['id_cuti'] ?>" class="btn btn-primary btn-sm mr-1">
                                                                        <i class="fa fa-eye" title="Detail"></i>
                                                                </a>
                                                                <?php
                                                                if ($row["status1"] == "Pending") :
                                                                ?>

                                                                <?php
                                                                elseif ($row["status1"] == "Disetujui") :
                                                                ?>
                                                                        <a href="?page=kecetak&id_cuti=<?php echo $row['id_cuti'] ?>" class="btn btn-primary btn-sm mr-1">
                                                                                <i class="fa fa-print" title="Cetak"></i>
                                                                        </a>
                                                                <?php endif; ?>
                                                                <a href="?page=cutiupdate&id_cuti=<?php echo $row['id_cuti'] ?>" class="btn btn-primary btn-sm mr-1">
                                                                        <i class="fa fa-edit" title="Edit"></i>
                                                                </a>
                                                                <a href="?page=cutidelete&id_cuti=<?php echo $row['id_cuti'] ?>" class="btn btn-danger btn-sm" onClick="javascript: return confirm('Konfirmasi data akan dihapus?');">
                                                                        <i class="fa fa-trash" title="Hapus"></i>
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