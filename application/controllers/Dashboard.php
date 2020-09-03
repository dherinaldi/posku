<?php 
//error_reporting(E_ALL ^ E_DEPRECATED);
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Cek_Controller{
    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->load->model('App_model');
        $this->model = $this->app_model;
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $data['subtitle'] = '';

        $this->load->view('design/header',$data);
        $this->load->view('dashboard/admin',$data);
        $this->load->view('design/footer',$data);
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}

