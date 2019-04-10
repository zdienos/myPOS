<style>
    .select2-container{
        width: 100% !important;
    }
</style>
<body>

  <div class="container">
      <span class="header-text">Data</span>&nbsp;<span>Barang</span>
      <span><a target="_blank" href="<?php echo base_url()."index.php/administrator/printLabel"?>" class="btn btn-warning right-side pull-right" id="btn-export" style="margin-left: 5px"><i class="glyphicon glyphicon-barcode"></i> Export Barcode</a>
      <button class="btn btn-success right-side pull-right" id="btn-add"><i class="glyphicon glyphicon-plus"></i> Tambah Barang</button>
      </span>

      <hr class="hr-top">
  </div>
  <div class="container">
    <input type="hidden" id="session" value="<?php echo  $this->session->userdata('akses');?>">


      <table class="table table-bordered top" id="tableBarang">
              <thead>
              <tr class="active">
                  <th>Kode Barang</th>

                  <th>Nama Barang</th>

                  <th>Kategori Barang</th>
                  <th>Stok</th>

                  <th>Satuan</th>

                  <th id="action">Action</th>
              </tr>
              </thead>
              <tbody id="content">




              </tbody>
    </table>

<?php
$this->load->view('modal');
?>

    <script src="<?php echo base_url();?>assets/lib/DataTable/jquery.dataTables.min.js">      </script>
    <script src="<?php echo base_url();?>assets/lib/DataTable/dataTables.bootstrap.min.js">      </script>
    <script src="<?php echo base_url();?>assets/lib/Number/number.js">      </script>
    <script>
        $("#stok_barang").inputFilter(function(value) {
            return /^\d*$/.test(value);
        });
        $("#berat_barang").inputFilter(function(value) {
            return /^\d*$/.test(value);
        });

        function GetAllBarang() {

            $.ajax({
                url: 'showAllBarang',
                async: false,
                dataType: 'json',
                success: function(data){
                    var html= '';
                    var htmlBarcode='';
if(data.length == null){
    $('#btn-export').hide();
}else{
    $('#btn-export').show();
}
                    $.each(data,function (i,item) {

                       if($('#session').val() == 1){
                        html += '<tr>' +
                            '<th scope="row">'+item.kode_barang+'</th>' +
                            '<td>'+item.nama_barang+'</td>' +

                            '<td>'+item.category_name+'</td>' +
                            '<td>'+item.stock+'</td>' +
                            '<td>'+item.satuan+'</td>' +
                            '<td name="action"><a href="javascript:;" class="btn btn-primary btn-xs item-detail" title="Detail" data="'+item.kode_barang+'"><i class="glyphicon glyphicon-info-sign"></i></a> <a href="javascript:;" class="btn btn-info btn-xs item-edit" title="Edit" data="'+item.kode_barang+'"><i class="glyphicon glyphicon-edit"></i></a> <a href="javascript:;" class="btn btn-danger btn-xs item-delete" title="Hapus" data="'+item.kode_barang+'"><i class="glyphicon glyphicon-trash"></i></a> <a target="_blank" href="<?php echo base_url()."index.php/administrator/printLabelById/"?>'+item.kode_barang+'" class="btn btn-warning btn-xs item-print" title="Print" ><i class="glyphicon glyphicon-barcode"></i></a></td>\n' +
                            '</tr>';

                       }else{
                           html += '<tr>' +
                               '<th scope="row">'+item.kode_barang+'</th>' +
                               '<td>'+item.nama_barang+'</td>' +

                               '<td>'+item.category_name+'</td>' +
                               '<td>'+item.stock+'</td>' +
                               '<td>'+item.satuan+'</td>' +
                               '<td name="action"><a href="javascript:;" class="btn btn-primary btn-xs item-detail" title="Detail" data="'+item.kode_barang+'"><i class="glyphicon glyphicon-info-sign"></i></a> <a target="_blank" href="<?php echo base_url() . "index.php/administrator/printLabelById/"?>'+item.kode_barang+'" class="btn btn-warning btn-xs item-print" title="Print"><i class="glyphicon glyphicon-barcode"></i></a></td>\n' +
                               '</tr>';

                       }
                        htmlBarcode += '<th><img src="<?php echo base_url()?>/'+item.barcode+'"></th>';

                    });
                    $('#content').html(html);
                    $('#barcode_list_content').html(htmlBarcode);

                    $('#tableBarang').DataTable();

                },
                error: function () {
                    alert("Something Wrong! Contact Administrator");
                }
            });
        }
        function GetAllCategory(){
            $.ajax({
                url: 'getCategory',
                async: false,
                dataType: 'json',
                success: function(data){
                    var html= '';

                    $.each(data,function (i,item) {

                    html += '<option value="'+item.id_category+'">'+item.category_name+'</option>';
                    });

                    $('#category_barang').html(html);
                    $('#category_barang').select2({
                        dropdownParent: $('#exampleModal')
                    });

                },
                error: function () {
                    alert("Something Wrong! Contact Administrator");
                }
            });
        }



        function GetAllSupplier(){
            $.ajax({
                url: 'getSupplier',
                async: false,
                dataType: 'json',
                success: function(data){
                    var html= '';

                    $.each(data,function (i,item) {

                        html += '<option value="'+item.id_supplier+'">'+item.nama_supplier+'</option>';
                    });

                    $('#id_supplier').html(html);
                    $('#id_supplier').select2({
                        dropdownParent: $('#exampleModal')
                    });

                },
                error: function () {
                    alert("Something Wrong! Contact Administrator");
                }
            });
        }
        $(function () {
    GetAllBarang();
    GetAllCategory();
    GetAllSupplier();

    $('#loading').hide();

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    var session = $('#session').val();
    if(session == "2"){
        $('#btn-add').hide();



    }else{
        $('#btn-add').show();

    }

    //Buton Tambah
    $('#btn-add').click(function () {
       $('#exampleModal').modal('show');
        $('#exampleModal').find('.modal-title').text('Input Barang');
        $('#myForm').attr('action','<?php echo base_url()?>index.php/administrator/addBarang');
        $('#myForm')[0].reset();
        $('#barcode_content').hide();
        $('#kode_barang').val('');
        var kodeBarang = $('#kode_barang');
        var namaBarang = $('#nama_barang');
        var jenisBarang = $('#jenis_barang');
        var sortBarang = $('#category_barang');
        var stokBarang = $('#stok_barang');
        var satuanBarang = $('#satuan_barang');
        var harga_hpp = $('#harga_asli_hpp');
        var harga_retail = $('#harga_asli_retail');
        var harga_dropship = $('#harga_asli_dropship');
        var harga_grosir = $('#harga_asli_grosir');
        $('#diskon').val("");

$('#diskon').trigger('change');


        namaBarang.removeAttr('readonly');
        jenisBarang.removeAttr('readonly');
        sortBarang.removeAttr('disabled');
        stokBarang.removeAttr('readonly');
        satuanBarang.removeAttr('readonly');
        $('#harga_hpp').removeAttr('readonly');
        $('#harga_retail').removeAttr('readonly');
        $('#harga_dropship').removeAttr('readonly');
        $('#harga_grosir').removeAttr('readonly');
        $('#diskon').removeAttr('readonly');

        $('#diskon_convert').removeClass('has-error').removeAttr('readonly');
        $('#id_supplier').removeClass('has-error').removeAttr('disabled');

        $('#berat_barang').removeAttr('readonly');
        $('#simpan').show();
    });

    //Proses Tambah
    $('#simpan').click(function () {
        $('#loading').show();
        var url = $('#myForm').attr('action');
        //validasi form
        var namaBarang = $('#nama_barang');

        var sortBarang = $('#category_barang');
        var stokBarang = $('#stok_barang');
        var satuanBarang = $('#satuan_barang');
        var harga_hpp = $('#harga_asli_hpp');
        var harga_retail = $('#harga_asli_retail');
        var harga_dropship = $('#harga_asli_dropship');
        var harga_grosir = $('#harga_asli_grosir');
        var diskon = $('#diskon');


        var result = 0;
        if(namaBarang.val() == ''){
            namaBarang.addClass('has-error');
        }else{
            namaBarang.removeClass('has-error');
            result += 1;
        }

        if(sortBarang.val() == ''){
            sortBarang.addClass('has-error');
        }else{
            sortBarang.removeClass('has-error');
            result += 1;
        }
        if(stokBarang.val() == ''){
            stokBarang.addClass('has-error');
        }else{
            stokBarang.removeClass('has-error');
            result += 1;
        }
        if(satuanBarang.val() == ''){
            satuanBarang.addClass('has-error');
        }else{
            satuanBarang.removeClass('has-error');
            result += 1;
        }
        if(harga_hpp.val() == ''){
            $('#harga_hpp').addClass('has-error');
        }else{
            $('#harga_hpp').removeClass('has-error');
            result += 1;
        }
        if(harga_retail.val() == ''){
            $('#harga_retail').addClass('has-error');
        }else{
            $('#harga_retail').removeClass('has-error');
            result += 1;
        }
        if(harga_dropship.val() == ''){
            $('#harga_dropship').addClass('has-error');
        }else{
            $('#harga_dropship').removeClass('has-error');
            result += 1;
        }
        if(harga_grosir.val() == ''){
            $('#harga_grosir').addClass('has-error');
        }else{
            $('#harga_grosir').removeClass('has-error');
            result += 1;
        }
        if(diskon.val() == ''){
            $('#diskon').addClass('has-error');
        }else{
            $('#diskon').removeClass('has-error');
            result += 1;
        }
        if($('#berat_barang').val() == ''){
            $('#berat_barang').addClass('has-error');
        }else{
            $('#berat_barang').removeClass('has-error');
            result += 1;
        }

        var data = {
        kode_barang : $('#kode_barang').val(),
        nama_barang : namaBarang.val(),

        category_barang : sortBarang.val(),
        stok_barang : stokBarang.val(),
        satuan_barang : satuanBarang.val(),
        harga_hpp : harga_hpp.val(),
        harga_retail:harga_retail.val(),
        harga_dropship : harga_dropship.val(),
        harga_grosir: harga_grosir.val(),
        diskon: diskon.val(),

        berat_barang: $('#berat_barang').val(),
        id_supplier: $('#id_supplier').val()

        };

       if(result == 10){
       $.ajax({
          type: 'ajax',
          method: 'post',
           url: url,
           data:data,
           async: false,
           dataType: 'json',
           success: function (response) {
              if(response.success){
                  $('#exampleModal').modal('hide');
                  $('#myForm')[0].reset();
                  if($('#kode_barang').val() != ""){
                      toastr.success('Edit Barang Berhasil', 'Sukses');
                  }else{
                  toastr.success('Tambah Barang Berhasil', 'Sukses');
                  }
                  GetAllBarang();

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
       else{
           $('#loading').hide();
       }


    });

    //Button Edit Detail Delete

    $('#content').on('click','.item-edit',function () {

        var id = $(this).attr('data');



        $('#exampleModal').modal('show');
        $('#exampleModal').find('.modal-title').text('Edit Barang');
        $('#myForm').attr('action','<?php echo base_url()?>index.php/administrator/updateBarang');
        $('#barcode_content').show();
        var kodeBarang = $('#kode_barang');
        var namaBarang = $('#nama_barang');

        var sortBarang = $('#category_barang');
        var stokBarang = $('#stok_barang');
        var satuanBarang = $('#satuan_barang');
        var harga_hpp = $('#harga_asli_hpp');
        var harga_retail = $('#harga_asli_retail');
        var harga_dropship = $('#harga_asli_dropship');
        var harga_grosir = $('#harga_asli_grosir');

        namaBarang.removeClass('has-error').removeAttr('readonly');

        sortBarang.removeClass('has-error').removeAttr('disabled');
        stokBarang.removeClass('has-error').removeAttr('readonly');
        satuanBarang.removeClass('has-error').removeAttr('readonly');
        $('#harga_hpp').removeClass('has-error').removeAttr('readonly');
        $('#harga_retail').removeClass('has-error').removeAttr('readonly');
        $('#harga_dropship').removeClass('has-error').removeAttr('readonly');
        $('#harga_grosir').removeClass('has-error').removeAttr('readonly');

        $('#diskon').removeClass('has-error').removeAttr('readonly');


        $('#diskon_convert').removeClass('has-error').removeAttr('readonly');
        $('#id_supplier').removeClass('has-error').removeAttr('disabled');

        $('#berat_barang').removeClass('has-error').removeAttr('readonly')
        $('#simpan').show();

        $.ajax({
            type: 'ajax',
            method: 'get',
            url: 'editBarang' ,
            async: 'false',
            data:{id:id},
            dataType: 'json',
            success: function (data) {

                var diskon = data.diskon * 100;
                kodeBarang.val(data.kode_barang);
                namaBarang.val(data.nama_barang);

                sortBarang.val(data.id_category).trigger('change');
                stokBarang.val(data.stock);
                satuanBarang.val(data.satuan);
                $('#diskon').val(diskon);

                var diskon = data.diskon;
                kodeBarang.val(data.kode_barang);
                namaBarang.val(data.nama_barang);
                $('#id_supplier').val(data.id_supplier).trigger('change');
                sortBarang.val(data.id_category).trigger('change');
                stokBarang.val(data.stock);
                satuanBarang.val(data.satuan);
                $('#diskon').val(diskon).trigger('change');

                harga_hpp.val(data.harga_hpp).trigger('change');
                harga_retail.val(data.harga_retail).trigger('change');
                harga_dropship.val(data.harga_dropship).trigger('change');
                harga_grosir.val(data.harga_grosir).trigger('change');
                $('#berat_barang').val(data.berat);
                $('#barcode').attr('src','<?php echo base_url()?>/'+data.barcode);
            },
            error: function () {
                alert('Error');
            }
        });
    });

    $('#content').on('click','.item-detail',function () {

        var id = $(this).attr('data');



        $('#exampleModal').modal('show');
        $('#exampleModal').find('.modal-title').text('Detail Barang');
        $('#barcode_content').show();
        $('#myForm').attr('action','<?php echo base_url()?>index.php/administrator/updateBarang');
        var kodeBarang = $('#kode_barang');
        var namaBarang = $('#nama_barang');
        var jenisBarang = $('#jenis_barang');
        var sortBarang = $('#category_barang');
        var stokBarang = $('#stok_barang');
        var satuanBarang = $('#satuan_barang');
        var harga_hpp = $('#harga_asli_hpp');
        var harga_retail = $('#harga_asli_retail');
        var harga_dropship = $('#harga_asli_dropship');
        var harga_grosir = $('#harga_asli_grosir');

        namaBarang.removeClass('has-error').attr('readonly','readonly');
        jenisBarang.removeClass('has-error').attr('readonly','readonly');
        sortBarang.removeClass('has-error').attr('disabled','disabled');
        stokBarang.removeClass('has-error').attr('readonly','readonly');
        satuanBarang.removeClass('has-error').attr('readonly','readonly');
        $('#diskon').removeClass('has-error').attr('readonly','readonly');
        $('#harga_hpp').removeClass('has-error').attr('readonly','readonly');
        $('#harga_retail').removeClass('has-error').attr('readonly','readonly');
        $('#harga_dropship').removeClass('has-error').attr('readonly','readonly');
        $('#harga_grosir').removeClass('has-error').attr('readonly','readonly');
        $('#berat_barang').removeClass('has-error').attr('readonly','readonly');

        $('#id_supplier').removeClass('has-error').attr('disabled','disabled');
        $('#diskon_convert').removeClass('has-error').attr('readonly','readonly');

        $('#simpan').hide();

        $.ajax({
            type: 'ajax',
            method: 'get',
            url: 'editBarang' ,
            async: 'false',
            data:{id:id},
            dataType: 'json',
            success: function (data) {


                var diskon = data.diskon;

                kodeBarang.val(data.kode_barang);
                namaBarang.val(data.nama_barang);
                sortBarang.val(data.id_category).trigger('change');

                stokBarang.val(data.stock);
                satuanBarang.val(data.satuan);

                $('#diskon').val(diskon).trigger('change');

                harga_hpp.val(data.harga_hpp).trigger('change');
                harga_retail.val(data.harga_retail).trigger('change');
                harga_dropship.val(data.harga_dropship).trigger('change');
                harga_grosir.val(data.harga_grosir).trigger('change');
                $('#berat_barang').val(data.berat);
                $('#barcode').attr('src','<?php echo base_url()?>/'+data.barcode);
            },
            error: function () {
                alert('Error');
            }
        });
    });

    $('#content').on('click','.item-delete',function () {
        var id = $(this).attr('data');
        $('#myModal').modal('show');
        $.ajax({
            type: 'ajax',
            method: 'get',
            url: 'editBarang' ,
            async: 'false',
            data:{id:id},
            dataType: 'json',
            success: function (data) {

                var isi = '<p>Apakah anda yakin ingin menghapus data '+data.nama_barang+' ?</p>';
                $('#isi_modal').html(isi);
                $('#kode_barang_delete').val(data.kode_barang);
            },
            error: function () {
                alert('Error');
            }
        });
    });

    $('#do_delete').click(function () {
      var id = $('#kode_barang_delete').val();
        $.ajax({
            type: 'ajax',
            method: 'get',
            url: 'deleteBarang' ,
            async: 'false',
            data:{id:id},
            dataType: 'json',
            success: function (response) {

                if(response.success){

                    $('#myModal').modal('hide');
                        toastr.success('Hapus Barang Berhasil', 'Sukses');

                    GetAllBarang();

                }

            },
            error: function () {

            }
        });
 


});
});

    </script>
