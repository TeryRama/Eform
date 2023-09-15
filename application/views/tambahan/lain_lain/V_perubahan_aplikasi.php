<?php
$this->load->view('template/head');
?>
        <!-- DATA TABLES -->
      <link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
  <!-- Theme style -->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

<?php
$this->load->view('template/topbar2');
?>


<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <fieldset>
                <legend class="text-maroon"><i class="fa fa-hand-o-right text-maroon"></i>  <b>Laboratorium Kimia (CHE)</b><a href="#"><img src="" width="8" height="20"></a></legend>
            </fieldset>
        </div>
    </div>

    <br>
    
    
    <div class="row">
        <div class="col-lg-12">
            <h3 style="text-align: right;">DAFTAR PERMINTAAN PERUBAHAN APLIKASI E-Form WHS</h3>
        </div>
    </div>

    <br/>
    <div class="row">
        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>ROA</h3>

              <p>Terakreditasi</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-list-outline"></i>
            </div>
            <a href="#" class="small-box-footer">
              Add New  <i class="fa fa-plus"></i>
            </a>
            <a href="#" class="small-box-footer">
              Detail  <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
          <br/><br/>
          <div class="small-box bg-maroon">
            <div class="inner">
              <h3>ROA</h3>

              <p>Tidak Terakreditasi</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-list-outline"></i>
            </div>
            <a href="#" class="small-box-footer">
              Add New  <i class="fa fa-plus"></i>
            </a>
            <a href="#" class="small-box-footer">
              Detail  <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-9 col-xs-6">
            <div id="form_html" style="">
                <div class="box box-warning">
                    <div class="box-header" style="text-align:center;">
                        <div class="row">
                            <div class="col-md-3" style="text-align:center;">
                                <img src="<?php echo base_url('assets/images/Logo_PSG.gif')?>"/>
                            </div>
                            <div class="col-md-6" style="text-align:center;">
                                <div class="table-responsive">
                                <table>
                                    <tr>
                                        <td colspan="6" style="text-align: left;"><h3><p class="text-warning"><b><?php echo $this->config->item("nama_perusahaan"); ?></b></p></h3></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="text-align: left;">Sungai Guntung, Kec Kateman, Kab Indragiri Hilir, Riau 29255 - Indonesia</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;">Tel</td>
                                        <td style="text-align: left;">: </td>
                                        <td style="text-align: left;"> (62) 779 552888</td>
                                        <td style="text-align: left;">Fax</td>
                                        <td style="text-align: left;">: </td>
                                        <td style="text-align: left;"> (62) 779 552000</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;">Email</td>
                                        <td style="text-align: left;">:</td>
                                        <td style="text-align: left;"><p class="text-warning"><u> general@psg.co.id</u></p></td>
                                        <td style="text-align: left;">Website</td>
                                        <td style="text-align: left;">:</td>
                                        <td style="text-align: left;"><p class="text-warning"><u> www.sambugroup.com</u></p></td>
                                    </tr>
                                </table>
                                </div>
                            </div>

                            <div class="col-md-3" style="text-align:center;">
                                <img src="<?php echo base_url('assets/images/LOGO_KAN.png')?>"/>
                            </div>
                        </div>

                    </div>
                    <div class="box-body">
                        <form action="" id="formlqs137" name="formlqs137" method="post" role="form" class="">
                        <div class="row">
                            <div class="col-md-12" style="text-align:center;">
                                <marquee direction="left" class="bg-info">
                                THE COCONUT SPECIALIST 
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                THE COCONUT SPECIALIST
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                THE COCONUT SPECIALIST
                                </marquee>
                            </div>
                        </div><!-- /.row-->
                        <div class="row">
                            <div class="col-md-12" style="text-align:center;">
                                <h4><b><u>REPORT OF ANALYSIS</u></b><br/>
                                <h5>No:  <div id="html_nodoc"></div></h5></h4>

                            </div>
                        </div>
                        <br/><br/>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if (isset($message)) { ?>
                                    <div class="alert alert-error">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Warning!</strong>
                                        <?php echo $message; ?>
                                    </div>
                                <?php } elseif(isset($message2)) {?>
                                    <div class="alert alert-error">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Warning!</strong>
                                        <?php echo $message2; ?>
                                    </div>
                                <?php } ?>

                                <div class="row">
                                    <div class="col-md-6">
                                        
                                        
                                        <input type="hidden" name="completedate" value="<?php echo date('Y-m-d');?>" id="completedate">
                                        <input type="hidden" name="completetime" value="<?php echo date('H:i:s');?>" id="completetime">
                                        <input type="hidden" name="completeby" value="<?php echo $nmdepan ;?>" id="completeby">
                                        <input type="hidden" name="nodoc" value="" id="nodoc">
                                        <?php if (isset($dtheader)) { ?>
                                        <input type="hidden" name="headerid" value="<?php echo $headerid ;?>" id="headerid">
                                        <?php } ?>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="create_date" class="col-sm-5 control-label" style="text-align:left;"><b><u>Tanggal Pembuatan Laporan</u></b><br/><i>Report Created Date</i></label>
                                                    <div class="col-sm-6">
                                                        <div class="input-group date form_date col-sm-12" data-date="" data-date-format="yyyy-mm-dd">
                                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                <input class="form-control" size="8" type="text" name="create_date"  id="create_date" placeholder=""  value="" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1"></div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="principle_dept" class="col-sm-5 control-label" style="text-align:left;"><b><u>Principle</u></b><br/><i>Pemberi Order</i></label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" size="8" type="text" placeholder="" name="principle_dept" id="principle_dept" value="" placeholder="Departement" />
                                                        <input class="form-control" size="8" type="text" placeholder="" name="principle_name" id="principle_name" value="" placeholder="Principle By"/>
                                                    </div>
                                                    <div class="col-sm-1"></div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="address" class="col-sm-5 control-label" style="text-align:left;"><b><u>Address</u></b><br/><i>Alamat</i></label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" size="8" type="text" placeholder="" name="address" id="address" value="" placeholder="Address" />
                                                    </div>
                                                    <div class="col-sm-1"></div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="fax" class="col-sm-5 control-label" style="text-align:left;"><b><u>Telp. No/ Fax No</u></b><br/><i>No. Telp / Fax</i></label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" size="8" type="text" placeholder="" name="fax" id="fax" value="" placeholder="Telp. No/ Fax No" />
                                                    </div>
                                                    <div class="col-sm-1"></div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="date_received" class="col-sm-5 control-label" style="text-align:left;"><b><u>Date Received</u></b><br/><i>Analisa/Uji</i></label>
                                                    <div class="col-sm-6">
                                                        <div class="input-group date form_date col-sm-12" data-date="" data-date-format="yyyy-mm-dd">
                                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                <input class="form-control" size="8" type="text" name="date_received"  id="date_received" placeholder=""  value=""/>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1"></div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="tasted" class="col-sm-5 control-label" style="text-align:left;"><b><u>Tested For</u></b><br/><i>Analisa/Uji</i></label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" size="8" type="text" placeholder="" name="tasted" id="tasted" value="" placeholder="Tested For" />
                                                    </div>
                                                    <div class="col-sm-1"></div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="description" class="col-sm-5 control-label" style="text-align:left;"><b><u>Description of Sample</u></b><br/><i>Keterangan Sampel</i></label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" size="8" type="text" placeholder="" name="description" id="description" value="" placeholder="Description of Sample" />
                                                    </div>
                                                    <div class="col-sm-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-sm-1"></div>
                                                <label for="condition" class="col-sm-5 control-label" style="text-align:left;"><b><u>Condition of Sample</u></b><br/><i>Kondisi Sampel</i></label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" size="8" type="text" placeholder="" name="condition" id="condition" value="" placeholder="Condition of Sample" />
                                                    </div>
                                                    
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-sm-1"></div>
                                                <label for="date_analysis" class="col-sm-5 control-label" style="text-align:left;"><b><u>Date of Analysis</u></b><br/><i>Tgl Analisa/Pengujian</i></label>
                                                    <div class="col-sm-6">
                                                       <div class="input-group date form_date col-sm-12" data-date="" data-date-format="yyyy-mm-dd">
                                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                <input class="form-control" size="8" type="text" name="date_analysis"  id="date_analysis" placeholder=""  value=""/>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-sm-1"></div>
                                                <label for="date_report" class="col-sm-5 control-label" style="text-align:left;"><b><u>Date of Report</u></b><br/><i>Tanggal Laporan</i></label>
                                                    <div class="col-sm-6">
                                                        <div class="input-group date form_date col-sm-12" data-date="" data-date-format="yyyy-mm-dd">
                                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                <input class="form-control" size="8" type="text" name="date_report"  id="date_report" placeholder=""  value=""/>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-sm-1"></div>
                                                <label for="contractor" class="col-sm-5 control-label" style="text-align:left;"><b><u>Sub Contractor of Test ( if any)</u></b><br/><i>Sub Kontraktor jika ada</i></label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" size="8" type="text" placeholder="" name="contractor" id="contractor" value="" placeholder="Contractor" />
                                                    </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-sm-1"></div>
                                                <label for="vessel" class="col-sm-5 control-label" style="text-align:left;"><b><u>Vessel Name</u></b><br/><i>Berangkat dengan</i></label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" size="8" type="text" placeholder="" name="vessel" id="vessel" value="" placeholder="Vessel" />
                                                    </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-sm-1"></div>
                                                <label for="shipment" class="col-sm-5 control-label" style="text-align:left;"><b><u>Date of Shipment</u></b><br/><i>Tanggal Shipment</i></label>
                                                    <div class="col-sm-6">
                                                        <div class="input-group date form_date col-sm-12" data-date="" data-date-format="yyyy-mm-dd">
                                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                <input class="form-control" size="8" type="text" name="shipment"  id="shipment" placeholder=""  value=""/>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-sm-1"></div>
                                                <label for="qty_sampel" class="col-sm-5 control-label" style="text-align:left;"><b><u>Quantity of Sample</u></b><br/><i>Jumlah Sample</i></label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" size="8" type="text" placeholder="" name="qty_sampel" id="qty_sampel" value="" placeholder="Quantity Sampel" />
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/><br/>
                        <div class="row">
                            <div class="col-md-12">
                                 <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped sticky-header">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th></th>
                                                <th>Parameter</th>
                                                <th>Unit</th>
                                                <th>Result</th>
                                                <th>Method</th>
                                                <th>Remark</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_detail">
                                            <?php if(!isset($dtdetail)) {;
                                                if(isset($message)){
                                                  for ($i=0;$i<$jmldtl;$i++) {
                                            ?>
                                            <tr>
                                                <td valign="top"><input name="chk[]" type="checkbox"/></td>
                                                <td><input type="text" name="parameter[]" id="parameter" class="parameter col-sm-12" value="<?php echo set_value('parameter['.$i.']');?>"/></td>
                                                <td><input type="text" name="unit[]" id="unit" class="unit col-sm-12" value="<?php echo set_value('unit['.$i.']');?>"/></td>
                                                <td><input type="text" name="result[]" id="result" class="result col-sm-12" value="<?php echo set_value('result['.$i.']');?>"/></td>
                                                <td><input type="text" name="method[]" id="method" class="method col-sm-12" value="<?php echo set_value('method['.$i.']');?>"/></td>
                                                <td><input type="text" name="remark[]" id="remark" class="remark col-sm-12" value="<?php echo set_value('remark['.$i.']');?>"/></td>
                                            </tr>
                                            <?php } } else { ?>
                                            <tr>
                                                <td valign="top"><input name="chk[]" type="checkbox"/></td>
                                                <td><input type="text" name="parameter[]" id="parameter" class="parameter col-sm-12" value=""/></td>
                                                <td><input type="text" name="unit[]" id="unit" class="unit col-sm-12" value=""/></td>
                                                <td><input type="text" name="result[]" id="result" class="result col-sm-12" value=""/></td>
                                                <td><input type="text" name="method[]" id="method" class="method col-sm-12" value=""/></td>
                                                <td><input type="text" name="remark[]" id="remark" class="remark col-sm-12" value=""/></td>
                                            </tr>
                                            <?php } }else {
                                                foreach($dtdetail as $detail){
                                            ?>
                                            <tr>
                                                <td valign="top"><input name="chk[]" type="checkbox"/></td>
                                                <td><input type="text" name="parameter[]" id="parameter" class="parameter col-sm-12" value=""/></td>
                                                <td><input type="text" name="unit[]" id="unit" class="unit col-sm-12" value=""/></td>
                                                <td><input type="text" name="result[]" id="result" class="result col-sm-12" value=""/></td>
                                                <td><input type="text" name="method[]" id="method" class="method col-sm-12" value=""/></td>
                                                <td><input type="text" name="remark[]" id="remark" class="remark col-sm-12" value=""/></td>
                                            </tr>
                                            <?php } } ?>
                                        </tbody>
                                        <tfoot class="bg-primary">
                                            <tr>
                                                <td colspan="6">
                                                    <?php if(!isset($dtdetail)) {?>
                                                        <button type="button" class="btn btn-sm btn-info" onClick="addRow('tbody_detail')">Tambah Baris</button>
                                                        <button type="button" class="btn btn-sm btn-success" onClick="InsertRow('tbody_detail')">Sisip Baris</button>
                                                        <button type="button" class="btn btn-sm btn-warning" onClick="deleteRow('tbody_detail')">Hapus Baris</button>
                                                    <?php } else { ?>
                                                        <button type="button" class="btn btn-sm btn-info" onClick="addRow('tbody_detail')">Tambah Baris</button>
                                                        <button type="button" class="btn btn-sm btn-warning" onClick="deleteRow('tbody_detail')">Hapus Baris</button>
                                                        <button type="button" class="btn btn-sm btn-success" onClick="InsertRow('tbody_detail')">Sisip Baris</button>
                                                        <button type="submit" class="btn btn-sm btn-danger" name="btndelete" onClick="return confirm('ANDA YAKIN MENGHAPUS DATA PENTING INI... ?')">Hapus Data</button>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                 </div>

                                 <p><b><u>The above finding based on tested sample only. This report shall not be reproduced, without the written approved from  PSG Lab</u></b><br/><i>Hasil pengujian di atas hanya berdasarkan pada contoh yang diuji. Laporan ini dilarang diperbanyak kecuali atas persetujuan Lab PSG</i></p>
                            </div>
                        </div>
                        <br/><br/>
                        <div class="row">
                            <div class="col-md-12" style="text-align: left">
                                <?php if (!isset($dtheader)){?>
                                <button type="submit" class="btn btn-primary" id="btnsimpan">Simpan</button>
                                <button type="button" onclick="location.href=<?php echo base_url('form_input/C_formintqad08_00') ?>" class="btn btn-success">Batal</button>

                                 <?php } else{?>
                                  <button type="submit" class="btn btn-primary" name="btnproses" value ="btnupdate" onclick="return confirm('Simpan Data ?')">Simpan</button>
                                  <button type="submit" class="btn btn-success" name="btnproses" value ="btncomplete" onclick="return confirm('Komplite Data ?')">Komplit</button>
                                  <a href="<?php echo base_url('export_excel/C_export_toexcel_'.$frmkd.'_'.$frmvrs.'/exportxls/'.$frmkd.'/'.$frmvrs.'/'.$headerid) ?>" title="Export to Excel" target="_blank" onclick="return confirm('EXPORT TO EXCEL... ?')"><span class="btn btn-success glyphicon glyphicon-export"></span></a>
                                 <?php } ?>
                            </div>
                        </div>
                        </form>
                    </div> <!-- /.box-body-->
                    <div class="box-footer">
                        <div class="clearfix">
                            <span class="pull-left">Mulai Berlaku:</span>
                            <a href="?#"><span class="pull-right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section><!-- /.content -->

<?php
$this->load->view('template/js2');
?>

<!-- DATA TABES SCRIPT -->
<!-- <script src="<?php //echo base_url('assets/fixedtblhdrlftcol/jquery.fixedTblHdrLftCol.js')?>" type="text/javascript"></script>
 -->

<!-- page script -->

<!-- <script>
      $(function() {
        $('table').fixedTblHdrLftCol({
          scroll: {
            height: '200px',
            width: '550px'
          }
        });
      });
    </script> -->

<?php
$this->load->view('template/foot2');
?>