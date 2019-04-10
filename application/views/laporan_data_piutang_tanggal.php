<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <title>laporan data piutang</title>
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
<?php
$countHutang = $this->db->query("SELECT SUM(total_hutang) AS jumlah_hutang FROM payment")->row_array();
?>
<?php if(count($data->result_array()) > 0){ ?>
    <body>
    <div class="container" style="width: 935px;height: 20px;margin-bottom: 0px !important;" id="printableArea">
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <img src="<?php echo base_url();?>assets/image/logoinv.png" style="width: 18%;"><h3 class="pull-right">Laporan Data Piutang</h3>
                </div>


            </div>
            <div class="col-xs-12" style="margin-top: -10px">
                <h6 class="pull-right">Periode Tanggal : <?php echo date("d M Y", strtotime($tgl_awal)); ?> <?php
                    if($tgl_akhir != null){
                        echo " - ".date("d M Y", strtotime($tgl_akhir));;
                    }
                    ?></h6>
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
            <?php
            $urut=0;
            $nomor=0;
            $group='-';
            foreach($data->result_array()as $d){
                $nomor++;
                $urut++;
                if($group=='-' || $group!=$d['nama_lengkap']){
                    $kat=$d['nama_lengkap'];
                    $query=$this->db->query("SELECT SUM(payment.total_hutang) AS tot_hutang FROM payment INNER JOIN customer ON payment.customer_id=customer.customer_id WHERE customer.nama_lengkap='$kat'");
                    $counting =$this->db->query("SELECT COUNT(payment.id_payment) AS tot_orang FROM payment INNER JOIN customer ON payment.customer_id=customer.customer_id WHERE customer.nama_lengkap='$kat' AND payment.total_hutang !='0'")->row_array();
                    $t=$query->row_array();
                    $totOrg = $counting['tot_orang'];
                    $tots=  number_format($t['tot_hutang'], 0, '.', '.');
                    if($group!='-'){
                        echo "</table><br>";
                    $urut--;
                    }
                    echo "<table align='center' width='900px;' border='1'>";


                    echo "<tr style='background-color:#ccc;'>
    <td  align='center' style='width:10%'>No Faktur</td>
    <td  align='center' style='width:15%'>Tanggal Pembayaran</td>
        <td align='center' style='width:25%'>Customer</td>
    <td align='center' style='width:15%'>Total Harga</td>
    <td align='center' style='width:15%'>Total Bayar</td>
    <td align='center'>Sisa</td>

    
    </tr>";
                    $nomor=1;
                }
                $group=$d['nama_lengkap'];
                if($urut==500){
                    $nomor=0;
                    echo "<div class='pagebreak'> </div>";
                    //echo "<center><h2>KALENDER EVENTS PER TAHUN</h2></center>";
                }
                ?>
                <tr>
                    <td style="text-align:center;vertical-align:top;text-align:center;"><?php echo $d['no_penjualan']; ?></td>
                    <td style="vertical-align:top;padding-left:5px;"><?php echo $d['jual_tanggal']; ?></td>
                    <td style="vertical-align:top;text-align:center;"><?php echo $d['nama_lengkap']; ?></td>
                    <td style="vertical-align:top;text-align:center;"><?php echo number_format($d['total_harga'], 0, '.', '.'); ?></td>
                    <td style="vertical-align:top;text-align:center;"><?php echo number_format($d['total_bayar'], 0, '.', '.'); ?></td>
                    <td style="vertical-align:top;text-align:center;"><?php echo number_format($d['total_hutang'], 0, '.', '.'); ?></td>
                </tr>


                <?php
                if($urut == $totOrg){
                    echo "<tr><td colspan=5'><b>Total Hutang : </b></td> <td style='text-align:center;'><b>$tots</b></td></tr>";
                }
            }
            ?>
            <?php

            ?>
        </table>
 <br/>
        <table border="1" align="center" style="width:900px;margin-bottom:20px;">
      <tr>
          <td colspan="5" style='width:80%'><b>Total Keseluruhan : </b></td>
          <td style='text-align: center'><b><?php echo number_format($countHutang['jumlah_hutang'], 0, '.', '.');?></b></td>
      </tr>
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
                    <img src="<?php echo base_url();?>assets/image/logoinv.png" style="width: 18%;"><h3 class="pull-right">Laporan Data Piutang</h3>
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