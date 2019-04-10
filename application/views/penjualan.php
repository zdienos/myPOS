<style>
    .select2-container{
        width: 100% !important;
    }
    .swal-text{
        text-align: center;
    }
</style>
<body>
  <div id="myModalPenjualan" class="modal fade" role="dialog">
      <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Batalkan Transaksi</h4>
                  <input type="hidden" id="no_faktur_penjualan">
                  <input type="hidden" id="stock_penjualan">
                  <input type="hidden" id="kode_barang_penjualan">
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

  <div id="myModalBayar" class="modal fade " role="dialog">
      <div class="modal-dialog" style="width: 900px !important;">

          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Pembayaran</h4>
<!--                  <input type="hidden" id="no_faktur_penjualan">-->
<!--                  <input type="hidden" id="stock_penjualan">-->
<!--                  <input type="hidden" id="kode_barang_penjualan">-->       
                  <input type="hidden" id="session_city" value="<?php echo  $this->session->userdata('city_id');?>">
              </div>         
              <div class="modal-body row" id="isi_modal_penjualan">
              <div class="col-md-6" id="div_col_one">
<form class="form-horizontal">
<div class="form-group row">
<label for="inputEmail3" class="col-sm-4 col-form-label">Nama</label>
<div class="col-sm-8">
<input type="text" class="form-control" id="nama_customer_baru" placeholder="Nama">
</div>
</div>

<div class="form-group row">
<label for="inputPassword3" class="col-sm-4 col-form-label">Email</label>
<div class="col-sm-8">
<input type="text" class="form-control" id="email_customer_baru" placeholder="Email">
</div>
</div>
<div class="form-group row">
<label for="inputPassword3" class="col-sm-4 col-form-label">Provinsi</label>
<div class="col-sm-8">
<select class="form-control" id="provinsi_customer_baru">
<option value="">--- Pilih Provinsi ---</option>

</select>
</div>
</div>
<div class="form-group row">
<label for="inputPassword3" class="col-sm-4 col-form-label">Kota</label>
<div class="col-sm-8">
<select class="form-control" id="kota_customer_baru">
<option value="">--- Pilih Kota ---</option>

</select>
</div>
</div>
<div class="form-group row">
<label for="inputPassword3" class="col-sm-4 col-form-label">Alamat</label>
<div class="col-sm-8">
    <input type="text" class="form-control" id="alamat_customer_baru" placeholder="Alamat">
</div>
</div>
<div class="form-group row">
<label for="inputPassword3" class="col-sm-4 col-form-label">No. Telp</label>
<div class="col-sm-8">
<input type="text" class="form-control" id="telpon_customer_baru" placeholder="Nomor Telepon">
</div>
</div>
</form>

              </div>
              <div class="col-md-6" id="div_col_two">               
                  <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">No Faktur</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" id="label_faktur" placeholder="No Faktur" readonly>
                      </div>
                  </div>


                  <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Customer</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" id="label_customer" placeholder="Customer" readonly>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Alamat</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" id="label_alamat" placeholder="Alamat" readonly>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Expedisi <i class="fa fa-spinner fa-spin" id="loading_expedisi"></i> </label>
                      <div class="col-sm-8">
                          <input type="hidden" id="berat">
                          <input type="hidden" id="provinsi">
                          <input type="hidden" id="kota">
                    <select class="form-control" id="label_expedisi" required>
                        <option value="">--- Pilih Expedisi ---</option>
                       <option value="0">None</option>
                        <option value="1">JNE (REG)</option>
                        <option value="2">JNE (OKE)</option>
                        <option value="3">POS Indonsia</option>
                        <option value="4">TIKI</option>
                    </select>
                          <input type="text" class="form-control" id="label_harga_expedisi_convert" placeholder="Harga Expedisi" readonly style="margin-top: 12px">
                          <input type="text" class="form-control" id="label_harga_expedisi" placeholder="Harga Expedisi" readonly style="margin-top: 12px">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Total Harga</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" id="label_total_harga" placeholder="Total Harga" readonly>
                          <input type="hidden" id="label_total_harga_asli">
                      </div>
                  </div>


                  <div class="form-group row">
                      <div class="col-sm-4">
                          <label for="inputEmail3" class="">Pembayaran</label>
                      </div>


                      <div class="col-sm-8">
                          <select class="form-control" id="select_pembayaran" required>
                              <option value="">--- Pilih Metode Pembayaran ---</option>
                              <option value="1">Cash</option>
                              <option value="2">Bank</option>
                              <option value="3">Termin</option>
                          </select>
                          <select class="form-control" id="method_pembayaran" required style="margin-top: 12px">
                              <option value="">--- Pilih Bank ---</option>

                          </select>
                          <input type="text" class="form-control" id="label_bayar" placeholder="Bayar" style="margin-top: 12px;">
                          <input type="text" class="form-control" id="label_bayar_termin" placeholder="Bayar" style="margin-top: 12px;">
<!--                          <label id="label_termin" class="control-label" style="margin-bottom: 0px !important;margin-top: 12px;">Tanggal Jatuh Tempo</label>-->
<!--                          <input type="date" class="form-control" id="label_date_termin" placeholder="Tanggal Jatuh Tempo">-->
                      </div>
                  </div>
              </div>
              </div>
              
              <div class="modal-footer">

                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="button" class="btn btn-primary" id="do_pembayaran"><i class="fa fa-spinner fa-spin" id="loading_pembayaran"></i> Proses</button>
              </div>          
</div>
      </div>
  </div>
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


    <div class="container">
      <span class="header-text">Penjualan</span>&nbsp;<span>Barang</span>
      <span><a href="" class="btn btn-success right-side pull-right" data-toggle="modal" data-target="#modalBarang">Daftar Produk</a></span>
      <hr class="hr-top">
    </div>

<div class="container">
  
<div class="row">
  <form class="horizontal" method="post">
      <div class="form-group col-md-2">
          <label for="exampleInput1">Customer</label>
