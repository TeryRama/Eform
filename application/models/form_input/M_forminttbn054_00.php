<?php
class M_forminttbn054_00 extends CI_Model
{
    var $tabel1  = 'tblfrminttbn054hdr';
    var $tabel2  = 'tblfrminttbn054dtl';
    var $tabel3  = 'tblfrminttbn054dtlx';

    function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
        $this->db1 = $this->load->database('db1', TRUE);
    }

    /**
     * get_docno
     *
     * @param  mixed $bulan
     * @param  mixed $tahun
     * @return void
     */
    function get_docno($bulan, $tahun)
    {
        return $this->db1->query("select 
                                    substring(docno from '.{3}$')::float vdocno
                                  from 
                                    $this->tabel1 
                                  where 
                                    extract(month from create_date)='$bulan'
                                    and extract(year from create_date)='$tahun'")->row();
    }

    function get_tanggal_indo($tanggal)
    {
        if ($this->session->userdata('logged_in')) {
            $bulan = array(
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $pecahkan = explode('-', $tanggal);

            // variabel pecahkan 0 = tanggal
            // variabel pecahkan 1 = bulan
            // variabel pecahkan 2 = tahun

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }
    }

    function get_tanggal_bahan_bakar($bulan, $tahun)
    {
        return $this->db1->query("SELECT
                                    ( EXTRACT ( DAY FROM date_trunc( 'MONTH', ( '" . $tahun . $bulan . "'||'01' ) :: DATE ) + ( n || ' day' ) :: INTERVAL ) ) AS hari,
                                    ( EXTRACT ( MONTH FROM date_trunc( 'MONTH', ( '" . $tahun . $bulan . "'||'01' ) :: DATE ) + ( n || ' day' ) :: INTERVAL ) ) AS bulan,
                                    ( EXTRACT ( YEAR FROM date_trunc( 'MONTH', ( '" . $tahun . $bulan . "'||'01' ) :: DATE ) + ( n || ' day' ) :: INTERVAL ) ) AS tahun 
                                FROM
                                    generate_series ( 0, ( EXTRACT ( DAY FROM date_trunc( 'MONTH', ( '" . $tahun . $bulan . "'||'01' ) :: DATE ) + INTERVAL '1 MONTH - 1 day' ) :: INTEGER - 1 ) ) n")->result();
    }

    function check_data($bulan, $tahun)
    {
        // cek data all data, jika pertama kali buat form ini maka list master tetap muncul
        $q = $this->db1->query("select count(headerid) jml_data from tblfrminttbn054hdr where tahun='$tahun'")->row();

        // cek data bulan input laporan
        $q2 = $this->db1->query("select count(headerid) jml_data from tblfrminttbn054hdr where bulan='$bulan' and tahun='$tahun' and status_detail='0'")->row();

        // cek data bulan input laporan terakhir
        $q3 = $this->db1->query("select max(create_date) data_terakhir from tblfrminttbn054hdr where status_detail='0'")->result();
        return [
            'cek_data_semua'     => $q,
            'cek_data_bulan'     => $q2,
            'cek_data_terakhir' => $q3,
        ];
    }

    function get_header_byid($id)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('headerid', $id);
        $query = $this->db1->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }

    function get_detail_byid($id)
    {
        $this->db1->from($this->tabel2);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byidx($id)
    {
        $this->db1->from($this->tabel3);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function check($create_date, $bulan)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);

        $this->db1->where('bulan', $bulan);

        if (!empty($headerid)) {
            $this->db1->where('headerid !=', $headerid);
        }

        $query = $this->db1->get();
        return $query;
    }

    function cek_stdetail($headerid)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('headerid', $headerid);
        $this->db1->where('status_detail', '1');
        $query = $this->db1->get();
        return $query;
    }

    function cek_stdetailx($headerid)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('headerid', $headerid);
        $this->db1->where('status_detailx', '1');
        $query = $this->db1->get();
        return $query;
    }

    /// insert group
    function insert_dtheader($data5)
    {
        $this->db1->trans_begin();
        $this->db1->insert($this->tabel1, $data5);
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
        return TRUE;
    }

    function insert_detail($data6)
    {
        $this->db1->trans_begin();
        $this->db1->insert($this->tabel2, $data6);
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
        return TRUE;
    }

    function insert_detailx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel3 
                            (
                              detail_id,
                              headerid,
                              stdtl,
                              tanggal_bahan_bakar,
                              supply_flow_awal,
                              supply_flow_akhir,
                              supply_total,
                              asf_flow_awal,
                              asf_flow_akhir,
                              asf_total,
                              soft_flow_awal,
                              soft_flow_akhir,
                              soft_total
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,
                              b.tanggal_bahan_bakar,
                              b.supply_flow_awal,
                              b.supply_flow_akhir,
                              b.supply_total,
                              b.asf_flow_awal,
                              b.asf_flow_akhir,
                              b.asf_total,
                              b.soft_flow_awal,
                              b.soft_flow_akhir,
                              b.soft_total
                              
                            from 
                              $this->tabel2 as b 
                            left join 
                              $this->tabel3 as bx 
                              on b.detail_id = bx.detail_id 
                            where 
                              bx.detail_id is null 
                              and b.headerid='$id' 
                            order by 
                              b.detail_id");
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }

    function update_hdr($headerid, $data5)
    {
        $this->db1->trans_begin();
        $this->db1->where('headerid', $headerid);
        $this->db1->update($this->tabel1, $data5);
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
        return TRUE;
    }

    function update_dtl($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel2, $data6);
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
        return TRUE;
    }

    function update_dtlx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel3, $data6);
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
        return TRUE;
    }

    function update_stdtlx($detail_id)
    {
        $this->db1->trans_start();
        $this->db1->query("Update $this->tabel3 set stdtl='0' where detail_id ='$detail_id'");
        $this->db1->trans_complete();
    }

    // delete aja, jadi gak ada update
    function delete_detail_byheaderid_a($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel2);
        return $query1;
    }

    function delete_detail_byheaderid_ax($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel3);
        return $query2;
    }
}
