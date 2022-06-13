

<section class="main-content-wrapper">
        <?php
        if ($this->session->flashdata('exception')) {

            echo '<section class="alert-wrapper"><div class="alert alert-success alert-dismissible fade show"> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-body"><p><i class="m-right fa fa-check"></i>';
            echo escape_output($this->session->flashdata('exception'));
            echo '</p></div></div></section>';
        }
        ?>

        <section class="content-header">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="top-left-header"><?php echo lang('staff'); ?> </h2>
                    <input type="hidden" class="datatable_name" data-title="<?php echo lang('staff'); ?>" data-id_name="datatable">
                </div>
                <div class="col-md-6">
                    <a class="btn_list m-right btn bg-blue-btn" href="<?php echo base_url() ?>Hr/addEditStaff">
                        <i data-feather="plus"></i> <?php echo lang('add_staff'); ?></a>
                </div>
            </div>
        </section>
    <div class="box-wrapper">
        
            <div class="table-box">
                <!-- /.box-header -->
                <div class="table-responsive">
                    <table id="datatable" class="table">
                        <thead>
                            <tr>
                                <th class="ir_w_1"> <?php echo lang('sn'); ?></th>
                                <th class="ir_w_8"><?php echo lang('name'); ?></th>
                                <th class="ir_w_10"><?php echo lang('designation'); ?></th>
                                <th class="ir_w_15"><?php echo lang('phone'); ?></th>
                                <th class="ir_w_16"><?php echo lang('salary'); ?></th>
                                <th class="ir_w_22"><?php echo lang('description'); ?></th>
                                <th class="ir_w_6 not-export-col"><?php echo lang('actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($staffdetails && !empty($staffdetails)) {
                                $i = count($staffdetails);
                            }
                            foreach ($staffdetails as $staff) {
                                ?>
                                <tr>
                                    <td class="ir_txt_center"><?php echo escape_output($i--); ?></td>
                                    <td>  <?php echo escape_output($staff->staff_name) ?>
                                    </td>
                                    <td><?php echo escape_output($staff->staff_designation); ?></td>
                                    <td><?php echo escape_output($staff->staff_phone); ?></td>
                                    <td><?php echo escape_output($staff->staff_salary); ?></td>
                                    <td><?php echo escape_output($staff->staff_description); ?></td>
                                    <td class="ir_txt_center">
                                        <div class="btn-group actionDropDownBtn">
                                            <button type="button" class="btn bg-blue-color dropdown-toggle"
                                                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1" role="menu">
                                                <?php if ($staff->active_status == 'Active') { ?>
                                                <li>
                                                    <a
                                                        href="<?php echo base_url() ?>Hr/deactivateUser/<?php echo escape_output($this->custom->encrypt_decrypt($staff->id, 'encrypt')); ?>"><i
                                                            class="fa fa-times tiny-icon"></i><?php echo lang('deactivate'); ?></a>
                                                </li>
                                                <?php } else { ?>
                                                <li>
                                                    <a
                                                        href="<?php echo base_url() ?>Hr/activateUser/<?php echo escape_output($this->custom->encrypt_decrypt($staff->id, 'encrypt')); ?>"><i
                                                            class="fa fa-check tiny-icon"></i><?php echo lang('activate'); ?></a>
                                                </li>
                                                <?php } ?>
                                                <li><a
                                                        href="<?php echo base_url() ?>Hr/addEditStaff/<?php echo escape_output($this->custom->encrypt_decrypt($staff->id, 'encrypt')); ?>"><i
                                                            class="fa fa-pencil tiny-icon"></i><?php echo lang('edit'); ?></a>
                                                </li>
                                                <li><a class="delete"
                                                        href="<?php echo base_url() ?>Hr/deleteStaff/<?php echo escape_output($this->custom->encrypt_decrypt($staff->id, 'encrypt')); ?>"><i
                                                            class="fa fa-trash tiny-icon"></i><?php echo lang('delete'); ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
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
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/js/dataTable/buttons.colVis.min.js"></script>
<script src="<?php echo base_url(); ?>frequent_changing/newDesign/js/forTable.js"></script>

<script src="<?php echo base_url(); ?>frequent_changing/js/custom_report.js"></script>