<div class="container">
    <div class="text-center"><h1>Data Pembelian</h1></div>

    <table class="table table-striped table-bordered top" id="table">
      <thead>
        <tr class="active">
          <th class="text-center">No Pembelian</th>
          <th class="text-center">Supplier</th>
          <th class="text-center">Tanggal Pembelian</th>
          <th class="text-center">Kode Barang</th>
          <th class="text-center">Nama Barang</th>
          <th class="text-center">Harga Barang</th>
          <th class="text-center">Total Barang</th>
          <th class="text-center">Total Harga</th>
          <th class="text-center">Opsi</th>
        </tr>
      </thead>
        <tbody>
            <?php foreach ($detail as $d) { ?>
            <tr>
            <td><?php echo $d->no_faktur_pembelian; ?></td>    
            <td><?php echo $d->nama_supplier; ?></td>    
            <td><?php echo $d->tgl_pembelian; ?></td>    
            <td><?php echo $d->kode_barang; ?></td>    
            <td><?php echo $d->nama_barang; ?></td>    
            <td><?php echo $d->harga_barang; ?></td>    
            <td><?php echo $d->qty; ?></td>    
            <td><?php echo $d->sub_total_harga; ?></td>    
            <td><center><a href="<?php echo base_url().'index.php/Administrator/faktur_detail/'.$d->id_pembelian; ?>" class="btn btn-warning btn-xs"><i class="fa fa-print"></i> Print</a></center></td>    
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <script src="http://localhost/PointOfSale/assets/lib/DataTable/jquery.dataTables.min.js">      </script>
    <script src="http://localhost/PointOfSale/assets/lib/DataTable/dataTables.bootstrap.min.js">      </script>
    <script src="http://localhost/PointOfSale/assets/lib/JqueryDate/jquery-dateformat.min.js">      </script>


<script type="text/javascript">
     $('#table').DataTable();
</script>

  
</div>