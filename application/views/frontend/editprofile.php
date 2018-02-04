<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$userId = '';
$name = '';
$email = '';
$mobile = '';
$address = '';
$city = '';
$town = '';
if (!empty($userInfo)) {
    foreach ($userInfo as $uf) {
        $userId = $uf->userId;
        $name = $uf->name;
        $email = $uf->email;
        $mobile = $uf->mobile;
        $address = $uf->address;
        $city = $uf->city;
        $town = $uf->town;
    }
//    echo '<pre>';
//    print_r($userInfo);
//    exit();
}
?>
<div class="container">
    <h1 align='center'> Profile Settings</h1>
    <div class="col-sm-2">

        <ul class="list-group">
            <li class="list-group-item">
                <a href="<?php echo base_url(); ?>mybookings">My Upcoming Bookings</a>
            </li>
            <li class="list-group-item">
                <a href="<?php echo base_url(); ?>previousbookings">Previous Bookings</a>
            </li>
            <li class="list-group-item">
                <a href="<?php echo base_url(); ?>mybookings">Profile</a>
            </li>
        </ul>
    </div>   
    <div class="col-sm-10">
        <section class="content">

            <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                    <!-- general form elements -->



                    <div class="box box-primary">
                        <!--                        <div class="box-header">
                                                    <h3 class="box-title">Enter User Details</h3>
                                                </div> /.box-header -->
                        <!-- form start -->

                        <form role="form" action="<?php echo base_url() ?>editUserprofile" method="post" id="editUserprofile" role="form" autocomplete="false">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">                                
                                        <div class="form-group">
                                            <label for="fname">Full Name</label>
                                            <input type="text" class="form-control" id="fname" placeholder="Full Name" name="fname" value="<?php echo $name; ?>" maxlength="128">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email address</label><br>
                                            <label><?php echo $email; ?></label>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" placeholder="Password" name="password" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cpassword">Confirm Password</label>
                                            <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password" name="cpassword" maxlength="10">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile">Mobile Number</label>
                                            <input type="text" class="form-control" id="mobile" placeholder="Mobile Number" name="mobile" value="<?php echo $mobile; ?>" maxlength="11">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control" id="city" placeholder="city" name="city" value="<?php echo $city; ?>">
                                        </div>
                                       <div class="form-group">
                                            <label for="town">Town</label>
                                            <input type="text" class="form-control" id="town" placeholder="town" name="town" value="<?php echo $town; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">                                
                                        <div class="form-group">
                                            <label for="fname">Address</label>
                                            <textarea name= "address" class="form-control" id ="address" rows="5" resize="false"><?php echo $address; ?></textarea>
                                        </div>

                                    </div>
                                </div>
                               
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary" value="Submit" />
                                <input type="reset" class="btn btn-default" value="Reset" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if ($error) {
                        ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('error'); ?>                    
                        </div>
                    <?php } ?>
                    <?php
                    $success = $this->session->flashdata('success');
                    if ($success) {
                        ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php } ?>

                    <div class="row">
                        <div class="col-md-12">
                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                        </div>
                    </div>
                </div>
            </div>    
        </section>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/editprofile.js" type="text/javascript"></script>
