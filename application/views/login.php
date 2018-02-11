<?php $this->load->view("layouts/header") ?>

<div class="full-page login-page" filter-color="black">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="content" id="login-box">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                            <?php echo form_open('Auth/login'); ?>
                                <div class="card card-login card-hidden">
                                    <div class="card-header text-center" data-background-color="purple">
                                        <h4 class="card-title">SENSE MANAGER</h4>
                                    </div>

                                    <div class="card-content">
                                        <?php if($this->session->flashdata('error_msg')):?>
                                            <div class="alert alert-danger">
                                                <?php echo $this->session->flashdata('error_msg') ?>
                                            </div>
                                        <?php endif;?>

                                        <?php if($this->session->flashdata('success_msg')):?>
                                            <div class="alert alert-success">
                                                <?php echo $this->session->flashdata('success_msg') ?>
                                            </div>
                                        <?php endif;?>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <!-- <label class="control-label">Email address</label> -->
                                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                            <div class="form-group">
                                                <!-- <label class="control-label">Password</label> -->
                                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="submit" class="btn btn-primary btn-simple btn-wd btn-lg">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

<?php $this->load->view("layouts/footer") ?>
