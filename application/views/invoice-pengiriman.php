<?php
$no_faktur = $invoice[0]->no_faktur_penjualan;
$tgl_transaksi = date("d-M-Y H:i A", strtotime($invoice[0]->tgl_penjualan));
$customer = $invoice[0]->nama_lengkap;
$customer_telp = $invoice[0]->no_telp;
$total = 0;
$sub_total = 0;
foreach ($invoice as $item){
    $total += $item->qty;
}
$total_harga = 0;
$diskon = 0;
$hasil_diskon= 0;
$nama_toko = $site[0]->nama_toko;
$alamat_toko = $site[0]->alamat_toko;
$telp_toko = $site[0]->telp_toko;
$hp_toko = $site[0]->hp_toko;
?>

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
    			<img src="<?php echo base_url();?>assets/image/logoinv.png" style="width: 18%;"><h3 class="pull-right">No. Faktur : <?php echo $no_faktur; ?></h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
                    <address>
                        <!--                        <strong>Tanggal Pesanan:</strong><br>-->
                        <!--                        --><?php //echo $tgl_transaksi; ?><!--<br>-->
                        <strong>Pengirim:</strong><br>
                       <?php echo $nama_toko ?><br>
                        <?php echo $alamat_toko?><br>
                        <?php echo $telp_toko?><br>
                        <?php echo $hp_toko?>
                    </address>
                </div>
                <div class="col-xs-6 text-right">


                    <address>
                        <strong>Penerima:</strong><br>
                        <?php echo $customer; ?><br>
                        <?php echo $invoice[0]->alamat; ?><br>
                        <?php echo $customer_telp; ?>

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

                            <?php for($i=0; $i < count($invoice); $i++){  ?>
                                <tr>
            						<td><?php echo $invoice[$i]->nama_barang?></td>
    								<td><?php echo $tgl_transaksi; ?></td>
                                    <td class="text-center"><?php echo $invoice[$i]->category_name?></td>
    								<td class="text-center"><?php echo $invoice[$i]->berat?></td>
    								<td class="text-right"><?php echo $invoice[$i]->qty?></td>
    							</tr>
    							<?php } ?>
                                <tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
                                    <td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Pengiriman</strong></td>
    								<td class="thick-line text-right">
                                        <?php
                                        if($invoice[0]->expedisi == 1){
                                            echo "JNE (REG)";
                                        }
                                        else if($invoice[0]->expedisi == 2){
                                            echo "JNE (OKE)";
                                        }
                                        else if($invoice[0]->expedisi == 3){
                                            echo "POS Indonesia";
                                        }
                                        else if($invoice[0]->expedisi == 4){
                                            echo "TIKI";
                                        }else{
                                            echo "None";
                                        }
                                        ?>

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