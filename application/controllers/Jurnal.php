<?php 
error_reporting(E_ALL ^ E_DEPRECATED);
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jurnal extends Cek_Controller{
    //put your code here
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index(){
		$data['title'] = "Jurnal Umum Pendapatan";
		$this->load->view('design/header',$data);
		$this->load->view('jurnal/index',$data);
		$this->load->view('design/footer',$data);
	}

	public function list_jurnal_umum(){
		$data = array();
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

		$s_date = " and date_format(ju.periode,'%Y-%m-%d') between '".$tgl_awal."' and '".$tgl_akhir."'";

		$s_where .=$s_date;
		echo $s_where;

		$string ="SELECT ju.id,ju.kode_jurnal,ju.kode_pendapatan,ju.no_bukti,ju.no_akun,ju.nama_rekening,ju.debet,ju.kredit,ju.qty_in,ju.qty_out,ju.tarifrs, ju.periode,ds.umum,ds.tumum
		FROM `tr_jurnal_umum` ju left join tr_data_simrs ds on ds.kode_tr = ju.kode_pendapatan ".$s_where."";
		$data['title'] ="List Jurnal Umum";
		$data['data'] = $this->db->query($string);
		$this->load->view('jurnal/list_jurnal_umum',$data);
	}

}
