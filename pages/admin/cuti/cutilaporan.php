<?php
include 'database/sql.php';
$dt1 = $_GET['tglawal'];
$dt2 = $_GET['tglakhir'];
$sql = "SELECT * FROM surat_cuti
INNER JOIN pegawai ON pegawai.id_pegawai = surat_cuti.id_pegawai
INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE awal_cuti BETWEEN '$dt1' AND '$dt2'";
$query = mysqli_query($konek, $sql) or die(mysqli_error($konek)); ?>

<section class="content-header">
        <div class="container-fluid">
                <div class="row mb2">
                        <div class="col-sm-6">
                                <h1>Cetak Laporan Surat Cuti</h1>
                        </div>
                        <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                                        <li class="breadcrumb-item"><a href="?page=cutiread">Laporan Surat Cuti</a></li>
                                        <li class="breadcrumb-item active">Cetak Laporan Data</li>
                                </ol>
                        </div>
                </div>
        </div>
</section>
<section class="content">
        <div class="card">
                <div class="row mt-4">
                        <div class="col-md-2">
                                <img src="dist/img/bpjs.png" alt="" width="100%">
                        </div>
                        <div class="col-md-8">
                                <h3 class="font-weight-bold text-center">BPJS KETENAGAKERJAAN</h3>
                                <h3 class="font-weight-bold text-center">BPJS Ketenagakerjaan Cabang Kuala Kapuas</h3>
                                <h3 class="font-weight-bold text-center">Jl.Tambun Bungai ,Selat Tengah,Kec.Selat Kabupaten Kapuas ,Kalimantan Tengah 73516</h3>
                                <p class="text-center">Telp (0513) 2021061 emailbpjsketenagakerjaan@gmail.com<br></p>
                        </div>
                </div>
                <hr style="border:3px solid #000">
                <br>
                <h3 class="font-weight-bold text-center">Laporan Surat Cuti</h3>
                <br>
                <p class="text-center">Laporan Surat Cuti dari tanggal
                        <?php
                        $newDate3 = date("d-m-Y", strtotime($dt1));
                        echo $newDate3;
                        ?> sampai dengan tanggal
                        <?php
                        $newDate3 = date("d-m-Y", strtotime($dt2));
                        echo $newDate3;
                        ?></p>

                <table class="table table-bordered ">
                        <tbody>
                                <tr>
                                        <th>No</th>
                                        <th>Nip</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Keterangan</th>
                                        <th>Mulai</th>
                                        <th>Akhir</th>
                                </tr>
                                <?php
                                $no = 1;
                                while ($data = mysqli_fetch_assoc($query)) {
                                ?>
                                        <tr>
                                                <?php
                                                if ($data["status1"] == "Pending") :
                                                ?>
                                                <?php
                                                elseif ($data["status1"] == "Ditolak") :
                                                ?>
                                                <?php
                                                elseif ($data["status1"] == "Disetujui") :
                                                ?>

                                                        <td><?php echo $no; ?></td>
                                                        <td><?php echo $data['nip']; ?></td>
                                                        <td><?php echo $data['nm_pegawai']; ?></td>
                                                        <td><?php echo $data['nm_jabatan']; ?></td>
                                                        <td><?php echo $data['keterangan']; ?></td>
                                                        <td><?php echo $data['awal_cuti']; ?></td>
                                                        <td><?php echo $data['akhir_cuti']; ?></td>

                                        </tr>
                                        <?php $no++; ?>
                                <?php endif; ?>
                        <?php } ?>

                </table>
                <div class="row mb-4">
                        <div class="col-md-6">
                                <div class="text-muted"></div>
                                <strong></strong>
                                <?php
                                $sql = mysqli_query($konek, "SELECT * FROM surat_cuti
                                INNER JOIN pegawai ON pegawai.id_pegawai = surat_cuti.id_pegawai
                                INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE awal_cuti BETWEEN '$dt1' AND '$dt2'");
                                $row1 = mysqli_num_rows($sql);
                                ?>
                                <p>Keterangan :</p>
                                <p>Jumlah Surat Perintah Tugas : <?php echo $row1; ?></p>
                        </div>
                        <?php
                        $sqlkb = mysqli_query($konek, "SELECT * FROM jabatan  LEFT JOIN pegawai ON pegawai.id_jabatan = jabatan.id_jabatan
                            WHERE pegawai.id_jabatan = 1");
                        while ($data = mysqli_fetch_array($sqlkb)) { ?>

                                <div class="col-md-6 text-md-right">
                                        <div class="text-muted"> <br></div>
                                        <h6 class="text-center">Kepala Cabang Kantor Cabang Tanjung
                                                <br>
                                                <br>

                                                <br>
                                                <br>
                                                <ins><?php echo $data['nm_pegawai']; ?></ins>
                                                <br>
                                                NIP: <?php echo $data['nip']; ?>

                                        </h6>
                                <?php } ?>
                                </p>
                                </div>
                </div>

        </div>
</section>
<script>
        window.print();
</script>