<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> View_sewa</h3>
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
            <label for="varchar">Nama Peminjam <?php echo form_error('Nama_Peminjam') ?></label>
            <input type="text" class="form-control" name="Nama_Peminjam" id="Nama_Peminjam" placeholder="Nama Peminjam" value="<?php echo $Nama_Peminjam; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Kasir <?php echo form_error('Nama_Kasir') ?></label>
            <input type="text" class="form-control" name="Nama_Kasir" id="Nama_Kasir" placeholder="Nama Kasir" value="<?php echo $Nama_Kasir; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tanggal Sewa <?php echo form_error('Tanggal_sewa') ?></label>
            <input type="text" class="form-control" name="Tanggal_sewa" id="Tanggal_sewa" placeholder="Tanggal Sewa" value="<?php echo $Tanggal_sewa; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tanggal Kembali <?php echo form_error('Tanggal_kembali') ?></label>
            <input type="text" class="form-control" name="Tanggal_kembali" id="Tanggal_kembali" placeholder="Tanggal Kembali" value="<?php echo $Tanggal_kembali; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tanggal Pengembalian <?php echo form_error('Tanggal_pengembalian') ?></label>
            <input type="text" class="form-control" name="Tanggal_pengembalian" id="Tanggal_pengembalian" placeholder="Tanggal Pengembalian" value="<?php echo $Tanggal_pengembalian; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Denda <?php echo form_error('Denda') ?></label>
            <input type="text" class="form-control" name="Denda" id="Denda" placeholder="Denda" value="<?php echo $Denda; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Total Bayar <?php echo form_error('Total_bayar') ?></label>
            <input type="text" class="form-control" name="Total_bayar" id="Total_bayar" placeholder="Total Bayar" value="<?php echo $Total_bayar; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">STATUS <?php echo form_error('STATUS') ?></label>
            <input type="text" class="form-control" name="STATUS" id="STATUS" placeholder="STATUS" value="<?php echo $STATUS; ?>" />
        </div>
	    <input type="hidden" name="" value="<?php echo $; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('view_sewa') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>