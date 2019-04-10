  <body>

    <div class="container">
      <span class="header-text">Data</span>&nbsp;<span>Customer</span>
      <span><button class="btn btn-success right-side pull-right" data-toggle="modal" data-target="#tambah">Tambah Pengguna</button></span>
      <hr class="hr-top">
    </div>
<div class="container">

 <?php if ($this->session->flashdata('success')) { ?>
  <script type="text/javascript">
   toastr.success('Berhasil Menambahkan Data!', 'Sukses!')
   toastr.options.timeOut = 30; // How long the toast will display without user interaction
</script>
 <?php }?>

 <?php if ($this->session->flashdata('error')) { ?>
  <script type="text/javascript">
   toastr.error('Berhasil Menambahkan Data!', 'Sukses!')
   toastr.options.timeOut = 30; // How long the toast will display without user interaction
</script>
 <?php }?>

 
    <table class="table table-bordered top" id="tableBarang">
      <thead>
        <tr class="active">
          <th class="text-center">ID</th>
          <th class="text-center">Nama Lengkap</th>
          <th class="text-center">Email</th>
          <th class="text-center">Alamat</th>
          <th class="text-center">Role</th>
          <th class="text-center">Opsi</th>
        </tr>
      </thead>
        <tbody>
          
        <?php foreach ($customer as $us) {

        ?>
        <tr>
        <td><?php echo $us->customer_id; ?></td>
        <td><?php echo $us->nama_lengkap; ?></td>
        <td><?php echo $us->email; ?></td>
        <td><?php echo $us->alamat; ?></td>
        <td><?php echo $us->nama_role; ?></td>
        <td>
          
          <a href="<?php echo base_url().'index.php/administrator/profile/' .$us->customer_id;?>""><button type="button" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-file"></i></button></a>

         <a id="edit" class='btn btn-success btn-xs' href='#' 
          data-customer_id='<?php echo $us->customer_id; ?>' 
          data-nama_lengkap='<?php echo $us->nama_lengkap; ?>'
          data-email='<?php echo $us->email; ?>'
          data-alamat='<?php echo $us->alamat; ?>' 
          data-no_telp='<?php echo $us->no_telp; ?>' 
          data-role_id='<?php echo $us->role_id; ?>'
          data-province='<?php echo $us->id_province; ?>' 
          data-city='<?php echo $us->id_city; ?>' 
          data-toggle='modal' 
          data-target='#ubah-data'><i class="glyphicon glyphicon-cog"></i></a>

        <a href="<?php echo base_url().'index.php/administrator/delete_customer/' .$us->customer_id;?>""><button type="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></button></a>
        <?php 
        }
        ?>
        </td>                                            
        </tr>                                            
        </tbody>
    </table>
    <script src="<?php echo base_url();?>assets/lib/DataTable/jquery.dataTables.min.js">      </script>
    <script src="<?php echo base_url();?>assets/lib/DataTable/dataTables.bootstrap.min.js">      </script>
    <!-- Tambah User -->
<div class="modal fade bs-example-modal-xs" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sx">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myLargeModalLabel">Tambah Pengguna</h4>
        </div>

        <div class="col-sm-12" style="margin-top: 10px">
            <form role="form" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Lengkap</label>
                <input name="nama_lengkap" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Lengkap">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input name="email" type="text" class="form-control" id="exampleInputEmail1" placeholder="Email">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Provinsi</label>
                <select name="id_province" id="id_province" class="form-control" >
                  <option value="">Pilih Provinsi</option>
                 
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Kota</label>
                <select name="id_city" id="id_city" class="form-control" >
                  <option value="">Pilih Kota</option>
                 
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Alamat</label>
                <input name="alamat" type="text" class="form-control" id="exampleInputPassword1" placeholder="Alamat">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">No. Telepon</label>
                <input name="no_telp" type="text" class="form-control" id="exampleInputEmail1" placeholder="No. Telepon">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Gambar</label>
                <input name="picture" type="file" class="form-control" id="exampleInputEmail1">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Role Customer</label>
                <select name="role_id" class="form-control" >
                  <option value="">Pilih Role</option>
                  <option value="3">Retail</option>
                  <option value="4">Grosir</option>
                  <option value="5">Dropshupper</option>
                </select>
              </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-sm">Tambah</button>
          </form>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
        </div>
    </div>
  </div>
