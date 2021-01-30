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
    <h3 align="center">DATA View Sewa</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Peminjam</th>
		<th>Nama Kasir</th>
		<th>Tanggal Sewa</th>
		<th>Tanggal Kembali</th>
		<th>Tanggal Pengembalian</th>
		<th>Denda</th>
		<th>Total Bayar</th>
		<th>STATUS</th>
		
            </tr><?php
            foreach ($view_sewa_data as $view_sewa)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $view_sewa->Nama_Peminjam ?></td>
		      <td><?php echo $view_sewa->Nama_Kasir ?></td>
		      <td><?php echo $view_sewa->Tanggal_sewa ?></td>
		      <td><?php echo $view_sewa->Tanggal_kembali ?></td>
		      <td><?php echo $view_sewa->Tanggal_pengembalian ?></td>
		      <td><?php echo $view_sewa->Denda ?></td>
		      <td><?php echo $view_sewa->Total_bayar ?></td>
		      <td><?php echo $view_sewa->STATUS ?></td>	
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