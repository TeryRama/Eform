<?php
date_default_timezone_set('Asia/Jakarta');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_jadwal_audit extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('M_user', 'M_menu', 'tambahan/lain_lain/M_jadwal_audit'));
        $this->load->library(array('table', 'form_validation', 'excel', 'fpdf'));
        $this->load->helper('form');
    }

    function exportxls() {

        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $data['password'] = $session_data['password'];
        $data['jabid'] = $session_data['jabid'];
        $data['leveluserid'] = $session_data['leveluserid'];
        $data['nmdepan'] = $session_data['nmdepan'];
        $data['levelusernm'] = $session_data['levelusernm'];
        $data['bagnm'] = $session_data['bagnm'];
        $data['jabnm'] = $session_data['jabnm'];
        $data['Titel'] = 'Home';

        $LevelUser = $session_data['leveluserid'];
        $UserName = $session_data['username'];
        $LevelUserNm = $session_data['levelusernm'];

        $cekLevelUserNm = substr($LevelUserNm,0,7);
        $data['cekLevelUserNm'] = substr($LevelUserNm,0,7);
        $menus = $this->M_menu->menus($LevelUser);
        $data2 = array('menus' => $menus);

        $date_from = $this->uri->segment(4);
        $date_to = $this->uri->segment(5);

        $frmcop = $this->config->item("nama_perusahaan");

        $model = 'M_dokumen_qad';
        $this->load->library('excel');

        $PTStyle = new PHPExcel_Style();
        $headerStyle = new PHPExcel_Style();
        $DetailheaderStyle = new PHPExcel_Style();
        $DetailheaderVerticalStyle = new PHPExcel_Style();
        $bodyStyle  = new PHPExcel_Style();
        $cellred  = new PHPExcel_Style();
        $headerStyleOutline = new PHPExcel_Style();
        $headerStyleRight = new PHPExcel_Style();
        $headerStyleLeft = new PHPExcel_Style();
        $headerStyleRightTop = new PHPExcel_Style();
        $headerStyleLeftTop = new PHPExcel_Style();
        $headerStyleRightbottom = new PHPExcel_Style();
        $headerStyleLeftBottom = new PHPExcel_Style();
        $headerStyleRightBottomTop = new PHPExcel_Style();
        $headerStyleLeftBottomTop = new PHPExcel_Style();

        $noborderStyle = new PHPExcel_Style();
        $rightborderStyle = new PHPExcel_Style();
        $DetailheaderRightTopStyle = new PHPExcel_Style();
        $DetailheaderRightStyle = new PHPExcel_Style();
        $DetailheaderLeftStyle = new PHPExcel_Style();
        $DetailheaderRightBottomStyle = new PHPExcel_Style();

        $footerStyleRightbottom = new PHPExcel_Style();
        $footerStyleLeftbottom = new PHPExcel_Style();

        $PTStyle->applyFromArray(array
            ('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID
                         ),
             'font' => array(
             'bold'    => true,
             'name' => 'Trebuchet MS',
             'size' => 12
             ),
            'numberformat'   => array(
                           'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
            'borders' => array(
                            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'left'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                         ),
            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'       => true
                           ),
            )
        );

        $headerStyle->applyFromArray(array
            ('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID
                         ),
             'font' => array(
             'bold'    => false,
             'name' => 'Trebuchet MS',
             'size' => 8
             ),
            'numberformat'   => array(
                           'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
            'borders' => array(
                            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'left'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                         ),
            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'       => true
                           ),
            )
        );
        $headerStyleRight->applyFromArray(array
            ('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID
                         ),
             'font' => array(
             'bold'    => false,
             'name' => 'Trebuchet MS',
             'size' => 8
             ),
            'numberformat'   => array(
                           'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
            'borders' => array(
                            'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                         ),
            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'       => true
                           ),
            )
        );

        $headerStyleLeft->applyFromArray(array
            ('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID
                         ),
             'font' => array(
             'bold'    => false,
             'name' => 'Trebuchet MS',
             'size' => 8
             ),
            'numberformat'   => array(
                           'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
            'borders' => array(
                            'left'  => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                         ),
            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'       => true
                           ),
            )
        );
        $headerStyleRightTop->applyFromArray(array
            ('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID
                         ),
             'font' => array(
             'bold'    => false,
             'name' => 'Trebuchet MS',
             'size' => 8
             ),
            'numberformat'   => array(
                           'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
            'borders' => array(
                            'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                         ),
            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'       => true
                           ),
            )
        );

        $headerStyleLeftTop->applyFromArray(array
            ('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID
                         ),
             'font' => array(
             'bold'    => false,
             'name' => 'Trebuchet MS',
             'size' => 8
             ),
            'numberformat'   => array(
                           'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
            'borders' => array(
                            'left'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                         ),
            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'       => true
                           ),
            )
        );

        $headerStyleRightbottom->applyFromArray(array
            ('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID
                         ),
             'font' => array(
             'bold'    => false,
             'name' => 'Trebuchet MS',
             'size' => 8
             ),
            'numberformat'   => array(
                           'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
            'borders' => array(
                            'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'bottom'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                         ),
            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'       => true
                           ),
            )
        );

        $headerStyleLeftBottom->applyFromArray(array
            ('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID
                         ),
             'font' => array(
             'bold'    => false,
             'name' => 'Trebuchet MS',
             'size' => 8
             ),
            'numberformat'   => array(
                           'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
            'borders' => array(
                            'left'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'bottom'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                         ),
            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'       => true
                           ),
            )
        );

        $headerStyleRightBottomTop->applyFromArray(array
            ('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID
                         ),
             'font' => array(
             'bold'    => false,
             'name' => 'Trebuchet MS',
             'size' => 8
             ),
            'numberformat'   => array(
                           'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
            'borders' => array(
                            'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'bottom'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                         ),
            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'       => true
                           ),
            )
        );

        $headerStyleLeftBottomTop->applyFromArray(array
            ('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID
                         ),
             'font' => array(
             'bold'    => false,
             'name' => 'Trebuchet MS',
             'size' => 8
             ),
            'numberformat'   => array(
                           'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
            'borders' => array(
                            'left'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'bottom'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                         ),
            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'       => true
                           ),
            )
        );

        $noborderStyle->applyFromArray(array
            ('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID
                         ),
             'font' => array(
             'bold'    => true,
             'name' => 'Trebuchet MS',
             'size' => 8
             ),
            'numberformat'   => array(
                           'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'       => true
                           ),
            )
        );

        $rightborderStyle->applyFromArray(array
            ('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID
                         ),
             'font' => array(
             'bold'    => false,
             'name' => 'Trebuchet MS',
             'size' => 8
             ),
            'numberformat'   => array(
                           'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
            'borders' => array(
                            'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                         ),
            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'       => true
                           ),
            )
        );

        $DetailheaderStyle->applyFromArray(array
            ('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID
                         ),
             'font' => array(
             'bold'    => true,
             'name' => 'Trebuchet MS',
             'size' => 8
             ),
            'numberformat'   => array(
                           'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
            'borders' => array(
                            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'left'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                         ),
            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'       => true
                           ),
            )
        );

        $DetailheaderVerticalStyle->applyFromArray(array
            ('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID
                         ),
             'font' => array(
             'bold'    => false,
             'name' => 'Trebuchet MS',
             'size' => 8
             ),
            'numberformat'   => array(
                           'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
            'borders' => array(
                            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'left'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                         ),
            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_BOTTOM,
                            'wrap'       => true
                           ),
            )
        );

        $DetailheaderRightTopStyle->applyFromArray(array
            ('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID
                         ),
             'font' => array(
             'bold'    => true,
             'name' => 'Trebuchet MS',
             'size' => 8
             ),
            'numberformat'   => array(
                           'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
            'borders' => array(
                            'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                         ),
            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'       => true
                           ),
            )
        );
        $DetailheaderRightBottomStyle->applyFromArray(array
            ('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID
                         ),
             'font' => array(
             'bold'    => true,
             'name' => 'Trebuchet MS',
             'size' => 8
             ),
            'numberformat'   => array(
                           'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
            'borders' => array(
                            'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'bottom'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                         ),
            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'       => true
                           ),
            )
        );
        $DetailheaderRightStyle->applyFromArray(array
            ('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID
                         ),
             'font' => array(
             'bold'    => true,
             'name' => 'Trebuchet MS',
             'size' => 8
             ),
            'numberformat'   => array(
                           'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
            'borders' => array(
                            'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                         ),
            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'       => true
                           ),
            )
        );

        $DetailheaderLeftStyle->applyFromArray(array
            ('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID
                         ),
             'font' => array(
             'bold'    => true,
             'name' => 'Trebuchet MS',
             'size' => 8
             ),
            'numberformat'   => array(
                           'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
            'borders' => array(
                            'left'  => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                         ),
            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'       => true
                           ),
            )
        );

        $footerStyleRightbottom->applyFromArray(array
            ('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID
                         ),
             'font' => array(
             'bold'    => false,
             'name' => 'Trebuchet MS',
             'size' => 8
             ),
            'numberformat'   => array(
                           'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
            'borders' => array(
                            'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'bottom'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                         ),
            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'       => true
                           ),
            )
        );

        $footerStyleLeftbottom->applyFromArray(array
            ('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID
                         ),
             'font' => array(
             'bold'    => false,
             'name' => 'Trebuchet MS',
             'size' => 8
             ),
            'numberformat'   => array(
                           'code'    => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
            'borders' => array(
                            'left'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'bottom'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                         ),
            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'       => true
                           ),
            )
        );

        $bodyStyle->applyFromArray(
            array('fill'   => array(
                                'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('argb' => 'FFFFFFFF')
                              ),
                   'font'   => array(
                                'name' => 'Times New Roman',
                                'size'  => 8),
                   'numberformat'   => array(
                                        'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
                   'borders' => array(
                                    'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                                    'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                                    'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                                    'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                ),
                   'alignment' => array(
                                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                                    'wrap'     => true
                                  ),
            )
        );

        $style['data_detail'] = array('fill'   => array(
                                'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('argb' => 'FFFFFFFF')
                              ),
                   'font'   => array(
                                'name' => 'Times New Roman',
                                'size'  => 8),
                   'numberformat'   => array(
                                        'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
                   'borders' => array(
                                    'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                                    'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                                    'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                                    'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                ),
                   'alignment' => array(
                                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                                    'wrap'     => true
                                  ),
            );

        $cellred->applyFromArray(

            array('fill'   => array(
                           'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                           'color'   => array('rgb' => 'ff0000')
                              ),
            'font'   => array(
                           'bold'    => true),
             'numberformat'   => array(
                           'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT),
             'borders' => array(
                            'bottom'=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'left'      => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                               ),
              'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'     => true
                                 ),


            )
        );


        $obj = new Excel();

        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setPath('assets/images/tlogopsg.png');

        $objDrawing2 = new PHPExcel_Worksheet_Drawing();
        $objDrawing2->setPath('assets/images/tlogopsg.png');

        $jadwal_audit   = $this->M_jadwal_audit->get_jadwal_audit_bydate($date_from, $date_to);

        if(isset($jadwal_audit)){
            $number =0;
            foreach($jadwal_audit as $jadwal_audit_row){$number++;
                $arr_number[]                   = $number;  
                $arr_jadwal_from[]              = $jadwal_audit_row->jadwal_from;
                $arr_jadwal_to[]                = $jadwal_audit_row->jadwal_to;
                $arr_jadwal_guest[]             = $jadwal_audit_row->jadwal_guest;
                $arr_jadwal_remarks[]           = $jadwal_audit_row->jadwal_remarks;
                $arr_jadwal_create_by[]         = $jadwal_audit_row->create_by;
                $arr_jadwal_create_by[]         = $jadwal_audit_row->create_by;
                $arr_jadwal_create_date[]       = $jadwal_audit_row->create_date;
                $arr_jadwal_create_time[]       = $jadwal_audit_row->create_time;
                $arr_jadwal_create_comp[]       = $jadwal_audit_row->create_comp;
                $arr_jadwal_update_by[]         = $jadwal_audit_row->update_by;
                $arr_jadwal_update_date[]       = $jadwal_audit_row->update_date;
                $arr_jadwal_update_time[]       = $jadwal_audit_row->update_time;
                $arr_jadwal_update_comp[]       = $jadwal_audit_row->update_comp;
            } 
            $count1 = count($arr_number);   
        }else{
            $arr_number[]                   = '';  
            $arr_jadwal_from[]              = '';
            $arr_jadwal_to[]                = '';
            $arr_jadwal_guest[]             = '';
            $arr_jadwal_remarks[]           = '';
            $arr_jadwal_create_by[]         = '';
            $arr_jadwal_create_by[]         = '';
            $arr_jadwal_create_date[]       = '';
            $arr_jadwal_create_time[]       = '';
            $arr_jadwal_create_comp[]       = '';
            $arr_jadwal_update_by[]         = '';
            $arr_jadwal_update_date[]       = '';
            $arr_jadwal_update_time[]       = '';
            $arr_jadwal_update_comp[]       = '';
            $count1 = 1;      
        }
        
        $jml_data_perpage = 30;
        if($count1<$jml_data_perpage){
            $jml_page = 1;
        }else{
            if(($count1 % $jml_data_perpage)==0){ $jml_page = $count1/$jml_data_perpage;}
            else{
//                $jml_worksheet = round(($count1/$jml_data_perpage), 0, PHP_ROUND_HALF_DOWN)+1;
                $jml_page = floor(($count1/$jml_data_perpage))+1;
                }
        }

        $jml_row_perpage = 31;


        $objPHPExcel = $obj->createSheet(0);

        $objPHPExcel->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $objPHPExcel->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objPHPExcel->getPageSetup()->setFitToPage(true);
        $objPHPExcel->getPageSetup()->setFitToWidth(1);
        $objPHPExcel->getPageSetup()->setFitToHeight(0);

        $objPHPExcel->setCellValue('A1', 'No');
        $objPHPExcel->setCellValue('B1', 'From Date');
        $objPHPExcel->setCellValue('C1', 'To Date');
        $objPHPExcel->setCellValue('D1', 'Guest');
        $objPHPExcel->setCellValue('E1', 'Remarks');
        $objPHPExcel->setCellValue('F1', 'Create Info');
        $objPHPExcel->setCellValue('G1', 'Update Info');

        $objPHPExcel->setSharedStyle($headerStyle, 'A1:G1');

        //get some data from DB 
           // $detail = $this->$mdl->get_datalaporan($dtquery1);
         
            //set A1 as the first cell
            $current_col = 0;
            $current_row = 2;
         
            if($jadwal_audit){
                $no=0;
                foreach($jadwal_audit as $det){ $no++;
                    //set value of cell
                    $objPHPExcel->setCellValueByColumnAndRow($current_col, $current_row, $no);
                    //set cell style
                    $objPHPExcel->getStyleByColumnAndRow($current_col, $current_row)->applyFromArray($style['data_detail']);

                    //move to next column
                    $current_col++;
                    //set value and style of the cell
                    $objPHPExcel->setCellValueByColumnAndRow($current_col, $current_row,  $det->jadwal_from);
                    //set cell style
                    $objPHPExcel->getStyleByColumnAndRow($current_col, $current_row)->applyFromArray($style['data_detail']);

                    //move to next column
                    $current_col++;
                    //set value and style of the cell
                    $objPHPExcel->setCellValueByColumnAndRow($current_col, $current_row,  $det->jadwal_to);
                    //set cell style
                    $objPHPExcel->getStyleByColumnAndRow($current_col, $current_row)->applyFromArray($style['data_detail']);

                    //move to next column
                    $current_col++;
                    //set value and style of the cell
                    $objPHPExcel->setCellValueByColumnAndRow($current_col, $current_row,  $det->jadwal_guest);
                    //set cell style
                    $objPHPExcel->getStyleByColumnAndRow($current_col, $current_row)->applyFromArray($style['data_detail']);

                    //move to next column
                    $current_col++;
                    //set value and style of the cell
                    $objPHPExcel->setCellValueByColumnAndRow($current_col, $current_row,  $det->jadwal_remarks);
                    //set cell style
                    $objPHPExcel->getStyleByColumnAndRow($current_col, $current_row)->applyFromArray($style['data_detail']);

                     //move to next column
                    $current_col++;
                    //set value and style of the cell
                    $objPHPExcel->setCellValueByColumnAndRow($current_col, $current_row,  $det->create_by."\n".$det->create_date.' '.$det->create_time."\n".$det->create_comp);
                    //set cell style
                    $objPHPExcel->getStyleByColumnAndRow($current_col, $current_row)->applyFromArray($style['data_detail']);

                     //move to next column
                    $current_col++;
                    //set value and style of the cell
                    $objPHPExcel->setCellValueByColumnAndRow($current_col, $current_row,  $det->update_by."\n".$det->update_date.' '.$det->update_time."\n".$det->update_comp);
                    //set cell style
                    $objPHPExcel->getStyleByColumnAndRow($current_col, $current_row)->applyFromArray($style['data_detail']);
         
                    //move to next row
                    $current_row++;
                    //reset column back to A
                    $current_col = 0;
                }
            }


        ob_clean();
        header('Content-Type: text/html; charset=utf-8');
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=Ketidaksesuaian.xls');
        //   header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel5');
        $objWriter->save('php://output');
        exit();
        ob_end_clean();

    }

}