<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
     public function __construct(){
        parent::__construct();
        //load model divisi_model,nama objeknya = divisi
        $this->load->model('member_model','member');
        $this->load->model('transaksi_model','transaksi');
    }
    private function _has_login()
    {
        if (!$this->session->has_userdata('logged_email')) {
            redirect('member');
        }
    }
	public function login()
	{
        $data['title'] = "Update Member";
        $data['members'] = $this->member->find_all();
		$this->template->load('templates/auth','member/update', $data);
	}
    public function check_unique_number($nomor){
        $existing_number = $this->member->get_by_nomor($nomor);

        if($existing_number){
            $this->form_validation->set_message('check_unique_number','Nomor Telepon sudah digunakan');
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function detail(){
        $this->_has_login();
        $data['title'] = "Detail Member";
        $id = $this->uri->segment('3');
        $data['members'] = $this->member->cari_detail_id($id);
        $data['trans'] = $this->transaksi->getTransaksiByIdMember($id);
		$this->template->load('templates/dashboard', 'member/detail', $data);
    }
    public function cari_member(){
        $nohp = $this->input->post('nohp');
        $data['member'] = $this->member->find_by_nohp($nohp);
        if($nohp){
            $data['title'] = "Update Data Member";
            $this->template->load('templates/auth','member/updateMember', $data);
        }else{
            redirect('member');
        }
        }
    public function edit_member(){
        $this->form_validation->set_rules("namamember","Nama Member","required");
        $this->form_validation->set_rules("nomor","Nomor","required");
        $this->form_validation->set_rules("alamat","Alamat","required");
        $this->form_validation->set_rules("email","Email","required");
        $this->form_validation->set_rules("jeniskelamin","Jenis Kelamin","required");
        $this->form_validation->set_rules("tanggallahir","Tanggal Lahir","required");
        $this->form_validation->set_rules("tempatlahir","Tempat Lahir","required");
        $this->form_validation->set_rules("poin","Poin","required");
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $namamember = $this->input->post("namamember");
            $nomor = $this->input->post("nomor");
            $alamat = $this->input->post("alamat");
            $email = $this->input->post("email");
            $jeniskelamin = $this->input->post("jeniskelamin");
            $tanggallahir = $this->input->post("tanggallahir");
            $tempatlahir = $this->input->post("tempatlahir");
            $poin = $this->input->post("poin");
            $data = array(
                'namamember' => $namamember,
                'nomor' => $nomor,
                'alamat' => $alamat,
                'email' => $email,
                'jeniskelamin' => $jeniskelamin,
                'tanggallahir' => $tanggallahir,
                'tempatlahir' => $tempatlahir,
                'poin' => $poin
            );
            var_dump($data);
            $this->db->where('nomor',$nomor);
            $this->db->update('member',$data);
            $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">Data Berhasil Diupdate</div>');
            redirect('member');
        }
    }
    public function check_unique_email($email){
        $existing_number = $this->member->get_by_email($email);

        if($existing_number){
            $this->form_validation->set_message('check_unique_email','Email sudah digunakan');
            return FALSE;
        }else{
            return TRUE;
        }
    }
    public function index()
	{
        $data['title'] = "Login Member";
        $data['error'] = $this->session->flashdata('error');
		$this->template->load('templates/authLogin','auth/login', $data);
	}
    public function login_member()
    {
    $this->load->library('email');
    $this->form_validation->set_rules("email", "Email", "required");

    if ($this->form_validation->run() == TRUE) {

        $email = $this->input->post('email');
        // Check if email exists
        if ($this->member->email_exists($email)) {
            $otp = mt_rand(100000, 999999);

            $this->member->save_otp($email, $otp);
            $this->session->set_userdata('logged_email', $email);
            $this->email->from('surya.eko.pra@gmail.com', 'Surya Eko');
            $this->email->to($email);
            $this->email->reply_to('surya.eko.pra@gmail.com', 'Surya Eko');
            $this->email->subject('Login OTP');
            $this->email->message('Your OTP for login into the system is: ' . $otp);

            if ($this->email->send()) {
                redirect('member/verify_otp');
            } else {
                echo "Email Gagal Dikirimkan";
                echo $this->email->print_debugger();
            }
        } else {
            // Email does not exist, redirect to login page
            $this->session->set_flashdata('error', 'Email Not Found');
            redirect('');
        
        }
    } else {
        echo "Email Gagal Dikirimkan";
    }
} 
        public function verify_otp(){
        $data['title'] = "Verify OTP";
        $data['error'] = $this->session->flashdata('error');
		$this->template->load('templates/authVerify','member/verifOtp', $data);
        }
        public function proses_verify(){
            $otp = $this->input->post("otp");
            $email = $this->session->userdata('logged_email');

            $memberdata = $this->member->verify_otp_and_get_data($email,$otp);

            if($memberdata){
                $this->session->set_userdata('memberdata',$memberdata);
                redirect('member/dashboard');
            }else{
                $this->session->set_flashdata('error', 'Incorrect OTP. Please try again.');
                redirect('member/verify_otp');
            }
            
        }

        public function dashboard(){
            $this->_has_login();
            $email = $this->session->userdata('logged_email');
            $data['member'] = $this->member->get_member_by_email($email);
            $this->load->view('member/dashboard',$data);
        }
        public function getTransaksi(){
            $email = $this->session->userdata('logged_email');

            // 2. Dapatkan ID member berdasarkan email
            $idMember = $this->member->getIdMemberByEmail($email);
        
            // 3. Ambil transaksi berdasarkan ID member
            if ($idMember !== null) {
                $transaksiData = $this->transaksi->getTransaksiByIdMemberWithDetails($idMember);
                $data['trans'] = $transaksiData;
                // 4. Tampilkan view
                $this->load->view('member/history', $data);
            } else {
                // Handle case where ID member is not found for the given email
                // You might want to show an error message or redirect the user
                echo "Member not found for the given email.";
            }
        
        }
        public function logout()
        {
        $this->session->unset_userdata('logged_email');

        set_pesan('anda telah berhasil logout');
        redirect('member');
    }
    
    }
    

