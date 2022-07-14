<?php include_once "partials/cssdatatables.php" ?>
<?php include "database/sql.php";

$id = $_GET['id'];

$query = $mysqli->query("SELECT * FROM tb_pindahtugas JOIN pegawai ON tb_pindahtugas.id_pegawai = pegawai.id_pegawai WHERE id_pindah = $id");
$data = $query->fetch_array();

$jabatan = $mysqli->query("SELECT * FROM jabatan where id_jabatan = $data[id_jabatan]");
$jabatan = $jabatan->fetch_array();

?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Detail Pindah Tugas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="?page=home"> Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="?page=ptugas"> Pindah Tugas</a>
                    </li>
                    <li class="breadcrumb-item"> Pindah Tugas Detail</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Detail Gaji</h3>
            <a href="#!" class="btn btn-success btn-sm float-right mx-2" onclick="printDiv('suratpindah')">
                <i class="fa fa-print"></i> Print</a>
            <a href="?page=ptugas" class="btn btn-danger btn-sm float-right mx-2">
                <i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card-body" id="suratpindah">
            <div class="container">

                <div class="row">
                    <div class="col-6">
                        <h6>
                            <strong>
                                Perihal : Surat Pindah Tugas
                            </strong>
                        </h6>
                    </div>
                    <div class="col-6" style="line-height: 7px;">
                        <p>
                            <strong>
                                Jakarta, <?= date('d F Y') ?>
                            </strong>
                        </p>
                        <p>
                            Kepada Yth,
                        </p>
                        <p>
                            Bapak Kepala Dinas Kesehatan Kota Jakarta,
                        </p>
                        <p>
                            <strong>
                                Kepala Bidang Kesehatan
                            </strong>
                        </p>
                        <p>di</p>
                        <p>
                            <strong>
                                Kota Jakarta
                            </strong>
                        </p>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h6>Dengan Hormat,</h6>
                        <div class="ml-4">
                            Yang bertandatangan di bawah ini: <br>
                            <table>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td><?= $data['nm_pegawai'] ?></td>
                                </tr>
                                <tr>
                                    <td>NIP</td>
                                    <td>:</td>
                                    <td><?= $data['nip'] ?> </td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>:</td>
                                    <td><?= $jabatan['nm_jabatan'] ?></td>
                                </tr>

                            </table>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <p>Melalui Surat ini saya bermaksud mengajukan permohonan pindah pekerjaan pada kantor Kesehatan Kota Jakarta, adapun alasan saya pindah dikarenakan
                            <strong>
                                <?= $data['alasan'] ?>
                            </strong>
                        </p>

                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <p>
                            <strong>
                                Demikian surat pindah tugas ini saya ajukan, atas perhatiannya saya ucapkan terimakasih.
                            </strong>
                        </p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-8"></div>
                    <div class="col-4 ">
                        <h5>Hormat Saya,</h5>
                        <div class="" style="line-height: 5px; margin-top:100px;">
                            <p>
                                <strong>
                                    <?= $data['nm_pegawai'] ?>
                                </strong>
                            </p>
                            <hr>
                            <p>
                                <strong>
                                    NIP. <?= $data['nip'] ?>
                                </strong>
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<?php include_once "partials/scripts.php" ?>
<?php include_once "partials/scripstdatatables.php" ?>