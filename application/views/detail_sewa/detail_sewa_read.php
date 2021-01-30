<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Detail Sewa Detail</h3>
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
	    <tr><td>Id Sewa</td><td><?php echo $id_sewa; ?></td></tr>
	    <tr><td>Id Barang</td><td><?php echo $id_barang; ?></td></tr>
	    <tr><td>Jumlah Barang</td><td><?php echo $jumlah_barang; ?></td></tr>
	    <tr><td>Total Harga Sewa</td><td><?php echo $total_harga_sewa; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('detail_sewa') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>