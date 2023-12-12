<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
     public function __construct(){
        parent::__construct();
        //load model divisi_model,nama objeknya = divisi
        $this->load->model('member_model','member');
        $this->load->model('transaksi_model','transaksi');
    }
	public function index()
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
        $this->form_validation->set_rules("email","Email","required|callback_check_unique_email");
        $this->form_validation->set_rules("alamat","Alamat","required");
        $this->form_validation->set_rules("jeniskelamin","Jenis Kelamin","required");
        $this->form_validation->set_rules("tanggallahir","Tanggal Lahir","required");
        $this->form_validation->set_rules("tempatlahir","Tempat Lahir","required");
        $this->form_validation->set_rules("poin","Poin","required");
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        }else{
            $namamember = $this->input->post("namamember");
            $nomor = $this->input->post("nomor");
            $email = $this->input->post("email");
            $alamat = $this->input->post("alamat");
            $jeniskelamin = $this->input->post("jeniskelamin");
            $tanggallahir = $this->input->post("tanggallahir");
            $tempatlahir = $this->input->post("tempatlahir");
            $poin = $this->input->post("poin");
            $data = array(
                'namamember' => $namamember,
                'nomor' => $nomor,
                'email' => $email,
                'alamat' => $alamat,
                'jeniskelamin' => $jeniskelamin,
                'tanggallahir' => $tanggallahir,
                'tempatlahir' => $tempatlahir,
                'poin' => $poin,
            );
            $this->db->where('nomor',$nomor);
            $this->db->update('member',$data);
            $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">Data Berhasil Diupdate</div>');
            redirect('member/login');
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
    public function login()
	{
        $data['title'] = "Login Member";
		$this->template->load('templates/auth','auth/login', $data);
	}
    
}
