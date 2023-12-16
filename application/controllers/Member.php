<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once FCPATH . 'vendor/autoload.php';
use Twilio\Rest\Client;

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
    private function _has_login_nomor()
    {
        if (!$this->session->has_userdata('logged_phone')) {
            redirect('member/indexWa');
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
            if($this->form_validation->run() == FALSE){
                echo validation_errors();
            }else{
                $config['upload_path'] = './fotouser/';
                $config['allowed_types'] = 'gif|jpg|png|PNG|jpeg|JPEG';
                $config['max_size'] = 2048000;
                $config['max_width'] = 10000;
                $config['max_height'] = 10000;
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload('foto')){
                    $namamember = $this->input->post("namamember");
                    $nomor = $this->input->post("nomor");
                    $alamat = $this->input->post("alamat");
                    $email = $this->input->post("email");
                    $jeniskelamin = $this->input->post("jeniskelamin");
                    $tanggallahir = $this->input->post("tanggallahir");
                    $tempatlahir = $this->input->post("tempatlahir");
                    $data = array(
                        'namamember' => $namamember,
                        'nomor' => $nomor,
                        'alamat' => $alamat,
                        'email' => $email,
                        'jeniskelamin' => $jeniskelamin,
                        'tanggallahir' => $tanggallahir,
                        'tempatlahir' => $tempatlahir,
                    );
                    var_dump($data);
                    $this->db->where('nomor',$nomor);
                    $this->db->update('member',$data);
                    $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">Data Berhasil Diupdate</div>');
                    redirect('member/dashboard');
                }else{
                    $foto = $this->upload->data();
                    $foto = $foto['file_name'];
                    $namamember = $this->input->post("namamember");
                    $nomor = $this->input->post("nomor");
                    $alamat = $this->input->post("alamat");
                    $email = $this->input->post("email");
                    $jeniskelamin = $this->input->post("jeniskelamin");
                    $tanggallahir = $this->input->post("tanggallahir");
                    $tempatlahir = $this->input->post("tempatlahir");
                    $data = array(
                        'namamember' => $namamember,
                        'nomor' => $nomor,
                        'alamat' => $alamat,
                        'email' => $email,
                        'jeniskelamin' => $jeniskelamin,
                        'tanggallahir' => $tanggallahir,
                        'tempatlahir' => $tempatlahir,
                        'foto' => $foto
                    );
                    var_dump($data);
                    $this->db->where('nomor',$nomor);
                    $this->db->update('member',$data);
                    $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">Data Berhasil Diupdate</div>');
                    redirect('member/dashboard');
                }
                
            }
        }
    public function edit_member_wa(){
        $this->form_validation->set_rules("namamember","Nama Member","required");
        $this->form_validation->set_rules("nomor","Nomor","required");
        $this->form_validation->set_rules("alamat","Alamat","required");
        $this->form_validation->set_rules("email","Email","required");
        $this->form_validation->set_rules("jeniskelamin","Jenis Kelamin","required");
        $this->form_validation->set_rules("tanggallahir","Tanggal Lahir","required");
        $this->form_validation->set_rules("tempatlahir","Tempat Lahir","required");
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $config['upload_path'] = './fotouser/';
            $config['allowed_types'] = 'gif|jpg|png|PNG|jpeg|JPEG';
            $config['max_size'] = 2048000;
            $config['max_width'] = 10000;
            $config['max_height'] = 10000;
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload('foto')){
                $namamember = $this->input->post("namamember");
                $nomor = $this->input->post("nomor");
                $alamat = $this->input->post("alamat");
                $email = $this->input->post("email");
                $jeniskelamin = $this->input->post("jeniskelamin");
                $tanggallahir = $this->input->post("tanggallahir");
                $tempatlahir = $this->input->post("tempatlahir");
                $data = array(
                    'namamember' => $namamember,
                    'nomor' => $nomor,
                    'alamat' => $alamat,
                    'email' => $email,
                    'jeniskelamin' => $jeniskelamin,
                    'tanggallahir' => $tanggallahir,
                    'tempatlahir' => $tempatlahir
                );
                var_dump($data);
                $this->db->where('nomor',$nomor);
                $this->db->update('member',$data);
                $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">Data Berhasil Diupdate</div>');
                redirect('member/dashboardNomor');
            }else{
                $foto = $this->upload->data();
                $foto = $foto['file_name'];
                $namamember = $this->input->post("namamember");
                $nomor = $this->input->post("nomor");
                $alamat = $this->input->post("alamat");
                $email = $this->input->post("email");
                $jeniskelamin = $this->input->post("jeniskelamin");
                $tanggallahir = $this->input->post("tanggallahir");
                $tempatlahir = $this->input->post("tempatlahir");
                $data = array(
                    'namamember' => $namamember,
                    'nomor' => $nomor,
                    'alamat' => $alamat,
                    'email' => $email,
                    'jeniskelamin' => $jeniskelamin,
                    'tanggallahir' => $tanggallahir,
                    'tempatlahir' => $tempatlahir,
                    'foto' => $foto
                );
                var_dump($data);
                $this->db->where('nomor',$nomor);
                $this->db->update('member',$data);
                $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">Data Berhasil Diupdate</div>');
                redirect('member/dashboardNomor');
            }
            
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
    public function indexEmail()
	{
        $data['title'] = "Login Member Email";
        $data['error'] = $this->session->flashdata('error');
		$this->template->load('templates/authLogin','auth/login', $data);
	}
    public function index()
	{
        $data['title'] = "Login Member WhatsApp";
        $data['error'] = $this->session->flashdata('error');
		$this->template->load('templates/authLogin','auth/loginWa', $data);
	}
    public function login_member()
    {
    $this->load->library('email');
    $this->load->library('phpmailer_lib'); // Load the PHPMailer library

    $this->form_validation->set_rules("email", "Email", "required");

    if ($this->form_validation->run() == TRUE) {

        $email = $this->input->post('email');
        // Check if email exists
        if ($this->member->email_exists($email)) {
            $otp = mt_rand(100000, 999999);

            $this->member->save_otp($email, $otp);
            $this->session->set_userdata('logged_email', $email);

            // Use PHPMailer to send email
            $mail = $this->phpmailer_lib->load(); // Initialize PHPMailer

            $mail->setFrom('cs@terasjapan.com', 'Teras Japan CS');
            $mail->addAddress($email);
            $mail->addReplyTo('cs@terasjapan.com', 'Teras Japan CS');
            $mail->Subject = 'Login OTP';
            $mail->Body =
            'PERHATIAN!
            JANGAN BERIKAN kode ini kepada siapa pun, 
            TERMASUK TIM TERAS JAPAN. 
            WASPADA PENIPUAN! 
            Untuk MASUK KE AKUM MEMBER TERAS JAPAN, masukkan kode RAHASIA: ' . $otp;

            // SMTP Configuration
            $mail->isSMTP();
            $mail->Host = 'srv125.niagahoster.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'cs@terasjapan.com';
            $mail->Password = 'customerserviceBSD';
            $mail->SMTPSecure = 'tls'; // You can change it to 'ssl' if needed
            $mail->Port = 587; // You can use port 465 for SSL

            if ($mail->send()) {
                redirect('member/verify_otp');
            } else {
                echo "Email Gagal Dikirimkan";
                echo $mail->ErrorInfo;
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
        public function verify_otp_wa(){
            $data['title'] = "Verify OTP Whatsapp";
            $data['error'] = $this->session->flashdata('error');
            $this->template->load('templates/authVerify','member/verifOtpWa', $data);
            }
        public function proses_verify(){
            $otp = $this->input->post("otp");
            $email = $this->session->userdata('logged_email');

            $memberdata = $this->member->verify_otp_and_get_data($email,$otp);

            if($memberdata){
                $this->session->set_userdata('memberdata',$memberdata);
                redirect('member/profile');
            }else{
                $this->session->set_flashdata('error', 'Incorrect OTP. Please try again.');
                redirect('member/verify_otp');
            }
            
        }
        public function proses_verify_wa(){
            $otp = $this->input->post("otp");
            $nomor = $this->session->userdata('logged_phone');

            $memberdata = $this->member->verify_otp_and_get_data_wa($nomor,$otp);

            if($memberdata){
                $this->session->set_userdata('memberdata',$memberdata);
                redirect('member/profileNomor');
            }else{
                $this->session->set_flashdata('error', 'Incorrect OTP. Please try again.');
                redirect('member/verify_otp_wa');
            }
            
        }
        public function dashboard(){
            $this->_has_login();
            $email = $this->session->userdata('logged_email');
            $data['member'] = $this->member->get_member_by_email($email);
            $this->load->view('member/dashboard',$data);
        }
        public function dashboardNomor(){
            $this->_has_login_nomor();
            $nomor = $this->session->userdata('logged_phone');
            $data['member'] = $this->member->get_member_by_phone($nomor);
            $this->load->view('member/dashboardNomor',$data);
        }
        public function profile(){
            $this->_has_login();
            $email = $this->session->userdata('logged_email');
            $data['member'] = $this->member->get_member_by_email($email);
            $this->load->view('member/profile',$data);
        }
        public function profileNomor(){
            $this->_has_login_nomor();
            $nomor = $this->session->userdata('logged_phone');
            $data['member'] = $this->member->get_member_by_phone($nomor);
            $this->load->view('member/profileWa',$data);
        }
        public function getTransaksi(){
            $this->_has_login();
            
            $email = $this->session->userdata('logged_email');
            $data['member'] = $this->member->get_member_by_email($email);

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
        public function getTransaksiNomor(){
            $this->_has_login_nomor();
            
            $nomor = $this->session->userdata('logged_phone');
            $data['member'] = $this->member->get_member_by_phone($nomor);

            // 2. Dapatkan ID member berdasarkan email
            $idMember = $this->member->getIdMemberByPhone($nomor);
        
            // 3. Ambil transaksi berdasarkan ID member
            if ($idMember !== null) {
                $transaksiData = $this->transaksi->getTransaksiByIdMemberWithDetails($idMember);
                $data['trans'] = $transaksiData;
                // 4. Tampilkan view
                $this->load->view('member/historyWa', $data);
            } else {
                // Handle case where ID member is not found for the given email
                // You might want to show an error message or redirect the user
                echo "Member not found for the given phone number.";
            }
        }
        public function logout()
        {
        $this->session->unset_userdata('logged_email');

        set_pesan('anda telah berhasil logout');
        redirect('member');
    }
    public function edit(){
        $this->_has_login();
        $email = $this->session->userdata('logged_email');
        $data['member'] = $this->member->get_member_by_email($email);
        $this->load->view('member/edit',$data);
    }
    public function edit_wa(){
        $this->_has_login_nomor();
        $nomor = $this->session->userdata('logged_phone');
        $data['member'] = $this->member->get_member_by_phone($nomor);
        $this->load->view('member/editWa',$data);
    }

    public function login_member_wa()
{
    $this->form_validation->set_rules("nomor", "Nomor Handphone", "required");

    if ($this->form_validation->run() == TRUE) {
        $nomor = $this->input->post('nomor');
        if ($this->member->exists_phone($nomor)) {
            $toNumber = '+62' . substr($nomor, 1);

            $otp = mt_rand(100000, 999999);

            // Save OTP in the database using your model method
            $this->member->save_otp_wa($nomor, $otp);
            $this->session->set_userdata('logged_phone', $nomor);

            $data = [
                'target' => $toNumber,
                'message' => 'PERHATIAN! JANGAN BERIKAN kode ini kepada siapa pun, TERMASUK TIM TERAS JAPAN. WASPADA PENIPUAN! Untuk MASUK KE AKUM MEMBER TERAS JAPAN, masukkan kode RAHASIA: ' . $otp
            ];

            // Fonnte API Configuration
            $fonnteApiUrl = 'https://api.fonnte.com/send';
            $headers = ['Authorization: DhcIVkveATpivXCwS+Bw']; // Replace with your Fonnte API token

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $fonnteApiUrl);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($ch);
            curl_close($ch);

            // Check if the message was sent successfully
            if ($result) {
                redirect('member/verify_otp_wa');
            } else {
                echo "WhatsApp OTP Failed to Send";
            }
        } else {
            // Phone number does not exist, redirect to login page
            $this->session->set_flashdata('error', 'Phone Number Not Found');
            redirect('');
        }
    } else {
        echo "WhatsApp OTP Failed to Send";
    }
}
    
    }
    

