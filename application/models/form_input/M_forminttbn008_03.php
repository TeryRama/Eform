<?php
class M_forminttbn008_03 extends CI_Model
{
    var $tabel1  = 'tblfrminttbn008hdr';
    var $tabel2  = 'tblfrminttbn008dtl';
    var $tabel3  = 'tblfrminttbn008dtlx';

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
        $q = $this->db1->query("select count(headerid) jml_data from tblfrminttbn008hdr where tahun='$tahun'")->row();

        // cek data bulan input laporan
        $q2 = $this->db1->query("select count(headerid) jml_data from tblfrminttbn008hdr where bulan='$bulan' and tahun='$tahun' and status_detail='0'")->row();

        // cek data bulan input laporan terakhir
        $q3 = $this->db1->query("select max(create_date) data_terakhir from tblfrminttbn008hdr where status_detail='0'")->result();
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
                              batubara_stock_awal,
                              batubara_terima,
                              batubara_pakai,
                              batubara_stock_akhir,
                              debu_arang_terima,
                              debu_arang_pakai,
                              tempurung_stock_awal,
                              tempurung_terima,
                              tempurung_pakai,
                              tempurung_stock_akhir,
                              sabut_stock_awal,
                              sabut_terima,
                              sabut_pakai,
                              sabut_stock_akhir,
                              cocopiet_terima,
                              cocopiet_pakai,
                              total_pakai_bahan_bakar
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.tanggal_bahan_bakar,
                              b.batubara_stock_awal,
                              b.batubara_terima,
                              b.batubara_pakai,
                              b.batubara_stock_akhir,
                              b.debu_arang_terima,
                              b.debu_arang_pakai,
                              b.tempurung_stock_awal,
                              b.tempurung_terima,
                              b.tempurung_pakai,
                              b.tempurung_stock_akhir,
                              b.sabut_stock_awal,
                              b.sabut_terima,
                              b.sabut_pakai,
                              b.sabut_stock_akhir,
                              b.cocopiet_terima,
                              b.cocopiet_pakai,
                              b.total_pakai_bahan_bakar
                              
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
