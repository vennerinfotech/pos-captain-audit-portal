<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h3 class="text-center response_text" style="color:<?php echo escape_output($color)?>;"><?php echo escape_output($txt_return) ?></h3>
        <p class="text-center redirect_text"><b>Redirecting... <span class="counter">5</span></b></p>
    </div>
    <div class="col-md-4 col-md-offset-4 form_div">
        <h3 class="text-center">Purchase Verification</h3>
        <?php echo form_open(base_url() . 'Update/updateVerification', $arrayName = array('id' => 'update_verification')) ?>
        <div class="control-group letf_margin">
            <label class="control-label" for="username">Envato Username</label>
            <div class="controls">
                <input  id="username" type="text" name="username" class="input-large form-control txt_w_3" required="required" data-error="Username is required" value="<?=set_value('username')?>" placeholder="Username" />
            </div>
        </div>
        <div class="control-group letf_margin">
            <label class="control-label" for="purchase_code">Purchase Code</label>
            <div class="controls">
                <input id="purchase_code" type="text" name="purchase_code" class="input-large form-control txt_w_3" required="required" data-error="Purchase Code is required" value="<?=set_value('purchase_code')?>" placeholder="Purchase Code" />
            </div>
            <!-- modified -->
            <input id="owner" type="hidden" name="owner" class="input-large" value="doorsoftco"  />
        </div>
        <div class="bottom txt_w_2">
            <input type="submit" name="submit" class="btn btn-primary button_1"  value="Verify"/>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    let status = "<?=escape_output($status)?>";
    if(status==2){
        $(".response_text").show();
        $(".redirect_text").show();
        $(".form_div").hide();

        let timeInterval = 5;
        setInterval(function(){
            timeInterval--;
            if(timeInterval<1){
                window.location.href="<?php echo base_url()?>Update";
            }else{
                $(".counter").html(timeInterval);
            }
        }, 1000);
    }else if(status==1){
        $(".response_text").show();
        $(".redirect_text").hide();
    }else{
        $(".response_text").hide();
        $(".redirect_text").hide();
    }
</script>