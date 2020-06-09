<?php
//error_reporting(E_ALL ^ E_DEPRECATED);
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pengaturan extends Cek_Controller {
    function __construct() {
        parent::__construct();
        
    }
    function index() {
        $data['judul'] = "Pengaturan";

        $this->load->view('design/header',$data);
        $this->load->view('pengaturan/index.php',$data);
        $this->load->view('design/footer',$data);
    }

    function get_menu(){
        $s_menu = "select * from menu";
        $q_menu = $this->db->query($s_menu);

        $data = array();
        $parent_key = '0';

        if($q_menu->num_rows() > 0)
        {
            $data = $this->membersTree($parent_key);
                    //$data=array("id"=>"0","name"=>"No Members presnt in list","text"=>"No Members is presnt in list","nodes"=>array());
        }else{
            $data=array("id"=>"0","name"=>"No Members presnt in list","text"=>"No Members is presnt in list","nodes"=>array());
        }

                //print_r ($this->membersTree(0));
        echo json_encode(array_values($data));
    }

    public function membersTree($parent_key)
    {
        $row1 = array();
        $row = $this->db->query('select submenu_id as id, submenu as name, submenu_link as link, level2_menu, level3_menu,id_roles,aktif, parent_id from submenu where parent_id = "'.$parent_key.'"')->result_array();               
        foreach($row as $key => $value){
                    //$row1[$key] =$value;
            $c = count($this->membersTree($value['id']));
            $id = $value['id'];
            $row1[$key]['id'] = $value['id'];
            $row1[$key]['parent_id'] = $value['parent_id'];
            $row1[$key]['name'] = $value['name'];
            ($c>0)?$c=$c:$c='';
            $row1[$key]['tags'] = array($c);
            $row1[$key]['text'] = $value['name'];
            $row1[$key]['href'] = $value['link'];

            $row1[$key]['level2_menu'] = $value['level2_menu'];
            $row1[$key]['level3_menu'] = $value['level3_menu'];
            $row1[$key]['id_roles'] = $value['id_roles'];
            $row1[$key]['aktif'] = $value['aktif'];
            if($c>0){
                $row1[$key]['nodes']=array_values($this->membersTree($value['id']));
            }else{
                $row1[$key]['nodes']= '';
            }
        }

        return $row1;
    }

    public function simpan_menu(){
                //id: submenu: submenu_link: aktif: 0 roles: act: 0 parent_id: 4
        $act = $this->input->post('act');
        $id = $this->input->post('id');
        $parent_id = $this->input->post('parent_id');
        $submenu = $this->input->post('submenu');
        $submenu_link = $this->input->post('submenu_link');
        $aktif = $this->input->post('aktif');
        $roles = $this->input->post('roles');
                //insert
        if($act==0){
            $tb = "submenu";
            $ins = array(
                "submenu"=>$submenu,
                "submenu_link"=>$submenu_link,
                "id_roles"=>$roles,
                "aktif"=>$aktif,
                "parent_id"=>$parent_id
                );
            $this->db->insert($tb,$ins);
            $msg = "Data Berhasil Ditambahkan !!!";
        }else{
            $tb = "submenu";
            $key = array(
                "submenu_id"=>$id
                );
            $dt = array(
                "submenu"=>$submenu,
                "submenu_link"=>$submenu_link,
                "id_roles"=>$roles,
                "aktif"=>$aktif,
                "parent_id"=>$parent_id
                );
            $this->db->update($tb,$dt,$key);
            $msg = "Data Berhasil Diubahkan !!!";

        }
        echo $msg;
    }

    function ambil_menu(){
        $s_data = "select sm.submenu_id parent_id, sm.submenu as nama from submenu as sm ";
        $q_data = $this->db->query($s_data);

        echo json_encode($q_data->result());
    }

}
