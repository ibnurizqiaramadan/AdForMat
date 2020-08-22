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
    }

    function pending()
    {
        $data = [
            'title' => "Surat - Peding",
            'content' => 'dashboard/dashboard',
            'menu' => 'surat',
            'subMenu' => 'pending',
            'script' => 'dashboard'
        ];
        $this->load->view('template/main', $data);
    }

    function ditolak()
    {
        $data = [
            'title' => "Surat - Ditolak",
            'content' => 'dashboard/dashboard',
            'menu' => 'surat',
            'subMenu' => 'ditolak',
            'script' => 'dashboard'
        ];
        $this->load->view('template/main', $data);
    }

    function selesai()
    {
        $data = [
            'title' => "Surat - Selesai",
            'content' => 'dashboard/dashboard',
            'menu' => 'surat',
            'subMenu' => 'selesai',
            'script' => 'dashboard'
        ];
        $this->load->view('template/main', $data);
    }
}
