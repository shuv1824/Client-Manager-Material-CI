<?php
 $this->load->view("layouts/header");
 $this->load->view("layouts/sidebar");
?>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <?php if($this->session->flashdata('message_display')):?>
            <div class="alert alert-danger" id="user-add-alert">
                <button type="button" aria-hidden="true" class="close" data-dismiss="#user-add-alert">x</button>
                <span>
                    <?php echo $this->session->flashdata('message_display'); ?>
                </span>
            </div>
            <?php endif;?>

            <div class="card">
                <?php echo form_open_multipart('user/store', 'class="form-horizontal"'); ?>
                    <div class="card-header" data-background-color="purple">
                    <h4 class="card-title">Add User</h4>
                    </div>
                    <div class="card-content">   
                    <div class="custom-form">  

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3 label-on-left">Name<small>*</small></label>
                                <div class="col-md-9">
                                    <input class="form-control" name="name" type="text" required="true" />
                                </div>
                            </div>  
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3 label-on-left">Email Address<small>*</small></label>
                                <div class="col-md-9">
                                    <input class="form-control" name="email" type="email" required="true" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3 label-on-left">Password<small>*</small></label>
                                <div class="col-md-9">
                                    <input class="form-control" name="password" id="registerPassword" type="password" required="true" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3 label-on-left">Confirm Password<small>*</small></label>
                                <div class="col-md-9">
                                    <input class="form-control" name="password_confirmation" id="registerPasswordConfirmation" type="password" required="true" equalTo="#registerPassword" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3 label-on-left">Role<small>*</small></label>
                                <div class="col-md-9">
                                    <select name="role" id="role" class="form-control">
                                        <option value=""></option>
                                        <option value="super_admin">Super Administrator</option>
                                        <option value="admin">Administrator</option>
                                        <option value="service_head">Service Head</option>
                                        <option value="customer_relation">Customer Relation</option>
                                        <option value="support">Support Engineer</option>
                                        <option value="basic_user">Basic User</option>
                                    </select>
                                </div>
                            </div>                          
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3 label-on-left">Upload Photo<small>*</small></label>
                                <div class="col-md-9 upload-btn-wrapper">
                                    <button class="upload-btn">Upload Photo</button>
                                    <input name="photo" id="photo" type="file" required="true" accept=".png, .jpg, .jpeg" onchange="checkImgExt('photo')" />
                                </div>
                            </div>
                        </div>

                        <div class="category form-category"> <small>*</small> Required fields</div>
                    
                        <div class="form-footer text-right">
                            <button type="submit" class="btn btn-primary btn-fill">Add</button>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>

<?php
 $this->load->view("layouts/footer");
?>

<script>
// extension check for image upload
// document.getElementById("photo").onchange = function() {
//   var allowedExtension = ['jpeg', 'jpg', 'png'];
//   var fileExtension = document.getElementById('photo').value.split('.').pop().toLowerCase();
//   var isValidFile = false;

//   for(var index in allowedExtension) {

//     if(fileExtension === allowedExtension[index]) {
//       isValidFile = true; 
//       break;
//     }
//   }

//   if(!isValidFile) {
//     alert('Allowed Extensions are : *.' + allowedExtension.join(', *.') + ' for photo upload');
//     $("#photo").val('');
//   }
//   return isValidFile;
// };
</script>
