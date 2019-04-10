  <body>

    <div class="container">
      <span class="header-text">Profile</span>&nbsp;<span>Customer</span>
      <span><a href="<?php echo base_url().'index.php/administrator/customer/'?>"><button class="btn btn-success right-side pull-right">Kembali</button></a></span>
      <hr class="hr-top">
    </div>
<div class="container">
      <div class="row">
      
        <div class="col-xs-12">
   
    <?php foreach ($customer as $u){ ?>
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $u->nama_lengkap;  ?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Picture" src="<?php echo base_url()?>upload/<?php echo $u->picture ?>" class="img-responsive"> <br>
                </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Customer ID:</td>
                        <td>#<?php echo $u->customer_id;  ?></td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td><?php echo $u->email;  ?></td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td><?php echo $u->alamat;  ?></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>No. Telp</td>
                        <td><?php echo $u->no_telp;  ?></td>
                      </tr>
                        <tr>
                        <td>Role</td>
                        <td><?php echo $u->nama_role;?></td>
                      </tr>                        
                      </tr>
                     
                    </tbody>
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

