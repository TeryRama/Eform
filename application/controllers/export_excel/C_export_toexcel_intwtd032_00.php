<?php
date_default_timezone_set('Asia/Jakarta');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//    session_start(); //Memanggil fungsi session Codeigniter
class C_export_toexcel_intwtd032_00 extends CI_Controller
{
    private $xls;
    private $spreadsheet;
    private $cekLevelUserNm;
    private $frmcop;

    var $header_id;
    var $frmnm;
    var $frmjdl;
    var $frmjdl_en;
    var $frmkd;
    var $frmver;
    var $frmefective;

    function __construct()
    {
        parent::__construct();
        $frmkode = $this->uri->segment(4);
        $frmvrs  = $this->uri->segment(5);
        $this->load->model(array('M_user', 'master/M_form', 'M_menu', 'form_input/M_forminput', 'form_input/M_form' . $frmkode . '_' . $frmvrs));
        $this->load->library(array('table', 'form_validation', 'excel', 'fpdf'));
        $session_data         = $this->session->userdata('logged_in');
        $dtheader['Titel']    = 'Home';
        $LevelUser            = $session_data['leveluserid'];
        $UserName             = $session_data['username'];
        $LevelUserNm          = $session_data['levelusernm'];
        $this->cekLevelUserNm = substr($LevelUserNm, 0, 7);
        $this->xls            = new exelstyles();
        $this->spreadsheet    = new Excel();
        $this->sheet          = $this->spreadsheet->getActiveSheet();
    }

