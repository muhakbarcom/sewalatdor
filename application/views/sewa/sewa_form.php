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
                        <div class="row">
                            <div class="col-sm-9"> <label>Barang yang dipinjam</label>
                                <select class="selectpicker form-control" name="id_barang" id="id_barang" data-placeholder="Select a Parent" data-live-search="true" style="width: 100%;">
                                    <option value="0">-- Pilih barang -- </option>
                                    <?php
                                    foreach ($barang as $key => $value) {
                                        echo "<option value='" . $value->id_barang . "'>" . $value->nama_barang . ' = ' . $value->harga_sewa . "</option>";
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="int">Jumlah</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="jumlah">
                                            <span class="glyphicon glyphicon-minus"></span>
                                        </button>
                                    </span>
                                    <input type="text" name="jumlah" class="form-control input-number" value="1" min="1" max="50">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="jumlah">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <input type="hidden" class="form-control" name="id_user" id="id_user" placeholder="Id User" value="<?= $_SESSION['user_id']; ?>" />
                    <input type="hidden" name="id_sewa" value="<?php echo $id_sewa; ?>" />
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('view_sewa') ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <!-- keranjang -->
        <form action="<?= base_url('sewa/create_action'); ?>" method="post">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Keranjang Sewa</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
                            <i class="fa fa-refresh"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <form action="<?php echo $action; ?>" method="post">


                        <div class="form-group">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Barang</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Total Harga</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($keranjang as $k) :
                                        $barang_nama = $this->db->query('SELECT nama_barang from barang where id_barang=' . $k->id_barang)->row_array();
                                        $i = null;

                                    ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $barang_nama['nama_barang']; ?></td>
                                            <td><?= $k->jumlah; ?></td>
                                            <td><?= $k->total_harga; ?></td>
                                            <td><a href="<?= base_url('keranjang/delete/') . $k->id_keranjang; ?>">Hapus</a></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">

                            <label>Member Peminjam</label> <?php echo form_error('id_member') ?>
                            <select class="selectpicker form-control" name="id_member" id="id_member" data-placeholder="Select a Parent" data-live-search="true" style="width: 100%;">
                                <option value="">-- Pilih Member -- </option>
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
                            <a href="<?= base_url('member/create'); ?>">Bikin member baru?</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Sewa</button>
                        <a href="<?php echo site_url('view_sewa') ?>" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
    </div>
</div>

<script>
    $('.btn-number').click(function(e) {
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {

                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if (type == 'plus') {

                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function() {
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function() {

        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }
    });

    $(".input-number").keydown(function(e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>