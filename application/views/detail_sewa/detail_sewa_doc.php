<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Detail_sewa List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Sewa</th>
		<th>Id Barang</th>
		<th>Jumlah Barang</th>
		<th>Total Harga Sewa</th>
		
            </tr><?php
            foreach ($detail_sewa_data as $detail_sewa)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $detail_sewa->id_sewa ?></td>
		      <td><?php echo $detail_sewa->id_barang ?></td>
		      <td><?php echo $detail_sewa->jumlah_barang ?></td>
		      <td><?php echo $detail_sewa->total_harga_sewa ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>