<style type="text/css">
    @media print {
        @page {
                    margin: 0;
                }

    a[href]:after {
        content: none !important;
    }
}
</style>

<div class="container" style="width: 1107px;" id="printableArea">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<img src="<?php echo base_url();?>assets/image/logoinv.png" style="width: 18%;"><h3 class="pull-right">No. PO :  <?php echo $ad[0]->no_faktur_pembelian; ?></h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
                    <address>
                        <!--                        <strong>Tanggal Pesanan:</strong><br>-->
                        <!--                        --><?php //echo $tgl_transaksi; ?><!--<br>-->





                        <strong>Pembuat PO:</strong><br>
                        <?php echo $site[0]->nama_toko; ?><br>
                        <?php echo $site[0]->alamat_toko; ?><br>
                        <?php echo $site[0]->telp_toko; ?><br>
                        <?php echo $site[0]->hp_toko; ?>
                    </address>
                </div>
                <div class="col-xs-6 text-right">


                    <address>
                        <strong>Konveksi:</strong><br>
                         <?php echo $ad[0]->nama_supplier; ?><br>
                         <?php echo $ad[0]->alamat; ?><br>
                         <?php echo $ad[0]->no_telp; ?>

                    </address>

                </div>

    		</div>

    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Detail Pembelian</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Barang</strong></td>
                                    <td style="width:170px"><strong>Tanggal Transaksi</strong></td>
        							<td class="text-center"><strong>Kategori Barang</strong></td>
        							<td class="text-center"><strong>Berat (gram)</strong></td>
        							<td class="text-right"><strong>Jumlah</strong></td>
                                </tr>
    						</thead>
    						<tbody>

                             
                                <tr>
            						<td><?php echo $ad[0]->nama_barang; ?></td>
    								<td><?php echo $ad[0]->tgl_pembelian; ?></td>
                                    <td class="text-center"><?php echo $ad[0]->category_name; ?></td>
    								<td class="text-center"><?php echo $ad[0]->berat; ?> gram</td>
    								<td class="text-right"><?php echo $ad[0]->qty; ?></td>
    							</tr>

                                <tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
                                    <td class="thick-line"></td>
    								<td class="thick-line text-center"><!-- <strong>Pengiriman</strong> --></td>
    								<td class="thick-line text-right">
                                       

                                    </td>
    							</tr>

    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
<div class="container">
<div class="col-md-12">
<center><button class="btn btn-primary" style="margin-bottom: 20px;" onclick="printDiv('printableArea')"> Print </button></center>
</div>
</div>
<script type="text/javascript">

function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
}

    </script>