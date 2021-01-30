<!DOCTYPE html>
<html>
<head>
    <title>Tittle</title>
    <style type="text/css" media="print">
    @page {
        margin: 0;  /* this affects the margin in the printer settings */
    }
      table{
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
      }
      table th{
          -webkit-print-color-adjust:exact;
        border: 1px solid;

                padding-top: 11px;
    padding-bottom: 11px;
    background-color: #a29bfe;
      }
   table td{
        border: 1px solid;

   }
        </style>
</head>
<body>
    <h3 align="center">DATA Sewa</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
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
<script type="text/javascript">
      window.print()
    </script>
</html>