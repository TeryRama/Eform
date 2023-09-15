<?php $this->load->view('template/headbar'); ?>
<!-- Content Header (Page header) -->
<!-- Main content -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12 mb-1">
            <h4 class="text-uppercase"><?php echo $Titel; ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">FORM ITEM</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <a type="button" href="<?php echo base_url('master/item/C_form_item/form/add') ?>" class="btn bg-gradient-primary modal_forminput waves-effect waves-light" role="button"><span class="feather icon-edit-1"> Tambah Baru</span></a><br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered complex-headers">
                                <thead>
                                    <tr>
                                        <th class="table-primary align-middle text-center" rowspan="2">No</th>
                                        <th class="table-primary align-middle text-center" rowspan="2">Kode Form</th>
                                        <th class="table-primary align-middle text-center" rowspan="2">Parameter I</th>
                                        <th class="table-primary align-middle text-center" rowspan="2">Departemen</th>
                                        <th class="table-primary align-middle text-center" rowspan="2">Tanggal Efective</th>
                                        <th class="table-primary align-middle text-center" rowspan="2">Create Info</th>
                                        <th class="table-primary align-middle text-center" rowspan="2">Update Info</th>
                                        <th class="table-primary align-middle text-center" colspan="3">Action</th>
                                    </tr>
                                    <tr>
                                        <th class="table-primary align-middle text-center">View</th>
                                        <th class="table-primary align-middle text-center">Update</th>
                                        <th class="table-primary align-middle text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($dt_item)) {
                                        $no = 0;
                                        foreach ($dt_item as $dt_item_row) {
                                            $no++;
                                            $headerid = $dt_item_row->headerid;
                                            $create_date = substr($dt_item_row->create_date, 8, 2) . '-' . substr($dt_item_row->create_date, 5, 2) . '-' . substr($dt_item_row->create_date, 0, 4);
                                            $updated_date = substr($dt_item_row->updated_date, 8, 2) . '-' . substr($dt_item_row->updated_date, 5, 2) . '-' . substr($dt_item_row->updated_date, 0, 4);
                                            $tgl_efective = substr($dt_item_row->tgl_efective, 8, 2) . '-' . substr($dt_item_row->tgl_efective, 5, 2) . '-' . substr($dt_item_row->tgl_efective, 0, 4); ?>
                                            <tr>
                                                <td align="center"><?php echo $no; ?></td>
                                                <td align="center"><?php echo $dt_item_row->form_kode; ?></td>
                                                <td align="center"><?php echo $dt_item_row->parameter; ?></td>
                                                <td align="center"><?php echo $dt_item_row->departemen; ?></td>
                                                <td align="center"><?php echo $tgl_efective; ?></td>
                                                <td align="center"><?php echo $dt_item_row->create_by . ' / ' . $create_date . ' / ' . $dt_item_row->create_time; ?></td>
                                                <td align="center"><?php if (trim($dt_item_row->updated_by) != '') {
                                                                        echo $dt_item_row->updated_by . ' / ' . $updated_date . ' / ' . $dt_item_row->updated_time;
                                                                    } ?></td>
                                                <td align="center"><?php echo anchor('master/item/C_form_item/form/view/' . $headerid, '<span class="btn bg-gradient-info btn-md waves-effect waves-light fa fa-search"></span>'); ?></td>
                                                <td align="center"><?php echo anchor('master/item/C_form_item/form/edit/' . $headerid, '<span class="btn bg-gradient-success btn-md waves-effect waves-light fa fa-edit"></span>'); ?></td>
                                                <td align="center"><?php echo anchor('master/item/C_form_item/delete/' . $headerid, '<span class="btn bg-gradient-danger btn-md waves-effect waves-light fa fa-trash"></span>', array('onclick' => "return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')")); ?></td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section><!-- /.content -->
<?php $this->load->view('template/footbar'); ?>
<?php $this->load->view('template/footbarend'); ?>