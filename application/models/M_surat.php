<?php

class M_surat extends CI_Model
{
    public $status;

    function __construct()
    {
        parent::__construct();
        $this->table = "t_permintaan";
        $this->table1 = "t_pengguna as pen";
        $this->table2 = "t_dokumen as doc";
        $this->table2_ = "t_dokumen";
        $this->column_search = array('pen.nama', 'doc.nama', 'keterangan', 'status', 'tgl');
        $this->column_order = array(null,'pen.nama', 'doc.nama','keterangan', 'tgl', 'status');
        $this->order = array('t_permintaan.id' => 'desc');
    }

    private function _get_datatables_query()
    {
        $this->db->select('t_permintaan.id,pen.nama as nama,doc.nama as jenis,keterangan,status,tgl');
        $this->db->from($this->table);
        $this->db->join($this->table1, "t_permintaan.id_user = pen.id", 'left');
        $this->db->join($this->table2, "t_permintaan.id_jenis = doc.id", 'left');
        if ($this->status != 'semua') {
            $this->db->where('status', $this->status);
        }
        if ($this->session->level == 2) {
            $this->db->where('id_user', $this->session->userid);
        }

        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        if ($this->status != 'semua') {
            $this->db->where('status', $this->status);
        }
        if ($this->session->level == 2) {
            $this->db->where('id_user', $this->session->userid);
        }
        return $this->db->count_all_results();
    }

    function cekPerubahan()
    {
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->cekPerubahan();
    }

    function get($id)
    {
        return $this->db->get_where($this->table, $this->req->id($id))->row();
    }

    function update($data, $where)
    {
        $this->db->where($where);
        $this->db->update($this->table, $data);
        return $this->cekPerubahan();
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->delete($this->table);
        // echo $this->req->query();
        return $this->cekPerubahan();
    }

    function getDokumen($id)
    {
        $permintaan = $this->db->get_where($this->table, $this->req->id($id))->row();
        $berkas = $this->db->get_where($this->table2_, ['id' => $permintaan->id_jenis])->row();
        // $this->req->print($berkas);
        return $berkas->file;
    }

    function getJenis()
    {
        return $this->db->get($this->table2_)->result();
    }
}
