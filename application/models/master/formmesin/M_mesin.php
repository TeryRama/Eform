<?php
class M_mesin extends CI_Model
{

	var $tabel         = 'tblmstmesin';
	var $tableSection  = 'tblmstsection';
	var $tableTipe     = 'tblmsttipemesin';
	var $tableKomponen = 'tblmstkomponenmesin';

	function __construct()
	{
		parent::__construct();
		$CI = &get_instance();

		$this->db1 = $this->load->database('db1', TRUE);
	}


	function getmesin_records()
	{
		$this->db1->select('*');
		$this->db1->from($this->tabel);
		$this->db1->where('inactive', '0');
		$this->db1->order_by('mesin_id', 'asc');
		$this->db1->order_by('kode_mesin', 'asc');
		$query = $this->db1->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	function getsectionmesin_records()
	{
		$this->db1->select('*');
		$this->db1->from($this->tableSection);
		$this->db1->order_by('no_urut', 'asc');
		$query = $this->db1->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	function getkomponenmesin_records()
	{
		$this->db1->select('*');
		$this->db1->from($this->tableKomponen);
		$this->db1->order_by('nama_komponen', 'asc');
		$query = $this->db1->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	function gettipemesin_records()
	{
		$this->db1->select($this->tableSection . '.nama_section,' . $this->tableTipe . '.*');
		$this->db1->from($this->tableTipe);
		$this->db1->join($this->tableSection, $this->tableSection . '.section_id = ' . $this->tableTipe . '.section_id');
		$this->db1->order_by($this->tableTipe . '.no_urut', 'asc');
		$query = $this->db1->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	function get_mesin_byid($mesin_id)
	{
		$this->db1->from($this->tabel);
		$this->db1->where('mesin_id', $mesin_id);
		$this->db1->order_by("mesin_id", "asc");

		$query = $this->db1->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	function get_sectionmesin_byid($section_id)
	{
		$this->db1->from($this->tableSection);
		$this->db1->where('section_id', $section_id);
		$this->db1->order_by("section_id", "asc");

		$query = $this->db1->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	function get_komponenmesin_byid($komponen_id)
	{
		$this->db1->from($this->tableKomponen);
		$this->db1->where('komponen_id', $komponen_id);
		$this->db1->order_by("komponen_id", "asc");

		$query = $this->db1->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	function get_tipenmesin_byid($tipe_mesin_id)
	{
		$this->db1->from($this->tableTipe);
		$this->db1->where('tipe_mesin_id', $tipe_mesin_id);
		$this->db1->order_by("tipe_mesin_id", "asc");

		$query = $this->db1->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	function update_mesin($mesin_id, $data)
	{
		$this->db1->where('mesin_id', $mesin_id);
		$this->db1->update($this->tabel, $data);

		return TRUE;
	}

	function update_sectionmesin($section_id, $data)
	{
		$this->db1->where('section_id', $section_id);
		$this->db1->update($this->tableSection, $data);
		return TRUE;
	}

	function update_tipemesin($tipe_mesin_id, $data)
	{
		$this->db1->where('tipe_mesin_id', $tipe_mesin_id);
		$this->db1->update($this->tableTipe, $data);
		return TRUE;
	}

	function update_komponenmesin($komponen_id, $data)
	{
		$this->db1->where('komponen_id', $komponen_id);
		$this->db1->update($this->tableKomponen, $data);
		return TRUE;
	}

	function insert($data)
	{
		$this->db1->insert($this->tabel, $data);
		return TRUE;
	}

	function insertSection($data)
	{
		$this->db1->insert($this->tableSection, $data);
		return TRUE;
	}

	function insert_tipe($data)
	{
		$this->db1->insert($this->tableTipe, $data);
		return TRUE;
	}

	function insert_komponen($data)
	{
		$this->db1->insert($this->tableKomponen, $data);
		return TRUE;
	}
}
