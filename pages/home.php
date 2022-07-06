<?php
include 'partials/scripts.php';
?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Starter Page</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Starter Page</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<?php include 'database/sql.php'; ?>
<!-- Main content -->
<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <?php
            $user = mysqli_query($konek, "SELECT * FROM pegawai ");
            $row1 = mysqli_num_rows($user);
            ?>
            <h3><?php echo $row1; ?></h3>

            <p>Pegawai</p>
          </div>

          <div class="icon">
            <i class="fa fa-user"></i>
          </div>
          <a href="?page=pegawairead" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <!-- <div class="small-box bg-success">
          <div class="inner">
            <?php
            $user = mysqli_query($konek, "SELECT * FROM surat_masuk ");
            $row1 = mysqli_num_rows($user);
            ?>
            <h3><?php echo $row1; ?></h3>

            <p>Surat Masuk</p>
          </div>
          <div class="icon">
            <i class="fa fa-envelope"></i>
          </div>
          <a href="?page=smread" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div> -->
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <?php
            $user = mysqli_query($konek, "SELECT * FROM surat_keluar ");
            $row1 = mysqli_num_rows($user);
            ?>
            <h3><?php echo $row1; ?></h3>

            <p>Surat Keluar</p>
          </div>
          <div class="icon">
            <i class="fa fa-envelope"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <?php
            $user = mysqli_query($konek, "SELECT * FROM surat_perintah ");
            $row1 = mysqli_num_rows($user);
            ?>
            <h3><?php echo $row1; ?></h3>

            <p>Surat Perintah</p>
          </div>
          <div class="icon">
            <i class="fa fa-envelope"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->

  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->