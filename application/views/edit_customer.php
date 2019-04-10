<div class="col-sm-12">
<h4 class="modal-title" id="myLargeModalLabel">Ubah Customer</h4>
</div>

<div class="col-sm-12 top">
 <?php foreach ($customer as $u){ ?>
<form role="form" action="<?php echo base_url(). 'index.php/administrator/update_customer'; ?>" method="post">
<input type="hidden" name="customer_id" value="<?php echo $u->customer_id;  ?>">
<div class="form-group">
<label for="exampleInputEmail1">Nama Customer</label>
<input name="nama_lengkap" type="text" class="form-control" value="<?php echo $u->nama_lengkap;  ?>">
</div>
<div class="form-group">
<label for="exampleInputPassword1">Email</label>
<input name="email" type="text" class="form-control" value="<?php echo $u->email;  ?>">
</div>
<div class="form-group">
<label for="exampleInputPassword1">Alamat</label>
<input name="alamat" type="text" class="form-control" value="<?php echo $u->alamat;  ?>">
</div>
<div class="form-group">
<label for="exampleInputPassword1">No. Telpon</label>
<input name="no_telp" type="text" class="form-control" value="<?php echo $u->no_telp;  ?>">
</div>
<input name="foto" type="hidden" class="form-control" value="">
<div class="form-group">
                <label for="exampleInputEmail1">Role Customer</label>
                <select name="role_id" class="form-control">
                  <option value="">Pilih Role</option>
                  <option value="3">Retail</option>
                  <option value="4">Grosir</option>
                  <option value="5">Dropshupper</option>
                </select>
              </div>
<button type="submit" class="btn btn-success btn-sm">Tambah</button>
 <a href="<?php echo base_url().'index.php/administrator/customer'?>""><button type="button" class="btn btn-danger btn-sm">Batal</button></a>
</form>
<?php } ?>
</div>



<!-- edit customer -->