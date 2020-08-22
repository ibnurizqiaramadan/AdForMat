<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_login extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = 't_pengguna';
        $this->token = 'IbnuGanteng;v';
    }

    function cek()
    {
        $where = [
            'username' => $this->req->input('username'),
            'password' => $this->req->acak($this->req->input('password'))
        ];
        $result = $this->db->get_where($this->table, $where);
        if ($result->num_rows() > 0) {
            return [
                'status' => 'ok',
                'data' => array_merge($result->row_array(), ['token' => $this->req->acak(time() . $this->token . $this->req->input('username'))])
            ];
        } else {
            return [
                'status' => 'fail',
                'data' => null
            ];
        }
    }
}


?>