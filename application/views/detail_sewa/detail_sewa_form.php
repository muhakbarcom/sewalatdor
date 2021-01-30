<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Detail_sewa</h3>
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
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Sewa <?php echo form_error('id_sewa') ?></label>
            <input type="text" class="form-control" name="id_sewa" id="id_sewa" placeholder="Id Sewa" value="<?php echo $id_sewa; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Barang <?php echo form_error('id_barang') ?></label>
            <input type="text" class="form-control" name="id_barang" id="id_barang" placeholder="Id Barang" value="<?php echo $id_barang; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Jumlah Barang <?php echo form_error('jumlah_barang') ?></label>
            <input type="text" class="form-control" name="jumlah_barang" id="jumlah_barang" placeholder="Jumlah Barang" value="<?php echo $jumlah_barang; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Total Harga Sewa <?php echo form_error('total_harga_sewa') ?></label>
            <input type="text" class="form-control" name="total_harga_sewa" id="total_harga_sewa" placeholder="Total Harga Sewa" value="<?php echo $total_harga_sewa; ?>" />
        </div>
	    <input type="hidden" name="id_detail_sewa" value="<?php echo $id_detail_sewa; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('detail_sewa') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>