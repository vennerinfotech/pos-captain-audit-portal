

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
                    <h2 class="top-left-header"><?php echo lang('closing'); ?> </h2>
                    <input type="hidden" class="datatable_name" data-title="<?php echo lang('closing'); ?>" data-id_name="datatable">
                </div>
                <div class="col-md-offset-2 col-md-4">
                    
                    <div class="btn_list m-right d-flex">
                            <a class="btn bg-blue-btn m-right" href="<?php echo base_url() ?>closing/addEditClosing">
                                <i data-feather="plus"></i> <?php echo lang('add_closing'); ?>
                            </a>
                    </div>
                </div>

            </div>
        </section>


        
        <div class="box-wrapper">
            <!-- general form elements -->
            <div class="table-box">
                <!-- /.box-header -->
                <div class="table-responsive">
                    <table id="datatable" class="table">
                        <thead>
                            <tr>
                                <th class="ir_w_2"> <?php echo lang('sn'); ?></th>
                                <th class="ir_w_15"><?php echo lang('ingredient_name'); ?></th>
                                <th class="ir_w_15"><?php echo lang('units'); ?></th>
                                <th class="ir_w_15"><?php echo lang('quantity'); ?></th>
                                <th class="ir_w_4"><?php echo lang('added_by'); ?></th>
                                <th class="ir_w_1 ir_txt_center not-export-col"><?php echo lang('actions');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($ingredients && !empty($ingredients)) {
                                $i = count($ingredients);
                            }

                            foreach ($ingredients as $ingrnts) {
                                $categories = '';
                                $cats = explode(",", escape_output($ingrnts->ingredient_id));
                                $total_selected = sizeof($cats);
                                $cnt = 1;
                                $sale_price = '';
                                $sale_price1 = '';
                                foreach($cats as $cat) {

                                    $previous_price = (array)json_decode($ingrnts->ingredient_unit);
                                    $units = isset($previous_price["tmp".$cat]) && $previous_price["tmp".$cat]?$previous_price["tmp".$cat]:"";
                                    $sale_price .=escape_output(unitName($units));

                                    $previous_price1 = (array)json_decode($ingrnts->ingredient_qty);
                                    $sale_price1 .= isset($previous_price1["tmp".$cat]) && $previous_price1["tmp".$cat]?$previous_price1["tmp".$cat]:"";

                                    $categories .= escape_output(getIngredientNameById($cat));
                                    if($total_selected > $cnt){
                                        $categories .= ",";
                                        $sale_price .=",";
                                        $sale_price1 .=",";
                                        $cnt++;
                                    }
                                }
                                ?>
                            <tr>
                                <td class="ir_txt_center"><?php echo escape_output($i--); ?></td>
                                <td><?php echo escape_output($categories); ?></td>
                                <td><?php echo escape_output($sale_price);?></td>
                                <td><?php echo escape_output($sale_price1) ?></td>
                                <td><?php echo escape_output(userName($ingrnts->company_id)); ?></td>
                                <td class="ir_txt_center">
                                    <div class="btn-group  actionDropDownBtn">
                                        <button type="button" class="btn bg-blue-color dropdown-toggle"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1" role="menu">
                                            <li><a
                                                    href="<?php echo base_url() ?>closing/addEditClosing/<?php echo escape_output($this->custom->encrypt_decrypt($ingrnts->id, 'encrypt')); ?>"><i
                                                        class="fa fa-pencil tiny-icon"></i><?php echo lang('edit'); ?></a></li>
                                            <li><a class="delete"
                                                    href="<?php echo base_url() ?>closing/deleteClosing/<?php echo escape_output($this->custom->encrypt_decrypt($ingrnts->id, 'encrypt')); ?>"><i
                                                        class="fa fa-trash tiny-icon"></i><?php echo lang('delete'); ?></a></li>
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

<div class="modal fade" id="uploadingredentsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-2x">×</i></span></button>
            </div>
            <div class="modal-body">
                <!-- <form class="form-horizontal" action="<?php echo base_url() ?>Master/ExcelDataAddIngredints" method="post" accept-charset="utf-8"> -->
                <?php echo form_open(base_url() . 'ingredient/ExcelDataAddIngredints', $arrayName = array('id' => 'language', 'class' => 'form-horizontal', 'accept-charset' => 'utf-8')) ?>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo lang('upload_file'); ?><span class="ir_color_red">
                            *</span></label>
                    <div class="col-sm-7">
                        <input type="file" class="form-control" name="userfile" id="userfile" placeholder="Upload file"
                            value="">
                        <div class="callout callout-danger my-2 error-msg customer_err_msg_contnr">
                            <p class="customer_err_msg"></p>
                        </div>
                    </div>
                </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="addNewGuest">
                    <i class="fa fa-save"></i> <?php echo lang('upload'); ?> </button>
                <a class="btn btn-primary" href="<?php echo base_url() ?>ingredient/downloadPDF/Ingredient_Upload.xlsx">
                    <i class="fa fa-save"></i> <?php echo lang('download_sample'); ?></a>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>frequent_changing/js/inventory.js"></script>
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