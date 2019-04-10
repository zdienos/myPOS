<body>

<div class="container">
    <span class="header-text">Retur</span>&nbsp;<span>Barang</span>
    <span><a href="<?php echo base_url()."index.php/administrator/Retur"?>"><button class="btn btn-success right-side pull-right">Data Retur</button></a></span>
    <hr class="hr-top">
</div>
<div class="container">

    <div class="row">
        <form class="horizontal">
            <div class="form-group col-md-2">
                <label for="exampleInput1">No Faktur</label>
                <!--          <input type="text" class="form-control" id="customer" placeholder="">-->
                <select class="form-control" id="no_faktur">
                    <option value="">Pilih No Faktur</option>
                </select>
            </div>
            <div class="form-group form-inline col-md-2" id="kode_barang_div">
                <label for="exampleInput1">Kode Barang</label>
                <input type="text" class="form-control" id="kode_barang" placeholder="" style="width: 100% !important;" readonly>

            </div>

            <div class="form-group col-md-2" id="nama_barang_div">
                <label for="exampleInput1">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" readonly>
            </div>





            <div class="form-group col-md-2" id="jumlah_div">
                <label for="exampleInput1" id="label_jumlah">Jumlah</label>
                <input type="text" class="form-control" id="jumlah" placeholder="">
                <input type="hidden" id="jumlah_asli">
                <input type="hidden" class="form-control" id="harga">
                <input type="hidden" id="id_penjualan">
            </div>

            <div class="form-group col-md-2" id="keterangan_div">
                <label for="harga" id="harga_label">Status</label>
