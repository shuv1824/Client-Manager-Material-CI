<?php
 $this->load->view("layouts/header");
 $this->load->view("layouts/sidebar");
?>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">

            <?php if($this->session->flashdata('message_display')):?>
            <div class="alert alert-danger" id="user-add-alert">
                <button type="button" aria-hidden="true" class="close" data-dismiss="#user-add-alert">x</button>
                <span>
                    <?php echo $this->session->flashdata('message_display'); ?>
                </span>
            </div>
            <?php endif;?>

            <div class="card">
                <?php echo form_open_multipart('user/update', 'class="form-horizontal"'); ?>
                    <div class="card-header" data-background-color="purple">
                    <h4 class="card-title">Edit User Info</h4>
                    </div>
                    <div class="card-content">   
                    <div class="custom-form">  
                        <input type="hidden" name='id' value="<?php echo $user['id']; ?>">

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3 label-on-left">Name<small>*</small></label>
                                <div class="col-md-9">
                                    <input class="form-control" name="name" type="text" required="true"
                                        value="<?php echo $user['username']; ?>" />
                                </div>
                            </div>  
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3 label-on-left">Email Address<small>*</small></label>
                                <div class="col-md-9">
                                    <input class="form-control" name="email" type="email" required="true" 
                                        value="<?php echo $user['email']; ?>" readonly />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3 label-on-left">Role<small>*</small></label>
                                <div class="col-md-9">
                                    <select name="role" id="role" class="form-control">
                                        <option value=""></option>
                                        <option value="super_admin" <?php if($user['role']=="super_admin") echo 'selected'; ?>>Super Administrator</option>
                                        <option value="admin" <?php if($user['role']=="admin") echo 'selected'; ?>>Administrator</option>
                                        <option value="service_head" <?php if($user['role']=="service_head") echo 'selected'; ?>>Service Head</option>
                                        <option value="customer_relation" <?php if($user['role']=="customer_relation") echo 'selected'; ?>>Customer Relation</option>
                                        <option value="support" <?php if($user['role']=="support") echo 'selected'; ?>>Support Engineer</option>
                                        <option value="basic_user" <?php if($user['role']=="basic_user") echo 'selected'; ?>>Basic User</option>
                                    </select>
                                </div>
                            </div>                          
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3 label-on-left"></label>
                                <div class="col-md-9 upload-btn-wrapper">
                                    <button class="upload-btn">Upload Photo</button>
                                    <input name="photo" id="photo" type="file" accept=".png, .jpg, .jpeg" onchange="checkImgExt('photo')"/>
                                </div>
                            </div>
                        </div>

                        <div class="category form-category"> <small>*</small> Required fields</div>
                    
                        <div class="form-footer text-right">
                            <button type="submit" class="btn btn-primary btn-fill">Update</button>
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
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

<?php
 $this->load->view("layouts/footer");
?>
