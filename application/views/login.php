<style type="text/css">
  .body{
    background-color: #2f2d1e;
  }

  .white{
    color: white;
  }

  .yellow{
    background-color: #caaa01;
  }

</style>
<?php if ($this->session->userdata('gagal') == TRUE) {
?>
<div></div>
<script type="text/javascript">
  swal("Peringatan!", "Username atau Password Salah!", "error");
</script>

  <?php $this->session->sess_destroy(); } ?>
  <body class="body">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-4 col-sm-offset-4 form-login">
        <img class="center-block" style="width: 30%;" src="<?php echo base_url();?>assets/image/logo.png">
    <form role="form" action="<?php echo base_url().'index.php/Login/auth'?>" method="POST">
  <div class="form-group">
    <label class="white" for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="Username">
  </div>
  <div class="form-group">
    <label class="white" for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
  </div>
  <div class="form-group">
  <!-- <input type="sybmit" class="btn btn-success form-control" value="Login" name="submit"> -->
  <!-- <a href="<?php echo base_url();?>index.php/Administrator/">Login</a>  -->
  <button class="btn yellow white form-control" type="submit">Login</button>
</div>
</form>
    </div>
  </div>
