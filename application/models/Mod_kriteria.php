<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_kriteria extends CI_Model {

    function getAll()
    {
        $this->db->order_by('kriteria.id_kriteria desc');
        return $this->db->get('kriteria');
    }

    function cekNamaKriteria($nama_kriteria)
    {
        $this->db->where("kriteria",$nama_kriteria);
        return $this->db->get("kriteria");
    }

    function insertKriteria($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function getKriteria($id_kriteria)
    {
        $this->db->where("id_kriteria", $id_kriteria);
        return $this->db->get("kriteria");
    }

    function updateKriteria($id_kriteria, $data)
    {
        $this->db->where('id_kriteria', $id_kriteria);
		$this->db->update('kriteria', $data);
    }
    

    function deleteKriteria($id, $table)
    {
        $this->db->where('id_kriteria', $id);
        $this->db->delete($table);
    }

    function totalRows($table)
	{
		return $this->db->count_all_results($table);
    }
}

/* End of file Mod_users.php */