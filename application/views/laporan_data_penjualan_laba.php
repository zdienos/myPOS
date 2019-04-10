<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <title>Laporan Laba/rugi</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/laporan.css')?>"/>
</head>
<style>
    @media print {
        @page {
                    margin: 0;
                }

        #print{
            display: none;
        }
    }
</style>
<body>
<div class="container" style="width: 935px;height: 20px;margin-bottom: 0px !important;" id="printableArea">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <img src="<?php echo base_url();?>assets/image/logoinv.png" style="width: 18%;"><h3 class="pull-right">Laporan Laba / Rugi</h3>
            </div>

        </div>
        <?php
        $b=$jml->row_array();
        ?>
        <div class="col-xs-12" style="margin-top: -10px">
            <h6 class="pull-right">Periode Bulan : <?php echo $b['bulan'];?></h6>
        </div>
        <div class="col-xs-12" style="    border: 0.5px solid gray;
    margin-bottom: 10px;
    width: 96%;
    margin-left: 2%;">
        </div>
    </div>
</div>
<div id="laporan">

    <table border="0" align="center" style="width:900px;border:none;">
        <tr>
            <th style="text-align:left"></th>
        </tr>
    </table>

    <table border="1" align="center" style="width:900px;margin-bottom:20px;">
        <thead>
<!--        <tr>-->
<!--            <th colspan="11" style="text-align:left;">Bulan : --><?php //echo $b['bulan'];?><!--</th>-->
<!--        </tr>-->
        <tr>
            <th style="width:50px;">No</th>
            <th>Tanggal</th>
            <th>Nama Barang</th>
            <th>Satuan</th>
            <th>Harga Pokok</th>
            <th>Harga Jual</th>
            <th>Keuntungan Per Unit</th>
            <th>Item Terjual</th>
            <th>Diskon</th>
            <th>Untung Bersih</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no=0;
        foreach ($data->result_array() as $i) {
            $no++;
            $tgl=$i['jual_tanggal'];
            $nabar=$i['nama_barang'];
            $satuan=$i['satuan'];
            $harpok=$i['harga_hpp'];
            $harjul=$i['harga_barang'];
            $untung_perunit=$i['keunt'];
            $qty=$i['qty'];
            $diskon=$i['diskon'];
            $untung_bersih=$i['untung_bersih'];
            ?>
            <tr>
                <td style="text-align:center;"><?php echo $no;?></td>
                <td style="text-align:center;"><?php echo $tgl;?></td>
                <td style="text-align:left;"><?php echo $nabar;?></td>
                <td style="text-align:left;"><?php echo $satuan;?></td>
                <td style="text-align:right;"><?php echo 'Rp '.number_format($harpok);?></td>
                <td style="text-align:right;"><?php echo 'Rp '.number_format($harjul);?></td>
                <td style="text-align:right;"><?php echo 'Rp '.number_format($untung_perunit);?></td>
                <td style="text-align:center;"><?php echo $qty;?></td>
                <td style="text-align:right;"><?php echo 'Rp '.number_format($diskon);?></td>
                <td style="text-align:right;"><?php echo 'Rp '.number_format($untung_bersih);?></td>
            </tr>
        <?php }?>
        </tbody>
        <tfoot>

        <tr>
            <td colspan="9" style="text-align:center;"><b>Total Keuntungan</b></td>
            <td style="text-align:right;"><b><?php echo 'Rp '.number_format($b['total']);?></b></td>
        </tr>
        </tfoot>
    </table>
    <table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
        <tr>
            <td></td>
    </table>
    <table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
        <tr>
            <td align="right">Bandung, <?php echo date('d-M-Y')?></td>
        </tr>
        <tr>
            <td align="right"></td>
        </tr>

        <tr>
            <td><br/><br/><br/><br/></td>
        </tr>
        <tr>
            <td align="right">( <?php echo $this->session->userdata('ses_name');?> )</td>
        </tr>
        <tr>
            <td align="center"></td>
        </tr>
    </table>
    <table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
        <tr>
            <th><br/><br/></th>
        </tr>
        <tr>
            <th align="left"></th>
        </tr>
    </table>
</div>
<div class="container">
    <div class="col-md-12">
        <center><button class="btn btn-primary" style="margin-bottom: 20px;" id="print"> Print </button></center>
    </div>
</div>
</body>
</html>

<script>
    $('#print').click(function () {
        window.print();
    });
</script>