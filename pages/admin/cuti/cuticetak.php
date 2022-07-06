<section class="content-header">
        <div class="container-fluid">
                <div class="row mb2">
                        <div class="col-sm-6">
                                <h1>Cetak Data Surat Cuti</h1>
                        </div>
                        <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                                        <li class="breadcrumb-item"><a href="?page=pangkatread">Surat Cuti</a></li>
                                        <li class="breadcrumb-item active">Cetak Data</li>
                                </ol>
                        </div>
                </div>
        </div>
</section>
<section class="content">
        <div class="card">
                <div class="card-body">
                        <div class="row mt-4">
                                <div class="col-md-2">
                                        <img src="dist/img/bpjs.png" alt="" width="100%">
                                </div>
                                <div class="col-md-8">
                                        <h3 class="font-weight-bold text-center">BPJS KETENAGAKERJAAN </h3>
                                        <h5 class="font-weight-bold text-center">BPJS Ketenagakerjaan Cabang Kuala Kapuas</h5>
                                        <h10 class="font-weight-bold text-center">Jl.Tambun Bungai ,Selat Tengah,Kec.Selat Kabupaten Kapuas ,Kalimantan Tengah 73516</h10>
                                        <p class="text-center">Telp (0513) 2021061 emailbpjsketenagakerjaan@gmail.com<br></p>
                                </div>
                        </div>
                        <hr style="border:3px solid #000">
                        <?php
                        include 'database/sql.php';

                        $id = $_GET['id_cuti'];
                        $join = mysqli_query($konek, "SELECT * FROM surat_cuti
                        INNER JOIN pegawai ON pegawai.id_pegawai = surat_cuti.id_pegawai
                        INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan
                        WHERE id_cuti = $id");


                        while ($row = mysqli_fetch_array($join)) {
                        ?>

                                <br>
                                <p>
                                <h6 class="font-weight ">Kapuas <?php echo date('d M Y'); ?></h6>
                                </p>
                                <table>
                                        <tbody>
                                                <br>
                                                <tr>
                                                        <td width='120px'>Hal</td>
                                                        <td width='20px'>:</td>
                                                        <td><?php echo $row['keterangan']; ?></td>
                                                </tr>
                                                <tr>
                                                        <td width='120px'>Lampiran</td>
                                                        <td width='20px'>:</td>
                                                        <td>Surat Izin</td>
                                                </tr>
                                        </tbody>
                                </table>
                                <br>
                                <div>
                                        Dengan Hormat,
                                        <p> Yang Bertanda Tangan dibawah ini :</p>
                                </div>
                                <table>
                                        <tbody>
                                                <br>
                                                <tr>
                                                        <td width='120px'>Nama</td>
                                                        <td width='20px'>:</td>
                                                        <td><?php echo $row['nm_pegawai']; ?></td>
                                                </tr>
                                                <tr>
                                                        <td width='120px'>Jabatan</td>
                                                        <td width='20px'>:</td>
                                                        <td><?php echo $row['nm_jabatan']; ?></td>
                                                </tr>
                                                <tr>
                                                        <td width='120px'>Alamat</td>
                                                        <td width='20px'>:</td>
                                                        <td><?php echo $row['alamat']; ?></td>
                                                </tr>
                                        </tbody>
                                </table>
                                <br>
                                <div>
                                        Dengan surat ini saya mengajukan cuti <?php echo $row['keterangan']; ?> yang akan di mulai <?php $newDate = date("d-m-Y", strtotime($row['awal_cuti']));
                                                                                                                                        echo $newDate; ?> s/d <?php $newDate = date("d-m-Y", strtotime($row['akhir_cuti']));
                                                                                                                                                                echo $newDate; ?> , Bersama surat Ini Saya lampirkan mengenai cuti <?php echo $row['keterangan']; ?>.
                                </div>
                                <br>
                                <div>
                                        Demikian surat permohonan ini saya sampaikan, untuk menjadi pertimbangan bagi Bapak/Ibu pimpinan. Atas perhatian Bapak/Ibu saya ucapkan terimakasih.
                                </div>

                                <div class="row mb-4">
                                        <div class="col-md-6">
                                                <div class="text-muted"></div>
                                                <strong></strong>
                                                <p></p>
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
        </div>
        </div>
</section>
<?php } ?>
<script>
        window.print();
</script>