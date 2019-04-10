

  <body>

    <div class="container">
      <span class="header-text">Pembelian</span>&nbsp;<span>Barang</span>
      <span><a href="" class="btn btn-success right-side pull-right" data-toggle="modal" data-target="#modalBarang">Daftar Produk</a></span>
      <hr class="hr-top">
    </div>
<div class="container">
  
<div class="row">
  <form method="post" >
        <tr>
<?php
date_default_timezone_set('Asia/Jakarta');
$date = date('Y/m/d h:i:s');
?>


      <td>
            <div class="form-group col-md-2" >
              <label for="exampleInput1">Suplier</label>
              
              <select class="form-control" name="id_supplier" id="supplier" >
                <option value="">Pilih Supplier</option>
                
              </select>
            </div>
          </td>
        
      <td>

          <td>
            <input type="hidden" name="no_pembelian">
            <input type="hidden" name="tgl_pembelian">

            <div class="form-group col-md-2" id="kode_barang_div">
              <label for="exampleInput1">Kode Barang</label>
              <input type="text"  class="form-control" name="kode_barang" id="kode_barang">             
            </div>
          </td>
          
            <div class="form-group col-md-3" id="nama_barang_div">
              <label for="exampleInput1">Nama Barang</label>
              <input type="text" class="form-control" id="nama_barang" readonly>
            </div>
          </td>
          
           <td>
            <div class="form-group col-md-2" id="harga_div">
              <label for="exampleInput1">Harga</label>
              <input type="text" class="form-control" name="harga_barang" id="harga_barang" readonly>
            </div>
          </td>

          <td>
            <div class="form-group col-md-1" id="stok_div">
              <label for="exampleInput1">Stok</label>
              <input type="text" class="form-control" name="stock" id="stock" readonly>
            </div>
          </td>
         
          <td>
            <td>
            <div class="form-group col-md-1" id="jumlah_div">
              <label for="exampleInput1">Jumlah</label>
              <input type="text" class="form-control" name="qty"  id="jumlah">
            </div>
          </td>
            <div class="form-group col-md-1" id="add_div">
            <label for="exampleInput1">&nbsp;</label>
            <button type="submit" class="btn btn-info form-top" id="btn_add">Add</button>
          </div>
          </td>
        </tr>
  </form>
   
 </div>
    <table class="table table-bordered" >
      <thead>
        <tr class="active">
          <th>No Faktur</th>
          <th>Nama Barang</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>Opsi</th>
        </tr>
      </thead>
      <tbody id="content">
    
       </tbody>  
    </table>

    <!-- Modal -->
    <div id="myModalPenjualan" class="modal fade" role="dialog">
      <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Batalkan Transaksi</h4>
                  <input type="hidden" id="no_faktur_pembelian">
                  <input type="hidden" id="stock_pembelian">
                  <input type="hidden" id="kode_barang_pembelian">
              </div>
              <div class="modal-body" id="isi_modal_pembelian">

              </div>
              <div class="modal-footer">

                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="button" class="btn btn-danger" id="do_delete">Ya</button>
              </div>
          </div>

      </div>
  </div>

    <!-- end modal -->
      <div id="modalBarang" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg" style="width: 900px !important;">

          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Pilih Barang</h4>
              </div>
              <div class="modal-body">
                  <table class="table table-bordered" id="tableBarang">
                      <thead>
                      <tr class="active">
                          <th>Kode Barang</th>

                          <th>Nama Barang</th>

                          <th>Kategori Barang</th>
                          <th>Stok</th>

                          <th>Satuan</th>

                          <th id="action">Opsi</th>
                      </tr>
                      </thead>
                      <tbody id="contentBarang">




                      </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
          </div>

      </div>
  </div>
    <script src="<?php echo base_url();?>assets/lib/DataTable/jquery.dataTables.min.js">      </script>
  <script src="<?php echo base_url();?>assets/lib/DataTable/dataTables.bootstrap.min.js">      </script>


    <form method="post" action="<?php echo base_url().'index.php/administrator/totalItem' ?>">     
      <input type="hidden" name="id_supplier" id="id_supplier_e">
<div class="form-horizontal pull-right" id="transaksi">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-5 control-label">Total Belanja</label>
    <div class="col-sm-7">
      <input type="hidden" class="form-control" name="no_faktur_pembelian" id="no_faktur_pembelian_e" placeholder="">
      <input type="text" class="form-control" id="total_belanja" placeholder="">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-5 control-label">Subtotal</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="total_barang" id="sub_total" placeholder="" readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-5 control-label">Total</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="total_belanja" id="total"  placeholder="" readonly>
    </div>
  </div>
</div>
  

