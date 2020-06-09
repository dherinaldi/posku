<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_print extends Cek_Controller{
    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->load->model('App_model');
        $this->model = $this->app_model;
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index(){
        $data['title'] = 'Laporan Transaksi Keuangan';
        $data['title_d'] = 'Data Keuangan';

        $data['q_dt'] = $this->db->query("select * from vw_tr_keu order by tgl desc limit 100");
        $this->load->view('lap_print/lap_keu',$data);
    }

    public function lap_pajak(){
        $data['title'] = 'Laporan Rekapitulasi Transaksi Pajak';
        $data['title_d'] = 'Data Pajak';

        $tgl_awal = GetRequest('tgl_awal','','');
        $tgl_akhir = GetRequest('tgl_akhir','','');
        $tgl_awal = date('Y-m-d',strtotime($tgl_awal));
        $tgl_akhir = date('Y-m-d',strtotime($tgl_akhir));

        /*print_r($_REQUEST);
        print_r($_POST);
        print_r($_GET);
        echo $_SERVER['REQUEST_URI'];*/
        echo GetRequest('tgl_awal','','');

        $data['s_periode'] = date('d-m-Y',strtotime($tgl_awal))." s/d ".date('d-m-Y',strtotime($tgl_akhir));

        $data['q_dt'] = $this->db->query("select p.id_pajak,p.kode as kode_pajak, p.kd_akun,p.nama as nama_pajak,
            COALESCE((SELECT `f_tot_pajak`(p.id_pajak, '".$tgl_awal."', '".$tgl_akhir."') ),0) as hasil from m_pajak p");


        if( GetRequest('excel','','') == 1){
            $s_periode = date('d-m-Y',strtotime($tgl_awal))." s/d ".date('d-m-Y',strtotime($tgl_akhir));;
            $file = "Pajak ".$s_periode.".xls";
            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=$file");
            $data['excel_stt'] = 1;
        }
        $this->load->view('lap_print/lap_pajak',$data);
    }

    public function lap_saldo(){
        $data['title'] = 'Laporan Rekapitulasi Transaksi Saldo';
        $tgl_awal = GetRequest('tgl_awal','','');
        $tgl_akhir = GetRequest('tgl_akhir','','');
        $tgl_awal = date('Y-m-d',strtotime($tgl_awal));
        $tgl_akhir = date('Y-m-d',strtotime($tgl_akhir));

        $data['s_periode'] = date('d-m-Y',strtotime($tgl_awal))." s/d ".date('d-m-Y',strtotime($tgl_akhir));

        //rekap data RM 
        $dt  = "select mak.mak_fix,mak.klasifikasi_akun_mak as nama_mak, 
        COALESCE((SELECT f_tot_saldo(mak.mak_fix, 1,'2018-01-01')),0) as jan ,
        COALESCE((SELECT f_tot_saldo(mak.mak_fix, 1,'2018-02-01')),0) as feb ,
        COALESCE((SELECT f_tot_saldo(mak.mak_fix, 1,'2018-03-01')),0) as mar ,
        COALESCE((SELECT f_tot_saldo(mak.mak_fix, 1,'2018-04-01')),0) as apr ,
        COALESCE((SELECT f_tot_saldo(mak.mak_fix, 1,'2018-05-01')),0) as mei ,
        COALESCE((SELECT f_tot_saldo(mak.mak_fix, 1,'2018-06-01')),0) as jun ,
        COALESCE((SELECT f_tot_saldo(mak.mak_fix, 1,'2018-07-01')),0) as jul ,
        COALESCE((SELECT f_tot_saldo(mak.mak_fix, 1,'2018-08-01')),0) as agu ,
        COALESCE((SELECT f_tot_saldo(mak.mak_fix, 1,'2018-09-01')),0) as sep ,
        COALESCE((SELECT f_tot_saldo(mak.mak_fix, 1,'2018-10-01')),0) as okt ,
        COALESCE((SELECT f_tot_saldo(mak.mak_fix, 1,'2018-11-01')),0) as nov ,
        COALESCE((SELECT f_tot_saldo(mak.mak_fix, 1,'2018-12-01')),0) as des 
        from m_mak mak";
        $data['q_dt'] = $this->db->query($dt);

        $this->load->view('lap_print/lap_saldo',$data);

    }

    public function lap_bp(){
        $tipe = GetRequest('tipe','','');
        $tgl_awal = GetRequest('tgl_awal','','');
        $tgl_akhir = GetRequest('tgl_akhir','','');

        $tgl_awal = date('Y-m-d',strtotime($tgl_awal));
        $tgl_akhir = date('Y-m-d',strtotime($tgl_akhir));

        $data['s_periode'] = date('d-m-Y',strtotime($tgl_awal))." s/d ".date('d-m-Y',strtotime($tgl_akhir));
        $s_tipe = "select nama from m_jenis_bp where id=".$tipe."";
        $q_tipe = $this->db->query($s_tipe)->result_array();

        $data['title'] = "Laporan Rekapitulasi Data ".$q_tipe[0]['nama']."";

        
        $s_data = "select sa.id_bku_saldo,sa.kode_bku,sa.no_bku,sa.mak,sa.uraian, sa.masuk,sa.keluar,sa.fk_sd,sa.tgl,d.kode_diagram,d.id_bp,  d.tipe as tipe_diagram
        from tr_bku_saldo sa 
        left join vw_diagram d on sa.kd_trans = d.kode_diagram
        where sa.fk_sd=2 and DATE_FORMAT(sa.tgl,'%Y-%m-%d') BETWEEN '".$tgl_awal."' and '".$tgl_akhir."' and sa.fk_sd=2 and d.id_bp = ".$tipe."
        order by sa.tgl";
        
        $data['sa'] = $this->model->sa_bp($tgl_awal,$tipe);
        $data['q_data'] =$this->db->query($s_data);

        $this->load->view("lap_print/lap_bp",$data);

    }





}