<!--                <input type="text" class="form-control" id="status" placeholder="Kondisi Barang">-->
                <select class="form-control" id="status">
                    <option value="baik">Dikembalikan</option>
                    <option value="rusak">Rusak</option>
                </select>
            </div>

            <div class="form-group col-md-2" id="btn_add_div" style="width: 105px;">
                <label for="exampleInput1">&nbsp;</label>
                <button type="button" class="btn btn-info form-top" id="btn_add"><i class="fa fa-spinner fa-spin" style="margin-right: 5px" id="loading"></i></i>Retur</button>
            </div>
        </form>

    </div>
    <table class="table table-bordered" id="tableReture">
        <thead>
        <tr class="active">
            <th>No Faktur</th>
            <th>Customer</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Sub Total</th>
            <th>Opsi</th>
        </tr>
        </thead>
        <tbody id="content">

        </tbody>
    </table>

    <script src="<?php echo base_url();?>assets/lib/DataTable/jquery.dataTables.min.js">      </script>
    <script src="<?php echo base_url();?>assets/lib/DataTable/dataTables.bootstrap.min.js">      </script>
    <script src="<?php echo base_url();?>assets/lib/JqueryDate/jquery-dateformat.min.js">      </script>

    <script>
        $(document).ready(function () {
            getPenjualan();
            $('#loading').hide();
            $('#nama_barang_div').hide();
            $('#satuan_barang_div').hide();
            $('#harga_div').hide();
            $('#jumlah_div').hide();
            $('#btn_add_div').hide();
            $('#keterangan_div').hide();
            $('#kode_barang_div').hide();


            $('#kode_barang').focus();

            $('#kode_barang').on('keyup',function () {
                var id = $(this).val();
                $.ajax({
                    type: 'ajax',
                    method: 'get',
                    url: 'editBarang' ,
                    async: 'false',
                    data:{id:id},
                    dataType: 'json',
                    success: function (data) {

                        if(data != false){
                            $('#nama_barang_div').show();
                            $('#satuan_barang_div').show();
                            $('#harga_div').show();
                            $('#jumlah_div').show();
                            $('#btn_add_div').show();
                            $('#keterangan_div').show();
                            $('#kode_barang_div').show();


                            $('#nama_barang').val(data.nama_barang);
                            $('#satuan_barang').val(data.satuan);





                        }
                        else{
                            $('#jumlah_div').hide();
                            $('#nama_barang').val("");
                            $('#stok_barang').val("");
                            $('#harga').val("");
                            $('#diskon').val("");
                            $('#jumlah').val("");
                            $('#satuan_barang').val("");
                        }
                    },
                    error: function () {
                        alert('Error');
                    }
                });
            });

            $( "#kode_barang" ).autocomplete({
                source: "<?php echo site_url('administrator/get_autocomplete/?');?>"
            });

            $("#kode_barang").keypress(function(e){
                if(e.which==13){
                    $("#jumlah").focus();

                }
            });

            $("#jumlah").keypress(function(e){
                if(e.which==13){
                    $("#status").focus();

                }
            });
            $("#status").keypress(function(e){
                if(e.which==13){
                    addReture();

                }
            });

            $('#btn_add').click(function () {
                addReture();

            });

            $('#no_faktur').change(function () {
               var id = $('#no_faktur').val();
               if(id != ""){
                   showReture();
               }
               else{
                   $('#content').empty();
               }
                $('#nama_barang_div').hide();
                $('#satuan_barang_div').hide();
                $('#harga_div').hide();
                $('#jumlah_div').hide();
                $('#btn_add_div').hide();
                $('#keterangan_div').hide();
                $('#kode_barang_div').hide();
            });

            function addReture(){

                var data = {
                    kode_barang : $('#kode_barang').val(),
                    jumlah: $('#jumlah').val(),
                    harga: parseInt($('#harga').val()) * parseInt($('#jumlah').val()),
                    status: $('#status').val(),
                    no_faktur: $('#no_faktur').val(),
                    id_penjualan : $('#id_penjualan').val()
                };
                var result = 0;
                if(data.kode_barang != ""){
                    $('#kode_barang').removeClass("has-error");
                    result += 1;
                }else{
                    $('#kode_barang').addClass("has-error");
                }
                if(data.jumlah != ""){
                    $('#jumlah').removeClass("has-error");
                    result += 1;
                }else{
                    $('#jumlah').addClass("has-error");
                }
                if(data.harga != 0){
                    $('#harga').removeClass("has-error");
                    result += 1;
                }else{
                    $('#harga').addClass("has-error");
                }
                if(data.status != ""){
                    $('#status').removeClass("has-error");
                    result += 1;
                }else{
                    $('#status').addClass("has-error");
                }

                if(result == 4){
                    $('#loading').show();
                    $.ajax({
                        type: 'ajax',
                        method: 'post',
                        url: "addReture",
                        data:data,
                        async: false,
                        dataType: 'json',
                        success: function (response) {
                            if(response.success){

                                $('#kode_barang').val("");
                                $('#jumlah_div').hide();
                                $('#nama_barang').val("");
                                $('#stok_barang').val("");
                                $('#harga_label').text("Harga");
                                $('#harga').val("");
                                $('#diskon').val("");
                                $('#jumlah').val("");
                                $('#satuan_barang').val("");

                                $('#nama_barang_div').hide();
                                $('#satuan_barang_div').hide();
                                $('#harga_div').hide();
                                $('#jumlah_div').hide();
                                $('#btn_add_div').hide();
                                $('#keterangan_div').hide();
                                $('#kode_barang_div').hide();

                                toastr.success('Retur Barang Berhasil', 'Sukses');

                                $('#no_faktur').trigger('change');

                                $('#loading').hide();
                            }else{
                                toastr.error('Proses Gagal', 'Error');
                                $('#loading').hide();
                            }
                        },
                        error: function () {
                            toastr.error('Proses Gagal', 'Error');
                        }
                    });
                }

            }

            function showReture(){
                $.ajax({
                    url: 'showReturPenjualan',
                    async: false,
                    data:{no_faktur:$('#no_faktur').val()},
                    dataType: 'json',
                    success: function(response){
                        var html= '';

                        $.each(response,function (i,item) {

                            html += '<tr id="tr-'+item.id_penjualan+'">' +
                                '<th scope="row">'+item.no_faktur_penjualan+'</th>' +
                                '<td>'+item.nama_lengkap+'</td>' +
                                '<td>'+item.nama_barang+'</td>' +
                                '<td>'+item.qty+'</td>' +

                                '<td>'+item.sub_total_harga+'</td>' +
                                '<td><a href="javascript:;" class="btn btn-warning btn-xs item-select" title="Pilih" data-jumlah="'+item.qty+'" data-penjualan="'+item.id_penjualan+'" data-barang="'+item.kode_barang+'" data-harga="'+item.harga_barang+'"><i class="glyphicon glyphicon-import"></i> Pilih</a></td>'+
                                '</tr>';



                        });
                        $('#content').html(html);



                    },
                    error: function () {

                    }
                });
            }

            $('#content').on('click','.item-select',function () {
                var id_barang = $(this).attr('data-barang');
                var id_penjualan = $(this).attr('data-penjualan');
                $('#kode_barang').val(id_barang).trigger("keyup");
                $('#label_jumlah').text('Jumlah ('+$(this).attr('data-jumlah')+')');
                $('#jumlah_asli').val($(this).attr('data-jumlah'));
                $('#harga').val($(this).attr('data-harga'));
                $('#id_penjualan').val(id_penjualan);

            });



            function getPenjualan() {
                $.ajax({
                    url: 'showPenjualan',
                    async: false,
                    dataType: 'json',
                    success: function(data){
                        var html= '';

                        $.each(data,function (i,item) {

                            html += '<option value="'+item.no_faktur_penjualan+'">'+item.no_faktur_penjualan+'</option>';



                        });
                        $('#no_faktur').append(html);


                        $('#no_faktur').select2();

                    },
                    error: function () {

                    }
                });

            }
        });

    </script>