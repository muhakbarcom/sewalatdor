<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">View Detail Sewa Detail</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
                        <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Harga Barang</th>
                            <th scope="col">Jumlah Barang</th>
                            <th scope="col">Total Harga Sewa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($row as $row) : ?>
                            <tr>
                                <th scope="row">1</th>
                                <td><?= $row->nama_barang; ?></td>
                                <td><?= $row->harga_sewa; ?></td>
                                <td><?= $row->jumlah_barang; ?></td>
                                <td><?= $row->total_harga_sewa; ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <a href="<?= base_url('view_sewa'); ?>"><button class="btn btn-primary"> <i class="fa fa-backward"></i> Kembali</button></a>
            </div>
        </div>
    </div>
</div>