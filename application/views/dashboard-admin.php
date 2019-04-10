<style type="text/css">
	.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;  
  margin-bottom: 20px;
}

/*.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}*/


.btn-card{
	vertical-align: bottom;
	width: 100%;
	border-radius: unset;
	/*color: white;*/
	background-color: #575437;
	color: #fff;
    
}
.btn-card:hover{
	
	background-color: #575437;
	color: #eee;
    
}
.btn-card:active{
	
	background-color: #575437;

	color: white;
    
}
body{

	overflow-x: hidden;
}/*.container{
	overflow-x: hidden;
}*/

</style>
<!-- modal -->
<body>
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
		<form method="post" action="<?php echo base_url('index.php/administrator/editstockBarang'); ?>">
		<div class="form-group">
		<input type="hidden" id="kode_barang" name="kode_barang">
		<label for="exampleInputEmail1">Tambah Stok</label>
		<input type="text" class="form-control" id="stock" name="stock" placeholder="Stok">
		</div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="btn_edit">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- modal -->

<div class="container">
	<div class="col-md-3">
		<div class="card white" style="background-color: #6a684c;">
		<div class="container">
		<!-- <img src=""> -->
		<h4><b><?php echo  $countonDate; ?></b></h4>
		<p>Penjualan Bulan Ini</p> 
		</div>
		<button class="btn btn-card" style="color: white;">Info Lanjut</button>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card white" style="background-color: #6a684c;">
		<div class="container">
		<h4><b><?php echo  $count; ?></b></h4> 
		<p>Total Penjualan</p> 
		</div>
		<button class="btn btn-card" style="color: white;">Info Lanjut</button>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card white" style="background-color: #6a684c;">
		<div class="container">
		<h4><b>Rp. <?php echo number_format($countpendapatandate, 0, '.', '.'); ?>,-</b></h4>
		<p>Pendapatan Bulan Ini</p> 
		</div>
		<button class="btn btn-card" style="color: white;">Info Lanjut</button>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card white" style="background-color: #6a684c;">
		<div class="container">
		<h4><b>Rp. <?php echo number_format($countpendapatan, 0, '.', '.'); ?>,-</b></h4>
		<p>Total Pendapatan</p> 
		</div>
		<button class="btn btn-card" style="color: white;">Info Lanjut</button>
		</div>
	</div>
</div>

<div class="container">
<div class="col-md-12">
		<div class="thumbnail">
		<div class="container-fluid">

		<h4><b>Penjualan Terbaru</b></h4>
<table class="table table-bordered" id="table"> 
	<thead> 
		<tr> 			
			<th>No Faktur</th> 			
			<th>Tanggal</th> 			
			<th>Customer</th> 			
			<th>Total Barang</th>
			<th>Total Harga</th> 			
		</tr> 
	</thead> 
	<tbody>
	<?php foreach ($penjualanTerbaru as $a) { ?>
		<tr> 			
			<td><?php echo  $a->no_faktur_penjualan; ?></td> 			
			<td><?php echo  $a->tgl_penjualan; ?></td> 			
			<td><?php echo  $a->nama_lengkap; ?></td> 			
			<td><?php echo  $a->total_barang; ?></td> 			
			<td><?php echo  "Rp. " . number_format($a->total_harga,0,',','.'); ?></td>
		</tr>
	<?php } ?>
		 
	</tbody> 
</table>
		</div>
		</div>
	</div>	



<div class="col-md-12">
		<div class="thumbnail">
		<div class="container-fluid">
		<h4><b>Pengiriman Barang</b></h4>
<table class="table table-bordered" id="table2"> 
	<thead> 
		<tr> 			
			<th>No Faktur</th> 			
			<th>Ekspedisi</th> 			
		</tr> 
	</thead> 
	<tbody> 
		<?php foreach ($ex as $a) { ?>
		<tr> 			
			<td><?php echo  $a->no_faktur_penjualan;?></td> 			
			<td><?php if ($a->expedisi == 1) {
				echo "JNE (REG)";
			}elseif ($a->expedisi == 2) {
				echo "JNE (OK)";
			}else{
				echo "POS INDONESIA";
			} ?></td>

		</tr> 
		<?php } ?> 
	</tbody> 
</table>		
</div>
</div>
</div>	

<div class="col-md-12">
		<div class="thumbnail">
		<div class="container-fluid">

		<h4><b>Data Stok Barang</b></h4>

<table class="table table-bordered" id="table3"> 
	<thead> 
		<tr> 			
			<th>Kode Barang</th> 			
			<th>Nama Barang</th> 			
			<th>Supplier</th> 			
			<th>Stok</th> 		
			<th>Action</th> 						
		</tr> 
	</thead> 
	<tbody> 
		<?php foreach ($cek as $a) { ?>
		<tr> 			
			<td><?php echo  $a->kode_barang; ?></td> 			
			<td><?php echo  $a->nama_barang; ?></td> 			
			<td><?php echo  $a->nama_supplier; ?></td>  
			<td><?php echo  $a->stock; ?></td> 
			<td><a href="" class="btn btn-primary btn-xs edit"  title="Detail" data-kode_barang="<?php echo  $a->kode_barang; ?>" data-stock="<?php echo  $a->stock; ?>" data-toggle="modal" data-target="#modal_edit"><i class="glyphicon glyphicon-plus"></i> Tambah Stok</a></td> 
		</tr> 
	<?php } ?>
	</tbody> 
</table>		
</div>
</div>
</div>	
</body>
    <script src="<?php echo base_url();?>assets/lib/DataTable/jquery.dataTables.min.js">      </script>
    <script src="<?php echo base_url();?>assets/lib/DataTable/dataTables.bootstrap.min.js">      </script>

<script type="text/javascript">
	
	$('#table2').DataTable();
	$('#table3').DataTable();
$(document).ready(function() {
	$.fn.dataTableExt.sErrMode = 'throw';
    $('#table').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
	$(document).on("click", ".edit", function(){
      var a = $(this).data('kode_barang');
          
      
      $("#kode_barang").val(a);
      
      
    });

   //  $('#btn_edit').on('click',function(){
   //    var a = $(this).data('kode_barang');
   //    var b = $(this).data('stock');
   //          $.ajax({
   //              type : "ajax",
   //              method :"post",
   //              url  : 'stoknya',
   //              dataType : "JSON",
   //              data : {kode_barang:a, stock:b},
   //              success: function(data){
                  
	  // $("#kode_barang").val(a);
   //    $("#stock").val(b);
                                                                                                
   //              },error: function () {
   //              toastr.error('Tambah Kategori Gagal', 'Gagal');
   //          }
   //          });
            
   //          return false;                      
   //      });
</script>