<?php

class M_hak_akses extends CI_Model {

        var $tabel1 = 'tbltrn_ketidaksesuaian'; //variabel tabel

        function __construct(){
                parent::__construct();
                $CI = &get_instance();
                $this->db1 = $this->load->database('db1',TRUE);
        }

        function get_hak_akses_all(){
            $query = $this->db1->query("with t1 as( SELECT a.formid, a.formkd, a.formjnsnm, a.formkategorinm, a.formkategori2nm, a.formnm, a.formversi, a.formefective, a.formjudul FROM vwmst_form as a), 
t2 as (select * from tblmstform_akses2),
t3 as (SELECT * FROM dblink('host=192.168.3.8 user=postgres password=sa123 dbname=dbuser', 'select leveluserid, nik, nmlengkap, username, bagnm, jabnm, levelusernm, inactive from view_data_user') AS tn1(leveluserid integer, nik text, nmlengkap text, username text, bagnm text, jabnm text, levelusernm text, inactive text))
select t1.*, t2.*, t3.nik, t3.nik, t3.nmlengkap, t3.username, t3.bagnm, t3.jabnm, t3.levelusernm
from t1 full join t2 on t1.formid = t2.formid
left join t3 on t2.leveluserid=t3.leveluserid
where t3.inactive='0' order by  t3.bagnm asc, t3.jabnm asc, t3.levelusernm asc, t3.nmlengkap asc, t1.formjnsnm asc, t1.formkategorinm asc, t1.formkategori2nm asc, t1.formkd asc, t1.formid asc");
            if ($query->num_rows() >0 ){
                return $query->result();
            }
        }

        function get_hak_akses($bagian,$posisi,$level,$nik,$nama,$form_bagian,$form_kategori,$form_subkategori,$form_nama, $form_versi){

            $val_nama = strtoupper(trim(str_replace(" ","",$nama)));

            if(trim($bagian)!=''){$con_bagian="and t3.bagnm='$bagian'";}else{$con_bagian="";}
            if(trim($posisi)!=''){$con_posisi="and t3.jabnm='$posisi'";}else{$con_posisi="";}
            if(trim($level)!=''){$con_level="and t3.levelusernm='$level'";}else{$con_level="";}
            if(trim($nik)!=''){$con_nik="and t3.nik='$nik'";}else{$con_nik="";}
            if(trim($nama)!=''){$con_nama="and UPPER(TRIM(REPLACE(t3.nmlengkap, ' ', ''))) like '%$val_nama%'";}else{$con_nama="";}
            if(trim($form_bagian)!=''){$con_form_bagian="and t1.formjnsnm='$form_bagian'";}else{$con_form_bagian="";}
            if(trim($form_kategori)!=''){$con_form_kategori="and t1.formkategorinm='$form_kategori'";}else{$con_form_kategori="";}
            if(trim($form_subkategori)!=''){$con_form_subkategori="and t1.formkategori2nm='$form_subkategori'";}else{$con_form_subkategori="";}
            if(trim($form_nama)!=''){$con_form_nama="and t1.formnm='$form_nama'";}else{$con_form_nama="";}
            if(trim($form_versi)!=''){$con_form_versi="and t1.formversi = '$form_versi'";}else{$con_form_versi="";}

            $query = $this->db1->query("with t1 as( SELECT a.formid, a.formkd, a.formjnsnm, a.formkategorinm, a.formkategori2nm, a.formnm, a.formversi, a.formefective, a.formjudul FROM vwmst_form as a), 
t2 as (select * from tblmstform_akses2),
t3 as (SELECT * FROM dblink('host=192.168.3.8 user=postgres password=sa123 dbname=dbuser', 'select leveluserid, nik, nmlengkap, username, bagnm, jabnm, levelusernm, inactive from view_data_user') AS tn1(leveluserid integer, nik text, nmlengkap text, username text, bagnm text, jabnm text, levelusernm text, inactive text))
select t1.*, t2.*, t3.nik, t3.nik, t3.nmlengkap, t3.username, t3.bagnm, t3.jabnm, t3.levelusernm
from t1 full join t2 on t1.formid = t2.formid
left join t3 on t2.leveluserid=t3.leveluserid
where t3.inactive='0' $con_bagian $con_posisi $con_level $con_nik $con_nama $con_form_bagian $con_form_kategori $con_form_subkategori $con_form_nama $con_form_versi order by  t3.bagnm asc, t3.jabnm asc, t3.levelusernm asc, t3.nmlengkap asc, t1.formjnsnm asc, t1.formkategorinm asc, t1.formkategori2nm asc, t1.formkd asc, t1.formid asc");
            if ($query->num_rows() >0 ){
                return $query->result();
            }
        }


        function get_kategori($bagian){
            $query= $this->db1->query("select distinct(formkategorinm) from vwmst_form where formjnsnm='$bagian' order by formkategorinm asc");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function get_subkategori($bagian, $form_kategori){
            if($form_kategori!='-'){
                $query= $this->db1->query("select distinct(formkategori2nm) from vwmst_form where formjnsnm='$bagian' and formkategorinm='$form_kategori' order by formkategori2nm asc");
            }else{
                 $query= $this->db1->query("select distinct(formkategori2nm) from vwmst_form where formjnsnm='$bagian' and formkategorinm IS NULL order by formkategori2nm asc");   
            }
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function get_formkode($bagian, $form_kategori, $form_subkategori){
            if(($form_kategori=='-') && ($form_subkategori=='-')){
                 $query= $this->db1->query("select distinct(formkd),formnm from vwmst_form where  formjnsnm='$bagian' and formkategorinm IS NULL and formkategori2nm IS NULL group by formkd, formnm order by formnm asc");  
            }else if(($form_kategori!='-') && ($form_subkategori=='-')){
                 $query= $this->db1->query("select distinct(formkd),formnm from vwmst_form where  formjnsnm='$bagian' and formkategorinm='$form_kategori' and formkategori2nm IS NULL group by formkd, formnm order by formnm asc"); 
            }else{
                $query= $this->db1->query("select distinct(formkd),formnm from vwmst_form where  formjnsnm='$bagian' and formkategorinm='$form_kategori' and formkategori2nm='$form_subkategori' group by formkd, formnm order by formnm asc");  
            }
            
            if ($query->num_rows() >0 ){
                return $query->result();
            }
        }

        function get_formversi($form_kode){
             $query= $this->db1->query("select distinct(formversi) from vwmst_form where formkd='$form_kode' order by formversi asc");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function get_list_bagian(){
            $query= $this->db1->query("SELECT * FROM dblink('host=192.168.3.8 user=postgres password=sa123 dbname=dbuser', 'select bagid, bagnm from tblmstbagian order by bagnm asc') AS tn1(bagid integer, bagnm text)");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function get_posisi($deptid){
            $query= $this->db1->query("SELECT * FROM dblink('host=192.168.3.8 user=postgres password=sa123 dbname=dbuser', 'select jabid, jabnm from tblmstjabatan where deptid='"."'".$deptid."'"."' order by jabnm asc') AS tn1(jabid integer, jabnm text)");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }

        function get_level($deptid){
            $query= $this->db1->query("SELECT * FROM dblink('host=192.168.3.8 user=postgres password=sa123 dbname=dbuser', 'select  leveluserid, levelusernm from tblmstleveluser where bagid='"."'".$deptid."'"."' order by levelusernm asc') AS tn1(  leveluserid integer, levelusernm text)");
                if ($query->num_rows() >0 ){
                    return $query->result();
                }
        }
              
}
?>
