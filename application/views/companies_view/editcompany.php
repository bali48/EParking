<?php
$id = '';
$name = '';
$logo = '';


if (!empty($CompanyInfo)) {
    foreach ($CompanyInfo as $uf) {
        $compid = $uf->id;
        $name = $uf->name;
        $rate = $uf->rate;
        $feature1 = $uf->feature1;
        $feature2 = $uf->feature2;
        $feature3 = $uf->feature3;
        $overview = $uf->overview;
        $isbann = $uf->isbann;
        $bannto = $uf->bannto;
        $bannfrom = $uf->bannfrom; 
         $company_logo = $uf->company_logo;
         $featured = $uf->featured;
    }
}
?>
<link href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />    
<script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-empire"></i> Company Management
            <small>Add / Edit Company</small>
        </h1>
    </section>
    <style>
        .image-preview-input {
            position: relative;
            overflow: hidden;
            margin: 0px;
            color: #333;
            background-color: #fff;
            border-color: #ccc;
        }
        .image-preview-input input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }
        .image-preview-input-title {
            margin-left:2px;
        }
    </style>
    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Company Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" action="<?php echo base_url() ?>Companyupdate" method="post" id="editUser" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="companyname">Company Name</label>
                                        <input type="text" class="form-control" id="companyname" placeholder="Company Name" name="companyname" value="<?php echo $name; ?>" >
                                        <input type="hidden" value="<?php echo $compid; ?>" name="compid" id="compid" />    
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rate">Per Day Rate</label>
                                        <input type="rate" class="form-control" id="rate" placeholder="Enter per day rate" name="rate" value="<?php echo $rate; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Feature1">Feature1</label>
                                        <input type="text" class="form-control required" id="Feature1"  value="<?php echo $feature1; ?>" name="Feature1">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Feature2">Feature2</label>
                                        <input type="text" class="form-control required" id="Feature2"  value="<?php echo $feature2 ?>" name="Feature2">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Feature3">Feature3</label>
                                        <input type="Feature3" class="form-control required" id="Feature3" value="<?php echo $feature3; ?>" name="Feature3">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="companyoverview">Company Overview</label>
                                        <textarea class="form-control required" id="companyoverview" value="" name="companyoverview"><?php echo $overview; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                     <?php if ($company_logo != NULL) { ?> <img src="<?php echo base_url() . '/uploads/' . $company_logo; ?>" style="width: 50px; height:50px " /> <?php
                                    } 
                                    ?>
                                    <div class="form-group">
                                        <label for="role">Company Logo</label>
                                   
                                        <div class="input-group image-preview">
                                            <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                                            <span class="input-group-btn">
                                                <!-- image-preview-clear button -->
                                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                                </button>
                                                <!-- image-preview-input -->
                                                <div class="btn btn-default image-preview-input">
                                                    <span class="glyphicon glyphicon-folder-open"></span>
                                                    <span class="image-preview-input-title">Browse</span>
                                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/> <!-- rename it -->
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <!---------------------->
                                     <div class="checkbox">
                                        <label><input type="checkbox" name="isfeatured" id="isfeatured" <?php if($featured == 1){ echo 'checked'; }?>/>Featured</label>     
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="isbann" id="checkbox"  <?php if($isbann == 1){ echo 'checked'; }?>/>Bann Company</label>     
                                    </div>
                                    <br />
                                        
                                    <div class="hidediv" style="<?php if($isbann == 1){echo 'display:block';}?>">
                                        <div class="form-group">
                                            <label>Bann From</label>
                                            <div class="input-group date" data-provide="datepicker">
                                                <input type="text" class="form-control" id="bannfrom" name="bannfrom" required="" <?php if($isbann == 1){ ?> value="<?php echo $bannfrom ?>" <?php } ?>>
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-th"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Bann To</label>
                                            <div class="input-group date" data-provide="datepicker">
                                                <input type="text" class="form-control" name="bannto" required <?php if($isbann == 1){ ?> value="<?php echo $bannto ?>" <?php } ?>>
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-th"></span>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>

                                    <!------------------------->
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
    CKEDITOR.replace('companyoverview');
</script>
<script>
    $(function () {
        $('.hidediv').hide();
        
        //show it when the checkbox is clicked  isbann
        $('input[name="ibann"]').on('click', function () {
            console.log('here');
            if ($(this).prop('checked')) {
                $('.hidediv').fadeIn();
            } else {
                $('.hidediv').hide();
            }
        });
    });
</script>
<script>
    $(function () {
        var date = new Date();
        var currentMonth = date.getMonth();
        var currentDate = date.getDate();
        var currentYear = date.getFullYear();
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-3d'
//    changeMonth: true
        });
    });
</script>