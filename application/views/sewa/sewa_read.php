<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Sewa Detail</h3>
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
	    <tr><td>Id Member</td><td><?php echo $id_member; ?></td></tr>
	    <tr><td>Id User</td><td><?php echo $id_user; ?></td></tr>
	    <tr><td>Tgl Sewa</td><td><?php echo $tgl_sewa; ?></td></tr>
	    <tr><td>Tgl Kembali</td><td><?php echo $tgl_kembali; ?></td></tr>
	    <tr><td>Tgl Pengembalian</td><td><?php echo $tgl_pengembalian; ?></td></tr>
	    <tr><td>Denda</td><td><?php echo $denda; ?></td></tr>
	    <tr><td>Total Bayar</td><td><?php echo $total_bayar; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('sewa') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>