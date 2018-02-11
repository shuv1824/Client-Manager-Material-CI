<?php
 $this->load->view("layouts/header");
 $this->load->view("layouts/sidebar");
?>

  <div class="content">
    <?php if($this->session->flashdata('success_msg')): ?>
    <div class="alert alert-success" id="login-alert">
      <button type="button" aria-hidden="true" class="close" data-dismiss="#login-alert">x</button>
      <span>
        Login Successfull. Hello <?php echo $this->session->userdata('role')." - ".$this->session->userdata('username'); ?>
      </span>
    </div>
    <?php endif;?>

    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header" data-background-color="orange">
            <i class="material-icons">people</i>
          </div>
          <div class="card-content">
            <p class="category">Active Clients</p>
            <h3 class="title"><?php echo $active_clients ?></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons text-primary">remove_red_eye</i>
              <a href="<?php echo base_url('clients')?>">View full Client list</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header" data-background-color="green">
            <i class="material-icons">supervisor_account</i>
          </div>
          <div class="card-content">
            <p class="category">Assigned Clients</p>
            <h3 class="title"><?php echo $assigned_clients ?></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons text-primary">remove_red_eye</i>
              <a href="<?php echo base_url('clients/assigned')?>">View list</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header" data-background-color="green">
            <i class="material-icons">assignment</i>
          </div>
          <div class="card-content">
            <p class="category">Upcoming Meetings</p>
            <h3 class="title"><?php echo $upcoming_meetings ?></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <a href="<?php echo base_url('assignments/assigned')?>">Go to the List</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header" data-background-color="blue">
            <i class="fa fa-wifi"></i>
          </div>
          <div class="card-content">
            <p class="category">Connections</p>
            <h3 class="title"><?php echo 34; ?></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">update</i> Just Updated
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Client Meetings</h4>
                                    <p class="category">Upcoming meetings with clients</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover datatable">
                                        <thead class="text-warning">
                                            <th>Sl.</th>
                                            <th>Client</th>
                                            <th>Company</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Assigned To</th>
                                            <th>Assigned By</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                        <?php foreach($assignments as $i => $assignment): ?>
                                            <tr>
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo $assignment['name']; ?></td>
                                                <td><?php echo $assignment['company']; ?></td>
                                                <td><strong><?php echo date('d-M-Y', strtotime($assignment['datetime'])) ?></strong></td>
                                                <td><strong><?php echo date('h:i A', strtotime($assignment['datetime'])) ?></strong></td>
                                                <td><?php echo $assignment['assigned_to']; ?></td>
                                                <td><?php echo $assignment['assigned_by']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('assignment/'.$assignment['a_id']); ?>" class="btn btn-success btn-xs" title="View Assignment Details">
                                                        <i class="material-icons">assignment</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

  </div>

<?php
 $this->load->view("layouts/footer");
?>