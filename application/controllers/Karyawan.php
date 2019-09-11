<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Karyawan_model', 'km');
    }

    public function index()
    {
        $this->load->view('karyawan');
    }

    public function get_data_karyawan()
    {
        $list = $this->km->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="ubah(' . "'" . $field->id_karyawan . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus(' . "'" . $field->id_karyawan . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            $row[] = $field->nama_karyawan;
            $row[] = $field->jenis_kelamin == 'pria' ? 'Pria' : 'Wanita';
            $row[] = $field->jabatan;
            $row[] = $field->no_hp;
            $row[] = $field->alamat;

            $data[] = $row;
        }

        $output = array(

            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->km->count_all(),
            "recordsFiltered" => $this->km->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function tambah()
    {
        $this->_validate();
        $data = array(
            'nama_karyawan' => $this->input->post('nama'),
            'jenis_kelamin' => $this->input->post('jenis'),
            'jabatan' => $this->input->post('jabatan'),
            'no_hp' => $this->input->post('no_hp'),
            'alamat' => $this->input->post('alamat'),
        );
        $insert = $this->km->simpan($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ubah($id)
    {
        $data = $this->km->get_by_id($id);
        echo json_encode($data);
    }

    public function update()
    {
        $this->_validate();
        $data = array(
            'nama_karyawan' => $this->input->post('nama'),
            'jenis_kelamin' => $this->input->post('jenis'),
            'jabatan' => $this->input->post('jabatan'),
            'no_hp' => $this->input->post('no_hp'),
            'alamat' => $this->input->post('alamat'),
        );
        $this->km->update(array('id_karyawan' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function hapus($id)
    {
        $this->km->hapus($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nama') == '') {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama harus diisi';
            $data['status'] = FALSE;
        }

        if ($this->input->post('jabatan') == '') {
            $data['inputerror'][] = 'jabatan';
            $data['error_string'][] = 'Jabatan harus diisi';
            $data['status'] = FALSE;
        }

        if ($this->input->post('no_hp') == '') {
            $data['inputerror'][] = 'no_hp';
            $data['error_string'][] = 'No HP harus diisi';
            $data['status'] = FALSE;
        }

        if ($this->input->post('jenis') == '') {
            $data['inputerror'][] = 'jenis';
            $data['error_string'][] = 'Silahkan pilih jenis kelamin';
            $data['status'] = FALSE;
        }

        if ($this->input->post('alamat') == '') {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Alamat harus diisi';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
