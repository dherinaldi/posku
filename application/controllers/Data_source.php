<?php 
error_reporting(E_ALL ^ E_DEPRECATED);
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_source extends Cek_Controller{
    //put your code here
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index(){
		$data['title'] = "Data Sumber dari SIMRS";
		$this->load->view('design/header',$data);
		$this->load->view('data/index',$data);
		$this->load->view('design/footer',$data);
	}

	public function list_simrs(){		
		$simrs = $this->load->database('simrs', TRUE);

		$tgl_awal =$_POST['tgl_awal'];

		$s_where = " where 0=0 ";
		if($tgl_awal !=''){
			$tgl_awal = date('Y-m-d ',strtotime($tgl_awal));
		}else{
			$tgl_awal = $tgl_awal;
		}


		/*$s_date = " and ( DATE( a.TANGGAL ) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' ) ";*/
		$s_date = " and date_format(a.TANGGAL,'%Y-%m-%d')='".$tgl_awal."' ";

		$s_where .=$s_date;
		echo $s_where;


		$s_data = "SELECT b.kode,
		b.nama AS klinik,
		c.nama_tindakan,
		c.kode_tindakan,
		a.TARIFRS as tarifrs ,
		SUM( CASE WHEN a.CARABAYAR = 1 THEN a.QTY ELSE 0 END ) AS jumlah_umum,
		SUM( CASE WHEN a.CARABAYAR = 1 THEN a.TARIFRS * a.QTY ELSE 0 END ) AS total_umum,
		SUM( CASE WHEN a.CARABAYAR > 1 THEN a.QTY ELSE 0 END ) AS jumlah_jamin,
		SUM( CASE WHEN a.CARABAYAR > 1 THEN a.TARIFRS * a.QTY ELSE 0 END ) AS total_jamin,
		SUM( a.QTY ) AS jumlah,
		SUM( a.TARIFRS * a.QTY ) AS total 
		FROM
		t_billrajal a
		LEFT JOIN m_poly b ON b.kode = a.UNIT
		LEFT JOIN m_tarif c ON c.kode_tindakan = a.KODETARIF 
		".$s_where." 
		GROUP BY
		b.kode,
		c.nama_tindakan;";
		//echo $s_data;
		$q_data = $simrs->query($s_data);
		
		$data['title'] = "List Data SIMRS periode ".$tgl_awal." ";
		$data['data'] = $q_data;
		$this->load->view('data/list_simrs',$data);

	}

	public function get_kode_simrs($kode,$tanggal)
	{
		$q = $this->db->query("select max(RIGHT(kode_tr,5)) as kd_max from tr_data_simrs where 0=0 and DATE_FORMAT(periode,'%Y-%m-%d')  = '".$tanggal."'");
		$kd = "";
		$tanggal = date('Ymd',strtotime($tanggal));
		if($q->num_rows()>0)
		{
			$k = $q->row();
			$tmp = ((int)$k->kd_max)+1;
			$kd = sprintf("%05s", $tmp);
		}
		else
		{
			$kd = "00001";
		}
		return $kode."-".$tanggal.$kd;
        //return $tmp;
	}

	public function cek_data_simrs($kode_klinik,$kode_tindakan,$periode){
		$s ="select kode_tr from tr_data_simrs 
		where 0=0 and kode_tindakan = '".$kode_tindakan."' and kode_klinik = ".$kode_klinik." and  DATE_FORMAT(periode,'%Y-%m-%d')  = '".$periode."'";
			//echo $s;
		$q = $this->db->query($s);
		if($q->num_rows()>0){
			$k =$q->row();
			$res = $k->kode_tr;
		}else{
			$res = "";
		}
		return $res;

	}

	public function simpan_data_simrs(){
		$tgl_awal = $this->input->get_post('tgl_awal');
		$chk = $this->input->get_post('chk');
		$tarifrs = $this->input->get_post('tarifrs');
		$kode_tindakan = $this->input->get_post('kode_tindakan');
		$umum = $this->input->get_post('umum');
		$tumum = $this->input->get_post('tumum');
		$jamin = $this->input->get_post('jamin');
		$tjamin = $this->input->get_post('tjamin');
		$jum = $this->input->get_post('jum');
		$tot = $this->input->get_post('tot');
		$kode_klinik = $this->input->get_post('kode_klinik');

		$periode = date('Y-m-d ',strtotime($tgl_awal));

		$id = $this->session->userdata('u_id');
		$urut=1;
		
		$c_chk = count($chk);
		$dt_upd =$dt_in= 0;
		if($c_chk>0){
			for ($i=0; $i <$c_chk ; $i++) {
				$cek = $this->cek_data_simrs($kode_klinik[$i],$kode_tindakan[$i],$periode);
				if($cek!=''){
					//echo 'update';
					$string ="update tr_data_simrs 
					set kode_klinik = ".$kode_klinik[$i].", kode_tindakan ='".$kode_tindakan[$i]."',  tarifrs =".$tarifrs[$i].", umum =".$umum[$i].", tumum =".$tumum[$i].",jamin =".$jamin[$i].",tjamin =".$tjamin[$i].",jumlah =".$jum[$i].",total =".$tot[$i].",periode ='".$periode."',oleh =".$id.",date_at ='".date('Y-m-d H:i:s')."'
					where kode_tr = '".$cek."'";
					 //echo $string;
					$this->db->query($string);
					$dt_upd++;
				}else{
					//get kode tr_simrs
					$kode_tr = $this->get_kode_simrs("SIMRS",$periode);
					$string = "INSERT INTO `tr_data_simrs`(`kode_tr`, `kode_klinik`, `kode_tindakan`, `tarifrs`, `umum`, `tumum`, `jamin`, `tjamin`, `jumlah`, `total`, `periode`, `oleh`, `date_at`) VALUES ('".$kode_tr."', ".$kode_klinik[$i].", '".$kode_tindakan[$i]."', ".$tarifrs[$i].",".$umum[$i].", ".$tumum[$i].", ".$jamin[$i].", ".$tjamin[$i].", ".$jum[$i].", ".$tot[$i].",'".$periode."', ".$id.", '".date('Y-m-d H:i:s')."')";
				//echo $string."<br>";
					$this->db->query($string);
					$urut++;
					$dt_in++;
				}

			}
			echo "data update ".$dt_upd." dan data masuk ".$dt_in;
		}else{
			echo "data kosong";
		}
	}

	public function pendapatan_simrs(){
		$data['title'] = "Data Fix Siaku dari SIMRS";
		$this->load->view('design/header',$data);
		$this->load->view('data/pendapatan_simrs',$data);
		$this->load->view('design/footer',$data);
	}

	public function list_pendapatan_simrs(){
		$simrs = $this->load->database('simrs', TRUE);
		$tgl_awal =$_POST['tgl_awal'];
		$tgl_akhir =$_POST['tgl_akhir'];

		$s_where = " where 0=0 ";
		if($tgl_awal !=''){
			$tgl_awal = date('Y-m-d ',strtotime($tgl_awal));
			$tgl_akhir = date('Y-m-d ',strtotime($tgl_akhir));
		}else{
			$tgl_awal = $tgl_awal;
			$tgl_akhir = $tgl_akhir;
		}

		$s_date = " and date_format(periode,'%Y-%m-%d') between '".$tgl_awal."' and '".$tgl_akhir."' ";
		$s_where .=$s_date;

		$s_simrs = " SELECT a.TANGGAL,
		SUM( CASE WHEN a.CARABAYAR = 1 THEN a.QTY ELSE 0 END ) AS jumlah_umum, SUM( CASE WHEN a.CARABAYAR = 1 THEN a.TARIFRS * a.QTY ELSE 0 END )
		AS total_umum, SUM( CASE WHEN a.CARABAYAR > 1 THEN a.QTY ELSE 0 END ) AS jumlah_jamin, SUM( CASE WHEN a.CARABAYAR > 1 THEN a.TARIFRS * a.QTY 
			ELSE 0 END ) AS total_jamin, SUM( a.QTY ) AS jumlah, SUM( a.TARIFRS * a.QTY ) AS total
FROM t_billrajal a LEFT JOIN m_poly b ON b.kode = a.UNIT LEFT JOIN m_tarif c ON c.kode_tindakan = a.KODETARIF where 0=0 and date_format(a.TANGGAL,'%Y-%m-%d') between '".$tgl_awal."' and '".$tgl_akhir."'";

$q_simrs = $simrs->query($s_simrs);
$dt_simrs = $q_simrs->row();
$data['j_umum_simrs']=$dt_simrs->jumlah_umum;
$data['t_umum_simrs']=$dt_simrs->total_umum;
$data['j_jamin_simrs']=$dt_simrs->jumlah_jamin;
$data['t_jamin_simrs']=$dt_simrs->total_jamin;
$data['jum_simrs']=$dt_simrs->jumlah;
$data['tot_simrs']=$dt_simrs->total;


$s = "select * from vw_list_data_simrs ".$s_where ."";
$data['title'] = "List Pendapatan SIAKU <=> SIMRS periode ".$tgl_awal." ";
$data['data'] = $this->db->query($s);
$this->load->view('data/list_pendapatan_simrs',$data);

}

public function rajaongkir(){
	$this->load->view('data/rajaongkir');
}

public function cek_kabupaten(){

	$provinsi_id = $_GET['prov_id'];

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$provinsi_id",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"key: 7cf558c7df1c3cd152ed1836e5990630"
			),
		));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
  //echo $response;
	}

	$data = json_decode($response, true);
	for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
		echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
	}

}