</div>  
<div class="container">
<div class="row col-md-3 pull-right">
<button type="submit" class="btn btn-info form-top" id="ok_btn">Ok</button>
</div>
</form>
<script>
  $("#supplier").keyup(function(){
    listitem();
  })
    
        $("#kode_barang" ).autocomplete({
        source: "<?php echo site_url('administrator/get_autocomplete/?');?>"
        });

        $('#kode_barang').on('keyup',function () {
            var id = $('#kode_barang').val();
            $.ajax({
                type: 'ajax',
                method: 'get',
                url: 'editbarang',
                async: 'false',
                data:{id:id},
                dataType: 'json',
                success: function (data) {
                      $('#nama_barang').val(data.nama_barang);
                      $('#harga_barang').val(data.harga_hpp);
                      $('#stock').val(data.stock);
                      
                },
                error: function () {
                    alert('error');
                }

            });
        });

        $('#jumlah').keyup(function () {
           var jumlah = parseInt($('#jumlah').val());
           var stok = parseInt($('#stock').val());

            if(jumlah = stok){

            }else{
                swal({
                    title: "Gagal",
                    text: "Masukan Jumlah yang Benar!",
                    icon: "warning"
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $('#jumlah').val("");
                        }

                    });
            }
        });

    //   $(document).on("click", "#edit", function(){
    //   var a = $(this).data('qty');
    //   var b = $(this).data('nama_barang');
    //   var c = $(this).data('id_penjualan');
    //  var d = $(this).data('ii');
    //   document.getElementById('del').innerHTML = '<a class="btn btn-danger" href="'+d+'">Ya</a>';
      
    //   document.getElementById("deletebarang").innerHTML = (b);
    //   document.getElementById("qty").innerHTML = (a);
    //   // document.getElementById('del').innerHTML = (c);
      
    // })


      function listitem(){
            var id = $('#supplier').val();
           
            $.ajax({
                url: 'getitem',
                data:{id_supplier:id},
                dataType: 'json',
                success: function(data){
                    var html= '';
                    var total_belanja = 0;
                    var sub_total = 0;
                    
                    if(data == false){
                        $('#transaksi').hide();
                        $('#ok_btn').hide();
                    }else{
                        $('#transaksi').show();
                        $('#ok_btn').show();
                    }
                    $.each(data,function (i,item) {
                     html += '<tr>'+
                         '<td>'+item.no_faktur_pembelian+'</td>'+
                         '<td>'+item.nama_barang+'</td>'+
                         '<td>'+item.qty+'</td>'+
                         '<td>'+item.harga_barang+'</td>'+
                         '<td><a href="javascript:;" class="btn btn-warning btn-xs item-delete" title="Batal" data="'+item.id_pembelian+'"><i class="glyphicon glyphicon-remove"></i> Batal</a></td>'+
                         '</tr>';
                     total_belanja += parseInt(item.harga_barang);
                     sub_total +=  parseInt(item.qty);
                     $('#no_faktur_pembelian_e').val(item.no_faktur_pembelian);
                     $('#tgl_pembelian_e').val(item.tgl_pembelian);
                    });
                    $('#content').html(html);
                    $('#total_belanja').val(total_belanja);
                    $('#sub_total').val(sub_total);
                    $('#total').val(total_belanja * sub_total);
                    $('#id_supplier_e').val(id);

                    // $('#no_faktur_pembelian_e').val(no_faktur_pembelian);
                    // $('#tgl_pembelian_e').val(tgl_pembelian);
                    // $('#id_pembelian_e').val(id_pembelian);
                },
                error: function () {
                    alert("Something Wrong! Contact Administrator");
                }
            });
        }
    listitem();



        $('#btn_add').click(function(e){
          e.preventDefault();
            var a= $('#kode_barang').val();
            var b= $('#nama_barang').val();
            var c= $('#harga_barang').val();
            var d= $('#stock').val();
            var e= $('#jumlah').val();
            var f= $('#supplier').val();
            $.ajax({
                type : "ajax",
                method :"post",
                url  : 'beli',
                dataType : "JSON",
                data : {id_supplier:f , kode_barang:a,harga_barang:c , stock:d , qty:e},
                success: function(data){
                  
                    $('[name="id_supplier"]').val();
                    $('[name="kode_barang"]').val("");
                    $('[name="harga_barang"]').val("");
                    $('[name="qty"]').val("");
                    $('[name="stock"]').val("");
                    $('#nama_barang').val("");
                    // $('#ModalaAdd').modal('hide');
                               toastr.success('Tambah Barang Berhasil', 'Sukses');
                                listitem();
                                                                                                
                },error: function () {
                toastr.error('Tambah Barang Gagal', 'Gagal');
            }
            });
           
            //return false;                      
        });

    $('#loading').hide();
        $.ajax({
            url: 'showAllSupplier',
            async: false,
            dataType: 'json',
            success: function(data){
                var html= '';

                $.each(data,function (i,item) {
                   html += '<option value="'+item.id_supplier+'">'+item.nama_supplier+'</option>';
                });
                $('#supplier').append(html);
                $('#supplier').select2();

            },
            error: function () {
                alert("Something Wrong! Contact Administrator");
            }
        });
        $('#kode_barang_div').hide();
        $('#nama_barang_div').hide();
        $('#stok_div').hide();
        $('#harga_div').hide();
        $('#jumlah_div').hide();
        $('#add_div').hide();
        $('#supplier').change(function () {
           var idSupplier = $('#supplier').val();
            if(idSupplier != ""){

                $.ajax({
                    type: 'ajax',
                    method: 'get',
                    url: 'editsupplier' ,
                    async: 'false',
                    data:{id:idSupplier},
                    dataType: 'json',

                    success: function (data) {
                        $('#kode_barang_div').show();
                        $('#nama_barang_div').show();
                        $('#stok_div').show();
                        $('#harga_div').show();
                        $('#jumlah_div').show();
                        $('#add_div').show();
                        $('#btn_add_div').show();

                    },
                    error: function () {
                        alert('Error');
                    }
                });                
            }else{
        $('#kode_barang_div').hide();
        $('#nama_barang_div').hide();
        $('#stok_div').hide();
        $('#harga_div').hide();
        $('#jumlah_div').hide();
        $('#add_div').hide();
            }
            listitem();
        });

