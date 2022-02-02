<?php

class Login extends CI_Controller{

    public function __construct() {  
        parent::__construct(); 

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('client/ClientModel','client_model');          

    } 
    
    public function index(){

        $data['judul']  = 'login';
        $this->load->view('client/templates/header', $data);
        $this->load->view('client/login-client');
    }

    public function verifyUserData(){

		$post = $_POST;
        $nama_user=$post['nama'];
        $pass=$post['password'];

        log_message('debug', 'user login '.$nama_user);

        $where = array(
            'nama'=>$nama_user,
            'password'=>md5($pass)
        );

        $client = $this->client_model->getWhere($where,'client');
        
        if(!empty($client)){

        	log_message('debug', 'success login '.$nama_user);

            //save user data to session
            $id = $client[0]->id;
            $nama = $client[0]->nama;
            $level = $client[0]->level;

            $sesdata = array(
                'id_user'  => $id,
                'nama_user'=> $nama,
                'level_user'=> $level,
                'logged_in'=> TRUE
            );
            
            $this->session->set_userdata($sesdata);

            if($level =='1'){
                 redirect('home');
            }
            /*else if($level =='2'){
                 redirect('barang');
            }else{
                 redirect('transaksi');
            }*/
           

        }else{

        	log_message('debug', 'fail login '.$nama_user);

            //redirect to login page
            $this->session->set_flashdata('login_failure', 'username dan password salah, coba lagi !');
            redirect('login');
            
        } 


	}


	public function logout(){
        $this->session->sess_destroy();
        
        redirect('login-auth');

    }
    
}

?>