    function exportxls()
    {
        $PT_style              = new PHPExcel_Style();
        $hdr_style_center      = new PHPExcel_Style();
        $hdr_style_start       = new PHPExcel_Style();
        $hdr_style_end         = new PHPExcel_Style();
        $th_style_center       = new PHPExcel_Style();
        $th_style_start        = new PHPExcel_Style();
        $th_style_end          = new PHPExcel_Style();
        $td_style_center       = new PHPExcel_Style();
        $td_style_start        = new PHPExcel_Style();
        $td_style_end          = new PHPExcel_Style();
        $ftr_style_start       = new PHPExcel_Style();
        $ftr_style_end         = new PHPExcel_Style();
        $line_style_left       = new PHPExcel_Style();
        $line_style_right      = new PHPExcel_Style();
        $line_style_top        = new PHPExcel_Style();
        $line_style_bottom     = new PHPExcel_Style();
        $noborder_style_center = new PHPExcel_Style();
        $noborder_style_start  = new PHPExcel_Style();
        $noborder_style_end    = new PHPExcel_Style();

        // other
        $noborder_bold_start    = new PHPExcel_Style();
        $noborder_nobold_center = new PHPExcel_Style();
        $noborder_nobold_start  = new PHPExcel_Style();
        $th_style_center_normal = new PHPExcel_Style();
        $th_style_center_italic = new PHPExcel_Style();

        $PT_style->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => true,
                    'name' => 'Trebuchet MS',
                    'size' => 14
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
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
                )
            )
        );
        $hdr_style_center->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => false,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
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
                )
            )
        );
        $hdr_style_start->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => false,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
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
                )
            )
        );
        $hdr_style_end->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => false,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
                'borders' => array(
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'left'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                )
            )
        );
        $th_style_center->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => true,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
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
                )
            )
        );
        $th_style_start->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => true,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
                'borders' => array(
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'left'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                )
            )
        );
        $th_style_end->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => true,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
                'borders' => array(
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'left'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                )
            )
        );
        $td_style_center->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => false,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
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
                )
            )
        );
        $td_style_start->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => false,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
                'borders' => array(
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'left'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                )
            )
        );
        $td_style_end->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => false,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
                'borders' => array(
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'left'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                )
            )
        );
        $ftr_style_start->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => false,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
                'borders' => array(
                    'left'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                )
            )
        );
        $ftr_style_end->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => false,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
                'borders' => array(
                    'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                )
            )
        );
        $line_style_left->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => false,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
                'borders' => array(
                    'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                )
            )
        );
        $line_style_right->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => false,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
                'borders' => array(
                    'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                )
            )
        );
        $line_style_top->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => false,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
                'borders' => array(
                    'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                )
            )
        );
        $line_style_bottom->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => false,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
                'borders' => array(
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                )
            )
        );
        $noborder_style_center->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => false,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                )
            )
        );
        $noborder_style_start->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => false,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                )
            )
        );
        $noborder_style_end->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => false,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                )
            )
        );

        // other
        $noborder_bold_start->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => true,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                ),
            )
        );
        $noborder_nobold_center->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => false,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                ),
            )
        );
        $noborder_nobold_start->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => false,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                ),
            )
        );
        $th_style_center_normal->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold' => true,
                    'name' => 'Trebuchet MS',
                    'size' => 9
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
                'borders' => array(
                    'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'left'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'top'   => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                ),
            )
        );
        $th_style_center_italic->applyFromArray(
            array(
                'fill'   => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID
                ),
                'font' => array(
                    'bold'   => true,
                    'name'   => 'Trebuchet MS',
                    'size'   => 9,
                    'italic' => true
                ),
                'numberformat'   => array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
                ),
                'borders' => array(
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'left'   => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                ),
            )
        );

        $frmkode  = $this->uri->segment(4);
        $frmvrs   = $this->uri->segment(5);
        $headerid = $this->uri->segment(6);
        $dtfrm    = $this->M_forminput->get_dtform($frmkode, $frmvrs);
        foreach ($dtfrm as $datafrm) {
            $frmkd     = $datafrm->formkd;
            $frmjdl    = $datafrm->formjudul;
            $frmnm     = $datafrm->formnm;
            $frmversi  = $datafrm->formversi;
            $frm_efect = substr($datafrm->formefective, 8, 2) . '-' . substr($datafrm->formefective, 5, 2) . '-' . substr($datafrm->formefective, 0, 4);
        }
        $frmcop = $this->config->item("nama_perusahaan");

        $this->model = $this->{'M_form' . $frmkode . '_' . $frmvrs};

        $dtheader = $this->model->get_header_byid($headerid);
        if (isset($dtheader)) {
            foreach ($dtheader as $dtheader_row) {
                $dtcreate_date    = $dtheader_row->create_date;
                $create_date      = date("d-m-Y", strtotime($dtheader_row->create_date));
                $docno            = $dtheader_row->docno;
                $equipment_name   = $dtheader_row->equipment_name;
                $equipment_code   = $dtheader_row->equipment_code;
                $running_test     = date("d-m-Y", strtotime($dtheader_row->running_test));
                $operational_date = date("d-m-Y", strtotime($dtheader_row->operational_date));

                $app1_by             = $dtheader_row->app1_by;
                $app1_position       = $dtheader_row->app1_position;
                $app1_personalid     = $dtheader_row->app1_personalid;
                $app1_personalstatus = $dtheader_row->app1_personalstatus;
                $app1_date           = $dtheader_row->app1_date;
                $app2_by             = $dtheader_row->app2_by;
                $app2_position       = $dtheader_row->app2_position;
                $app2_personalid     = $dtheader_row->app2_personalid;
                $app2_personalstatus = $dtheader_row->app2_personalstatus;
                $app2_date           = $dtheader_row->app2_date;
                $app3_by             = $dtheader_row->app3_by;
                $app3_position       = $dtheader_row->app3_position;
                $app3_personalid     = $dtheader_row->app3_personalid;
                $app3_personalstatus = $dtheader_row->app3_personalstatus;
                $app3_date           = $dtheader_row->app3_date;
                if (trim($dtheader_row->app1_date) != '') {
                    $app1_date = date('d-m-Y', strtotime($dtheader_row->app1_date));
                } else {
                    $app1_date = '';
                }
                if (trim($dtheader_row->app2_date) != '') {
                    $app2_date = date('d-m-Y', strtotime($dtheader_row->app2_date));
                } else {
                    $app2_date = '';
                }
                if (trim($dtheader_row->app3_date) != '') {
                    $app3_date = date('d-m-Y', strtotime($dtheader_row->app3_date));
                } else {
                    $app3_date = '';
                }
            }
        }

        if ($this->cekLevelUserNm == "Auditor") {
            $dtdetail = $this->model->get_detail_byidx($headerid);
        } else {
            $dtdetail = $this->model->get_detail_byid($headerid);
        }
        $no = 1;
        foreach ($dtdetail as $row) {
            $arr_dta_number[]            = $no++;
            $arr_dta_problem_condition[] = $row->dta_problem_condition;
            $arr_dta_problem_solving[]   = $row->dta_problem_solving;
            $arr_dta_start[]             = $row->dta_start;
            $arr_dta_finish[]            = $row->dta_finish;
            $arr_dta_usage_material[]    = $row->dta_usage_material;
            $arr_dta_total[]             = $row->dta_total;
            $arr_dta_remark[]            = $row->dta_remark;
        }

        $count1           = count($dtdetail);
        $jml_data_perpage = 10;
        if ($count1 < $jml_data_perpage) {
            $total_page = 1;
        } else {
            if (($count1 % $jml_data_perpage) == 0) {
                $total_page = $count1 / $jml_data_perpage;
            } else {
                $total_page = floor(($count1 / $jml_data_perpage)) + 1;
            }
        }
        $jml_row_perpage = $jml_data_perpage + 17;

        $obj        = new Excel();
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setPath('assets/images/PSG_logo_2022.png');
        $objPHPExcel = $obj->createSheet(0);
        $objPHPExcel->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $objPHPExcel->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objPHPExcel->getPageSetup()->setFitToPage(true);
        $objPHPExcel->getPageSetup()->setFitToWidth(0);
        $objPHPExcel->getPageSetup()->setFitToHeight(0);
        $objPHPExcel->getPageSetup()->setScale(100);
        $range    = array();
        $rangeCol = "AF";
        for ($y = "A", $rangeCol++; $y != $rangeCol; $y++) {
            $range[] = $y;
        }
        foreach ($range as $columnID) {
            $objPHPExcel->getColumnDimension($columnID)->setWidth(4);
        }
        for ($a = 0; $a < 500; $a++) {
            $objPHPExcel->getRowDimension($a)->setRowHeight(18);
        }

        for ($i = 0; $i < $total_page; $i++) {
            $hdr_cell      = ($i * $jml_row_perpage) + 1;
            $finish_row    = ((($i * $jml_row_perpage) + 1) + ($jml_row_perpage));
            $start_detail  = ($i * $jml_data_perpage);
            $finish_detail = (($i * $jml_data_perpage) + ($jml_data_perpage - 1));
            $gbr           = '$objDrawing' . $i;
            $gbr           = new PHPExcel_Worksheet_Drawing();
            $gbr->setPath('assets/images/PSG_logo_2022.png');
            $gbr->setWidthAndHeight(55, 55);
            $gbr->setCoordinates('A' . $hdr_cell)->setOffsetX(16);
            $gbr->setWorksheet($objPHPExcel);

            $objPHPExcel->mergeCells('A' . $hdr_cell . ':C' . ($hdr_cell + 1));
            $objPHPExcel->mergeCells('A' . ($hdr_cell + 2) . ':C' . ($hdr_cell + 2))->setCellValue('A' . ($hdr_cell + 2), 'JUDUL');
            $objPHPExcel->mergeCells('D' . $hdr_cell . ':X' . ($hdr_cell + 1))->setCellValue('D' . $hdr_cell, $frmcop);
            $objPHPExcel->mergeCells('D' . ($hdr_cell + 2) . ':X' . ($hdr_cell + 2))->setCellValue('D' . ($hdr_cell + 2), $frmjdl);
            $objPHPExcel->mergeCells('Y' . $hdr_cell . ':Z' . $hdr_cell)->setCellValue('Y' . $hdr_cell, 'Dok');
            $objPHPExcel->mergeCells('AA' . $hdr_cell . ':AF' . $hdr_cell)->setCellValue('AA' . $hdr_cell, ': ' . $docno);
            $objPHPExcel->mergeCells('Y' . ($hdr_cell + 1) . ':Z' . ($hdr_cell + 1))->setCellValue('Y' . ($hdr_cell + 1), 'Tgl');
            $objPHPExcel->mergeCells('AA' . ($hdr_cell + 1) . ':AF' . ($hdr_cell + 1))->setCellValue('AA' . ($hdr_cell + 1), ': ' . $create_date);
            $objPHPExcel->mergeCells('Y' . ($hdr_cell + 2) . ':Z' . ($hdr_cell + 2))->setCellValue('Y' . ($hdr_cell + 2), 'Hlm');
            $objPHPExcel->mergeCells('AA' . ($hdr_cell + 2) . ':AF' . ($hdr_cell + 2))->setCellValue('AA' . ($hdr_cell + 2), ': ' . ($i + 1) . ' dari ' . $total_page);
            $objPHPExcel->setSharedStyle($hdr_style_start, 'A' . $hdr_cell . ':C' . ($hdr_cell + 2));
            $objPHPExcel->setSharedStyle($PT_style, 'D' . $hdr_cell . ':X' . ($hdr_cell + 1));
            $objPHPExcel->setSharedStyle($hdr_style_center, 'D' . ($hdr_cell + 2) . ':X' . ($hdr_cell + 2));
            $objPHPExcel->setSharedStyle($hdr_style_end, 'Y' . $hdr_cell . ':AF' . ($hdr_cell + 2));

            $objPHPExcel->mergeCells('A' . ($hdr_cell + 3) . ':C' . ($hdr_cell + 3))->setCellValue('A' . ($hdr_cell + 3), 'NAMA ALAT');
            $objPHPExcel->mergeCells('D' . ($hdr_cell + 3) . ':AF' . ($hdr_cell + 3))->setCellValue('D' . ($hdr_cell + 3), ': ' . $equipment_name);
            $objPHPExcel->mergeCells('A' . ($hdr_cell + 4) . ':C' . ($hdr_cell + 4))->setCellValue('A' . ($hdr_cell + 4), 'KODE ALAT');
            $objPHPExcel->mergeCells('D' . ($hdr_cell + 4) . ':AF' . ($hdr_cell + 4))->setCellValue('D' . ($hdr_cell + 4), ': ' . $equipment_code);
            $objPHPExcel->setSharedStyle($noborder_style_start, 'A' . ($hdr_cell + 3) . ':AF' . ($hdr_cell + 4));
            $objPHPExcel->setSharedStyle($line_style_left, 'A' . ($hdr_cell + 3) . ':A' . ($hdr_cell + 4));
            $objPHPExcel->setSharedStyle($line_style_right, 'AF' . ($hdr_cell + 3) . ':AF' . ($hdr_cell + 4));

            $dta_hcell = $hdr_cell + 4;
            $objPHPExcel->mergeCells('A' .  ($dta_hcell + 1) . ':A' .  ($dta_hcell + 2))->setCellValue('A' .  ($dta_hcell + 1), "NO");
            $objPHPExcel->mergeCells('B' .  ($dta_hcell + 1) . ':I' .  ($dta_hcell + 2))->setCellValue('B' .  ($dta_hcell + 1), "KONDISI \n MASALAH");
            $objPHPExcel->mergeCells('J' .  ($dta_hcell + 1) . ':O' .  ($dta_hcell + 2))->setCellValue('J' .  ($dta_hcell + 1), "TINDAKAN");
            $objPHPExcel->mergeCells('P' .  ($dta_hcell + 1) . ':S' .  ($dta_hcell + 1))->setCellValue('P' .  ($dta_hcell + 1), "WAKTU");
            $objPHPExcel->mergeCells('P' .  ($dta_hcell + 2) . ':Q' .  ($dta_hcell + 2))->setCellValue('P' .  ($dta_hcell + 2), "MULAI");
            $objPHPExcel->mergeCells('R' .  ($dta_hcell + 2) . ':S' .  ($dta_hcell + 2))->setCellValue('R' .  ($dta_hcell + 2), "SELESAI");
            $objPHPExcel->mergeCells('T' .  ($dta_hcell + 1) . ':W' .  ($dta_hcell + 2))->setCellValue('T' .  ($dta_hcell + 1), "PEMAKAIAN \n MATERIAL");
            $objPHPExcel->mergeCells('X' .  ($dta_hcell + 1) . ':Z' .  ($dta_hcell + 2))->setCellValue('X' .  ($dta_hcell + 1), "JUMLAH");
            $objPHPExcel->mergeCells('AA' .  ($dta_hcell + 1) . ':AF' .  ($dta_hcell + 2))->setCellValue('AA' .  ($dta_hcell + 1), "KETERANGAN");
            $objPHPExcel->setSharedStyle($th_style_center, 'A' . ($dta_hcell + 1) . ':AF' . ($dta_hcell + 2));

            $dta_dcell = $dta_hcell + 3;
            for ($a = $start_detail; $a <= $finish_detail; $a++) {
                $objPHPExcel->getRowDimension($dta_dcell)->setRowHeight(18);
                if (isset($arr_dta_number[$a])) {
                    $dt_dta_number[$a] = $arr_dta_number[$a];
                } else {
                    $dt_dta_number[$a] = "";
                }
                if (isset($arr_dta_problem_condition[$a])) {
                    $dt_dta_problem_condition[$a] = $arr_dta_problem_condition[$a];
                } else {
                    $dt_dta_problem_condition[$a] = "";
                }
                if (isset($arr_dta_problem_solving[$a])) {
                    $dt_dta_problem_solving[$a] = $arr_dta_problem_solving[$a];
                } else {
                    $dt_dta_problem_solving[$a] = "";
                }
                if (isset($arr_dta_start[$a])) {
                    $dt_dta_start[$a] = $arr_dta_start[$a];
                } else {
                    $dt_dta_start[$a] = "";
                }
                if (isset($arr_dta_finish[$a])) {
                    $dt_dta_finish[$a] = $arr_dta_finish[$a];
                } else {
                    $dt_dta_finish[$a] = "";
                }
                if (isset($arr_dta_usage_material[$a])) {
                    $dt_dta_usage_material[$a] = $arr_dta_usage_material[$a];
                } else {
                    $dt_dta_usage_material[$a] = "";
                }
                if (isset($arr_dta_total[$a])) {
                    $dt_dta_total[$a] = $arr_dta_total[$a];
                } else {
                    $dt_dta_total[$a] = "";
                }
                if (isset($arr_dta_remark[$a])) {
                    $dt_dta_remark[$a] = $arr_dta_remark[$a];
                } else {
                    $dt_dta_remark[$a] = "";
                }
                $objPHPExcel->mergeCells('A' .  $dta_dcell . ':A' .  $dta_dcell)->setCellValue('A' .  $dta_dcell, $dt_dta_number[$a]);
                $objPHPExcel->mergeCells('B' .  $dta_dcell . ':I' .  $dta_dcell)->setCellValue('B' .  $dta_dcell, $dt_dta_problem_condition[$a]);
                $objPHPExcel->mergeCells('J' .  $dta_dcell . ':O' .  $dta_dcell)->setCellValue('J' .  $dta_dcell, $dt_dta_problem_solving[$a]);
                $objPHPExcel->mergeCells('P' .  $dta_dcell . ':Q' .  $dta_dcell)->setCellValue('P' .  $dta_dcell, $dt_dta_start[$a]);
                $objPHPExcel->mergeCells('R' .  $dta_dcell . ':S' .  $dta_dcell)->setCellValue('R' .  $dta_dcell, $dt_dta_finish[$a]);
                $objPHPExcel->mergeCells('T' .  $dta_dcell . ':W' .  $dta_dcell)->setCellValue('T' .  $dta_dcell, $dt_dta_usage_material[$a]);
                $objPHPExcel->mergeCells('X' .  $dta_dcell . ':Z' .  $dta_dcell)->setCellValue('X' .  $dta_dcell, $dt_dta_total[$a]);
                $objPHPExcel->mergeCells('AA' .  $dta_dcell . ':AF' .  $dta_dcell)->setCellValue('AA' .  $dta_dcell, $dt_dta_remark[$a]);
                $objPHPExcel->setSharedStyle($td_style_center, 'A' . $dta_dcell  . ':A' . $dta_dcell);
                $objPHPExcel->setSharedStyle($td_style_start,  'B' . $dta_dcell . ':O' . $dta_dcell);
                $objPHPExcel->setSharedStyle($td_style_center,  'P' . $dta_dcell . ':S' . $dta_dcell);
                $objPHPExcel->setSharedStyle($td_style_start,  'T' . $dta_dcell . ':AF' . $dta_dcell);
                $dta_dcell++;
            }

            $dta_fcell = $dta_dcell;
            $objPHPExcel->mergeCells('A' . $dta_fcell . ':E' . $dta_fcell)->setCellValue('A' . $dta_fcell, 'Masa uji/running test');
            $objPHPExcel->mergeCells('F' . $dta_fcell . ':AF' . $dta_fcell)->setCellValue('F' . $dta_fcell, ': ' . $running_test);
            $objPHPExcel->mergeCells('A' . ($dta_fcell + 1) . ':E' . ($dta_fcell + 1))->setCellValue('A' . ($dta_fcell + 1), 'Layak operasi tanggal');
            $objPHPExcel->mergeCells('F' . ($dta_fcell + 1) . ':AF' . ($dta_fcell + 1))->setCellValue('F' . ($dta_fcell + 1), ': ' . $operational_date);
            $objPHPExcel->setSharedStyle($noborder_style_start, 'A' . $dta_fcell . ':AF' . ($dta_fcell + 1));
            $objPHPExcel->setSharedStyle($line_style_left, 'A' . $dta_fcell . ':A' . ($dta_fcell + 1));
            $objPHPExcel->setSharedStyle($line_style_right, 'AF' . $dta_fcell . ':AF' . ($dta_fcell + 1));

            //approval
            $app_cell = $dta_fcell + 1;
            $objPHPExcel->mergeCells('I' . ($app_cell + 1) . ':P' . ($app_cell + 1))->setCellValue('I' . ($app_cell + 1), 'Dibuat Oleh,');
            $objPHPExcel->mergeCells('I' . ($app_cell + 2) . ':P' . ($app_cell + 4))->setCellValue('I' . ($app_cell + 2), '');
            $objPHPExcel->mergeCells('I' . ($app_cell + 5) . ':J' . ($app_cell + 5))->setCellValue('I' . ($app_cell + 5), 'Nama');
            $objPHPExcel->mergeCells('I' . ($app_cell + 6) . ':J' . ($app_cell + 6))->setCellValue('I' . ($app_cell + 6), 'Jabatan');
            $objPHPExcel->mergeCells('I' . ($app_cell + 7) . ':J' . ($app_cell + 7))->setCellValue('I' . ($app_cell + 7), 'Tanggal');
            $objPHPExcel->mergeCells('K' . ($app_cell + 5) . ':P' . ($app_cell + 5))->setCellValue('K' . ($app_cell + 5), ': ' . $app1_by);
            $objPHPExcel->mergeCells('K' . ($app_cell + 6) . ':P' . ($app_cell + 6))->setCellValue('K' . ($app_cell + 6), ': ' . $app1_position);
            $objPHPExcel->mergeCells('K' . ($app_cell + 7) . ':P' . ($app_cell + 7))->setCellValue('K' . ($app_cell + 7), ': ' . $app1_date);
            if ($app1_personalstatus == '2') {
                $imageurlapp = '/forviewfoto_pekerja/TTD_TK/';
                $imageformatapp = '.png';
            } else if (
                $app1_personalstatus == '1'
            ) {
                $imageurlapp = '/forviewfoto_pekerja/';
                $imageformatapp = '_0_0.png';
            } else {
                $imageurlapp = '';
                $imageformatapp = '';
            }
            $fcpath1   = str_replace('utl/', '', FCPATH);
            $sign_img  = '$objDrawing';
            if (isset($app1_by)) {
                if (file_exists($fcpath1 . 'utl/assets/ttd/' . $app1_personalstatus . '_' . $app1_personalid . '.png')) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/ttd/' . $app1_personalstatus . '_' . $app1_personalid . '.png');
                    $sign_img->setWidthAndHeight(120, 120);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('K' . ($app_cell + 2));
                } else if ($app1_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp . $app1_personalid . $imageformatapp)) {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp . $app1_personalid . $imageformatapp);
                    $sign_img->setWidthAndHeight(120, 120);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('K' . ($app_cell + 2));
                } else {
                    $sign_img = new PHPExcel_Worksheet_Drawing();
                    $sign_img->setPath('assets/images/approved.png');
                    $sign_img->setWidthAndHeight(120, 120);
                    $sign_img->setResizeProportional(true);
                    $sign_img->setWorksheet($objPHPExcel);
                    $sign_img->setCoordinates('K' . ($app_cell + 2));
                }
            }

            $objPHPExcel->mergeCells('Q' . ($app_cell + 1) . ':X' . ($app_cell + 1))->setCellValue('Q' . ($app_cell + 1), 'Diketahui Oleh,');
            $objPHPExcel->mergeCells('Q' . ($app_cell + 2) . ':X' . ($app_cell + 4))->setCellValue('Q' . ($app_cell + 2), '');
            $objPHPExcel->mergeCells('Q' . ($app_cell + 5) . ':R' . ($app_cell + 5))->setCellValue('Q' . ($app_cell + 5), 'Nama');
            $objPHPExcel->mergeCells('Q' . ($app_cell + 6) . ':R' . ($app_cell + 6))->setCellValue('Q' . ($app_cell + 6), 'Jabatan');
            $objPHPExcel->mergeCells('Q' . ($app_cell + 7) . ':R' . ($app_cell + 7))->setCellValue('Q' . ($app_cell + 7), 'Tanggal');
            $objPHPExcel->mergeCells('S' . ($app_cell + 5) . ':X' . ($app_cell + 5))->setCellValue('S' . ($app_cell + 5), ': ' . $app2_by);
            $objPHPExcel->mergeCells('S' . ($app_cell + 6) . ':X' . ($app_cell + 6))->setCellValue('S' . ($app_cell + 6), ': ' . $app2_position);
            $objPHPExcel->mergeCells('S' . ($app_cell + 7) . ':X' . ($app_cell + 7))->setCellValue('S' . ($app_cell + 7), ': ' . $app2_date);
            if ($app2_personalstatus == '2') {
                $imageurlapp2 = '/forviewfoto_pekerja/TTD_TK/';
                $imageformatapp2 = '.png';
            } else if ($app2_personalstatus == '1') {
                $imageurlapp2 = '/forviewfoto_pekerja/';
                $imageformatapp2 = '_0_0.png';
            } else {
                $imageurlapp2 = '';
                $imageformatapp2 = '';
            }
            $fcpath2   = str_replace('utl/', '', FCPATH);
            $sign_img2 = '$objDrawing';
            if (isset($app2_by)) {
                if (file_exists($fcpath2 . 'utl/assets/ttd/' . $app2_personalstatus . '_' . $app2_personalid . '.png')) {
                    $sign_img2 = new PHPExcel_Worksheet_Drawing();
                    $sign_img2->setPath('assets/ttd/' . $app2_personalstatus . '_' . $app2_personalid . '.png');
                    $sign_img2->setWidthAndHeight(120, 120);
                    $sign_img2->setResizeProportional(true);
                    $sign_img2->setWorksheet($objPHPExcel);
                    $sign_img2->setCoordinates('S' . ($app_cell + 2));
                } else if ($app2_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2)) {
                    $sign_img2 = new PHPExcel_Worksheet_Drawing();
                    $sign_img2->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp2 . $app2_personalid . $imageformatapp2);
                    $sign_img2->setWidthAndHeight(120, 120);
                    $sign_img2->setResizeProportional(true);
                    $sign_img2->setWorksheet($objPHPExcel);
                    $sign_img2->setCoordinates('S' . ($app_cell + 2));
                } else {
                    $sign_img2 = new PHPExcel_Worksheet_Drawing();
                    $sign_img2->setPath('assets/images/approved.png');
                    $sign_img2->setWidthAndHeight(120, 120);
                    $sign_img2->setResizeProportional(true);
                    $sign_img2->setWorksheet($objPHPExcel);
                    $sign_img2->setCoordinates('S' . ($app_cell + 2));
                }
            }

            $objPHPExcel->mergeCells('Y' . ($app_cell + 1) . ':AF' . ($app_cell + 1))->setCellValue('Y' . ($app_cell + 1), 'Disetujui Oleh,');
            $objPHPExcel->mergeCells('Y' . ($app_cell + 2) . ':AF' . ($app_cell + 4))->setCellValue('Y' . ($app_cell + 2), '');
            $objPHPExcel->mergeCells('Y' . ($app_cell + 5) . ':Z' . ($app_cell + 5))->setCellValue('Y' . ($app_cell + 5), 'Nama');
            $objPHPExcel->mergeCells('Y' . ($app_cell + 6) . ':Z' . ($app_cell + 6))->setCellValue('Y' . ($app_cell + 6), 'Jabatan');
            $objPHPExcel->mergeCells('Y' . ($app_cell + 7) . ':Z' . ($app_cell + 7))->setCellValue('Y' . ($app_cell + 7), 'Tanggal');
            $objPHPExcel->mergeCells('AA' . ($app_cell + 5) . ':AF' . ($app_cell + 5))->setCellValue('AA' . ($app_cell + 5), ': ' . $app3_by);
            $objPHPExcel->mergeCells('AA' . ($app_cell + 6) . ':AF' . ($app_cell + 6))->setCellValue('AA' . ($app_cell + 6), ': ' . $app3_position);
            $objPHPExcel->mergeCells('AA' . ($app_cell + 7) . ':AF' . ($app_cell + 7))->setCellValue('AA' . ($app_cell + 7), ': ' . $app3_date);
            if ($app3_personalstatus == '2') {
                $imageurlapp3 = '/forviewfoto_pekerja/TTD_TK/';
                $imageformatapp3 = '.png';
            } else if ($app3_personalstatus == '1') {
                $imageurlapp3 = '/forviewfoto_pekerja/';
                $imageformatapp3 = '_0_0.png';
            } else {
                $imageurlapp3 = '';
                $imageformatapp3 = '';
            }
            $fcpath3   = str_replace('utl/', '', FCPATH);
            $sign_img3 = '$objDrawing';
            if (isset($app3_by)) {
                if (file_exists($fcpath3 . 'utl/assets/ttd/' . $app3_personalstatus . '_' . $app3_personalid . '.png')) {
                    $sign_img3 = new PHPExcel_Worksheet_Drawing();
                    $sign_img3->setPath('assets/ttd/' . $app3_personalstatus . '_' . $app3_personalid . '.png');
                    $sign_img3->setWidthAndHeight(120, 120);
                    $sign_img3->setResizeProportional(true);
                    $sign_img3->setWorksheet($objPHPExcel);
                    $sign_img3->setCoordinates('AA' . ($app_cell + 2));
                } else if ($app3_personalid != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3)) {
                    $sign_img3 = new PHPExcel_Worksheet_Drawing();
                    $sign_img3->setPath($_SERVER['DOCUMENT_ROOT'] . $imageurlapp3 . $app3_personalid . $imageformatapp3);
                    $sign_img3->setWidthAndHeight(120, 120);
                    $sign_img3->setResizeProportional(true);
                    $sign_img3->setWorksheet($objPHPExcel);
                    $sign_img3->setCoordinates('AA' . ($app_cell + 2));
                } else {
                    $sign_img3 = new PHPExcel_Worksheet_Drawing();
                    $sign_img3->setPath('assets/images/approved.png');
                    $sign_img3->setWidthAndHeight(120, 120);
                    $sign_img3->setResizeProportional(true);
                    $sign_img3->setWorksheet($objPHPExcel);
                    $sign_img3->setCoordinates('AA' . ($app_cell + 2));
                }
            }

            $objPHPExcel->setSharedStyle($th_style_center, 'I' . ($app_cell + 1) . ':AF' . ($app_cell + 1));
            $objPHPExcel->setSharedStyle($td_style_start, 'I' . ($app_cell + 2) . ':AF' . ($app_cell + 7));

            $objPHPExcel->setSharedStyle($noborder_style_start, 'A' . ($app_cell + 1) . ':H' . ($app_cell + 7));
            $objPHPExcel->setSharedStyle($line_style_left, 'A' . ($app_cell + 1) . ':A' . ($app_cell + 7));

            // footer
            $ftr_cell = $app_cell + 7;
            $objPHPExcel->mergeCells('A' . ($ftr_cell + 1) . ':O' . ($ftr_cell + 1))->setCellValue('A' . ($ftr_cell + 1), 'Mulai Berlaku : ' . $frm_efect);
            $objPHPExcel->mergeCells('P' . ($ftr_cell + 1) . ':AF' . ($ftr_cell + 1))->setCellValue('P' . ($ftr_cell + 1), $frmnm . '-' . $frmvrs);
            $objPHPExcel->getStyle('A' . ($ftr_cell + 1) . ':AF' . ($ftr_cell + 1))->getFont()->setBold(true);
            $objPHPExcel->getStyle('P' . ($ftr_cell + 1) . ':AF' . ($ftr_cell + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->setSharedStyle($ftr_style_start, 'A' . ($ftr_cell + 1) . ':O' . ($ftr_cell + 1));
            $objPHPExcel->setSharedStyle($ftr_style_end, 'P' . ($ftr_cell + 1) . ':AF' . ($ftr_cell + 1));
            $objPHPExcel->setBreak('A' . ($ftr_cell + 1),  PHPExcel_Worksheet::BREAK_ROW);
        }

        ob_clean();
        header('Content-Type: text/html; charset=utf-8');
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $frmnm . '.xls');
        $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel5');
        $objWriter->save('php://output');
        exit();
        ob_end_clean();
    }
}
