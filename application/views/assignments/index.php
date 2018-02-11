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
              <h3>Assignments</h3>
            </div>

            <div class="card-content">
              <table class="table table-striped datatable">
                <thead>
                  <tr>
                    <th>Sl.</th>
                    <th>User</th>
                    <th>Meeting with</th>
                    <th>From</th>
                    <th>On</th>
                    <th>At</th> 
                    <th>Remarks</th>
                    <th>Assigned by</th>
                    <th>Assigned on</th>
                    <th>Updated On</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Respond</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $i = 1;
                    foreach($assignments as $assignment):
                  ?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $assignment['assigned_to'] ?></td>
                    <td><?php echo $assignment['name'] ?></td>
                    <td><?php echo $assignment['company'] ?></td>
                    <td><strong><?php echo date('d-M-Y h:i A', strtotime($assignment['datetime'])) ?></strong></td>
                    <td><?php echo $assignment['place'] ?></td>
                    <td><?php echo $assignment['remarks'] ?></td>
                    <td><?php echo $assignment['assigned_by'] ?></td>
                    <td><?php echo $assignment['assigned_on'] ?></td>
                    <td>
                      <?php 
                        if($assignment['updated_on']=="0000-00-00 00:00:00"){
                          echo "Not updated";
                        }else{
                          echo $assignment['updated_on'];
                        }
                      ?>
                    </td>
                    <td>
                        <?php
                          if($assignment['status'] == 0) echo "New";
                          else if($assignment['status'] == 1) echo "Postponed";
                          else if($assignment['status'] == 2) echo "On Going";
                          else if($assignment['status'] == 3) echo "Finished";
                          else if($assignment['status'] == 4) echo "Cancelled";
                        ?>
                    </td>
                    <td>
                      <a href="<?php echo base_url('assignment/edit/'.$assignment['a_id']); ?>" class="btn btn-warning btn-xs" title="Edit Assignment">
                        <i class="material-icons">edit</i>
                      </a>
                      <a href="<?php echo base_url('assignment/'.$assignment['a_id']); ?>" class="btn btn-success btn-xs" title="View Assignment Details">
                        <i class="material-icons">assignment</i>
                      </a>
                    </td>
                    <td>
                        <a href="<?php echo base_url('respond/'.$assignment['a_id']); ?>" class="btn btn-success btn-xs" title="Respond to Assignement">
                          <i class="material-icons">reply</i>
                        </a>
                        <a href="<?php echo base_url('Assignment/finish/'.$assignment['a_id']); ?>" class="btn btn-default btn-xs" title="End Assignement">
                          <i class="material-icons">done</i>
                        </a>
                    </td>
                  </tr>
                  <?php 
                    $i++;
                    endforeach; 
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
 $this->load->view("layouts/footer");
?>
