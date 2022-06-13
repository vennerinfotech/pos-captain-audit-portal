<link rel="stylesheet" href="<?= base_url('assets/') ?>buttonCSS/checkBotton.css">

 <section class="main-content-wrapper">
    <section class="content-header">
        <h3 class="top-left-header">
            <?php echo lang('add'); ?> <?php echo lang('closing'); ?>
        </h3>
    </section>

    <div class="box-wrapper">
        <div class="table-box">
                 <!-- form start -->
                 <?php echo form_open(base_url('closing/addEditClosing')); ?>
                 <div>
                     <div class="row">
                        <div class="row my-3">
                            <div class="col-sm-12 mb-2 col-md-4">
                                <div class="form-group">
                                    <label><?php echo lang('add'); ?> <?php echo lang('tooltip_txt_33'); ?> </label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-12 mb-2 col-md-4">
                                <label class="container txt_47"> <?php echo lang('select_all'); ?>
                                    <input class="checkbox_userAll" type="checkbox" id="checkbox_userAll">
                                    <span class="checkmark"></span>
                                </label>
                            </div>    
                        </div>

                        <?php
                        foreach ($items as $item) {
                            ?>
                            <div class="col-sm-6 mb-3 col-md-6 col-lg-4">
                                <label class="container txt_47"> <?=$item->name?>
                                    <input class="checkbox_user  parent_class" data-name="<?php echo str_replace(' ', '_', $item->name)?>" value="<?=$item->id?>" type="checkbox" name="item_check[]">
                                    <span class="checkmark"></span>
                                </label>
                                <div class="row">
                                    <div class="col-sm-6 mb-3 col-md-6 col-lg-6">
                                        <input type="hidden" value="<?=$item->unit_id?>" name="unit_<?php echo $item->id?>" placeholder="Unit" class="form-control txt_outlet_2">
                                        <input readonly="true" type="text" value="<?=$item->unitname?>" placeholder="Unit" onfocus="select()" class="form-control txt_outlet_2">
                                    </div>
                                    <div class="col-sm-6 mb-3 col-md-6 col-lg-6">
                                        <input  type="text" name="qty_<?php echo $item->id?>" placeholder="Quantity" onfocus="select()" class="form-control txt_outlet_2">
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        

                    </div>
            </div>
                 <!-- /.box-body -->

                 <div class="row mt-2">
                     <div class="col-sm-12 col-md-2 mb-2">
                        <button type="submit" name="submit" value="submit"
                         class="btn bg-blue-btn w-100"><?php echo lang('submit'); ?></button>
                     </div>
                     <div class="col-sm-12 col-md-2 mb-2">
                        <a class="btn bg-blue-btn w-100" href="<?php echo base_url() ?>ingredient/ingredients">
                            <?php echo lang('back'); ?>
                        </a>
                     </div>
                 </div>
                 <?php echo form_close(); ?>
        </div>
    </div>
 </section>
 <script type="text/javascript" src="<?php echo base_url('frequent_changing/js/add_closing.js'); ?>"></script>