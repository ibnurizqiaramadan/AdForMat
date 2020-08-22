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

    function index()
    {
        $data = [
            'title' => "Dashboard",
            'content' => 'dashboard/dashboard',
            'menu' => 'dashboard',
            'script' => 'dashboard'
        ];
        $this->load->view('template/main', $data);
    }
}


?>