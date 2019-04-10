<style>
    .select2-container{
        width: 100% !important;
    }
</style>

<body>
<!--<div id="modalBulan" class="modal fade" role="dialog">-->
<!--    <div class="modal-dialog modal-sm">-->
<!---->
<!--        <div class="modal-content ">-->
<!--            <div class="modal-header">-->
<!--                <button type="button" class="close" data-dismiss="modal">&times;</button>-->
<!--                <h4 class="modal-title">Pilih Bulan</h4>-->
<!--            </div>-->
<!--            <div class="modal-body">-->
<!---->
<!--            </div>-->
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    </div>-->
<!--</div>-->

<div class="modal fade" id="modalTanggal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Range</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'index.php/administrator/laporanDataPenjualanTanggal'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" style="text-align: center" >Tanggal Awal</label>
                        <div class="col-xs-9">
                            <input type="date" name="tgl" id="tgl" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" style="text-align: center" >Tanggal Akhir</label>
                        <div class="col-xs-9">
                            <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control">
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-eye"></span> Lihat</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalTanggalRetur" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Range Tanggal</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'index.php/administrator/laporanDataReturTanggal'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" style="text-align: center" >Tanggal Awal</label>
                        <div class="col-xs-9">
                            <input type="date" name="tgl_retur" id="tgl_retur" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" style="text-align: center" >Tanggal Akhir</label>
                        <div class="col-xs-9">
                            <input type="date" name="tgl_akhir_retur" id="tgl_akhir_retur" class="form-control">
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-eye"></span> Lihat</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalTanggalBank" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Range Tanggal & Bank</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'index.php/administrator/laporanDataBankTanggal'?>" target="_blank">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3" style="text-align: center" >Bank</label>
                        <div class="col-xs-9">
                            <select name="bank" id="bank" class="form-control" required>
                                <option>--- Pilih Bank ---</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" style="text-align: center" >Tanggal Awal</label>
                        <div class="col-xs-9">
                            <input type="date" name="tgl_bank" id="tgl_bank" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" style="text-align: center" >Tanggal Akhir</label>
                        <div class="col-xs-9">
                            <input type="date" name="tgl_akhir_bank" id="tgl_akhir_bank" class="form-control">
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-eye"></span> Lihat</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalTanggalPiutang" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Range Tanggal</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'index.php/administrator/laporanDataPiutangTanggal'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" style="text-align: center" >Tanggal Awal</label>
                        <div class="col-xs-9">
                            <input type="date" name="tgl_piutang" id="tgl_piutang" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" style="text-align: center" >Tanggal Akhir</label>
                        <div class="col-xs-9">
                            <input type="date" name="tgl_akhir_piutang" id="tgl_akhir_piutang" class="form-control">
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-eye"></span> Lihat</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalBulan" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Bulan</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'index.php/administrator/laporanDataPenjualanBulan'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" style="text-align: center" >Bulan</label>
                        <div class="col-xs-9">
                            <select id="bln" name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required/>
                            <?php foreach ($jual_bln->result_array() as $k) {
                                $bln=$k['bulan'];
                                ?>
                                <option><?php echo $bln;?></option>
                            <?php }?>
                            </select>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-eye"></span> Lihat</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalTahun" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Tahun</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'index.php/administrator/laporanDataPenjualanTahun'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" style="text-align: center" >Tahun</label>
                        <div class="col-xs-9">
                            <select id="thn" name="thn" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Tahun" data-width="80%" required/>
                            <?php foreach ($jual_thn->result_array() as $t) {
                                $thn=$t['tahun'];
                                ?>
                                <option><?php echo $thn;?></option>
                            <?php }?>
                            </select>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-eye"></span> Lihat</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalLaba" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Bulan</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'index.php/administrator/laporanDataPenjualanLaba'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" style="text-align: center" >Bulan</label>
                        <div class="col-xs-9">
                            <select id="bln-laba" name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Tahun" data-width="80%" required/>
                            <?php foreach ($jual_bln->result_array() as $k) {
                                $bln=$k['bulan'];
                                ?>
                                <option><?php echo $bln;?></option>
                            <?php }?>
                            </select>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-eye"></span> Lihat</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="text-center"><h1>Laporan</h1></div>
    <table class="table table-bordered top" id="table">
        <thead>
        <tr class="active">
            <th>No</th>
            <th>Laporan</th>
            <th style="width: 8%">Opsi</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Laporan Data Barang</td>
            <td><a target="_blank" href="<?php echo base_url()."index.php/administrator/laporanDataBarang"?>"><button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> Lihat</button></a></td>

        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Laporan Stok Barang</td>
            <td><a target="_blank" href="<?php echo base_url()."index.php/administrator/laporanDataBarangStok"?>"><button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> Lihat</button></a></td>

        </tr>
        <tr>
            <th scope="row">3</th>
            <td>Laporan Penjualan</td>
            <td><a target="_blank" href="<?php echo base_url()."index.php/administrator/laporanDataPenjualan"?>"><button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> Lihat</button></a></td>

        </tr>
        <tr>
            <th scope="row">4</th>
            <td>Laporan Penjualan PerTanggal</td>
            <td><a href="javascript:;" data-toggle="modal" data-target="#modalTanggal"><button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> Lihat</button></a></td>

        </tr>
        <tr>
            <th scope="row">5</th>
            <td>Laporan Penjualan PerBulan</td>
            <td><a href="javascript:;" data-toggle="modal" data-target="#modalBulan"><button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> Lihat</button></a></td>

        </tr>
        <tr>
            <th scope="row">6</th>
            <td>Laporan Penjualan PerTahun</td>
            <td><a href="javascript:;" data-toggle="modal" data-target="#modalTahun"><button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> Lihat</button></a></td>

        </tr>
        <tr>
            <th scope="row">7</th>
            <td>Laporan Retur Barang</td>
            <td><a href="javascript:;" data-toggle="modal" data-target="#modalTanggalRetur"><button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> Lihat</button></a></td>

        </tr>
        <tr>
            <th scope="row">8</th>
            <td>Laporan Piutang</td>
            <td><a href="javascript:;" data-toggle="modal" data-target="#modalTanggalPiutang"><button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> Lihat</button></a></td>

        </tr>
        <tr>
            <th scope="row">9</th>
            <td>Laporan Bank</td>
            <td><a href="javascript:;" data-toggle="modal" data-target="#modalTanggalBank"><button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> Lihat</button></a></td>

        </tr>

        <?php if($this->session->userdata('akses') == "1"){ ?>
            <tr>
                <th scope="row">10</th>
                <td>Laporan Laba/Rugi</td>
                <td><a href="javascript:;" data-toggle="modal" data-target="#modalLaba"><button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> Lihat</button></a></td>

            </tr>
        <?php } ?>

        </tbody>
    </table>

    <script src="<?php echo base_url();?>assets/lib/DataTable/jquery.dataTables.min.js">      </script>
    <script src="<?php echo base_url();?>assets/lib/DataTable/dataTables.bootstrap.min.js">      </script>
    <script>
        $('#table').dataTable();
        $('#bln').select2({
            dropdownParent: $('#modalBulan')
        });
        $('#thn').select2({
            dropdownParent: $('#modalTahun')
        });
        $('#bln-laba').select2({
            dropdownParent: $('#modalLaba')
        });
        $.ajax({
            url: 'showAllBank',
            async: false,
            dataType: 'json',
            success: function(data){
                var htmlPembayaran= '';

                $.each(data,function (i,item) {
                    htmlPembayaran += '<option value="'+item.id_bank+'">'+item.nama_bank+' ('+item.no_rek+')</option>';
                });
                $('#bank').append(htmlPembayaran);



            },
            error: function () {
                //alert("Something Wrong! Contact Administrator");
            }
        });
    </script>
