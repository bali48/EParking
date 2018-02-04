<?php 

?>

<div class="container">
    <div class="row">
        <form method="post" action="frontend/bookmyvehicle">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Name:</label>
                    <label><?php echo ' ' . $userRecords[0]->name; ?></label>
                    <input type="hidden" name="comp" value="<?php echo $comp ; ?>"/>
                </div>
            </div>
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Phone:</label>
                    <label><?php echo ' ' . $userRecords[0]->mobile; ?></label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="Address">Address:</label>
                    <label><?php echo ' ' . $userRecords[0]->address; ?></label>
                </div> 
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="tout">Terminal Out:</label>
                    <input type="text" class="form-control" name= "tout" id="tout" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="tin">Terminal In:</label>
                    <input type="text" class="form-control" name= "tin" id="tin">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="outfilight">Outbond Flight:</label>
                    <input type="text" class="form-control" name= "outfilight" id="outfilight">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="returnfilight">Return Flight:</label>
                    <input type="text" class="form-control" name= "returnfilight" id="returnfilight">
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
                        <option id="<?php echo $value->id;?>" value="<?php echo $value->id;?>"><?php echo '<b>'.$value->vnumber.'</b>-'.$value->vname.'-'.$value->vmodel; ?></option>
                        <?php    }  
                        }
                        ?>
                    </select>
                </div> 
            </div>

            <div class="col-sm-6">
                <h3>Payment Details</h3>
                <div class="travel-details">
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-5">
                        <input type="radio" id="option-5" class="mdl-radio__button" name="paymentoptions" value="visa" onclick="myFunc5()" checked>
                        <span class="mdl-radio__label"><img src="<?php echo base_url(); ?>assets/images/visa.jpg"></span>
                    </label>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-6">
                        <input type="radio" id="option-6" class="mdl-radio__button" name="paymentoptions" value="paypal" onclick="myFunc6()">
                        <span class="mdl-radio__label"><img src="<?php echo base_url(); ?>assets/images/paypal.jpg"></span>
                    </label>
                </div>
            </div>
            <div class="row">
                <button class="btn btn-github btn-block btn-success" name="submit" type="submit">Booking</button>
            </div>
        </form>

    </div>

</div>

<!--<script src="<?php echo base_url(); ?>assets/js/main.js"></script>-->