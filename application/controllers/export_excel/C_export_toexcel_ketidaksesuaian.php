<?php
date_default_timezone_set('Asia/Jakarta');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_ketidaksesuaian extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('M_user', 'M_menu', 'tambahan/lain_lain/M_ketidaksesuaian'));
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

        $model = 'M_ketidaksesuaian';
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

        $result_jadwal = $this->M_user->check_jadwal_audit();
        if($result_jadwal){
          $on_audit ='1';
        }else{
          $on_audit ='0'; 
        }

        $ketidaksesuaian      = $this->M_ketidaksesuaian->get_ketidaksesuaian_bydate($date_from, $date_to,$on_audit);

        $number =0;
        foreach($ketidaksesuaian as $ketidaksesuaian_row){$number++;
            $arr_number[]             = $number;  
            $arr_id[]                 = $ketidaksesuaian_row->id;
            $arr_report_date[]        = $ketidaksesuaian_row->report_date;
            $arr_report_time[]        = $ketidaksesuaian_row->report_time;
            $arr_report_by[]          = $ketidaksesuaian_row->report_by;
            $arr_bagian[]             = $ketidaksesuaian_row->bagian;
            $arr_form_kode[]          = $ketidaksesuaian_row->form_kode;
            $arr_form_versi[]         = $ketidaksesuaian_row->form_versi;
            $arr_form_judul[]         = $ketidaksesuaian_row->form_judul;
            $arr_ketidaksesuaian[]    = $ketidaksesuaian_row->ketidaksesuaian;
            $arr_action_date[]        = $ketidaksesuaian_row->action_date;
            $arr_action_time[]        = $ketidaksesuaian_row->action_time;
            $arr_action_by[]          = $ketidaksesuaian_row->action_by;
            $arr_action_ket[]         = $ketidaksesuaian_row->action_ket;
            $arr_action_status[]      = $ketidaksesuaian_row->action_status;
            $arr_verifi_date[]        = $ketidaksesuaian_row->verifi_date;
            $arr_verifi_time[]        = $ketidaksesuaian_row->verifi_time;
            $arr_verifi_by[]          = $ketidaksesuaian_row->verifi_by;
            $arr_verifi_ket[]         = $ketidaksesuaian_row->verifi_ket;
            $arr_verifi_status[]      = $ketidaksesuaian_row->verifi_status;
            $arr_form_kategori[]      = $ketidaksesuaian_row->form_kategori;
            $arr_form_subkategori[]   = $ketidaksesuaian_row->form_subkategori;
            $arr_form_nama[]          = $ketidaksesuaian_row->form_nama;
        }
        
        $awal = substr($date_from, 8, 2) . '-' . substr($date_from, 5, 2) . '-' . substr($date_from, 0, 4);
        $akhir = substr($date_to, 8, 2) . '-' . substr($date_to, 5, 2) . '-' . substr($date_to, 0, 4);
        
        $count1 = count($ketidaksesuaian);
        $jml_data_perpage = 15;
        if($count1<$jml_data_perpage){
            $jml_page = 1;
        }else{
            if(($count1 % $jml_data_perpage)==0){ $jml_page = $count1/$jml_data_perpage;}
            else{
//                $jml_worksheet = round(($count1/$jml_data_perpage), 0, PHP_ROUND_HALF_DOWN)+1;
                $jml_page = floor(($count1/$jml_data_perpage))+1;
                }
        }

        $jml_row_perpage = 52;


        $objPHPExcel = $obj->createSheet(0);

        $objPHPExcel->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $objPHPExcel->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objPHPExcel->getPageSetup()->setFitToPage(true);
        $objPHPExcel->getPageSetup()->setFitToWidth(1);
        $objPHPExcel->getPageSetup()->setFitToHeight(0);

        $range = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD');

        foreach ($range as $columnID) {
            $objPHPExcel->getRowDimension($columnID)->setRowHeight(50);
            $objPHPExcel->getColumnDimension($columnID)->setWidth(4);
        }

        $objPHPExcel->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getColumnDimension('E')->setWidth(12);
        $objPHPExcel->getColumnDimension('F')->setWidth(6);
        $objPHPExcel->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getColumnDimension('H')->setWidth(10);
        $objPHPExcel->getColumnDimension('Q')->setWidth(10);
        $objPHPExcel->getColumnDimension('R')->setWidth(7);
        $objPHPExcel->getColumnDimension('S')->setWidth(8);
        $objPHPExcel->getColumnDimension('Y')->setWidth(5);
        $objPHPExcel->getColumnDimension('Z')->setWidth(5);
        $objPHPExcel->getColumnDimension('AA')->setWidth(7);
        $objPHPExcel->getColumnDimension('AD')->setWidth(20);

        for($i1=0;$i1<$jml_page;$i1++){

            $start_row = ($i1*$jml_row_perpage)+1;
            $finish_row = ((($i1*$jml_row_perpage)+1)+($jml_row_perpage));

            $start_detail = ($i1*$jml_data_perpage);
            $finish_detail = (($i1*$jml_data_perpage)+($jml_data_perpage-1));

            $gbr = '$objDrawing'.$i1;

            $gbr = new PHPExcel_Worksheet_Drawing();
            $gbr->setPath('assets/images/tlogopsg.png');
            $gbr->setWorksheet($objPHPExcel);
            $gbr->setCoordinates('B'.$start_row);


            $objPHPExcel->mergeCells('A'.$start_row.':B'.($start_row+1));
            $objPHPExcel->mergeCells('C'.$start_row.':AA'.($start_row+1))->setCellValue('C'.$start_row, $frmcop);
            $objPHPExcel->mergeCells('AB'.$start_row.':AC'.$start_row)->setCellValue('AB'.$start_row, 'No. Dok');
            $objPHPExcel->mergeCells('AD'.$start_row.':AE'.$start_row)->setCellValue('AD'.$start_row, ': -');

            $objPHPExcel->mergeCells('AB'.($start_row+1).':AC'.($start_row+1))->setCellValue('AB'.($start_row+1), 'Tanggal');
            $objPHPExcel->mergeCells('AD'.($start_row+1).':AE'.($start_row+1))->setCellValue('AD'.($start_row+1), ': '.$awal.' s/d '.$akhir);

            $objPHPExcel->mergeCells('A'.($start_row+2).':B'.($start_row+2))->setCellValue('A'.($start_row+2), 'JUDUL');
            $objPHPExcel->mergeCells('C'.($start_row+2).':AA'.($start_row+2))->setCellValue('C'.($start_row+2), 'LAPORAN KETIDAKSESUAIAN FORM PADA APLIKASI E-FORM QAD');
            $objPHPExcel->mergeCells('AB'.($start_row+2).':AC'.($start_row+2))->setCellValue('AB'.($start_row+2), 'Halaman');
            $objPHPExcel->mergeCells('AD'.($start_row+2).':AE'.($start_row+2))->setCellValue('AD'.($start_row+2),': '.($i1+1).' of '.$jml_page);

            $objPHPExcel->setSharedStyle($PTStyle, 'C'.$start_row.':AA'.($start_row+1));
            $objPHPExcel->setSharedStyle($headerStyle, 'A'.$start_row.':B'.($start_row+2));
            $objPHPExcel->setSharedStyle($headerStyleLeftTop, 'AB'.$start_row.':AC'.$start_row);
            $objPHPExcel->setSharedStyle($headerStyleLeftBottomTop, 'AB'.($start_row+1).':AC'.($start_row+1));
            $objPHPExcel->setSharedStyle($headerStyleLeftBottom, 'AB'.($start_row+2).':AC'.($start_row+2));
            $objPHPExcel->setSharedStyle($headerStyleRightTop, 'AD'.$start_row.':AE'.$start_row);
            $objPHPExcel->setSharedStyle($headerStyleRightBottomTop, 'AD'.($start_row+1).':AE'.($start_row+1));
            $objPHPExcel->setSharedStyle($headerStyleRightbottom, 'AD'.($start_row+2).':AE'.($start_row+2));
            $objPHPExcel->setSharedStyle($headerStyle, 'C'.($start_row+2).':AA'.($start_row+2));

            $objPHPExcel->mergeCells('A'.($start_row+3).':P'.($start_row+3))->setCellValue('A'.($start_row+3), '');
            $objPHPExcel->mergeCells('Q'.($start_row+3).':AE'.($start_row+3))->setCellValue('Q'.($start_row+3), '');

            $objPHPExcel->setSharedStyle($headerStyleLeft, 'A'.($start_row+3).':P'.($start_row+3));
            $objPHPExcel->setSharedStyle($headerStyleRight, 'Q'.($start_row+3).':AE'.($start_row+3));

            $objPHPExcel->mergeCells('A'.($start_row+4).':A'.($start_row+5))->setCellValue('A'.($start_row+4), "No");
            $objPHPExcel->mergeCells('B'.($start_row+4).':B'.($start_row+5))->setCellValue('B'.($start_row+4), "Bagian");
            $objPHPExcel->mergeCells('C'.($start_row+4).':C'.($start_row+5))->setCellValue('C'.($start_row+4), "Form\nKategori");
            $objPHPExcel->mergeCells('D'.($start_row+4).':D'.($start_row+5))->setCellValue('D'.($start_row+4), "Form\nSub Kategori");
            $objPHPExcel->mergeCells('E'.($start_row+4).':E'.($start_row+5))->setCellValue('E'.($start_row+4), "Form Nama");
            $objPHPExcel->mergeCells('F'.($start_row+4).':F'.($start_row+5))->setCellValue('F'.($start_row+4), "Form Versi");
            $objPHPExcel->mergeCells('G'.($start_row+4).':G'.($start_row+5))->setCellValue('G'.($start_row+4), "Form Judul");
            $objPHPExcel->mergeCells('H'.($start_row+4).':H'.($start_row+5))->setCellValue('H'.($start_row+4), "Dilaporkan\nOleh");
            $objPHPExcel->mergeCells('I'.($start_row+4).':P'.($start_row+5))->setCellValue('I'.($start_row+4), "Ketidaksesuaian");
            $objPHPExcel->mergeCells('Q'.($start_row+4).':X'.($start_row+4))->setCellValue('Q'.($start_row+4), "Tindakan");
            $objPHPExcel->mergeCells('Y'.($start_row+4).':AE'.($start_row+4))->setCellValue('Y'.($start_row+4), "Verifikasi");
            
            $objPHPExcel->mergeCells('Q'.($start_row+5).':Q'.($start_row+5))->setCellValue('Q'.($start_row+5), "Tanggal");
            $objPHPExcel->mergeCells('R'.($start_row+5).':R'.($start_row+5))->setCellValue('R'.($start_row+5), "Jam");
            $objPHPExcel->mergeCells('S'.($start_row+5).':S'.($start_row+5))->setCellValue('S'.($start_row+5), "Oleh");
            $objPHPExcel->mergeCells('T'.($start_row+5).':V'.($start_row+5))->setCellValue('T'.($start_row+5), "Keterangan");
            $objPHPExcel->mergeCells('W'.($start_row+5).':X'.($start_row+5))->setCellValue('W'.($start_row+5), "Status");
            $objPHPExcel->mergeCells('Y'.($start_row+5).':Z'.($start_row+5))->setCellValue('Y'.($start_row+5), "Tanggal");
            $objPHPExcel->mergeCells('AA'.($start_row+5).':AA'.($start_row+5))->setCellValue('AA'.($start_row+5), "Jam");
            $objPHPExcel->mergeCells('AB'.($start_row+5).':AC'.($start_row+5))->setCellValue('AB'.($start_row+5), "Oleh");
            $objPHPExcel->mergeCells('AD'.($start_row+5).':AD'.($start_row+5))->setCellValue('AD'.($start_row+5), "Keterangan");
            $objPHPExcel->mergeCells('AE'.($start_row+5).':AE'.($start_row+5))->setCellValue('AE'.($start_row+5), "Status");

            $objPHPExcel->setSharedStyle($DetailheaderStyle, 'A'.($start_row+4).':AE'.($start_row+5));

            $a1 = $start_row+5;
            $no=0;
            $nmb_sum = -1;
            for ($arr=$start_detail;$arr<=$finish_detail;$arr++){
                $a1++;
                $no++;
                $nmb_sum++;

                if(isset($arr_number[$arr])){$dt_number[$arr]=$arr_number[$arr];}else{$dt_number[$arr]='-';}
                if(isset($arr_report_date[$arr])){$dt_report_date[$arr]=$arr_report_date[$arr];}else{$dt_report_date[$arr]='-';}
                if(isset($arr_report_time[$arr])){$dt_report_time[$arr]=$arr_report_time[$arr];}else{$dt_report_time[$arr]='-';}
                if(isset($arr_report_by[$arr])){$dt_report_by[$arr]=$arr_report_by[$arr];}else{$dt_report_by[$arr]='-';}
                if(isset($arr_bagian[$arr])){$dt_bagian[$arr]=$arr_bagian[$arr];}else{$dt_bagian[$arr]='-';}
                if(isset($arr_form_kode[$arr])){$dt_form_kode[$arr]=$arr_form_kode[$arr];}else{$dt_form_kode[$arr]='-';}
                if(isset($arr_form_versi[$arr])){$dt_form_versi[$arr]=$arr_form_versi[$arr];}else{$dt_form_versi[$arr]='-';}
                if(isset($arr_form_judul[$arr])){$dt_form_judul[$arr]=$arr_form_judul[$arr];}else{$dt_form_judul[$arr]='-';}
                if(isset($arr_ketidaksesuaian[$arr])){$dt_ketidaksesuaian[$arr]=$arr_ketidaksesuaian[$arr];}else{$dt_ketidaksesuaian[$arr]='-';}
                if(isset($arr_action_date[$arr])){$dt_action_date[$arr]=$arr_action_date[$arr];}else{$dt_action_date[$arr]='-';}
                if(isset($arr_action_time[$arr])){$dt_action_time[$arr]=$arr_action_time[$arr];}else{$dt_action_time[$arr]='-';}
                if(isset($arr_action_by[$arr])){$dt_action_by[$arr]=$arr_action_by[$arr];}else{$dt_action_by[$arr]='-';}
                if(isset($arr_action_ket[$arr])){$dt_action_ket[$arr]=$arr_action_ket[$arr];}else{$dt_action_ket[$arr]='-';}
                if(isset($arr_action_status[$arr])){$dt_action_status[$arr]=$arr_action_status[$arr];}else{$dt_action_status[$arr]='-';}
                if(isset($arr_verifi_date[$arr])){$dt_verifi_date[$arr]=$arr_verifi_date[$arr];}else{$dt_verifi_date[$arr]='-';}
                if(isset($arr_verifi_time[$arr])){$dt_verifi_time[$arr]=$arr_verifi_time[$arr];}else{$dt_verifi_time[$arr]='-';}
                if(isset($arr_verifi_by[$arr])){$dt_verifi_by[$arr]=$arr_verifi_by[$arr];}else{$dt_verifi_by[$arr]='-';}
                if(isset($arr_verifi_ket[$arr])){$dt_verifi_ket[$arr]=$arr_verifi_ket[$arr];}else{$dt_verifi_ket[$arr]='-';}
                if(isset($arr_verifi_status[$arr])){$dt_verifi_status[$arr]=$arr_verifi_status[$arr];}else{$dt_verifi_status[$arr]='-';}
                if(isset($arr_form_kategori[$arr])){$dt_form_kategori[$arr]=$arr_form_kategori[$arr];}else{$dt_form_kategori[$arr]='-';}
                if(isset($arr_form_subkategori[$arr])){$dt_form_subkategori[$arr]=$arr_form_subkategori[$arr];}else{$dt_form_subkategori[$arr]='-';}
                if(isset($arr_form_nama[$arr])){$dt_form_nama[$arr]=$arr_form_nama[$arr];}else{$dt_form_nama[$arr]='-';}


                $objPHPExcel->setSharedStyle($bodyStyle, 'A'.($a1+($nmb_sum*2)).':AE'.($a1+(($nmb_sum*2)+2)));

                if($dt_number[$arr]!='-'){
                $objPHPExcel->mergeCells('A'.($a1+($nmb_sum*2)).':A'.($a1+(($nmb_sum*2)+2)))->setCellValue('A'.($a1+($nmb_sum*2)), $dt_number[$arr]);
                $objPHPExcel->mergeCells('B'.($a1+($nmb_sum*2)).':B'.($a1+(($nmb_sum*2)+2)))->setCellValue('B'.($a1+($nmb_sum*2)), $dt_bagian[$arr]);
                $objPHPExcel->mergeCells('C'.($a1+($nmb_sum*2)).':C'.($a1+(($nmb_sum*2)+2)))->setCellValue('C'.($a1+($nmb_sum*2)), $dt_form_kategori[$arr]);
                $objPHPExcel->mergeCells('D'.($a1+($nmb_sum*2)).':D'.($a1+(($nmb_sum*2)+2)))->setCellValue('D'.($a1+($nmb_sum*2)), $dt_form_subkategori[$arr]);
                $objPHPExcel->mergeCells('E'.($a1+($nmb_sum*2)).':E'.($a1+(($nmb_sum*2)+2)))->setCellValue('E'.($a1+($nmb_sum*2)), $dt_form_nama[$arr]);
                $objPHPExcel->mergeCells('F'.($a1+($nmb_sum*2)).':F'.($a1+(($nmb_sum*2)+2)))->setCellValue('F'.($a1+($nmb_sum*2)), $dt_form_versi[$arr]);
                $objPHPExcel->mergeCells('G'.($a1+($nmb_sum*2)).':G'.($a1+(($nmb_sum*2)+2)))->setCellValue('G'.($a1+($nmb_sum*2)), $dt_form_judul[$arr]);
                $objPHPExcel->mergeCells('H'.($a1+($nmb_sum*2)).':H'.($a1+(($nmb_sum*2)+2)))->setCellValue('H'.($a1+($nmb_sum*2)), $dt_report_by[$arr]);
                $objPHPExcel->mergeCells('I'.($a1+($nmb_sum*2)).':P'.($a1+(($nmb_sum*2)+2)))->setCellValue('I'.($a1+($nmb_sum*2)), $dt_ketidaksesuaian[$arr]);
                $objPHPExcel->mergeCells('Q'.($a1+($nmb_sum*2)).':Q'.($a1+(($nmb_sum*2)+2)))->setCellValue('Q'.($a1+($nmb_sum*2)), $dt_action_date[$arr]);
                $objPHPExcel->mergeCells('R'.($a1+($nmb_sum*2)).':R'.($a1+(($nmb_sum*2)+2)))->setCellValue('R'.($a1+($nmb_sum*2)), $dt_action_time[$arr]);
                $objPHPExcel->mergeCells('S'.($a1+($nmb_sum*2)).':S'.($a1+(($nmb_sum*2)+2)))->setCellValue('S'.($a1+($nmb_sum*2)), $dt_action_by[$arr]);
                $objPHPExcel->mergeCells('T'.($a1+($nmb_sum*2)).':V'.($a1+(($nmb_sum*2)+2)))->setCellValue('T'.($a1+($nmb_sum*2)), $dt_action_ket[$arr]);
                $objPHPExcel->mergeCells('W'.($a1+($nmb_sum*2)).':X'.($a1+(($nmb_sum*2)+2)))->setCellValue('W'.($a1+($nmb_sum*2)), $dt_action_status[$arr]);
                $objPHPExcel->mergeCells('Y'.($a1+($nmb_sum*2)).':Z'.($a1+(($nmb_sum*2)+2)))->setCellValue('Y'.($a1+($nmb_sum*2)), $dt_verifi_date[$arr]);
                $objPHPExcel->mergeCells('AA'.($a1+($nmb_sum*2)).':AA'.($a1+(($nmb_sum*2)+2)))->setCellValue('AA'.($a1+($nmb_sum*2)), $dt_verifi_time[$arr]);
                $objPHPExcel->mergeCells('AB'.($a1+($nmb_sum*2)).':AC'.($a1+(($nmb_sum*2)+2)))->setCellValue('AB'.($a1+($nmb_sum*2)), $dt_verifi_by[$arr]);
                $objPHPExcel->mergeCells('AD'.($a1+($nmb_sum*2)).':AD'.($a1+(($nmb_sum*2)+2)))->setCellValue('AD'.($a1+($nmb_sum*2)), $dt_verifi_ket[$arr]);
                $objPHPExcel->mergeCells('AE'.($a1+($nmb_sum*2)).':AE'.($a1+(($nmb_sum*2)+2)))->setCellValue('AE'.($a1+($nmb_sum*2)), $dt_verifi_status[$arr]);
                }else{
                $objPHPExcel->mergeCells('A'.($a1+($nmb_sum*2)).':A'.($a1+(($nmb_sum*2)+2)))->setCellValue('A'.($a1+($nmb_sum*2)), '');
                $objPHPExcel->mergeCells('B'.($a1+($nmb_sum*2)).':B'.($a1+(($nmb_sum*2)+2)))->setCellValue('B'.($a1+($nmb_sum*2)), '');
                $objPHPExcel->mergeCells('C'.($a1+($nmb_sum*2)).':C'.($a1+(($nmb_sum*2)+2)))->setCellValue('C'.($a1+($nmb_sum*2)), '');
                $objPHPExcel->mergeCells('D'.($a1+($nmb_sum*2)).':D'.($a1+(($nmb_sum*2)+2)))->setCellValue('D'.($a1+($nmb_sum*2)), '');
                $objPHPExcel->mergeCells('E'.($a1+($nmb_sum*2)).':E'.($a1+(($nmb_sum*2)+2)))->setCellValue('E'.($a1+($nmb_sum*2)), '');
                $objPHPExcel->mergeCells('F'.($a1+($nmb_sum*2)).':F'.($a1+(($nmb_sum*2)+2)))->setCellValue('F'.($a1+($nmb_sum*2)), '');
                $objPHPExcel->mergeCells('G'.($a1+($nmb_sum*2)).':G'.($a1+(($nmb_sum*2)+2)))->setCellValue('G'.($a1+($nmb_sum*2)), '');
                $objPHPExcel->mergeCells('H'.($a1+($nmb_sum*2)).':H'.($a1+(($nmb_sum*2)+2)))->setCellValue('H'.($a1+($nmb_sum*2)), '');
                $objPHPExcel->mergeCells('I'.($a1+($nmb_sum*2)).':P'.($a1+(($nmb_sum*2)+2)))->setCellValue('I'.($a1+($nmb_sum*2)), '');
                $objPHPExcel->mergeCells('Q'.($a1+($nmb_sum*2)).':Q'.($a1+(($nmb_sum*2)+2)))->setCellValue('Q'.($a1+($nmb_sum*2)), '');
                $objPHPExcel->mergeCells('R'.($a1+($nmb_sum*2)).':R'.($a1+(($nmb_sum*2)+2)))->setCellValue('R'.($a1+($nmb_sum*2)), '');
                $objPHPExcel->mergeCells('S'.($a1+($nmb_sum*2)).':S'.($a1+(($nmb_sum*2)+2)))->setCellValue('S'.($a1+($nmb_sum*2)), '');
                $objPHPExcel->mergeCells('T'.($a1+($nmb_sum*2)).':V'.($a1+(($nmb_sum*2)+2)))->setCellValue('T'.($a1+($nmb_sum*2)), '');
                $objPHPExcel->mergeCells('W'.($a1+($nmb_sum*2)).':X'.($a1+(($nmb_sum*2)+2)))->setCellValue('W'.($a1+($nmb_sum*2)), '');
                $objPHPExcel->mergeCells('Y'.($a1+($nmb_sum*2)).':Z'.($a1+(($nmb_sum*2)+2)))->setCellValue('Y'.($a1+($nmb_sum*2)), '');
                $objPHPExcel->mergeCells('AA'.($a1+($nmb_sum*2)).':AA'.($a1+(($nmb_sum*2)+2)))->setCellValue('AA'.($a1+($nmb_sum*2)), '');
                $objPHPExcel->mergeCells('AB'.($a1+($nmb_sum*2)).':AC'.($a1+(($nmb_sum*2)+2)))->setCellValue('AB'.($a1+($nmb_sum*2)), '');
                $objPHPExcel->mergeCells('AD'.($a1+($nmb_sum*2)).':AD'.($a1+(($nmb_sum*2)+2)))->setCellValue('AD'.($a1+($nmb_sum*2)), '');
                $objPHPExcel->mergeCells('AE'.($a1+($nmb_sum*2)).':AE'.($a1+(($nmb_sum*2)+2)))->setCellValue('AE'.($a1+($nmb_sum*2)), '');
                }
            }

            $last_row = ($a1+(($nmb_sum*2)+2));

            $objPHPExcel->mergeCells('A'.($last_row+1).':P'.($last_row+1))->setCellValue('A'.($last_row+1),'Mulai Berlaku: 02-08-2018');
            $objPHPExcel->getStyle('Q'.($last_row+1).':AE'.($last_row+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->mergeCells('Q'.($last_row+1).':AE'.($last_row+1))->setCellValue('Q'.($last_row+1),'INT-QAD-169-00');

            $objPHPExcel->setSharedStyle($footerStyleLeftbottom, 'A'.($last_row+1).':P'.($last_row+1));
            $objPHPExcel->setSharedStyle($footerStyleRightbottom, 'Q'.($last_row+1).':AE'.($last_row+1));

            $objPHPExcel->setBreak('A'.($last_row+1),  PHPExcel_Worksheet::BREAK_ROW);


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