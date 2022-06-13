<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/custom/report.css">

<section class="main-content-wrapper">
    <section class="content-header">
        <h3 class="top-left-header text-left"><?php echo lang('Ingredient_Purchases_Report'); ?></h3>
        <input type="hidden" class="datatable_name" data-id_name="datatable">
    </section>
    <div class="box-wrapper">
        <div class="row mb-3">
            <div class="col-sm-12 col-md-4 col-lg-2 mb-3">
                <?php echo form_open(base_url() . 'Report/purchaseReportByIngredient', $arrayName = array('id' => 'purchaseReportByIngredient')) ?>
                <div class="form-group">
                    <input tabindex="1" type="text" id="" name="startDate" readonly class="form-control customDatepicker"
                        placeholder="<?php echo lang('Start_Date'); ?>" value="<?php echo set_value('startDate'); ?>">
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-2 mb-3">
                <div class="form-group">
                    <input tabindex="2" type="text" id="endMonth" name="endDate" readonly
                        class="form-control customDatepicker" placeholder="<?php echo lang('End_Date'); ?>"
                        value="<?php echo set_value('endDate'); ?>">
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-2 mb-3">
                <div class="form-group">
                    <select tabindex="2" class="form-control select2 ir_w_100" id="ingredients_id" name="ingredients_id">
                        <option value=""><?php echo lang('ingredients'); ?></option>
                        <?php
                        foreach ($ingredients as $value) {
                            ?>
                        <option value="<?php echo escape_output($value->id) ?>" <?php echo set_select('ingredients_id', $value->id); ?>>
                            <?php echo substr(ucwords(strtolower($value->name)), 0, 50) . " <span>(" . $value->code . ")</span>"; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="callout callout-danger my-2 error-msg ingredients_id_err_msg_contnr">
                    <p id="ingredients_id_err_msg"></p>
                </div>
            </div>
            <?php
            if(isLMni()):
                ?>
                <div class="col-md-2">
                    <div class="form-group">
                        <select tabindex="2" class="form-control select2 ir_w_100" id="outlet_id" name="outlet_id">
                            <?php 
                                $outletid = $this->session->userdata('outlet_id');
                                $outletname = $this->session->userdata('outlet_name');
                                if($outletid == 1)
                                { 
                                    $outlets = getAllOutlestByAssign();
                                    foreach ($outlets as $value):
                                        ?>
                                        <option <?= set_select('outlet_id',$value->id)?>  value="<?php echo escape_output($value->id) ?>"><?php echo escape_output($value->outlet_name) ?></option>
                                        <?php
                                    endforeach; 
                                }
                                else
                                {?>
                                    <option <?= set_select('outlet_id',$outletid)?>  value="<?php echo escape_output($outletid) ?>"><?php echo escape_output($outletname) ?></option>
                                <?php }

                            ?>
                        </select>
                    </div>
                </div>
                <?php
            endif;
            ?>
            <div class="col-sm-12 col-md-4 col-lg-2">
                <div class="form-group">
                    <button type="submit" name="submit" value="submit"
                        class="btn bg-blue-btn w-100"><?php echo lang('submit'); ?></button>
                </div>
            </div>
        </div>
        <div class="table-box">
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    
                    <table id="datatable" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="ir_w2_txt_center"><?php echo lang('sn'); ?></th>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('Ingredient_Code'); ?></th>
                                <th><?php echo lang('qty'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $pGrandTotal = 0;
                            if (isset($purchaseReportByIngredient)):
                                foreach ($purchaseReportByIngredient as $key => $value) {
                                    $pGrandTotal+=$value->totalQuantity_amount;
                                    $key++;
                                    ?>
                            <tr>
                                <td class="ir_txt_center"><?php echo escape_output($key); ?></td>
                                <td><?= escape_output(date($this->session->userdata('date_format'), strtotime($value->date))) ?></td>
                                <td><?php echo escape_output($value->name) . "(" . $value->code . ")" ?></td>
                                <td><?php echo escape_output($value->totalQuantity_amount) ?></td>
                            </tr>
                            <?php
                                }
                            endif;
                            ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th class="ir_w2_txt_center"></th>
                            <th></th>
                            <th class="ir_txt_right"><?php echo lang('total'); ?> </th>
                            <th><?php echo escape_output($pGrandTotal); ?></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            
        </div>
    </div>
    </div>
</section>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/datatable_custom/jquery-3.3.1.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatable_custom/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatable_custom/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatable_custom/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatable_custom/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatable_custom/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/datatable_custom/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatable_custom/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/newDesign/js/forTable.js"></script>

<script src="<?php echo base_url(); ?>frequent_changing/js/custom_report.js"></script>