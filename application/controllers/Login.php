<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function _construct(){
        parent::__construct();
		$this->load->library('form_validation');
	}
    }
    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run() == false){
        //load view header,login,footer
        //$this->load->view('login');
        }
		else{
			//success validation
			$this->_login();
		}
    }
    public function _login(){
        $email = $this->input->post('email');
		$password = $this->input->post('password');
        //ambil data email dan password dari database
        //$user =$this->db->get_where('user',['email' => $email])->row_array();
        if($user){ 

                if($user['active'] == 1){
                    if(password_verify($password,$user['password'])){
                        if($user['role'] == admin){
                            redirect(base_url('Admin'));
                        }
                        else{
                            redirect(base_url('User'));
                        }
                    }
                    else{
                        $this->session->set_flashdata('warning', 'Maaf Password Salah ');
                        redirect(base_url('Login'));
                        
                    }
                }
                else{
                    $this->session->set_flashdata('warning', 'Akun anda tidak aktif. Hubungi Admin ');
                        redirect(base_url('Login'));
                }
        }
        else{
             $this->session->set_flashdata('warning', 'Anda Belum Terdaftar. Silahkan Daftar terlebih dahulu');
             //redirect login ganti jadi redirect ke hal daftar
             redirect(base_url('Login'));
        }
    }
}

/* End of file Login.php */
