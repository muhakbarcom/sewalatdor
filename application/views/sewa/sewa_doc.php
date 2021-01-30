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
        <h2>Sewa List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Member</th>
		<th>Id User</th>
		<th>Tgl Sewa</th>
		<th>Tgl Kembali</th>
		<th>Tgl Pengembalian</th>
		<th>Denda</th>
		<th>Total Bayar</th>
		<th>Status</th>
		
            </tr><?php
            foreach ($sewa_data as $sewa)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $sewa->id_member ?></td>
		      <td><?php echo $sewa->id_user ?></td>
		      <td><?php echo $sewa->tgl_sewa ?></td>
		      <td><?php echo $sewa->tgl_kembali ?></td>
		      <td><?php echo $sewa->tgl_pengembalian ?></td>
		      <td><?php echo $sewa->denda ?></td>
		      <td><?php echo $sewa->total_bayar ?></td>
		      <td><?php echo $sewa->status ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>