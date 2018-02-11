<?php
 $this->load->view("layouts/header");
 $this->load->view("layouts/sidebar");
?>

  <div class="content">
  <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
            <?php if($this->session->flashdata('message_display')):?>
            <div class="alert alert-success" id="user-add-alert">
                <button type="button" aria-hidden="true" class="close" data-dismiss="#user-add-alert">x</button>
                <span>
                    <?php echo $this->session->flashdata('message_display'); ?>
                </span>
            </div>
            <?php endif;?>
            <?php if($this->session->flashdata('message_error')):?>
            <div class="alert alert-danger" id="user-add-alert">
                <button type="button" aria-hidden="true" class="close" data-dismiss="#user-add-alert">x</button>
                <span>
                    <?php echo $this->session->flashdata('message_error'); ?>
                </span>
            </div>
            <?php endif;?>

            <div class="card">
            <?php echo form_open('Auth/resetPass', 'class="form-horizontal"'); ?>
                <div class="card-header" data-background-color="purple">
                <h4 class="card-title">Reset Your Password Here</h4>
                </div>
                <div class="card-content">   
                <div class="custom-form"> 

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-3 label-on-left">Current Password<small>*</small></label>
                            <div class="col-md-9">
                                <input class="form-control" name="current_password" type="password" required="true"/>
                            </div>
                        </div>  
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-3 label-on-left">New Password<small>*</small></label>
                            <div class="col-md-9">
                                <input class="form-control" name="new_password" type="password" required="true"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-3 label-on-left">Confirm New Password<small>*</small></label>
                            <div class="col-md-9">
                                <input class="form-control" name="new_password_confirmation" type="password" required="true"/>
                            </div>
                        </div>                          
                    </div>

                    <div class="category form-category"> <small>*</small> Required fields</div>
                
                    <div class="form-footer text-right">
                        <button type="submit" class="btn btn-primary btn-fill">Reset Password</button>
                    </div>
                </div>
                </div>
            </form>
        </div>  
        </div> 
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-avatar">
                    <img src="<?php echo base_url('assets/img/users/'.$user['image'])?>" alt="User Photo">
                </div>
                <div class="content">
                    <h3><?php echo $user['role']; ?></h3>
                    <h4><strong><?php echo $user['username']; ?></strong></h4>
                    <h5><?php echo $user['email']; ?></h5>
                </div>
            </div>
        </div> 
      </div>  
    </div>
  </div>

<?php
 $this->load->view("layouts/footer");
?>