  <body>

    <div class="container">
      <span class="header-text">Profile</span>&nbsp;<span>User</span>
      <hr class="hr-top">
    </div>
<div class="container">
      <div class="row">
      
        <div class="col-xs-12">
   
    <?php foreach ($profil as $u){ ?>
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $u->username; ?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class=" col-md-3 col-lg-3" style="margin-top: 20px;">
                <img src="<?php echo base_url().'assets/image/image-logo.png' ?>"> 
                </div>

                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <form method="post" action="<?php echo base_url().'index.php/administrator/update_profil'?>">
                      <tr>
                      <div class="form-group">
                      <label for="exampleInputEmail1">User ID</label>
                      <input type="text" name="user_id" class="form-control" id="exampleInputEmail1" value="<?php echo $u->user_id; ?>" readonly>
                      </div>
                      </tr>
                      
                      <tr>
                      <div class="form-group">
                      <label for="exampleInputEmail1">Useraname</label>
                      <input type="text" name="username" class="form-control" value="<?php echo $u->username; ?>" id="exampleInputEmail1">
                      </div>
                      </tr>

                      <tr>
                      <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="text" name="password" class="form-control" value="<?php echo $u->password; ?>" id="exampleInputEmail1">
                      
                      <?php if ($this->session->userdata('ses_id')== 1)  { ?>
                      <input type="hidden" class="form-control" name="role_id" value="1">  
                      <?php }else { ?>
                      <input type="hidden" class="form-control" name="role_id" value="2">
                      <?php } ?>
                      </div>
                      </tr>

                      <button type="submit" class="btn btn-success">Ubah Profile</button>
                     
                    </form>
                  </table>

                </div>
              </div>
            </div>


            
          </div>
           <?php } ?>
        </div>
      </div>
    </div>
<!-- tambah user -->

