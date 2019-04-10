<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <title>Laporan data retur</title>
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
    <!-- Modal -->
    <div class="container" style="width: 935px;height: 20px;margin-bottom: 0px !important;" id="printableArea">
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <img src="<?php echo base_url();?>assets/image/logoinv.png" style="width: 18%;"><h3 class="pull-right">Laporan Data Retur</h3>


                </div>
                <!--            <div class="invoice-title">-->
                <!--                <h3 class="pull-right">Laporan Data Penjualan</h3>-->
                <!--             </div>-->

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
            <thead>
            <!--        <tr>-->
            <!--            <th colspan="11" style="text-align:left;">Tanggal : --><?php //echo date("d M Y", strtotime($tgl_awal)); ?><!-- --><?php
            //                if($tgl_akhir != null){
            //                    echo " - ".date("d M Y", strtotime($tgl_akhir));;
            //                }
            //                ?><!--</th>-->
            <!--        </tr>-->
            <tr>
                <th style="text-align: center">No Retur</th>
                <th style="text-align: center">No Faktur Penjualan</th>
                <th style="text-align: center">Tanggal</th>
                <th style="text-align: center">Kode Barang</th>
                <th style="text-align: center">Total Barang</th>
                <th style="text-align: center">Total Harga</th>
                <th style="text-align: center">Status</th>
</tr>
            </thead>
            <tbody>
            <?php
            $no=0;
            foreach ($data->result_array() as $i) {

                $noretur =$i['no_reture'];
                $nofak=$i['no_faktur_penjualan'];
                $tgl=$i['jual_tanggal'];
                $barang_id=$i['kode_barang'];
                $total_barang=$i['total_barang'];
                $total_harga=$i['total_harga'];
                $status=$i['status'];
                if($status == "baik"){
                    $status = "Dikembalikan";
                }else{
                    $status = "Rusak";
                }
                ?>
                <tr>
                    <td style="text-align:center;"><?php echo $noretur;?></td>
                    <td style="padding-left:5px;"><?php echo $nofak;?></td>
                    <td style="text-align:center;"><?php echo $tgl;?></td>
                    <td style="text-align:center;"><?php echo $barang_id;?></td>
                    <td style="text-align:left;"><?php echo $total_barang;?></td>
                    <td style="text-align:left;"><?php echo $total_harga;?></td>
                    <td style="text-align:center;"><?php echo $status;?></td>
                </tr>
            <?php }?>
            </tbody>
            <tfoot>
            <?php
            $b=$jml->row_array();
            ?>
            <tr>
                <td colspan="6" style="text-align:center;"><b>Total</b></td>

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
<?php }else{ ?>
    <body>

    <table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
        <tr>
            <td colspan="2" style="width:800px;paddin-left:20px;"><center><h4>BELUM ADA DATA!</h4></center><br/></td>
        </tr>

    </table>
    </body>
<?php } ?>
</html>_
<script>
    $('#print').click(function () {
        window.print();
    });
</script>