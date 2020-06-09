<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_angular extends CI_Model
{

   public function __construct()
   {
       parent::__construct();
   }

   public function AddUser($name,$city)
   {
      $data = array('name' =>$name,'city' =>$city);
      $this->db->insert('user_angular',$data);
      $insert_id = $this->db->insert_id();
      return $insert_id;
  }
}

/* End of file m_transaksi.php */
/* Location: ./application/models/m_transaksi.php */