<!--          <input type="text" class="form-control" id="customer" placeholder="">-->
          <select class="form-control" id="customer">
              <option value="">Pilih Customer</option>
              <option value="0">Customer Baru</option>
          </select>
          <input type="hidden" id="role_customer">
      </div>
            <div class="form-group form-inline col-md-2" id="kode_barang_div">
              <label for="exampleInput1">Kode Barang</label>
              <input type="text" class="form-control" id="kode_barang" placeholder="" style="width: 100% !important;">

            </div>

            <div class="form-group col-md-2" id="nama_barang_div">
              <label for="exampleInput1">Nama Barang</label>
              <input type="text" class="form-control" id="nama_barang" readonly>
            </div>
          

         
            <div class="form-group col-md-1" id="stok_barang_div">
              <label for="exampleInput1">Stok</label>
              <input type="text" class="form-control" id="stok_barang" readonly>
            </div>
         
            <div class="form-group col-md-2" id="harga_div">
              <label for="harga" id="harga_label">Harga</label>
              <input type="text" readonly class="form-control" id="harga_convert">
              <input type="hidden" class="form-control" id="harga">
                <input type="hidden" id="harga_barang_asli">
            </div>

      <div class="form-group col-md-2" id="diskon_div">
          <label for="harga" id="harga_label">Diskon</label>
          <input type="text" class="form-control" id="diskon_convert" value="" placeholder="Masukan Nilai Rupiah">
          <input type="hidden" class="form-control" id="diskon" value="0">
      </div>

      <div class="form-group col-md-1" id="jumlah_div">
          <label for="exampleInput1">Jumlah</label>
          <input type="text" class="form-control" id="jumlah" placeholder="">
      </div>

      <div class="container" id="add_div">
          <div class="col-md-1 pull-right row">
              <div class="form-group" id="btn_add_div">
                  <label for="exampleInput1">&nbsp;</label>
                  <button type="button" class="btn btn-info form-top" id="btn_add" style="margin-top: -30px;" ><i class="fa fa-spinner fa-spin" style="margin-right: 5px" id="loading"></i></i>Add</button>
              </div>
          </div>
      </div>
  
  </form>
   
 </div>
 <table class="table table-striped table-bordered" id="tableBarang">
      <thead>
        <tr class="active">
          <th>No Faktur</th>
          <th>Nama Barang</th>
          <th>Jumlah</th>
            <th>Harga</th>
            <th>Diskon</th>
          <th>Opsi</th>
        </tr>
      </thead>
      <tbody id="content">

      </tbody>
    </table>

    <div class="form-horizontal pull-right" id="transaksi">
        <form method="post">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-5 control-label">Total Belanja</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="total_belanja" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-5 control-label">Subtotal</label>
            <div class="col-sm-7">
                <input type="hidden" class="form-control" id="sub_total" readonly>
                <input type="text" class="form-control" id="sub_total_convert" readonly>
            </div>
        </div>
<!--            <div class="form-group">-->
<!--                <label for="inputEmail3" class="col-sm-5 control-label">Expedisi</label>-->
<!--                <div class="col-sm-7">-->
<!--                    <select class="form-control" id="expedisi">-->
<!--                        <option value="">- Pilih Expedisi -</option>-->
<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                <label for="inputEmail3" class="col-sm-5 control-label">Pembayaran</label>-->
<!--                <div class="col-sm-7">-->
<!--                   <select class="form-control" id="method_pembayaran">-->
<!--                    <option value="">- Metode -</option>-->
<!--                   </select>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--        <div class="form-group">-->
<!--            <label for="inputEmail3" class="col-sm-5 control-label">Total</label>-->
<!--            <div class="col-sm-7">-->
<!--                <input type="text" class="form-control" id="inputEmail3" placeholder="">-->
<!--            </div>-->
<!--        </div>-->
            <div class="form-group">
                <div class="col-sm-12 text-right">
                <button class="btn btn-primary" id="bayar" type="button">Bayar</button>
            </div>
            </div>
        </form>
    </div>

