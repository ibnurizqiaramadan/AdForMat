<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_login', 'login');
	}
	
	function index()
	{
		$this->load->view('v_login');
	}

	function aksi()
	{
		$cek = $this->login->cek();
		if ($cek['status'] == 'fail') {
			echo json_encode([
				'status' => 'fail',
				'msg' => 'Username Atau Password Salah !'
			]);
		} else {
			$data = $cek['data'];
			$session = [
				'userid'	=> $data['id'],
				'username' 	=> $data['username'],
				'nama' 		=> $data['nama'],
				'level' 	=> $data['level'],
				'jur' 		=> $data['jur'],
				'token' 	=> $data['token'],
			];
			$this->session->set_userdata($session);
			echo json_encode([
				'status' => 'ok',
				'msg' => 'Berhasil Masuk !'
			]);
		}
	}

	function logout($token)
	{
		if ($token == $this->session->userdata('token')) {
			$this->session->sess_destroy();
			redirect(base_url('login'));
		} else {
			show_404();
		}
	}


}