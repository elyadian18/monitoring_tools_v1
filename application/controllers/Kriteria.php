<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_kriteria');
    }


    public function index()
    {
        $data['kriteria'] = $this->Mod_kriteria->getAll()->result();

        if($this->uri->segment(3)=="create-success") {
            $data['message'] = "<div class='alert alert-block alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <p><strong><i class='icon-ok'></i>Data</strong> Berhasil Disimpan...!</p></div>";    
            $this->template->load('layoutbackend', 'kriteria/kriteria_data', $data);
        }
        else if($this->uri->segment(3)=="update-success"){
            $data['message'] = "<div class='alert alert-block alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <p><strong><i class='icon-ok'></i>Data</strong> Berhasil Diperbarui...!</p></div>"; 
            $this->template->load('layoutbackend', 'kriteria/kriteria_data', $data);
        }
        else if($this->uri->segment(3)=="delete-success"){
            $data['message'] = "<div class='alert alert-block alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <p><strong><i class='icon-ok'></i>Data</strong> Berhasil Dihapus...!</p></div>"; 
            $this->template->load('layoutbackend', 'kriteria/kriteria_data', $data);
        }
        else{
            $this->template->load('layoutbackend', 'kriteria/kriteria_data', $data);
        }

       
    }

    public function create()
    {
        $this->template->load('layoutbackend', 'kriteria/kriteria_create');
    }

    public function insert()
    {
        if(isset($_POST['save'])) {
        
            //function validasi
            $this->_set_rules();

            //apabila users mengisi form
            if($this->form_validation->run()==true){
                $kriteria = $this->input->post('kriteria');
                $cek = $this->Mod_kriteria->cekNamaKriteria($kriteria);
                //cek nis yg sudah digunakan
                if($cek->num_rows() > 0){
                    $data['message'] = "<div class='alert alert-block alert-danger'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <p><strong><i class='icon-ok'></i>Nama Kriteria</strong> Sudah Digunakan...!</p></div>";
                    $this->template->load('layoutbackend', 'kriteria/kriteria_create', $data);
                }
                //kalo blm digunakan lakukan insert data kedatabase
                else{
                    
                    $save  = array(
                        'kriteria'   => $this->input->post('kriteria'),
                        'atribut'  => $this->input->post('atribut'),
                        'kode'  => $this->input->post('kode')
                    );
                    $this->Mod_kriteria->insertKriteria("kriteria", $save);
                    // echo "berhasil"; die();
                    redirect('kriteria/index/create-success');
                }
            }
            //jika users mengkosongkan form input
            else{
                $this->template->load('layoutbackend', 'kriteria/kriteria_create');
            } 

        } //end $_POST['save']
    }

    public function edit($id)
    {
         
        $data['edit']    = $this->Mod_kriteria->getKriteria($id)->row_array();
        // $data['karyawan'] =  $this->Mod_karyawan->getAll()->result_array();
        // print_r($data['edit']); die();
        $this->template->load('layoutbackend', 'kriteria/kriteria_edit', $data);
    }

    public function update()
    {
        if(isset($_POST['update'])) {
        
            $this->_set_rules();

            //apabila user apabila user mengisi form input
            if($this->form_validation->run()==true){

                // //apabila password diganti
                 if($this->input->post('kriteria') != "") {
                //     $id_kriteria      = $this->input->post('id_kriteria');
                    
                //     $save  = array(
                //         'id_kriteria' => $this->input->post('id_kriteria'),
                //         'nama_kriteria'   => $this->input->post('nama_kriteria'),
                //         'deskripsi'   => ($this->input->post('deskripsi')
                //     );
                //     $this->Mod_kriteria->updatekriteria($id_kriteria, $save);
                //     // echo "berhasil"; die();
                //     redirect('kriteria/index/update-success');

                //jika password tidak diganit    
                //}
                    $id_kriteria      = $this->input->post('id_kriteria');
                    
                    $save  = array(
                        'id_kriteria' => $this->input->post('id_kriteria'),
                        'kriteria'   => $this->input->post('kriteria'),
                        'atribut'  => $this->input->post('atribut'),
                        'kode'  => $this->input->post('kode'),
                    );
                    $this->Mod_kriteria->updateKriteria($id_kriteria, $save);
                    // echo "berhasil"; die();
                    redirect('kriteria/index/update-success');
                }
                
                
                 

            }
            //jika mengkosongkan
            else{
                $id_kriteria      = $this->input->post('id_kriteria');
                $data['edit']    = $this->Mod_kriteria->getKriteria($id_kriteria)->row_array();
                $this->template->load('layoutbackend', 'kriteria/kriteria_edit', $data);
            }
        
        }
    }

    public function delete()
    {
        $id_kriteria = $this->input->post('id_kriteria');

        $this->Mod_kriteria->deleteKriteria($id_kriteria, 'kriteria');
        // echo "berhasil"; die();
        redirect('kriteria/index/delete-success');
    }

    public function _set_rules(){
        $this->form_validation->set_rules('kriteria','Nama Kriteria','required|trim');
        $this->form_validation->set_rules('atribut','Atribut','required|trim');
        $this->form_validation->set_rules('kode','Kode','required|trim');
        $this->form_validation->set_message('required', '{field} kosong, silahkan diisi');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a>","</div>");
    }

}

/* End of file Users.php */
