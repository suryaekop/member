<?php
class Member_model extends CI_Model{

    public $table = "member";

    public function __construct(){
        parent::__construct();
    }

    public function insert($data){
        //akan digenerate DML insert into oleh ci
        return $this->db->insert($this->table,$data);
    }
    public function find_all(){
        return $this->db->query("SELECT * from member")->result_array();
    }

    public function update($nomor,$data){
        //ci akan men-generate statement where 
        $this->db->where('nomor',$nomor);
        //ci mengupdate sesuai where diatas
        return $this->db->update($this->table,$data);
    }
    public function delete($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table);
    }
    public function tambahPoin($idmember, $poin) {
        $this->db->where('id', $idmember);
        $this->db->set('poin', 'poin+' . $poin, FALSE);
        $this->db->update('member');
    }
    public function get_by_nomor($nomor)
    {
        return $this->db->get_where('member',array('nomor' => $nomor))->row();
    }
    public function get_by_email($email)
    {
        return $this->db->get_where('member',array('email' => $email))->row();
    }
    public function find_by_nohp($nohp){
        $result = $this->db->query("SELECT * from member where nomor = $nohp")->result_array();
        return $result;
    }
    public function cari_detail_id($id){
        $result =  $this->db->query("SELECT * from member WHERE id='$id'")->result_array();
        if($result){
            return $result[0];
        }else{
            return false;
        }
    }
    public function cari_transaksi_id($id){
        $result =  $this->db->query("SELECT * from transaksi WHERE idmember='$id'")->result_array();
        if($result){
            return $result[0];
        }else{
            return false;
        }
    }
    public function save_otp($email, $otp) {
        $data = array(
            'otp' => $otp,
            'otp_created_at' => date('Y-m-d H:i:s'),
        );

        $this->db->where('email', $email);
        $this->db->update('member', $data); // Replace 'members' with your actual table name
    }
    public function get_user_data($email) {
        // Assuming 'users' is your table name
        $this->db->where('email', $email);
        $query = $this->db->get('member');

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false; // User not found
        }
    }
    public function verify_otp_and_get_data($email, $otp)
    {
        // Check if the provided OTP matches the stored OTP for the given email
        $this->db->where('email', $email);
        $this->db->where('otp', $otp);
        $query = $this->db->get('member');

        if ($query->num_rows() == 1) {
            // OTP is valid, fetch member data
            $member_data = $query->row_array();
            // Optionally, you may want to clear the OTP after successful verification
            $this->clear_otp($email);

            return $member_data;
        } else {
            // OTP is invalid
            return false;
        }
    }

    private function clear_otp($email)
    {
        // Clear the OTP for the given email
        $this->db->where('email', $email);
        $this->db->update('member', ['otp' => null]);
    }
    public function email_exists($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('member'); // replace 'your_member_table_name' with your actual table name

        return $query->num_rows() > 0;
    }
    public function get_member_by_email($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('member'); // replace 'your_member_table_name' with your actual table name

        return $query->row(); // Assuming you expect only one row
    }
    public function getIdMemberByEmail($email) {
        $this->db->select('id');
        $this->db->where('email', $email);
        $query = $this->db->get('member'); // Gantilah 'nama_tabel_member' dengan nama tabel sesuai dengan struktur database Anda.

        $result = $query->row();
        return $result ? $result->id : null;
    }
    
}