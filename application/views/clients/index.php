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
            <div class="card-header" data-background-color="purple">
              <h3>Client List</h3>
            </div>

            <div class="card-content">
              <table class="table table-striped datatable">
                <thead>
                  <tr>
                    <th>Sl.</th>
                    <th>Contact Person</th>
                    <th>Company</th>
                    <th>Business Type</th>
                    <th>Email</th> 
                    <th>Contact No.</th>
                    <th>Activation</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $i = 1;
                    foreach($clients as $client):
                  ?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $client['name'] ?></td>
                    <td><?php echo $client['company'] ?></td>
                    <td><?php echo $client['type'] ?></td>
                    <td><?php echo $client['email'] ?></td>
                    <td>
                      <?php echo $client['phone']."<br>".$client['phone2'] ?>
                    </td>

                    <td>
                        <?php if(($this->session->userdata['role'] == 'super_admin') || ($this->session->userdata['role'] == 'admin')):?>
                          <input type="checkbox" class="toggle-btn" 
                              id="<?php echo $client['id'] ?>"  <?php if($client['is_active'] == 1) echo 'checked'; ?>>
                        <?php else:?>
                          <?php if($client['is_active'] == 1) echo "<span style='color:green'>ACTIVE</span>";
                                else echo "<span style='color:red'>INACTIVE</span>";
                          ?> 
                        <?php endif;?>
                    </td>

                    <td>
                      <?php if($client['is_approved'] == 1): ?>
                        <span style="color:green">APPROVED</span>
                      <?php else:?>
                        <span style="color:orange">PENDING</span> <br>
                        <?php if(($this->session->userdata['role'] == 'super_admin') || ($this->session->userdata['role'] == 'admin')):?>
                          <a class="btn btn-success btn-xs" href=<?php echo base_url("Client/approveClient/".$client['id']) ?>>Approve</a>
                        <?php endif;?>
                      <?php endif;?>
                    </td>

                    <td>
                      <?php if(($this->session->userdata['role'] == 'super_admin') || ($this->session->userdata['role'] == 'admin')): ?>
                      <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#assignment_modal" 
                              onclick="setClientId(<?php echo $client['id'] .', '. $client['assigned_to_user']; ?>)">
                        <i class="material-icons" title="Assign to User">assignment_ind</i>
                      </button> <?php endif;?>

                      <?php if(($this->session->userdata['role'] == 'super_admin') || ($this->session->userdata['role'] == 'admin') || ($this->session->userdata['role'] == 'customer_relation')):?>
                      <a href="<?php echo base_url('client/edit/'.$client['id']); ?>" class="btn btn-warning btn-xs"><i class="material-icons" title="Edit Client">edit</i></a> <?php endif;?>

                      <?php if(($this->session->userdata['role'] == 'super_admin') || ($this->session->userdata['role'] == 'admin')): ?>
                      <a href="<?php echo base_url('Client/destroy/'.$client['id']); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete?')" title="Delete Client">
                        <i class="material-icons">delete</i>
                      </a> <?php endif;?>
                    </td>
                  </tr>
                  <?php 
                    $i++;
                    endforeach; 
                  ?>
                </tbody>
              </table>

              <!-- Modal -->
              <div class="modal fade" id="assignment_modal" tabindex="-1" role="dialog" aria-labelledby="visitingCardModalTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <?php echo form_open( 'class="form-horizontal"', 'id="assign-form"'); ?>
                          <div class="modal-header">
                            <h5 class="modal-title">Assign User to The Client</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          </div>

                          <div class="modal-body">
                              <input type="hidden" name="client_id" id="client_id">
                              <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <select name="user_id" id="user_id" class="form-control select" required="true">
                                        <option value=""></option>
                                        <?php foreach($users as $user):?>
                                            <option value="<?php echo $user['id'];?>"><?php echo $user['username']." - ".$user['role'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                              </div>
                          </div>

                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success" >Assign</button>
                          </div>
                      </div>
                    </form>
                  </div>
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
