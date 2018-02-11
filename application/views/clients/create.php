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
                <?php echo form_open_multipart('client/store', 'class="form-horizontal"'); ?>
                    <div class="card-header" data-background-color="purple">
                    <h4 class="card-title">Add Client</h4>
                    </div>
                    <div class="card-content">   
                    <div class="custom-form">  

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 label-on-left">Contact Person<small>*</small></label>
                                <div class="col-md-4">
                                    <input class="form-control" name="name" type="text" required="true" />
                                </div>
                                <label class="col-md-2 label-on-left">Designation<small>*</small></label>
                                <div class="col-md-4">
                                    <input class="form-control" name="designation" type="text" required="true" />
                                </div>
                            </div>  
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 label-on-left">Email Address<small>*</small></label>
                                <div class="col-md-4">
                                    <input class="form-control" name="email" type="email" required="true" />
                                </div>
                                <label class="col-md-2 label-on-left">Contact No.<small>*</small></label>
                                <div class="col-md-4">
                                    <input class="form-control" name="phone" type="text" required="true" />
                                </div>
                            </div>  
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 label-on-left">Company Name</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="company" type="text" />
                                </div>
                            </div>  
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 label-on-left">Address</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="address" type="text" ></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 label-on-left">Business Type<small>*</small></label>
                                <div class="col-md-4">
                                    <input class="form-control" name="type" type="text" required="true" />
                                </div>
                                <label class="col-md-2 label-on-left">Alternative Contact No.</label>
                                <div class="col-md-4">
                                    <input class="form-control" name="phone2" type="text"/>
                                </div>
                            </div>  
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 label-on-left">Website</label>
                                <div class="col-md-4">
                                    <input class="form-control" name="website" type="text" />
                                </div>
                                <label class="col-md-2 label-on-left">Facebook Page</label>
                                <div class="col-md-4">
                                    <input class="form-control" name="facebook" type="text"/>
                                </div>
                            </div>  
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 label-on-left"></label>
                                <div class="col-md-4 upload-btn-wrapper">
                                    <button class="upload-btn">Upload Photo</button>
                                    <input name="photo" id="photo" type="file" accept=".png, .jpg, .jpeg" onchange="checkImgExt('photo')" />
                                </div>
                                <label class="col-md-2 label-on-left"></label>
                                <div class="col-md-4 upload-btn-wrapper">
                                    <button class="upload-btn">Upload Visiting Card</button>
                                    <input name="visiting_card" id="visiting_card" type="file" accept=".png, .jpg, .jpeg" onchange="checkImgExt('visiting_card')" />
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