$('#content').on('click','.item-delete',function () {
            var id = $(this).attr('data');
            $('#myModalPenjualan').modal('show');
            $.ajax({
                type: 'ajax',
                method: 'get',
                url: 'editPembelian' ,
                async: 'false',
                data:{id:id},
                dataType: 'json',
                success: function (data) {
                    var isi = '<p>Apakah anda yakin ingin membatalkan ?</p>';
                    $('#isi_modal_pembelian').html(isi);
                    $('#no_faktur_pembelian').val(data.id_pembelian);
                    $('#stock_pembelian').val(data.qty);
                    $('#kode_barang_pembelian').val(data.kode_barang);
                },
                error: function () {
                    alert('Error');
                }
            });
        });


          $('#do_delete').click(function () {
            var id = $('#no_faktur_pembelian').val();
            var stock = $('#stock_pembelian').val();
            var kode = $('#kode_barang_pembelian').val();
            $.ajax({
                type: 'ajax',
                method: 'get',
                url: 'deletePembelian' ,
                async: 'false',
                data:{id:id,stock:stock,kode_barang:kode},
                dataType: 'json',
                success: function (response) {

                     
                  if (response.success) {
                        $('#myModalPenjualan').modal('hide');
                        toastr.success('Proses Berhasil', 'Sukses');
                        listitem();
                     }
                    
                },
                error: function () {
                    alert('Error');
                }
            });
        });

 function GetAllBarang() {

            $.ajax({
                url: 'showAllBarang',
                async: false,
                dataType: 'json',
                success: function(data){
                    var html= '';

                    $.each(data,function (i,item) {

                            html += '<tr>' +
                                '<th scope="row">'+item.kode_barang+'</th>' +
                                '<td>'+item.nama_barang+'</td>' +
                                '<td>'+item.category_name+'</td>' +

                                '<td>'+item.stock+'</td>' +
                                '<td>'+item.satuan+'</td>' +
                                '<td name="action"><a href="javascript:;" class="btn btn-warning btn-xs item-select" title="Select" data="'+item.kode_barang+'"><i class="glyphicon glyphicon-import"></i> Pilih</a></td>\n' +
                                '</tr>';


                    });
                    $('#contentBarang').html(html);

                    $('#tableBarang').DataTable();
                },
                error: function () {
                    alert("Something Wrong! Contact Administrator");
                }
            });
        }

        GetAllBarang();

         $('#contentBarang').on('click','.item-select',function () {
           $('#modalBarang').modal('hide');
           if($('#supplier').val() != ""){
               $('.select2-container').removeClass('has-error');
               $('#kode_barang').val($(this).attr('data'));
               $('#kode_barang').trigger('keyup');
           }else{
               $('.select2-container').addClass('has-error');
           }
        });

        // $('#nama_customer_baru').on('keyup',function () {
        //    $('#label_customer').val($(this).val());
        // });
        // $('#alamat_customer_baru').on('keyup',function () {
        //     $('#label_alamat').val($(this).val());
        // });

</script>
