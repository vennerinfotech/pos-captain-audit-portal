

<section class="main-content-wrapper">
    <section class="content-header">
        <h3 class="top-left-header">
            <?php echo lang('edit_table'); ?>
        </h3>
    </section>

    
        <div class="box-wrapper">
            
            <div class="table-box">
                
                <?php echo form_open(base_url('royalty/addEditRoyalty/' . $encrypted_id)); ?>
                <div>
                    <div class="row">
                        <div class="col-sm-12 mb-2 col-md-4">

                            <div class="form-group">
                                <label><?php echo lang('outlet'); ?> <span class="required_star">*</span></label>
                               <select class="form-control select2" name="outlet" id="outlet">
                                   <?php
                                    foreach ($outlets as $outlet):
                                   ?>
                                   <option <?=isset($table_information->storeid) && $table_information->storeid == $outlet->id?'selected':''?> value="<?php echo escape_output($outlet->id)?>"><?php echo escape_output($outlet->outlet_name)?></option>
                                   <?php
                                   endforeach;
                                   ?>
                               </select>
                            </div>
                            <?php if (form_error('outlet')) { ?>
                                <div class="callout callout-danger my-2">
                                    <?php echo form_error('outlet'); ?>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label><?php echo lang('month'); ?> <span class="required_star">*</span></label>
                                <input tabindex="1" id="months" type="month" name="month" class="form-control"
                                    placeholder="<?php echo lang('month'); ?>"
                                    value="<?php echo escape_output($table_information->royaltymonth) ?>">
                            </div>
                            <?php if (form_error('month')) { ?>
                            <div class="callout callout-danger my-2">
                                <?php echo form_error('month'); ?>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="col-sm-12 mb-2 col-md-4">

                            <div class="form-group">
                                <label><?php echo lang('status'); ?></label>
                               <select class="form-control select2" name="status">
                                   <option <?=isset($table_information->status) && $table_information->status == 'Paid'?'selected':''?> value="Paid">Paid</option>
                                   <option <?=isset($table_information->status) && $table_information->status == 'Unpaid'?'selected':''?> value="Unpaid">Unpaid</option>
                               </select>
                            </div>
                            <?php if (form_error('status')) { ?>
                            <div class="callout callout-danger my-2">
                                <?php echo form_error('status'); ?>
                            </div>
                            <?php } ?>

                        </div>
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label><?php echo lang('date'); ?> <span class="required_star">*</span></label>
                                <input tabindex="1" type="date" name="date" class="form-control"
                                       placeholder="<?php echo lang('date'); ?>"
                                       value="<?php echo escape_output($table_information->date)?>">
                            </div>
                            <?php if (form_error('date')) { ?>
                                <div class="callout callout-danger my-2">
                                    <?php echo form_error('date'); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label><?php echo lang('sale_amount'); ?> <span class="required_star">*</span></label>
                                <input tabindex="2" type="number" id="saleamount" name="saleamount" class="form-control"
                                       placeholder="<?php echo lang('sale_amount'); ?>"
                                       value="<?php echo escape_output($table_information->totalsale)?>">
                            </div>
                            <?php if (form_error('sale_amount')) { ?>
                                <div class="callout callout-danger my-2">
                                    <?php echo form_error('sale_amount'); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label><?php echo lang('royalty').' '.lang('amount').' '.'(Without GST)'; ?> <span class="required_star">*</span></label>
                                <input tabindex="2" type="number" name="royaltyamount" id="royaltyamount" class="form-control" value="<?php echo escape_output($table_information->royaltyamount)?>" placeholder="<?php echo lang('royalty').' '.lang('amount'); ?>">
                            </div>
                            <?php if (form_error('royalty')) { ?>
                                <div class="callout callout-danger my-2">
                                    <?php echo form_error('royalty'); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label><?php echo lang('royalty').' '.lang('amount').' '.'(With GST)'; ?> <span class="required_star">*</span></label>
                                <input tabindex="2" type="number" name="gstroyaltyamount" id="gstroyaltyamount" value="<?php echo escape_output($table_information->gstroyaltyamount)?>" class="form-control" placeholder="<?php echo lang('royalty').' '.lang('amount'); ?>">
                            </div>
                            <?php if (form_error('royalty')) { ?>
                                <div class="callout callout-danger my-2">
                                    <?php echo form_error('royalty'); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <?php
                                    $Values = array("Company Employee visits done at store (Follow Visit Book)","Social Media Marketing Designs regular updated. (Details Available in Company group)","All Days POS Support without any interruption.","Company Employee had managed successfully opening event at store.","Complete raw material arrival direct at store regularly","WhatsApp Marketing done multiple times in a month","Regular sharing of new Post and Story/Reels for Social Media."); 

                                    $selected_modules =  explode(',',$table_information->item_check);
                                    $arr_1 = array_diff($Values, $selected_modules);
                                    $result = array_intersect($Values, $selected_modules);
                                                                        
                                    foreach ($result as $item) {?>
                                        <label class="container txt_47"><?=$item?>
                                            <input class="checkbox_user  parent_class" checked value="<?=$item?>" type="checkbox" name="item_check[]">
                                            <span class="checkmark"></span>
                                        </label>
                                    <?php }
                                    foreach ($arr_1 as $item1) {?>
                                        <label class="container txt_47"><?=$item1?>
                                            <input class="checkbox_user  parent_class" value="<?=$item1?>" type="checkbox" name="item_check[]">
                                            <span class="checkmark"></span>
                                        </label>
                                    <?php }

                                     ?>
                            </div>
                            <?php if (form_error('royalty')) { ?>
                                <div class="callout callout-danger my-2">
                                    <?php echo form_error('royalty'); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-12 col-md-2 mb-2">
                        <button type="submit" name="submit" value="submit"
                        class="btn bg-blue-btn w-100"><?php echo lang('submit'); ?></button>
                    </div>
                    <div class="col-sm-12 col-md-2 mb-2">
                        <a class="btn bg-blue-btn w-100" href="<?php echo base_url() ?>royalty/royalty">
                            <?php echo lang('back'); ?></a>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        
</section>
<script src="<?php echo base_url(); ?>frequent_changing/js/edit_royalty.js"></script>