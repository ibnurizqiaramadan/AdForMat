<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->token) {
            redirect(base_url('login'));
        }
    }

    function getTotal($table, $where = null)
    {
        if ($where == null) {
            return $this->db->get($table)->num_rows();
        } else {
            return $this->db->get_where($table, $where)->num_rows();
        }
    }

    function index()
    {
        if ($this->session->level == 1) {
            $dashboardItem = (object) [
                (object) [
                    'total' => $this->getTotal('t_pengguna'),
                    'color' => 'success',
                    'icon' => 'fas fa-users',
                    'caption' => "Total User",
                    'url' => base_url('master/user')
                ],
                (object) [
                    'total' => $this->getTotal('t_permintaan'),
                    'color' => 'info',
                    'icon' => 'fas fa-exchange-alt',
                    'caption' => "Total Permintaan",
                    'url' => base_url('surat/semua')
                ],
                (object) [
                    'total' => $this->getTotal('t_dokumen'),
                    'color' => 'warning',
                    'icon' => 'fas fa-file-pdf',
                    'caption' => "Total Dokumen",
                    'url' => base_url('master/dokumen')
                ]
            ];
        } else {
            $dashboardItem = (object) [
                (object) [
                    'total' => $this->getTotal('t_permintaan', ['status' => 'pending', 'id_user' => $this->session->userid]),
                    'color' => 'warning',
                    'icon' => 'far fa-clock',
                    'caption' => "Pending",
                    'url' => base_url('surat/pending')
                ],
                (object) [
                    'total' => $this->getTotal('t_permintaan', ['status' => 'acc', 'id_user' => $this->session->userid]),
                    'color' => 'info',
                    'icon' => 'far fa-check-circle',
                    'caption' => "Diterima",
                    'url' => base_url('surat/acc')
                ],
                (object) [
                    'total' => $this->getTotal('t_permintaan', ['status' => 'ditolak', 'id_user' => $this->session->userid]),
                    'color' => 'danger',
                    'icon' => 'far fa-times-circle',
                    'caption' => "Ditolak",
                    'url' => base_url('surat/ditolak')
                ],
                (object) [
                    'total' => $this->getTotal('t_permintaan', ['status' => 'selesai', 'id_user' => $this->session->userid]),
                    'color' => 'success',
                    'icon' => 'far fa-check-circle ',
                    'caption' => "Selesai",
                    'url' => base_url('surat/selesai')
                ],
            ];
        }
        $data = [
            'title' => "Dashboard",
            'content' => 'dashboard/dashboard',
            'menu' => 'dashboard',
            'dashboard' => $dashboardItem,
            'script' => 'dashboard'
        ];
        $this->load->view('template/main', $data);
    }
}


?>