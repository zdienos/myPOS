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
<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>No Faktur : <?php echo $no_faktur?></title>
    <script src="<?=base_url()?>assets/js/jquery-3.3.1.js"></script>

    <style type="text/css" media="all">
        body {
            max-width: 300px;
            margin:0 auto;
            text-align:center;
            color:#000;
            font-family: Arial, Helvetica, sans-serif;
            font-size:12px;
        }
        #wrapper {
            min-width: 250px;
            margin: 0px auto;
        }
        #wrapper img {
            max-width: 300px;
            width: auto;
        }

        h2, h3, p {
            margin: 5px 0;
        }
        .left {
            width:100%;
            float:right;
            text-align:right;
            margin-bottom: 3px;
            margin-top: 3px;
        }
        .right {
            width:40%;
            float:right;
            text-align:right;
            margin-bottom: 3px;
        }
        .table, .totals {
            width: 100%;
            margin:10px 0;
        }
        .table th {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding-top: 4px;
            padding-bottom: 4px;
        }
        .table td {
            padding:0;
        }
        .totals td {
            width: 24%;
            padding:0;
        }
        .table td:nth-child(2) {
            overflow:hidden;
        }

        @media print {
            @page {
                    margin: 0;
                }

            body { text-transform: uppercase; }
            #buttons { display: none; }
            #wrapper { width: 100%; margin: 0; font-size:9px; }
            #wrapper img { max-width:300px; width: 80%; }
            #bkpos_wrp{
                display: none;
            }

        }
    </style>
</head>

