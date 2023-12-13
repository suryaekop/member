<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

    public $table = "transaksi";

    public function __construct() {
        parent::__construct();
    }

    public function getAllTransaksi() {
        // Logic to retrieve all transaction data from the table
        return $this->db->get($this->table)->result();
    }

    public function getTransaksiById($id) {
        // Logic to retrieve transaction data based on ID from the table
        return $this->db->get_where($this->table, array('id' => $id))->row();
    }
    public function getTransaksiByIdMember($id) {
        // Logic to retrieve transaction data based on ID from the table
        $this->db->where('idmember', $id);
        $query = $this->db->get('transaksi'); // Ganti 'nama_tabel_transaksi' dengan nama tabel transaksi Anda
        return $query->result_array();
    }
    public function getTransaksiByEmail($email) {
        // Logic to retrieve transaction data based on ID from the table
        $this->db->where('email', $email);
        $query = $this->db->get('transaksi'); // Ganti 'nama_tabel_transaksi' dengan nama tabel transaksi Anda
        return $query->result_array();
    }

    public function insert($data) {
        // Insert data into the 'transaksi' table
        return $this->db->insert($this->table, $data);
    }
    public function getTransaksiByIdMemberWithDetails($idMember) {
        $this->db->select('transaksi.*, cabang.namacabang, member.namamember');
        $this->db->from('transaksi');
        $this->db->join('cabang', 'cabang.id = transaksi.nocabang');
        $this->db->join('member', 'member.id = transaksi.idmember');
        $this->db->where('transaksi.idmember', $idMember);
        $query = $this->db->get();
        $result = $query->result();

        $totalPoin = 0;
        foreach ($result as &$transaksi) {
            $poinPer10rb = $transaksi->total / 10000;
            $transaksi->konversipoin = floor($poinPer10rb);
            $totalPoin += $transaksi->konversipoin;
            $transaksi->totalpoin = $totalPoin;
        }

        return $result;
    }
}
