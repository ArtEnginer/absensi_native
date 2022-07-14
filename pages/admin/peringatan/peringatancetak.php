<?php
include 'database/sql.php';
$id = $_GET['id_sp'];
$join = mysqli_query($konek, "SELECT * from tb_peringatan 
    inner join pegawai on pegawai.id_pegawai  = tb_peringatan.id_pegawai where id_sp='$id'");
?>
<!DOCTYPE html>
<html>

<head>
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <style>
                h1,
                h2,
                h5,
                p,
                table {
                        font-family: 'Times New Roman';
                }

                .table td,
                .table th {
                        color: black;
                        border: 1px solid black;
                }

                table,
                tr,
                th,
                td {
                        color: black;
                }
        </style>
</head>

<body>
        <div class="content-wrapper">
                <section class="header">
                        <div class="container-fluid">
                                <div class="card">
                                        <div class="card-body">
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
                                        </div>
                                        <?php
                                        while ($row = mysqli_fetch_array($join)) {
                                        ?>
                                                <hr style="border:2px solid #000">
                                                <p class="text-center font-weight-bold">
                                                        SURAT PERINGANTAN <?php echo $row['sp']; ?>
                                                        <br>
                                                        Nomor : <?php echo $row['no_surat']; ?>
                                                </p>

                                                <div class="col-md-12">
                                                        <p>
                                                        <table class="col-md-5 mt-2">
                                                                <p>Surat ini ditujukan kepada : <br><br>
                                                                        Nama : <?php echo $row['nm_pegawai']; ?><br>
                                                                        Alamat : <?php echo $row['alamat']; ?><br>
                                                                        Telpon : <?php echo $row['no_hp']; ?><br><br>

                                                                        Dengan ini perusahaan terpaksa menyampaikan surat peringantan untuk menindak lanjuti
                                                                        perihal kesalahan yang pernah perusahaan sampaikan pada kesempatan sebelumnya dan kepada <?php echo $row['nm_pegawai']; ?>
                                                                        segara merespon surat peringatan ini. Agar saudari merubah sikap dan bertindak secara profesional lagi
                                                                        dengan ini perusahaan memberikan hukuman sesuai dengan aturan yang berlaku yakni :
                                                                        <br> <br>
                                                                        <?php echo $row['pelanggaran']; ?>
                                                                </p><br>
                                                                <p>
                                                                        Demikian surat ini dibuat agar dapat ditaati sebagaimana mestinya.
                                                                        Diharapankan yang bersangkutan dapat merubah sikap dan mampu menunjukkan sikap profesional dalam bekerja.
                                                                </p>
                                                                <br><br><br><br>
                                                </div>
                                                <div class="row mb-4">
                                                        <div class="col-md-6">
                                                                <div class="text-muted"></div>
                                                                <strong></strong>
                                                                <p></p>
                                                        </div>
                                                        <div class="col-md-6 text-md-right">
                                                                <div class="text-muted"> <br></div>
                                                                <p class="text-center">Kepala Cabang Kapuas</p>
                                                                <p class="text-center">
                                                                        <br>
                                                                        <br>
                                                                        <ins>Syahrul Rahim</ins>
                                                                        <br>
                                                                </p>

                                                                </p>
                                                        </div>
                                                </div>
                                </div>
                        </div><!-- /.container-fluid -->
                </section>
</body>
<script>
        window.print();
</script>

</html>
<?php } ?>