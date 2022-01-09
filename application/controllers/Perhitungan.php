<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perhitungan extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        //$this->load->model(array('Mod_laporan','Mod_barang','Mod_karyawan'));
    }


    public function hasil()
    {
        $input = array();
        $key_tfn = 0;
        $this->db->order_by('kode asc');
        foreach($this->db->get('kriteria')->result() as $key=>$row) {
            $this->db->where("id_kriteria_1", $row->id_kriteria);
            $this->db->order_by('nama_tfn asc');
            $key_tfn = $key+1;
            foreach ($this->db->get('tfn')->result() as $key1 => $row1) {
                $input[$key][$key_tfn++] = $row1->nilai;
            }
        }
/*        print_r($input);die;
        $input[0]=array(1=>-1,2=>4,3=>2);
        $input[1]=array(2=>-2,3=>1);
        $input[2]=array(3=>6);*/
        for ($baris = 0; $baris < count($input) + 1; $baris++) {
            for ($kolom = 0; $kolom < count($input) + 1; $kolom++) {
                if ($baris < $kolom) {
                    $data[$baris][$kolom] = $input[$baris][$kolom];
                } elseif ($baris == $kolom) {
                    $data[$baris][$kolom] = 0;
                } elseif ($baris > $kolom) {
                    $data[$baris][$kolom] = -$input[$kolom][$baris];
                }
            }
        }

        $tfn_fuzzyahp = [
            -8 => [2 / 9, 2 / 9, 2 / 8],
            -7 => [2 / 9, 2 / 8, 2 / 7],
            -6 => [2 / 8, 2 / 7, 2 / 6],
            -5 => [2 / 7, 2 / 6, 2 / 5],
            -4 => [2 / 6, 2 / 5, 2 / 4],
            -3 => [2 / 5, 2 / 4, 2 / 3],
            -2 => [2 / 4, 2 / 3, 2 / 2],
            -1 => [2 / 3, 2 / 2, 2 / 1],
            0 => [1, 1, 1],
            1 => [1 / 2, 2 / 2, 3 / 2],
            2 => [2 / 2, 3 / 2, 4 / 2],
            3 => [3 / 2, 4 / 2, 5 / 2],
            4 => [4 / 2, 5 / 2, 6 / 2],
            5 => [5 / 2, 6 / 2, 7 / 2],
            6 => [6 / 2, 7 / 2, 8 / 2],
            7 => [7 / 2, 8 / 2, 9 / 2],
            8 => [8 / 2, 9 / 2, 9 / 2],
        ];
        for ($baris = 0; $baris < count($data); $baris++) {
            for ($kolom = 0; $kolom < count($data); $kolom++) {
                $data_tfn[$baris][$kolom] = $tfn_fuzzyahp[$data[$baris][$kolom]];
            }
        }

        for ($baris = 0; $baris < count($data_tfn); $baris++) {
            $lmu[$baris][0] = array_sum(array_column($data_tfn[$baris], 0));
            $lmu[$baris][1] = array_sum(array_column($data_tfn[$baris], 1));
            $lmu[$baris][2] = array_sum(array_column($data_tfn[$baris], 2));
        }

        $total_lmu[0] = array_sum(array_column($lmu, 0));
        $total_lmu[1] = array_sum(array_column($lmu, 1));
        $total_lmu[2] = array_sum(array_column($lmu, 2));

        for ($baris = 0; $baris < count($lmu); $baris++) {
            $Si[$baris][0] = $lmu[$baris][0] / $total_lmu[2];
            $Si[$baris][1] = $lmu[$baris][1] / $total_lmu[1];
            $Si[$baris][2] = $lmu[$baris][2] / $total_lmu[0];
        }

        for ($baris = 0; $baris < count($Si); $baris++) {
            for ($kolom = 0; $kolom < count($Si); $kolom++) {
               // echo $Si[$kolom][0]." >= ".$Si[$baris][1];
                if ($Si[$baris][1] >= $Si[$kolom][1]) {
                    $V[$baris][$kolom] = 1;
                } elseif ($Si[$kolom][0] >= $Si[$baris][1]) {

                    $V[$baris][$kolom] = 0;
                } else {
                    $V[$baris][$kolom] = ($Si[$kolom][0] - $Si[$baris][2]) / (($Si[$baris][1] - $Si[$baris][2]) - ($Si[$kolom][1] - $Si[$kolom][0]));
                }
              //  echo " ====".$V[$baris][$kolom]."<br />";
            }
        }

        for ($baris = 0; $baris < count($V); $baris++) {
            $dfuzz[$baris] = min($V[$baris]);
        }
        for ($baris = 0; $baris < count($dfuzz); $baris++) {
            $W[$baris] = $dfuzz[$baris] / array_sum($dfuzz);
        }
        $kriteria = array();
        $this->db->order_by('kode asc');
        foreach($this->db->get('kriteria')->result() as $row) {
            $kriteria[] = array("nama"=>$row->kriteria,"atribut"=>$row->atribut);
        }
        /*print_r($kriteria);die;
        $kriteria = [
            ['nama' => 'harga', 'atribut' => 'biaya'],
            ['nama' => 'tipe_tools', 'atribut' => 'keuntungan'],
            ['nama' => 'jumlah', 'atribut' => 'biaya'],
            ['nama' => 'kebutuhan', 'atribut' => 'keuntungan'],
        ];*/
        $databarang =$this->db->get('barang')->result();
 /*       $datarumah[0]=(object) array("id_rumah"=>"1",
            "desc"=>"Print Label (Tape Cartridge Refill)",
            "harga"=>"128800",
            "tipe_tools" =>"1",
            "jumlah" => "6",
            "kebutuhan" =>"9"
        );
        $datarumah[1]=(object) array(
            "id_rumah"=>"2",
            "desc"=>"Kyoritsu 2046R Digital Clamp Meter Digital Tang Ampere AC/DC 2046 R",
            "harga"=>"2535000",
            "tipe_tools" =>"0",
            "jumlah" => "3",
            "kebutuhan" =>"5"
        );
        $datarumah[2]=(object) array(
            "id_rumah"=>"3",
            "desc"=>"Patchcord SC-LC 10 meter duplek singlemode",
            "harga"=>"17600000",
            "tipe_tools" =>"1",
            "jumlah" => "12",
            "kebutuhan" =>"8"
        );
        $datarumah[3]=(object) array(
            "id_rumah"=>"4",
            "desc"=>"Kabel ATEN UC-232A Usb To Serial (DB 9 pin/rs 232)",
            "harga"=>"208900",
            "tipe_tools" =>"0",
            "jumlah" => "4",
            "kebutuhan" =>"7"
        );*/
        $data_max_min = array();
        for ($baris = 0; $baris < count($databarang); $baris++) {
            for ($kolom = 0; $kolom < count($kriteria); $kolom++) {
                $max = max(array_map(function ($barang) use ($kriteria, $kolom) {
                    return $barang->{$kriteria[$kolom]['nama']};
                }, $databarang));
                $data_max_min["max"][$kolom]= "Nilai Max = ".$max;

                $min = min(array_map(function ($barang) use ($kriteria, $kolom) {
                    return $barang->{$kriteria[$kolom]['nama']};
                }, $databarang));
                $data_max_min["min"][$kolom]= "Nilai Min = ".$min;
                if ($kriteria[$kolom]['atribut'] == 'biaya') {
                    $w_krit[$baris][$kolom] = ($max - $databarang[$baris]->{$kriteria[$kolom]['nama']}) /($max - $min);
                } elseif ($kriteria[$kolom]['atribut'] ==
                    'keuntungan') {
                    $w_krit[$baris][$kolom] = ($databarang[$baris]->{$kriteria[$kolom]['nama']} - $min) /
                        ($max - $min);
                }
            }
        }

        for ($baris = 0; $baris < count($w_krit); $baris++) {
            for ($kolom = 0; $kolom < count($w_krit[$baris]); $kolom++) {
                $w_total_krit[$baris][$kolom] = $w_krit[$baris][$kolom] / array_sum(array_column($w_krit, $kolom));
            }
        }

        for ($baris = 0; $baris < count($databarang); $baris++) {
            $skor[$baris] = 0;
            for ($kolom = 0; $kolom < count($W); $kolom++) {
                $skor[$baris]+=$w_total_krit[$baris][$kolom] * $W[$kolom];
            }
            $databarang[$baris]->skor_akhir =$skor[$baris];
        }
        $databarang_hasil = $databarang;
       /* $crumah_hasilspk[0]=array("id_rumah"=>"1",
            "desc"=>"Print Label (Tape Cartridge Refill)",
            "harga"=>"128800",
            "tipe_tools" =>"1",
            "jumlah" => "6",
            "kebutuhan" =>"9",
            "skor_akhir"=>$skor[0]
        );
        $crumah_hasilspk[1]= array(
            "id_rumah"=>"2",
            "desc"=>"Kyoritsu 2046R Digital Clamp Meter Digital Tang Ampere AC/DC 2046 R",
            "harga"=>"2535000",
            "tipe_tools" =>"0",
            "jumlah" => "3",
            "kebutuhan" =>"5",
            "skor_akhir"=>$skor[1]
        );
        $crumah_hasilspk[2]= array(
            "id_rumah"=>"3",
            "desc"=>"Patchcord SC-LC 10 meter duplek singlemode",
            "harga"=>"17600000",
            "tipe_tools" =>"1",
            "jumlah" => "12",
            "kebutuhan" =>"8",
            "skor_akhir"=>$skor[2]
        );
        $crumah_hasilspk[3]= array(
            "id_rumah"=>"4",
            "desc"=>"Kabel ATEN UC-232A Usb To Serial (DB 9 pin/rs 232)",
            "harga"=>"208900",
            "tipe_tools" =>"0",
            "jumlah" => "4",
            "kebutuhan" =>"7",
            "skor_akhir"=>$skor[3]
        );*/

        function urut($a, $b) {
            if ($a->skor_akhir < $b->skor_akhir) {
                return 1;
            } elseif ($a->skor_akhir > $b->skor_akhir) {
                return -1;
            } else {
                return 0;
            }
        }
        uasort($databarang_hasil, 'urut');
       /* echo "<pre>";
        print_r($crumah_hasilspk);
        echo "</pre>";die;*/
        $data = array("databarang_hasil"=>$databarang_hasil);
        $this->template->load('layoutbackend', 'perhitungan/hasil', $data);

    }

}
