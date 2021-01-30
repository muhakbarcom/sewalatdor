<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button; ?> Sewa</h3>
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
                        <label>Member Peminjam</label>
                        <select class="selectpicker form-control" name="id_member" id="id_member" data-placeholder="Select a Parent" data-live-search="true" style="width: 100%;">
                            <option value="0">-- Pilih Member -- </option>
                            <?php
                            foreach ($member as $key => $value) {
                                echo "<option value='" . $value->id_member . "'>" . $value->id_member . " - " . $value->nama . "</option>";
                            }
                            ?>

                        </select>
                    </div>

                    <input type="hidden" class="form-control" name="id_user" id="id_user" placeholder="Id User" value="<?= $_SESSION['user_id']; ?>" />

                    <div class="form-group">
                        <!-- <label for="date">Tgl Sewa <?php echo form_error('tgl_sewa') ?></label> -->
                        <input type="hidden" class="form-control formdate" name="tgl_sewa" id="tgl_sewa" placeholder="Tgl Sewa" value="<?= date('Y-m-d'); ?>" />
                    </div>
                    <div class="form-group">
                        <!-- <label for="date">Tgl Kembali <?php echo form_error('tgl_kembali') ?></label> -->
                        <input type="hidden" class="form-control" name="tgl_kembali" id="tgl_kembali" placeholder="Tgl Kembali" value="<?php $date = date('Y-m-d');
                                                                                                                                        $date = strtotime($date);
                                                                                                                                        $date = strtotime("+7 day", $date);
                                                                                                                                        echo date('Y-m-d', $date); ?>" />
                    </div>
                    <!-- <div class="form-group">
                        <label for="date">Tgl Pengembalian <?php echo form_error('tgl_pengembalian') ?></label>
                        <input type="text" class="form-control" name="tgl_pengembalian" id="tgl_pengembalian" placeholder="Tgl Pengembalian" value="<?php echo $tgl_pengembalian; ?>" />
                    </div> -->
                    <div class="form-group">
                        <label for="int">Denda <?php echo form_error('denda') ?></label>
                        <input type="text" class="form-control" name="denda" id="denda" placeholder="Denda" value="<?php echo $denda; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="int">Total Bayar <?php echo form_error('total_bayar') ?></label>
                        <input type="text" class="form-control" name="total_bayar" id="total_bayar" placeholder="Total Bayar" value="<?php echo $total_bayar; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="enum">Status <?php echo form_error('status') ?></label>
                        <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
                    </div>
                    <input type="hidden" name="id_sewa" value="<?php echo $id_sewa; ?>" />
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('sewa') ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>