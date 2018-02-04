<?php
$isLoggedIn = $this->session->userdata('isLoggedIn');

if (!isset($isLoggedIn) || $isLoggedIn !== TRUE) {
    redirect('/');
} else {
    ?>
    <link href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <style>
        a{
            text-decoration: none !important
        }
    </style>
    <div class="container">

        <div class="row" style="margin-top: 10px">
            <div class="col-sm-2">

                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="<?php echo base_url(); ?>mybookings">My Bookings</a>
                    </li>
                    <li class="list-group-item">
                        <a href="<?php echo base_url(); ?>mybookings">Previous Bookings</a>
                    </li>
                    <li class="list-group-item">
                        <a href="<?php echo base_url(); ?>mybookings">Profile</a>
                    </li>
                </ul>
            </div>   
            <div class="col-sm-10">
                
                <table id="bookinglist" class="display" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Company</th>
                            <th>Vehical Name</th>
                            <th>Vehical Model</th>
                            <th>Status</th>
                            <th>Amount Pay</th>
                            <th>Booking From</th>
                            <th>Booking To</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!empty($userRecords)){
                            foreach ($userRecords as $ur) {
                                ?>
                        <tr>
                    <td><?php echo $ur->id; ?></td>
                    <td><?php echo $ur->name; ?></td>
                    <td><?php echo $ur->vname; ?></td>
                    <td><?php echo $ur->vmodel; ?></td>
                    <td><?php echo $ur->status; ?></td>
                    <td><?php echo $ur->pay; ?></td>
                    <td><?php echo $ur->bookingfrom; ?></td>
                    <td><?php echo $ur->bookingto; ?></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function () {
            $('#bookinglist').DataTable();
        });
    </script>
    <?php
}
?>
