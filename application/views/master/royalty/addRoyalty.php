

<section class="main-content-wrapper">
    <section class="content-header">
        <h3 class="top-left-header">
            <?php echo lang('add_royalty'); ?>
        </h3>
    </section>

    
        <div class="box-wrapper">
            <!-- general form elements -->
            <div class="table-box">
                <!-- form start -->
                <?php echo form_open(base_url('royalty/addEditRoyalty')); ?>
                <div>
                    <div class="row">
                        <div class="col-sm-12 mb-2 col-md-4">

                            <div class="form-group">
                                <label><?php echo lang('outlet'); ?> <span class="required_star">*</span></label>
                               <select class="form-control select2" name="outlet" id="outlet">
                                   <?php
                                    foreach ($outlets as $outlet):
                                   ?>
                                   <option value="<?php echo escape_output($outlet->id)?>"><?php echo escape_output($outlet->outlet_name)?></option>
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
                                    value="<?=date('Y-m')?>">
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
                                   <option value="Paid">Paid</option>
                                   <option value="Unpaid">Unpaid</option>
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
                                       value="<?=date('Y-m-d')?>">
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
                                       value="<?php echo set_value('sale_amount'); ?>">
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
                                <input tabindex="2" type="number" name="royaltyamount" id="royaltyamount" class="form-control" placeholder="<?php echo lang('royalty').' '.lang('amount'); ?>">
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
                                <input tabindex="2" type="number" name="gstroyaltyamount" id="gstroyaltyamount" class="form-control" placeholder="<?php echo lang('royalty').' '.lang('amount'); ?>">
                            </div>
                            <?php if (form_error('royalty')) { ?>
                                <div class="callout callout-danger my-2">
                                    <?php echo form_error('royalty'); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label class="container txt_47"> Company Employee visits done at store (Follow Visit Book)
                                    <input class="checkbox_user  parent_class" value="Company Employee visits done at store (Follow Visit Book)" type="checkbox" name="item_check[]">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container txt_47"> Social Media Marketing Designs regular updated. (Details Available in Company group)
                                    <input class="checkbox_user  parent_class" value="Social Media Marketing Designs regular updated. (Details Available in Company group)" type="checkbox" name="item_check[]">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container txt_47"> All Days POS Support without any interruption.
                                    <input class="checkbox_user  parent_class" value="All Days POS Support without any interruption." type="checkbox" name="item_check[]">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container txt_47"> Company Employee had managed successfully opening event at store.
                                    <input class="checkbox_user  parent_class" value="Company Employee had managed successfully opening event at store." type="checkbox" name="item_check[]">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container txt_47"> Complete raw material arrival direct at store regularly
                                    <input class="checkbox_user  parent_class" value="Complete raw material arrival direct at store regularly" type="checkbox" name="item_check[]">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container txt_47"> WhatsApp Marketing done multiple times in a month
                                    <input class="checkbox_user  parent_class" value="WhatsApp Marketing done multiple times in a month" type="checkbox" name="item_check[]">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container txt_47"> Regular sharing of new Post and Story/Reels for Social Media.
                                    <input class="checkbox_user  parent_class" value="Regular sharing of new Post and Story/Reels for Social Media." type="checkbox" name="item_check[]">
                                    <span class="checkmark"></span>
                                </label>
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
<script src="<?php echo base_url(); ?>frequent_changing/js/add_royalty.js"></script>