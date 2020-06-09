<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cek_Controller extends CI_Controller {

    public function __construct()
    {

        parent::__construct();

        if ($this->session->userdata['logged'] == TRUE)
        {
            //do something
        }
        else
        {
            redirect('login'); //if session is not there, redirect to login page
             $this->session->sess_destroy();
        }   

    }
}