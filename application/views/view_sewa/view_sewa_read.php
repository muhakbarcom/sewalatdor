<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">View Sewa Detail</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                     <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
              <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
        <table class="table">
	    <tr><td>Nama Peminjam</td><td><?php echo $Nama_Peminjam; ?></td></tr>
	    <tr><td>Nama Kasir</td><td><?php echo $Nama_Kasir; ?></td></tr>
	    <tr><td>Tanggal Sewa</td><td><?php echo $Tanggal_sewa; ?></td></tr>
	    <tr><td>Tanggal Kembali</td><td><?php echo $Tanggal_kembali; ?></td></tr>
	    <tr><td>Tanggal Pengembalian</td><td><?php echo $Tanggal_pengembalian; ?></td></tr>
	    <tr><td>Denda</td><td><?php echo $Denda; ?></td></tr>
	    <tr><td>Total Bayar</td><td><?php echo $Total_bayar; ?></td></tr>
	    <tr><td>STATUS</td><td><?php echo $STATUS; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('view_sewa') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>