<?php
class Login extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Model_data');
    }
 
    function index(){
        $this->load->view('header');
        $this->load->view('login');
        $this->load->view('footer');
    }
 
    function auth(){
        $username=htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
        $password=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);
 
        $cek_dosen=$this->Model_data->auth_user($username,$password);
 
        if($cek_dosen->num_rows() > 0){ //jika login sebagai dosen
                   $data=$cek_dosen->row_array();
                $this->session->set_userdata('masuk',TRUE);
                 if($data['role_id']=='1'){ //Akses admin
                    $this->session->set_userdata('akses','1');
                    $this->session->set_userdata('ses_id',$data['user_id']);
                    $this->session->set_userdata('ses_name',$data['username']);
                     $this->session->set_userdata('city_id',$data['id_city']);
                     helper_log('User Login kedalam sistem');
                    redirect('administrator/dashboard');
                    
 
                 }else{ //akses dosen
                    $this->session->set_userdata('akses','2');
                    $this->session->set_userdata('ses_id',$data['user_id']);
                    $this->session->set_userdata('ses_name',$data['username']);
                    redirect('administrator');
                     $this->session->set_userdata('city_id',$data['id_city']);
                     helper_log('User Login kedalam sistem');
                    redirect('administrator/hpp');
                    
                 }

        }else{
        $this->session->set_userdata('gagal',TRUE);
		$url=base_url(). 'index.php/login';	
	    redirect($url);
        

        }
 
    }
 
 
    function logout(){
        helper_log('User Logout dari sistem');
        $this->session->sess_destroy();
        $url=base_url('');
        redirect($url);
    }
 
}