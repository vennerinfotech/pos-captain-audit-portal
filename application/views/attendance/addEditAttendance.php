<script src="<?php echo base_url(); ?>assets/plugins/local/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/local/jquery.timepicker.min.css">
<script>
    $(function() {
        "use strict";
        $('#in_time').timepicker({
            timeFormat: 'HH:mm:ss',
            interval: 15,
            <?php if($encrypted_id == ''){ echo "defaultTime: 'now',"; } ?>
            dynamic: false,
            dropdown: false,
            scrollbar: false
        });

        $('#out_time').timepicker({
            timeFormat: 'HH:mm:ss',
            interval: 15,
            <?php if($encrypted_id != ''){ echo "defaultTime: 'now',"; } ?>
            dynamic: false,
            dropdown: false,
            scrollbar: false
        });
    })
</script>


<!-- Main content -->
<section class="main-content-wrapper">

    <section class="content-header">
        <h3 class="top-left-header">
            <?php echo lang('add_update_attendance'); ?>
        </h3>
    </section>


    <div class="box-wrapper">
            <!-- general form elements -->
            <div class="table-box">

                <?php echo form_open(base_url('Attendance/addEditAttendance/' . $encrypted_id) ); ?>
                <div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-lg-4 mb-2">
                            <div class="form-group">
                                <label><?php echo lang('ref_no'); ?></label>
                                <input tabindex="1" type="text" id="reference_no" readonly name="reference_no"
                                    class="form-control" placeholder="<?php echo lang('ref_no'); ?>"
                                    value="<?php echo escape_output($reference_no); ?>">
                            </div>
                            <?php if (form_error('reference_no')) { ?>
                            <div class="callout callout-danger my-2">
                                <?php echo form_error('reference_no'); ?>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-6 col-sm-12 col-lg-4 mb-2">
                            <div class="form-group">
                                <label><?php echo lang('date'); ?> <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" id="date" readonly name="date" class="form-control"
                                    placeholder="<?php echo lang('date'); ?>"
                                    value="<?php if($encrypted_id == ''){ echo  date('Y-m-d'); }else{ echo escape_output($attendance_details->date); }?>" readonly>
                            </div>
                            <?php if (form_error('date')) { ?>
                            <div class="callout callout-danger my-2">
                                <?php echo form_error('date'); ?>
                            </div>
                            <?php } ?>
                        </div>


                        <div class="col-md-6 col-sm-12 col-lg-4 mb-2">
                            <div class="form-group">
                                <label><?php echo lang('employee'); ?> <span class="required_star">*</span></label>
                                <select tabindex="3" class="form-control select2 ir_w_100" id="employee_id"
                                    name="employee_id">
                                    <option value=""><?php echo lang('select'); ?></option>
                                    <?php foreach ($employees as $value) { ?>

                                    <?php if($encrypted_id == ''){ ?>
                                    <option value="<?php echo escape_output($value->id) ?>"
                                        <?php echo set_select('value_id', $value->id); ?>>
                                        <?php echo escape_output($value->staff_name) ."-". $value->staff_designation ." (". $value->staff_phone.")"?>
                                    </option>
                                    <?php }else{ ?>
                                    <option value="<?php echo escape_output($value->id) ?>" <?php
                                            if ($attendance_details->employee_id == $value->id) {
                                                echo "selected";
                                            }
                                            ?>>
                                        <?php echo escape_output($value->staff_name) ."-". escape_output($value->staff_designation)."(". escape_output($value->staff_phone).")"?>
                                    </option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php if (form_error('employee_id')) { ?>
                            <div class="callout callout-danger my-2">
                                <?php echo form_error('employee_id'); ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-lg-4 mb-2" id="in_time_container">
                            <div class="form-group">
                                <label><?php echo lang('in_time'); ?>
                                    <?php if($encrypted_id == ''){ echo '<span class="required_star">*</span>'; } ?></label>
                                <input tabindex="2" type="text" name="in_time" id="in_time"
                                    class="form-control ir_w_100" placeholder="<?php echo lang('in_time'); ?>"
                                    value="<?php if($encrypted_id == ''){ echo set_value('in_time'); }else{ echo escape_output($attendance_details->in_time); }?>" readonly>
                            </div>
                            <?php if (form_error('in_time')) { ?>
                            <div class="callout callout-danger my-2">
                                <?php echo form_error('in_time'); ?>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-6 col-sm-12 col-lg-4 mb-2" id="out_time_container">
                            <div class="form-group">
                                <label><?php echo lang('out_time'); ?>
                                    <?php if($encrypted_id != ''){ echo '<span class="required_star">*</span>'; } ?></label>
                                <input tabindex="2" type="text" autocomplete="off" name="out_time" id="out_time"
                                    class="form-control ir_w_100" placeholder="<?php echo lang('out_time'); ?>"
                                    value="<?php if($encrypted_id == ''){ echo set_value('out_time'); }else{ echo escape_output($attendance_details->out_time); }?>" readonly>
                            </div>
                            <?php if (form_error('out_time')) { ?>
                            <div class="callout callout-danger my-2">
                                <?php echo form_error('out_time'); ?>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-6 col-sm-12 col-lg-4 mb-2">
                            <div class="form-group">
                                <label><?php echo lang('note'); ?></label>
                                <textarea tabindex="5" class="form-control" rows="4" name="note"
                                    placeholder="<?php echo lang('enter'); ?> ..."><?php echo escape_output($this->input->post('note')); ?></textarea>
                                <input tabindex="2" type="hidden" name="dataurl" id="dataurl"
                                    class="form-control ir_w_100">
                            </div>
                            <?php if (form_error('note')) { ?>
                            <div class="alert alert-error">
                                <?php echo form_error('note'); ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-lg-4 mb-2" id="in_time_container">
                            <div id="my_camera" style="width:100%;"></div>
                            
                        </div>
                        <div class="col-md-6 col-sm-12 col-lg-4 mb-2" id="out_time_container">
                            <div id="results" style="width:100%;"></div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

                <input type="hidden" name="in_or_out" value="">

                <div class="row">
                    <div class="col-sm-12 col-md-2 mb-2">
                        <input type=button class="btn bg-blue-btn w-100" value="Take Snapshot" onClick="take_snapshot()">
                            
                    </div>
                    <div class="col-sm-12 col-md-2 mb-2">
                        <button type="submit" name="submit" value="submit"
                            class="btn bg-blue-btn w-100"><?php echo lang('submit'); ?></button>
                    </div>
                    <div class="col-sm-12 col-md-2 mb-2">
                        <a class="btn bg-blue-btn w-100" href="<?php echo base_url() ?>Attendance/attendances">
                            <?php echo lang('back'); ?>
                        </a>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
    </div>
    
    
</section>

<!-- Webcam.min.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

<script language="JavaScript">
 Webcam.set({
    height: 240,
    image_format: 'jpeg',
    jpeg_quality: 90
 });
 Webcam.attach( '#my_camera' );

function take_snapshot() {
 
   // take snapshot and get image data
   Webcam.snap( function(data_uri) {
       // display results in page
       document.getElementById('results').innerHTML = 
        '<img src="'+data_uri+'"/>';
        document.getElementById("dataurl").value=data_uri;
    } );
}
</script>