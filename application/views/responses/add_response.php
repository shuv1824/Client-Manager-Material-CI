<?php
 $this->load->view("layouts/header");
 $this->load->view("layouts/sidebar");
?>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
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
                <?php echo form_open('Response/insertResponse', 'class="form-horizontal"'); ?>
                    <div class="card-header" data-background-color="purple">
                    <h4 class="card-title">Respond to Meeting Assignment</h4>
                    </div>
                    <div class="card-content">   
                    <div class="custom-form">  
                        <input type="hidden" name="assignment_id" value="<?php echo $assignment['id']?>">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 col-xs-12 label-on-left">Meeting Date &amp; Time<small>*</small></label>
                                <div class="col-md-4 col-xs-12">
                                    <input class="form-control datepicker" name="datetime" type="text" value="<?php echo $assignment['datetime']?>" required="true" readonly/>
                                </div>
                                <label class="col-md-2 col-sx-12 label-on-left">Duration (in Minutes)</label>
                                <div class="col-md-4 col-xs-12">
                                    <input class="form-control" name="duration" type="number"/>
                                </div>
                            </div>  
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 label-on-left">Results<small>*</small></label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="results" required="true"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 label-on-left">Comments</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="comments" ></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-2 col-xs-12 label-on-left">Next Meeting Date &amp; Time</label>
                                <div class="col-md-4 col-xs-12">
                                    <input class="form-control datepicker" name="nextdatetime" type="text" readonly/>
                                </div>
                                <label class="col-md-2 col-sx-12 label-on-left">Status<small>*</small></label>
                                <div class="col-md-4 col-xs-12">
                                    <select name="status" class="form-control">
                                        <option value="0" <?php if($assignment['status']==0) echo 'selected'?>>New</option>
                                        <option value="1" <?php if($assignment['status']==1) echo 'selected'?>>Postponed</option>
                                        <option value="2" <?php if($assignment['status']==2) echo 'selected'?>>On Going</option>
                                        <!--<option value="3" <?php //if($assignment['status']==3) echo 'selected'?>>Finished</option>
                                        <option value="4" <?php //if($assignment['status']==4) echo 'selected'?>>Cancelled</option>-->
                                    </select>
                                </div>
                            </div>  
                        </div>

                        <div class="category form-category"> <small>*</small> Required fields</div>
                    
                        <div class="form-footer text-right">
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#postpone_modal">Postpone Meeting</button>
                            <button type="submit" class="btn btn-primary btn-fill">Give Feedback</button>
                        </div>
                    </div>
                    </div>
                </form>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="postpone_modal" tabindex="-1" role="dialog" aria-labelledby="visitingCardModalTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <?php echo form_open('Response/postponeMeeting', 'class="form-horizontal"'); ?>
                          <div class="modal-header">
                            <h5 class="modal-title">Give updated meeting date &amp; time</h5>
                          </div>

                          <div class="modal-body">
                            <input type="hidden" name="assignment_id" value="<?php echo $assignment['id']?>">
                              <div class="form-group">
                              <div class="row">
                                  <label class="col-md-4 col-xs-12 label-on-left">Meeting Date &amp; Time<small>*</small></label>
                                  <div class="col-md-8 col-xs-12">
                                      <input class="form-control datepicker" name="datetime" type="text" required="true" readonly/>
                                  </div>
                              </div>  
                          </div>
                          </div>

                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success btn-xs" >Postpone</button>
                          </div>
                      </div>
                    </form>
                  </div>
            </div>
        </div>
      </div>
    </div>
  </div>

<?php
 $this->load->view("layouts/footer");
?>