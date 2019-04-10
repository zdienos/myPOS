<style type="text/css">
  .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover{
    background-color: transparent;
  }
</style>

<nav class="navbar navbar-default navbar-bg">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand white" style="padding: 10px 15px;" href="<?php echo base_url();?>index.php/administrator/"><span><img src="<?php echo base_url();?>assets/image/navbar-logo.png"></span> Point Of Sale</a>
    <button type="button" style="background-color: transparent; border: none;" class="navbar-toggle collapsed white" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"><i class="glyphicon glyphicon-option-vertical"></i></button>
    </div>
<?php if ($this->session->userdata('akses') == 1) { ?>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <ul class="nav navbar-nav">
    <li><a class="white" href="<?php echo base_url();?>index.php/administrator/dashboard">Dashboard</a></li>
        <li><a class="white" href="<?php echo base_url();?>index.php/administrator">Menu</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle white" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Setting <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url();?>index.php/administrator/siteSetting">Site Setting</a></li>
            <li><a href="<?php echo base_url();?>index.php/administrator/listBank">Bank Setting</a></li>
          </ul>
        </li>
      </ul>
    <?php } ?> 
     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo base_url().'index.php/administrator/profil'?>" class="white"><i class="glyphicon glyphicon-user"></i> Edit Pengguna</a></li>
        <li><a href="<?php echo base_url().'index.php/login/logout'?>" class="white"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
