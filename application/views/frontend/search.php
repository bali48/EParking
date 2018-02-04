<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style>

    .panel-pricing {
        -moz-transition: all .3s ease;
        -o-transition: all .3s ease;
        -webkit-transition: all .3s ease;
    }
    .panel-pricing:hover {
        box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.2);
    }
    .panel-pricing .panel-heading {
        padding: 20px 10px;
    }
    .panel-pricing .panel-heading .fa {
        margin-top: 10px;
        font-size: 58px;
    }
    .panel-pricing .list-group-item {
        color: #777777;
        border-bottom: 1px solid rgba(250, 250, 250, 0.5);
    }
    .panel-pricing .list-group-item:last-child {
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
    }
    .panel-pricing .list-group-item:first-child {
        border-top-right-radius: 0px;
        border-top-left-radius: 0px;
    }
    .panel-pricing .panel-body {
        background-color: #f0f0f0;
        font-size: 40px;
        color: #777777;
        padding: 20px;
        margin: 0px;
    }

</style>
<br/><br/><br/>
<!--//cid + nod-->
<?php
$token = $this->session->userdata('checkout');
?>
<!-- Plans -->
<section id="plans">
    <div class="container">
        <div class="row">
            <!-- item -->
            <?php
            $companyids = array();
            if ($companies != NULL) {
                foreach ($companies as $company) {
                    if ($company->isbann == 0) {
                        $companyids[] = $company->id;
                        ?>


                        <div class="col-md-4 text-center">
                            <div class="panel panel-success panel-pricing">

                                <div class="panel-heading">
                                    <?php if ($company->company_logo != NULL) { ?> <img src="<?php echo base_url() . '/uploads/' . $company->company_logo; ?>" style="width: 50px; height:50px " /> <?php
                                    } else {
                                        echo 'No Image Found';
                                    }
                                    ?>
                                    <h3><?php echo $company->name; ?></h3>
                                </div>
                                <div class="panel-body text-center">
                                    <div class="pull-right">
                                        <p><strong><?php echo $company->rate ?> / Day</strong></p>
                                    </div>
                                    <p> <?php echo $total = $company->rate * $search['nod']; ?></p>
                                </div>
                                <ul class="list-group text-center">
                                    <li class="list-group-item"><i class="fa fa-check"></i> <?php echo $company->feature1 ?></li>
                                    <li class="list-group-item"><i class="fa fa-check"></i> <?php echo $company->feature2 ?></li>
                                    <li class="list-group-item"><i class="fa fa-check"></i><?php echo $company->feature3 ?></li>
                                </ul>
                                <div class="panel-footer">
                                    <?php if ($this->session->userdata('isLoggedIn') != TRUE) { ?>

                                        <a class="btn btn-lg btn-block btn-success" data-toggle="modal" data-target="#myModal" href="#">BUY NOW!</a>
                                    <?php } else { ?>
                                        <a class="btn btn-lg btn-block btn-success" name="buy" href="<?php echo base_url() ?>checkout?token=<?php echo $token; ?>&comp=<?php echo $company->id; ?>">BUY NOW!</a>

                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            } else {
                ?> 
                <h1> No Car Parks Found </h1>
                <?php
                /* --ADD FOREIGN KEY (vehicaleid) REFERENCES tbl_vehicals(id)
                  ADD FOREIGN KEY (locationid) REFERENCES tbl_locations(id) */
            }
            ?>
            <!-- /item -->

        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>    
</section>

