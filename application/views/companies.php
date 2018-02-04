<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-empire"></i> Companies
            <small>Add, Edit, Delete</small>
        </h1>
    </section>
    <style>
        .icon-d {
            color: yellow;
            -webkit-text-stroke-width: 1px;
            -webkit-text-stroke-color: orange;
        }
        .icon-a {
            color: #888;
        }
    </style>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>companies/addNewcomp"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Comapny List</h3>
                        <div class="box-tools">
                            <form action="<?php echo base_url() ?>companiesListing" method="POST" id="searchList">
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
                                <th>Name</th>
                                <th>Rate</th>
                                <th>Company Logo</th>
                                <th>Status</th>
                                <th>Featured</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                            if (!empty($userRecords)) {
                                //  print_r($userRecords); exit;
                                foreach ($userRecords as $record) {
                                    ?>
                                    <tr>
                                        <td><?php echo $record->id ?></td>
                                        <td><?php echo $record->name ?></td>
                                        <td><?php echo $record->rate ?></td>
                                        <td><?php if ($record->company_logo != NULL) { ?> <img src="<?php echo base_url() . '/uploads/' . $record->company_logo; ?>" style="width: 50px; height:50px " /> <?php
                                            } else {
                                                echo 'No Image Found';
                                            }
                                            ?></td>
                                        <td>

                                            <?php if ($record->isbann != 0) { ?>

                                                <span class="label label-danger">BANN</span>
                                            <?php } else { ?>
                                                <span class="label label-success">Active</span>
                                            <?php } ?>
                                        </td>
                                        <td>

                                            <?php if ($record->featured != 0) { ?>

                                                <i class="fa fa-star icon-d" aria-hidden="true"></i>

                                            <?php } else { ?>
                                                <i class="fa fa-star icon-a" aria-hidden="true"></i>

                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-info" href="<?php echo base_url() . 'editCompany/' . $record->id; ?>"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-sm btn-danger deleteCompany" href="#" data-compid="<?php echo $record->id; ?>"><i class="fa fa-trash"></i></a>
                                        </td>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common_company.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();
            var link = jQuery(this).get(0).href;
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "companiesListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
