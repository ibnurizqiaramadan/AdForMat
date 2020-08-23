<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_user extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->token || $this->session->level != 1) {
            redirect(base_url('login'));
        }
        $this->load->model('M_user', 'user');
    }

    function data()
    {
        error_reporting(0);
        $list = $this->user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $idNa = $this->req->acak($field->id);
            $level = ($field->level == '1') ? 'Admin' : 'User';
            // $idNa = $field->id;
            $button = "
                <button class='btn btn-danger btn-xs' id='delete' data-id='$idNa'><i class='fas fa-trash-alt'></i></button>
                <button class='btn btn-warning btn-xs' id='edit' data-id='$idNa'><i class='fas fa-pencil-alt'></i></button>
                <button class='btn btn-info btn-xs' id='reset' data-id='$idNa'><i class='fas fa-sync-alt'></i></button>
            ";
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->username;
            $row[] = $field->nama;
            $row[] = $level;
            $row[] = $field->jur;
            $row[] = $button;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->user->count_all(),
            "recordsFiltered" => $this->user->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    function index()
    {
        $data = [
            'title' => "Users",
            'content' => 'user/list',
            'menu' => 'master',
            'subMenu' => 'user',
            'script' => 'user'
        ];
        $this->load->view('template/main', $data);
    }

    function get($id)
    {
        $data = $this->user->get($id);
        foreach ($data as $key => $value) {
            if (strtolower($key) == 'id') {
                $data->$key = $this->req->acak($value);
            }
        }
        echo json_encode($data);
    }

    function insert()
    {
        $data = $this->req->all(['password' => $this->req->acak($this->req->input('username'))]);
        if ($this->user->insert($data) == true) {
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
        if ($this->user->update($data, $this->req->id($id)) == true) {
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
        if ($this->user->delete($this->req->id($id)) == true) {
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


?>