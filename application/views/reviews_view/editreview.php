<?php
$id = '';
$name = '';
$logo = '';


if (!empty($ReviewInfo)) {
    foreach ($ReviewInfo as $uf) {
        $revid = $uf->id;
        $review = $uf->review;
        $companyid = $uf->company;
    }
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-empire"></i> Review Management
            <small>Add / Edit Review</small>
        </h1>
    </section>
 
    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Review Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" action="<?php echo base_url() ?>Reviewupdate" method="post" id="editUser" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                 <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="Reviewname">Review Name</label>
                                        <select class="form-control required" id="Reviewname" name="Reviewname">
                                            <option value="0">Select Company</option>
                                            <?php
                                            if (!empty($companies)) {
                                                foreach ($companies as $rl) {
                                                    ?>
                                            <option value="<?php echo $rl->id ?>" <?php if($rl->id == $companyid) echo 'selected';?>><?php echo $rl->name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" name="compid" value="<?php echo $revid; ?>"/>
                                    </div>

                                </div>
                               <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="Review">Review</label>
                                        <textarea class="form-control required" id="Review" name="Review"><?php echo $review; ?></textarea>
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

<script src="<?php echo base_url(); ?>assets/js/editCompany.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('Review');
</script>
