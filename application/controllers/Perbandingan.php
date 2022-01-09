<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class perbandingan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_perbandingan');
    }


    public function index()
    {
        $data['tfn'] = $this->Mod_perbandingan->getAll();

        $data['kriteria']=$this->db->get('kriteria')->result_array();
        if ($this->uri->segment(3) == "create-success") {
            $data['message'] = "<div class='alert alert-block alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <p><strong><i class='icon-ok'></i>Data</strong> Berhasil Disimpan...!</p></div>";
            $this->template->load('layoutbackend', 'perbandingan/perbandingan_data', $data);
        } else if ($this->uri->segment(3) == "update-success") {
            $data['message'] = "<div class='alert alert-block alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <p><strong><i class='icon-ok'></i>Data</strong> Berhasil Diubah...!</p></div>";
            $this->template->load('layoutbackend', 'perbandingan/perbandingan_data', $data);
        } else if ($this->uri->segment(3) == "delete-success") {
            $data['message'] = "<div class='alert alert-block alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <p><strong><i class='icon-ok'></i>Data</strong> Berhasil Dihapus...!</p></div>";
            $this->template->load('layoutbackend', 'perbandingan/perbandingan_data', $data);
        } else {
            $data['message'] = "";
            $this->template->load('layoutbackend', 'perbandingan/perbandingan_data', $data);
        }

    }

    public function create()
    {
        $data = array();
        $data['kriteria']=$this->db->get('kriteria')->result_array();
        $this->template->load('layoutbackend', 'perbandingan/perbandingan_create', $data);
    }

    public function insert()
    {
        $data['kriteria']=$this->db->get('kriteria')->result_array();
        //function validasi
        $this->_set_rules();

        //apabila user mengkosongkan form input
        if ($this->form_validation->run() == true) {
            $save = array(
                'nama_tfn' => $this->input->post('nama_tfn'),
                'id_kriteria_1' => $this->input->post('id_kriteria_1'),
                'id_kriteria_2' => $this->input->post('id_kriteria_2'),
                'nilai' => $this->input->post('nilai'),
            );
            $this->Mod_perbandingan->insertperbandingan("tfn", $save);
            // echo "berhasil"; die();
            redirect('perbandingan/index/create-success');
        } //jika tidak mengkosongkan form
        else {
            $data['message'] = "";
            $this->template->load('layoutbackend', 'perbandingan/perbandingan_create', $data);
        }
    }

    public function edit()
    {
        $id = $this->uri->segment(3);
        $data['kriteria']=$this->db->get('kriteria')->result_array();
        $data['edit'] = $this->Mod_perbandingan->cekperbandingan($id)->row_array();
        $this->template->load('layoutbackend', 'perbandingan/perbandingan_edit', $data);
    }

    public function update()
    {
        $data['kriteria']=$this->db->get('kriteria')->result_array();
        $this->_set_rules();

        //apabila user mengkosongkan form input
        if ($this->form_validation->run() == true) {

            $id = $this->input->post('id');

            $save = array(
                'id' => $this->input->post('id'),
                'nama_tfn' => $this->input->post('nama_tfn'),
                'id_kriteria_1' => $this->input->post('id_kriteria_1'),
                'id_kriteria_2' => $this->input->post('id_kriteria_2'),
                'nilai' => $this->input->post('nilai'),
            );

            $this->Mod_perbandingan->updateperbandingan($id, $save);
            redirect('perbandingan/index/update-success');

        } else {
            $data['message'] = "";
            $this->template->load('layoutbackend', 'barang/barang_edit', $data);
        }

    }

    function delete()
    {

        $id = $this->input->post('id');

        $this->Mod_perbandingan->deleteperbandingan($id, 'tfn');

        redirect('perbandingan/index/delete-success');
    }

//function global buat validasi input
    public
    function _set_rules()
    {
        $this->form_validation->set_rules('nama_tfn', 'Nama TFN', 'required|max_length[100]');
        $this->form_validation->set_rules('id_kriteria_1', 'Kriteria 1', 'required|max_length[50]');
        $this->form_validation->set_rules('id_kriteria_2', 'Kriteria 2', 'required|max_length[200]');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required|max_length[200]');
        $this->form_validation->set_message('required', '{field} kosong, silahkan diisi');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a>", "</div>");
    }

}

/* End of file barang.php */
