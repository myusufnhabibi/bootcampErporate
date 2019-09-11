<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perhitungan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Perhitungan_model', 'pm');
    }

    public function index()
    {
        $data['karyawan'] = $this->pm->get('tb_karyawan');
        $this->load->view('Perhitungan/index', $data);
    }

    public function get_data()
    {
        $list = $this->pm->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {

            if (isset($field->jam_kerja)) {
                $button = '<button disabled class="btn btn-sm btn-primary" title="Edit" onclick="ubah(' . "'" .             $field->id_kehadiran . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
                <button disabled class="btn btn-sm btn-success" onclick="hitung(' . "'" . $field->id_kehadiran . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Hitung</button>
              <button class="btn btn-sm btn-danger" title="Hapus" onclick="hapus(' . "'" . $field->id_kehadiran . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</button>';
            } else {
                $button = '<button class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="ubah(' . "'" .             $field->id_kehadiran . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
                <button class="btn btn-sm btn-success" href="javascript:void(0)" onclick="hitung(' . "'" . $field->id_kehadiran . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Hitung</button>
              <button class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus(' . "'" . $field->id_kehadiran . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</button>';
            }

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = @$button;
            $row[] = $field->nama_karyawan;
            $row[] = $field->tanggal;
            $row[] = $field->jam_datang;
            $row[] = $field->jam_pulang;
            $row[] = $field->jam_kerja;

            $data[] = $row;
        }

        $output = array(

            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->pm->count_all(),
            "recordsFiltered" => $this->pm->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function hitung($id)
    {
        $hasil = $this->pm->get_by_id($id);
        $selisih = $this->pm->selisih($id);
        $jam_kerja = substr($selisih->selisih, 0, 5);
        $data = "<h4>Perhitungan Jam Kerja Karyawan : <b>" . $hasil->nama_karyawan . "</b></h4>
                   Jam Datang : <b>" . $hasil->jam_datang . "</b> <br> 
                   Jam Jam Pulang : <b>" . $hasil->jam_pulang . "</b> <br>
                   Jam Kerja : " . $jam_kerja . " <br>
                   <form action='#' id='form'>
                   <input type='hidden' name='id' value='" . $hasil->id_kehadiran . "'>
                   <input type='hidden' name='jam_kerja' value='" . $jam_kerja . "'>
                   </form>
                   <button id='btnSave' class='btn btn-sm btn-warning mt-2' onclick='save()'>Simpan</button>
                ";

        $output = [
            'data' => $data
        ];
        echo json_encode($output);
    }


    public function tambah()
    {
        $this->_validate();
        $data = array(
            'id_karyawan' => $this->input->post('karyawan'),
            'tanggal' => $this->input->post('tanggal'),
            'jam_datang' => $this->input->post('jam_datang'),
            'jam_pulang' => $this->input->post('jam_pulang'),
            'jam_kerja' => null
        );
        $insert = $this->pm->simpan($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ubah($id)
    {
        $data = $this->pm->get_by_id($id);
        echo json_encode($data);
    }

    public function update()
    {
        $this->_validate();
        $data = array(
            'id_karyawan' => $this->input->post('karyawan'),
            'tanggal' => $this->input->post('tanggal'),
            'jam_datang' => $this->input->post('jam_datang'),
            'jam_pulang' => $this->input->post('jam_pulang'),
            'jam_kerja' => null
        );
        $this->pm->update(array('id_kehadiran' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function hapus($id)
    {
        $this->pm->hapus($id);
        echo json_encode(array("status" => TRUE));
    }

    public function simpan_jam()
    {
        $data['jam_kerja'] = $this->input->post('jam_kerja');
        $this->pm->simpan_jam(array('id_kehadiran' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('karyawan') == '') {
            $data['inputerror'][] = 'karyawan';
            $data['error_string'][] = 'karyawan harus diisi';
            $data['status'] = FALSE;
        }

        if ($this->input->post('tanggal') == '') {
            $data['inputerror'][] = 'tanggal';
            $data['error_string'][] = 'tanggal harus diisi';
            $data['status'] = FALSE;
        }

        if ($this->input->post('jam_datang') == '') {
            $data['inputerror'][] = 'jam_datang';
            $data['error_string'][] = 'Jam Datang harus diisi';
            $data['status'] = FALSE;
        }

        if ($this->input->post('jam_pulang') == '') {
            $data['inputerror'][] = 'jam_pulang';
            $data['error_string'][] = 'Jam Pulang harus diisi';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
