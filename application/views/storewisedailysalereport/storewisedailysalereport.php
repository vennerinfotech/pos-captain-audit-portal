


 <section class="main-content-wrapper">
    <?php
        if ($this->session->flashdata('exception')) {

            echo '<section class="alert-wrapper">
            <div class="alert alert-success alert-dismissible fade show"> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-body">
            <p class="m-0"><i class="icon fa fa-check"></i>';
            echo escape_output($this->session->flashdata('exception'));
            echo '</p></div></div></section>';
        }
        $plusSVG= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>';

    ?>

        <section class="content-header">
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <h3 class="top-left-header"><?php echo lang('storewisedailysalereport'); ?> </h3>
                    <input type="hidden" class="datatable_name" data-title="<?php echo lang('purchases'); ?>" data-id_name="datatable">
                </div>
                <div class="col-sm-12 col-md-4">
                    <!-- <a class="btn_list m-right btn bg-blue-btn" href="<?php echo base_url() ?>Purchase/addEditPurchase">
                        <?php echo $plusSVG?> <?php echo lang('add_purchase'); ?>
                    </a> -->
                </div>
            </div>
        </section>

     <div class="box-wrapper">
        <div class="row my-2">
                <div class="col-sm-12 mb-3 col-md-4 col-lg-2">
                    <?php echo form_open(base_url() . 'StoreWiseDailySaleReport/GetDailySaleReportByStore') ?>
                    <div class="form-group">
                        <input tabindex="1" type="text" id="" name="startDate" readonly class="form-control customDatepicker"
                            placeholder="<?php echo lang('start_date'); ?>" value="<?php echo set_value('startDate'); ?>">
                    </div>
                </div>
                <div class="col-sm-12 mb-3 col-md-4 col-lg-2">

                    <div class="form-group">
                        <input tabindex="2" type="text" id="endMonth" name="endDate" readonly
                            class="form-control customDatepicker" placeholder="<?php echo lang('end_date'); ?>"
                            value="<?php echo set_value('endDate'); ?>">
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-2">
                    <div class="form-group">
                        <button type="submit" name="submit" value="submit"
                            class="btn w-100 bg-blue-btn"><?php echo lang('submit'); ?></button>
                    </div>
                </div>
            </div>
        <div class="table-box">
                 <!-- /.box-header -->
                 <div class="table-responsive">
                     <table id="datatable" class="table table-responsive">
                         <thead>
                             <tr>
                                <th class="ir_w2_txt_center"><?php echo lang('sn'); ?></th>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('outlet'); ?></th>
                                <th><?php echo lang('total_sale'); ?></th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php
                            $grandTotal = 0;
                            if (isset($StoreSaleReportByDate)):
                                foreach ($StoreSaleReportByDate as $key => $value) {
                                    $grandTotal+=$value->total_payable;
                                    $key++;
                                    ?>
                            <tr>
                                <td class="ir_txt_center"><?php echo escape_output($key); ?></td>
                                <td><?= escape_output(date($this->session->userdata('date_format'), strtotime($value->sale_date))) ?>
                                </td>
                                <td><?= escape_output(getOutletNameById($value->outlet_id)) ?>
                                </td>
                                <td><?php echo escape_output(getAmt($value->total_payable)) ?></td>
                            </tr>
                            <?php
                                }
                            endif;
                            ?>
                         </tbody>
                         
                     </table>
                 </div>
                 <!-- /.box-body -->
        </div>
     </div>
 </section>
 <script src="<?php echo base_url(); ?>frequent_changing/js/inventory.js"></script>
 
 <!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/datatable_custom/jquery-3.3.1.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/buttons.colVis.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/newDesign/js/forTable.js"></script>



 <script src="<?php echo base_url(); ?>frequent_changing/js/custom_report.js"></script>

