<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button; ?> Barang</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
                        <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="<?php echo $action; ?>" method="post">
                    <div class="form-group">
                        <label for="varchar">Nama Barang <?php echo form_error('nama_barang') ?></label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="<?php echo $nama_barang; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="int">Harga Sewa <?php echo form_error('harga_sewa') ?></label>
                        <input type="text" class="form-control" name="harga_sewa" id="harga_sewa" placeholder="Harga Sewa" value="<?php echo $harga_sewa; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="int">Stok <?php echo form_error('stok') ?></label>
                        <input type="number" class="form-control" name="stok" id="stok" placeholder="Stok" value="<?php echo $stok; ?>" />
                    </div>
                    <input type="hidden" name="id_barang" value="<?php echo $id_barang; ?>" />
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('barang') ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>