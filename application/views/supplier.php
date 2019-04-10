  <body>

    <div class="container">
      <span class="header-text">Data</span>&nbsp;<span>Suplier</span>
      <span><button class="btn btn-success right-side pull-right" data-toggle="modal" data-target="#tambah">Tambah Supplier</button></span>
      <hr class="hr-top">
    </div>
<div class="container">
   <?php if ($this->session->flashdata('something') == TRUE) { ?>
<script type="text/javascript">
   toastr.success('Tambah Data Supplier Berhasil!', 'Sukses!')
   toastr.options.timeOut = 30; // How long the toast will display without user interaction
</script>
 <?php }?>

 
 
    <table class="table table-bordered top" id="tableBarang">
      <thead>
        <tr class="active">
          <th class="text-center">Supplier ID</th>
          <th class="text-center">Nama Supplier</th>
          <th class="text-center">Alamat</th>
          <th class="text-center">No. Telpon</th>
          <th class="text-center">Email</th>
          <th class="text-center">Opsi</th>
        </tr>
      </thead>
        <tbody>
        <?php foreach ($supplier as $us) {
        ?>
        
        <tr>
        <td><?php echo $us->id_supplier; ?></td>
        <td><?php echo $us->nama_supplier; ?></td>
        <td><?php echo $us->alamat; ?></td>
        <td><?php echo $us->no_telp; ?></td>
        <td><?php echo $us->email; ?></td>
        <td>

           <a id="edit" class='btn btn-success btn-xs' href='#' 
          data-id_supplier='<?php echo $us->id_supplier; ?>' 
          data-nama_supplier='<?php echo $us->nama_supplier; ?>'
          data-email='<?php echo $us->email; ?>'
          data-alamat='<?php echo $us->alamat; ?>' 
          data-no_telp='<?php echo $us->no_telp; ?>' 
          data-toggle='modal' 
          data-target='#ubah-data'><i class="glyphicon glyphicon-cog"></i></a>
         <!-- <a href="<?php echo base_url().'index.php/administrator/edit_supp/' .$us->id_supplier;?>"><button type="button" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-cog"></i></button></a> -->
        <a href="<?php echo base_url().'index.php/administrator/delete_supp/' .$us->id_supplier;?>"><button type="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></button></a>
        </td>                                            
        </tr>
        
        <?php 
        }
        ?>                                            
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
                <label for="exampleInputEmail1">Nama Supplier</label>
                <input name="nama_supplier" type="text" class="form-control" id="exampleInputEmail1">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Alamat</label>
                <input name="alamat" type="text" class="form-control" id="exampleInputPassword1">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">No. Telepon</label>
                <input name="no_telp" type="text" class="form-control" id="exampleInputPassword1">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input name="email" type="text" class="form-control" id="exampleInputPassword1">
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

<div class="col-sm-12 top" id="mm">
 
<form role="form" action="<?php echo base_url(). 'index.php/administrator/update_supp'; ?>" method="post">

<input type="hidden" id="id_supplier" name="id_supplier">

<div class="form-group">
<label for="exampleInputEmail1">Nama Supplier</label>
<input name="nama_supplier" id="nama_supplier" type="text" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Alamat</label>
<input name="alamat" id="alamat" type="text" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">No. Telpon</label>
<input name="no_telp" id="no_telp" type="text" class="form-control">
</div>

<div class="form-group">
<label for="exampleInputPassword1">Email</label>
<input name="email" id="email" type="text" class="form-control">
</div>
</div>

<div class="modal-footer">
<button type="submit" class="btn btn-success btn-sm">Ubah</button>
<a href="<?php echo base_url().'index.php/administrator/supplier'?>""><button type="button" class="btn btn-danger btn-sm">Batal</button></a>
</form>
</div>

<script>
    $(document).on("click", "#edit", function(){
      var a = $(this).data('id_supplier');
      var b = $(this).data('nama_supplier');
      var c = $(this).data('email');
      var d = $(this).data('alamat');
      var e = $(this).data('no_telp');
      $("#mm #id_supplier").val(a);
      $("#mm #nama_supplier").val(b);
      $("#mm #email").val(c);
      $("#mm #alamat").val(d);
      $("#mm #no_telp").val(e);
    })
    $(document).ready(function() {
    $('#tableBarang').DataTable();
} );    

</script>
    