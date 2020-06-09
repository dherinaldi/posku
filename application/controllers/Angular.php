<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Angular extends CI_Controller{
    //put your code here
  public function __construct()
  {
    parent::__construct();
        //$this->load->model('app_model');
    $this->load->model('m_angular');
    $this->load->library(array('pagination','image_lib','form_validation','breadcrumb'));
  }    

  public function index() {
        /*$data['title'] = 'Barang';
        $data['subtitle'] = 'input data';*/
        $data = array();
        $this->load->view("angular/angular",$data);
      }

      public function add()
      {
   // Here you will get data from angular ajax request in json format so you have to decode that json data you will get object array in $request variable

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $name = $request->name;
        $city = $request->city;
        $id = $this->m_angular->AddUser($name,$city);
        if($id)
        {
         echo $result = '{"status" : "success"}';
       }else{
         echo $result = '{"status" : "failure"}';
       }
     }

     public function js(){
      $data = array();
      $this->load->view('design/header', $data);
      $this->load->view('tutorial/js', $data);
      $this->load->view('design/footer', $data);


     }


   }


