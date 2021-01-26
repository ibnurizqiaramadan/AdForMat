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
            if ($field->status == 'selesai-system') {
                $btn = "";
                $status = "<button class='btn btn-success btn-xs'><i class='fas fa-check'></i> Selesai (System)</button>";
            }
            if ($field->status == 'ditolak') {
                $btn = "";
                $status = "<button class='btn btn-danger btn-xs'><i class='fas fa-times-circle'></i> Ditolak</button>";
            }
            if ($field->status == 'acc-system') {
                $btn = "";
                $status = "<button class='btn btn-info btn-xs'><i class='fas fa-info'></i> Diterima (System)</button>";
            }
            if ($this->session->level == 1) {
                $button = "
                    $btn
                    <button class='btn btn-danger btn-xs' id='delete' data-id='$idNa'><i class='fas fa-trash-alt'></i> Hapus</button>
                ";
            } else {
                if ($field->status == 'selesai' || $field->status == 'selesai-system' || $field->status == 'acc' || $field->status == 'acc-system') {
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
        if ($this->surat->cekKataKunci() == true) {
            $data = [
                'id_user' => $this->session->userid, 
                'status' => 'acc-system',
                'keterangan' => $this->req->input('keterangan'),
                'id_jenis' => $this->req->input('id_jenis')
            ];
        } else {
            $data = [
                'id_user' => $this->session->userid,
                'keterangan' => $this->req->input('keterangan'),
                'id_jenis' => $this->req->input('id_jenis')
            ];
        }   
        

        // $data = $this->req->all($custom);
        if ($this->surat->insert($data) == true){
            $formData = [];

            $data_ = $this->getSuratArray($this->req->input('id_jenis'));

            $this->db->from('t_permintaan');
            $this->db->order_by('id', 'DESC');
            $permintaan = $this->db->get()->row();

            // $this->req->print($data_);

            foreach ($data_ as $key) {
                $formData[] = [
                    'id_permintaan' => $permintaan->id,
                    'field' => "$key[type]-$key[name]",
                    'value' => $this->req->input($key['name'])
                ];
            }

            $this->db->insert_batch('t_form_data', $formData);
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
        $acc = $this->surat->getAcc($id);
        // $this->req->query();
        // echo $acc->status;
        if ($acc->status == 'acc' || $acc->status == "selesai") {
            $status = "selesai";
        } else {
            $status = "selesai-system";
        }
        $this->surat->update(['status' => $status], $this->req->id($id));
        $surat = $this->db->get_where('t_dokumen', ['id' => $acc->id_jenis])->row();
        // echo $id;
        $myfile = fopen("./uploads/surat/$surat->file", "r") or die("Unable to open file!");
        $html = fread($myfile, filesize("./uploads/surat/$surat->file"));
        $ada = 0;
        $baca = false;
        $variable = "";
        for ($i = 0; $i < strlen($html); $i++) {
            if ($html[$i] == "{" && $html[$i + 1] == "{") {
                $baca = true;
                $i++;
            }
            if ($html[$i] == "}" && $html[$i + 1] == "}") {
                $baca = false;
                $variable .= ",";
            }
            if ($baca == true) {
                $no = $i + 1;
                $variable .= substr($html[$no], 0, strlen($html[$no]));
            }
        }
        $result = str_replace("}", "", $variable);
        $vars = explode(",", $result);
        $resultInput = [];
        foreach ($vars as $key) {
            if ($key != "") {
                $input = explode("-", trim($key));
                if (trim($input[1]) == "NIM") {
                    $value = $this->session->username;
                } else if (trim($input[1]) == "NAMA") {
                    $value = $this->session->nama;
                } else if (trim($input[1]) == "JURUSAN") {
                    $value = $this->session->jur;
                } else {
                    $value = "";
                }
                $resultInput[] = [
                    // 'type' => trim($input[0]),
                    'name' => trim($input[1]),
                    // 'value' => $value,
                    // 'ro' => $value != "" ? 'readonly' : ''
                ];
            }
        }
        fclose($myfile);

        $html = str_replace(['{{', '}}'], ['', ''], $html);
        
        $this->db->where($this->req->encKey('id_permintaan'), $id);
        $formData = $this->db->get('t_form_data')->result();
        // $this->req->print($formData);
        // print_r($formData);
        


        foreach ($formData as $key) {
            $html = str_replace($key->field, $key->value, $html);
        }

        // print_r($surat);
        // echo json_encode($resultInput);
        $this->load->view('surat/header', ['html' => $html]);
        // force_download("uploads/dokumen/$berkas", NULL);
    }

    function getNotif()
    {
        $this->db->select('per.id,pen.nama as nama,doc.nama as jenis,keterangan,not.status,tgl');
        $this->db->from('t_permintaan as per');
        $this->db->join('t_pengguna as pen', "per.id_user = pen.id", 'left');
        $this->db->join('t_dokumen as doc', "per.id_jenis = doc.id", 'left');
        $this->db->join('t_notif as not', "not.id_permintaan = per.id", 'left');
        $this->db->where('not.status', '1');
        $data = $this->db->get()->result();
        echo json_encode($data);
    }

    function getSurat($id)
    {
        $surat = $this->db->get_where('t_dokumen', ['id' => $id])->row();
        $myfile = fopen("./uploads/surat/$surat->file", "r") or die("Unable to open file!");
        $html = fread($myfile, filesize("./uploads/surat/$surat->file"));
        $baca = false;
        $variable = "";
        for ($i=0; $i < strlen($html); $i++) { 
            if ($html[$i] == "{" && $html[$i+1] == "{") {
                $baca = true;
                $i++;
            }
            if ($html[$i] == "}" && $html[$i + 1] == "}") {
                $baca = false;
                $variable .= ",";
            }
            if ($baca == true) {
                $no = $i+1;
                $variable .= substr($html[$no], 0, strlen($html[$no]));
            }
        }
        $result = str_replace("}", "", $variable);
        $vars = explode(",", $result);
        $resultInput = [];
        foreach ($vars as $key) {
            if ($key != "") {
                $input = explode("-", trim($key));
                if (trim($input[1]) == "NIM") {
                    $value = $this->session->username;
                } else if (trim($input[1]) == "NAMA") {
                    $value = $this->session->nama;
                } else if (trim($input[1]) == "JURUSAN") {
                    $value = $this->session->jur;
                } else if (trim($input[1]) == "KODE_SURAT") {
                    $value = $surat->kode;
                } else if (trim($input[1]) == "JUDUL_SURAT") {
                    $value = $surat->nama;
                } else {
                    $value = "";
                }
                $resultInput[] = [
                    'type' => trim($input[0]),
                    'name' => trim($input[1]),
                    'value' => $value,
                    'ro' => $value != "" ? 'readonly' : ''
                ];
            }
        }
        fclose($myfile);
        echo json_encode($resultInput);
    }

    function getSuratArray($id)
    {
        $surat = $this->db->get_where('t_dokumen', ['id' => $id])->row();
        $myfile = fopen("./uploads/surat/$surat->file", "r") or die("Unable to open file!");
        $html = fread($myfile, filesize("./uploads/surat/$surat->file"));
        $ada = 0;
        $baca = false;
        $variable = "";
        for ($i = 0; $i < strlen($html); $i++) {
            if ($html[$i] == "{" && $html[$i + 1] == "{") {
                $baca = true;
                $i++;
            }
            if ($html[$i] == "}" && $html[$i + 1] == "}") {
                $baca = false;
                $variable .= ",";
            }
            if ($baca == true) {
                $no = $i + 1;
                $variable .= substr($html[$no], 0, strlen($html[$no]));
            }
        }
        $result = str_replace("}", "", $variable);
        $vars = explode(",", $result);
        $resultInput = [];
        // $this->req->print($surat);
        foreach ($vars as $key) {
            if ($key != "") {
                $input = explode("-", trim($key));
                if (trim($input[1]) == "NIM") {
                    $value = $this->session->username;
                } else if (trim($input[1]) == "NAMA") {
                    $value = $this->session->nama;
                } else if (trim($input[1]) == "JURUSAN") {
                    $value = $this->session->jur;
                } else if (trim($input[1]) == "KODE_SURAT") {
                    $value = $surat->kode;
                } else if (trim($input[1]) == "JUDUL_SURAT ") {
                    $value = $surat->nama;
                } else {
                    $value = "";
                }
                $resultInput[] = [
                    'type' => trim($input[0]),
                    'name' => trim($input[1]),
                    'value' => $value,
                    'ro' => $value != "" ? 'readonly' : ''
                ];
            }
        }
        fclose($myfile);
        // print_r($surat);
        // echo json_encode($resultInput);
        return $resultInput;
    }

    function testSurat()
    {
        $this->load->view('testView',['surat'=> "sidangkp.php"]);
    }
}
