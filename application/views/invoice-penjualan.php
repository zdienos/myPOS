<?php
    $no_faktur = $invoice[0]->no_faktur_penjualan;
    $tgl_transaksi = date("d/m/Y H:i A", strtotime($invoice[0]->tgl_penjualan));
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
                <img src="<?php echo base_url();?>assets/image/logoinv.png" style="width: 18%;"><h3 class="pull-right">No Faktur : <?php echo $no_faktur ?></h3>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <!--                        <strong>Tanggal Pesanan:</strong><br>-->
                        <!--                        --><?php //echo $tgl_transaksi; ?><!--<br>-->





                        <strong>Pengirim:</strong><br>
                        <?php echo $nama_toko ?><br>
                        <?php echo $alamat_toko ?><br>
                        <?php echo $telp_toko ?><br>
                        <?php echo $hp_toko ?>
                        <input type="hidden" id="no_faktur" value="<?php echo $no_faktur?>">
                    </address>
                </div>
                <div class="col-xs-6 text-right">


                    <address>
                        <strong>Penerima:</strong><br>
                         <?php echo $customer ?><br>
                         <?php echo $customer_telp ?><br>
                         <input type="hidden" id="emailCustomer" value="<?php echo $invoice[0]->email;?>">
                         

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
                                    <td><strong>#</strong></td>
                                    <td><strong>Produk</strong></td>
                                    <td><strong>Jumlah</strong></td>
                                    <td><strong>Per Barang</strong></td>
                                    <td><strong>Total</strong></td>
                                </tr>
                            </thead>
                            <tbody>

                             <?php for($i=0; $i < count($invoice); $i++){ ?>
                                <tr>
                                    <td><?php echo $i + 1;?></td>
                                    <td><?php echo $invoice[$i]->nama_barang?></td>
                                    <td><?php echo $invoice[$i]->qty?></td>
                                    <?php if($invoice[$i]->role_id == 3){ ?>
                                    <td><?php echo number_format($invoice[$i]->harga_retail, 0, '.', '.'); $sub_total = $invoice[$i]->qty * $invoice[$i]->harga_retail; ?></td>

                                    <?php } ?>
                                    <?php if($invoice[$i]->role_id == 4){ ?>
                                    <td><?php echo number_format($invoice[$i]->harga_dropship, 0, '.', '.'); $sub_total = $invoice[$i]->qty * $invoice[$i]->harga_dropship;?></td>

                                    <?php } ?>
                                    <?php if($invoice[$i]->role_id == 5){ ?>
                                    <td><?php echo number_format($invoice[$i]->harga_grosir, 0, '.', '.'); $sub_total = $invoice[$i]->qty * $invoice[$i]->harga_grosir;?></td>

                                    <?php } ?>
                                    <td><?php echo number_format($sub_total, 0, '.', '.');?></td>
                                </tr>
                                <?php $total_harga += $sub_total; $hasil_diskon += $sub_total - $invoice[$i]->sub_total_harga;} ?>
                                <tr>
                                    <td class="thick-line"><strong>Total Item</strong></td>
                                    <td class="thick-line">  
                                    <?php echo number_format($total, 0, '.', '.');?>                                                    
                                    </td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"><strong>Total Biaya</strong></td>
                                    <td class="thick-line"><?php echo number_format($total_harga - $hasil_diskon + $invoice[0]->biaya_expedisi, 0, '.', '.');?></td>
                                </tr>
                                <tr>                                    
                                    <td class=""><strong>Total</strong></td>
                                    <td>  
                                        <?php echo number_format($total_harga, 0, '.', '.');?></td>
                                    <td></td>
                                    <td><strong>Total Bayar</strong></td>
                                    <td>
                                        <?php
                                        if($invoice[0]->method_pembayaran == 1){
                                        echo number_format($invoice[0]->total_bayar, 0, '.', '.');
                                        }else if($invoice[0]->method_pembayaran == 2){
                                        echo number_format($total_harga - $hasil_diskon + $invoice[0]->biaya_expedisi, 0, '.', '.');
                                        }else{
                                        echo number_format($invoice[0]->total_bayar, 0, '.', '.');
                                        }
                ?>
                                    </td>                                                 
                                    
                                </tr>
                                <tr>                                    
                                    <td class=""><strong>Diskon</strong></td>
                                    <td>  
                                        - <?php echo number_format($hasil_diskon, 0, '.', '.');?></td>
                                    <td></td>
                                    <?php
                                    if($invoice[0]->method_pembayaran ==1 || $invoice[0]->method_pembayaran ==2 || $invoice[0]->total_kembali != 0){
                                    ?>
                                    <td><strong>Kembalian</strong></td>
                                    <td>

                                    <?php
                                    if($invoice[0]->method_pembayaran ==1 || $invoice[0]->total_kembali != 0){
                                    echo number_format($invoice[0]->total_kembali, 0, '.', '.');
                                    }else{
                                    echo "0";
                                    }

                                    ?>

                                    </td>
                                    <?php }?>   
                                     <?php if($invoice[0]->method_pembayaran ==3){ ?>


                                    <td><strong>Total Sisa</strong></td>
                                    <td>
                                    <?php
                                    echo number_format($invoice[0]->total_hutang, 0, '.', '.');
                                    ?>
                                    </td>
                                <?php }?>                                              
                                </tr>
                                <tr>                                    
                                    <td class=""><strong>Biaya Expedisi</strong></td>
                                    <td>  
                                       <?php echo number_format($invoice[0]->biaya_expedisi, 0, '.', '.');?></td>
                                        <td></td>
                                    <td><strong>Metode Pembayaran</strong></td>
                                    <td><?php
                if($invoice[0]->method_pembayaran ==1){
                    echo "Cash";
                }else if($invoice[0]->method_pembayaran ==2){
                    echo "Bank";
                }else{
                    echo "Termin";
                }
                ?></td>
                                     
                                </tr>


                            </tbody>
                        </table>
                         <p class="text-center">Terimakasih sudah berbelanja di ZOLAQU!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
