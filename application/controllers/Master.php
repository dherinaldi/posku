<?php 
//error_reporting(E_ALL ^ E_DEPRECATED);
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends Cek_Controller{
    //put your code here
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index(){
        $data['title'] = 'Master User/ Pengguna';
        $data['subtitle'] = '';

        $this->load->view('design/header',$data);
        $this->load->view('master/user',$data);
        $this->load->view('design/footer',$data);
    }

    public function customer(){
        $data['title'] = 'Master Customer/Pelanggan';
        $data['subtitle'] = '';

        $this->load->view('design/header',$data);
        $this->load->view('master/customer',$data);
        $this->load->view('design/footer',$data);
    }
    public function jenis(){
        $data['title'] = 'Master Jenis Barang';
        $data['subtitle'] = '';

        $this->load->view('design/header',$data);
        $this->load->view('master/jenis',$data);
        $this->load->view('design/footer',$data);
    }

    public function supplier(){
        $data['title'] = 'Master Supplier/ Penyedia';
        $data['subtitle'] = '';

        $this->load->view('design/header',$data);
        $this->load->view('master/supplier',$data);
        $this->load->view('design/footer',$data);
    }

    public function barang(){
        $data['title'] = 'Master Barang';
        $data['subtitle'] = '';

        $data['generate_kode'] = $this->cekkode();

        $this->load->view('design/header',$data);
        $this->load->view('master/barang',$data);
        $this->load->view('design/footer',$data);
    }

    public function list_customer(){
        $data = array();
        $s_data  = "select * from m_cust";
        $data['q_data']= $this->db->query($s_data);
        $this->load->view('master/detail/list_customer',$data);
    }

    public function list_jenis(){
        $data = array();
        $s_data  = "select * from m_jenis";
        $data['q_data']= $this->db->query($s_data);
        $this->load->view('master/detail/list_jenis',$data);
    }

    public function list_supplier(){
        $data = array();
        $s_data  = "select * from m_supp";
        $data['q_data']= $this->db->query($s_data);
        $this->load->view('master/detail/list_supplier',$data);
    }

    public function list_barang(){
        $data = array();
        $dat = json_decode(file_get_contents("php://input"));
        $nama = $dat->nama;
        $kode = $dat->kode;
        $jenis = $dat->jenis;
        $satuan = $dat->satuan;
        $limit = $dat->limit;
        $s_limit =$s_where=$s_nama=$s_kode=$s_jenis=$s_satuan= '';
        /*$nama = $this->input->get_post('nama');
        $kode = $this->input->get_post('kode');
        $jenis = $this->input->get_post('jenis');
        $satuan = $this->input->get_post('satuan');
        $limit = $this->input->get_post('limit');*/

        ($nama!='')?$s_nama = " and nama like '%".$nama."%'":$s_nama='';
        ($kode!='')?$s_kode = " and kode like '%".$kode."%'":$s_kode='';
        ($jenis!='')?$s_jenis = " and jenis like '%".$jenis."%'":$s_jenis='';
        ($satuan!='')?$s_satuan = " and satuan like '%".$satuan."%'":$s_satuan='';

        ($limit!='all')?$s_limit = " limit ".$limit:$s_limit = '';

        $s_where .=$s_nama.$s_kode.$s_jenis.$s_satuan;
        $s_data  = "select * from m_barang where 0=0 ".$s_where.$s_limit."";
        $data['q_data']= $this->db->query($s_data);
        $this->load->view('master/detail/list_barang',$data);
    }

    public function list_data(){
        $data = array();
        $nama = $this->input->get_post('nama');
        $u_name = $this->input->get_post('u_name');
        $role = $this->input->get_post('role');
        $s_where = 'where 0=0 ';
        $s_nama =$s_u_name = $s_role= '';

        ($nama!='')?$s_nama = " and u.nama like '%".$nama."%'":$s_nama='';
        ($u_name!='')?$s_u_name = " and u.u_name like '%".$u_name."%'":$s_u_name='';
        ($role!='')?$s_role = " and tb_role.role like '%".$role."%'":$s_role='';

        $s_where .=$s_nama.$s_u_name.$s_role;
        $s_data = "select u.u_id, u.nama, u.u_name, u.id_role, tb_role.role
        from user u
        left join tb_role on u.id_role = tb_role.id_role ".$s_where;
        //echo $s_data;

        $data['q_data'] = $this->db->query($s_data);
        $this->load->view('master/detail/list_user',$data);
    }

    public function simpan(){
        $act = $this->input->get_post('act');
        $nama = $this->input->get_post('nama');
        $username = $this->input->get_post('username');
        $id_role = $this->input->get_post('id_role');
        $u_id = $this->input->get_post('u_id');
        $tb ="user";

        if($act=="ubah"){
            $key = array(
                "u_id"=>$u_id
                );
            $dt = array(
                "nama"=>$nama,
                "u_name"=>$username,
                "id_role"=>$id_role,
                );
            $this->db->update($tb, $dt,$key);
            $msg  = "Data Berhasil Diubah ";
        }else{
            $msg  = "Data Berhasil Disimpan ";
        }

        $this->session->set_flashdata('msg', $msg );
        echo $msg;
        
        /*echo '<div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa fa-check"></i>'.$msg.'</div>';*/
    }

    public function simpan_barang(){
        $data = json_decode(file_get_contents("php://input"));
        $act = $data->act;
        $id = $data->id;
        $nama = $data->nama;
        $kode = $data->kode;
        $id_jenis = $data->id_jenis;
        $satuan = $data->satuan;
        $hpp =$data->hpp;
        $hjual= $data->hjual;

        $tb ="m_barang";
        if($act=='ubah'){
            $key =array('id_barang'=>$id);
            $data = array('nama'=>$nama, 'kode'=>$kode, 'id_jenis'=>$id_jenis,'satuan'=>$satuan,'hpp'=>$hpp, 'jual1'=>$hjual);
            $this->db->update($tb,$data,$key);
            $msg = "Data ". $nama ." kode ".$kode." Berhasil diubah !!!";
        }else{
            $data = array('nama'=>$nama, 'kode'=>$kode, 'id_jenis'=>$id_jenis,'satuan'=>$satuan,'hpp'=>$hpp, 'jual1'=>$hjual);
            $this->db->insert($tb,$data);
            $msg = "Data ". $nama ." kode ".$kode." Berhasil ditambahkan !!!";
        }

        echo $msg;
    }

    public function hapus(){
        $id = $this->input->get_post('id');
        $key = array('u_id'=>$id);
        $this->db->delete('user',$key);
        echo "data id ".$id." berhasil di hapus !!!!";

    }

    public function hapus_barang(){
        $id = $this->input->get_post('id');
        $key = array('id_barang'=>$id);
        //$this->db->delete('m_barang',$key);
        echo "data id ".$id." berhasil di hapus !!!!";

    }

    function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),
        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,
        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,
        // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
            );
    }

    public function generate_data(){
        $s_data = "select id_barang, kode from m_barang";
        $q_data = $this->db->query($s_data);
        foreach ($q_data->result() as $key) {
            $id_brg = $key->id_barang;
            $tmp = $id_brg;
            $kd = "BR".sprintf("%010s", $tmp);
            $s_update = " update m_barang set kode ='".$kd."' where id_barang = ".$id_brg."";
            $q_update = $this->db->query($s_update);
        }

    }

    function cekkode(){
        $q = $this->db->query("SELECT MAX(RIGHT(kode,10)) AS kd_max FROM m_barang");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%010s", $tmp);
            }
        }else{
            $kd = "0000000001";
        }
        return "BR".$kd;
    }
}
