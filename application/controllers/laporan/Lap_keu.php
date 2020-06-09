<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_keu extends Cek_Controller{
    //put your code here
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index(){
        $data['title'] = 'Laporan Transaksi Keuangan';
        $data['title_d'] = 'Data Keuangan';
        $this->load->view('design/header');
        $this->load->view('lap_keu/lap_keu',$data);
        $this->load->view('design/footer');
    }

    public function lap_saldo(){
        $data['title'] = 'Laporan Saldo Keuangan';
        $data['title_d'] = 'Data Saldo Keuangan';
        $this->load->view('design/header');
        $this->load->view('lap_keu/lap_saldo',$data);
        $this->load->view('design/footer');
    }

    public function lap_pajak(){
        $data['title'] = 'Laporan Data Pajak ';
        $data['title_d'] = 'Data Pajak';
        $this->load->view('design/header');
        $this->load->view('lap_keu/lap_pajak',$data);
        $this->load->view('design/footer');
    }

    public function lap_BP(){
        $tipe = $this->uri->segment(4);

        $s_tipe = "select nama from m_jenis_bp where id=".$tipe."";
        $q_tipe =$this->db->query($s_tipe)->result_array();

        $data['title'] = "Laporan Data ".$q_tipe[0]['nama']."";
        $data['title_d'] = "Data ".$q_tipe[0]['nama']."";

        $data['tipe']=$tipe;
        $this->load->view('design/header');
        $this->load->view('lap_keu/lap_bp',$data);
        $this->load->view('design/footer');
    }

}