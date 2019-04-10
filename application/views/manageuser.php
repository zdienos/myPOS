  <body>

    <div class="container">
      <span class="header-text">User</span>&nbsp;<span>Manajemen</span>
      <span><button class="btn btn-success right-side pull-right" data-toggle="modal" data-target="#tambah">Tambah Pengguna</button></span>
      <hr class="hr-top">
    </div>
<div class="container">

    <table class="table table-striped table-bordered top" id="tableBarang">
      <thead>
        <tr class="active">
          <th class="text-center">No</th>
          <th class="text-center">Username</th>
          <th class="text-center">Password</th>
          <th class="text-center">Role</th>
          <th class="text-center">Opsi</th>
        </tr>
      </thead>
        <tbody>
        <?php foreach ($user as $us) {
        ?>
        <tr>
        <td><?php echo $us->user_id; ?></td>
        <td><?php echo $us->username; ?></td>
        <td><?php echo $us->password; ?></td>
        <td><?php if ($us->role_id == '1') {
          echo "Admin";
        }elseif ($us->role_id == 2) {
          echo "Kasir";
        } ?></td>
        <td>
          <a id="edit" class='btn btn-success btn-sm' href='#' 
          data-user_id='<?php echo $us->user_id; ?>' 
          data-username='<?php echo $us->username; ?>' 
          data-password='<?php echo $us->password; ?>' 
          data-province='<?php echo $us->id_province; ?>' 
          data-city='<?php echo $us->id_city; ?>' 
          data-toggle='modal' 
          data-target='#ubah-data'>Ubah</a>
            <?php if ($us->user_id != '1') { ?>
        <a href="<?php echo base_url().'index.php/administrator/delete_user/' .$us->user_id;?>""><button type="button" class="btn btn-danger btn-sm">Hapus</button></a>
      <?php } ?>
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
<div class="modal fade bs-example-modal-sm" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myLargeModalLabel">Tambah Pengguna</h4>
        </div>

        <div class="col-sm-12 top-modal">
            <form role="form" method="post">
              <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input name="username" type="text" class="form-control" id="exampleInputEmail1" placeholder="Username">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Role</label>
                <select name="role_id" class="form-control" >
                  <option value="">Pilih Role</option>
                  <option value="1">Admin</option>
                  <option value="2">Kasir</option>
                </select>
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
              
        <!-- <input type="hidden" name="role_id" value="2"> -->
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

<div class="modal fade bs-example-modal-lg" id="ubah-data" enctype="multipart/form-data" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myLargeModalLabel">Ubah Pengguna</h4>
        </div>

<div class="col-sm-12 top" id="mm">
 
<form role="form" action="<?php echo base_url(). 'index.php/administrator/update'; ?>" method="post">
<input type="hidden" name="user_id" id="user_id">
<div class="form-group">
<label for="exampleInputEmail1">Username</label>
<input name="username" type="text" class="form-control" id="username">
</div>
<div class="form-group">
<label for="exampleInputPassword1">Password</label>
<input name="password" type="text" class="form-control" id="password">
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
                <label for="exampleInputEmail1">Role</label>
                <select name="role_id" class="form-control" >
                  <option value="">Pilih Role</option>
                  <option value="1">Admin</option>
                  <option value="2">Kasir</option>
                </select>
              </div>
</div>


<div class="modal-footer">
<button type="submit" class="btn btn-success btn-sm">Ubah</button>
<a href="<?php echo base_url().'index.php/administrator/user'?>""><button type="button" class="btn btn-danger btn-sm">Batal</button></a>
</form>
<script>
        
    $(document).ready(function() {
    $('#tableBarang').DataTable();
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
                    url: 'cekCity',
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
    $(document).on("click", "#edit", function(){
      var user_id = $(this).data('user_id');
      var username = $(this).data('username');
      var password = $(this).data('password');
      var role_id = $(this).data('role_id');
      var province = $(this).data('province');
      var city = $(this).data('city');

      $("#mm #user_id").val(user_id);
      $("#mm #username").val(username);
      $("#mm #password").val(password);
      $("#mm #role_id").val(role_id);
      $("#mm #edit_id_province").val(province);
      $("#mm #edit_id_city").val(city);
    });


</script>
        </div>
    </div>
  </div>
</div>
