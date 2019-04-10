<div class="col-sm-12">
<h4 class="modal-title" id="myLargeModalLabel">Ubah Pengguna</h4>
</div>

<div class="col-sm-12 top">
 <?php foreach ($user as $u){ ?>
<form role="form" action="<?php echo base_url(). 'index.php/administrator/update'; ?>" method="post">
<input type="hidden" name="user_id" value="<?php echo $u->user_id;  ?>">
<div class="form-group">
<label for="exampleInputEmail1">Username</label>
<input name="username" type="text" class="form-control" value="<?php echo $u->username;  ?>">
</div>
<div class="form-group">
<label for="exampleInputPassword1">Password</label>
<input name="password" type="text" class="form-control" value="<?php echo $u->password;  ?>">
</div>
<input type="hidden" name="role_id" value="2">
<button type="submit" class="btn btn-success btn-sm">Tambah</button>
 <a href="<?php echo base_url().'index.php/administrator/user'?>""><button type="button" class="btn btn-danger btn-sm">Batal</button></a>
</form>
<?php } ?>
</div>



<!-- edit user -->