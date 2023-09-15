<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class M_tambahan extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
    }

    function get_form_kode($nm_lab)
    {
        $this->db1->distinct();
        $this->db1->select('formkode');
        $this->db1->where('nm_lab', $nm_lab);
        $result = $this->db1->get('tblmstkode_samplekimia');
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_agno3($tgltest)
    {
        $query = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='AgNO3' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function getdata_edta($tgltest)
    {
        $query = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='EDTA' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function getdata_na2s2o3_qad016($tgltest)
    {
        $query = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='Na2S2O3' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function getdata_na2edta($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='Na2EDTA'  AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_hcl002($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='HCI' AND konsentrasi='0.0200' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_hcl1000($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='HCI'  AND konsentrasi='1.0000' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_hcl1m($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='HCI'  AND konsentrasi='1.0000' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_hcl1m_labcmp2($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmnon079dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmnon079hdr JOIN  tblfrmfrmnon079dtl ON tblfrmfrmnon079hdr.headerid = tblfrmfrmnon079dtl.headerid where id_larutan ='HCI'  AND konsentrasi='1.0000' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_naoh1m_labcmp2($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmnon079dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmnon079hdr JOIN  tblfrmfrmnon079dtl ON tblfrmfrmnon079hdr.headerid = tblfrmfrmnon079dtl.headerid where id_larutan ='NaOH'  AND konsentrasi='0.5000' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            // var_dump($result->result());
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_hcl1m_induk($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='HCI'  AND konsentrasi='1.0000' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_naoh1m($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='NaOH'  AND konsentrasi='0.5000' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            // var_dump($result->result());
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_naoh01000($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='NaOH'  AND konsentrasi='0.1000' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            // var_dump($result->result());
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_naoh1m_induk($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='NaOH'  AND konsentrasi='0.5000' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            // var_dump($result->result());
            return $result->result_array();
        } else {
            return array();
        }
    }


    function getdata_kio32083($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(8,6))),6) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='KIO3'  AND konsentrasi='0.002083' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_naoh00100($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(8,6))),6) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='NaOH'  AND konsentrasi='0.0100' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_naoh141($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(8,6))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='NaOH'  AND konsentrasi='0.0100' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_na2s2o3($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='Na2S2O3.2H2O'  AND konsentrasi='0.0100' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_na2s2o3_2($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='Na2S2O3.2H2O'  AND konsentrasi='0.1000' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    ///////////////////////////////////////////////////////////////////
    ////////////////          LQS 082 dan 054 model     ///////////////
    ///////////////////////////////////////////////////////////////////

    function getdata_naoh2($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='NaOH'  AND konsentrasi='0.01' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            // var_dump($result->result());
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_naoh2_mini($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='NaOH'  AND konsentrasi='0.01' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            // var_dump($result->result());
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_picno2($tgl_analisa, $no_picno)
    {
        $result = $this->db1->query("select picno_kosong, picno_hasil from tblfrmfrmqad004dtl WHERE dttanggal='$tgl_analisa' AND dtno='$no_picno'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_na2s2o3b($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='NaOH'  AND konsentrasi='0.1000' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_na2s2o3puregene($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='Na2S2O3.2H2O'  AND konsentrasi='0.1000' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_na2s2o3puregene2($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='Na2S2O3.2H2O'  AND konsentrasi='0.0100' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_i2($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='I2'  AND konsentrasi='0.0100' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_i2_mini($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='I2'  AND konsentrasi='0.0100' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_agno3_chlo($tgltest)
    {
        $query = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='AgNO3'  AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function getdata_agno3_chlo_mini($tgltest)
    {
        $query = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='AgNO3'  AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function getdata_naoh1000($tgltest)
    {
        $result = $this->db1->query("select coalesce(round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4),0) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='NaOH'  AND konsentrasi='0.1000' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_naoh1000_mini($tgltest)
    {
        $result = $this->db1->query("select coalesce(round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4),0) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='NaOH'  AND konsentrasi='0.1000' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    ///////////////////////////////////////////////////////////////////
    ////////////////       End  LQS 082 model           ///////////////
    ///////////////////////////////////////////////////////////////////

    function getdata_naoh($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='NaOH'  AND konsentrasi='0.0100' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_naoh_lqs081($tgltest, $normalitas_naoh)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='NaOH'  AND konsentrasi='$normalitas_naoh' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest' AND trim(hasil_m) <> ''");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_naoh5000($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='NaOH'  AND konsentrasi='0.5000' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_naoh_2($tgltest)
    {
        $result = $this->db1->query("select round(avg(cast(tblfrmfrmqad005dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005hdr JOIN  tblfrmfrmqad005dtl ON tblfrmfrmqad005hdr.headerid = tblfrmfrmqad005dtl.headerid where id_larutan ='NaOH'  AND konsentrasi='0.1000' AND tgl_start <='$tgltest' AND tgl_finish >='$tgltest'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_edta_qad150($tgltest, $normalitas)
    {
        $result = $this->db1->query("select round(avg(cast(dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005dtl as dtl join tblfrmfrmqad005hdr as hdr on hdr.headerid = dtl.headerid where hdr.id_larutan = 'EDTA' and hdr.konsentrasi = '$normalitas' and dtl.tgl_start <= '$tgltest' and dtl.tgl_finish >= '$tgltest' and trim(dtl.hasil_m) <> '' and dtl.status_param = 'Active'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_agno3_qad150($tgltest, $normalitas)
    {
        $result = $this->db1->query("select round(avg(cast(dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005dtl as dtl join tblfrmfrmqad005hdr as hdr on hdr.headerid = dtl.headerid where hdr.id_larutan = 'AgNO3' and hdr.konsentrasi = '$normalitas' and dtl.tgl_start <= '$tgltest' and dtl.tgl_finish >= '$tgltest' and trim(dtl.hasil_m) <> '' and dtl.status_param = 'Active'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_KIO3_qad150($tgltest, $normalitas)
    {
        $result = $this->db1->query("select round(avg(cast(dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005dtl as dtl join tblfrmfrmqad005hdr as hdr on hdr.headerid = dtl.headerid where hdr.id_larutan = 'KIO3' and hdr.konsentrasi = '$normalitas' and dtl.tgl_start <= '$tgltest' and dtl.tgl_finish >= '$tgltest' and trim(dtl.hasil_m) <> '' and dtl.status_param = 'Active'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_NaOH_qad150($tgltest, $normalitas)
    {
        $result = $this->db1->query("select round(avg(cast(dtl.hasil_m as decimal(6,4))),4) as hasil_m from tblfrmfrmqad005dtl as dtl join tblfrmfrmqad005hdr as hdr on hdr.headerid = dtl.headerid where hdr.id_larutan = 'NaOH' and hdr.konsentrasi = '$normalitas' and dtl.tgl_start <= '$tgltest' and dtl.tgl_finish >= '$tgltest' and trim(dtl.hasil_m) <> '' and dtl.status_param = 'Active'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getDivKdSampel($jenis_contoh, $jenis_produk)
    {
        //$result = $this->db1->query("select * from view_kdsampelmikro where nm_jeniscontoh = '$jenis_contoh' and nm_jenisproduk = '$jenis_produk' ");
        $result = $this->db1->query("select tblmst_jeniscontoh.nm_jeniscontoh, tblmst_jenisproduk.nm_jenisproduk, tblmstkode_samplemikro.id_jeniscontoh,
                                    tblmstkode_samplemikro.id_jenisproduk, tblmstkode_samplemikro.id_samplemikro, tblmstkode_samplemikro.nm_kd_samplemikro,
                                    tblmstkode_samplemikro.nm_ket_samplemikro, tblmstkode_samplemikro.nm_lab, tblmstkode_samplemikro.formkode
                                    FROM
                                    ((tblmstkode_samplemikro JOIN tblmst_jeniscontoh ON ((tblmstkode_samplemikro.id_jeniscontoh =
                                        tblmst_jeniscontoh.id_jeniscontoh))) JOIN tblmst_jenisproduk ON ((tblmstkode_samplemikro.id_jenisproduk =
                                        tblmst_jenisproduk.id_jenisproduk)))
                                    WHERE tblmst_jeniscontoh.nm_jeniscontoh = '$jenis_contoh' AND
                                    tblmst_jenisproduk.nm_jenisproduk = '$jenis_produk'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getoptformula002($tipe_contoh, $jns_produk)
    {
        $result = $this->db1->query("select distinct(nama_formula) from tblmstformula where kategori_formula='$jns_produk'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_picno($dttgl_analisa, $dtno)
    {
        $result = $this->db1->query("select picno_kosong, picno_hasil from tblfrmfrmqad004dtl WHERE dttanggal='$dttgl_analisa' AND dtno='$dtno'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getdata_picno_only($dttgl_analisa, $dtno)
    {
        $result = $this->db1->query("select picno_kosong, picno_hasil from tblfrmfrmqad004dtl WHERE dttanggal='$dttgl_analisa' AND dtno='$dtno'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getkodeform_fss115($ndtbagian, $dttipe_contoh)
    {
        $result = $this->db1->query("select DISTINCT (formkd), formnm, formjudul FROM vwmst_form WHERE formjnsnm='$ndtbagian' and formkategorinm like '%$dttipe_contoh%' and formstatus='1' ORDER BY formkd ASC");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getlistformula_fss115($dtformula)
    {
        $result = $this->db1->query("select DISTINCT(nama_formula) from tblmstformula where nama_formula IS NOT NULL AND kategori_formula='$dtformula' order by nama_formula asc");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function get_jenis_produk($tipe_contoh)
    {
        $query = $this->db1->query("select DISTINCT (b.kode_jenis_produk2) as jenis_produk2, b.kode_jenis_produk as jenis_produk FROM tblmst_jenis_produk as b join tblmst_tipe_contoh as a on a.id_tipe_contoh = b.id_tipe_contoh  WHERE a.tipe_contoh='$tipe_contoh' ORDER BY b.kode_jenis_produk2 ASC");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_jenis_produk2($tipe_contoh)
    {
        $query = $this->db1->query("select DISTINCT (b.kode_jenis_produk2) as jenis_produk2, b.kode_jenis_produk as jenis_produk, b.id_jenis_produk  FROM tblmst_jenis_produk as b join tblmst_tipe_contoh as a on a.id_tipe_contoh = b.id_tipe_contoh WHERE a.tipe_contoh='$tipe_contoh' ORDER BY b.kode_jenis_produk2 ASC");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_jenis_proses($tipe_contoh, $jns_produk)
    {
        $query = $this->db1->query("select DISTINCT (c.kode_jenis_proses2) as jenis_proses2, c.kode_jenis_proses as jenis_proses FROM tblmst_jenis_proses as c join tblmst_jenis_produk as b on b.id_jenis_produk = c.id_jenis_produk join tblmst_tipe_contoh as a on a.id_tipe_contoh = b.id_tipe_contoh WHERE a.tipe_contoh='$tipe_contoh' and b.kode_jenis_produk='$jns_produk' ORDER BY c.kode_jenis_proses2 ASC");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_jenis_produk_all()
    {
        $query = $this->db1->query("select DISTINCT (jenis_produk2), jenis_produk FROM tblmstkode_samplekimia ORDER BY jenis_produk2 ASC");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_jenis_produk_non078($tipe_contoh)
    {
        $query = $this->db1->query("select DISTINCT (jenis_produk2), jenis_produk FROM tblmstkode_samplekimia WHERE tipe_contoh='$tipe_contoh' AND jenis_produk2 NOT IN ('CMP', 'DSC') ORDER BY jenis_produk2 ASC");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function getDivKdSampel002($tipe_contoh, $jns_produk)
    {
        $result = $this->db1->query("SELECT kode_sample FROM tblmstkode_samplekimia WHERE tipe_contoh='$tipe_contoh' AND jenis_produk ='$jns_produk' AND kode_sample<>'' AND form_penggunaan like '%FRM-LQS-001%' ORDER BY kode_sample ASC");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function getDivFormula002($tipe_contoh, $jns_produk, $jns_produk_2)
    {
        $result = $this->db1->query("SELECT * FROM tblmstformula WHERE kategori_formula='$jns_produk_2' ORDER BY nama_formula ASC");
        /* $result = $this->db1->query("select distinct(formula), deskripsi_formula from (select nama_formula as formula, deskripsi_formula, kategori_formula from tblmstformula where kategori_formula='$jns_produk_2'"
                ." union all select qaformulaid as formula, qaformuladesc as deskripsi_formula, qaformulacategory as kategori_formula from tblmstqadformula where qaformulacategory='$jns_produk_2') as data_formula ");*/
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function get_nopo($jns_produk)
    {
        $query = $this->db1->query("select 
                                            no_po 
                                        from 
                                            tblfrmintqad016hdr 
                                        where 
                                            jenis_produk = '$jns_produk' 
                                            and no_po <> ''
                                            and no_po NOT IN (select 
                                                                distinct (c.no_po)
                                                            from 
                                                                tblfrmfrmlqs001hdr as a 
                                                            join
                                                                tblfrmfrmlqs001dtl as b 
                                                                on a.headerid = b.headerid
                                                            join
                                                                tblfrmintqad016hdr as c
                                                                on b.headerid_sampel = c.headerid
                                                            where 
                                                                a.jns_proses = 'Shipment' 
                                                                and c.jenis_produk = '$jns_produk'
                                                                and c.no_po <> '')
                                        order by 
                                            no_po asc");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_productid($jns_produk)
    {
        $this->db1->distinct();
        $this->db1->select('product_id');
        $this->db1->where('abbr_kategori', $jns_produk);
        $result = $this->db1->get('tblmst_productid');
        $this->db1->order_by("product_id", "asc");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function get_dt_product_id087($filler, $kategori_produk)
    {

        switch ($kategori_produk) {
            case $kategori_produk == 'CCU' || $kategori_produk == 'CC':
                $smp = array('CC', 'CCU');
                $smp2 = "('CC','CCU')";
                break;
            case $kategori_produk == 'CLD' || $kategori_produk == 'CMB':
                $smp = array('CLD', 'CMB');
                $smp2 = "('CLD','CMB')";
                break;
            case $kategori_produk == 'CWD' || $kategori_produk == 'CWB':
                $smp = array('CWD', 'CWB');
                $smp2 = "('CWD','CWB')";
                break;
            default:
                $smp = array($kategori_produk);
                $smp2 = "('$kategori_produk')";
                break;
        }

        if ($filler == 'G' || $filler == 'K') {
            $result = $this->db1->query("select distinct(product_id) from tblmst_productid where abbr_kategori in $smp2 and product_name like '%65%' order by product_id asc");
        } else {
            $this->db1->distinct();
            $this->db1->select('product_id');
            $this->db1->where('filler', $filler);
            $this->db1->where_in('abbr_kategori', $smp);
            $this->db1->order_by('product_id', 'asc');
            $result = $this->db1->get('tblmst_productid');
        }

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function get_dt_product_id087_gk($filler, $kategori_produk)
    {

        switch ($kategori_produk) {
            case $kategori_produk == 'CCU' || $kategori_produk == 'CC':
                $smp = "('CC','CCU')";
                break;
            case $kategori_produk == 'CLD' || $kategori_produk == 'CMB':
                $smp = "('CLD','CMB')";
                break;
            case $kategori_produk == 'CWD' || $kategori_produk == 'CWB':
                $smp = "('CWD','CWB')";
                break;
            default:
                $smp = "($kategori_produk)";
                break;
        }

        /*$this->db1->distinct();
                $this->db1->select('product_id');
                $this->db1->where('filler',$filler);
                $this->db1->where_in('abbr_kategori',$smp);
                $Linkearray = array('product_id' => '65');
                $this->db1->like($Linkearray);
                $this->db1->order_by('product_id','asc');
                $result = $this->db1->get('tblmst_productid');*/
        $result = $this->db1->query("select distinct(product_id) from tblmst_productid where abbr_kategori in $smp and product_name like '%65%' order by product_id asc");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function get_dt_product_id037($tipe_contoh, $kategori_produk, $nm_produk)
    {

        if (trim($tipe_contoh) != '') {
            $con1 = "and jns_produk='$tipe_contoh'";
        } else {
            $con1 = "";
        }
        if (trim($kategori_produk) != '') {
            $con2 = "and nm_jns_produk='$kategori_produk'";
        } else {
            $con2 = "";
        }
        if (trim($nm_produk) != '') {
            $con3 = "and nm_produk='$nm_produk'";
        } else {
            $con3 = "";
        }

        $result = $this->db1->query("select distinct(product_id) from tblfrmfrmlqs082hdr as a join tblfrmfrmlqs082dtl as b
on a.headerid=b.headerid where (b.product_id is not null or trim(b.product_id)<>'')  $con1 $con2 $con3 group by product_id  order by product_id asc");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function get_dt_product_id091($kategori_produk)
    {
        $this->db1->distinct();
        $this->db1->select('product_id');
        $this->db1->where('abbr_kategori', $kategori_produk);
        $this->db1->order_by('product_id', 'asc');
        $result = $this->db1->get('tblmst_productid');
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    function get_dt_formula($kategori_produk)
    {

        switch ($kategori_produk) {
            case $kategori_produk == 'CWB' || $kategori_produk == 'CWD':
                $con_kat = "kategori_formula IN ('CWB','CWD')";
                break;
            case $kategori_produk == 'CC' || $kategori_produk == 'CCU':
                $con_kat = "kategori_formula IN ('CC','CCU')";
                break;
            case $kategori_produk == 'CLD' || $kategori_produk == 'CMB':
                $con_kat = "kategori_formula IN ('CLD','CMB')";
                break;
            default:
                $con_kat = "kategori_formula IN ('$kategori_produk')";
                break;
        }

        //            $query = $this->db1->query("select DISTINCT(formula) from tblmstproduct where $con_kat order by formula asc");
        $query = $this->db1->query("select distinct(formula), deskripsi_formula from (select nama_formula as formula, deskripsi_formula, kategori_formula from tblmstformula "
            . " union all select qaformulaid as formula, qaformuladesc as deskripsi_formula, qaformulacategory as kategori_formula from tblmstqadformula) as data_formula "
            . " where $con_kat");
        return $query->result_array();
    }

    function get_dt_formula_forspect($jns_produk)
    {

        switch ($jns_produk) {
            case $jns_produk == 'CWB' || $jns_produk == 'CWD':
                $con_kat = "kategori_formula IN ('CWB','CWD')";
                break;
            case $jns_produk == 'CC' || $jns_produk == 'CCU':
                $con_kat = "kategori_formula IN ('CC','CCU')";
                break;
            case $jns_produk == 'CLD' || $jns_produk == 'CMB':
                $con_kat = "kategori_formula IN ('CLD','CMB')";
                break;
            default:
                $con_kat = "kategori_formula IN ('$jns_produk')";
                break;
        }

        //            $query = $this->db1->query("select DISTINCT(formula) from tblmstproduct where $con_kat order by formula asc");
        $query = $this->db1->query("select distinct(formula), deskripsi_formula from (select nama_formula as formula, deskripsi_formula, kategori_formula from tblmstformula "
            . " union all select qaformulaid as formula, qaformuladesc as deskripsi_formula, qaformulacategory as kategori_formula from tblmstqadformula) as data_formula "
            . " where $con_kat");
        return $query->result_array();
    }

    function get_nmproduk_byformula($kategori_produk, $formula)
    {
        //            $query = $this->db1->query("select deskripsi_formula from tblmstformula where kategori_formula='$kategori_produk' AND nama_formula='$formula' order by deskripsi_formula asc");
        //            echo $this->db1->last_query();
        $query = $this->db1->query("select * from (select nama_formula, deskripsi_formula, kategori_formula from tblmstformula "
            . " union all select qaformulaid as nama_formula, qaformuladesc as deskripsi_formula, qaformulacategory as kategori_formula from tblmstqadformula) as data_formula "
            . " where nama_formula='$formula' and kategori_formula='$kategori_produk'");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_nmproduk_byformula_fss090($kategori_produk)
    {
        //            $query = $this->db1->query("select deskripsi_formula from tblmstformula where kategori_formula='$kategori_produk' AND nama_formula='$formula' order by deskripsi_formula asc");
        //            echo $this->db1->last_query();
        $query = $this->db1->query("select * from (select nama_formula, deskripsi_formula, kategori_formula from tblmstformula "
            . " union all select qaformulaid as nama_formula, qaformuladesc as deskripsi_formula, qaformulacategory as kategori_formula from tblmstqadformula) as data_formula "
            . " where kategori_formula='$kategori_produk'");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_produkid($ndt_jns_produk)
    {
        if ($ndt_jns_produk == 'CWC' || $ndt_jns_produk == 'CWC UHT') {
            return json_decode($this->curl->simple_get(setAPI() . 'Product/getPN2'));
        } else { //$ndt_jns_produk=='UHT-CC'
            return json_decode($this->curl->simple_get(setAPI() . 'Product/getPN'));
        }
    }

    function get_nmproduk($jns_produk2)
    {
        //            $query = $this->db1->query("select deskripsi_formula from tblmstformula where kategori_formula='$jns_produk2' order by deskripsi_formula asc");
        //            echo $this->db1->last_query();
        //            $query = $this->db1->query("select * from (select nama_formula, deskripsi_formula, kategori_formula from tblmstformula "
        //                ." union all select qaformulaid as nama_formula, qaformuladesc as deskripsi_formula, qaformulacategory as kategori_formula from tblmstqadformula) as data_formula "
        //                ." where kategori_formula='$jns_produk2'");
        $query = $this->db1->query("select DISTINCT(nama_formula),deskripsi_formula,kategori_formula from (select nama_formula, deskripsi_formula, kategori_formula from tblmstformula "
            . " union all select qaformulaid as nama_formula, qaformuladesc as deskripsi_formula, qaformulacategory as kategori_formula from tblmstqadformula) as data_formula "
            . " where  kategori_formula='$jns_produk2' group by nama_formula, deskripsi_formula,  kategori_formula");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_nmprodukByJP($jp)
    {
        $query = $this->db1->query("select deskripsi_formula from tblmstformula where kategori_formula='$jp' order by deskripsi_formula asc");
        echo $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function getdata_phacf($tgl_analisa, $dt_jam_awal, $dt_jam_akhir)
    {
        $result = $this->db1->query("select b.ph as ph_acf from tblfrmintqad078dtl as b join tblfrmintqad078hdr as a on a.headerid=b.headerid "
            . " where a.tgl_dok='$tgl_analisa' and substring(regexp_replace(b.jam_sampling, '\s+$',''),0,3)='$dt_jam_awal' "
            . " and substring(regexp_replace(b.jam_sampling, '\s+$',''),4,2)='$dt_jam_akhir' and kode_sample='ACF'");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }
    function get_data_lqs077($tgl_produksi, $filler, $kode_pack, $jam_sampling, $suhu, $tipe_contoh, $jns_produk, $sample_type)
    {

        //if($kode_pack!=''){$con_kode_pack="and kode_pack='$kode_pack'";}else{$con_kode_pack="";}

        if ($filler == 'X' || $filler == 'Y' || $filler == 'Z' || $filler == '18' || $filler == '19' || $filler == '20' || $filler == '21') {
            $con_sample = "AND trim(split_part(b.kode_sample, '-','1'))='$sample_type'";
        } else {
            $con_sample = "AND b.kode_sample='$sample_type'";
        }

        $query = $this->db1->query("select distinct(b.product_id), c.product_name, b.kode_sample, b.tgl_expired, b.ph from tblfrmfrmlqs083hdr as a join tblfrmfrmlqs083dtl as b "
            . " on a.headerid = b.headerid join tblmst_productid as c on b.product_id=c.product_id where a.tgl_produksi='$tgl_produksi' and a.filler='$filler' and b.kode_pack='$kode_pack' and a.suhu='$suhu' and b.jam_sampling='$jam_sampling' "
            . " and a.jenis_produk='$tipe_contoh' and a.nm_jns_produk='$jns_produk' and b.dtl_filler='$filler' $con_sample");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_data_lqs077_audit($tgl_produksi, $filler, $kode_pack, $jam_sampling, $suhu, $tipe_contoh, $jns_produk, $sample_type)
    {

        //if($kode_pack!=''){$con_kode_pack="and kode_pack='$kode_pack'";}else{$con_kode_pack="";}

        if ($filler == 'X' || $filler == 'Y' || $filler == 'Z' || $filler == '18' || $filler == '19' || $filler == '20' || $filler == '21') {
            $con_sample = "AND trim(split_part(b.kode_sample, '-','1'))='$sample_type'";
        } else {
            $con_sample = "AND b.kode_sample='$sample_type'";
        }

        $query = $this->db1->query("select distinct(b.product_id), c.product_name, b.kode_sample, b.tgl_expired, b.ph from tblfrmfrmlqs083hdr as a join tblfrmfrmlqs083dtlx as b "
            . " on a.headerid = b.headerid join tblmst_productid as c on b.product_id=c.product_id where a.tgl_produksi='$tgl_produksi' and a.filler='$filler' and b.kode_pack='$kode_pack' and a.suhu='$suhu' and b.jam_sampling='$jam_sampling' "
            . " and a.jenis_produk='$tipe_contoh' and a.nm_jns_produk='$jns_produk' and b.dtl_filler='$filler' $con_sample");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_data_lqs077_2($tgl_produksi, $filler, $jam_sampling, $suhu, $tipe_contoh, $jns_produk, $varian, $sample_type)
    {

        //if($kode_pack!=''){$con_kode_pack="and kode_pack='$kode_pack'";}else{$con_kode_pack="";}

        /*$query = $this->db1->query("select distinct(b.product_id), c.product_name, b.kode_sample, b.tgl_expired, b.ph from tblfrmfrmlqs083hdr as a join tblfrmfrmlqs083dtl as b  on a.headerid = b.headerid join tblmst_productid as c on b.product_id=c.product_id where a.tgl_produksi='$tgl_produksi' and a.filler='W'  and a.suhu='35' and b.jam_sampling='11:45'  and a.jenis_produk='Produk Akhir' and a.nm_jns_produk='CWB' and b.dtl_filler='W' and a.varian_produk='Hydro Coco Original' and b.kode_sample='".$sample_type."'");*/

        $query = $this->db1->query("select distinct(b.product_id), c.product_name, b.kode_sample, b.tgl_expired, b.ph from tblfrmfrmlqs083hdr as a join tblfrmfrmlqs083dtl as b "
            . " on a.headerid = b.headerid join tblmst_productid as c on b.product_id=c.product_id where a.tgl_produksi='$tgl_produksi' and a.filler='$filler' and a.varian_produk='$varian' and a.suhu='$suhu' and b.jam_sampling='$jam_sampling' "
            . " and a.jenis_produk='$tipe_contoh' and a.nm_jns_produk='$jns_produk' and b.dtl_filler='$filler' and b.kode_sample='$sample_type'");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_data_lqs077_2_audit($tgl_produksi, $filler, $jam_sampling, $suhu, $tipe_contoh, $jns_produk, $varian, $sample_type)
    {

        //if($kode_pack!=''){$con_kode_pack="and kode_pack='$kode_pack'";}else{$con_kode_pack="";}

        /*$query = $this->db1->query("select distinct(b.product_id), c.product_name, b.kode_sample, b.tgl_expired, b.ph from tblfrmfrmlqs083hdr as a join tblfrmfrmlqs083dtl as b  on a.headerid = b.headerid join tblmst_productid as c on b.product_id=c.product_id where a.tgl_produksi='$tgl_produksi' and a.filler='W'  and a.suhu='35' and b.jam_sampling='11:45'  and a.jenis_produk='Produk Akhir' and a.nm_jns_produk='CWB' and b.dtl_filler='W' and a.varian_produk='$varian' and b.kode_sample='".$sample_type."'");*/

        $query = $this->db1->query("select distinct(b.product_id), c.product_name, b.kode_sample, b.tgl_expired, b.ph from tblfrmfrmlqs083hdr as a join tblfrmfrmlqs083dtlx as b "
            . " on a.headerid = b.headerid join tblmst_productid as c on b.product_id=c.product_id where a.tgl_produksi='$tgl_produksi' and a.filler='$filler' and a.suhu='$suhu' and b.jam_sampling='$jam_sampling' "
            . " and a.jenis_produk='$tipe_contoh' and a.nm_jns_produk='$jns_produk' and b.dtl_filler='$filler' and b.kode_sample='$sample_type'");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_data_alat($param)
    {
        $query = $this->db1->query("select distinct nama_alat from tblfrmfrmlqs072dtl where nama_alat like '%" . $param . "%' order by nama_alat asc");
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_data_kodealat($param, $kode)
    {
        $query = $this->db1->query("select distinct no_inventaris from tblfrmfrmlqs072dtl where nama_alat = '" . $param . "' AND no_inventaris like '" . $kode . "%' order by no_inventaris asc");
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_data_lokasialat($param, $lokasi)
    {
        $query = $this->db1->query("select distinct tempat_penyimpanan from tblfrmfrmlqs072dtl where nama_alat = '" . $param . "' AND tempat_penyimpanan like '" . $lokasi . "%' order by tempat_penyimpanan asc");
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_data_penanggung_jawabalat($param, $penanggung_jawab)
    {
        $query = $this->db1->query("select distinct penanggung_jawab from tblfrmfrmlqs072dtl where nama_alat = '" . $param . "' AND penanggung_jawab like '" . $penanggung_jawab . "%' order by penanggung_jawab asc");
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_data_kodealat1($kode)
    {
        $query = $this->db1->query("select distinct no_inventaris from tblfrmfrmlqs072dtl where no_inventaris like '" . $kode . "%' order by no_inventaris asc");
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function getFormula($kode)
    {
        $query = $this->db1->query("select formula_id, nama_formula from tblmstformula where kategori_formula='CMP' order by formula_id asc");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function getdata_nama_alat($nama_alat)
    {
        $query = $this->db1->query("select no_inventaris from tblfrmfrmlqs072dtl where nama_alat='" . $nama_alat . "'");
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_data_nama_alat($nama_alat)
    {
        $query = $this->db1->query("WITH tablekodealat AS (
                SELECT DISTINCT
                kode_alat
            FROM
                tblmst_interpolasi_koreksi_hdr
            WHERE
                PARAMETER = 'Suhu'
            ),
            tablenamaalat AS (
                SELECT DISTINCT
                dtl.nama_alat,
                dtl.no_inventaris
            FROM
                tblfrmfrmlqs072dtl AS dtl
            )
            SELECT DISTINCT tablenamaalat.no_inventaris
            FROM tablenamaalat JOIN tablekodealat ON tablekodealat.kode_alat = tablenamaalat.no_inventaris
            WHERE tablenamaalat.nama_alat = '$nama_alat'");
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_data_nama_alat_a($nama_alat)
    {
        $query = $this->db1->query("SELECT DISTINCT
                nama_alat,
                no_inventaris
            FROM
                tblfrmfrmlqs072dtl
            WHERE
                nama_alat = '$nama_alat'");
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_data_nama_form($kode_form)
    {
        $query = $this->db1->query("SELECT DISTINCT formnm, formkd, formjudul, formjnsnm FROM vwmst_form WHERE formjnsnm != 'Form RND' AND formnm='$kode_form' ORDER BY formnm ASC");
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return $query->result();
        }
    }

    function get_dt_range_pemakaian($kode_alat)
    {
        $query = $this->db1->query("select distinct(a.range_pemakaian), b.status_form from tblfrmfrmlqs072dtl as a JOIN tblfrmfrmlqs072hdr as b on a.headerid = b.headerid where no_inventaris='" . $kode_alat . "' and status_form='Updated'");
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_data_penanggung_jawab($no_inventaris)
    {
        $query = $this->db1->query("select distinct(a.penanggung_jawab), b.status_form from tblfrmfrmlqs072dtl as a JOIN tblfrmfrmlqs072hdr as b ON a.headerid = b.headerid where no_inventaris='" . $no_inventaris . "' and status_form='Updated'");
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_data_suhu_koreksi($no_inventaris)
    {
        $query = $this->db1->query("select distinct dtl_u from tblmst_frmlqs030_12 where no_inventaris='" . $no_inventaris . "' and keterangan='suhu'");
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_data_rh_koreksi($no_inventaris)
    {
        $query = $this->db1->query("select distinct dtl_u from tblmst_frmlqs030_12 where no_inventaris='" . $no_inventaris . "' and keterangan='rh'");
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_dt_nmalat($tgluji)
    {
        $query = $this->db1->query("select distinct(nama_alat) from tblfrmfrmlqs072dtl JOIN tblfrmfrmlqs072hdr ON tblfrmfrmlqs072dtl.headerid = tblfrmfrmlqs072hdr.headerid where tgl_uji='" . $tgluji . "'");

        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_data_faktor_koreksi_suhu($suhu1, $nama_alat, $no_inventaris, $tgl_kontrol)
    {
        $query = $this->db1->query("WITH tablekodealat AS (
                SELECT
                    hdr.kode_alat,
                    hdr.tgl_efective,
                    dtl.*
                FROM
                    tblmst_interpolasi_koreksi_dtl AS dtl
                JOIN tblmst_interpolasi_koreksi_hdr AS hdr ON hdr.headerid = dtl.headerid
                WHERE
                    hdr.parameter = 'Suhu'
            ),
             tablenamaalat AS (
                SELECT DISTINCT
                    dtl.nama_alat,
                    dtl.no_inventaris
                FROM
                    tblfrmfrmlqs072dtl AS dtl
            ) SELECT DISTINCT
                tablekodealat.*
            FROM
                tablenamaalat
            JOIN tablekodealat ON tablekodealat.kode_alat = tablenamaalat.no_inventaris
            WHERE
                tablenamaalat.nama_alat = '$nama_alat'
            AND tablenamaalat.no_inventaris = '$no_inventaris'
            AND tablekodealat.penunjukan_alat = '$suhu1'
            AND tablekodealat.tgl_efective <= '$tgl_kontrol'
                                        ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_data_faktor_koreksi_rh($rh1, $nama_alat, $no_inventaris, $tgl_kontrol)
    {
        $query = $this->db1->query("WITH tablekodealat AS (
                SELECT
                    hdr.kode_alat,
                    hdr.tgl_efective,
                    dtl.*
                FROM
                    tblmst_interpolasi_koreksi_dtl AS dtl
                JOIN tblmst_interpolasi_koreksi_hdr AS hdr ON hdr.headerid = dtl.headerid
                WHERE
                    hdr.parameter = 'Kelembaban Relatif'
            ),
             tablenamaalat AS (
                SELECT DISTINCT
                    dtl.nama_alat,
                    dtl.no_inventaris
                FROM
                    tblfrmfrmlqs072dtl AS dtl
            ) SELECT DISTINCT
                tablekodealat.*
            FROM
                tablenamaalat
            JOIN tablekodealat ON tablekodealat.kode_alat = tablenamaalat.no_inventaris
            WHERE
                tablenamaalat.nama_alat = '$nama_alat'
            AND tablenamaalat.no_inventaris = '$no_inventaris'
            AND tablekodealat.penunjukan_alat = '$rh1'
            AND tablekodealat.tgl_efective <= '$tgl_kontrol'
                                        ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_data_lokasi($no_inventaris)
    {
        $query = $this->db1->query("select distinct(a.tempat_penyimpanan), b.status_form from tblfrmfrmlqs072dtl as a JOIN tblfrmfrmlqs072hdr as b on a.headerid =b.headerid where no_inventaris='" . $no_inventaris . "' and status_form='Updated'");
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_dtbatas_ph($nama_media)
    {
        $query = $this->db1->query("select distinct batas_ph from tblmstspecphmedia where nama_media='" . $nama_media . "'");
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_jadwal093($no_inventaris)
    {
        $query = $this->db1->query("select a.jdwl_prw_mingguan,a.jdwl_prw_bulanan,b.status_form from tblfrmfrmlqs072dtl as a JOIN tblfrmfrmlqs072hdr as b on a.headerid = b.headerid where no_inventaris='" . $no_inventaris . "' and status_form='Updated'");
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    function get_kode_sampel($dept)
    {
        $query = $this->db1->query("select * from tblmst_metaltrapping where dept='" . $dept . "'");
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    /*function getdata_non005($tgl_terima,$jns_inspeksi,$kode_pm){
                $this->db1->select('detail_id, dt_panjang, dt_lebar, dt_tinggi, dt_volume');
                $this->db1->from('tblfrmfrmnon055hdr');
                $this->db1->join('tblfrmfrmnon055dtl', 'tblfrmfrmnon055hdr.headerid = tblfrmfrmnon055dtl.headerid');
                $this->db1->where('tblfrmfrmnon055hdr.tgl_terima',$tgl_terima);
                $this->db1->where('tblfrmfrmnon055hdr.jns_inspeksi',$jns_inspeksi);
                $this->db1->where('tblfrmfrmnon055hdr.kode_pm',$kode_pm);
                $this->db1->order_by("tblfrmfrmnon055dtl.detail_id", "asc");
                $query = $this->db1->get();
                // echo $this->db1->last_query();
                if ($query->num_rows() > 0){
                return $query->result_array();
                }
        }*/

    function getdata_non005($tgl_terima, $jns_inspeksi, $kode_pm, $tgl_produksi, $delivery_for)
    {
        $query = $this->db1->query("select b.* from tblfrmfrmnon055hdr as a join tblfrmfrmnon055dtl as b on a.headerid=b.headerid where a.tgl_terima='" . $tgl_terima . "' and a.jns_inspeksi='" . $jns_inspeksi . "' and a.kode_pm='" . $kode_pm . "' and a.tgl_produksi='" . $tgl_produksi . "' and a.delivery_for='" . $delivery_for . "' order by b.detail_id asc");
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_data_kode_pm($param, $kode)
    {
        $query = $this->db1->query("select distinct kode_pm from tblmstincomingmaterials where  kode_pm like '" . $kode . "%' order by kode_pm asc");
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_dt_product_id_fss090($kategori_produk)
    {
        switch ($kategori_produk) {
            case $kategori_produk == 'CCU' || $kategori_produk == 'CC':
                $smp = array('CC', 'CCU');
                break;
            case $kategori_produk == 'CLD' || $kategori_produk == 'CMB':
                $smp = array('CLD', 'CMB');
                break;
            case $kategori_produk == 'CWD' || $kategori_produk == 'CWB':
                $smp = array('CWD', 'CWB');
                break;
            default:
                $smp = array($kategori_produk);
                break;
        }

        $this->db1->distinct();
        $this->db1->select('product_id');
        $this->db1->where_in('abbr_kategori', $smp);
        $this->db1->order_by('product_id', 'asc');
        $query = $this->db1->get('tblmst_productid');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getdata_dimensi_non005($tgl_terima, $jns_inspeksi, $kode_pm, $tgl_produksi, $delivery_for)
    {
        $query = $this->db1->query("select b.* from tblfrmfrmnon055hdr as a join tblfrmfrmnon055dtl as b on a.headerid=b.headerid where a.tgl_terima='" . $tgl_terima . "' and a.jns_inspeksi='" . $jns_inspeksi . "' and a.kode_pm='" . $kode_pm . "' and a.tgl_produksi='" . $tgl_produksi . "' and a.delivery_for='" . $delivery_for . "' order by b.detail_id asc");
        $this->db1->last_query();
        //if($query->num_rows()>0){
        return $query->result();
        //}else{
        // return array();
        //}
    }

    function getdata_dtl_nm_produk($tipe_contoh, $jenis_produk, $deskripsi)
    {
        $query = $this->db1->query("select * from tblmstkode_samplekimia where tipe_contoh='" . $tipe_contoh . "' and jenis_produk='" . $jenis_produk . "' and kode_sample='" . $deskripsi . "' ");
        $this->db1->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
        //return $query->result();
    }

    function getParamCmp($ndtjns_sample)
    {
        $query = $this->db1->query("
                SELECT parameter FROM tblmst_parameter_ujikorelasi WHERE kategori_produk='$ndtjns_sample' group by parameter, kategori_produk ORDER BY
                CASE
                    WHEN kategori_produk='DSC' THEN
                        CASE
                           WHEN parameter::text ~* '.*Total Plate Count.*'::text THEN 1
                           WHEN parameter::text ~* '.*Enterobacteriaceae.*'::text THEN 2
                           WHEN parameter::text ~* '.*Yeast and Mould.*'::text THEN 3
                           WHEN parameter::text ~* '.*Deteksi E.Coli.*'::text THEN 4
                           WHEN parameter::text ~* '.*Deteksi Salmonella.*'::text THEN 5
                           WHEN parameter::text ~* '.*Deteksi S.Aureus.*'::text THEN 6
                           ELSE NULL::integer
                        END
                    WHEN kategori_produk='CCU' THEN
                        CASE
                           WHEN parameter::text ~* '.*Total Plate Count.*'::text THEN 1
                           WHEN parameter::text ~* '.*Commercial Sterility .*'::text THEN 2
                           WHEN parameter::text ~* '.*Spora Count.*'::text THEN 3
                           WHEN parameter::text ~* '.*Deteksi S.Aureus.*'::text THEN 4
                           WHEN parameter::text ~* '.*Yeast and Mould.*'::text THEN 5
                           WHEN parameter::text ~* '.*Total Coliform Count.*'::text THEN 6
                           WHEN parameter::text ~* '.*Deteksi E.Coli.*'::text THEN 7
                           WHEN parameter::text ~* '.*Deteksi Salmonella.*'::text THEN 8
                           WHEN parameter::text ~* '.*pH.*'::text THEN 9
                           ELSE NULL::integer
                        END
                    WHEN kategori_produk='CMP' THEN
                        CASE
                           WHEN parameter::text ~* '.*Total Plate Count.*'::text THEN 1
                           WHEN parameter::text ~* '.*Enterobacteriaceae.*'::text THEN 2
                           WHEN parameter::text ~* '.*Yeast and Mould.*'::text THEN 3
                           WHEN parameter::text ~* '.*Deteksi E.Coli.*'::text THEN 4
                           WHEN parameter::text ~* '.*Deteksi Salmonella.*'::text THEN 5
                           ELSE NULL::integer
                        END
                   ELSE NULL::integer
                END
                ");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function getSubParamCmp($dtjns_sample, $dtparameter)
    {
        $query = $this->db1->query("SELECT sub_parameter FROM tblmst_paramete r_ujikorelasi WHERE parameter='$dtparameter' and kategori_produk='$dtjns_sample' ORDER BY parameter ASC");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function getdata_result_pmk($tipe_contoh, $jns_produk, $date_received, $vessel, $shipment)
    {
        $query = $this->db1->query("select a.tgl_produksi, b.tgl_analisa, b.mc_hasil, b.fc_hasil, b.ffa_hasil, b.qty_tank, b.jns_sampel, b.detail_id_sampel as detail_id_sampel087, b.detail_id as detail_id087, b.headerid as headerid087 from tblfrmfrmlqs087hdr as a join tblfrmfrmlqs087dtl as b on a.headerid=b.headerid where a.tgl_produksi='$shipment' and jns_sampel='KM AMELIA'");
        return $query->result();
    }

    function getdata_nodoc_lqs137($create_date_month, $create_date_year)
    {
        $query = $this->db1->query("select (count(headerid)+1) as nodoc from tblfrmfrmlqs137hdr where extract(month from create_date)='$create_date_month' and extract(year from create_date)='$create_date_year'");
        return $query->result();
    }

    function getdata_nodoc_lqs136($create_date_month, $create_date_year)
    {
        $query = $this->db1->query("select (count(headerid)+1) as nodoc from tblfrmfrmlqs136hdr where extract(month from create_date)='$create_date_month' and extract(year from create_date)='$create_date_year'");
        return $query->result();
    }

    function getdata_doc_hcc004($create_date_month, $create_date_year)
    {
        $query = $this->db1->query("select (count(headerid)+1) as doc from tblfrmfrmlqs136hdr where extract(month from create_date)='$create_date_month' and extract(year from create_date)='$create_date_year'");
        return $query->result();
    }

    function cek_log_aksi($val_fungsi, $val_form_kd, $val_form_versi, $val_headerid, $val_param, $val_comp)
    {

        if (trim($val_param) != '') {
            $con_param = "log_aksi_param='$val_param'";
        } else {
            $con_param = "";
        }

        $query = $this->db1->query("select * from tbl_log_aksi where log_aksi_fungsi ='$val_fungsi' and log_aksi_form_kd='$val_form_kd' and log_aksi_form_versi='$val_form_versi' and log_aksi_form_aksi in ('dtopen','dtupdate') and log_aksi_headerid='$val_headerid' $con_param and log_aksi_comp !='$val_comp' and log_aksi_end is NULL");
        return $query;
    }

    function insert_log_aksi($detail_aksi)
    {
        $this->db1->trans_begin();
        $this->db1->insert('tbl_log_aksi', $detail_aksi);
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }

    function get_data_ster($val_timestamp, $val_at)
    {
        if ($val_at == '1') {
            $item_select = "at1_step, at1_timer, at1_TI150, at1_PS130, at1_TI140, at1_TI160, at1_TI170, at1_LT110, at1_PIC130";
            $ster_tabel  = "atfilling";
        } elseif ($val_at == '2') {
            $item_select = "at2_step, at2_timer, at2_TI150, at2_PS130, at2_TI140, at2_TI160, at2_TI170, at2_LT110, at2_PIC130";
            $ster_tabel  = "atfilling";
        } elseif ($val_at == '3') {
            $item_select = "AT3_TT110, AT3_M124, AT3_TE130, AT3_STEP, AT3_TT140, AT3_TT160, AT3_TE170, AT3_TT150";
            $ster_tabel  = "at3at4";
        } elseif ($val_at == '4') {
            $item_select = "AT4_LT110, AT4_M124, AT4_TE130, AT4_STEP, AT4_PT130, AT4_TE140, AT4_TE160, AT4_TE170, AT4_TT110, AT4_TT150, AT4_TT180";
            $ster_tabel  = "at3at4";
        } elseif ($val_at == '5') {
            $item_select = "AT5_LT110, AT5_PIC130, AT5_TT101, AT5_TT130, AT5_TT140, AT5_TT150, AT5_TT160, AT5_TT170, AT5_TT90, AT5_STEP";
            $ster_tabel  = "at5";
        } elseif ($val_at == '6') {
            $item_select = "AT6_STEP, AT6_TT140, AT6_TT150, AT6_PIC130, AT6_TT101, AT6_TT160, AT6_TT130, AT6_LT110, AT6_TT170";
            $ster_tabel  = "at5";
        } else {
        }
        $query = $this->db1->query("select $item_select  from $ster_tabel where timestemp like '%$val_timestamp%' limit 1");
        return $query->result();
    }

    function getDiv_sampel_cip_wtpprocessing($tgl_produksi)
    {
        $query = $this->db1->query("SELECT * FROM dblink('host=192.168.3.9 user=postgres password=wtp2018 dbname=wtpdb', 'select b.item1, b.item2 from tblmst_item_formexternal_hdr as a join tblmst_item_formexternal_dtl as b on a.headerid=b.headerid where a.tgl_efective in (select max(tgl_efective) from tblmst_item_formexternal_hdr where form_kode=''frmfss195'' and  tgl_efective <='" . "'" . $tgl_produksi . "'" . "') and a.form_kode=''frmfss195'' order by b.detail_id asc') AS tn1(kode_sample text, item2 text)");
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function getList_jamSampling($tipe_contoh, $jns_produk, $tanggal_antar, $tanggal_produksi, $filler, $varian_produk)
    {
        if ($varian_produk != '') {
            $con_varian = "AND hdr.nm_produk = '$varian_produk'";
        } else {
            $con_varian = "";
        }

        $pencarian = $this->db1->query("SELECT
                dtl.detail_id_sampel,
                dtl.jam_sampling
            FROM
                tblfrmfrmlqs002dtl AS dtl
            JOIN tblfrmfrmlqs002hdr AS hdr ON hdr.headerid = dtl.headerid
            WHERE
                hdr.tipe_contoh = '$tipe_contoh'
            AND hdr.jns_produk = '$jns_produk'
            AND hdr.lab_penguji = 'Laboratorium Mikro (MIC)'
            AND hdr.tgl_antar = '$tanggal_antar'
            AND hdr.tgl_produksi = '$tanggal_produksi'
            AND hdr.filler = '$filler'
            $con_varian
            ORDER BY
                dtl.detail_id_sampel ASC");
        if ($pencarian->num_rows() > 0) {
            return $pencarian->result_array();
        } else {
            return array();
        }
    }

    function getList_jamSamplingx($tipe_contoh, $jns_produk, $tanggal_antar, $tanggal_produksi, $filler, $varian_produk)
    {
        if ($varian_produk != '') {
            $con_varian = "AND hdr.nm_produk = '$varian_produk'";
        } else {
            $con_varian = "";
        }

        $pencarian = $this->db1->query("SELECT
                dtl.detail_id_sampel,
                dtl.jam_sampling
            FROM
                tblfrmfrmlqs002dtlx AS dtl
            JOIN tblfrmfrmlqs002hdr AS hdr ON hdr.headerid = dtl.headerid
            WHERE
                hdr.tipe_contoh = '$tipe_contoh'
            AND hdr.jns_produk = '$jns_produk'
            AND hdr.lab_penguji = 'Laboratorium Mikro (MIC)'
            AND hdr.tgl_antar = '$tanggal_antar'
            AND hdr.tgl_produksi = '$tanggal_produksi'
            AND hdr.filler = '$filler'
            $con_varian
            ORDER BY
                dtl.detail_id_sampel ASC");
        if ($pencarian->num_rows() > 0) {
            return $pencarian->result_array();
        } else {
            return array();
        }
    }

    function getData_jamSampling($tipe_contoh, $jns_produk, $tanggal_antar, $tanggal_produksi, $filler, $sampling_time, $incubation_sample, $varian_produk)
    {
        if ($tipe_contoh == 'Finished Product') {
            $vtipe_contoh = "Produk Akhir";
        }

        if ($varian_produk != '') {
            $con_varian002 = "AND hdr.nm_produk = '$varian_produk'";
            $con_varian083 = "AND hdr.varian_produk = '$varian_produk'";
            $con_varian030 = "AND hdr.varian_produk = '$varian_produk'";
        } else {
            $con_varian002 = "";
            $con_varian083 = "";
            $con_varian030 = "";
        }

        $pencarian = $this->db1->query("WITH tablelqs002 AS (
                SELECT
                    dtl.detail_id AS detail_id002,
                    dtl.detail_id_sampel AS detail_id_sampel002,
                    dtl.jam_sampling AS jam_sampling002,
                    dtl.deskripsi AS deskripsi002,
                    dtl.product_id AS product_id002,
                    dtl.expiry_date AS expiry_date002,
                    hdr.incubation_day,
                    hdr.headerid AS headerid002,
                    dtl.headerid_sampel AS headerid_sampel002
                FROM
                    tblfrmfrmlqs002dtl AS dtl
                JOIN tblfrmfrmlqs002hdr AS hdr ON hdr.headerid = dtl.headerid
                WHERE
                    hdr.tipe_contoh = '$tipe_contoh'
                AND hdr.jns_produk = '$jns_produk'
                AND hdr.lab_penguji = 'Laboratorium Mikro (MIC)'
                AND hdr.tgl_antar = '$tanggal_antar'
                AND hdr.tgl_produksi = '$tanggal_produksi'
                AND hdr.filler = '$filler'
                $con_varian002
                AND dtl.jam_sampling = '$sampling_time'
            ),
            tablelqs083 AS (
                SELECT
                    hdr.headerid AS headerid083,
                    hdr.jenis_produk AS jenis_produk083,
                    hdr.nm_jns_produk AS nm_jns_produk083,
                    hdr.filler AS filler083,
                    hdr.suhu AS suhu083,
                    hdr.inkubasi AS inkubasi083,
                    dtl.*
                FROM
                    tblfrmfrmlqs083dtl AS dtl
                JOIN tblfrmfrmlqs083hdr AS hdr ON hdr.headerid = dtl.headerid
                WHERE
                    hdr.tgl_produksi = '$tanggal_produksi'
                AND hdr.jenis_produk = '$vtipe_contoh'
                AND hdr.nm_jns_produk = '$jns_produk'
                AND hdr.filler = '$filler'
                $con_varian083
                AND hdr.suhu = '$incubation_sample'
                AND dtl.jam_sampling = '$sampling_time'
                ORDER BY
                    dtl.detail_id ASC
            ),
            tablenon030 AS (
                SELECT
                    hdr.headerid AS headerid030,
                    hdr.jenis_contoh AS jenis_contoh030,
                    hdr.jenis_produk AS jenis_produk030,
                    hdr.tgl_produksi AS tgl_produksi030,
                    hdr.filler AS filler030,
                    hdr.suhu AS suhu030,
                    dtl.detail_id AS detail_id030,
                    dtl.detail_id_sampel AS detail_id_sampel030,
                    dtl.tgl_analisa AS tgl_analisa030,
                    dtl.jam_analisa AS jam_analisa030,
                    dtl.analisa_oleh AS analisa_oleh030,
                    dtl.jam_sampling AS jam_sampling030,
                    dtl.kode_sample AS kode_sample030,
                    dtl.operator33 AS op_tpc_hasil,
                    dtl.ham_tpc_hasil AS tpc_hasil,
                    dtl.ham_tpc_paraf AS tpc_paraf,
                    dtl.operator5 AS op_tsc_35,
                    dtl.ham_tsc_35_celcius AS tsc_35_hasil,
                    dtl.operator6 AS op_ttr_35,
                    dtl.ham_tsc_paraf,
                    dtl.ham_ttr_35_celcius AS ttr_35_hasil,
                    dtl.operator7 AS op_ttr_55,
                    dtl.ham_ttr_55_celcius AS ttr_55_hasil,
                    dtl.ham_ttr_paraf
                FROM
                    tblfrmfrmnon030dtl AS dtl
                JOIN tblfrmfrmnon030hdr AS hdr ON hdr.headerid = dtl.headerid
                WHERE
                    hdr.jenis_contoh = '$tipe_contoh'
                AND hdr.jenis_produk = '$jns_produk'
                AND hdr.tgl_produksi = '$tanggal_produksi'
                AND hdr.filler = '$filler'
                $con_varian030
                AND dtl.jam_sampling = '$sampling_time'
                AND hdr.suhu = '$incubation_sample'
            )
            SELECT
                tablelqs002.*,
                tablelqs083.*,
                tablenon030.*
            FROM
                tablelqs002 LEFT JOIN tablelqs083 ON tablelqs002.detail_id002 = tablelqs083.detail_id_sampel
            LEFT JOIN tablenon030 ON tablelqs002.detail_id002 = tablenon030.detail_id_sampel030");
        if ($pencarian->num_rows() > 0) {
            return $pencarian->result_array();
        } else {
            return array();
        }
    }

    function getData_jamSamplingx($tipe_contoh, $jns_produk, $tanggal_antar, $tanggal_produksi, $filler, $sampling_time, $incubation_sample, $varian_produk)
    {
        $pencarian = $this->db1->query("WITH tablelqs002 AS (
                SELECT
                    dtl.detail_id AS detail_id002,
                    dtl.detail_id_sampel AS detail_id_sampel002,
                    dtl.jam_sampling AS jam_sampling002,
                    dtl.deskripsi AS deskripsi002,
                    dtl.product_id AS product_id002,
                    dtl.expiry_date AS expiry_date002,
                    hdr.incubation_day,
                    hdr.headerid AS headerid002,
                    dtl.headerid_sampel AS headerid_sampel002
                FROM
                    tblfrmfrmlqs002dtlx AS dtl
                JOIN tblfrmfrmlqs002hdr AS hdr ON hdr.headerid = dtl.headerid
                WHERE
                    hdr.tipe_contoh = '$tipe_contoh'
                AND hdr.jns_produk = '$jns_produk'
                AND hdr.lab_penguji = 'Laboratorium Mikro (MIC)'
                AND hdr.tgl_antar = '$tanggal_antar'
                AND hdr.tgl_produksi = '$tanggal_produksi'
                AND hdr.filler = '$filler'
                AND dtl.jam_sampling = '$sampling_time'
            ),
            tablelqs083 AS (
                SELECT
                    hdr.headerid AS headerid083,
                    hdr.jenis_produk AS jenis_produk083,
                    hdr.nm_jns_produk AS nm_jns_produk083,
                    hdr.filler AS filler083,
                    hdr.suhu AS suhu083,
                    hdr.inkubasi AS inkubasi083,
                    dtl.*
                FROM
                    tblfrmfrmlqs083dtlx AS dtl
                JOIN tblfrmfrmlqs083hdr AS hdr ON hdr.headerid = dtl.headerid
                WHERE
                    hdr.tgl_produksi = '$tanggal_produksi'
                AND hdr.nm_jns_produk = '$jns_produk'
                AND hdr.filler = '$filler'
                AND hdr.suhu = '$incubation_sample'
                AND dtl.jam_sampling = '$sampling_time'
                ORDER BY
                    dtl.detail_id ASC
            ),
            tablenon030 AS (
                SELECT
                    hdr.headerid AS headerid030,
                    hdr.jenis_contoh AS jenis_contoh030,
                    hdr.jenis_produk AS jenis_produk030,
                    hdr.tgl_produksi AS tgl_produksi030,
                    hdr.filler AS filler030,
                    hdr.suhu AS suhu030,
                    dtl.detail_id AS detail_id030,
                    dtl.detail_id_sampel AS detail_id_sampel030,
                    dtl.tgl_analisa AS tgl_analisa030,
                    dtl.jam_analisa AS jam_analisa030,
                    dtl.analisa_oleh AS analisa_oleh030,
                    dtl.jam_sampling AS jam_sampling030,
                    dtl.kode_sample AS kode_sample030,
                    dtl.operator33 AS op_tpc_hasil,
                    dtl.ham_tpc_hasil AS tpc_hasil,
                    dtl.ham_tpc_paraf AS tpc_paraf,
                    dtl.operator5 AS op_tsc_35,
                    dtl.ham_tsc_35_celcius AS tsc_35_hasil,
                    dtl.operator6 AS op_ttr_35,
                    dtl.ham_tsc_paraf,
                    dtl.ham_ttr_35_celcius AS ttr_35_hasil,
                    dtl.operator7 AS op_ttr_55,
                    dtl.ham_ttr_55_celcius AS ttr_55_hasil,
                    dtl.ham_ttr_paraf
                FROM
                    tblfrmfrmnon030dtlx AS dtl
                JOIN tblfrmfrmnon030hdr AS hdr ON hdr.headerid = dtl.headerid
                WHERE
                    hdr.jenis_contoh = '$tipe_contoh'
                AND hdr.jenis_produk = '$jns_produk'
                AND hdr.tgl_produksi = '$tanggal_produksi'
                AND hdr.filler = '$filler'
                AND dtl.jam_sampling = '$sampling_time'
                AND hdr.suhu = '$incubation_sample'
            )
            SELECT
                tablelqs002.*,
                tablelqs083.*,
                tablenon030.*
            FROM
                tablelqs002 LEFT JOIN tablelqs083 ON tablelqs002.detail_id002 = tablelqs083.detail_id_sampel
            LEFT JOIN tablenon030 ON tablelqs002.detail_id002 = tablenon030.detail_id_sampel030");
        if ($pencarian->num_rows() > 0) {
            return $pencarian->result_array();
        } else {
            return array();
        }
    }

    function getData_filler($jenis_produk)
    {
        if (($jenis_produk == 'Coconut Cream') || ($jenis_produk == 'Coconut Cream for MAR')) {
            $con_abbr_kategori = "IN ('CC','CCU')";
        } else {
            $con_abbr_kategori = "= '$jenis_produk'";
        }
        $hasil = $this->db1->query("select distinct
                flr.filler_id,
                flr.filler_name
            FROM
                tblmst_productid AS prodid
            JOIN tblmstfiller AS flr ON prodid.filler = flr.filler_name
            WHERE
                prodid.abbr_kategori $con_abbr_kategori
            AND flr.efective_date IN (select max(efective_date) from tblmstfiller where efective_date <= current_date)
            AND flr.status = '1'
            ORDER BY
                flr.filler_id ASC");
        if ($hasil->num_rows() > 0) {
            return $hasil->result_array();
        } else {
            return array();
        }
    }

    function get_productid091($jenis_produk)
    {
        if ($jenis_produk == 'Coconut Milk Powder') {
            $con_abbr_kategori = "prodid.abbr_kategori = 'CMP'";
        } elseif ($jenis_produk == 'Desiccated Coconut') {
            $con_abbr_kategori = "prodid.abbr_kategori = 'DSC'";
        } else {
            $con_abbr_kategori = "prodid.abbr_kategori = '$jenis_produk'";
        }
        $hasil = $this->db1->query("select distinct
                prodid.product_id
            FROM
                tblmst_productid AS prodid
            LEFT JOIN tblmstfiller AS flr ON prodid.filler = flr.filler_name
            WHERE
                $con_abbr_kategori
            ORDER BY
                prodid.product_id ASC");
        if ($hasil->num_rows() > 0) {
            return $hasil->result_array();
        } else {
            return array();
        }
    }

    function getData_productid($jenis_produk, $filler)
    {
        if (($jenis_produk == 'Coconut Cream') || ($jenis_produk == 'Coconut Cream for MAR')) {
            $con_abbr_kategori = "IN ('CC','CCU')";
        } else {
            $con_abbr_kategori = "= '$jenis_produk'";
        }
        $hasil = $this->db1->query("select distinct
                flr.filler_id,
                flr.filler_name,
                prodid.product_id
            FROM
                tblmst_productid AS prodid
            JOIN tblmstfiller AS flr ON prodid.filler = flr.filler_name
            WHERE
                prodid.abbr_kategori $con_abbr_kategori
            AND flr.efective_date IN (select max(efective_date) from tblmstfiller where efective_date <= current_date)
            AND flr.status = '1'
            AND flr.filler_name = '$filler'
            ORDER BY
                flr.filler_id ASC");
        if ($hasil->num_rows() > 0) {
            return $hasil->result_array();
        } else {
            return array();
        }
    }

    function getData_sg_kode_alat($tglanalisa)
    {
        $hasilnya = $this->db1->query("select distinct(kode_alat_picno) as sg_kode_alat from tblfrmfrmqad004dtl where stdtl = '1' and dttanggal = '$tglanalisa' order by kode_alat_picno asc");
        if ($hasilnya->num_rows() > 0) {
            return $hasilnya->result_array();
        } else {
            return array();
        }
    }

    function getData_sg_kode_alat2($tglanalisa, $dtsg_kode_alat)
    {
        $hasilnya = $this->db1->query("select distinct(kode_alat) as sg_kode_alat2 from tblfrmfrmqad004dtl where stdtl = '1' and dttanggal = '$tglanalisa' and kode_alat_picno = '$dtsg_kode_alat' order by kode_alat asc");
        if ($hasilnya->num_rows() > 0) {
            return $hasilnya->result_array();
        } else {
            return array();
        }
    }

    function getData_sg_kode_alat2_b($tglanalisa)
    {
        $hasilnya = $this->db1->query("select distinct(kode_alat) as sg_kode_alat2 from tblfrmfrmqad004dtl where stdtl = '1' order by kode_alat asc");
        // $hasilnya = $this->db1->query("select distinct(kode_alat) as sg_kode_alat2 from tblfrmfrmqad004dtl where stdtl = '1' and dttanggal = '$tglanalisa' order by kode_alat asc");
        if ($hasilnya->num_rows() > 0) {
            return $hasilnya->result_array();
        } else {
            return array();
        }
    }

    function getData_sg_bobot_air($tglanalisa, $dtsg_kode_alat)
    {
        $hasilnya = $this->db1->query("select picno_hasil from tblfrmfrmqad004dtl where stdtl = '1' and dttanggal = '$tglanalisa' and kode_alat_picno = '$dtsg_kode_alat'");
        if ($hasilnya->num_rows() > 0) {
            return $hasilnya->result_array();
        } else {
            return array();
        }
    }

    function getData_sg_faktor_koreksi($dtsg_kode_alat2)
    {
        $hasilnya = $this->db1->query("select dtl.correction from tblmst_interpolasi_certificate_dtl as dtl join tblmst_interpolasi_certificate_hdr as hdr on hdr.headerid = dtl.headerid where hdr.kode_alat = '$dtsg_kode_alat2'");
        if ($hasilnya->num_rows() > 0) {
            return $hasilnya->result_array();
        } else {
            return array();
        }
    }

    function getData_mc_faktor_koreksi($dtmc_kode_ab)
    {
        $hasilnya = $this->db1->query("select dtl.correction from tblmst_interpolasi_certificate_dtl as dtl join tblmst_interpolasi_certificate_hdr as hdr on hdr.headerid = dtl.headerid where hdr.kode_alat = '$dtmc_kode_ab'");
        if ($hasilnya->num_rows() > 0) {
            return $hasilnya->result_array();
        } else {
            return array();
        }
    }

    function get_kategori_alat($bagian_abbr, $tahun)
    {  //kalibrasi
        return $this->db1->query("select DISTINCT(c.kode_alat), c.nama_alat from tblfrmfrmcal004hdr a join tblfrmfrmcal003dtl b on a.id_pengajuan=b.headerid join tblmst_kategori_alat c on b.id_kategori_alat=c.kategori_id where a.departement='$bagian_abbr' and EXTRACT(YEAR FROM a.create_date)='$tahun' and a.app2_status='1' and a.inactive='0' order by c.kode_alat asc")->result();
    }

    function get_kategori_alat_001($bagian_abbr, $in_ex)
    {  //kalibrasi
        return $this->db1->query("select distinct(singkatan_alat), nama_alat from tblmst_listalat where department='$bagian_abbr' and in_ex = '$in_ex' and inactive='0' and delete ='0' and status_alat !='NON KALIBRASI' and status='1'")->result();
    }

    function get_kategori_alat_002($bagian_abbr)
    {  //kalibrasi
        // return $this->db1->query("select distinct(singkatan_alat), nama_alat from tblmst_listalat_nonkal where department='$bagian_abbr' and inactive='0' and delete ='0' and status='1'")->result(); //Old
        return $this->db1->query("select distinct(a.singkatan_alat), a.nama_alat from tblmst_listalat_nonkal a join tblfrmfrmcal003hdr b on a.headerid2=b.headerid where a.department='$bagian_abbr' and a.inactive='0' and a.delete ='0' and a.status='1' and b.app1_status='1'")->result();
    }

    function getData_no_alat($bagian_abbr, $tahun, $kategori_alat)
    {  //kalibrasi
        return $this->db1->query("select a.*, c.nomor_sertifikat from tblfrmfrmcal003dtl a join tblfrmfrmcal003hdr b on a.headerid=b.headerid join view_lap_cal_005 c on a.headerid=c.id_pengajuan where a.department='$bagian_abbr' and EXTRACT(YEAR FROM c.create_date)='$tahun' and a.singkatan_alat='$kategori_alat' and b.status_kal='1' and c.app2_status='1' and c.inactive='0' order by a.no_identitas")->result();
    }

    function getData_no_alat_005($bagian_abbr, $tahun, $bulan, $kategori_alat)
    {  //kalibrasi
        return $this->db1->query("select a.*, c.nomor_sertifikat from tblfrmfrmcal003dtl a join tblfrmfrmcal003hdr b on a.headerid=b.headerid join view_lap_cal_005 c on a.headerid=c.id_pengajuan where a.department='$bagian_abbr' and EXTRACT(YEAR FROM c.create_date)='$tahun' and EXTRACT(MONTH FROM c.create_date)='$bulan' and a.singkatan_alat='$kategori_alat' and b.status_kal='1' and c.app3_status='1' and c.inactive='0' order by a.no_identitas")->result();
    }

    function getData_no_alat_006($bagian_abbr, $tahun, $kategori_alat)
    {  //kalibrasi
        return $this->db1->query("select a.* from tblfrmfrmcal006dtl a join tblfrmfrmcal006hdr b on a.headerid=b.headerid where a.department='$bagian_abbr' and EXTRACT(YEAR FROM b.create_date)='$tahun' and a.singkatan_alat='$kategori_alat' and b.app2_status='1' and b.inactive='0'")->result();
    }

    function getData_no_alat_007($bagian_abbr, $kategori_alat, $status)
    {  //kalibrasi
        if ($status == 'ALAT RUSAK') {
            return $this->db1->query("select a.* from tblfrmfrmcal006dtl a join tblfrmfrmcal006hdr b on a.headerid=b.headerid where a.department='$bagian_abbr' and a.singkatan_alat='$kategori_alat' and b.app2_status='1' and b.inactive='0'")->result();
        } else if ($status == 'PERLU PERBAIKAN') {
            return $this->db1->query("select a.* from tblfrmfrmcal006dtl a join tblfrmfrmcal006hdr b on a.headerid=b.headerid where a.department='$bagian_abbr' and a.singkatan_alat='$kategori_alat' and b.app2_status='1' and b.inactive='0' and a.keterangan='PERLU PERBAIKAN'")->result();
        } else if ($status == 'NON KALIBRASI') {
            return $this->db1->query("select * FROM tblmst_listalat_nonkal where department='$bagian_abbr' and singkatan_alat='$kategori_alat' and inactive='0' and status = '1' and delete ='0'")->result();
        } else {
            return $this->db1->query("select a.*, c.nomor_sertifikat from tblfrmfrmcal003dtl a join tblfrmfrmcal003hdr b on a.headerid=b.headerid join view_lap_cal_005 c on a.headerid=c.id_pengajuan where a.department='$bagian_abbr' and a.singkatan_alat='$kategori_alat' and b.status_kal='1' and c.app2_status='1' and c.inactive='0' order by a.no_identitas")->result();
        }
    }

    function getData_no_alat_007_date($bagian_abbr, $kategori_alat, $status, $tgl_awal, $tgl_akhir)
    {  //kalibrasi
        if ($status == 'ALAT RUSAK') {
            return $this->db1->query("select a.* from tblfrmfrmcal006dtl a join tblfrmfrmcal006hdr b on a.headerid=b.headerid where a.department='$bagian_abbr' and a.singkatan_alat='$kategori_alat' and b.app2_status='1' and b.inactive='0' and b.create_date >= '$tgl_awal' and b.create_date <= '$tgl_akhir'")->result();
        } else if ($status == 'NON KALIBRASI') {
            return $this->db1->query("select * FROM tblmst_listalat_nonkal where department='$bagian_abbr' and singkatan_alat='$kategori_alat' and inactive='0' and status = '1' and delete ='0' and create_date >= '$tgl_awal' and create_date <= '$tgl_akhir'")->result();
        } else {
            return $this->db1->query("select a.*, c.nomor_sertifikat from tblfrmfrmcal003dtl a join tblfrmfrmcal003hdr b on a.headerid=b.headerid join view_lap_cal_005 c on a.headerid=c.id_pengajuan where a.department='$bagian_abbr' and a.singkatan_alat='$kategori_alat' and c.tgl_kal >= '$tgl_awal' and c.tgl_kal <= '$tgl_akhir' and b.status_kal='1' and c.app2_status='1' and c.inactive='0' order by a.no_identitas")->result();
        }
    }

    function get_kategori_alat_cal_005($bagian_abbr, $tahun, $bulan)
    {  //kalibrasi
        return $this->db1->query("select DISTINCT(c.kode_alat), c.nama_alat from tblfrmfrmcal004hdr a join tblfrmfrmcal003dtl b on a.id_pengajuan=b.headerid join tblmst_kategori_alat c on b.id_kategori_alat=c.kategori_id where a.departement='$bagian_abbr' and EXTRACT(YEAR FROM a.create_date)='$tahun' and EXTRACT(MONTH FROM a.create_date)='$bulan' and a.app3_status='1' and a.inactive='0' order by c.kode_alat asc")->result();
    }

    function get_kategori_alat_006($bagian_abbr, $tahun)
    {  //kalibrasi
        return $this->db1->query("select DISTINCT(c.kode_alat), c.nama_alat from tblfrmfrmcal006hdr a join tblfrmfrmcal006dtl b on a.headerid=b.headerid join tblmst_kategori_alat c on b.id_kategori_alat=c.kategori_id where a.departement='$bagian_abbr' and EXTRACT(YEAR FROM a.create_date)='$tahun' and a.app2_status='1' and a.inactive='0' order by c.kode_alat asc")->result();
    }

    function get_kategori_alat_007($bagian_abbr, $status)
    {  //kalibrasi
        if ($status == 'ALAT RUSAK') {
            return $this->db1->query("select DISTINCT(c.kode_alat), c.nama_alat from tblfrmfrmcal006hdr a join tblfrmfrmcal006dtl b on a.headerid=b.headerid join tblmst_kategori_alat c on b.id_kategori_alat=c.kategori_id where a.departement='$bagian_abbr' and a.app2_status='1' and a.inactive='0' order by c.kode_alat asc")->result();
        } else if ($status == 'PERLU PERBAIKAN') {
            return $this->db1->query("select DISTINCT(c.kode_alat), c.nama_alat from tblfrmfrmcal006hdr a join tblfrmfrmcal006dtl b on a.headerid=b.headerid join tblmst_kategori_alat c on b.id_kategori_alat=c.kategori_id where a.departement='$bagian_abbr' and a.app2_status='1' and a.inactive='0' and b.keterangan ='PERLU PERBAIKAN' order by c.kode_alat asc")->result();
        } else if ($status == 'NON KALIBRASI') {
            return $this->db1->query("select DISTINCT(c.kode_alat), c.nama_alat from tblmst_listalat_nonkal a join tblmst_kategori_alat c on a.id_kategori_alat=c.kategori_id where a.department='$bagian_abbr' and a.inactive='0' and a.status = '1' and a.delete ='0' order by c.kode_alat asc")->result();
        } else {
            return $this->db1->query("select DISTINCT(c.kode_alat), c.nama_alat from tblfrmfrmcal004hdr a join tblfrmfrmcal003dtl b on a.id_pengajuan=b.headerid join tblmst_kategori_alat c on b.id_kategori_alat=c.kategori_id where a.departement='$bagian_abbr' and a.app1_status='1' and a.inactive='0' order by c.kode_alat asc")->result();
        }
    }


    ///////////////////////////////////////////// function untuk Laporan Master Coding Marking ///////////////////

    function get_buyer($jns_produk)
    {
        $hasil = $this->db1->query("SELECT buyer from tblmst_codingmarking where jenis_produk = '$jns_produk'");
        return $hasil->result();
    }

    function get_brand($jns_produk, $buyer)
    {
        $hasil = $this->db1->query("SELECT distinct brand from tblmst_codingmarking where jenis_produk = '$jns_produk' and buyer = '$buyer'");
        return $hasil->result();
    }

    function get_product($jns_produk, $buyer, $brand)
    {
        $hasil = $this->db1->query("SELECT * from tblmst_codingmarking where jenis_produk = '$jns_produk' and buyer = '$buyer' and brand='$brand'");
        return $hasil->result();
    }

    function get_consignee($jns_produk, $buyer, $brand, $product_id)
    {
        $hasil = $this->db1->query("SELECT consignee from tblmst_codingmarking where jenis_produk = '$jns_produk' and buyer = '$buyer' and brand='$brand' and product_id='$product_id'");
        return $hasil->result();
    }

    function get_consigneeNK($jns_produk, $buyer, $brand, $product_id2)
    {
        $hasil = $this->db1->query("SELECT consignee from tblmst_codingmarking where jenis_produk = '$jns_produk' and buyer = '$buyer' and brand='$brand' and product_id2='$product_id2'");
        return $hasil->result();
    }

    /////////////////////////////////////////////// END Laporan Master Coding Marking ////////////////////////////

    function get_kode_sample_frmqad039($dt_area)
    { // EDTA atau Hardness
        $query = $this->db1->query("SELECT kode_sample FROM tblmstkode_samplekimia where area_penggunaan like '%$dt_area%' and form_penggunaan like '%FRM-QAD-039%' order by kode_sample ASC");
        return $query->result();
    }

    ///////////////////// Ini Punya QAD051 //////////////////////

    function get_productCategory($jns_produk)
    {
        $hasil = $this->db1->query("SELECT * FROM public.tblmst_jenis_produk where jenis_produk = '$jns_produk'");
        return $hasil->result();
    }

    function get_productid051($getdataPID) // narik dari Krodec
    {
        return json_decode($this->curl->simple_post(setAPI() . "ProductKrodec/getProductCode", $getdataPID, array(CURLOPT_BUFFERSIZE => 10)));
    }

    /////////////////////// END FRM QAD 051 //////////////////////


    function get_list_pj($create_date, $formkd)
    {
        return $this->db1->query("select 
                                    * 
                                  from 
                                    tblmst_penanggung_jawab a
                                  join
                                    tblmst_penanggung_jawab_dtl b
                                    on a.headerid=b.headerid
                                  where 
                                    a.inactive='0' 
                                    and b.inactive='0' 
                                    and form_kode='$formkd' 
                                    and tgl_efektif in (select 
                                                      max(tgl_efektif) 
                                                    from 
                                                      tblmst_penanggung_jawab 
                                                    where 
                                                      inactive='0' 
                                                      and form_kode='$formkd'
                                                      and tgl_efektif <='$create_date') 
                                  order by 
                                    nama")->result();
    }

    function get_pj_by($detail_id)
    {
        return $this->db1->query("select 
                                    * 
                                  from 
                                    tblmst_penanggung_jawab a
                                  join
                                    tblmst_penanggung_jawab_dtl b
                                    on a.headerid=b.headerid
                                  where 
                                    b.detail_id='$detail_id'")->row();
    }
}
