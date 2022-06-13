<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/custom/report.css">

<section class="main-content-wrapper">
    <section class="content-header">
        <h3 class="top-left-header text-left"><?php echo lang('monthly_sale_report'); ?></h3>
        <input type="hidden" class="datatable_name" data-id_name="datatable">
    </section>

    <div class="box-wrapper">
        <div class="row my-2">
            <div class="col-sm-12 mb-3 col-md-4 col-lg-2">
                <?php echo form_open(base_url() . 'Report/saleReportByMonth') ?>
                <div class="form-group">
                    <input tabindex="1" type="text" id="" name="startMonth" readonly class="form-control datepicker_months"
                        placeholder="<?php echo lang('Start_Month'); ?>" value="<?php echo set_value('startMonth'); ?>">
                </div>
            </div>
            <div class="col-sm-12 mb-3 col-md-4 col-lg-2">
                <div class="form-group">
                    <input tabindex="1" type="text" id="endMonth" name="endMonth" readonly
                        class="form-control datepicker_months" placeholder="<?php echo lang('End_Month'); ?>"
                        value="<?php echo set_value('endMonth'); ?>">
                </div>
            </div>
            <div class="col-sm-12 mb-3 col-md-4 col-lg-2">
                <div class="form-group">
                    <select tabindex="2" class="form-control select2 ir_w_100" id="user_id" name="user_id">
                        <option value=""><?php echo lang('user'); ?></option>
                        <!-- <option value="<?= escape_output($this->session->userdata['user_id']); ?>">
                            <?= escape_output($this->session->userdata['full_name']); ?></option> -->
                        <?php
                        foreach ($users as $value) {
                            ?>
                        <option value="<?php echo escape_output($value->id) ?>" <?php echo set_select('user_id', $value->id); ?>>
                            <?php echo escape_output($value->full_name) ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <?php
            if(isLMni()):
            ?>
            <div class="col-sm-12 mb-3 col-md-4 col-lg-2">
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
                                    <option <?= set_select('outlet_id',$value->id)?>  value="<?php echo escape_output($value->id) ?>"><?php echo escape_output($value->outlet_name) ?> <?php echo escape_output($value->id) ?></option>
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
            <div class="col-sm-12 mb-3 col-md-4 col-lg-1">
                <div class="form-group">
                    <button type="submit" name="submit" value="submit" class="btn btn-block btn-primary pull-left"><?php echo lang('Submit'); ?></button>
                </div>
            </div>
        </div>
        <div class="table-box">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <?php
                if(isLMni() && isset($outlet_id)):
                    ?>
                    <h4> <?php echo lang('outlet'); ?>: <?php echo escape_output(getOutletNameById($outlet_id))?></h4>
                    <?php
                endif;
                ?>
                <h4 class="ir_txtCenter_mt0"><?php
                if (isset($user_id) && $user_id):
                    echo "User: " . userName($user_id) . "</span>";
                endif;
                ?></h4>
                <h4><?= isset($start_date) && $start_date && isset($end_date) && $end_date ? lang('date').": " . date($this->session->userdata('date_format'), strtotime($start_date)) . " - " . date($this->session->userdata('date_format'), strtotime($end_date)) : '' ?>
                </h4>
                <table id="datatable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="ir_w2_txt_center"><?php echo lang('sn'); ?></th>
                            <th><?php echo lang('month'); ?></th>
                            <th><?php echo lang('Total_Sale'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $grandTotal = 0;

                        if (isset($saleReportByMonth)):
                            foreach ($saleReportByMonth as $key => $value) {
                                $grandTotal+=$value->total_payable;
                                $key++;
                                ?>
                        <tr>
                            <td class="ir_txt_center"><?php echo escape_output($key); ?></td>
                            <td><?= escape_output(date('M-Y', strtotime($value->sale_date))) ?></td>
                            <td><?php echo escape_output(getAmt($value->total_payable)) ?></td>
                        </tr>
                        <?php
                            }
                        endif;
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="ir_w2_txt_center"></th>
                            <th class="ir_txt_right"><?php echo lang('total'); ?> </th>
                            <th>
                                <?php echo escape_output(getAmt($grandTotal)) ?>
                            </th>
                        </tr>

                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</section>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/datatable_custom/jquery-3.3.1.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
</script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/newDesign/js/forTable.js"></script>

<script src="<?php echo base_url(); ?>frequent_changing/js/custom_report.js"></script>