<center><div class="col-md-12">
      <button class="btn btn-warning" onclick="printDiv('printableArea')"> Print </button>
      <a href="<?php echo base_url()."index.php/administrator/printInvoiceKecil/".$no_faktur?>" target="_blank"><button class="btn btn-warning" >Print Thermal</button></a>
      <?php if($invoice[0]->expedisi != 0){ ?>
    
    <a href="<?php echo base_url()."index.php/administrator/faktur/".$no_faktur?>"><button class="btn btn-primary" >Print Label Expedisi</button></a>
  <?php }?>
  <a href="javascript:;" class="btn btn-info" id="email"><i class="fa fa-spinner fa-spin" id="loading"></i> Kirim Email</a>
    <!-- <div id="bkpos_wrp" style="margin-top: 8px;">
        <span class="left"><a href="#" style="width:100%; display:block; font-size:12px; text-decoration: none; text-align:center; color:#000; background-color:#FFA93C; border:2px solid #FFA93C; padding: 10px 0px; font-weight:bold;" id="email"><i class="fa fa-spinner fa-spin" id="loading"></i> Kirim Email</a></span>
    </div> -->
    <a href="" class="btn btn-danger" onclick="window.close()" id="back">Selesai</a></a>
    <!-- <div id="bkpos_wrp" style="margin-top: 8px;">
        <span class="left"><a href="" onclick="window.close()" style="width:100%; display:block; font-size:12px; text-decoration: none; text-align:center; color:#000; background-color:#005b8a; border:2px solid #007FFF; padding: 10px 0px; font-weight:bold;color:white;" id="back">Selesai</a></span>
    </div> -->
</div></center>

</div>
</div>
<script type="text/javascript">
 $(document).ready(function() {
        $('#loading').hide();

            $('#email').click( function(){
                $('#loading').show();
                var email   = $('#emailCustomer').val();
                var no_penjualan = $('#no_faktur').val();

                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>index.php/administrator/sendInvoice",
                    data: { email: email,no_penjualan: no_penjualan},
                }).done(function( msg ) {
                                alert("Successfully Sent Receipt to "+email);
                                $('#email').hide();
                    $('#loading').hide();
                           });

            });
            $('#print').click(function () {
                window.print();
            });
      });
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
}

    </script>