<!--    <div class="row col-md-3">-->
<!--<button type="button" class="btn btn-info form-top">Ok</button>-->
<!--</div>-->

  
</div>

  <script src="<?php echo base_url();?>assets/lib/DataTable/jquery.dataTables.min.js">      </script>
  <script src="<?php echo base_url();?>assets/lib/DataTable/dataTables.bootstrap.min.js">      </script>
    <script>
        // $('#customer').select2();
        $('#loading_expedisi').hide();
        $('#loading_pembayaran').hide();

        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split   		= number_string.split(','),
                sisa     		= split[0].length % 3,
                rupiah     		= split[0].substr(0, sisa),
                ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
        var rupiah = document.getElementById('label_bayar');
        var rupiah2 = document.getElementById('label_bayar_termin');
        rupiah.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, 'Rp. ');

        });
        rupiah2.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah2.value = formatRupiah(this.value, 'Rp. ');

        });

        function getCart(){
            var cusId = $('#customer').val();
           if(cusId == ""){
               $('#transaksi').hide();
               $('#content').empty();
           }
           else{
            $.ajax({
                url: 'showCart',
                async: false,
                data:{id_customer:cusId},
                dataType: 'json',
                success: function(data){
                    var html= '';
                    var total_belanja = 0;
                    var sub_total = 0;
                    var berat = 0;
                    if(data == false){
                        $('#transaksi').hide();
                    }else{
                        $('#transaksi').show();
                    }
                    $.each(data,function (i,item) {
                       
                     html += '<tr>'+
                             '<td>'+item.no_faktur_penjualan+'</td>'+
                         '<td>'+item.nama_barang+'</td>'+
                         '<td>'+item.qty+'</td>'+
                         '<td>'+formatRupiah(item.harga_barang, 'Rp. ')+'</td>'+
                         '<td>'+formatRupiah(item.diskon, 'Rp. ')+'</td>'+
                         '<td><a href="javascript:;" class="btn btn-warning btn-xs item-delete" title="Batal" data="'+item.id_penjualan+'"><i class="glyphicon glyphicon-remove"></i> Batal</a></td>'+
                         '</tr>';
                     total_belanja += parseInt(item.sub_total_harga);
                     sub_total +=  parseInt(item.qty);
                     var hitungBerat = parseInt(item.berat) * parseInt(item.qty);
                     berat += hitungBerat;
                     $('#label_faktur').val(item.no_faktur_penjualan);


                    });
                    $('#content').html(html);
                    $('#total_belanja').val(sub_total);
                    var toString = total_belanja.toString();
                    var convert = formatRupiah(toString, 'Rp. ');
                    $('#sub_total').val(total_belanja);
                    $('#sub_total_convert').val(convert);

                    $('#label_total_harga').val(convert);
                    $('#label_total_harga_asli').val(total_belanja);
                    $('#berat').val(berat);

                },
                error: function () {
                    alert("Something Wrong! Contact Administrator");
                }
            });
           }
        }

        //getCart();
        $('#transaksi').hide();
        $('#loading').hide();
        $.ajax({
            url: 'showAllCustomer',
            async: false,
            dataType: 'json',
            success: function(data){
                var html= '';

                $.each(data,function (i,item) {
                   html += '<option value="'+item.customer_id+'">'+item.nama_lengkap+' ('+item.nama_role+')</option>';
                });
                $('#customer').append(html);
                $('#customer').select2();

            },
            error: function () {
                alert("Something Wrong! Contact Administrator");
            }
        });

        function getBank(){
            $.ajax({
                url: 'showAllBank',
                async: false,
                dataType: 'json',
                success: function(data){
                    var htmlPembayaran= '';

                    $.each(data,function (i,item) {
                        htmlPembayaran += '<option value="'+item.id_bank+'">'+item.nama_bank+' ('+item.no_rek+')</option>';
                    });
                    $('#method_pembayaran').append(htmlPembayaran);



                },
                error: function () {
                    //alert("Something Wrong! Contact Administrator");
                }
            });
        }

        getBank();

        $('#kode_barang_div').hide();
        $('#nama_barang_div').hide();
        $('#stok_barang_div').hide();
        $('#harga_div').hide();
        $('#jumlah_div').hide();
        $('#btn_add_div').hide();
        $('#label_harga_expedisi').hide();
        $('#method_pembayaran').hide();
        $('#label_bayar').hide();
        $('#label_bayar_termin').hide();
        $('#label_date_termin').hide();
        $('#label_termin').hide();
        $('#diskon_div').hide();
        $('#add_div').hide();
        $('#label_harga_expedisi_convert').hide();


        $('#customer').change(function () {

           var idCustomer = $('#customer').val();
            if(idCustomer != ""){
                if(idCustomer != 0){
                $.ajax({
                    type: 'ajax',
                    method: 'get',
                    url: 'editCustomer' ,
                    async: 'false',
                    data:{id:idCustomer},
                    dataType: 'json',
                    success: function (data) {
                        $('#kode_barang_div').show();
                        $('#nama_barang_div').show();
                        $('#stok_barang_div').show();
                        $('#harga_div').show();
                        $('#div_col_one').hide();
                        $('#diskon_div').show();
                        $('#div_col_two').removeClass('col-md-6');
                        $('#div_col_two').addClass('col-md-12');
                        $('#myModalBayar').find($('.modal-dialog')).removeAttr('style');


                        $('#btn_add_div').show();
                        $.each(data,function (i,item) {
                           $('#role_customer').val(item.role_id);
                           $('#label_customer').val(item.nama_lengkap);
                           $('#label_alamat').val(item.alamat);

                           $('#provinsi').val(item.id_province);
                           $('#kota').val(item.id_city);
                        });




                    },
                    error: function () {

                    }
                });
                }else{
                    $('#kode_barang_div').show();
                    $('#nama_barang_div').show();
                    $('#stok_barang_div').show();
                    $('#harga_div').show();
                    $('#diskon_div').show();
                    $('#btn_add_div').show();
                    $('#role_customer').val("");
                    $('#label_customer').val("");
                    $('#label_alamat').val("");

                    $('#provinsi').val("");
                    $('#kota').val("");
                    $('#div_col_one').show();

                    $('#div_col_two').removeClass('col-md-12');
                    $('#div_col_two').addClass('col-md-6');
                    $('#myModalBayar').find($('.modal-dialog')).css('cssText','width: 900px !important');

                }


            }else{
                $('#kode_barang_div').hide();
                $('#nama_barang_div').hide();
                $('#stok_barang_div').hide();
                $('#harga_div').hide();
                $('#jumlah_div').hide();
                $('#btn_add_div').hide();
                $('#diskon_div').hide();

            }

            getCart();

        });


        $("#kode_barang" ).autocomplete({
            source: "<?php echo site_url('administrator/get_autocomplete/?');?>"
        });

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
                      $('#jumlah_div').show();
                      $('#add_div').show();
                      var role = $('#role_customer').val();
                      var harga = 0;
                      var harga_asli = 0;

                      $('#nama_barang').val(data.nama_barang);
                      $('#stok_barang').val(data.stock);

                      if(role == "3"){
                          $('#harga').val(data.harga_retail);
                          $('#harga_barang_asli').val(data.harga_retail);
                            harga = data.harga_retail;
                          harga_asli = data.harga_retail;
                      }else if(role == "4"){
                          $('#harga').val(data.harga_grosir);
                          $('#harga_barang_asli').val(data.harga_grosir);
                          harga = data.harga_grosir;
                          harga_asli = data.harga_grosir;
                      }else if(role == "5"){
                          $('#harga').val(data.harga_dropship);
                          $('#harga_barang_asli').val(data.harga_dropship);
                            harga = data.harga_dropship;
                          harga_asli = data.harga_dropship;
                      }else{
                          $('#harga').val(data.harga_retail);
                          $('#harga_barang_asli').val(data.harga_retail);
                          harga = data.harga_retail;
                          harga_asli = data.harga_retail;
                      }

                      if(data.diskon != 0){

                            $('#harga_label').text('Harga Barang');
                            $('#diskon').val(data.diskon);
                          var asli = document.getElementById('diskon');
                          var convert = document.getElementById('diskon_convert');

                          convert.value = formatRupiah(asli.value, 'Rp. ');
                      }else{
                          $('#harga_label').text("Harga Barang");
                          $('#harga').val(harga);
                          $('#diskon').val("");
                          var asli = document.getElementById('diskon');
                          var convert = document.getElementById('diskon_convert');

                          convert.value = formatRupiah(asli.value, 'Rp. ');
                      }
                      var asli = document.getElementById('harga');
                      var convert = document.getElementById('harga_convert');

                      convert.value = formatRupiah(asli.value, 'Rp. ');
                  }
                  else{
                      $('#jumlah_div').hide();
                      $('#nama_barang').val("");
                      $('#stok_barang').val("");
                      $('#harga_label').text("Harga");
                      $('#harga').val("");
                      $('#diskon').val("");
                      $('#jumlah').val("")
                  }
                },
                error: function () {

                }
            });
        });

        $("#kode_barang").keypress(function(e){
            if(e.which==13){
                $("#jumlah").focus();

            }
        });

        $('#jumlah').keyup(function () {
           var jumlah = parseInt($('#jumlah').val());
           var stok = parseInt($('#stok_barang').val());

            if(jumlah > stok){


                swal({
                    title: "Out of stock",
                    text: "Stok tidak mencukupi!\n"+
                    "Stok Saat Ini : "+stok+" ",
                    icon: "warning"
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $('#jumlah').val("");
                        }

                    });
            }
        });

        $('#btn_add').click(function () {


           $('#loading').show();
           var result = 0;
           var kode_barang = $('#kode_barang');
           var jumlah = $('#jumlah');
           if(kode_barang.val() != ""){
            result += 1;
            kode_barang.removeClass('has-error');
               $('#loading').show();
           }else{
               kode_barang.addClass('has-error');
               $('#loading').hide();
           }
           if(jumlah.val() != ''){
               result +=1;
               jumlah.removeClass('has-error');
               $('#loading').show();
           }
           else{
               jumlah.addClass('has-error');
               $('#loading').hide();
           }

           if(result == 2){
               $('#loading').show();
               var data = {
                   id_customer : $('#customer').val(),
                   kode_barang : $('#kode_barang').val(),
                   nama_barang: $('#nama_barang').val(),
                   stok : $('#stok_barang').val(),
                   harga : $('#harga').val(),
                   sub_total : parseInt($('#harga').val()) * parseInt($('#jumlah').val()),
                   jumlah : $('#jumlah').val(),
                   diskon: $('#diskon').val(),
                   harga_asli : $('#harga_barang_asli').val()
               };
               $.ajax({
                   type: 'ajax',
                   method: 'post',
                   url: "addToCart",
                   data:data,
                   async: false,
                   dataType: 'json',
                   success: function (response) {
                       if(response.success){
                               toastr.success('Tambah Barang Berhasil', 'Sukses');
                                getCart();
                           $('#loading').hide();
                           $('#kode_barang').val("");
                           $('#nama_barang').val("");
                           $('#stok_barang').val("");
                           $('#harga_label').text("Harga");
                           $('#harga').val("");
                           $('#jumlah').val("");
                           $('#diskon').val("");
                            $('#harga_convert').val("");
                            $('#diskon_convert').val("");
                           GetAllBarang();
                       }else{
                           toastr.error('Proses Gagal', 'Error');
                           $('#loading').hide();
                       }
                   },
                   error: function () {
                       toastr.error('Proses Gagal', 'Error');
                       $('#loading').hide();
                   }
               });
           }


        });

        $('#content').on('click','.item-delete',function () {
            var id = $(this).attr('data');
            $('#myModalPenjualan').modal('show');
            $.ajax({
                type: 'ajax',
                method: 'get',
                url: 'editPenjualan' ,
                async: 'false',
                data:{id:id},
                dataType: 'json',
                success: function (data) {
                    var isi = '<p>Apakah anda yakin ingin membatalkan ?</p>';
                    $('#isi_modal_penjualan').html(isi);
                    $('#no_faktur_penjualan').val(data.id_penjualan);
                    $('#stock_penjualan').val(data.qty);
                    $('#kode_barang_penjualan').val(data.kode_barang);
                },
                error: function () {

                }
            });
        });

        $('#do_delete_penjualan').click(function () {
            var id = $('#no_faktur_penjualan').val();
            var stock = $('#stock_penjualan').val();
            var kode = $('#kode_barang_penjualan').val();
            $.ajax({
                type: 'ajax',
                method: 'get',
                url: 'deletePenjualan' ,
                async: 'false',
                data:{id:id,stock:stock,kode_barang:kode},
                dataType: 'json',
                success: function (response) {

                    if(response.success){

                        $('#myModalPenjualan').modal('hide');
                        toastr.success('Proses Berhasil', 'Sukses');

                        getCart();
                        GetAllBarang();
                    }

                },
                error: function () {

                }
            });
        });

        $('#bayar').click(function () {
           $('#myModalBayar').modal('show');
        });

        $('#label_expedisi').change(function () {
            $('#loading_expedisi').show();
            var origin = $('#session_city').val();
            var weight = $('#berat').val();
            var destination = $('#kota').val();
            var expedisi = $('#label_expedisi').val();
            if(expedisi == ""){
                $('#label_harga_expedisi').hide();
                $('#label_total_harga').val($('#sub_total').val());
                $('#loading_expedisi').hide();
            }
            else if(expedisi == "1" || expedisi == "2"){

                $.ajax({
                    type: 'ajax',
                    method: 'get',
                    url: 'cekOngkir' ,
                    async: 'false',
                    data:{origin:origin,destination:destination,weight:weight,courier:'jne'},
                    dataType: 'json',
                    success: function (response) {
                    $.each(response.rajaongkir.results,function (i,item) {

                        $.each(item.costs,function (x,items){
                       if(expedisi == 1){
                        if(x == 0){
                            $.each(items.cost,function (x,item_cost) {
                                        // console.log(item_cost.value);
                                $('#label_harga_expedisi').val(item_cost.value);
                                var toString = item_cost.value.toString();
                                $('#label_harga_expedisi_convert').val(formatRupiah(toString,'Rp. '));

                                $('#label_harga_expedisi_convert').show();

                                var hasil = parseInt($('#label_total_harga_asli').val()) + item_cost.value;
                                var toString = hasil.toString();
                                var convert = formatRupiah(toString, 'Rp. ');
                                $('#label_total_harga').val(convert);

                            });
                        }
                       }if(expedisi == 2){
                        if(x == 1){
                            $.each(items.cost,function (x,item_cost) {
                                $('#label_harga_expedisi').val(item_cost.value);
                                var toString = item_cost.value.toString();
                                $('#label_harga_expedisi_convert').val(formatRupiah(toString,'Rp. '));

                                $('#label_harga_expedisi_convert').show();
                                var hasil = parseInt($('#label_total_harga_asli').val()) + item_cost.value;
                                var toString = hasil.toString();
                                var convert = formatRupiah(toString, 'Rp. ');
                                $('#label_total_harga').val(convert);
                            });
                        }
                            }
                        });
                    });
                        $('#loading_expedisi').hide();
                        if(response.rajaongkir.status.code == 400){
                            swal("Perhatian","Pilih Lokasi Terlebih Dahulu!","info");
                            $('#label_expedisi').val("");
                            $('#label_harga_expedisi').hide();
                        }

                    },
                    error: function () {
                        swal('Server Error','Check Your Internet Connection!','error');
                    }
                });
            }

            else if(expedisi == "3"){
                $.ajax({
                    type: 'ajax',
                    method: 'get',
                    url: 'cekOngkir' ,
                    async: 'false',
                    data:{origin:origin,destination:destination,weight:weight,courier:'pos'},
                    dataType: 'json',
                    success: function (response) {
                        $.each(response.rajaongkir.results,function (i,item) {

                            $.each(item.costs,function (x,items){


                                        $.each(items.cost,function (x,item_cost) {
                                            $('#label_harga_expedisi').val(item_cost.value);
                                            var toString = item_cost.value.toString();
                                            $('#label_harga_expedisi_convert').val(formatRupiah(toString,'Rp. '));

                                            $('#label_harga_expedisi_convert').show();
                                            var hasil = parseInt($('#label_total_harga_asli').val()) + item_cost.value;
                                            var toString = hasil.toString();
                                            var convert = formatRupiah(toString, 'Rp. ');
                                            $('#label_total_harga').val(convert);
                                        });

                            });
                        });
                        $('#loading_expedisi').hide();
                        if(response.rajaongkir.status.code == 400){
                            swal("Perhatian","Pilih Lokasi Terlebih Dahulu!","info");
                            $('#label_expedisi').val("");
                            $('#label_harga_expedisi').hide();
                        }
                    },
                    error: function () {
                        swal('Server Error','Check Your Internet Connection!','error');
                    }
                });
            }

            else if(expedisi == "4"){
                $.ajax({
                    type: 'ajax',
                    method: 'get',
                    url: 'cekOngkir' ,
                    async: 'false',
                    data:{origin:origin,destination:destination,weight:weight,courier:'tiki'},
                    dataType: 'json',
                    success: function (response) {
                        $.each(response.rajaongkir.results,function (i,item) {

                            $.each(item.costs,function (x,items){


                                $.each(items.cost,function (x,item_cost) {
                                    $('#label_harga_expedisi').val(item_cost.value);
                                    var toString = item_cost.value.toString();
                                    $('#label_harga_expedisi_convert').val(formatRupiah(toString,'Rp. '));

                                    $('#label_harga_expedisi_convert').show();
                                    var hasil = parseInt($('#label_total_harga_asli').val()) + item_cost.value;
                                    var toString = hasil.toString();
                                    var convert = formatRupiah(toString, 'Rp. ');
                                    $('#label_total_harga').val(convert);
                                });

                            });
                        });
                        $('#loading_expedisi').hide();
                        if(response.rajaongkir.status.code == 400){
                            swal("Perhatian","Pilih Lokasi Terlebih Dahulu!","info");
                            $('#label_expedisi').val("");
                            $('#label_harga_expedisi').hide();
                        }
                    },
                    error: function () {
                        swal('Server Error','Check Your Internet Connection!','error');
                    }
                });
            }
            else{
                $('#label_harga_expedisi').val(0);
                $('#label_harga_expedisi_convert').val("Rp. 0");
                $('#label_harga_expedisi_convert').show();
                var hasil = parseInt($('#label_total_harga_asli').val()) + 0;
                var toString = hasil.toString();
                var convert = formatRupiah(toString, 'Rp. ');
                $('#label_total_harga').val(convert);
                $('#loading_expedisi').hide();
            }
        });


        $('#do_pembayaran').click(function () {
        $('#loading_pembayaran').show();
    var expedisi = $('#label_expedisi');
    var harga_expedisi = $('#label_harga_expedisi');
    var pembayaran = $('#select_pembayaran');
    var bank = $('#method_pembayaran');
    var cash = $('#label_bayar');
    var nama_customer = $('#nama_customer_baru');
    var email = $('#email_customer_baru');
    var provinsi = $('#provinsi_customer_baru');
    var kota = $('#kota_customer_baru');
    var alamat = $('#alamat_customer_baru');
    var telp = $('#telpon_customer_baru');
    var label_termin = $('#label_bayar_termin');
    var label_date_termin = $('#label_date_termin');

    var result= 0;
            var customer = $('#customer').val();
            if(customer == "0"){
                if (expedisi.val() != "" && harga_expedisi != "") {
                    $('#label_expedisi').removeClass('has-error');
                    result += 1;

                } else {
                    $('#label_expedisi').addClass('has-error');
                    $('#loading_pembayaran').hide();
                }

                if (pembayaran.val() != "") {
                    pembayaran.removeClass('has-error');
                    result += 1;
                    if (pembayaran.val() == "1") {
                        if (cash.val() != "") {
                            cash.removeClass('has-error');
                            result += 1;
                        } else {
                            cash.addClass('has-error');
                            $('#loading_pembayaran').hide();
                        }
                    } else if (pembayaran.val() == "2") {
                        if (bank.val() != "") {
                            bank.removeClass('has-error');
                            result += 1;
                        } else {
                            bank.addClass('has-error');
                            $('#loading_pembayaran').hide();
                        }
                    }else if(pembayaran.val() == "3"){
                        if (label_termin.val() != "") {
                            label_termin.removeClass('has-error');
                            result += 1;
                        } else {
                            label_termin.addClass('has-error');
                            $('#loading_pembayaran').hide();
                        }if (label_date_termin.val() != "") {
                            label_date_termin.removeClass('has-error');
                            result += 1;
                        } else {
                            label_date_termin.addClass('has-error');
                            $('#loading_pembayaran').hide();
                        }
                    }
                } else {
                    pembayaran.addClass('has-error');
                    $('#loading_pembayaran').hide();
                }

                if(nama_customer.val() != ""){
                    nama_customer.removeClass('has-error');
                    result += 1;
                }else{
                    nama_customer.addClass('has-error');
                }

                if(email.val() != ""){
                    email.removeClass('has-error');
                    result += 1;
                }else{
                    email.addClass('has-error');
                }

                if(provinsi.val() != ""){
                    $('#select2-provinsi_customer_baru-container').removeClass('has-error');
                    result += 1;
                }else{
                    $('#select2-provinsi_customer_baru-container').addClass('has-error');
                }

                if(kota.val() != ""){
                    $('#select2-kota_customer_baru-container').removeClass('has-error');
                    result += 1;
                }else{
                    $('#select2-kota_customer_baru-container').addClass('has-error');
                }

                if(alamat.val() != ""){
                    alamat.removeClass('has-error');
                    result += 1;
                }else{
                    alamat.addClass('has-error');
                }

                if(telp.val() != ""){
                    telp.removeClass('has-error');
                    result += 1;
                }else{
                    telp.addClass('has-error');
                }

                var check_termin = 0;
                if(pembayaran.val() == "3"){
                    check_termin += 10;
                }else{
                    check_termin += 9;
                }

                if (result == check_termin) {
                    $('#loading_pembayaran').show();

                    var convert = parseInt(rupiah.value.replace(/[\. ,:-Rp]+/g, ""));
                    var convert2 = parseInt(rupiah2.value.replace(/[\. ,:-Rp]+/g, ""));
                    var totId = document.getElementById('label_total_harga').value.replace(/[\. ,:-Rp]+/g, "");
                    var totalHarga = parseInt(totId);

                    if ($('#select_pembayaran').val() == "1") {

                        if (convert < totalHarga) {
                            swal('Peringatan', 'Uang Tidak Cukup!', 'info');
                            $('#loading_pembayaran').hide();

                        } else {
                            var sisa = convert - totalHarga;
                            var data = {
                                no_penjualan: $('#label_faktur').val(),
                                total_barang: $('#total_belanja').val(),
                                expedisi: $('#label_expedisi').val(),
                                biaya_expedisi: $('#label_harga_expedisi').val(),
                                total_harga: totalHarga,
                                customer_id: $('#customer').val(),
                                method_pembayaran: $('#select_pembayaran').val(),
                                total_bayar: convert,
                                total_kembali: sisa,
                                id_bank: $('#method_pembayaran').val(),
                                nama_customer: nama_customer.val(),
                                email: email.val(),
                                provinsi: provinsi.val(),
                                kota: kota.val(),
                                alamat: alamat.val(),
                                no_telp : telp.val()
                            };


                            $.ajax({
                                type: 'ajax',
                                method: 'post',
                                url: "pembayaran",
                                data: data,
                                async: false,
                                dataType: 'json',
                                success: function (response) {
                                    if (response.success) {
                                        // swal('Pembayaran Berhasil', 'Sukses!','success');
                                        //window.location.href = "<?php //echo base_url()."index.php/administrator/printInvoice/"?>//"+data.no_penjualan+"";
                                        swal({
                                            title: "Pembayaran Berhasil",
                                            text: "Sukses!",
                                            icon: "success"
                                        })
                                            .then((willDelete) => {
                                                if (willDelete) {
                                                    window.open('<?php echo base_url() . "index.php/administrator/printInvoice/"?>' + data.no_penjualan + '','_blank');
                                                }

                                            });
                                        getCart();
                                        $('#loading_pembayaran').hide();
                                        $('#kode_barang').val("");
                                        $('#nama_barang').val("");
                                        $('#stok_barang').val("");
                                        $('#harga_label').text("Harga");
                                        $('#harga').val("");
                                        $('#jumlah').val("");
                                        $('#diskon').val("");
                                        $('#myModalBayar').modal('hide');
                                    } else {
                                        swal({
                                            title: "Pembayaran Gagal",
                                            text: "Proses Gagal!",
                                            icon: "error"
                                        })
                                            .then((willDelete) => {
                                                if (willDelete) {
                                                    location.reload();
                                                }

                                            });
                                    }
                                },
                                error: function () {
                                    swal({
                                        title: "Pembayaran Gagal",
                                        text: "Proses Gagal!",
                                        icon: "error"
                                    })
                                        .then((willDelete) => {
                                            if (willDelete) {
                                                location.reload();
                                            }

                                        });
                                }
                            });
                        }

                    } else if($('#select_pembayaran').val() == "2") {

                        var sisa = convert - totalHarga;
                        var data = {
                            no_penjualan: $('#label_faktur').val(),
                            total_barang: $('#total_belanja').val(),
                            expedisi: $('#label_expedisi').val(),
                            biaya_expedisi: $('#label_harga_expedisi').val(),
                            total_harga: totalHarga,
                            customer_id: $('#customer').val(),
                            method_pembayaran: $('#select_pembayaran').val(),
                            total_bayar: convert,
                            total_kembali: sisa,
                            id_bank: $('#method_pembayaran').val(),
                            nama_customer: nama_customer.val(),
                            email: email.val(),
                            provinsi: provinsi.val(),
                            kota: kota.val(),
                            alamat: alamat.val(),
                            no_telp : telp.val()
                        };


                        $.ajax({
                            type: 'ajax',
                            method: 'post',
                            url: "pembayaran",
                            data: data,
                            async: false,
                            dataType: 'json',
                            success: function (response) {
                                if (response.success) {
                                    // swal('Pembayaran Berhasil', 'Sukses!','success');
                                    //window.location.href = "<?php //echo base_url()."index.php/administrator/printInvoice/"?>//"+data.no_penjualan+"";
                                    swal({
                                        title: "Pembayaran Berhasil",
                                        text: "Sukses!",
                                        icon: "success"
                                    })
                                        .then((willDelete) => {
                                            if (willDelete) {
                                                //window.location.href = "<?php //echo base_url() . "index.php/administrator/printInvoice/"?>//" + data.no_penjualan + "";
                                                window.open('<?php echo base_url() . "index.php/administrator/printInvoice/"?>' + data.no_penjualan + '','_blank');
                                            }

                                        });
                                    getCart();
                                    $('#loading_pembayaran').hide();
                                    $('#kode_barang').val("");
                                    $('#nama_barang').val("");
                                    $('#stok_barang').val("");
                                    $('#harga_label').text("Harga");
                                    $('#harga').val("");
                                    $('#jumlah').val("");
                                    $('#diskon').val("");
                                    $('#myModalBayar').modal('hide');
                                } else {
                                    swal({
                                        title: "Pembayaran Gagal",
                                        text: "Proses Gagal!",
                                        icon: "error"
                                    })
                                        .then((willDelete) => {
                                            if (willDelete) {
                                                location.reload();
                                            }

                                        });
                                }
                            },
                            error: function () {
                                swal({
                                    title: "Pembayaran Gagal",
                                    text: "Proses Gagal!",
                                    icon: "error"
                                })
                                    .then((willDelete) => {
                                        if (willDelete) {
                                            location.reload();
                                        }

                                    });
                            }
                        });
                    }else{
                        var sisa = totalHarga - convert2;
                        var data = {
                            no_penjualan: $('#label_faktur').val(),
                            total_barang: $('#total_belanja').val(),
                            expedisi: $('#label_expedisi').val(),
                            biaya_expedisi: $('#label_harga_expedisi').val(),
                            total_harga: totalHarga,
                            customer_id: $('#customer').val(),
                            method_pembayaran: $('#select_pembayaran').val(),
                            total_bayar: convert2,
                            total_hutang: sisa,
                            tgl_jatuh_tempo: label_date_termin.val(),
                            id_bank: $('#method_pembayaran').val(),
                            nama_customer: nama_customer.val(),
                            email: email.val(),
                            provinsi: provinsi.val(),
                            kota: kota.val(),
                            alamat: alamat.val(),
                            no_telp : telp.val()
                        };


                        $.ajax({
                            type: 'ajax',
                            method: 'post',
                            url: "pembayaran",
                            data: data,
                            async: false,
                            dataType: 'json',
                            success: function (response) {
                                if (response.success) {
                                    // swal('Pembayaran Berhasil', 'Sukses!','success');
                                    //window.location.href = "<?php //echo base_url()."index.php/administrator/printInvoice/"?>//"+data.no_penjualan+"";
                                    swal({
                                        title: "Pembayaran Berhasil",
                                        text: "Sukses!",
                                        icon: "success"
                                    })
                                        .then((willDelete) => {
                                            if (willDelete) {
                                                //window.location.href = "<?php //echo base_url() . "index.php/administrator/printInvoice/"?>//" + data.no_penjualan + "";
                                                window.open('<?php echo base_url() . "index.php/administrator/printInvoice/"?>' + data.no_penjualan + '','_blank');
                                            }

                                        });
                                    getCart();
                                    $('#loading_pembayaran').hide();
                                    $('#kode_barang').val("");
                                    $('#nama_barang').val("");
                                    $('#stok_barang').val("");
                                    $('#harga_label').text("Harga");
                                    $('#harga').val("");
                                    $('#jumlah').val("");
                                    $('#diskon').val("");
                                    $('#myModalBayar').modal('hide');
                                } else {
                                    swal({
                                        title: "Pembayaran Gagal",
                                        text: "Proses Gagal!",
                                        icon: "error"
                                    })
                                        .then((willDelete) => {
                                            if (willDelete) {
                                                location.reload();
                                            }

                                        });
                                }
                            },
                            error: function () {
                                swal({
                                    title: "Pembayaran Gagal",
                                    text: "Proses Gagal!",
                                    icon: "error"
                                })
                                    .then((willDelete) => {
                                        if (willDelete) {
                                            location.reload();
                                        }

                                    });
                            }
                        });
                    }
                }



            }else {

                if (expedisi.val() != "" && harga_expedisi != "") {
                    $('#label_expedisi').removeClass('has-error');
                    result += 1;

                } else {
                    $('#label_expedisi').addClass('has-error');
                    $('#loading_pembayaran').hide();
                }

                if (pembayaran.val() != "") {
                    pembayaran.removeClass('has-error');
                    result += 1;
                    if (pembayaran.val() == "1") {
                        if (cash.val() != "") {
                            cash.removeClass('has-error');
                            result += 1;
                        } else {
                            cash.addClass('has-error');
                            $('#loading_pembayaran').hide();
                        }
                    } else if (pembayaran.val() == "2") {
                        if (bank.val() != "") {
                            bank.removeClass('has-error');
                            result += 1;
                        } else {
                            bank.addClass('has-error');
                            $('#loading_pembayaran').hide();
                        }
                    }else if(pembayaran.val() == "3"){
                        if (label_termin.val() != "") {
                            label_termin.removeClass('has-error');
                            result += 1;
                        } else {
                            label_termin.addClass('has-error');
                            $('#loading_pembayaran').hide();
                        }
                    }
                } else {
                    pembayaran.addClass('has-error');
                    $('#loading_pembayaran').hide();
                }

                   var check_termin = 3;



                if (result == check_termin) {
                    $('#loading_pembayaran').show();

                    var convert = parseInt(rupiah.value.replace(/[\. ,:-Rp]+/g, ""));
                    var convert2 = parseInt(rupiah2.value.replace(/[\. ,:-Rp]+/g, ""));
                    var totId = document.getElementById('label_total_harga').value.replace(/[\. ,:-Rp]+/g, "");
                    var totalHarga = parseInt(totId);

                    if ($('#select_pembayaran').val() == "1") {

                        if (convert < totalHarga) {
                            swal('Peringatan', 'Uang Tidak Cukup!', 'info');
                            $('#loading_pembayaran').hide();

                        } else {
                            var sisa = convert - totalHarga;
                            var data = {
                                no_penjualan: $('#label_faktur').val(),
                                total_barang: $('#total_belanja').val(),
                                expedisi: $('#label_expedisi').val(),
                                biaya_expedisi: $('#label_harga_expedisi').val(),
                                total_harga: totalHarga,
                                customer_id: $('#customer').val(),
                                method_pembayaran: $('#select_pembayaran').val(),
                                total_bayar: convert,
                                total_kembali: sisa,
                                id_bank: $('#method_pembayaran').val()
                            };


                            $.ajax({
                                type: 'ajax',
                                method: 'post',
                                url: "pembayaran",
                                data: data,
                                async: false,
                                dataType: 'json',
                                success: function (response) {
                                    if (response.success) {
                                        // swal('Pembayaran Berhasil', 'Sukses!','success');
                                        //window.location.href = "<?php //echo base_url()."index.php/administrator/printInvoice/"?>//"+data.no_penjualan+"";
                                        swal({
                                            title: "Pembayaran Berhasil",
                                            text: "Sukses!",
                                            icon: "success"
                                        })
                                            .then((willDelete) => {
                                                if (willDelete) {
                                                    window.open('<?php echo base_url() . "index.php/administrator/printInvoice/"?>' + data.no_penjualan + '','_blank');
                                                }

                                            });
                                        getCart();
                                        $('#loading_pembayaran').hide();
                                        $('#kode_barang').val("");
                                        $('#nama_barang').val("");
                                        $('#stok_barang').val("");
                                        $('#harga_label').text("Harga");
                                        $('#harga').val("");
                                        $('#jumlah').val("");
                                        $('#diskon').val("");
                                        $('#myModalBayar').modal('hide');
                                        clearPembayaran();
                                    } else {
                                        swal({
                                            title: "Pembayaran Gagal",
                                            text: "Proses Gagal!",
                                            icon: "error"
                                        })
                                            .then((willDelete) => {
                                                if (willDelete) {
                                                    location.reload();
                                                }

                                            });
                                    }
                                },
                                error: function () {
                                    swal({
                                        title: "Pembayaran Gagal",
                                        text: "Proses Gagal!",
                                        icon: "error"
                                    })
                                        .then((willDelete) => {
                                            if (willDelete) {
                                                location.reload();
                                            }

                                        });
                                }
                            });
                        }

                    } else if($('#select_pembayaran').val() == "2") {

                        var sisa = convert - totalHarga;
                        var data = {
                            no_penjualan: $('#label_faktur').val(),
                            total_barang: $('#total_belanja').val(),
                            expedisi: $('#label_expedisi').val(),
                            biaya_expedisi: $('#label_harga_expedisi').val(),
                            total_harga: totalHarga,
                            customer_id: $('#customer').val(),
                            method_pembayaran: $('#select_pembayaran').val(),
                            total_bayar: convert,
                            total_kembali: sisa,
                            id_bank: $('#method_pembayaran').val()
                        };


                        $.ajax({
                            type: 'ajax',
                            method: 'post',
                            url: "pembayaran",
                            data: data,
                            async: false,
                            dataType: 'json',
                            success: function (response) {
                                if (response.success) {
                                    // swal('Pembayaran Berhasil', 'Sukses!','success');
                                    //window.location.href = "<?php //echo base_url()."index.php/administrator/printInvoice/"?>//"+data.no_penjualan+"";
                                    swal({
                                        title: "Pembayaran Berhasil",
                                        text: "Sukses!",
                                        icon: "success"
                                    })
                                        .then((willDelete) => {
                                            if (willDelete) {
                                                window.open('<?php echo base_url() . "index.php/administrator/printInvoice/"?>' + data.no_penjualan + '','_blank');
                                            }

                                        });
                                    getCart();
                                    $('#loading_pembayaran').hide();
                                    $('#kode_barang').val("");
                                    $('#nama_barang').val("");
                                    $('#stok_barang').val("");
                                    $('#harga_label').text("Harga");
                                    $('#harga').val("");
                                    $('#jumlah').val("");
                                    $('#diskon').val("");
                                    $('#myModalBayar').modal('hide');
                                    clearPembayaran();
                                } else {
                                    swal({
                                        title: "Pembayaran Gagal",
                                        text: "Proses Gagal!",
                                        icon: "error"
                                    })
                                        .then((willDelete) => {
                                            if (willDelete) {
                                                location.reload();
                                            }

                                        });
                                }
                            },
                            error: function () {
                                swal({
                                    title: "Pembayaran Gagal",
                                    text: "Proses Gagal!",
                                    icon: "error"
                                })
                                    .then((willDelete) => {
                                        if (willDelete) {
                                            location.reload();
                                        }

                                    });
                            }
                        });
                    }else{
                        var sisa = totalHarga - convert2;
                        var data = {
                            no_penjualan: $('#label_faktur').val(),
                            total_barang: $('#total_belanja').val(),
                            expedisi: $('#label_expedisi').val(),
                            biaya_expedisi: $('#label_harga_expedisi').val(),
                            total_harga: totalHarga,
                            customer_id: $('#customer').val(),
                            method_pembayaran: $('#select_pembayaran').val(),
                            total_bayar: convert2,
                            total_hutang: sisa,
                            id_bank: $('#method_pembayaran').val()
                        };


                        $.ajax({
                            type: 'ajax',
                            method: 'post',
                            url: "pembayaran",
                            data: data,
                            async: false,
                            dataType: 'json',
                            success: function (response) {
                                if (response.success) {
                                    // swal('Pembayaran Berhasil', 'Sukses!','success');
                                    //window.location.href = "<?php //echo base_url()."index.php/administrator/printInvoice/"?>//"+data.no_penjualan+"";
                                    swal({
                                        title: "Pembayaran Berhasil",
                                        text: "Sukses!",
                                        icon: "success"
                                    })
                                        .then((willDelete) => {
                                            if (willDelete) {
                                                window.open('<?php echo base_url() . "index.php/administrator/printInvoice/"?>' + data.no_penjualan + '','_blank');
                                            }

                                        });
                                    getCart();
                                    $('#loading_pembayaran').hide();
                                    $('#kode_barang').val("");
                                    $('#nama_barang').val("");
                                    $('#stok_barang').val("");
                                    $('#harga_label').text("Harga");
                                    $('#harga').val("");
                                    $('#jumlah').val("");
                                    $('#diskon').val("");
                                    $('#myModalBayar').modal('hide');
                                    clearPembayaran();
                                } else {
                                    swal({
                                        title: "Pembayaran Gagal",
                                        text: "Proses Gagal!",
                                        icon: "error"
                                    })
                                        .then((willDelete) => {
                                            if (willDelete) {
                                                location.reload();
                                            }

                                        });
                                }
                            },
                            error: function () {
                                swal({
                                    title: "Pembayaran Gagal",
                                    text: "Proses Gagal!",
                                    icon: "error"
                                })
                                    .then((willDelete) => {
                                        if (willDelete) {
                                            location.reload();
                                        }

                                    });
                            }
                        });
                    }
                }
            }
});

        $('#select_pembayaran').change(function () {
   var select = $('#select_pembayaran');
   if(select.val() == 2){
       $('#method_pembayaran').show();
       $('#label_bayar').hide();
       $('#label_bayar_termin').hide();
       $('#label_termin').hide();
       $('#label_date_termin').hide();

   }else if(select.val() == 1){
       $('#label_bayar').show();
       $('#method_pembayaran').hide();

       $('#label_bayar_termin').hide();
       $('#label_termin').hide();
       $('#label_date_termin').hide();

   }else if(select.val() == 3){
       $('#label_bayar').hide();
       $('#method_pembayaran').hide();
       $('#label_bayar_termin').show();
       $('#label_termin').show();
       $('#label_date_termin').show();
   }
   else{
       $('#method_pembayaran').hide();
       $('#label_bayar').hide();

       $('#label_bayar_termin').hide();
       $('#label_termin').hide();
       $('#label_date_termin').hide();
   }
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
           if($('#customer').val() != ""){
               $('.select2-container').removeClass('has-error');
               $('#kode_barang').val($(this).attr('data'));
               $('#kode_barang').trigger('keyup');
           }else{
               $('.select2-container').addClass('has-error');
           }
        });

        $('#nama_customer_baru').on('keyup',function () {
           $('#label_customer').val($(this).val());
        });
        $('#alamat_customer_baru').on('keyup',function () {
            $('#label_alamat').val($(this).val());
        });

        function cekProvince() {
            $.ajax({
                type: 'ajax',
                method: 'get',
                url: 'cekProvince',
                async: 'false',
                dataType: 'json',
                success: function (data) {
                    // console.log(data.rajaongkir.);
                    var html = '';
                    $.each(data.rajaongkir.results,function(i,item){
                        html += '<option value='+item.province_id+'>'+item.province+'</option>';


                    });

                    $('#provinsi_customer_baru').append(html);
                    $('#provinsi_customer_baru').select2({
                        dropdownParent: $('#myModalBayar')
                    });
                    // $('#id_province').select2();

                },
                error: function () {

                }
            });
        }
        function cekCity() {
            $.ajax({
                type: 'ajax',
                method: 'get',
                url: 'cekCity',
                async: 'false',
                dataType: 'json',
                success: function (data) {
                    // console.log(data.rajaongkir.);
                    var html = '';
                    $.each(data.rajaongkir.results,function(i,item){
                        html += '<option value='+item.city_id+'>'+item.city_name+'</option>';


                    });

                    $('#kota_customer_baru').append(html);
                    $('#kota_customer_baru').select2({
                        dropdownParent: $('#myModalBayar')
                    });
                    // $('#id_city').select2();
                },
                error: function () {

                }
            });
        }

        $('#provinsi_customer_baru').change(function () {
           $('#provinsi').val($(this).val());
        });
        $('#kota_customer_baru').change(function () {
            $('#kota').val($(this).val());
        });
        cekProvince();
        cekCity();

        var diskon_asli = document.getElementById('diskon');
        var convert_diskon = document.getElementById('diskon_convert');
        convert_diskon.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            convert_diskon.value = formatRupiah(this.value, 'Rp. ');
            diskon_asli.value = convert_diskon.value.replace(/[\. ,:-Rp]+/g, "");
        });
        
        function clearPembayaran() {
            $('#label_expedisi').val("");
            $('#label_harga_expedisi_convert').hide();
            $('#select_pembayaran').val("");
            $('#method_pembayaran').hide();

        }
        // $('#kode_barang').on('focus',function () {
        //    $('#modalBarang').modal('show');
        // });
    </script>
