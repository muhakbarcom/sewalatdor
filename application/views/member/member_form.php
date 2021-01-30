<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button; ?> Member</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
                        <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- <form action="<?php echo $action; ?>" method="post"> -->
                <?php echo form_open_multipart($action); ?>
                <div class="form-group">
                    <label for="varchar">Nama <?php echo form_error('nama') ?></label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Alamat <?php echo form_error('alamat') ?></label>
                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Scan Jaminan <?php echo form_error('scan_jaminan') ?></label>
                    <input type="file" class="form-control" name="scan_jaminan" id="scan_jaminan" placeholder="Scan Jaminan" value="<?php echo $scan_jaminan; ?>" />
                    <?php if ($scan_jaminan) : ?>
                        <img src="<?= base_url('assets/uploads/image/jaminan/') . $scan_jaminan ?>" class="img-thumbnail">
                    <?php else : ?>
                    <?php endif ?>
                </div>
                <input type="hidden" name="id_member" value="<?php echo $id_member; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('member') ?>" class="btn btn-default">Cancel</a>
                <!-- </form> -->
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>