<?php ?><div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-files-o 2x"></i> Booking Orders
            <small>Add, Edit, Delete</small>
        </h1>
    </section>
    <section class="content">
        <!--        <div class="row">
                    <div class="col-xs-12 text-right">
                        <div class="form-group">
                            <a class="btn btn-primary" href="<?php //echo base_url(); 
?>companies/addNewcomp"><i class="fa fa-plus"></i> Add New</a>
                        </div>
                    </div>
                </div>-->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Booking List</h3>
                        <div class="box-tools">
                            <form action="<?php echo base_url() ?>bookinglist" method="POST" id="searchList">
                                <div class="input-group">
                                    <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Id</th>
                                <th>Customer Name</th>
                                <th>Vehicle Number</th>
                                <th>Vehicle model</th>
                                <th>Customer Status</th>
                                <th>Amount Paid</th>
                                <th>Booking From</th>
                                <th>Booking To</th>
                                <?php if ($this->session->userdata('role') == 1) { ?>
                                <th class="text-center">Actions</th>
                                <?php } ?>
                            </tr>
                            <?php
                            if (!empty($userRecords)) {
                                //   print_r($userRecords);  
                                foreach ($userRecords as $record) {
                                    ?>
                                    <tr>
                                        <td><?php echo $record->id ?></td>
                                        <td><?php echo $record->name ?></td>
                                        <td><?php echo $record->vname ?></td>
                                        <td><?php echo $record->vmodel ?></td>
                                        <td><?php echo $record->status ?></td>
                                        <td><?php
                            if ($this->session->userdata('role') == 3) {
                                $temp = $record->pay;
                                $percent = $record->pay * 0.3;
                                echo $temp - $percent;
                            } else {
                                echo $record->pay;
                            }
                            ?></td>
                                        <td><?php echo $record->bookingfrom ?></td>
                                        <td><?php echo $record->bookingto ?></td>
                                        <?php if ($this->session->userdata('role') == 1) { ?>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-info" href="<?php echo base_url() . 'editCompany/' . $record->id; ?>"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-sm btn-danger deleteCompany" href="#" data-compid="<?php echo $record->id; ?>"><i class="fa fa-trash"></i></a>
                                        </td>
                                        <?php } ?>
                                    </tr>
        <?php
    }
}
?>
                        </table>

                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
<?php echo $this->pagination->create_links(); ?>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common_order.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();
            var link = jQuery(this).get(0).href;
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "reportsListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
