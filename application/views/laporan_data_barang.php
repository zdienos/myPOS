<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <title>laporan data barang</title>
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

<?php if(count($data->result_array()) > 0){ ?>
<body>
<div class="container" style="width: 935px;height: 20px;margin-bottom: 0px !important;" id="printableArea">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <img src="<?php echo base_url();?>assets/image/logoinv.png" style="width: 18%;"><h3 class="pull-right">Laporan Data Barang</h3>
            </div>
            <hr>

        </div>
    </div>
</div>
<div id="laporan">


<!--    <table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">-->
<!--        <tr>-->
<!--            <td colspan="2" style="width:800px;paddin-left:20px;"><center><h4>LAPORAN DATA BARANG</h4></center><br/></td>-->
<!--        </tr>-->
<!---->
<!--    </table>-->


    <table border="0" align="center" style="width:900px;border:none;">
        <tr>
            <th style="text-align:left"></th>
        </tr>
    </table>

    <table border="1" align="center" style="width:900px;margin-bottom:20px;">
        <?php
        $urut=0;
        $nomor=0;
        $group='-';
        foreach($data->result_array()as $d){
            $nomor++;
            $urut++;
            if($group=='-' || $group!=$d['category_name']){
                $kat=$d['category_name'];

                if($group!='-')
                    echo "</table><br>";
                echo "<table align='center' width='900px;' border='1'>";
                echo "<tr><td colspan='6'><b>Kategori: $kat</b></td> </tr>";
                echo "<tr style='background-color:#ccc;'>
    <td width='4%' align='center'>No</td>
    <td width='10%' align='center'>Kode Barang</td>
    <td width='40%' align='center'>Nama Barang</td>
    <td width='10%' align='center'>Satuan</td>
    <td width='20%' align='center'>Harga Jual</td>
    <td width='30%' align='center'>Stok</td>
    
    </tr>";
                $nomor=1;
            }
            $group=$d['category_name'];
            if($urut==500){
                $nomor=0;
                echo "<div class='pagebreak'> </div>";

            }
            ?>
            <tr>
                <td style="text-align:center;vertical-align:center;text-align:center;"><?php echo $nomor; ?></td>
                <td style="vertical-align:center;padding-left:5px;text-align:center;"><?php echo $d['kode_barang']; ?></td>
                <td style="vertical-align:center;padding-left:5px;"><?php echo $d['nama_barang']; ?></td>
                <td style="vertical-align:center;text-align:center;"><?php echo $d['satuan']; ?></td>
                <td style="vertical-align:center;padding-right:5px;text-align:right;"><?php echo 'Rp '.number_format($d['harga_hpp']); ?></td>
                <td style="vertical-align:center;text-align:center;text-align:center;"><?php echo $d['stock']; ?></td>
            </tr>


            <?php
        }
        ?>
    </table>

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
<?php }else{ ?>
    <body>
    <div class="container" style="width: 935px;height: 20px;margin-bottom: 0px !important;" id="printableArea">
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <img src="<?php echo base_url();?>assets/image/logoinv.png" style="width: 18%;"><h3 class="pull-right">Laporan Data Barang</h3>
                </div>
                <hr>

            </div>
        </div>
    </div>
    <table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
        <tr>
            <td colspan="2" style="width:800px;paddin-left:20px;"><center><h4>BELUM ADA DATA!</h4></center><br/></td>
        </tr>

    </table>

    </body>
<?php } ?>
</html>
<script>
    $('#print').click(function () {
        window.print();
    });
</script>