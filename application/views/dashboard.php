  <style type="text/css">
    .text-putih{
      color: white;
      text-decoration: none;
    }
    .text-putih:hover{
      color: white;
      text-decoration: none;
}
  </style>

  <body class="dashboard">

    <div class="container white">
      <span class="header-text">Menu</span>&nbsp;<span>Point Of Sale</span>
      <hr class="hr-top-white">
    </div>
<div class="container">
  
   <a href="" class="dropdown-toggle" style="text-decoration: none;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
   <!-- <a href="<?php echo base_url();?>index.php/administrator/diskon"> -->
    <div class="col-lg-3 top">
      <div class="box-menu text-white card-1" style="background-color: #565235;">
        <img class="top-menu center-block" src="<?php echo base_url();?>assets/image/box.png">
      <center class="top-menu text-white">Barang<span class="caret"></span></center>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="width: 100%;">
    <li><a href="<?php echo base_url();?>index.php/administrator/barang">Opname Barang</a></li>
    <li><a href="<?php echo base_url();?>index.php/administrator/category">List Kategori</a></li>
    <?php if ($this->session->userdata('akses') == 1) { ?>
    <li><a href="<?php echo base_url();?>index.php/administrator/pembelian">Pembelian Barang</a></li>
    <li><a href="<?php echo base_url();?>index.php/administrator/Data_Pembelian">Data Pembelian Barang</a></li>
  <?php } ?>
    </div>
    </div>
</a>

  <!-- <a href="<?php echo base_url();?>index.php/administrator/barang">
    <div class="col-lg-3 top">
      <div class="box-menu text-white card-1" style="background-color: #565235;">
        <img class="top-menu center-block" src="<?php echo base_url();?>assets/image/box.png">
      <center class="top-menu text-white">Barang</center>
  </ul>
    </div>
    </div>
</a> -->
 <a href="<?php echo base_url();?>index.php/administrator/customer">
    <div class="col-lg-3 top">
      <div class="box-menu text-white card-1" style="background-color: #565235;">
         <img class="top-menu center-block" src="<?php echo base_url();?>assets/image/cus.png">
      <center class="top-menu">Customer</center>
    </div>
    </div>
</a>
<?php if ($this->session->userdata('akses') == 1) { ?>
 
   <a href="<?php echo base_url();?>index.php/administrator/supplier">
    <div class="col-lg-3 top">
      <div class="box-menu text-white card-1" style="background-color: #565235;">
        <img class="top-menu center-block" src="<?php echo base_url();?>assets/image/supp.png">
      <center class="top-menu">Supplier</center>
    </div>
    </div>
</a>
<a href="<?php echo base_url();?>index.php/administrator/user">
    <div class="col-lg-3 top">
      <div class="box-menu text-white card-1" style="background-color: #565235;">
        <img class="top-menu center-block" src="<?php echo base_url();?>assets/image/user.png">
      <center class="top-menu">User Manajemen</center>
    </div>
    </div>
</a>
<?php } ?>
   <a href="" class="dropdown-toggle" style="text-decoration: none;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
    <div class="col-lg-3 top">
      <div class="box-menu text-white card-1" style="background-color: #565235;">
        <img class="top-menu center-block" src="<?php echo base_url();?>assets/image/reload.png">
          <center class="top-menu text-white">Retur Barang<span class="caret"></span></center>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="width: 100%;">
              <li><a href="<?php echo base_url();?>index.php/administrator/Retur">Data Reture</a></li>
              <li><a href="<?php echo base_url();?>index.php/administrator/returBarang">Reture Barang</a></li>
      </div>
    </div>
</a>
 <a href="" class="dropdown-toggle" style="text-decoration: none;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
   <!-- <a href="<?php echo base_url();?>index.php/administrator/diskon"> -->
    <div class="col-lg-3 top">
      <div class="box-menu text-white card-1" style="background-color: #565235;">
        <img class="top-menu center-block" src="<?php echo base_url();?>assets/image/shopping-cart.png">
      <center class="top-menu text-white">Transaksi<span class="caret"></span></center>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="width: 100%;">
    <li><a href="<?php echo base_url();?>index.php/administrator/penjualan">Penjualan Barang</a></li>    
    <li><a href="<?php echo base_url();?>index.php/administrator/dataPembayaran">Data Pembayaran</a></li>
    </div>
    </div>
</a>
<?php if ($this->session->userdata('akses') == 2) { ?>
    <div class="col-xs-3 top">
    </div>
  <?php } ?>
   <a href="<?php echo base_url();?>index.php/administrator/laporan">
    <div class="col-lg-3 top">
      <div class="box-menu text-white card-1" style="background-color: #565235;">
        <img class="top-menu center-block" src="<?php echo base_url();?>assets/image/statistics.png">
      <center class="top-menu">Laporan</center>
    </div>
    </div>
</a>
   <a href="<?php echo base_url();?>index.php/administrator/log">
    <div class="col-lg-3 top">
      <div class="box-menu text-white card-1" style="background-color: #565235;">
        <img class="top-menu center-block" src="<?php echo base_url();?>assets/image/layers.png">
      <center class="top-menu">Log Aktivitas</center>
    </div>
    </div>
</a>
</div>  

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>