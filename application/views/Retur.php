<body>
<div id="myModalPenjualan" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Batalkan Reture</h4>

                <input type="hidden" id="no_reture_delete">
            </div>
            <div class="modal-body" id="isi_modal_penjualan">

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="do_delete_penjualan">Ya</button>
            </div>
        </div>

    </div>
</div>
    <div class="container">
      <span class="header-text">Data </span>&nbsp;<span>Retur</span>
        <span><a href="<?php echo base_url()."index.php/administrator/returBarang"?>"><button class="btn btn-success right-side pull-right">Retur Barang</button></a></span>
      <hr class="hr-top">
    </div>
<div class="container">
  
<!--<div class="row">-->
<!--  <form class="horizontal">-->
<!--      <div class="form-group form-inline col-md-2" id="kode_barang_div">-->
<!--          <label for="exampleInput1">Kode Barang</label>-->
<!--          <input type="text" class="form-control" id="kode_barang" placeholder="" style="width: 100% !important;">-->
<!---->
<!--      </div>-->
<!---->
<!--      <div class="form-group col-md-2" id="nama_barang_div">-->
<!--          <label for="exampleInput1">Nama Barang</label>-->
<!--          <input type="text" class="form-control" id="nama_barang" readonly>-->
<!--      </div>-->
<!---->
<!---->
<!---->
<!--      <div class="form-group col-md-1" id="satuan_barang_div">-->
<!--          <label for="exampleInput1">Satuan</label>-->
<!--          <input type="text" class="form-control" id="satuan_barang" readonly>-->
<!--          <input type="hidden" id="diskon">-->
<!--      </div>-->
<!---->
<!--      <div class="form-group col-md-2" id="harga_div">-->
<!--          <label for="harga" id="harga_label">Harga</label>-->
<!--          <input type="text" class="form-control" id="harga" readonly>-->
<!--      </div>-->
<!---->
<!--      <div class="form-group col-md-1" id="jumlah_div">-->
<!--          <label for="exampleInput1">Jumlah</label>-->
<!--          <input type="text" class="form-control" id="jumlah" placeholder="">-->
<!--      </div>-->
<!---->
<!--      <div class="form-group col-md-2" id="keterangan_div">-->
<!--          <label for="harga" id="harga_label">Status</label>-->
<!--          <input type="text" class="form-control" id="status" placeholder="Kondisi Barang">-->
<!--      </div>-->
<!---->
<!--      <div class="form-group col-md-2" id="btn_add_div" style="width: 105px;">-->
<!--          <label for="exampleInput1">&nbsp;</label>-->
<!--          <button type="button" class="btn btn-info form-top" id="btn_add"><i class="fa fa-spinner fa-spin" style="margin-right: 5px" id="loading"></i></i>Retur</button>-->
<!--      </div>-->
<!--  </form>-->
<!--   -->
<!-- </div>-->
    <table class="table table-bordered" id="tableReture">
      <thead>
        <tr class="active">
            <th>No Reture</th>
          <th>Tanggal</th>
            <th>Kode Barang</th>
          <th>Nama Barang</th>

            <th>Harga</th>
            <th>Jumlah</th>
          <th>Subtotal</th>
            <th>Status</th>

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
        $.fn.dataTableExt.sErrMode = 'throw';
        $('#loading').hide();
        $('#nama_barang_div').hide();
        $('#satuan_barang_div').hide();
        $('#harga_div').hide();
        $('#jumlah_div').hide();
        $('#btn_add_div').hide();
        $('#keterangan_div').hide();



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



                        $('#nama_barang').val(data.nama_barang);
                        $('#satuan_barang').val(data.satuan);

                        $('#harga').val(data.harga_retail);




                    }
                    else{
                        $('#jumlah_div').hide();
                        $('#nama_barang').val("");
                        $('#stok_barang').val("");
                        $('#harga_label').text("Harga");
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

        function addReture(){

            var data = {
              kode_barang : $('#kode_barang').val(),
              jumlah: $('#jumlah').val(),
              harga: parseInt($('#harga').val()) * parseInt($('#jumlah').val()),
                status: $('#status').val()
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

                                toastr.success('Reture Barang Berhasil', 'Sukses');

                            showReture();

                            $('#loading').hide();
                        }else{
                            toastr.error('Proses Gagal', 'Error');
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
                url: 'showReture',
                async: false,
                dataType: 'json',
                success: function(data){
                    var html= '';

                    $.each(data,function (i,item) {

                            html += '<tr>' +
                                '<th scope="row">'+item.no_reture+'</th>' +
                                '<td>'+$.format.date(item.tgl_reture,"dd/MM/yyyy")+'</td>' +
                                '<td>'+item.kode_barang+'</td>' +
                                '<td>'+item.nama_barang+'</td>' +

                                '<td>'+item.harga_retail+'</td>' +
                                '<td>'+item.total_barang+'</td>' +
                                '<td>'+item.total_harga+'</td>' +
                                '<td>'+item.status+'</td>' +
                                '</tr>';



                    });
                    $('#content').html(html);


                    $('#tableReture').dataTable({
                            order: [ 0, 'desc' ]
                        });

                },
                error: function () {

                }
            });
        }

        $('#content').on('click','.item-delete',function () {
            var id = $(this).attr('data');
            $('#myModalPenjualan').modal('show');
            $.ajax({
                type: 'ajax',
                method: 'get',
                url: 'editReture' ,
                async: 'false',
                data:{id:id},
                dataType: 'json',
                success: function (data) {
                    var isi = '<p>Apakah anda yakin ingin membatalkan ?</p>';
                    $('#isi_modal_penjualan').html(isi);

                    $('#no_reture_delete').val(data.no_reture);
                },
                error: function () {
                    alert('Error');
                }
            });
        });
        $('#do_delete_penjualan').click(function () {
            var id = $('#no_reture_delete').val();

            $.ajax({
                type: 'ajax',
                method: 'get',
                url: 'deleteReture' ,
                async: 'false',
                data:{id:id},
                dataType: 'json',
                success: function (response) {

                    if(response.success){

                        $('#myModalPenjualan').modal('hide');
                        toastr.success('Proses Berhasil', 'Sukses');

                        showReture();

                    }

                },
                error: function () {
                    alert('Error');
                }
            });
        });

        showReture();

    });

</script>