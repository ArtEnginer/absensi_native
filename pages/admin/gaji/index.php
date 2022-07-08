<?php include_once "partials/cssdatatables.php"?>
<?php include "database/sql.php";
$gaji = [];
if ($result = $mysqli->query("SELECT * FROM gaji INNER JOIN pegawai ON gaji.id_pegawai = pegawai.id_pegawai")) {
    while ($obj = $result->fetch_object()) {
        $obj->gaji_total = $obj->gaji_pokok + $obj->gaji_bonus + $obj->gaji_lembur;
        $obj->gaji_kurang = $obj->bpjs_kesehatan + $obj->bpjs_tenaker + $obj->pinjaman + $obj->biaya_transfer;
        $obj->gaji_bersih = $obj->gaji_total - $obj->gaji_kurang;
        $gaji[] = $obj;
    }
    $result->free_result();
}

$mysqli->close();
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
        <?php } else {?>
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
                <h1 class="m-0"> Gaji</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="?page=home"> Home</a>
                    </li>
                    <li class="breadcrumb-item"> Gaji</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Data Gaji</h3>
            <a href="?page=gajicreate" class="btn btn-success btn-sm float-right">
                <i class="fa fa-plus-circle"></i> Tambah</a>
        </div>
        <div class="card-body">
            <table id="mytable" class="table table-bordered table-hover">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Gaji Bersih</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$no = 1;
foreach ($gaji as $gj): ?>
                    <tr class="text-center">
                        <td><?=$no++?></td>
                        <td><?=$gj->tanggal?></td>
                        <td><?=$gj->nm_pegawai?></td>
                        <td><?="Rp. " . number_format($gj->gaji_bersih)?>
                        </td>
                        <td>
                            <a href="?page=gajidetail&id=<?=$gj->id?>" class="btn btn-primary btn-sm mr-1">
                                <i class="fa fa-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include_once "partials/scripts.php"?>
<?php include_once "partials/scripstdatatables.php"?>
<script>
$(function() {
    $('#mytable').DataTable()
});
</script>