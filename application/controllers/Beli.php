<?php 
//error_reporting(E_ALL ^ E_DEPRECATED);
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Beli extends Cek_Controller{
    //put your code here
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index(){
        $data['title'] = 'Data Pembelian';
        $data['subtitle'] = '';

        $this->load->view('design/header',$data);
        $this->load->view('transaksi/index',$data);
        $this->load->view('design/footer',$data);
    }

    public function list_beli(){
        $data = array();
        $limit = $this->input->post('limit');
        $start = $this->input->post('start');
        $id_jenis_penerimaan = $this->input->post('jenis_penerimaan');
        $start = date('Y-m-d', strtotime($start));
        $end = $this->input->post('end');
        $end = date('Y-m-d', strtotime($end));

        $s_where =$s_jenis_penerimaan = '';

        if($id_jenis_penerimaan==1){
            $s_jenis_penerimaan = " and fk_jenis_penerimaan = ".$id_jenis_penerimaan;
        }else{
            $s_jenis_penerimaan = '';
        }
        $s_limit = " limit ".$limit."";

        $s_date = " and DATE_FORMAT(tanggal,'%Y-%m-%d') BETWEEN '".$start."' and '".$end."' ";

        $s_where .= $s_date . $s_jenis_penerimaan .$s_limit;

        $s_data  = "select * from beli where 0=0  ".$s_where;
        $data['q_data']= $this->db->query($s_data);
        $this->load->view('transaksi/detail/list_beli',$data);
    }

    public function add(){
        $data = array();
        $data['title'] = 'Barang Masuk/ Beli';
        //$data['last_id'] = $this->last_id(array('nota'=>''));
        $data['id'] = '';
        $data['faktur'] = '';
        $data['tanggal_faktur'] = '';
        $data['jatuh_tempo'] = '';
        $data['no_kontrak'] = '';
        $data['supp'] = '';
        $data['diskon_rp'] = '';
        $data['diskon_persen'] = '';
        $data['grand_total'] = '';
        $data['bayar'] = '';
        $data['sisa'] = '';
        $data['note'] = '';
        $data['subtotal'] = 0;
        $data['act'] = 'add';

        $tanggal = date('Y-m-d');
        $id_jenis_penerimaan = 2;
        $data['nota'] = $this->cek_kode_beli($tanggal,$id_jenis_penerimaan);
        $this->load->view('design/header',$data);
        $this->load->view('transaksi/add',$data);
        $this->load->view('design/footer',$data);
    }

    public function edit(){
        $data = array();
        $data['title'] = 'Ubah Barang Masuk/ Beli';
        $id = $this->uri->segment(3);
        $s_header = "select * from beli where id = ".$id;
        $s_detail = "select det.id , det.fk_ms_beli, det.nota, det.id_barang, b.kode,b.nama,det.qty, 
        det.satuan, det.retur,det.hbeli, det.hjual, det.diskon_rp, det.diskon_persen, det.batch,det.expired, det.subtotal
        from detbeli det
        left join m_barang b on b.id_barang = det.id_barang
        where det.fk_ms_beli = ".$id;

        $row = $this->db->query($s_header)->row();

        $data['detail'] = $this->db->query($s_detail)->result();

        $data['id'] = $id;
        $data['nota'] = $row->nota;
        $data['faktur'] = $row->faktur;
        $data['tanggal_faktur'] = date('d-m-Y',strtotime($row->tanggalfaktur));
        $data['jatuh_tempo'] = date('d-m-Y',strtotime($row->tempo));
        $data['no_kontrak'] = $row->faktur;
        $data['supp'] = $row->supp;
        $data['diskon_rp'] = $row->diskon_rp;
        $data['diskon_persen'] = $row->diskon_persen;
        $data['subtotal'] = $row->subtotal;
        $data['grand_total'] = $row->total;
        $data['bayar'] = $row->bayar;
        $data['sisa'] = $row->sisa;
        $data['note'] = $row->note;


        $data['act'] = 'edit';
        
        $this->load->view('design/header',$data);
        $this->load->view('transaksi/add',$data);
        $this->load->view('design/footer',$data);
    }


    public function save_data_header($tb, $data){
        $this->db->insert('beli', $data);
        $last_id = $this->db->insert_id();
        return $last_id; 
    }

    function ambil_supplier(){
        $s_data = "select id_supp, kode, nama from m_supp ";
        $q_data = $this->db->query($s_data);

        echo json_encode($q_data->result());
    }

    public function simpan(){
        /*kode : kode,  no_faktur : no_faktur,  tanggal_faktur : tanggal_faktur,  no_kontrak : no_kontrak, supplier : supplier,            jatuh_tempo : jatuh_tempo,   subtotal : subtotal,  diskong_persen : diskong_persen, diskong_rp : diskong_rp, grand_total : grand_total, cash : cash,  change : change,  note : note,
        id_barang : id_barang, qty:qty, satuan:satuan, hbeli:hbeli, hjual:hjual,  batch:batch, expired:expired,  subtotal:subtotal, dsc_persen:dsc_persen, dsc_rp:dsc_rp, total:total,*/
        $upd = $this->session->userdata('u_id');
        $kode = $_POST['kode'];
        $no_faktur = $_POST['no_faktur'];
        $tanggal_faktur = $_POST['tanggal_faktur'];
        $no_kontrak = $_POST['no_kontrak'];
        $supplier = $_POST['supplier'];
        $jatuh_tempo = $_POST['jatuh_tempo'];
        $sub_total = $_POST['sub_total'];
        $diskong_persen = $_POST['diskong_persen'];
        $diskong_rp = $_POST['diskong_rp'];
        $grand_total = $_POST['grand_total'];
        $cash = $_POST['cash'];
        $change = $_POST['change'];
        $note = $_POST['note'];
        $id_beli = $_POST['id_beli'];
        $fk_jenis_penerimaan = 2;
        $act = $_POST['act'];

        if($act!='edit'){
            $dat_header = array(
            'nota' =>$kode,
            'tanggal'=>date('Y-m-d'),
            'faktur'=>$no_faktur,
            'tanggalfaktur'=>date('Y-m-d', strtotime($tanggal_faktur)),
            'tanggalact'=>date('Y-m-d H:i:s'),
            'supp'=>$supplier,
            'diskon_rp'=>$diskong_rp,
            'diskon_persen'=>$diskong_persen,
            'subtotal'=>$sub_total,
            'total'=>$grand_total,
            'bayar'=>$cash,
            'sisa'=>$change,
            'tempo'=>date('Y-m-d', strtotime($jatuh_tempo)),
            'note'=>$note,
            'opr'=>$upd,
            'fk_jenis_penerimaan'=>$fk_jenis_penerimaan
            );
            $last_id = $this->save_data_header('beli', $dat_header);
             //insert into detail beli
            $dat =$dat_ks = array();
            foreach ($_POST['id_barang'] as $in => $val) {
                if($val!=''){
                    $dat = array(
                        'fk_ms_beli'=> $last_id,
                        'nota'=> $kode,
                        'id_barang'=> $_POST['id_barang'][$in],
                        'qty'=> $_POST['qty'][$in],
                        'satuan'=> $_POST['satuan'][$in],
                        'hbeli'=> $_POST['hbeli'][$in],
                        'hjual'=> $_POST['hjual'][$in],
                        'diskon_persen'=> $_POST['dsc_persen'][$in],
                        'diskon_rp'=> $_POST['dsc_rp'][$in],
                        'batch'=> $_POST['batch'][$in],
                        'expired'=> $_POST['expired'][$in],
                        'subtotal'=> $_POST['subtotal'][$in]
                        );
                    $this->db->insert('detbeli', $dat);

                    $dat_ks = array(
                        'kode_stok'=>$kode,
                        'fk_ms_barang'=>$_POST['id_barang'][$in],
                        'tanggal_trans'=>date('Y-m-d', strtotime($tanggal_faktur)),
                        'tanggal_act'=>date('Y-m-d H:i:s'),
                        'no_bukti'=>$no_faktur,
                        'debet'=> $_POST['qty'][$in] * $_POST['hbeli'][$in] ,
                        'kredit'=> 0,
                        'qty_in'=> $_POST['qty'][$in],
                        'qty_out'=> 0,
                        'fk_ms_satuan'=> $_POST['satuan'][$in],
                        'keterangan'=> $note,
                        'fk_ms_user'=> $upd,
                        'fk_ref'=> $last_id,
                        'tipetrans'=> $fk_jenis_penerimaan,
                        'hbeli'=>  $_POST['hbeli'][$in],
                        'hjual'=> $_POST['hjual'][$in],
                        'expired_date'=>date('Y-m-d', strtotime($_POST['expired'][$in])),
                        'batch'=> $_POST['batch'][$in]
                        );
                    $this->db->insert('t_kartustok',$dat_ks);
                }
            }
            redirect('beli','refresh');
            
        }else{
            //update header beli
            $dat_header = array(
            'nota' =>$kode,
            'tanggal'=>date('Y-m-d'),
            'faktur'=>$no_faktur,
            'tanggalfaktur'=>date('Y-m-d', strtotime($tanggal_faktur)),
            'tanggalact'=>date('Y-m-d H:i:s'),
            'supp'=>$supplier,
            'diskon_rp'=>$diskong_rp,
            'diskon_persen'=>$diskong_persen,
            'subtotal'=>$sub_total,
            'total'=>$grand_total,
            'bayar'=>$cash,
            'sisa'=>$change,
            'tempo'=>date('Y-m-d', strtotime($jatuh_tempo)),
            'fk_jenis_penerimaan'=>$fk_jenis_penerimaan,
            'note'=>$note,
            'opr'=>$upd,
            );

            $key = array('id'=>$id_beli, 'nota'=>$kode);
            
            $this->db->update('beli',$dat_header,$key);

            //hapus detbeli,kartustok
            echo "hapus, insert";
            $this->db->query("delete from detbeli where fk_ms_beli=".$id_beli);
            $this->db->query("delete from t_kartustok where fk_ref=".$id_beli);

            foreach ($_POST['id_barang'] as $in => $val) {
                if($val!=''){
                    $dat = array(
                        'fk_ms_beli'=> $id_beli,
                        'nota'=> $kode,
                        'id_barang'=> $_POST['id_barang'][$in],
                        'qty'=> $_POST['qty'][$in],
                        'satuan'=> $_POST['satuan'][$in],
                        'hbeli'=> $_POST['hbeli'][$in],
                        'hjual'=> $_POST['hjual'][$in],
                        'diskon_persen'=> $_POST['dsc_persen'][$in],
                        'diskon_rp'=> $_POST['dsc_rp'][$in],
                        'batch'=> $_POST['batch'][$in],
                        'expired'=> date('Y-m-d', strtotime($_POST['expired'][$in])),
                        'subtotal'=> $_POST['subtotal'][$in]
                        );
                    $this->db->insert('detbeli', $dat);

                    $dat_ks = array(
                        'fk_ref'=> $id_beli,
                        'kode_stok'=>$kode,
                        'fk_ms_barang'=>$_POST['id_barang'][$in],
                        'tanggal_trans'=>date('Y-m-d', strtotime($tanggal_faktur)),
                        'tanggal_act'=>date('Y-m-d H:i:s'),
                        'no_bukti'=>$no_faktur,
                        'debet'=> $_POST['qty'][$in] * $_POST['hbeli'][$in] ,
                        'kredit'=> 0,
                        'qty_in'=> $_POST['qty'][$in],
                        'qty_out'=> 0,
                        'fk_ms_satuan'=> $_POST['satuan'][$in],
                        'keterangan'=> $note,
                        'fk_ms_user'=> $upd,                        
                        'tipetrans'=> $fk_jenis_penerimaan,
                        'hbeli'=>  $_POST['hbeli'][$in],
                        'hjual'=> $_POST['hjual'][$in],
                        'expired_date'=>date('Y-m-d', strtotime($_POST['expired'][$in])),
                        'batch'=> $_POST['batch'][$in],
                        );
                     $this->db->insert('t_kartustok',$dat_ks);
                     //update fk_id_trans
                     
                     $id_trans = $this->cek_id_trans($_POST['id_barang'][$in],$id_beli,$_POST['batch'][$in]);
                     $s_update = "update t_kartustok set fk_id_trans=".$id_trans." where fk_ms_barang = ".$_POST['id_barang'][$in]." and fk_ref = ".$id_beli." and batch = '".$_POST['batch'][$in]."'";
                     $this->db->query($s_update);
                     echo $s_update."<br>";
                }
            }
            redirect('beli/edit/'.$id_beli,'refresh');
        }


    }

    public function cek_id_trans($id_barang,$fk_ref,$batch){
        $s_cek  = $this->db->query("select id from detbeli where id_barang = ".$id_barang." and fk_ms_beli=".$fk_ref." and batch='".$batch."'")->row();
        $id = $s_cek->id;
        return $id;
    }

    public function barang_get(){
        $g = $_GET;
        $src = $g['term'];
        $limit = $g['limit'];
        /*$s_query = "select id_barang,kode, nama, id_jenis, jenis, satuan, stok, beli, jual1 as jual
        from m_barang where nama like '%".$src."%' limit ".$limit."";*/
        $s_query = "select * from vw_stok where nama like '%".$src."%' limit ".$limit."";
        $a = $this->db->query($s_query)->result();
        $suburbs = array();
        foreach ($a as $d) {
            $suburbs[] = array(
                'ID'=> $d->id_barang,
                'nama'=> $d->nama,
                'kode'=> $d->kode,
                'satuan'=> $d->satuan,
                'jenis'=> $d->jenis,
                'stok'=> $d->stok,
                'beli'=> $d->hbeli,
                'jual'=> $d->hjual,
                'id_jenis'=> $d->id_jenis
                );
        }
        echo json_encode( $suburbs );

    }

    //select * from beli where DATE_FORMAT(tanggal,'%Y-%m')='2020-04' order by nota desc

    function cek_kode_beli($tanggal, $fk_jenis_penerimaan){
        $tgl_kode = date('mY',strtotime($tanggal));
        $tgl_cek = date('Y-m',strtotime($tanggal));
        $q = $this->db->query("SELECT MAX(RIGHT(nota,6)) as kd_max from beli where DATE_FORMAT(tanggal,'%Y-%m')='".$tgl_cek."' and fk_jenis_penerimaan = ".$fk_jenis_penerimaan." order by nota desc");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
        return 'B'.$tgl_kode.'-'.$kd;
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


    function saldo_awal(){
        $data['title'] = 'Data Saldo Awal';
        $data['subtitle'] = '';

        $this->load->view('design/header',$data);
        $this->load->view('saldo_awal/index',$data);
        $this->load->view('design/footer',$data);
    }

    public function add_sawal(){
        $data = array();
        $data['title'] = 'Saldo Awal';
        $data['id'] = '';
        $data['faktur'] = '';
        $data['tanggal_faktur'] = '';
        $data['jatuh_tempo'] = '';
        $data['no_kontrak'] = '';
        $data['supp'] = '';
        $data['diskon_rp'] = '';
        $data['diskon_persen'] = '';
        $data['grand_total'] = '';
        $data['bayar'] = '';
        $data['sisa'] = '';
        $data['note'] = '';
        $data['subtotal'] = 0;
        $data['act'] = 'add';

        $tanggal = date('Y-m-d');
        $id_jenis_penerimaan = 1;
        $data['nota'] = $this->cek_kode_beli($tanggal,$id_jenis_penerimaan);
        $this->load->view('design/header',$data);
        $this->load->view('saldo_awal/add',$data);
        $this->load->view('design/footer',$data);
    }
}
