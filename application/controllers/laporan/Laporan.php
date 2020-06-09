<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_laporan');
		$this->load->library('breadcrumb1');
	}

	public function index()
	{


		$data['home'] = $this->breadcrumb1->add('Home', base_url());
		$data['tutorial'] = $this->breadcrumb1->add('Tutorials', base_url().'#');		
		$data['spring'] = $this->breadcrumb1->add('Spring Tutorial', base_url().'#');

		$data['dt_laporan'] = $this->m_laporan->manualQuery('select * from v_laporan');
		$data['dt_distribusi'] = $this->m_laporan->manualQuery('select * from v_distribusi');

		$data['total'] = $this->m_laporan->manualQuery('select sum(tbl_pengadaan_detail.subtotal) as total, sum(tbl_pengeluaran_detail.subtotal) total_pengeluaran from data_barang left join tbl_pengadaan_detail on tbl_pengadaan_detail.id_barang = data_barang.id_barang left join tbl_pengadaan_header on tbl_pengadaan_header.id_pengadaan = tbl_pengadaan_detail.id_pengadaan
left join tbl_pengeluaran_detail on tbl_pengeluaran_detail.id_barang=data_barang.id_barang
left join tbl_pengeluaran_header on tbl_pengeluaran_header.id_pengeluaran = tbl_pengeluaran_detail.id_pengeluaran');
		$this->load->view('design/header');
		$this->load->view('laporan/laporan_master', $data);
		$this->load->view('design/footer');
	}
	function laporan_stok(){
		/*$data= array();*/
		$data['title'] = "Laporan Data Persediaan";
		$data['dt_persediaan'] = $this->m_laporan->manualQuery('select * from v_persediaan');
		$this->load->view('design/header');
		$this->load->view('laporan/laporan_stok_persediaan', $data);
		$this->load->view('design/footer');
	}
	function laporan_distribusi(){
		$data['title'] = "Laporan Data Distribusi";
		$data['dt_distribusi'] = $this->m_laporan->manualQuery('select * from v_laporan_distribusi');
		$this->load->view('design/header');
		$this->load->view('laporan/laporan_distribusi', $data);
		$this->load->view('design/footer');
	}

	function laporan_pengadaan_detail(){
		$data['title'] = "Laporan Data Pengadaan";
		$data['pengadaan'] = $this->m_laporan->manualQuery('select tph.id_pengadaan ,tph.kd_pengadaan,tph.total_harga,tph.tanggal_pengadaan,tph.kode_penyedia,
(select count(tbl_pengadaan_detail.qty) from tbl_pengadaan_detail where tbl_pengadaan_detail.id_pengadaan = tph.id_pengadaan) as jumlah
from tbl_pengadaan_header as tph
order by tph.kd_pengadaan desc');
		$this->load->view('design/header');
		$this->load->view('laporan/laporan_pengadaan', $data);
		$this->load->view('design/footer');

	}
	function laporan_pengadaan_detail2(){
		$data['title'] = "Laporan Data Pengadaan Detail";
		$data['dt_pengadaan'] = $this->m_laporan->manualQuery('select * from v_pengadaan');
		$this->load->view('design/header');
		$this->load->view('laporan/laporan_pengadaan_detail', $data);
		$this->load->view('design/footer');
	}

	function cari_laporan_pengadaan(){
		$data['title'] = "Laporan Data Pengadaan Detail";
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		/*split data tanggal*/
		if ($start!="" and $end!=""){
			$start = explode("-",$start);
			$start = $start[2].'-'.$start[1].'-'.$start[0];
			$end = explode("-",$end);
			$end = $end[2].'-'.$end[1].'-'.$end[0];
		}else{
			$start ="";
			$end ="";
		}

		$data['dt_pengadaan'] = $this->m_laporan->detail_pengadaan($start,$end,$bulan,$tahun);
		$this->load->view('laporan/laporan_pengadaan_detail', $data);
		
	}

	function detail_pengadaan(){
        $id= $this->uri->segment(4);
        $data=array(
            'title'=>'Detail Pengadaan Barang',
            'dt_pengadaan'=>$this->m_laporan->getDataPengadaan($id),
            'barang_pengadaan'=>$this->m_laporan->getBarangPengadaan($id),
        );
        $this->load->view('design/header');
        $this->load->view('laporan/detail/detail_pengadaan',$data);
        $this->load->view('design/footer');
    }

	function laporan_distribusi_detail(){
		$data['title'] = "Laporan Data Distribusi";
		$data['data_amprah'] = $this->m_laporan->manualQuery('select * from v_amprah');
		$this->load->view('design/header');
		$this->load->view('laporan/laporan_distribusi', $data);
		$this->load->view('design/footer');
		
	}
	function laporan_home_pengadaan(){
		$data['title'] = "Laporan Data Pengadaan";
		$this->load->view('design/header');
		$this->load->view('laporan/laporan_home_pengadaan', $data);
		$this->load->view('design/footer');
	}

	function laporan_distribusi_detail2(){
		$data['title'] = "Laporan Data Distribusi Detail";
		
		$data['data_amprah'] = $this->m_laporan->manualQuery('select * from v_amprah_detail');
		$this->load->view('design/header');
		$this->load->view('laporan/laporan_distribusi_detail', $data);
		$this->load->view('design/footer');
	}

	function detail_amprah(){
 	$id['id_amprah'] = $this->uri->segment(4);
 	$data['title'] = "View Data Amprah";
 	$data['dt_amprah'] = $this->m_laporan->getSelectedData("v_amprah",$id);
 	$data['detail_amprah'] = $this->m_laporan->getSelectedData("v_amprah_detail",$id);
 	$data['total_barang'] = $this->m_laporan->manualQuery("select sum(tad.qty) as total_barang from tbl_amprah_detail as tad where tad.id_amprah =".$id['id_amprah']."");
 	$this->load->view('design/header');
	$this->load->view('laporan/detail/detail_amprah', $data);
	$this->load->view('design/footer');

 }

}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */