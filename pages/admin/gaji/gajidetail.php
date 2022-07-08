<?php include_once "partials/cssdatatables.php"?>
<?php include "database/sql.php";
$gaji = new stdClass;
if ($result = $mysqli->query("SELECT * FROM gaji INNER JOIN pegawai ON gaji.id_pegawai = pegawai.id_pegawai WHERE id='$_GET[id]'")) {
    $obj = $result->fetch_object();
    $obj->gaji_total = $obj->gaji_pokok + $obj->gaji_bonus + $obj->gaji_lembur;
    $obj->gaji_kurang = $obj->bpjs_kesehatan + $obj->bpjs_tenaker + $obj->pinjaman + $obj->biaya_transfer;
    $obj->gaji_bersih = $obj->gaji_total - $obj->gaji_kurang;
    $obj->jk = $obj->jk == 'L' ? 'Laki-Laki' : 'Perempuan';
    $gaji = $obj;
    $result->free_result();
}
var_dump($gaji);
$mysqli->close();
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Detail Gaji</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="?page=home"> Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="?page=gaji"> Gaji</a>
                    </li>
                    <li class="breadcrumb-item"> Gaji Detail</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Detail Gaji <?=$gaji->nm_pegawai?></h3>
            <a href="?page=gajicreate" class="btn btn-success btn-sm float-right">
                <i class="fa fa-print"></i> Print</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col text-end">
                    <p>Slip Gaji <?=date('F Y')?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Nama</th>
                                <td>: <?=$gaji->nm_pegawai?></td>
                            </tr>
                            <tr>
                                <th>NIP</th>
                                <td>: <?=$gaji->nip?></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>: <?=$gaji->jk?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>: </td>
                            </tr>
                            <tr>
                                <th>Jabatan</th>
                                <td>: Pegawai</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-6">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Nomor Urut</th>
                                <td>: <?=$gaji->id?></td>
                            </tr>
                            <tr>
                                <th>Nomor Rekening</th>
                                <td>: <?=$gaji->rekening_no?></td>
                            </tr>
                            <tr>
                                <th>Rekening Bank</th>
                                <td>: <?=$gaji->rekening_bank?></td>
                            </tr>
                            <tr>
                                <th>Jumlah Kehadiran</th>
                                <td>: <?=$gaji->kehadiran?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="card-title"> Penerima</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>Nama</th>
                                        <td>: <?=$gaji->nm_pegawai?></td>
                                    </tr>
                                    <tr>
                                        <th>Tunjangan Jabatan</th>
                                        <td>: -</td>
                                    </tr>
                                    <tr>
                                        <th>Gaji Pokok</th>
                                        <td>: <?="Rp. " . number_format($gaji->gaji_pokok)?></td>
                                    </tr>
                                    <tr>
                                        <th>Uang Makan / Transport</th>
                                        <td>: <?="Rp. " . number_format($gaji->gaji_bonus)?></td>
                                    </tr>
                                    <tr>
                                        <th>Uang Lembur</th>
                                        <td>: <?="Rp. " . number_format($gaji->gaji_lembur)?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td>: <?="Rp. " . number_format($gaji->gaji_total)?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title"> Potongan</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>BPJS Kesehatan</th>
                                        <td>: <?="Rp. " . number_format($gaji->bpjs_kesehatan)?></td>
                                    </tr>
                                    <tr>
                                        <th>BPJS Ketenagakerjaan</th>
                                        <td>: <?="Rp. " . number_format($gaji->bpjs_tenaker)?></td>
                                    </tr>
                                    <tr>
                                        <th>Pinjaman</th>
                                        <td>: <?="Rp. " . number_format($gaji->pinjaman)?></td>
                                    </tr>
                                    <tr>
                                        <th>Biaya Transfer</th>
                                        <td>: <?="Rp. " . number_format($gaji->biaya_transfer)?></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td colspan="2">-</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td colspan="2">
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td>: <?="Rp. " . number_format($gaji->gaji_kurang)?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="alert alert-success text-center" role="alert">
                        Gaji Bersih : <strong><?="Rp. " . number_format($gaji->gaji_bersih)?></strong>
                    </div>
                </div>
            </div>
            .row.mt-4
        </div>
    </div>
</div>
<?php include_once "partials/scripts.php"?>
<?php include_once "partials/scripstdatatables.php"?>