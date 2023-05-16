<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelTransaksi extends CI_Model
{
    public function tambahTransaksi($data = null)
    {
        return $this->db->insert('transaksi', $data);
    }

    public function cekTransaksi($where = null)
    {
        return $this->db->get_where('transaksi', $where);
    }
}
