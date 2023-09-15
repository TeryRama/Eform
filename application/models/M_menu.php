<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class M_menu extends CI_Model
{
//  private $db1;
  function __construct()
  {
    parent::__construct();
    $CI = &get_instance();
    $this->db1 = $this->load->database('db1',TRUE);
  }

   function menus($leveluser) {
        $session = $this->load->library("session");
        
        $this->db1->select("*");
        $this->db1->from("tblmstmenu");
        $this->db1->where("menuid IN", "(SELECT DISTINCT menuid from tblmstsubmenu_akses2 where leveluserid=" .$leveluser. ")", false);
        $this->db1->order_by("menuid","asc");
        $q = $this->db1->get();

        $final = array();
        if ($q->num_rows() > 0 && empty($this->session->userdata('logged_in')['akses_sambupedia'])) {
            foreach ($q->result() as $row) {
                $this->db1->select("*");
                $this->db1->from("tblmstsubmenu");
                $this->db1->where("menuid", $row->menuid);
                $this->db1->where("submenuid IN", "(SELECT DISTINCT submenuid from tblmstsubmenu_akses2 where menuid=".$row->menuid." and leveluserid=" .$leveluser. ")", false);
                $this->db1->order_by("submenunm","asc");
                $q2 = $this->db1->get();
                if ($q2->num_rows() > 0) {
                    foreach ($q2->result() as $row2) {
                        $this->db1->select("*");
                        $this->db1->from("tblmstsubmenu2");
                        $this->db1->where("submenuid", $row2->submenuid);
                        $this->db1->where("submenu2id IN", "(SELECT DISTINCT submenu2id from tblmstsubmenu_akses2 where submenuid=".$row2->submenuid." and menuid=".$row->menuid." and leveluserid=" .$leveluser. " and submenu2id IS NOT NULL)", false);
                        $this->db1->order_by("submenu2nm","asc");
                        $q3 = $this->db1->get();
                        if ($q3->num_rows() > 0) {
                            foreach ($q3->result() as $row3) {
                                    $this->db1->select("*");
                                    $this->db1->from("tblmstsubmenu3");
                                    $this->db1->where("submenu2id", $row3->submenu2id);
                                    $this->db1->where("submenu3id IN", "(SELECT DISTINCT submenu3id from tblmstsubmenu_akses2 where submenu2id=".$row3->submenu2id." and submenuid=".$row2->submenuid." and menuid=".$row->menuid." and leveluserid=" .$leveluser. " and submenu3id IS NOT NULL)", false);
                                    $this->db1->order_by("submenu3nm","asc");
                                    $q4 = $this->db1->get();
                                    if ($q4->num_rows() > 0) {
                                        $row3->children3 = $q4->result();
                                    }
                            }
                            $row2->children2 = $q3->result();
                        }
                    }
                   $row->children = $q2->result();
                }
                array_push($final, $row);
            }
        }
        return $final;
    }


    function getLevelnm ($LevelUser) {
        $this->db->select("levelusernm");
        $this->db->from("tblmst_leveluser");
        $this->db->where('leveluserid', $LevelUser);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }

   
}
