<?php
class M_formfrmfss317_16 extends CI_Model
{
    var $tabel1  = 'tblfrmfrmfss317hdr';
    var $tabel2  = 'tblfrmfrmfss317dtl';
    var $tabel3  = 'tblfrmfrmfss317dtlx';
    var $tabel4  = 'tblfrmfrmfss317dtl_b';
    var $tabel5  = 'tblfrmfrmfss317dtl_bx';
    var $tabel6  = 'tblfrmfrmfss317dtl_c';
    var $tabel7  = 'tblfrmfrmfss317dtl_cx';
    var $tabel8  = 'tblfrmfrmfss317dtl_d';
    var $tabel9  = 'tblfrmfrmfss317dtl_dx';
    var $tabel10 = 'tblfrmfrmfss317dtl_e';
    var $tabel11 = 'tblfrmfrmfss317dtl_ex';
    var $tabel12 = 'tblfrmfrmfss317dtl_f';
    var $tabel13 = 'tblfrmfrmfss317dtl_fx';
    var $tabel14 = 'tblfrmfrmfss317dtl_g';
    var $tabel15 = 'tblfrmfrmfss317dtl_gx';
    var $tabel16 = 'tblfrmfrmfss317dtl_h';
    var $tabel17 = 'tblfrmfrmfss317dtl_hx';
    var $tabel18 = 'tblfrmfrmfss317dtl_i';
    var $tabel19 = 'tblfrmfrmfss317dtl_ix';
    var $tabel20 = 'tblfrmfrmfss317dtl_j';
    var $tabel21 = 'tblfrmfrmfss317dtl_jx';
    var $tabel22 = 'tblfrmfrmfss317dtl_k';
    var $tabel23 = 'tblfrmfrmfss317dtl_kx';
    var $tabel24 = 'tblfrmfrmfss317dtl_l';
    var $tabel25 = 'tblfrmfrmfss317dtl_lx';
    var $tabel26 = 'tblfrmfrmfss317dtl_m';
    var $tabel27 = 'tblfrmfrmfss317dtl_mx';
    var $tabel28 = 'tblfrmfrmfss317dtl_n';
    var $tabel29 = 'tblfrmfrmfss317dtl_nx';
    var $tabel30 = 'tblfrmfrmfss317dtl_o';
    var $tabel31 = 'tblfrmfrmfss317dtl_ox';
    var $tabel32 = 'tblfrmfrmfss317dtl_p';
    var $tabel33 = 'tblfrmfrmfss317dtl_px';

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
                                    substring(docno from '.{2}$')::float vdocno
                                  from 
                                    $this->tabel1 
                                  where 
                                    extract(month from create_date)='$bulan'
                                    and extract(year from create_date)='$tahun'")->row();
    }

    function get_frmfss315($create_date, $persen)
    {
        return $this->db1->query("with
                                    tbl_a as
                                        (select
                                            '$create_date'::date create_date,

                                            'Jam Operasi (Proses)' dtl_b_jam_operasi_jenis,
                                            sum(coalesce(nullif(rw_1_total_jam,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_2_total_jam,''), '0')::numeric)
                                            + sum(coalesce(nullif(cone_1_2_total_jam,''), '0')::numeric)
                                            + sum(coalesce(nullif(cone_3_4_total_jam,''), '0')::numeric) dtl_b_jam_operas_nilai,
                                            0 dtl_b_jam_operasi_nilai,                                            
                                            'JAM' dtl_b_jam_operasi_satuan,

                                            'Air Gambut Sedimen' dtl_b_air_gambut_sedimen_jenis,
                                            ((sum(coalesce(nullif(rw_1_total,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_2_total,''), '0')::numeric)) *  $persen) dtl_b_air_gambut_sedimen_nilai,
                                            ((sum(coalesce(nullif(rw_1_total,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_2_total,''), '0')::numeric))) dtl_b_air_gambut_sedimen_nilai_efisiensi,
                                            'M3' dtl_b_air_gambut_sedimen_satuan,

                                            'Air Gambut Cone Clarifier' dtl_b_air_gambut_cone_jenis,
                                            ((sum(coalesce(nullif(cone_1_2_total,''), '0')::numeric)
                                            + sum(coalesce(nullif(cone_3_4_total,''), '0')::numeric))*  $persen ) dtl_b_air_gambut_cone_nilai,
                                            ((sum(coalesce(nullif(cone_1_2_total,''), '0')::numeric)
                                            + sum(coalesce(nullif(cone_3_4_total,''), '0')::numeric))) dtl_b_air_gambut_cone_nilai_efisiensi,
                                            'M3' dtl_b_air_gambut_cone_satuan,								

                                            'Total Air Gambut' dtl_b_air_gambut_total_jenis,
                                            ((sum(coalesce(nullif(rw_1_total,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_2_total,''), '0')::numeric)
                                            + sum(coalesce(nullif(cone_1_2_total,''), '0')::numeric)
                                            + sum(coalesce(nullif(cone_3_4_total,''), '0')::numeric)) *  $persen ) dtl_b_air_gambut_total_nilai,
                                            ((sum(coalesce(nullif(rw_1_total,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_2_total,''), '0')::numeric)
                                            + sum(coalesce(nullif(cone_1_2_total,''), '0')::numeric)
                                            + sum(coalesce(nullif(cone_3_4_total,''), '0')::numeric)) ) dtl_b_air_gambut_total_nilai_efisiensi,
                                            'M3' dtl_b_air_gambut_total_satuan
                                        from
                                            tblfrmfrmfss315hdr a
                                        join 
                                            tblfrmfrmfss315dtl b
                                                on a.headerid=b.headerid
                                        where 
                                            a.status_detail_sf1 = '1'
                                            and a.status_detail_sf2 = '1'
                                            and a.status_detail_sf3 = '1'
                                            and a.create_date='$create_date'),
																						
                                    tbl_a2 as
                                        (select
                                            '$create_date'::date create_date,

                                            (sum(coalesce(nullif(rw_1_total_jam,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_2_total_jam,''), '0')::numeric)
                                            + sum(coalesce(nullif(cone_1_2_total_jam,''), '0')::numeric)
                                            + sum(coalesce(nullif(cone_3_4_total_jam,''), '0')::numeric)) / 60 dtl_b_jam_operasi_akumulatif,

                                            ((sum(coalesce(nullif(rw_1_total,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_2_total,''), '0')::numeric)) *  $persen ) dtl_b_air_gambut_sedimen_akumulatif,

                                            ((sum(coalesce(nullif(cone_1_2_total,''), '0')::numeric)
                                            + sum(coalesce(nullif(cone_3_4_total,''), '0')::numeric)) *  $persen ) dtl_b_air_gambut_cone_akumulatif,

                                            ((sum(coalesce(nullif(rw_1_total,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_2_total,''), '0')::numeric)
                                            + sum(coalesce(nullif(cone_1_2_total,''), '0')::numeric)
                                            + sum(coalesce(nullif(cone_3_4_total,''), '0')::numeric)) *  $persen ) dtl_b_air_gambut_total_akumulatif

                                        from
                                            tblfrmfrmfss315hdr a
                                        join 
                                            tblfrmfrmfss315dtl b
                                                on a.headerid=b.headerid
                                        where 
                                            a.status_detail_sf1 = '1'
                                            and a.status_detail_sf2 = '1'
                                            and a.status_detail_sf3 = '1'
                                            and a.create_date>=to_date('$create_date', 'yyyy-mm-01')
                                            and a.create_date<='$create_date'),

                                    tbl_b as
                                        (select
                                            '$create_date'::date create_date,    
                                            
                                            'Tawas (15%)' dtl_i_tawas_jenis,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%tawas%')
                                                    and (lower(replace(val_item2, ' ', '')) like '%sedimen%')
                                                then
                                                    coalesce(nullif(larutan_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_i_tawas_nilai,

                                            'Caustic soda (10%)' dtl_i_caustic_soda_jenis,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%causticsoda%')
                                                    and (lower(replace(val_item2, ' ', '')) like '%sedimen%')
                                                then
                                                    coalesce(nullif(larutan_pakai,''), '0')::numeric
                                                when 
                                                    (lower(replace(val_item1, ' ', '')) like '%causticsoda%')
                                                    and (lower(replace(val_item2, ' ', '')) like '%cone%')
                                                then
                                                    coalesce(nullif(larutan_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_i_caustic_soda_nilai,
                                            'ACH (15%)' dtl_i_ach_jenis,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%ach%')
                                                    and (lower(replace(val_item2, ' ', '')) like '%sedimen%')
                                                then
                                                    coalesce(nullif(larutan_pakai,''), '0')::numeric
                                                when 
                                                    (lower(replace(val_item1, ' ', '')) like '%ach%')
                                                    and (lower(replace(val_item2, ' ', '')) like '%cone%')
                                                then
                                                    coalesce(nullif(larutan_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_i_ach_nilai,

                                            'Alum' dtl_j_alum_jenis,
                                            0.3 dtl_j_alum_target,
                                            'Kg/M3' dtl_j_alum_satuan,

                                            'Caustic Soda' dtl_j_caustic_jenis,
                                            0.09 dtl_j_caustic_target,
                                            'M3' dtl_j_caustic_satuan,

                                            'Tawas (Kg)' dtl_k_tawas_jenis,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%tawas%')
                                                    and (lower(replace(val_item2, ' ', '')) like '%sedimen%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_k_tawas_nilai,
                                            
                                           sum( 
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%tawas%')
                                                    and (lower(replace(val_item2, ' ', '')) like '%sedimen%')
                                                    and (lower(replace(shift, ' ', '')) like '%shift_3%')
                                                then
                                                    coalesce(nullif(baku_stok,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_k_tawas_stok,
                                            'M3' dtl_k_tawas_satuan,

                                            'Caustic soda (Kg)' dtl_k_caustic_soda_jenis,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%causticsoda%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_k_caustic_soda_nilai,
                                            
                                            sum( 
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%causticsoda%')
                                                    and (lower(replace(val_item2, ' ', '')) like '%sedimen%')
                                                    and (lower(replace(shift, ' ', '')) like '%shift_3%')
                                                then
                                                    coalesce(nullif(baku_stok,''), '0')::numeric
                                                when 
                                                    (lower(replace(val_item1, ' ', '')) like '%causticsoda%')
                                                    and (lower(replace(val_item2, ' ', '')) like '%cone%')
                                                    and (lower(replace(shift, ' ', '')) like '%shift_3%')
                                                then
                                                    coalesce(nullif(baku_stok,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_k_caustic_soda_stok,
                                            'M3' dtl_k_caustic_soda_satuan,

                                            'TCCA (Kg)' dtl_k_tcca_jenis,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%tcca%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_k_tcca_nilai,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%tcca%')
                                                    and (lower(replace(shift, ' ', '')) like '%shift_3%')
                                                then
                                                    coalesce(nullif(baku_stok,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_k_tcca_stok,
                                            'M3' dtl_k_tcca_satuan,

                                            'Flockulant (Kg)' dtl_k_flokulan_jenis,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%flokulan%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_k_flokulan_nilai,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%flokulan%')
                                                    and (lower(replace(val_item2, ' ', '')) like '%sedimen%')
                                                    and (lower(replace(shift, ' ', '')) like '%shift_3%')
                                                then
                                                    coalesce(nullif(baku_stok,''), '0')::numeric
                                                when 
                                                    (lower(replace(val_item1, ' ', '')) like '%flokulan%')
                                                    and (lower(replace(val_item2, ' ', '')) like '%cone%')
                                                    and (lower(replace(shift, ' ', '')) like '%shift_3%')
                                                then
                                                    coalesce(nullif(baku_stok,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_k_flokulan_stok,
                                            'M3' dtl_k_flokulan_satuan,

                                            'ACH (Kg)' dtl_k_ach_jenis,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%ach%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_k_ach_nilai,
                                            
                                            sum(  
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%ach%')
                                                    and (lower(replace(val_item2, ' ', '')) like '%sedimen%')
                                                    and (lower(replace(shift, ' ', '')) like '%shift_3%')
                                                then
                                                    coalesce(nullif(baku_stok,''), '0')::numeric
                                                when 
                                                    (lower(replace(val_item1, ' ', '')) like '%ach%')
                                                    and (lower(replace(val_item2, ' ', '')) like '%cone%')
                                                    and (lower(replace(shift, ' ', '')) like '%shift_3%')
                                                then
                                                    coalesce(nullif(baku_stok,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_k_ach_stok,
                                            'M3' dtl_k_ach_satuan,
                                        
                                            'Garam (Kg)' dtl_l_garam_jenis,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%garam%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_l_garam_nilai,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%garam%')
                                                    and(lower(replace(shift, ' ', '')) like '%shift_3%')
                                                then
                                                    coalesce(nullif(baku_stok,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_l_garam_stok,

                                            'Anti Scalant (Kg)' dtl_m_as_jenis,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%scalant%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_m_as_nilai,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%scalant%')
                                                    and(lower(replace(shift, ' ', '')) like '%shift_3%')
                                                then
                                                    coalesce(nullif(baku_stok,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_m_as_stok,

                                            'MC.alkalin (kg)' dtl_m_mcal_jenis,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%alkalin%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_m_mcal_nilai,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%alkalin%')
                                                    and(lower(replace(shift, ' ', '')) like '%shift_3%')
                                                then
                                                    coalesce(nullif(baku_stok,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_m_mcal_stok,

                                            'MC. Acid (Kg)' dtl_m_mcd_jenis,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%acid%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_m_mcd_nilai,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%acid%')
                                                    and(lower(replace(shift, ' ', '')) like '%shift_3%')
                                                then
                                                    coalesce(nullif(baku_stok,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_m_mcd_stok,

                                            'Biocide' dtl_m_bcd_jenis,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%biocide%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_m_bcd_nilai,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%biocide%')
                                                    and(lower(replace(shift, ' ', '')) like '%shift_3%')
                                                then
                                                    coalesce(nullif(baku_stok,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_m_bcd_stok,

                                            'Cartridge Filter (pcs)' dtl_n_cf_jenis,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%cartridge%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_n_cf_nilai,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%cartridge%')
                                                    and(lower(replace(shift, ' ', '')) like '%shift_3%')
                                                then
                                                    coalesce(nullif(baku_stok,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_n_cf_stok,
                                            
                                            'Bag Filter 10 micron (pcs)' dtl_n_bf_jenis,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%bag%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_n_bf_nilai,
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%bag%')
                                                    and(lower(replace(shift, ' ', '')) like '%shift_3%')
                                                then
                                                    coalesce(nullif(baku_stok,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_n_bf_stok

                                        from
                                            tblfrmfrmfss315hdr a
                                        join 
                                            tblfrmfrmfss315dtl_b b
                                                on a.headerid=b.headerid
                                        where 
                                            a.status_detail_sf1 = '1'
                                            and a.status_detail_sf2 = '1'
                                            and a.status_detail_sf3 = '1'
                                            and a.create_date='$create_date'),
																						
                                    tbl_b2 as
                                        (select
                                            '$create_date'::date create_date,                                            

                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%tawas%')
                                                    and (lower(replace(val_item2, ' ', '')) like '%sedimen%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_i_tawas_akumulatif,

                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%causticsoda%')
                                                    and (lower(replace(val_item2, ' ', '')) like '%sedimen%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                when 
                                                    (lower(replace(val_item1, ' ', '')) like '%causticsoda%')
                                                    and (lower(replace(val_item2, ' ', '')) like '%cone%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_i_caustic_soda_akumulatif,

                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%tawas%')
                                                    and (lower(replace(val_item2, ' ', '')) like '%sedimen%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_k_tawas_akumulatif,

                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%causticsoda%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_k_caustic_soda_akumulatif,

                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%tcca%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_k_tcca_akumulatif,
                                            
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%flokulan%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_k_flokulan_akumulatif,
                                            
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%ach%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_k_ach_akumulatif,

                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%garam%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_l_garam_akumulatif,
                                            
                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%antiscalan%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_m_as_akumulatif,

                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%mc.alkalin%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_m_mcal_akumulatif,

                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%mc.acid%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_m_mcd_akumulatif,

                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%biocide%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_m_bcd_akumulatif,

                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%cartridge%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_n_cf_akumulatif,

                                            sum(
                                                case when 
                                                    (lower(replace(val_item1, ' ', '')) like '%bag%')
                                                then
                                                    coalesce(nullif(baku_pakai,''), '0')::numeric
                                                else 
                                                    0 
                                                end
                                            ) dtl_n_bf_akumulatif

                                        from
                                            tblfrmfrmfss315hdr a
                                        join 
                                            tblfrmfrmfss315dtl_b b
                                                on a.headerid=b.headerid
                                        where 
                                            a.status_detail_sf1 = '1'
                                            and a.status_detail_sf2 = '1'
                                            and a.status_detail_sf3 = '1'
                                            and a.create_date>=to_date('$create_date', 'yyyy-mm-01')
                                            and a.create_date<='$create_date'),

                                    tbl_c as
                                        (select
                                            '$create_date'::date create_date,

                                            'Pre Treatment' dtl_e_pre_treatment_jenis,
                                            sum(coalesce(nullif(rw_sedimen_a1,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_a2,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_a3,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_a4,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_a5,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_a6,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_b1,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_b2,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_b3,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_b4,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_b5,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_b6,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_cone_clarifier_1_2,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_cone_clarifier_3_4,''), '0')::numeric)
                                            + sum(coalesce(nullif(bsf_sedimen_c1,''), '0')::numeric)
                                            + sum(coalesce(nullif(bsf_sedimen_c2,''), '0')::numeric)
                                            + sum(coalesce(nullif(bsf_bak_v_notch,''), '0')::numeric)
                                            + sum(coalesce(nullif(bsf_bak_reyclce,''), '0')::numeric)
                                            + sum(coalesce(nullif(bsf_bak_cw,''), '0')::numeric) dtl_e_pre_treatment_nilai,
                                            'M3' dtl_e_pre_treatment_satuan,

                                            'Sand filter' dtl_e_asf_jenis,
                                            sum(coalesce(nullif(asf_asf_a,''), '0')::numeric)
                                            + sum(coalesce(nullif(asf_asf_b,''), '0')::numeric)
                                            + sum(coalesce(nullif(asf_asf_1a,''), '0')::numeric)
                                            + sum(coalesce(nullif(asf_asf_1b,''), '0')::numeric)
                                            + sum(coalesce(nullif(asf_bak_2,''), '0')::numeric)
                                            + sum(coalesce(nullif(asf_bak_3,''), '0')::numeric)
                                            + sum(coalesce(nullif(asf_tower_tbn,''), '0')::numeric)
                                            + sum(coalesce(nullif(asf_tower_mess,''), '0')::numeric) dtl_e_asf_nilai,
                                            'M3' dtl_e_asf_satuan,

                                            'Carbon Filter' dtl_e_acf_jenis,
                                            sum(coalesce(nullif(acf_acf_a,''), '0')::numeric)
                                            + sum(coalesce(nullif(acf_acf_b,''), '0')::numeric)
                                            + sum(coalesce(nullif(acf_bak_iv,''), '0')::numeric)
                                            + sum(coalesce(nullif(acf_bak_cip_1,''), '0')::numeric)
                                            + sum(coalesce(nullif(acf_bak_cip_2,''), '0')::numeric) dtl_e_acf_nilai,
                                            'M3' dtl_e_acf_satuan,

                                            'Softener' dtl_e_ast_jenis,
                                            sum(coalesce(nullif(ast_ast,''), '0')::numeric)
                                            + sum(coalesce(nullif(ast_bak_demin,''), '0')::numeric)
                                            + sum(coalesce(nullif(ast_tangki_st_mes,''), '0')::numeric) dtl_e_ast_nilai,
                                            'M3' dtl_e_ast_satuan,
                                            
                                            'Reverse Osmosis' dtl_e_ro_jenis,
                                            sum(coalesce(nullif(aro_tangki_ro_mes,''), '0')::numeric)
                                            + sum(coalesce(nullif(aro_tangki_ro,''), '0')::numeric)
                                            + sum(coalesce(nullif(aro_ro_wtp,''), '0')::numeric) dtl_e_ro_nilai,
                                            'M3' dtl_e_ro_satuan
                                        from
                                            tblfrmfrmfss315hdr a
                                        join 
                                            tblfrmfrmfss315dtl_c b
                                                on a.headerid=b.headerid
                                        where 
                                            a.status_detail_sf1 = '1'
                                            and a.status_detail_sf2 = '1'
                                            and a.status_detail_sf3 = '1'
                                            and a.create_date='$create_date'
                                            and b.shift='shift_3'),
																						
                                    tbl_c2 as
                                        (select
                                            '$create_date'::date create_date,

                                            sum(coalesce(nullif(rw_sedimen_a1,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_a2,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_a3,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_a4,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_a5,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_a6,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_b1,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_b2,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_b3,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_b4,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_b5,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_sedimen_b6,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_cone_clarifier_1_2,''), '0')::numeric)
                                            + sum(coalesce(nullif(rw_cone_clarifier_3_4,''), '0')::numeric)
                                            + sum(coalesce(nullif(bsf_sedimen_c1,''), '0')::numeric)
                                            + sum(coalesce(nullif(bsf_sedimen_c2,''), '0')::numeric)
                                            + sum(coalesce(nullif(bsf_bak_v_notch,''), '0')::numeric)
                                            + sum(coalesce(nullif(bsf_bak_reyclce,''), '0')::numeric)
                                            + sum(coalesce(nullif(bsf_bak_cw,''), '0')::numeric) dtl_e_pre_treatment_akumulatif,

                                            sum(coalesce(nullif(asf_asf_a,''), '0')::numeric)
                                            + sum(coalesce(nullif(asf_asf_b,''), '0')::numeric)
                                            + sum(coalesce(nullif(asf_asf_1a,''), '0')::numeric)
                                            + sum(coalesce(nullif(asf_asf_1b,''), '0')::numeric)
                                            + sum(coalesce(nullif(asf_bak_2,''), '0')::numeric)
                                            + sum(coalesce(nullif(asf_bak_3,''), '0')::numeric)
                                            + sum(coalesce(nullif(asf_tower_tbn,''), '0')::numeric)
                                            + sum(coalesce(nullif(asf_tower_mess,''), '0')::numeric) dtl_e_asf_akumulatif,

                                            sum(coalesce(nullif(acf_acf_a,''), '0')::numeric)
                                            + sum(coalesce(nullif(acf_acf_b,''), '0')::numeric)
                                            + sum(coalesce(nullif(acf_bak_iv,''), '0')::numeric)
                                            + sum(coalesce(nullif(acf_bak_cip_1,''), '0')::numeric)
                                            + sum(coalesce(nullif(acf_bak_cip_2,''), '0')::numeric) dtl_e_acf_akumulatif,

                                            sum(coalesce(nullif(ast_ast,''), '0')::numeric)
                                            + sum(coalesce(nullif(ast_bak_demin,''), '0')::numeric)
                                            + sum(coalesce(nullif(ast_tangki_st_mes,''), '0')::numeric) dtl_e_ast_akumulatif,

                                            sum(coalesce(nullif(aro_tangki_ro_mes,''), '0')::numeric)
                                            + sum(coalesce(nullif(aro_tangki_ro,''), '0')::numeric)
                                            + sum(coalesce(nullif(aro_ro_wtp,''), '0')::numeric) dtl_e_ro_akumulatif

                                        from
                                            tblfrmfrmfss315hdr a
                                        join 
                                            tblfrmfrmfss315dtl_c b
                                                on a.headerid=b.headerid
                                        where 
                                            a.status_detail_sf1 = '1'
                                            and a.status_detail_sf2 = '1'
                                            and a.status_detail_sf3 = '1'
                                            and a.create_date>=to_date('$create_date', 'yyyy-mm-01')
                                            and a.create_date<='$create_date'
                                            and b.shift='shift_3')
                                    select
                                        a.headerid,
                                        a.complete_date,
                                        a.complete_time,
                                        b.*,
                                        c.*,
                                        d.*,
                                        e.*,
                                        f.*,
                                        g.*
                                    from
                                        tblfrmfrmfss315hdr a
                                    left join 
                                        tbl_a b
                                            on a.create_date=b.create_date
                                    left join
                                        tbl_a2 c
                                            on a.create_date=c.create_date
                                    left join 
                                        tbl_b d
                                            on a.create_date=d.create_date
                                    left join
                                        tbl_b2 e
                                            on a.create_date=e.create_date
                                    left join 
                                        tbl_c f
                                            on a.create_date=f.create_date
                                    left join
                                        tbl_c2 g
                                            on a.create_date=g.create_date
                                    where 
                                        a.status_detail_sf1 = '1'
                                        and a.status_detail_sf2 = '1'
                                        and a.status_detail_sf3 = '1'
                                        and a.create_date='$create_date'")->result();
    }

    function get_frmfss316($create_date)
    {
        return $this->db1->query("with 
                                    -- cari grand total per pd
                                    tbl_a as 
                                        (select
                                            a.headerid,
                                            sum(coalesce(nullif(total,''), '0')::numeric) grand_total
                                        from
                                            tblfrmfrmfss316hdr a
                                        join 
                                            tblfrmfrmfss316dtl b
                                                on a.headerid=b.headerid
                                        where 
                                            -- a.status_detail='1' and
                                            a.create_date='$create_date'
                                        group by
                                            a.headerid),
                                    
                                    -- cari akumulatif dari awal bulan
                                    tbl_b as 
                                        (select
                                            b.nama_jenis_air,
                                            b.nama_departemen,
                                            sum(coalesce(nullif(total,''), '0')::numeric) akumulatif
                                        from
                                            tblfrmfrmfss316hdr a
                                        join 
                                            tblfrmfrmfss316dtl b
                                                on a.headerid=b.headerid
                                        where 
                                            -- a.status_detail='1' and
                                            a.create_date>=to_date('$create_date', 'yyyy-mm-01')
                                            and a.create_date<='$create_date'
                                        group by
                                            b.nama_jenis_air,
                                            b.nama_departemen),

                                    -- cari total per departemen
                                    tbl_c as 
                                        (select
                                            a.headerid,
                                            b.nama_jenis_air,
                                            b.nama_departemen,
                                            sum(coalesce(nullif(total,''), '0')::numeric) total_dept
                                        from
                                            tblfrmfrmfss316hdr a
                                        join 
                                            tblfrmfrmfss316dtl b
                                                on a.headerid=b.headerid
                                        where 
                                            -- a.status_detail='1' and
                                            a.create_date='$create_date'
                                        group by
                                            a.headerid,
                                            b.nama_jenis_air,
                                            b.nama_departemen)
                                    select
                                        row_number () over (partition by c.nama_jenis_air order by c.nama_departemen) no_urut_asc,
                                        row_number() over (partition by c.nama_jenis_air order by c.nama_departemen desc) no_urut_desc,
                                        a.headerid,
                                        a.complete_date,
                                        a.complete_time,
                                        c.nama_jenis_air,
                                        c.nama_departemen,
                                        c.total_dept::numeric/b.grand_total*80 persen,
                                        c.total_dept total,
                                        d.akumulatif akumulatif
                                    from
                                        tblfrmfrmfss316hdr a
                                    join
                                        tbl_a b
                                        on a.headerid=b.headerid
                                    join
                                        tbl_c c
                                        on a.headerid=c.headerid
                                    join
                                        tbl_b d
                                        on c.nama_departemen=d.nama_departemen
                                        and c.nama_jenis_air=d.nama_jenis_air
                                    where 
                                        -- a.status_detail='1' and
                                        a.create_date='$create_date'
                                    order by 
                                        c.nama_jenis_air,
										c.nama_departemen")->result();
    }
    function get_frmfss317_f_akumulatif($create_date)
    {
        return $this->db1->query("select
                                    max(create_date) create_date,

                                    sum(dtl_f_ro_akumulatif) dtl_f_ro_akumulatif,
                                    sum(dtl_f_asf_akumulatif) dtl_f_asf_akumulatif,
                                    sum(dtl_f_acf_akumulatif) dtl_f_acf_akumulatif,
                                    sum(dtl_f_ast_akumulatif) dtl_f_ast_akumulatif,
                                    sum(dtl_f_konen_akumulatif) dtl_f_konen_akumulatif
                                from
                                    (select
                                        '$create_date'::date create_date,

                                        case when 
                                            b.operasi_jenis = 'Reject RO' 
                                        then 
                                            sum(coalesce(nullif(operasi_nilai,''), '0')::numeric)
                                        else
                                            0
                                        end dtl_f_ro_akumulatif,
                                        case when 
                                            b.operasi_jenis = 'Sand filter' 
                                        then 
                                            sum(coalesce(nullif(operasi_nilai,''), '0')::numeric)
                                        else
                                            0
                                        end dtl_f_asf_akumulatif,
                                        case when 
                                            b.operasi_jenis = 'Carbon Filter' 
                                        then 
                                            sum(coalesce(nullif(operasi_nilai,''), '0')::numeric)
                                        else
                                            0
                                        end dtl_f_acf_akumulatif,
                                        case when 
                                            b.operasi_jenis = 'Softener' 
                                        then 
                                            sum(coalesce(nullif(operasi_nilai,''), '0')::numeric)
                                        else
                                            0
                                        end dtl_f_ast_akumulatif,
                                        case when 
                                            b.operasi_jenis = 'Konservasi Energi' 
                                        then 
                                            sum(coalesce(nullif(operasi_nilai,''), '0')::numeric)
                                        else
                                            0
                                        end dtl_f_konen_akumulatif
                                    from
                                        $this->tabel1 a
                                    join
                                        $this->tabel12 b
                                        on a.headerid = b.headerid
                                    where
                                        a.create_date>=to_date('$create_date', 'yyyy-mm-01')
                                        and a.create_date <= '$create_date'
                                    group by
                                        b.operasi_jenis) x
                                -- group by
                                --     dtl_f_ro_jenis,
                                --     dtl_f_ro_satuan,
                                --     dtl_f_asf_jenis,
                                --     dtl_f_asf_satuan,
                                --     dtl_f_acf_jenis,
                                --     dtl_f_acf_satuan,
                                --     dtl_f_ast_jenis,
                                --     dtl_f_ast_satuan,
                                --     dtl_f_konen_jenis,
                                --     dtl_f_konen_satuan")->result();
    }
    function get_frmfss317($tgl_kemarin)
    {
        return $this->db1->query("select 
                                    a.headerid,
                                    a.complete_date,
                                    a.complete_time,
                                    b.stok_air_awal dtl_g_stok_air_awal
                                  from 
                                    $this->tabel1 a
                                  join
                                    $this->tabel14 b
                                        on a.headerid=b.headerid
                                  where 
                                    a.create_date='$tgl_kemarin'")->result();
    }

    function get_frmfss317_wtd($create_date)
    {
        return $this->db1->query("SELECT
                                        'Pemakaian WTD' dtl_b_wtd_jenis,
                                        '0' dtl_b_wtd_nilai,
                                        'M3' dtl_b_wtd_satuan,
                                        SUM ( COALESCE ( NULLIF ( operasi_nilai, '' ), '0' ) :: NUMERIC ) dtl_b_wtd_akumulatif 
                                    FROM
                                        tblfrmfrmfss317hdr
                                        A JOIN tblfrmfrmfss317dtl_b b ON A.headerid = b.headerid 
                                    WHERE
                                        A.create_date >= to_date( '$create_date', 'yyyy-mm-01' ) 
                                        AND A.create_date <= '$create_date' 
                                        AND b.operasi_jenis LIKE '%WTD%'")->result();
    }
    function get_frmfss317_operasi_jam($create_date)
    {
        return $this->db1->query("SELECT
                                        'Jam Operasi (Proses)' dtl_b_jam_operasi_jenis,
                                        '24' dtl_b_jam_operasi_nilai,
                                        'JAM' dtl_b_jam_operasi_satuan,
                                        (SUM ( COALESCE ( NULLIF ( operasi_nilai, '' ), '0' ) :: NUMERIC )) + 24 dtl_b_jam_operasi_akumulatif 
                                    FROM
                                        tblfrmfrmfss317hdr
                                        A JOIN tblfrmfrmfss317dtl_b b ON A.headerid = b.headerid 
                                    WHERE
                                        A.create_date >= to_date( '$create_date', 'yyyy-mm-01' ) 
                                        AND A.create_date <= '$create_date' 
                                        AND b.operasi_jenis = 'Jam Operasi (Proses)'")->result();
    }

    function get_list_data_kemarin_stok_air($tgl_kemarin)
    {
        $query = $this->db1->query("SELECT SUM(operasi_nilai::NUMERIC) total_stok_awal_kemarin FROM tblfrmfrmfss317hdr A LEFT JOIN tblfrmfrmfss317dtl_e AS b ON A.headerid = b.headerid WHERE A.create_date = '$tgl_kemarin'");
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_frmfss520($create_date)
    {
        return $this->db1->query("with 
                                    -- cari akumulatif
                                    tbl_a as 
                                        (select
                                            '$create_date'::date create_date,
                                            case when b.parameter='Operasi ( menit )' 
                                                then (sum(coalesce(nullif(cek_shift_jam1,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam2,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam3,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam4,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam5,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam6,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam7,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam8,''), '0')::numeric)) / 60 else 0 end jam_operasi_akumulatif,
                                                    
                                            case when (lower(replace(b.parameter, ' ', '')) like '%flow%')
                                                    and (lower(replace(b.parameter, ' ', '')) like '%product%') 
                                                then sum(coalesce(nullif(cek_shift_jam1,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam2,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam3,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam4,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam5,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam6,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam7,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam8,''), '0')::numeric) else 0 end proses_akumulatif,

                                            case when (lower(replace(b.parameter, ' ', '')) like '%flow%') 
                                                    and (lower(replace(b.parameter, ' ', '')) like '%reject%') 
                                                then sum(coalesce(nullif(cek_shift_jam1,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam2,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam3,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam4,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam5,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam6,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam7,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam8,''), '0')::numeric) else 0 end reject_akumulatif


                                        from
                                            tblfrmfrmfss520hdr a
                                        join 
                                            tblfrmfrmfss520dtl b
                                                on a.headerid=b.headerid
                                        where 
                                            a.status_detail_sf1 = '1'
                                            and a.status_detail_sf2 = '1'
                                            and a.status_detail_sf3 = '1'
                                            and a.create_date>=to_date('$create_date', 'yyyy-mm-01')
                                            and a.create_date<='$create_date'
                                        group by 
                                            b.parameter),
                                        
                                    -- cari hari ini
                                    tbl_b as 
                                        (select
                                            a.headerid,
                                            a.complete_date,
                                            a.complete_time,
                                            '$create_date'::date create_date,
                                            case when b.parameter='Operasi ( menit )' 
                                                then (sum(coalesce(nullif(cek_shift_jam1,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam2,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam3,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam4,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam5,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam6,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam7,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam8,''), '0')::numeric)) / 60 else 0 end jam_operasi_nilai,

                                            case when (lower(replace(b.parameter, ' ', '')) like '%flow%')
                                                    and (lower(replace(b.parameter, ' ', '')) like '%product%') 
                                                then sum(coalesce(nullif(cek_shift_jam1,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam2,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam3,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam4,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam5,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam6,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam7,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam8,''), '0')::numeric) else 0 end proses_nilai,

                                            case when (lower(replace(b.parameter, ' ', '')) like '%flow%') 
                                                    and (lower(replace(b.parameter, ' ', '')) like '%reject%') 
                                                then sum(coalesce(nullif(cek_shift_jam1,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam2,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam3,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam4,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam5,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam6,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam7,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam8,''), '0')::numeric) else 0 end reject_nilai,

                                            
                                            case when (b.parameter='Operasi ( menit )' )
                                                    and (b.nama_mesin like '%Reverse Osmosis 1%')
                                                then (sum(coalesce(nullif(cek_shift_jam1,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam2,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam3,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam4,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam5,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam6,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam7,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam8,''), '0')::numeric)) / 60 else 0 end dtl_o_ro1_jam,
                                            case when (b.nama_mesin like '%Reverse Osmosis 1%')
                                                    and(b.parameter like '%Product Flow%') 
                                                then sum(coalesce(nullif(cek_shift_jam1,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam2,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam3,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam4,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam5,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam6,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam7,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam8,''), '0')::numeric) else 0 end dtl_o_ro1_produk,

                                            
                                            case when b.parameter='Operasi ( menit )' 
                                                    and(b.nama_mesin like '%Reverse Osmosis 2%')
                                                then (sum(coalesce(nullif(cek_shift_jam1,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam2,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam3,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam4,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam5,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam6,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam7,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam8,''), '0')::numeric)) / 60  else 0 end dtl_o_ro2_jam,
                                            case when (b.nama_mesin like '%Reverse Osmosis 2%')
                                                    and(b.parameter like '%Product Flow%') 
                                                then sum(coalesce(nullif(cek_shift_jam1,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam2,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam3,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam4,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam5,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam6,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam7,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam8,''), '0')::numeric) else 0 end dtl_o_ro2_produk,

                                            
                                            case when b.parameter='Operasi ( menit )' 
                                                    and(b.nama_mesin like '%Reverse Osmosis 3%')
                                                then (sum(coalesce(nullif(cek_shift_jam1,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam2,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam3,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam4,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam5,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam6,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam7,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam8,''), '0')::numeric)) / 60  else 0 end dtl_o_ro3_jam,
                                            case when (b.nama_mesin like '%Reverse Osmosis 3%')
                                                    and(b.parameter like '%Product Flow%') 
                                                then sum(coalesce(nullif(cek_shift_jam1,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam2,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam3,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam4,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam5,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam6,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam7,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam8,''), '0')::numeric) else 0 end dtl_o_ro3_produk

                                        from
                                            tblfrmfrmfss520hdr a
                                        join 
                                            tblfrmfrmfss520dtl b
                                                on a.headerid=b.headerid
                                        where 
                                            a.status_detail_sf1 = '1'
                                            and a.status_detail_sf2 = '1'
                                            and a.status_detail_sf3 = '1'
                                            and a.create_date='$create_date'
                                        group by 
                                            a.headerid,
                                            a.complete_date,
                                            a.complete_time,
                                            b.nama_mesin,
                                            b.parameter)
                                        
                                    select 
                                        *,
                                        'Reject RO' dtl_f_ro_jenis,
                                        'M3' dtl_f_ro_satuan,
                                        'Sand filter' dtl_f_asf_jenis,
                                        'M3' dtl_f_asf_satuan,
                                        'Carbon Filter' dtl_f_acf_jenis,
                                        'M3' dtl_f_acf_satuan,
                                        'Softener' dtl_f_ast_jenis,
                                        'M3' dtl_f_ast_satuan,
                                        'Konservasi Energi' dtl_f_konen_jenis,
                                        'M3' dtl_f_konen_satuan,
                                        'Proses RO 1' dtl_o_ro1_jenis,
                                        'Proses RO 2' dtl_o_ro2_jenis,
                                        'Proses RO 3' dtl_o_ro3_jenis,
                                        'Jam Operasi (Proses)' jam_operasi_jenis,
                                        'Proses' proses_jenis,
										'Jam Operasi (Proses)' jam_operasi_uf_jenis,
                                        'Proses' proses_uf_jenis,
                                        'Reject' reject_jenis,
                                        'Jam' jam_operasi_satuan,
                                        'Jam' jam_operasi_uf_satuan,
                                        'Jam' dtl_o_ro1_satuan,
                                        'Jam' dtl_o_ro2_satuan,
                                        'Jam' dtl_o_ro3_satuan,
                                        'M3' proses_satuan,
                                        'M3' proses_uf_satuan,
                                        'M3' reject_satuan,
                                        'Proses RO' tabel_status,
                                        'Proses UF' tabel_uf_status
                                    from
                                        (select 
                                            max(create_date) create_date, 
                                            sum(jam_operasi_akumulatif) jam_operasi_akumulatif, 
                                            sum(proses_akumulatif) proses_akumulatif, 
                                            sum(reject_akumulatif) reject_akumulatif 
                                        from 
                                            tbl_a) a 
                                    join 
                                        (select 
                                            max(headerid) headerid, 
                                            max(complete_date) complete_date, 
                                            max(complete_time) complete_time, 
                                            max(create_date) create_date, 
                                            sum(jam_operasi_nilai) jam_operasi_nilai, 
                                            sum(proses_nilai) proses_nilai, 
                                            sum(reject_nilai) reject_nilai,
                                            sum(dtl_o_ro1_jam) dtl_o_ro1_jam,
                                            sum(dtl_o_ro1_produk) dtl_o_ro1_produk,
                                            sum(dtl_o_ro2_jam) dtl_o_ro2_jam,
                                            sum(dtl_o_ro2_produk) dtl_o_ro2_produk,
                                            sum(dtl_o_ro3_jam) dtl_o_ro3_jam,
                                            sum(dtl_o_ro3_produk) dtl_o_ro3_produk 
                                        from 
                                            tbl_b) b 
                                        on a.create_date = b.create_date")->result();
    }
    function get_intwtd014($create_date)
    {
        return $this->db1->query("with 
                                    -- cari akumulatif
                                    tbl_a as 
                                        (select
                                            '$create_date'::date create_date,
                                            case when b.parameter='Operasi ( menit )' 
                                                then (sum(coalesce(nullif(cek_shift_jam1,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam2,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam3,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam4,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam5,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam6,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam7,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam8,''), '0')::numeric) ) / 60 else 0 end jam_operasi_uf_akumulatif,
                                                    
                                            case when (lower(replace(b.parameter, ' ', '')) like '%uffeedflow%')
                                                then sum(coalesce(nullif(cek_shift_jam1,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam2,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam3,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam4,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam5,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam6,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam7,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam8,''), '0')::numeric) else 0 end proses_uf_akumulatif


                                        from
                                            tblfrmintwtd014hdr a
                                        join 
                                            tblfrmintwtd014dtl b
                                                on a.headerid=b.headerid
                                        where 
                                            a.status_detail_sf1 = '1'
                                            and a.status_detail_sf2 = '1'
                                            and a.status_detail_sf3 = '1'
                                            and a.create_date>=to_date('$create_date', 'yyyy-mm-01')
                                            and a.create_date<='$create_date'
                                        group by 
                                            b.parameter),
                                        
                                    -- cari hari ini
                                    tbl_b as 
                                        (select
                                            a.headerid,
                                            a.complete_date,
                                            a.complete_time,
                                            '$create_date'::date create_date,
                                            case when b.parameter='Operasi ( menit )' 
                                                then (sum(coalesce(nullif(cek_shift_jam1,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam2,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam3,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam4,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam5,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam6,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam7,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam8,''), '0')::numeric)) / 60 else 0 end jam_operasi_uf_nilai,

                                            case when (lower(replace(b.parameter, ' ', '')) like '%uffeedflow%')
                                                then sum(coalesce(nullif(cek_shift_jam1,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam2,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam3,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam4,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam5,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam6,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam7,''), '0')::numeric)
                                                    + sum(coalesce(nullif(cek_shift_jam8,''), '0')::numeric) else 0 end proses_uf_nilai

                                        from
                                            tblfrmintwtd014hdr a
                                        join 
                                            tblfrmintwtd014dtl b
                                                on a.headerid=b.headerid
                                        where 
                                            a.status_detail_sf1 = '1'
                                            and a.status_detail_sf2 = '1'
                                            and a.status_detail_sf3 = '1'
                                            and a.create_date='$create_date'
                                        group by 
                                            a.headerid,
                                            a.complete_date,
                                            a.complete_time,
                                            b.nama_mesin,
                                            b.parameter)
                                        
                                    select 
                                        *,
										'Jam Operasi (Proses)' jam_operasi_uf_jenis,
                                        'Proses' proses_uf_jenis,
                                        'Jam' jam_operasi_uf_satuan,
                                        'M3' proses_uf_satuan,
                                        'Proses UF' tabel_uf_status
                                    from
                                        (select 
                                            max(create_date) create_date, 
                                            sum(jam_operasi_uf_akumulatif) jam_operasi_uf_akumulatif, 
                                            sum(proses_uf_akumulatif) proses_uf_akumulatif
                                        from 
                                            tbl_a) a 
                                    join 
                                        (select 
                                            max(headerid) headerid, 
                                            max(complete_date) complete_date, 
                                            max(complete_time) complete_time, 
                                            max(create_date) create_date, 
                                            sum(jam_operasi_uf_nilai) jam_operasi_uf_nilai, 
                                            sum(proses_uf_nilai) proses_uf_nilai
                                        from 
                                            tbl_b) b 
                                        on a.create_date = b.create_date")->result();
    }

    function get_from_mypsg($create_date)
    {
        return json_decode($this->curl->simple_post(setAPI() . "pi_mypsg_frmfss317", ['create_date' => $create_date], array(CURLOPT_BUFFERSIZE => 10)));;
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
        // $this->db1->from($this->tabel2);
        // $this->db1->where('headerid', $id);
        // $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->query("SELECT
                                        *,
                                        ROW_NUMBER ( ) OVER ( PARTITION BY nama_jenis_air ORDER BY detail_id DESC ) no_urut_desc,
                                        ROW_NUMBER ( ) OVER ( PARTITION BY nama_jenis_air ORDER BY detail_id ) no_urut,
                                        ROW_NUMBER ( ) OVER ( PARTITION BY nama_jenis_air, nama_departemen ORDER BY detail_id ) no_urut2_asc,
                                        ROW_NUMBER ( ) OVER ( PARTITION BY nama_jenis_air, nama_departemen ORDER BY detail_id DESC ) no_urut2_desc
                                    FROM
                                        tblfrmfrmfss317dtl 
                                    WHERE
                                        headerid = '$id'
                                    order by detail_id ASC");
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

    function get_detail_lap_byid($id, $tbl = null)
    {
        $tbl = $tbl ?? $this->tabel2;

        return $this->db1->query("select
                                        row_number () over (partition by b.nama_jenis_air order by detail_id) no_urut,
                                        row_number() over (partition by b.nama_jenis_air order by detail_id desc) no_urut_desc,
                                        *
                                    from
                                        $this->tabel1 a
                                    join 
                                        $tbl b
                                            on a.headerid=b.headerid
                                    where 
                                        a.headerid=$id
                                    order by 
                                        detail_id")->result();
    }

    function get_detail_lap_byidx($id)
    {
        return $this->get_detail_lap_byid($id, $this->tabel3);
    }

    function get_detail_byid_b($id)
    {
        $this->db1->from($this->tabel4);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_bx($id)
    {
        $this->db1->from($this->tabel5);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_c($id)
    {
        $this->db1->from($this->tabel6);
        $this->db1->where('headerid', $id);
        $this->db1->where('operasi_status', 'Proses RO');
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_cx($id)
    {
        $this->db1->from($this->tabel7);
        $this->db1->where('headerid', $id);
        $this->db1->where('operasi_status', 'Proses RO');
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_c_uf($id)
    {
        $this->db1->from($this->tabel6);
        $this->db1->where('headerid', $id);
        $this->db1->where('operasi_status', 'Proses UF');
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_c_ufx($id)
    {
        $this->db1->from($this->tabel7);
        $this->db1->where('headerid', $id);
        $this->db1->where('operasi_status', 'Proses UF');
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_d($id)
    {
        $this->db1->from($this->tabel8);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_dx($id)
    {
        $this->db1->from($this->tabel9);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_e($id)
    {
        $this->db1->from($this->tabel10);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_ex($id)
    {
        $this->db1->from($this->tabel11);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_f($id)
    {
        $this->db1->from($this->tabel12);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_fx($id)
    {
        $this->db1->from($this->tabel13);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_g($id)
    {
        $this->db1->from($this->tabel14);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_gx($id)
    {
        $this->db1->from($this->tabel15);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_h($id)
    {
        $this->db1->from($this->tabel16);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_hx($id)
    {
        $this->db1->from($this->tabel17);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_i($id)
    {
        $this->db1->from($this->tabel18);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_ix($id)
    {
        $this->db1->from($this->tabel19);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_j($id)
    {
        $this->db1->from($this->tabel20);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_jx($id)
    {
        $this->db1->from($this->tabel21);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_k($id)
    {
        $this->db1->from($this->tabel22);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_kx($id)
    {
        $this->db1->from($this->tabel23);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_l($id)
    {
        $this->db1->from($this->tabel24);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_lx($id)
    {
        $this->db1->from($this->tabel25);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_m($id)
    {
        $this->db1->from($this->tabel26);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_mx($id)
    {
        $this->db1->from($this->tabel27);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_n($id)
    {
        $this->db1->from($this->tabel28);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_nx($id)
    {
        $this->db1->from($this->tabel29);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_o($id)
    {
        $this->db1->from($this->tabel30);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_ox($id)
    {
        $this->db1->from($this->tabel31);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_detail_byid_p($id)
    {
        $this->db1->from($this->tabel32);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function get_detail_byid_px($id)
    {
        $this->db1->from($this->tabel33);
        $this->db1->where('headerid', $id);
        $this->db1->order_by("detail_id", "asc");
        $query = $this->db1->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function check($create_date, $docno, $headerid = null)
    {
        $this->db1->from($this->tabel1);
        $this->db1->where('create_date', $create_date);
        $this->db1->where('docno', $docno);


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
        $dtlid = $this->db1->insert($this->tabel2, $data6);
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

                              id_flow_meter,
                              nama_jenis_air,
                              nama_departemen,
                              nama_flow,
                              pemakaian,
                              persen,
                              akumulatif
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.id_flow_meter,
                              b.nama_jenis_air,
                              b.nama_departemen,
                              b.nama_flow,
                              b.pemakaian,
                              b.persen,
                              b.akumulatif
                              
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

    function insert_detail_b($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel4, $data6);
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

    function insert_detail_bx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel5 
                            (
                              detail_id,
                              headerid,
                              stdtl,

                              operasi_jenis,
                              operasi_satuan,
                              operasi_nilai,
                              operasi_akumulatif,
                              operasi_status
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.operasi_jenis,
                              b.operasi_satuan,
                              b.operasi_nilai,
                              b.operasi_akumulatif,
                              b.operasi_status
                              
                            from 
                              $this->tabel4 as b 
                            left join 
                              $this->tabel5 as bx 
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

    function insert_detail_c($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel6, $data6);
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

    function insert_detail_cx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel7 
                            (
                              detail_id,
                              headerid,
                              stdtl,

                              operasi_jenis,
                              operasi_satuan,
                              operasi_nilai,
                              operasi_akumulatif,
                              operasi_status
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.operasi_jenis,
                              b.operasi_satuan,
                              b.operasi_nilai,
                              b.operasi_akumulatif,
                              b.operasi_status
                              
                            from 
                              $this->tabel6 as b 
                            left join 
                              $this->tabel7 as bx 
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

    function insert_detail_d($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel8, $data6);
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

    function insert_detail_dx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel9 
                            (
                              detail_id,
                              headerid,
                              stdtl,

                              stok_air_awal
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.stok_air_awal
                              
                            from 
                              $this->tabel8 as b 
                            left join 
                              $this->tabel9 as bx 
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

    function insert_detail_e($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel10, $data6);
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

    function insert_detail_ex($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel11 
                            (
                              detail_id,
                              headerid,
                              stdtl,

                              operasi_jenis,
                              operasi_satuan,
                              operasi_nilai,
                              operasi_akumulatif
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.operasi_jenis,
                              b.operasi_satuan,
                              b.operasi_nilai,
                              b.operasi_akumulatif
                              
                            from 
                              $this->tabel10 as b 
                            left join 
                              $this->tabel11 as bx 
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

    function insert_detail_f($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel12, $data6);
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

    function insert_detail_fx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel13 
                            (
                              detail_id,
                              headerid,
                              stdtl,
                              operasi_jenis,
                              operasi_nilai,
                              operasi_akumulatif,
                              operasi_satuan
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,
                              b.operasi_jenis,
                              b.operasi_nilai,
                              b.operasi_akumulatif,
                              b.operasi_satuan
                              
                            from 
                              $this->tabel12 as b 
                            left join 
                              $this->tabel13 as bx 
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

    function insert_detail_g($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel14, $data6);
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

    function insert_detail_gx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel15 
                            (
                              detail_id,
                              headerid,
                              stdtl,

                              stok_air_akhir_awal,
                              stok_air_akhir,
                              t_distribusi,
                              stok_air_awal,
                              total_proses
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.stok_air_akhir_awal,
                              b.stok_air_akhir,
                              b.t_distribusi,
                              b.stok_air_awal,
                              b.total_proses
                              
                            from 
                              $this->tabel14 as b 
                            left join 
                              $this->tabel15 as bx 
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

    function insert_detail_h($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel16, $data6);
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

    function insert_detail_hx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel17 
                            (
                              detail_id,
                              headerid,
                              stdtl,

                              drain_sedimen,
                              backwash_tanki,
                              cleaning_bak,
                              operasional
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.drain_sedimen,
                              b.backwash_tanki,
                              b.cleaning_bak,
                              b.operasional
                              
                            from 
                              $this->tabel16 as b 
                            left join 
                              $this->tabel17 as bx 
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

    function insert_detail_i($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel18, $data6);
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

    function insert_detail_ix($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel19 
                            (
                              detail_id,
                              headerid,
                              stdtl,

                              operasi_jenis,
                              operasi_nilai,
                              operasi_akumulatif,
                              operasi_stok,
                              operasi_effisiensi
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.operasi_jenis,
                              b.operasi_nilai,
                              b.operasi_akumulatif,
                              b.operasi_stok,
                              b.operasi_effisiensi
                              
                            from 
                              $this->tabel18 as b 
                            left join 
                              $this->tabel19 as bx 
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

    function insert_detail_j($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel20, $data6);
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

    function insert_detail_jx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel21 
                            (
                              detail_id,
                              headerid,
                              stdtl,

                              operasi_jenis,
                              target,
                              operasi_satuan
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.operasi_jenis,
                              b.target,
                              b.operasi_satuan
                              
                            from 
                              $this->tabel20 as b 
                            left join 
                              $this->tabel21 as bx 
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

    function insert_detail_k($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel22, $data6);
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

    function insert_detail_kx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel23 
                            (
                              detail_id,
                              headerid,
                              stdtl,

                              operasi_jenis,
                              operasi_nilai,
                              effisiensi,
                              operasi_akumulatif,
                              keterangan,
                              stock
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.operasi_jenis,
                              b.operasi_nilai,
                              b.effisiensi,
                              b.operasi_akumulatif,
                              b.keterangan,
                              b.stock
                              
                            from 
                              $this->tabel22 as b 
                            left join 
                              $this->tabel23 as bx 
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

    function insert_detail_l($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel24, $data6);
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

    function insert_detail_lx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel25 
                            (
                              detail_id,
                              headerid,
                              stdtl,

                              operasi_jenis,
                              operasi_nilai,
                              effisiensi,
                              operasi_akumulatif,
                              operasi_stok
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.operasi_jenis,
                              b.operasi_nilai,
                              b.effisiensi,
                              b.operasi_akumulatif,
                              b.operasi_stok
                              
                            from 
                              $this->tabel24 as b 
                            left join 
                              $this->tabel25 as bx 
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

    function insert_detail_m($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel26, $data6);
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

    function insert_detail_mx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel27 
                            (
                              detail_id,
                              headerid,
                              stdtl,

                              operasi_jenis,
                              operasi_nilai,
                              effisiensi,
                              operasi_akumulatif,
                              operasi_stok
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.operasi_jenis,
                              b.operasi_nilai,
                              b.effisiensi,
                              b.operasi_akumulatif,
                              b.operasi_stok
                              
                            from 
                              $this->tabel26 as b 
                            left join 
                              $this->tabel27 as bx 
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

    function insert_detail_n($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel28, $data6);
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

    function insert_detail_nx($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel29 
                            (
                              detail_id,
                              headerid,
                              stdtl,

                              operasi_jenis,
                              operasi_nilai,
                              operasi_akumulatif,
                              operasi_stok
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.operasi_jenis,
                              b.operasi_nilai,
                              b.operasi_akumulatif,
                              b.operasi_stok
                              
                            from 
                              $this->tabel28 as b 
                            left join 
                              $this->tabel29 as bx 
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

    function insert_detail_o($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel30, $data6);
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

    function insert_detail_ox($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel31 
                            (
                              detail_id,
                              headerid,
                              stdtl,

                              operasi_jenis,
                              operasi_produk,
                              operasi_jam,
                              operasi_satuan
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.operasi_jenis,
                              b.operasi_produk,
                              b.operasi_jam,
                              b.operasi_satuan
                              
                            from 
                              $this->tabel30 as b 
                            left join 
                              $this->tabel31 as bx 
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

    function insert_detail_p($data6)
    {
        $this->db1->trans_begin();
        $dtlid = $this->db1->insert($this->tabel32, $data6);
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

    function insert_detail_px($id)
    {
        $this->db1->trans_begin();
        $this->db1->query("insert into $this->tabel33 
                            (
                              detail_id,
                              headerid,
                              stdtl,

                              item,
                              ph,
                              turbidity,
                              colour,
                              ket
                            ) 
                            select 
                              b.detail_id,
                              b.headerid,
                              case when (b.stdtl)='0' then '1' else b.stdtl end as stdtl,

                              b.item,
                              b.ph,
                              b.turbidity,
                              b.colour,
                              b.ket
                              
                            from 
                              $this->tabel32 as b 
                            left join 
                              $this->tabel33 as bx 
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

    function update_dtl_b($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel4, $data6);
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

    function update_dtl_bx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel5, $data6);
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

    function update_dtl_c($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel6, $data6);
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

    function update_dtl_cx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel7, $data6);
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

    function update_dtl_d($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel8, $data6);
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

    function update_dtl_dx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel9, $data6);
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

    function update_dtl_e($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel10, $data6);
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

    function update_dtl_ex($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel11, $data6);
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

    function update_dtl_f($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel12, $data6);
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

    function update_dtl_fx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel13, $data6);
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

    function update_dtl_g($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel14, $data6);
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

    function update_dtl_gx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel15, $data6);
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

    function update_dtl_h($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel16, $data6);
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

    function update_dtl_hx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel17, $data6);
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

    function update_dtl_i($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel18, $data6);
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

    function update_dtl_ix($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel19, $data6);
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

    function update_dtl_j($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel20, $data6);
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

    function update_dtl_jx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel21, $data6);
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

    function update_dtl_k($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel22, $data6);
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

    function update_dtl_kx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel23, $data6);
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

    function update_dtl_l($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel24, $data6);
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

    function update_dtl_lx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel25, $data6);
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

    function update_dtl_m($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel26, $data6);
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

    function update_dtl_mx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel27, $data6);
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

    function update_dtl_n($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel28, $data6);
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

    function update_dtl_nx($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel29, $data6);
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

    function update_dtl_o($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel30, $data6);
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

    function update_dtl_ox($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel31, $data6);
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

    function update_dtl_p($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel32, $data6);
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

    function update_dtl_px($detail_id, $data6)
    {
        $this->db1->trans_begin();
        $this->db1->set($data6);
        $this->db1->where('detail_id', $detail_id);
        $this->db1->update($this->tabel33, $data6);
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

    function delete_detail_byheaderid_b($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel4);
        return $query1;
    }

    function delete_detail_byheaderid_bx($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel5);
        return $query2;
    }

    function delete_detail_byheaderid_c($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel6);
        return $query1;
    }

    function delete_detail_byheaderid_cx($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel7);
        return $query2;
    }

    function delete_detail_byheaderid_d($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel8);
        return $query1;
    }

    function delete_detail_byheaderid_dx($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel9);
        return $query2;
    }

    function delete_detail_byheaderid_e($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel10);
        return $query1;
    }

    function delete_detail_byheaderid_ex($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel11);
        return $query2;
    }

    function delete_detail_byheaderid_f($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel12);
        return $query1;
    }

    function delete_detail_byheaderid_fx($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel13);
        return $query2;
    }

    function delete_detail_byheaderid_g($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel14);
        return $query1;
    }

    function delete_detail_byheaderid_gx($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel15);
        return $query2;
    }

    function delete_detail_byheaderid_h($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel16);
        return $query1;
    }

    function delete_detail_byheaderid_hx($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel17);
        return $query2;
    }

    function delete_detail_byheaderid_i($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel18);
        return $query1;
    }

    function delete_detail_byheaderid_ix($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel19);
        return $query2;
    }

    function delete_detail_byheaderid_j($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel20);
        return $query1;
    }

    function delete_detail_byheaderid_jx($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel21);
        return $query2;
    }

    function delete_detail_byheaderid_k($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel22);
        return $query1;
    }

    function delete_detail_byheaderid_kx($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel23);
        return $query2;
    }

    function delete_detail_byheaderid_l($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel24);
        return $query1;
    }

    function delete_detail_byheaderid_lx($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel25);
        return $query2;
    }

    function delete_detail_byheaderid_m($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel26);
        return $query1;
    }

    function delete_detail_byheaderid_mx($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel27);
        return $query2;
    }

    function delete_detail_byheaderid_n($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel28);
        return $query1;
    }

    function delete_detail_byheaderid_nx($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel29);
        return $query2;
    }

    function delete_detail_byheaderid_o($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel30);
        return $query1;
    }

    function delete_detail_byheaderid_ox($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel31);
        return $query2;
    }

    function delete_detail_byheaderid_p($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query1 = $this->db1->delete($this->tabel32);
        return $query1;
    }

    function delete_detail_byheaderid_px($headerid)
    {
        $this->db1->where('headerid', $headerid);
        $query2 = $this->db1->delete($this->tabel33);
        return $query2;
    }

    function fn_update_frmfss317a($update_create_date)
    {
        $this->db1->trans_begin();
        $query = $this->db1->query("SELECT * FROM fn_update_frmfss317a('$update_create_date')");
        if ($this->db1->trans_status() == FALSE) {
            $this->db1->trans_rollback();
            $result = 0;
        } else {
            $this->db1->trans_commit();
            $result = 1;
        }
        return $result;
    }
}
