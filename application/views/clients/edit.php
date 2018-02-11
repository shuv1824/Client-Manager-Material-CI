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
                <?php echo form_open_multipart('client/update', 'class="form-horizontal"'); ?>
                    <div class="card-header" data-background-color="purple">
                    <h4 class="card-title">Edit Client</h4>
                    </div>
                    <div class="card-content">   
                    <div class="custom-form">  
                        <input type="hidden" name="id" value="<?php echo $client['id']?>">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 label-on-left">Contact Person<small>*</small></label>
                                <div class="col-md-4">
                                    <input class="form-control" name="name" type="text" required="true" value="<?php echo $client['name']?>"/>
                                </div>
                                <label class="col-md-2 label-on-left">Designation<small>*</small></label>
                                <div class="col-md-4">
                                    <input class="form-control" name="designation" type="text" required="true" value="<?php echo $client['designation']?>"/>
                                </div>
                            </div>  
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 label-on-left">Email Address<small>*</small></label>
                                <div class="col-md-4">
                                    <input class="form-control" name="email" type="email" required="true" value="<?php echo $client['email']?>"/>
                                </div>
                                <label class="col-md-2 label-on-left">Contact No.<small>*</small></label>
                                <div class="col-md-4">
                                    <input class="form-control" name="phone" type="text" required="true" value="<?php echo $client['phone']?>"/>
                                </div>
                            </div>  
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 label-on-left">Company Name</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="company" type="text" value="<?php echo $client['company']?>"/>
                                </div>
                            </div>  
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 label-on-left">Address</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="address" type="text" ><?php echo $client['address']?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 label-on-left">Business Type<small>*</small></label>
                                <div class="col-md-4">
                                    <input class="form-control" name="type" type="text" required="true" value="<?php echo $client['type']?>"/>
                                </div>
                                <label class="col-md-2 label-on-left">Alternative Contact No.</label>
                                <div class="col-md-4">
                                    <input class="form-control" name="phone2" type="text" value="<?php echo $client['phone2']?>"/>
                                </div>
                            </div>  
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 label-on-left">Website</label>
                                <div class="col-md-4">
                                    <input class="form-control" name="website" type="text" value="<?php echo $client['website']?>"/>
                                </div>
                                <label class="col-md-2 label-on-left">Facebook Page</label>
                                <div class="col-md-4">
                                    <input class="form-control" name="facebook" type="text" value="<?php echo $client['facebook']?>"/>
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
                        
                            <span class="pull-left">
                                <?php if($client['is_approved'] == 1): ?>
                                    <span style="color:green">APPROVED CLIENT</span>
                                <?php else:?>
                                    <span style="color:orange">PENDING APPROVAL</span> |
                                    <?php if(($this->session->userdata['role'] == 'super_admin') || ($this->session->userdata['role'] == 'admin')):?>
                                    <a class="btn btn-success btn-xs" href=<?php echo base_url("Client/approveClient/".$client['id']) ?>>Approve</a>
                                    <?php endif;?>
                                <?php endif;?> <br>

                                <?php if($client['is_active'] == 1): ?>
                                    <span style="color:green">ACTIVE CLIENT</span>
                                <?php else:?>
                                    <span style="color:red">INACTIVE CLIENT</span>
                                <?php endif;?>
                            </span>
                        
                            <button type="submit" class="btn btn-warning btn-fill" onclick="return confirm('Are you sure?')">Update</button>
                        </div>
                    </div>
                    </div>
                </form>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-avatar">
                    <img src="<?php echo base_url('assets/img/clients/'.$client['photo'])?>" alt="User Photo">
                </div>
                <div class="content">
                    <h4><strong><?php echo $client['name']; ?></strong></h4>
                    <p><?php echo $client['designation']; ?></p>  
                    <h3><?php echo $client['company']; ?></h3>
                    <div>
                        <span><i class="material-icons">phone</i> <?php echo $client['phone']?> <?php if($client['phone2'] != "") echo " | ".$client['phone2']; ?></span><br>
                        <span><i class="material-icons">email</i> <?php echo $client['email']; ?></span><br>
                        <?php if($client['website']!=""):?>
                        <a href="<?php echo "http://".$client['website'];?>" target='_blank' title="Visit Website">
                            <i class="material-icons">language</i> <?php echo $client['website']; ?>
                        </a><br>
                        <?php endif; ?>
                        <br>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visitingCardModal">View Visiting Card</button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="visitingCardModal" tabindex="-1" role="dialog" aria-labelledby="visitingCardModalTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="<?php echo base_url('assets/img/clients/'.$client['visiting_card'])?>" alt="Visiting Card" height="300px" width="500px">
                    </div>
                </div>
            </div>
        </div>

      </div>
    </div>
  </div>

<?php
 $this->load->view("layouts/footer");
?>