</div>
<!-- tambah user -->

<div class="modal fade bs-example-modal-sm" id="ubah-data" enctype="multipart/form-data" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myLargeModalLabel">Ubah Pengguna</h4>
        </div>

<div class="col-sm-12" id="mm" style="margin-top: 10px">
 
<form role="form" action="<?php echo base_url(). 'index.php/administrator/update_customer'; ?>" method="post">

<input type="hidden" id="customer_id" name="customer_id">
<div class="form-group">
<label for="exampleInputEmail1">Nama Customer</label>
<input name="nama_lengkap" id="nama_lengkap" type="text" class="form-control">
</div>
<div class="form-group">
<label for="exampleInputPassword1">Email</label>
<input name="email" id="email" type="text" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputEmail1">Provinsi</label>
<select name="id_province" id="edit_id_province" class="form-control" >
<option value="">Pilih Provinsi</option>

</select>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Kota</label>
<select name="id_city" id="edit_id_city" class="form-control" >
<option value="">Pilih Kota</option>

</select>
</div>
<div class="form-group">
<label for="exampleInputPassword1">Alamat</label>
<input name="alamat" id="alamat" type="text" class="form-control">
</div>
<div class="form-group">
<label for="exampleInputPassword1">No. Telpon</label>
<input name="no_telp" id="no_telp" type="text" class="form-control">
</div>
<input name="picture" type="hidden" id="picture" class="form-control">
<div class="form-group">
                <label for="exampleInputEmail1">Role Customer</label>
                <select name="role_id" id="role_id" class="form-control">
                  <option value="">Pilih Role</option>
                  <option value="3">Retail</option>
                  <option value="4">Grosir</option>
                  <option value="5">Dropshupper</option>
                </select>
              </div>
</div>

<div class="modal-footer">
<button type="submit" class="btn btn-success btn-sm">Ubah</button>
<a href="<?php echo base_url().'index.php/administrator/customer'?>""><button type="button" class="btn btn-danger btn-sm">Batal</button></a>
</form>
<script>
    $(document).on("click", "#edit", function(){
      var a = $(this).data('customer_id');
      var b = $(this).data('nama_lengkap');
      var c = $(this).data('email');
      var d = $(this).data('alamat');
      var e = $(this).data('no_telp');
      var f = $(this).data('role_id');
      var province = $(this).data('province');
      var city = $(this).data('city');
      $("#mm #customer_id").val(a);
      $("#mm #nama_lengkap").val(b);
      $("#mm #email").val(c);
      $("#mm #alamat").val(d);
      $("#mm #no_telp").val(e);
      $("#mm #role_id").val(f);
      $("#mm #edit_id_province").val(province);
      $("#mm #edit_id_city").val(city);
    })
    
    $(document).ready(function() {
    $('#tableBarang').DataTable();
    $.ajax({
                    type: 'ajax',
                    method: 'get',
                    url: '<?php echo base_url().'index.php/administrator/'?>cekProvince',
                    async: 'false',
                    dataType: 'json',
                    success: function (data) {
                       // console.log(data.rajaongkir.);
                       var html = '';
                       $.each(data.rajaongkir.results,function(i,item){
                        html += '<option value='+item.province_id+'>'+item.province+'</option>';
                      
                     
                      });
                       
 $('#id_province').append(html);
 $('#edit_id_province').append(html);
 // $('#id_province').select2();

                    },
                    error: function () {
                        alert('Error');
                    }
                });

    $.ajax({
                    type: 'ajax',
                    method: 'get',
                    url: '<?php echo base_url().'index.php/administrator/'?>cekCity',
                    async: 'false',
                    dataType: 'json',
                    success: function (data) {
                       // console.log(data.rajaongkir.);
                       var html = '';
                       $.each(data.rajaongkir.results,function(i,item){
                        html += '<option value='+item.city_id+'>'+item.city_name+'</option>';


                      });

 $('#id_city').append(html);
 $('#edit_id_city').append(html);
 // $('#id_city').select2();
                    },
                    error: function () {
                        alert('Error');
                    }
                });


}

 );



</script>

        </div>
    </div>
  </div>
</div>
<?php unset($_SESSION["something"]);?>
