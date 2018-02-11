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
              <h3>User List</h3>
            </div>

            <div class="card-content">
              <table class="table table-striped datatable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($users as $i => $user):?>
                  <tr>
                    <td><?php echo $i+1 ?></td>
                    <td><?php echo $user['username'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td><?php echo $user['role'] ?></td>
                    <td>
                        <?php if($user['role'] != "super_admin"): ?>
                          <input type="checkbox" class="toggle-btn-user" 
                              id="<?php echo $user['id'] ?>"  <?php if($user['is_active'] == 1) echo 'checked'; ?>>
                        <?php endif;?>
                    </td>
                    <td>
                    <?php if(($this->session->userdata['role'] == 'super_admin') && ($user['email'] != 'admin@admin.com')):?>
                      <a href="<?php echo base_url('user/edit/'.$user['id']); ?>" class="btn btn-warning btn-xs"><i class="material-icons">edit</i></a>
                      <a href="<?php echo base_url('User/destroy/'.$user['id']); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete?')">
                        <i class="material-icons" >delete</i>
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
