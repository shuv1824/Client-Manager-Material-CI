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
                <?php echo form_open('assignment/store', 'class="form-horizontal"'); ?>
                    <div class="card-header" data-background-color="purple">
                    <h4 class="card-title">Assign Meeting</h4>
                    </div>
                    <div class="card-content">   
                    <div class="custom-form">  

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 col-sx-12 label-on-left">User<small>*</small></label>
                                <div class="col-md-4 col-xs-12">
                                    <select name="user_id" class="form-control select" required="true">
                                        <option value=""></option>
                                        <?php foreach($users as $user):?>
                                            <option value="<?php echo $user['id'];?>"><?php echo $user['username']." - ".$user['role'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <label class="col-md-2 col-xs-12 label-on-left">Date &amp; Time<small>*</small></label>
                                <div class="col-md-4 col-xs-12">
                                    <input class="form-control datepicker" name="datetime" type="text" required="true" readonly/>
                                </div>
                            </div>  
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 col-xs-12 label-on-left">Client<small>*</small></label>
                                <div class="col-md-10 col-xs-12">
                                    <select name="client_id" class="form-control select" required="true">
                                        <option value=""></option>
                                        <?php foreach($clients as $client):?>
                                            <option value="<?php echo $client['id'];?>"><?php echo $client['name']." - ".$client['company'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>  
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 label-on-left">Meeting Place</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="place" ></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 label-on-left">Remarks</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="remarks" ></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="category form-category"> <small>*</small> Required fields</div>
                    
                        <div class="form-footer text-right">
                            <button type="submit" class="btn btn-primary btn-fill">Assign Meeting</button>
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