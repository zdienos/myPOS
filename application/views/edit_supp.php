<div class="col-sm-12">
<h4 class="modal-title" id="myLargeModalLabel">Ubah Supplier</h4>
</div>

<div class="col-sm-12 top">
 <?php foreach ($supplier as $u){ ?>
<form role="form" action="<?php echo base_url(). 'index.php/administrator/update_supp'; ?>" method="post">
<input type="hidden" name="id_supplier" value="<?php echo $u->id_supplier;  ?>">
<div class="form-group">
<label for="exampleInputEmail1">Nama Supplier</label>
<input name="nama_supplier" type="text" class="form-control" value="<?php echo $u->nama_supplier;  ?>">
</div>
<div class="form-group">
<label for="exampleInputPassword1">Alamat</label>
<input name="alamat" type="text" class="form-control" value="<?php echo $u->alamat;  ?>">
</div>
<div class="form-group">
<label for="exampleInputPassword1">No. Telpon</label>
<input name="no_telp" type="text" class="form-control" value="<?php echo $u->no_telp;  ?>">
</div>
<div class="form-group">
<label for="exampleInputPassword1">Email</label>
<input name="email" type="text" class="form-control" value="<?php echo $u->email;  ?>">
</div>
<button type="submit" class="btn btn-success btn-sm">Tambah</button>
 <a href="<?php echo base_url().'index.php/administrator/supplier'?>""><button type="button" class="btn btn-danger btn-sm">Batal</button></a>
</form>
<?php } ?>
</div>



<!-- edit supplier -->