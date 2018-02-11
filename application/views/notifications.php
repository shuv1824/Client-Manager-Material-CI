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
                    <h4 class="card-title">All Notifications</h4>
                </div>

                <div class="card-content"> 
                    <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Date</th>
                                <th>Notification</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($notifications as $i => $notification):?>
                            <tr>
                                <td><?php echo $i+1 ?></td>
                                <td><?php echo date('d-M-Y', strtotime($notification['created_on'])) ?></td>
                                <td>
                                    <a href="<?php echo $notification['link'] ?>" onclick="markAsRead(<?php echo $notification['id']?>)">
                                        <?php echo $notification['content'] ?>
                                    </a>
                                </td>

                                <td id="notification_<?php echo $notification['id']?>">
                                    <?php if($notification['is_read'] == 0):?>
                                    <button  class="btn btn-success btn-xs" title="Mark as Unread" onclick="markAsRead(<?php echo $notification['id']?>)">
                                        <i class="material-icons" >bookmark</i>
                                    </button> 
                                    <?php else: ?>
                                    <a  href="<?php echo base_url('Notification/markAsOld/'.$notification['id'])?>" class="btn btn-danger btn-xs" title="Remove Notification">
                                        <i class="material-icons">delete</i>
                                    </a>
                                    <?php endif;?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
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