public function cek_ongkir(){
	$asal = $_POST['asal'];
	$id_kabupaten = $_POST['kab_id'];
	$kurir = $_POST['kurir'];
	$berat = $_POST['berat'];

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "origin=".$asal."&destination=".$id_kabupaten."&weight=".$berat."&courier=".$kurir."",
		CURLOPT_HTTPHEADER => array(
			"content-type: application/x-www-form-urlencoded",
			"key: 7cf558c7df1c3cd152ed1836e5990630"
			),
		));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {	  echo "cURL Error #:" . $err;
} else {
	echo $response;
}

}

public function hapus_pendapatan(){
	$chk = $this->input->get_post('chk');
	$kode_tr = $this->input->get_post('kode_tr');
	$c_chk = count($chk);
	for ($i=0; $i <$c_chk ; $i++) {
		$string = "delete from tr_data_simrs where kode_tr ='".$kode_tr[$i]."'";
		$this->db->query($string);
	}
}

public function dashboard_pendapatan(){
	$tgl_awal =$_POST['tgl_awal'];
	$tgl_akhir =$_POST['tgl_akhir'];

	$s_where = " where 0=0 ";
	if($tgl_awal !=''){
		$tgl_awal = date('Y-m-d ',strtotime($tgl_awal));
	}else{
		$tgl_awal = $tgl_awal;
	}

	if($tgl_akhir !=''){
		$tgl_akhir = date('Y-m-d ',strtotime($tgl_akhir));
	}else{
		$tgl_akhir = $tgl_akhir;
	}

	echo $tgl_akhir;

}

}