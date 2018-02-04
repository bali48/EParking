<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$vehicaleid = '';
$outgoingflightno = '';
$terminalin = '';
$terminalout = '';
$returnflightno = '';
if($bookingdetail != NULL){
    $vehicaleid = $bookingdetail[0]->vehicaleid;
    $outgoingflightno = $bookingdetail[0]->outgoingflightno;
    $terminalin = $bookingdetail[0]->terminalin;
    $terminalout = $bookingdetail[0]->terminalout; 
    $returnflightno = $bookingdetail[0]->returnflightno;
}
?>
<div class="container">
    <div class="row">
        <form method="post" action="<?php echo base_url() ?>frontend/updatemyvehicle">
            
            
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="tout">Terminal Out:</label>
                    <input type="text" class="form-control" name= "tout" id="tout" value="<?php echo $terminalout; ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="tin">Terminal In:</label>
                    <input type="text" class="form-control" name= "tin" id="tin" value="<?php echo $terminalin; ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="outfilight">Outbond Flight:</label>
                    <input type="text" class="form-control" name= "outfilight" id="outfilight" value="<?php echo $outgoingflightno; ?>">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="returnfilight">Return Flight:</label>
                    <input type="text" class="form-control" name= "returnfilight" id="returnfilight" value="<?php echo $returnflightno; ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="vehicle">Select Vehicle:</label>
                    <select class="form-control" id="vehicle" name="vehicle">
                        <option id="no">Select one</option>
                        <?php
                        if($userVehicals != NULL){
                            foreach ($userVehicals as $value) { ?>
                        <option id="<?php echo $value->id;?>" value="<?php echo $value->id;?>" <?php if($value->id == $vehicaleid){ echo 'selected';}?> ><?php echo $value->vnumber.'-'.$value->vname.'-'.$value->vmodel; ?></option>
                        <?php    }  
                        }
                        ?>
                    </select>
                </div> 
            </div>


            <div class="row">
                <button class="btn btn-github btn-block btn-success" name="submit" type="submit">Update Booking Details</button>
            </div>
        </form>

    </div>

</div>