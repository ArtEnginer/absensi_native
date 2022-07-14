<?php include_once "partials/cssdatatables.php" ?>
<div class="content-header">
        <div class="container-fluid">
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
                        <h3 class="card-title"><i class="fas fa-fw fa-print"></i> Pilih Tanggal Peringtan</h3>
                </div>
                <form action="" method="post">
                        <div class="card-body">
                                <div class="row mb-3">
                                        <div class="col md-6">
                                                <label for="" class="col-form-label font-weight-bold">Tanggal Awal</label>
                                                <div class="input-group">
                                                        <input type="date" name="tglawal" class="form-control" required />
                                                </div>
                                        </div>
                                        <div class="col md-6">
                                                <label for="" class="col-form-label font-weight-bold">Tanggal Akhir</label>
                                                <div class="input-group">
                                                        <input type="date" name="tglakhir" class="form-control" required />
                                                </div>
                                        </div>
                                </div>
                                <div class="card-footer text-right">
                                        <button name="tampilkan" class="btn btn-primary" type="submit"><i class="fas fa-fw fa-check mr-1"></i> Pilih Tanggal</button>
                                </div>
                        </div>
                </form>

                <?php
                include 'database/sql.php';

                if (isset($_POST["tampilkan"])) {
                        $dt1 = $_POST["tglawal"];
                        $dt2 = $_POST["tglakhir"];

                        $no = 1;

                        $sql = "SELECT * FROM tb_peringatan
                        INNER JOIN pegawai ON pegawai.id_pegawai = tb_peringatan.id_pegawai WHERE tgl_surat BETWEEN '$dt1' AND '$dt2'";
                        $query = mysqli_query($konek, $sql) or die(mysqli_error($konek)); ?>
                        <div class="card-header card-header py-3">
                                <h6 class="m-0 font-weight-bold text-dark"><i class="fa fa-table"></i> Data Laporan kegiatan <?= $dt1 ?> s/d <?= $dt2 ?></h6>
                        </div>
                        <div class="card-header card-header py-3">

                                <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                                <tr class="text-center">
                                                        <th>No</th>
                                                        <th>Nomor</th>
                                                        <th>Nama Pegawai</th>
                                                        <th>Tanggal Lahir </th>
                                                        <th>Kelamin</th>
                                                        <th>Alamat</th>
                                                        <th>Telpon</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                                <?php

                                                while ($row = mysqli_fetch_array($query)) { ?>

                                                        <tr>
                                                                <td><?php echo $no++ ?></td>
                                                                <td><?php echo $row['no_surat'] ?></td>
                                                                <td><?php echo $row['tgl_surat'] ?></td>
                                                                <td><?php echo $row['nm_pegawai'] ?></td>
                                                                <td><?php echo $row['jk'] ?></td>
                                                                <td><?php echo $row['alamat'] ?></td>
                                                                <td><?php echo $row['no_hp'] ?></td>
                                                        </tr>

                                                        <?php $no++; ?>
                                                        </tr>

                                                <?php }
                                                ?>

                                        </tbody>


                                </table>
                                <div class="card-footer text-right">
                                        <a class="btn btn-primary" href="?page=plaporan&tglawal=<?= $dt1 ?>&tglakhir=<?= $dt2 ?>"><i class="fas fa-fw fa-print mr-1"></i> Cetak Laporan</a>
                                </div>
                        </div>
                <?php } ?>
        </div>
</div>
<?php include_once "partials/scripts.php" ?>
<?php include_once "partials/scripstdatatables.php" ?>
<script>
        $(function() {
                $('#mytable').DataTable()
        });
</script>