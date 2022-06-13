<!-- Main content -->
<section class="main-content-wrapper">
    <section class="content-header">
        <h3 class="top-lef-header">
            <?php echo lang('add_staff'); ?>
        </h3>
    </section>

    <div class="box-wrapper">   
        <div class="table-box">
            <!-- /.box-header -->
            <!-- form start -->
            <?php echo form_open(base_url('Hr/addEditStaff')); ?>
            <div>
                <div class="row">
                    <div class="col-sm-12 mb-2 col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('outlet'); ?> <span class="required_star">*</span></label>
                            <select tabindex="3" class="form-control select2 ir_w_100" name="category_id">
                                <option value=""><?php echo lang('select'); ?></option>
                                <?php foreach ($outlets as $ec) { ?>
                                    <option value="<?php echo escape_output($ec->id) ?>"
                                        <?php echo set_select('category_id', $ec->outlet_name); ?>><?php echo escape_output($ec->outlet_name) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php if (form_error('category_id')) { ?>
                            <div class="callout callout-danger my-2">
                                <?php echo form_error('category_id'); ?>
                            </div>
                        <?php } ?>

                        <div class="form-group">
                            <label><?php echo lang('name'); ?> <span class="required_star">*</span></label>
                            <input tabindex="2" type="text" name="name" class="form-control" placeholder="<?php echo lang('name'); ?>"
                            value="<?php echo set_value('name'); ?>">
                        </div>
                        <?php if (form_error('name')) { ?>
                            <div class="callout callout-danger my-2">
                                <?php echo form_error('name'); ?>
                            </div>
                        <?php } ?>

                        <div class="form-group">
                            <label><?php echo lang('designation'); ?> <span class="required_star">*</span></label>
                            <input tabindex="2" type="text" name="designation" class="form-control" placeholder="<?php echo lang('designation'); ?>"
                            value="<?php echo set_value('designation'); ?>">
                        </div>
                        <?php if (form_error('designation')) { ?>
                            <div class="callout callout-danger my-2">
                                <?php echo form_error('designation'); ?>
                            </div>
                        <?php } ?>  

                        <div class="form-group">
                            <label><?php echo lang('salary'); ?> <span class="required_star">*</span></label>
                            <input tabindex="2" type="text" name="salary" class="form-control" placeholder="<?php echo lang('salary'); ?>"
                            value="<?php echo set_value('salary'); ?>">
                        </div>
                        <?php if (form_error('salary')) { ?>
                            <div class="callout callout-danger my-2">
                                <?php echo form_error('salary'); ?>
                            </div>
                        <?php } ?>                      

                    </div>
                    <div class="col-sm-12 mb-2 col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('phone'); ?> <span class="required_star">*</span></label>
                            <input tabindex="2" type="text" name="phone" class="form-control integerchk"
                                placeholder="<?php echo lang('phone'); ?>"
                                value="<?php echo set_value('phone'); ?>">
                        </div>
                        <?php if (form_error('phone')) { ?>
                            <div class="callout callout-danger my-2">
                                <span class="error_paragraph"><?php echo form_error('phone'); ?></span>
                            </div>
                        <?php } ?>

                        <div class="form-group">
                            <label><?php echo lang('description'); ?> <span class="required_star">*</span></label>
                            <input tabindex="2" type="text" name="description" class="form-control" placeholder="<?php echo lang('description'); ?>"
                            value="<?php echo set_value('description'); ?>">
                        </div>
                        <?php if (form_error('description')) { ?>
                            <div class="callout callout-danger my-2">
                                <?php echo form_error('description'); ?>
                            </div>
                        <?php } ?>

                        <div class="form-group">
                            <label><?php echo lang('joining'); ?> <?php echo lang('date'); ?> <span class="required_star">*</span></label>
                            <input tabindex="3" readonly type="text" id="date" name="date" class="form-control"
                                placeholder="<?php echo lang('date'); ?>" >
                        </div>
                        <?php if (form_error('date')) { ?>
                        <div class="callout callout-danger my-2">
                            <?php echo form_error('date'); ?>
                        </div>
                        <?php } ?>

                        <!-- /.box-body -->
                    </div>

                    <div class="box-footer p-0 mt-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 mb-2">
                                <button type="submit" name="submit" value="submit"
                                class="btn bg-blue-btn w-100"><?php echo lang('submit'); ?></button>
                            </div>
                            <div class="col-sm-12 col-md-2 mb-2">
                             <a class="btn bg-blue-btn w-100"href="<?php echo base_url() ?>Hr/staff">
                                <?php echo lang('back'); ?>
                            </a>
                        </div>
                    </div>
                    
                    
                </div>
                <?php echo form_close(); ?>
            </div>

        </div>
    </section>