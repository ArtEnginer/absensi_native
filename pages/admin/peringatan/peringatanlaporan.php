<?php
include 'database/sql.php';
$dt1 = $_GET['tglawal'];
$dt2 = $_GET['tglakhir'];
$sql = "SELECT * FROM tb_peringatan
INNER JOIN pegawai ON pegawai.id_pegawai = tb_peringatan.id_pegawai WHERE tgl_surat BETWEEN '$dt1' AND '$dt2'";
$query = mysqli_query($konek, $sql) or die(mysqli_error($konek)); ?>

<section class="content-header">
        <div class="container-fluid">
                <div class="row mb2">
                        <div class="col-sm-6">
                                <h1>Cetak Laporan Peringatan</h1>
                        </div>
                        <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                                        <li class="breadcrumb-item"><a href="?page=pread">Laporan peringatan</a></li>
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
                <h3 class="font-weight-bold text-center">Laporan Peringatan</h3>
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
                                        <th>Nomor</th>
                                        <th>Nama Pegawai</th>
                                        <th>Tanggal Lahir </th>
                                        <th>Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Telpon</th>

                                </tr>
                                <?php
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($query)) {
                                ?>
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

                                <?php } ?>

                </table>
                <div class="row mb-4">
                        <div class="col-md-6">
                                <div class="text-muted"></div>
                                <strong></strong>
                                <?php
                                $sql = mysqli_query($konek, "SELECT * FROM tb_peringatan
                                INNER JOIN pegawai ON pegawai.id_pegawai = tb_peringatan.id_pegawai WHERE tgl_surat BETWEEN '$dt1' AND '$dt2'");
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
                                        <h6 class="text-center">Kepala Cabang Kantor Cabang Kuala Kapuas
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