<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_surat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->token) {
            redirect(base_url('login'));
        }
        $this->load->model('M_surat', 'surat');
        $this->load->helper('download');
        $this->status = $this->uri->segment('2');
    }

    function surat($status)
    {
        $data = [
            'title' => "Surat - $status",
            'content' => "surat/list",
            'menu' => 'surat',
            'subMenu' => $status,
            'jenis' => $this->surat->getJenis(),
            'script' => 'surat'
        ];
        $this->load->view('template/main', $data);
    }

    function data()
    {
        error_reporting(0);
        $this->surat->status = $this->status;
        $list = $this->surat->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $idNa = $this->req->acak($field->id);
            if ($field->status == 'pending') {
                $btn = "
                    <button class='btn btn-success btn-xs' id='konfirmasi' data-id='$idNa'><i class='fas fa-check'></i> Konfirmasi</button>
                    <button class='btn btn-warning btn-xs' id='tolak' data-id='$idNa'><i class='fas fa-times-circle'></i> Tolak</button>
                ";
                $status = "<button class='btn btn-warning btn-xs'><i class='fas fa-clock'></i> Pending</button>";
            }
            if ($field->status == 'acc') {
                $btn ="";
                $status = "<button class='btn btn-info btn-xs'><i class='fas fa-info'></i> Diterima</button>";
            }
            if ($field->status == 'selesai') {
                $btn = "";
                $status = "<button class='btn btn-success btn-xs'><i class='fas fa-check'></i> Selesai</button>";
            }
            if ($field->status == 'ditolak') {
                $btn = "";
                $status = "<button class='btn btn-danger btn-xs'><i class='fas fa-times-circle'></i> Ditolak</button>";
            }
            if ($this->session->level == 1) {
                $button = "
                    $btn
                    <button class='btn btn-danger btn-xs' id='delete' data-id='$idNa'><i class='fas fa-trash-alt'></i> Hapus</button>
                ";
            } else {
                if ($field->status == 'selesai' || $field->status == 'acc') {
                    $button = "<button class='btn btn-success btn-xs' id='unduh' data-id='$idNa'><i class='fas fa-download'></i> Unduh Berkas</button>";
                } else {
                    $button = "-";
                }
            }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama;
            $row[] = $field->jenis;
            $row[] = $field->keterangan;
            $row[] = date_format(date_create($field->tgl),"Y-m-d H:i");
            $row[] = $status;
            $row[] = $button;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->surat->count_all(),
            "recordsFiltered" => $this->surat->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    function add_()
    {
        $data = $this->req->all(['id_user' => $this->session->userid]);
        if ($this->surat->insert($data) == true){
            echo json_encode([
                'status' => 'ok',
                'msg' => 'Berhasil Menambah Permintaan !'
            ]);
        } else {
            echo json_encode([
                'status' => 'fail',
                'msg' => 'Gagal Menambah Permintaan !'
            ]);
        }
    }

    function delete($id)
    {
        if ($this->surat->delete($this->req->id($id)) == true) {
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

    function action($status, $id)
    {
        if ($this->surat->update(['status' => $status], $this->req->id($id))) {
            echo json_encode([
                'status' => 'ok',
                'msg' => "Status berhasil diubah !"
            ]);
        } else {
            echo json_encode([
                'status' => 'fail',
                'msg' => "Status gagal diubah !"
            ]);
        }
    }

    function unduh($id)
    {
        $berkas = $this->surat->getDokumen($id);
        $this->surat->update(['status' => "selesai"], $this->req->id($id));
        force_download("uploads/dokumen/$berkas", NULL);
    }
}
