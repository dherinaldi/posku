<?php
//error_reporting(E_ALL ^ E_DEPRECATED);
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        //session_start();
        $this->load->library('session');
        $this->load->model(array('m_user'));
        if ($this->session->userdata('u_name')) {
            redirect('Dashboard');
        }
    }
    function index() {
        $data['judul'] = "POSKU";
        $this->load->view('login',$data);
    }

    function proses() {
        $sql_host =     "localhost";      
        $sql_username = "root";    
        $sql_password = "";       
        $sql_database = "db_keupb";       


        $mysqli = new mysqli($sql_host , $sql_username , $sql_password , $sql_database );
        if ($mysqli->connect_errno) {
          printf("Connect failed: %s\n", $mysqli->connect_error);
          exit();
      }

      $this->form_validation->set_rules('username', 'username', 'required|trim');
      $this->form_validation->set_rules('password', 'password', 'required|trim');

      if ($this->form_validation->run() == FALSE) {
        redirect('login','refresh');
    } else {
        $usr = $this->input->post('username');
        $psw = $this->input->post('password');
        $u = mysqli_real_escape_string($mysqli,$usr);
        $p = md5(mysqli_real_escape_string($mysqli,$psw));
            
            echo 'user='.$u."&pass=".$p;

            $cek = $this->m_user->cek($u, $p);
            if ($cek->num_rows() > 0) {
                //login berhasil, buat session
                foreach ($cek->result() as $qad) {
                    $sess_data['u_id'] = $qad->u_id;
                    $sess_data['nama'] = $qad->nama;
                    $sess_data['u_name'] = $qad->u_name;
                    $sess_data['id_role'] = $qad->id_role;
                    $sess_data['id_unit'] = $qad->id_unit;
                    $sess_data['logged'] = TRUE;
                    $this->session->set_userdata($sess_data);
                }
                redirect('Dashboard');
                
            } else {
                $this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');
                redirect('login');
            }
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}
