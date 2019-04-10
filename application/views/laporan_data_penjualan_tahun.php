<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <title>Laporan data penjualan</title>
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
    <body >
    <!-- Modal -->
    <div class="container" style="width: 935px;height: 20px;margin-bottom: 0px !important;" id="printableArea">
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <img src="<?php echo base_url();?>assets/image/logoinv.png" style="width: 18%;"><h3 class="pull-right">Laporan Data Penjualan</h3>
                </div>

            </div>
            <div class="col-xs-12" style="margin-top: -10px">
                <h6 class="pull-right">Periode Tahun :<?php $bulan_jual = $data->result(); echo $bulan_jual[0]->tahun_jual;?></h6>
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
            <tr>
                <th style="width:50px;text-align: center;">No</th>
                <th style="text-align: center;">No Faktur</th>
                <th style="text-align: center;">Tanggal</th>
                <th style="text-align: center;">Kode Barang</th>
                <th style="text-align: center;">Nama Barang</th>
                <th style="text-align: center;">Satuan</th>
                <th style="text-align: center;width: 120px">Metode Pembayaran</th>
                <th style="text-align: center;">Harga Jual</th>
                <th style="text-align: center;">Qty</th>
                <th style="text-align: center;">Diskon</th>

                <th style="text-align: center;">Total</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no=0;
            foreach ($data->result_array() as $i) {
                $no++;
                $nofak=$i['no_faktur_penjualan'];
                $tgl=$i['jual_tanggal'];
                $barang_id=$i['kode_barang'];
                $barang_nama=$i['nama_barang'];
                $barang_satuan=$i['satuan'];
                $barang_harjul=$i['harga_retail'];
                $barang_qty=$i['qty'];
                $barang_diskon=$i['diskon'];

                $expedisi = $i['biaya_expedisi'];

                $barang_total=$i['sub_total_harga'];
                $method_pembayaran;
                $bank = $i['nama_bank'];

                if($i['method_pembayaran'] == "1"){
                    $method_pembayaran = "Cash";
                }
                else if($i['method_pembayaran'] == "2"){
                    $method_pembayaran = "Bank ".$bank;
                }
                else if($i['method_pembayaran'] == "3"){
                    $method_pembayaran = "Termin";
                }
                ?>
                <tr>
                    <td style="text-align:center;"><?php echo $no;?></td>
                    <td style="padding-left:5px;"><?php echo $nofak;?></td>
                    <td style="text-align:center;"><?php echo $tgl;?></td>
                    <td style="text-align:center;"><?php echo $barang_id;?></td>
                    <td style="text-align:left;"><?php echo $barang_nama;?></td>
                    <td style="text-align:left;"><?php echo $barang_satuan;?></td>
                    <td style="text-align:center;"><?php echo $method_pembayaran;?></td>
                    <td style="text-align:right;"><?php echo 'Rp '.number_format($barang_harjul);?></td>
                    <td style="text-align:center;"><?php echo $barang_qty;?></td>
                    <td style="text-align:right;"><?php echo 'Rp '.number_format($barang_diskon);?></td>

                    <td style="text-align:right;"><?php echo 'Rp '.number_format($barang_total);?></td>
                </tr>
            <?php }?>
            </tbody>
            <tfoot>
            <?php
            $b=$jml->row_array();
            ?>
            <?php if($expedisi_total->num_rows() > 0){ ?>
                <tr>
                    <td colspan="8" ><b style="padding-left: 10px;">Biaya Expedisi</b></td>
                    <td colspan="2" style="text-align:center;">
                        <?php foreach ($expedisi_total->result_array() as $ex){ ?>
                            <b><?php echo $ex['no_faktur_penjualan'];?></b><br/>
                        <?php } ?>
                    </td>
                    <td style="text-align:right;">
                        <?php foreach ($expedisi_total->result_array() as $ex){ ?>
                            <b><?php echo 'Rp '.number_format($ex['biaya_expedisi']);?></b><br/>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="10" style="padding-left: 10px"><b>Total Biaya Expedisi</b></td>

                    <td style="text-align:right;"><b><?php echo 'Rp '.number_format($b['total_expedisi']);?></b></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="10" style="padding-left: 10px"><b>Total Penjualan</b></td>

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