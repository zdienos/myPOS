<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <title>laporan data stok barang</title>
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
                <img src="<?php echo base_url();?>assets/image/logoinv.png" style="width: 18%;"><h3 class="pull-right">Laporan Data Stok Barang</h3>
            </div>
            <hr>

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
        <?php
        $urut=0;
        $nomor=0;
        $group='-';
        foreach($data->result_array()as $d){
            $nomor++;
            $urut++;
            if($group=='-' || $group!=$d['category_name']){
                $kat=$d['category_name'];
                $query=$this->db->query("SELECT barang.id_category,category.category_name,barang.nama_barang,SUM(barang.stock) AS tot_stok FROM barang INNER JOIN category ON barang.id_category=category.id_category WHERE category.category_name='$kat'");
                $t=$query->row_array();
                $tots=$t['tot_stok'];
                if($group!='-')
                    echo "</table><br>";
                echo "<table align='center' width='900px;' border='1'>";
                echo "<tr><td colspan='2'><b>Kategori: $kat</b></td> <td style='text-align:center;'><b>Total Stok: $tots </b></td></tr>";
                echo "<tr style='background-color:#ccc;'>
    <td width='4%' align='center'>No</td>
    <td width='60%' align='center'>Nama Barang</td>
    <td width='30%' align='center'>Stok</td>
    
    </tr>";
                $nomor=1;
            }
            $group=$d['category_name'];
            if($urut==500){
                $nomor=0;
                echo "<div class='pagebreak'> </div>";
                //echo "<center><h2>KALENDER EVENTS PER TAHUN</h2></center>";
            }
            ?>
            <tr>
                <td style="text-align:center;vertical-align:top;text-align:center;"><?php echo $nomor; ?></td>
                <td style="vertical-align:top;padding-left:5px;"><?php echo $d['nama_barang']; ?></td>
                <td style="vertical-align:top;text-align:center;"><?php echo $d['stock']; ?></td>
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