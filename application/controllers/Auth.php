<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{
        $data['title'] = "Login Member";
		$this->template->load('templates/auth','auth/login', $data);
	}
}
