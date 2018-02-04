<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
            <small>Control panel</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            
            <?php if ($this->session->userdata('role') == 1) { ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-person"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Users</span>
                        <span class="info-box-number"><?php echo $userscount; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-briefcase"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Compnies</span>
                        <span class="info-box-number"><?php echo $companycount; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <?php } ?>
               <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-orange"><i class="ion ion-cash"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Earning </span>
                        <span class="info-box-number"><?php echo $earning; ?><small>RS</small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
<!--            <div class="col-lg-3 col-xs-6">
                 small box 
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>20<sup style="font-size: 20px">$</sup></h3>
                        <p>Earning</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    echo base_url();userListing
                                   <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div> ./col -->
            <!--            <div class="col-lg-3 col-xs-6">
                           small box 
                          <div class="small-box bg-red">
                            <div class="inner">
                              <h3>65</h3>
                              <p>Reopened Issue</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                          </div>
                        </div> ./col -->
        </div>
    </section>
</div>