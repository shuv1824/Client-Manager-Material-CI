<?php
 $this->load->view("layouts/header");
 $this->load->view("layouts/sidebar");
?>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header" data-background-color="purple">
              <h3>Assignment Details</h3>
            </div>

            <div class="card-content details-card">
              <div class="row">
                <div class="col-md-12">
                  <table  class="table table-striped">
                    <thead>
                      <tr>
                        <th>Meeting Date</th>
                        <th>Meeting Time</th>
                        <th>Meeting Place</th>
                        <th>Assigned by</th>
                        <th>Assigned on</th>
                        <th>Updated on</th>
                        <th>remarks</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo date('d-M-Y', strtotime($assignment['datetime']))?></td>
                        <td><?php echo date('h:i A', strtotime($assignment['datetime']))?></td>
                        <td><?php echo $assignment['place']?></td>
                        <td><?php echo $assignment['assigned_by']?></td>
                        <td><?php echo $assignment['assigned_on']?></td>
                        <td><?php echo $assignment['updated_on']?></td>
                        <td><?php echo $assignment['remarks']?></td>
                      </tr>
                    </tbody>
                  </table><br>
                  <h3>Response Details</h3>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Sl.</th>
                        <th>Status</th>
                        <th>Meeting Time</th>
                        <th>Meeting Duration</th>
                        <th>Results</th>
                        <th>Comments</th>
                        <th>Next Meeting Time</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($responses as $i => $response): ?>
                      <tr>
                        <td><?php echo $i+1;?></td>
                        <td>
                        <?php
                          if($response['status'] == 0) echo "New";
                          else if($response['status'] == 1) echo "Postponed";
                          else if($response['status'] == 2) echo "On Going";
                          else if($response['status'] == 3) echo "Finished";
                          else if($response ['status'] == 4) echo "Cancelled";
                        ?>
                        </td>
                        <td><?php echo $response['meeting_time'];?></td>
                        <td><?php echo $response['duration'];?></td>
                        <td><?php echo $response['results'];?></td>
                        <td><?php echo $response['comments'];?></td>
                        <td><?php echo $response['next_meeting_time'];?></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
                    <div class="card card-profile">
                        <div class="card-avatar">
                            <img src="<?php echo base_url('assets/img/clients/'.$assignment['photo'])?>" alt="User Photo">
                        </div>
                        <div class="content">
                            <h4><strong><?php echo $assignment['name']; ?></strong></h4>
                            <p><?php echo $assignment['designation']; ?></p>  
                            <h3><?php echo $assignment['company']; ?></h3>
                            <p><?php echo $assignment['address']; ?></p>
                            <div>
                                <span><i class="material-icons">phone</i> <?php echo $assignment['phone']?> <?php if($assignment['phone2'] != "") echo " | ".$assignment['phone2']; ?></span><br>
                                <span><i class="material-icons">email</i> <?php echo $assignment['email']; ?></span><br>
                                <?php if($assignment['website']!=""):?>
                                <a href="<?php echo "http://".$assignment['website'];?>" target='_blank' title="Visit Website">
                                    <i class="material-icons">language</i> <?php echo $assignment['website']; ?>
                                </a><br>
                                <?php endif; ?>
                                <br>
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visitingCardModal">View Visiting Card</button>
                            <a href="<?php echo base_url('respond/'.$assignment['a_id']); ?>" class="btn btn-success" title="Respond to Assignement">
                              Give Feedback
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="visitingCardModal" tabindex="-1" role="dialog" aria-labelledby="visitingCardModalTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <img src="<?php echo base_url('assets/img/clients/'.$assignment['visiting_card'])?>" alt="Visiting Card" height="300px" width="500px">
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
