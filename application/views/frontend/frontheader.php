<?php ?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Modern Business - Start Bootstrap Template</title>
        <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    

        <link href="<?php echo base_url(); ?>assets/css/modern-business.css" rel="stylesheet" type="text/css" />    

        <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

        <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript">
            var baseURL = "<?php echo base_url(); ?>";
        </script>
        <script>
            $('.carousel').carousel({
                interval: 5000 //changes the speed
            })
        </script>
        <script>
            $(document).ready(function () {
                //Handles menu drop down
                $('.dropdown-menu').find('form').click(function (e) {
                    e.stopPropagation();
                });
            });
        </script>
    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">Start Bootstrap</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="<?php echo base_url(); ?>About">About</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>Faq">FAQ</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>contact">Contact</a>
                        </li>
                        <?php
                        $isLoggedIn = $this->session->userdata('isLoggedIn');

                        if (isset($isLoggedIn) || $isLoggedIn == TRUE) {
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo base_url(); ?>mybookings">My Bookings</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>logout">LogOut</a>
                                    </li>
                                    
                                </ul>
                            </li>
                        <?php } else {
                            ?>
                                  	<li class="divider-vertical"></li>
					<li class="dropdown">
						<a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>
						<div class="dropdown-menu " style="padding: 15px; ">
							<form method="post" action="<?php echo base_url(); ?>loginMe" accept-charset="UTF-8">
                                                            <input style="margin-bottom: 15px;" type="email" class="form-control" placeholder="email" id="email" name="email">
								<input style="margin-bottom: 15px;" type="password" class="form-control" placeholder="Password" id="password" name="password">
								
								
								<input class="btn btn-primary btn-block" type="submit" id="sign-in" value="Sign In">
								
							</form>
                                                    
                                                    <br> 
                                                    <a href="#" class="btn btn-success btn-block">Sign Up</a>
                                                    
						</div>
					</li>
                            <?php
                        }
                        ?>

                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
        <?php
        $this->load->helper('form');
        $error = $this->session->flashdata('error');
        if($error)
        {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error; ?>                    
            </div>
        <?php }
        $success = $this->session->flashdata('success');
        if($success)
        {
            ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $success; ?>                    
            </div>
        <?php } ?>