<!-- Default box -->
<div class="col-md-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Rental Alat Outdoor</h3>
      <div class="box-tools pull-right">
        Jl. Sariasih 4 No.123 Kel. Sarijadi Kec.Suksari Kota Bandung, Jawa Barat 40151
      </div>
    </div>
    <div class="box-body">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-aqua">
          <span class="info-box-icon"><i class="fas fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Member</span>
            <span class="info-box-number"><?= $member; ?></span>

            <div class="progress">
              <div class="progress-bar" style="width: 100%"></div>
            </div>
            <span class="progress-description">
              Total Member
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-green">
          <span class="info-box-icon"><i class="fa fa-cubes"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Barang</span>
            <span class="info-box-number"><?= $barang; ?></span>

            <div class="progress">
              <div class="progress-bar" style="width: 100%"></div>
            </div>
            <span class="progress-description">
              Total Barang
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-yellow">
          <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Transaksi</span>
            <span class="info-box-number"><?= $sewa; ?></span>

            <div class="progress">
              <div class="progress-bar" style="width: 100%"></div>
            </div>
            <span class="progress-description">
              Transaksi Bulan Ini
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-red">
          <span class="info-box-icon"><i class="fa fa-money-bill-alt"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Pendapatan</span>
            <span class="info-box-number">Rp.<?= $pendapatan; ?>,-</span>

            <div class="progress">
              <div class="progress-bar" style="width: 100%"></div>
            </div>
            <span class="progress-description">
              Pemasukan Bulan ini
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <center>
      <h2> <b> Selamat Datang di Rental Alat Outdoor</b></h2>

    </center>
    <img src="<?= base_url('/assets/uploads/image/dashboard.jpg'); ?>" class="img img-responsive" width="100%">
  </div>

</div>