<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_perbandingan extends CI_Model {

    private $table   = "tfn";
    private $primary = "id";

    function searchBarang($cari, $limit, $offset)
    {
        $this->db->like($this->primary,$cari);
        $this->db->or_like("nama_tfn",$cari);
        $this->db->limit($limit, $offset);
        return $this->db->get($this->table);
    }

    function getAll()
    {
        $this->db->order_by('nama_tfn asc');
        return $this->db->get('tfn');
    }
    function cekPerbandingan($kode)
    {
        $this->db->where("id", $kode);
        return $this->db->get("tfn");
    }
    function totalRows($table)
	{
		return $this->db->count_all_results($table);
    }


    function insertPerbandingan($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function updatePerbandingan($kode, $data)
    {
        $this->db->where('id', $kode);
		$this->db->update('tfn', $data);
    }

    function deletePerbandingan($kode, $table)
    {
        $this->db->where('id', $kode);
        $this->db->delete($table);
    }

}

/* End of file ModelName.php */
