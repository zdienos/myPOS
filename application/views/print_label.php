
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="<?=base_url()?>assets/css/bootstrap.css" rel="stylesheet">


    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>


    <title>Export Barcode</title>

    <style type="text/css">
        body{
            padding-top: 0px;
            background: #f1f4f7;
            color: #000;;
        }
        @media all {
            .page-break	{ //display: none; }
        }

        @media print {
            #bkpos_wrp{
                display: none;
            }
            .page-break	{ display: block; page-break-before: always; }
        }
        td, th {
            padding: 0px;
        }
    </style>
</head>

<body>

<div class="row" id="bkpos_wrp" style="padding-bottom: 10px; padding-top: 10px;">
    <div class="col-md-12">
        <center>
<!--            <a href="--><?//=base_url()."index.php/administrator/data_barang"?><!--" style="text-decoration: none;">-->
<!--                <button class="btn btn-primary" style="padding: 6px 12px; border-radius: 2px;">Kembali</button>-->
<!--            </a>-->

           <a href="<?= base_url()."index.php/administrator/barang"  ?>"><h1 style="color: #00598c; margin-top: 10px;">ZOLAQU</h1></a>
           <p> <?php echo $lang_print_label_header; ?></p>
            <a href="#" style="text-decoration: none;" id="print">
                <button class="btn btn-warning" style="padding: 6px 12px; border-radius: 2px;"><i class="glyphicon glyphicon-file"></i> Print</button>
            </a>
        </center>
    </div>
</div><!-- /.row -->

<center>
    <?php
    if (count($results) > 0) {
        foreach ($results as $data) {
            $code = $data->kode_barang;

            $prod_name = '';
            $prod_price = '';
            $prod_code = '';

            $prodDtaResult = $this->db->query("SELECT * FROM barang WHERE kode_barang = '$code' ");
            $prodDtaRows = $prodDtaResult->num_rows();
            if ($prodDtaRows == 1) {
                $prodDtaData = $prodDtaResult->result();

                $prod_name = $prodDtaData[0]->nama_barang;
                $prod_price = $prodDtaData[0]->harga_retail;
                $prod_code = $prodDtaData[0]->kode_barang;

                unset($prodDtaData);
            }
            unset($prodDtaResult);
            unset($prodDtaRows);

            ?>
            <div class="page-break" style="margin-top: 5px;">
                <table border="0" style="border-collapse: collapse; margin-bottom: 20px;" width="140px" height="auto">
                    <tr>
                        <td style="font-family: Arial, Helvetica, sans-serif; text-align: center; font-size: 12px;">
                            <?php echo $prod_name; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family: Arial, Helvetica, sans-serif; text-align: center; font-size: 12px;">
                            <img src="<?=base_url()?>assets/image/barcode/<?php echo $code; ?>.jpg" />
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family: Arial, Helvetica, sans-serif; text-align: center; font-size: 11px;">
                            <?php echo number_format($prod_price, 0, '.', '.'); ?>
                        </td>
                    </tr>
                </table>

            </div>
            <?php
        }
    }
    ?>
</center>

<div class="row" id="bkpos_wrp">
    <div class="col-md-12">
        <center><?php echo $links; ?></center>
    </div>
</div><!-- /.row -->

</body>
</html>
<script>
    $(document).ready(function () {
       $('#print').click(function () {
           window.print();
       });
    });
</script>
