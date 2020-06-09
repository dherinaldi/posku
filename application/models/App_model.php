<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_model extends CI_Model {

	//public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default',true);

	}
	public function barang(){
       $q = $this->db->query("select * from view_barang");
       return $q;
   }
   public function subbarang(){
       $q = $this->db->query("select * from view_sub");
       return $q;
   }
   public function jenisbarang(){
       $q = $this->db->query("select * from data_jenis");
       return $q;
   }
   public function datadivisi(){
       $q = $this->db->query("select * from data_divisi");
       return $q;
   }
   public function userlogin(){
       $q = $this->db->query("select * from user_login");
       return $q;
   }
   public function penyedia(){
       $q = $this->db->query("select * from data_penyedia");
       return $q;
   }
   function data_satuan(){
      $q = $this->db->query("select * from satuan");
      return $q;
  }
  public function manualQuery($q)
  {
    return $this->db->query($q);
}
function simpan($jenis){
        //$this->db->insert($this->table,$jenis);
    $this->db->insert('data_penyedia',$jenis);
    return $this->db->insert_id();
}
function update($kode,$jenis){
    $this->db->where("kode_penyedia",$kode);
    $this->db->update("data_penyedia",$jenis);
}


    //-------- BARANG

public function insertBarang($data){
    $query = $this->db->insert('data_barang',$data);
    return $query;
}

public function getKodeBarang($kode)
{
    $q = $this->db->query("select MAX(RIGHT(kode_barang,6)) as kd_max from data_barang where kode_sub = '".$kode."'");
    $kd = "";
    if($q->num_rows()>0)
    {
        foreach($q->result() as $k)
        {
            $tmp = ((int)$k->kd_max)+1;
            $kd = sprintf("%06s", $tmp);
        }
    }
    else
    {
        $kd = "000001";
    }
    return $kode.".".$kd;
}

/*untuk counter kode_barang*/
public function getKodeBarangCount1($kode)
{

    $q = $this->db->query("select MAX(RIGHT(kode_barang,6)) as kd_max,kode_sub from data_barang where kode_sub like '%".$kode."%'");
    return $q;
}

public function sawal($jenis,$tgl_awal){
    //sawal tunai
    if(strtolower($jenis)==strtolower('tun')){
        $s_kd_trans = " and kd_trans in (24,26,28,34,43,54,61,25,27,35,36,37,41,51,53,62,63) ";
        $s_data = "select 
        COALESCE(sum(masuk)-sum(keluar),0) as saldo_awal
        from tr_bku_saldo where tgl < '".$tgl_awal."' ".$s_kd_trans." and fk_sd=2";
    }
    //sawal bank
    elseif(strtolower($jenis)==strtolower('ban')){
        $s_kd_trans = " and kd_trans in (21,22,62,24) ";

        $s_data = "select 
        SUM(if(kd_trans=21,masuk,0)) - SUM(if(kd_trans in(22,62,24),masuk,0)) as saldo_awal
        from tr_bku_saldo where tgl < '".$tgl_awal."' ".$s_kd_trans." and fk_sd=2";
    }
    elseif(strtolower($jenis)==strtolower('per')){
        $s_kd_trans = " and kd_trans in (15,61,63,64) ";
        $s_data = "select 
        COALESCE(sum(masuk)-sum(keluar),0) as saldo_awal
        from tr_bku_saldo where tgl < '".$tgl_awal."' ".$s_kd_trans." and fk_sd=2";
    }
    

    $q_data = $this->db->query($s_data)->result_array();
    return $q_data[0]['saldo_awal'];

}

public function cek_tipe($kode_diagram,$kode_bp){
    $s_data ="select tipe from tr_diagram where fk_diagram=".$kode_diagram." and fk_bp=".$kode_bp."";
    $q_dt1 = $this->db->query($s_data);
    $q_data =$this->db->query($s_data)->result_array();
    if($q_dt1->num_rows()>0){
        $q_data[0]['tipe'];
    }else{
        $q_data[0]['tipe']=0;
    }
    return $q_data[0]['tipe'];

}

public function sa_bp($tgl_awal,$id_bp){
  if($id_bp==4){
    $s_data = "select 
    SUM(if(d.tipe like '1,2',sa.masuk-sa.masuk,0)) + SUM(if(d.tipe like '1',sa.masuk,0)) - SUM(if(d.tipe='2',sa.masuk,0)) as saldo_awal
    from tr_bku_saldo sa 
    left join vw_diagram d on sa.kd_trans = d.kode_diagram
    where sa.fk_sd=2 and DATE_FORMAT(sa.tgl,'%Y-%m-%d') < '".$tgl_awal."' and sa.fk_sd=2 and d.id_bp = ".$id_bp."
    order by sa.tgl ";
}else{
 $s_data = "select 
 SUM(if(d.tipe like '1,2',sa.masuk-sa.masuk,0)) + SUM(if(d.tipe like '1',sa.masuk,0)) - SUM(if(d.tipe='2',sa.keluar,0)) as saldo_awal
 from tr_bku_saldo sa 
 left join vw_diagram d on sa.kd_trans = d.kode_diagram
 where sa.fk_sd=2 and DATE_FORMAT(sa.tgl,'%Y-%m-%d') < '".$tgl_awal."' and sa.fk_sd=2 and d.id_bp = ".$id_bp."
 order by sa.tgl ";

}

$q_data = $this->db->query($s_data)->result_array();
$cek_data = $this->db->query($s_data);
if($cek_data->num_rows()>0){
    $q_data[0]['saldo_awal']=$q_data[0]['saldo_awal'];
}else{
    $q_data[0]['saldo_awal']=0;
}
return $q_data[0]['saldo_awal'];
}

}