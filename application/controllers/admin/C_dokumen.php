<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_dokumen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->token) {
            redirect(base_url('login'));
        }
        $this->load->model('M_dokumen', 'dokumen');
    }

    function data()
    {
        error_reporting(0);
        $list = $this->dokumen->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $idNa = $this->req->acak($field->id);
            $button = "
                <button class='btn btn-danger btn-xs' id='delete' data-id='$idNa'><i class='fas fa-trash-alt'></i></button>
                <button class='btn btn-warning btn-xs' id='edit' data-id='$idNa'><i class='fas fa-pencil-alt'></i></button>
            ";
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama;
            $row[] = $field->file;
            $row[] = $button;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->dokumen->count_all(),
            "recordsFiltered" => $this->dokumen->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    function index()
    {
        $data = [
            'title' => "Dokumen",
            'content' => 'dokumen/list',
            'menu' => 'master',
            'subMenu' => 'dokumen',
            'script' => 'dokumen'
        ];
        $this->load->view('template/main', $data);
    }

    function get($id)
    {
        $data = $this->dokumen->get($id);
        foreach ($data as $key => $value) {
            if (strtolower($key) == 'id') {
                $data->$key = $this->req->acak($value);
            }
        }
        echo json_encode($data);
    }

    function insert()
    {
        $config = [
            'file' => 'file',
            'type' => 'doc',
            'fileName' => time() . "-" . $this->req->input('nama'),
            'path' => 'dokumen',
        ];
        $data = $this->req->upload_form($config);
        if ($this->dokumen->insert($data) == true) {
            echo json_encode([
                'status' => 'ok',
                'msg' => 'Berhasil Menambahkan Data !'
            ]);
        } else {
            echo json_encode([
                'status' => 'fail',
                'msg' => 'Gagal Menambahkan Data !'
            ]);
        }
    }

    function update()
    {
        $id = $this->input->post('id');
        $data = $this->req->all(['id' => false]);
        if ($this->dokumen->update($data, $this->req->id($id)) == true) {
            $msg = array(
                'status' => 'ok',
                'msg' => 'Berhasil mengubah data !'
            );
        } else {
            $msg = array(
                'status' => 'fail',
                'msg' => 'Gagal mengubah data !'
            );
        }
        echo json_encode($msg);
    }

    function delete($id)
    {
        if ($this->dokumen->delete($this->req->id($id)) == true) {
            $msg = array(
                'status' => 'ok',
                'msg' => 'Berhasil menghapus data !'
            );
        } else {
            $msg = array(
                'status' => 'fail',
                'msg' => 'Gagal menghapus data !'
            );
        }
        echo json_encode($msg);
    }
}