<body>
<input type="hidden" id="no_faktur" value="<?php echo $no_faktur?>">
<div id="wrapper">
    <table border="0" style="border-collapse: collapse; width: 100%; height: auto;">
        <tr>
            <td width="50%" align="left">

                <img src="<?=base_url()?>assets/image/logoinv.png" style="width: 100px;" />

            </td>
            <td width="50%" align="left">

                <?php echo $no_faktur;?>

            </td>
        </tr>
        <tr>
            <!-- <td width="100%" align="center">
                <h2 style="padding-top: 0px; font-size: 24px;"><strong>ZOLAQU</strong></h2>
            </td> -->
        </tr>
        <tr>
            <td width="100%">
                <span class="left" style="text-align: left;">Alamat   : <?php echo $alamat_toko; ?></span>
                <span class="left" style="text-align: left;">No. Telepon  : <?php echo $telp_toko; ?></span>
                <span class="left" style="text-align: left;">No. Hp  : <?php echo $hp_toko; ?></span>
                <span class="left" style="text-align: left;">Tanggal  : <?php echo $tgl_transaksi; ?></span>
                <span class="left" style="text-align: left;">Customer : <?php echo $customer; ?></span>
                <span class="left" style="text-align: left;">Telepon  : <?php echo $customer_telp; ?></span>
                <input type="hidden" id="emailCustomer" value="<?php echo $invoice[0]->email;?>">
            </td>
        </tr>
    </table>


    <div style="clear:both;"></div>

    <table class="table" cellspacing="0"  border="0">
        <thead>
        <tr>
            <th width="10%"><em>#</em></th>
            <th width="35%" align="left">Produk</th>
            <th width="10%">Qty</th>
            <th width="25%">Per Barang</th>
            <th width="20%" align="right">Total</th>
        </tr>
        </thead>
        <tbody>
        <?php for($i=0; $i < count($invoice); $i++){ ?>
            <tr>
                <td style="text-align:center; width:30px;" valign="top"><?php echo $i + 1;?></td>
                <td style="text-align:left; width:130px; padding-bottom: 10px" valign="top"><?php echo $invoice[$i]->nama_barang?><br /></td>
                <td style="text-align:center; width:50px;" valign="top"><?php echo $invoice[$i]->qty?></td>
                <?php if($invoice[$i]->role_id == 3){ ?>
                    <td style="text-align:center; width:50px;" valign="top"><?php echo number_format($invoice[$i]->harga_retail, 0, '.', '.'); $sub_total = $invoice[$i]->qty * $invoice[$i]->harga_retail; ?></td>

                <?php } ?>
                <?php if($invoice[$i]->role_id == 4){ ?>
                    <td style="text-align:center; width:50px;" valign="top"><?php echo number_format($invoice[$i]->harga_dropship, 0, '.', '.'); $sub_total = $invoice[$i]->qty * $invoice[$i]->harga_dropship;?></td>

                <?php } ?>
                <?php if($invoice[$i]->role_id == 5){ ?>
                    <td style="text-align:center; width:50px;" valign="top"><?php echo number_format($invoice[$i]->harga_grosir, 0, '.', '.'); $sub_total = $invoice[$i]->qty * $invoice[$i]->harga_grosir;?></td>

                <?php } ?>
                <td style="text-align:right; width:70px;" valign="top"><?php echo number_format($sub_total, 0, '.', '.');?></td>
            </tr>
            <?php $total_harga += $sub_total; $hasil_diskon += $sub_total - $invoice[$i]->sub_total_harga;} ?>
        </tbody>
    </table>


    <table class="totals" cellspacing="0" border="0" style="margin-bottom:5px; border-top: 1px solid #000; border-collapse: collapse;">
        <tbody>
        <tr>
            <td style="text-align:left; padding-top: 5px;">Total Item</td>
            <td style="text-align:right; padding-right:1.5%; border-right: 1px solid #000;font-weight:bold;"><?php echo number_format($total, 0, '.', '.');?></td>
            <td style="text-align:left; padding-left:1.5%;">Total</td>
            <td style="text-align:right;font-weight:bold;"><?php echo number_format($total_harga, 0, '.', '.');?></td>
        </tr>

        <tr>
            <td style="text-align:left;">Expedisi</td>

            <td style="text-align:right; padding-right:1.5%; border-right: 1px solid #000;font-weight:bold;">
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

            <td style="text-align:left; padding-left:1.5%; padding-bottom: 5px;">Diskon</td>
            <td style="text-align:right;font-weight:bold;">- <?php echo number_format($hasil_diskon, 0, '.', '.');?></td>
        </tr>

        <tr>
            <td style="text-align:left; padding-top: 5px;">&nbsp;</td>
            <td style="text-align:right; padding-right:1.5%; border-right: 1px solid #000;font-weight:bold;">&nbsp;</td>
            <td style="text-align:left; padding-left:1.5%;">Biaya Expedisi</td>
            <td style="text-align:right;font-weight:bold;"><?php echo number_format($invoice[0]->biaya_expedisi, 0, '.', '.');?></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:left; font-weight:bold; border-top:1px solid #000; padding-top:5px;">Total</td>
            <td colspan="2" style="border-top:1px solid #000; padding-top:5px; text-align:right; font-weight:bold;"><?php echo number_format($total_harga - $hasil_diskon + $invoice[0]->biaya_expedisi, 0, '.', '.');?></td>
        </tr>

        <tr>
            <td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;">Total Bayar</td>
            <td colspan="2" style="padding-top:5px; text-align:right; font-weight:bold;"><?php
                if($invoice[0]->method_pembayaran == 1){
                    echo number_format($invoice[0]->total_bayar, 0, '.', '.');
                }else if($invoice[0]->method_pembayaran == 2){
                    echo number_format($total_harga - $hasil_diskon + $invoice[0]->biaya_expedisi, 0, '.', '.');
                }else{
                    echo number_format($invoice[0]->total_bayar, 0, '.', '.');
                }
                ?></td>
        </tr>
        <tr>
            <?php
            if($invoice[0]->method_pembayaran ==1 || $invoice[0]->method_pembayaran ==2 || $invoice[0]->total_kembali != 0){
                ?>
                <td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;">Kembalian</td>
                <td colspan="2" style="padding-top:5px; text-align:right; font-weight:bold;">

                    <?php
                    if($invoice[0]->method_pembayaran ==1 || $invoice[0]->total_kembali != 0){
                        echo number_format($invoice[0]->total_kembali, 0, '.', '.');
                    }else{
                        echo "0";
                    }

                    ?>

                </td>
            <?php }?>
        </tr>
        <?php if($invoice[0]->method_pembayaran ==3){ ?>

            <tr>
                <td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;">Total Sisa</td>
                <td colspan="2" style="padding-top:5px; text-align:right; font-weight:bold;">

                    <?php
                    echo number_format($invoice[0]->total_hutang, 0, '.', '.');


                    ?>

                </td>
            </tr>
        <?php }?>


        </tbody>
    </table>
    <table class="totals" cellspacing="0" border="0" style="margin-bottom:5px; border-top: 1px solid #000; border-collapse: collapse;">
        <tbody>
        <tr>
            <td style="text-align:left; padding-top: 5px;">Metode Pembayaran</td>
            <td style="text-align:right; padding-right:1.5%;font-weight:bold;"></td>
            <td style="text-align:left; padding-left:1.5%;"></td>
            <td style="text-align:right;font-weight:bold;">  <?php
                if($invoice[0]->method_pembayaran ==1){
                    echo "Cash";
                }else if($invoice[0]->method_pembayaran ==2){
                    echo "Bank";
                }else{
                    echo "Termin";
                }
                ?></td>

        </tr>
        <?php if($invoice[0]->method_pembayaran ==2){ ?>
            <tr>
                <td style="text-align:left; padding-top: 5px;">Bank</td>
                <td style="text-align:right; padding-right:1.5%;font-weight:bold;"></td>
                <td style="text-align:left; padding-left:1.5%;"></td>
                <td style="text-align:right;font-weight:bold;">  <?php
                    echo $invoice[0]->nama_bank;
                    ?></td>

            </tr>
            <tr>
                <td style="text-align:left; padding-top: 5px;">No Rekening</td>
                <td style="text-align:right; padding-right:1.5%;font-weight:bold;"></td>
                <td style="text-align:left; padding-left:1.5%;"></td>
                <td style="text-align:right;font-weight:bold;">  <?php
                    echo $invoice[0]->no_rek;
                    ?></td>

            </tr>
        <?php } ?>


        </tbody>
    </table>

    <div style="border-top:1px solid #000; padding-top:10px;">
        <p>Terimakasih sudah berbelanja di ZOLAQU!</p>
    </div>

</div>

<script>
window.print();
</script>

</body>
</html>
