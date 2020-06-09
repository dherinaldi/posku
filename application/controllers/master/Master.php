<?php 
error_reporting(E_ALL ^ E_DEPRECATED);
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends Cek_Controller{
    //put your code here
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index(){
        $data['title'] = 'Master Sasaran Strategis';
        $data['subtitle'] = '';
        $s_sasaran = "select * from m_sasaran ms left join m_perspektif mp on ms.id_perspektif=mp.id_perspektif";
        $data['q_s'] =$this->db->query($s_sasaran);

        $this->load->view('design/header',$data);
        $this->load->view('master/m_sasaran',$data);
        $this->load->view('design/footer',$data);
    }

    function add_sasaran(){
        $data = array(
            'title'=>'Add Sasaran Strategis',
            'subtitle'=>'',
            'act'=>'add',
            'id_sasaran'=>'',
            'nama_sasaran'=>'',
            'urut'=>'',
            );
        /*$s_p = "select * from m_perspektif";
        $data['q_p'] =$this->db->query($s_p);*/

        $this->load->view('design/header',$data);
        $this->load->view('master/add_sasaran',$data);
        $this->load->view('design/footer',$data);
    }

    function edit_sasaran(){
        $id= $this->uri->segment(4);        

        $s_sasaran = "select * from m_sasaran where id_sasaran=".$id."";
        $q_sasaran =$this->db->query($s_sasaran);

        foreach ($q_sasaran->result() as $key) {
            $data = array(
                'title'=>'Ubah Sasaran Strategis',
                'subtitle'=>'',
                'act'=>'edit',
                'id_sasaran'=>$key->id_sasaran,
                'nama_sasaran'=>$key->nama_sasaran,
                'id_perspektif'=>$key->id_perspektif,
                'urut'=>$key->urut,
                );
        }

        $this->load->view('design/header',$data);
        $this->load->view('master/add_sasaran',$data);
        $this->load->view('design/footer',$data);
    }

    function simpan_sasaran(){
        $act = $this->input->post('act');
        $id_sasaran = $this->input->post('id_sasaran');
        $urut = $this->input->post('urut');
        $nama_sasaran = $this->input->post('nama_sasaran');
        $id_perspektif = $this->input->post('id_perspektif');
        $tanggal = date('Y-m-d H:i:s');
        $upd = $this->session->userdata('u_id');

        $tb = 'm_sasaran';
        if($act=="add"){
            $in = array(
                'nama_sasaran'=>$nama_sasaran,
                'id_perspektif'=>$id_perspektif,
                'urut'=>$urut,
                'tanggal'=>$tanggal,
                'upd'=>$upd,
                );
            print_r(array('in'=>$in));
            $ins = $this->db->insert($tb,$in);
            $msg ="Data berhasil ditambahkan...";
        }else{
            $key = array(
                'id_sasaran'=>$id_sasaran
                );
            $up = array(
                'nama_sasaran'=>$nama_sasaran,
                'id_perspektif'=>$id_perspektif,
                'urut'=>$urut,
                'tanggal'=>$tanggal,
                'upd'=>$upd,
                );
            print_r(array('key'=>$key,'up'=>$up));
            $u = $this->db->update($tb,$up,$key);
            $msg ="Data berhasil diubah...";
        }

        echo "<script>window.alert('".$msg."');
        window.location='".base_url('master/master')."'</script>";

        /*$this->session->set_flashdata('result', $msg);
        redirect('master/master','refresh');*/

    }

    public function perspektif(){
        $data['title'] = 'Master Perspektif';
        $data['subtitle'] = '';
        $s_p = "select * from m_perspektif";
        $data['q_p'] =$this->db->query($s_p);

        $this->load->view('design/header',$data);
        $this->load->view('master/m_perspektif',$data);
        $this->load->view('design/footer',$data);
    }

    function add_perspektif(){
        $data = array(
            'title'=>'Add Perspektif',
            'subtitle'=>'',
            'act'=>'add',
            'id_perspektif'=>'',
            'nama_perspektif'=>''
            );

        $this->load->view('design/header',$data);
        $this->load->view('master/add_perspektif',$data);
        $this->load->view('design/footer',$data);
    }

    function edit_perspektif(){
        $id= $this->uri->segment(4);        

        $s_p = "select * from m_perspektif where id_perspektif=".$id."";
        $q_p =$this->db->query($s_p);

        foreach ($q_p->result() as $key) {
            $data = array(
                'title'=>'Ubah Perspektif',
                'subtitle'=>'',
                'act'=>'edit',
                'id_perspektif'=>$key->id_perspektif,
                'nama_perspektif'=>$key->nama_perspektif
                );
        }

        $this->load->view('design/header',$data);
        $this->load->view('master/add_perspektif',$data);
        $this->load->view('design/footer',$data);
    }

    function simpan_perspektif(){
        $act = $this->input->post('act');
        $id_perspektif = $this->input->post('id_perspektif');
        $nama_perspektif = $this->input->post('nama_perspektif');
        $tanggal = date('Y-m-d H:i:s');
        $upd = $this->session->userdata('u_id');

        $tb = 'm_perspektif';
        if($act=="add"){
            $in = array(
                'nama_perspektif'=>$nama_perspektif,
                'tanggal'=>$tanggal,
                'upd'=>$upd,
                );
            print_r(array('in'=>$in));
            $ins = $this->db->insert($tb,$in);
            $msg ="Data berhasil ditambahkan...";
        }else{
            $key = array(
                'id_perspektif'=>$id_perspektif
                );
            $up = array(
                'nama_perspektif'=>$nama_perspektif,
                'tanggal'=>$tanggal,
                'upd'=>$upd,
                );
            print_r(array('key'=>$key,'up'=>$up));
            $u = $this->db->update($tb,$up,$key);
            $msg ="Data berhasil diubah...";
        }

        echo "<script>window.alert('".$msg."');
        window.location='".base_url('master/master/perspektif')."'</script>";

    }

    public function unit(){
        $data['title'] = 'Master Unit/Stakeholder';
        $data['subtitle'] = '';
        $s_p = "select * from m_unit";
        $data['q_p'] =$this->db->query($s_p);

        $this->load->view('design/header',$data);
        $this->load->view('master/m_unit',$data);
        $this->load->view('design/footer',$data);
    }

    function add_unit(){
        $data = array(
            'title'=>'Add Unit/ Stakeholder',
            'subtitle'=>'',
            'act'=>'add',
            'id_unit'=>'',
            'unit'=>'',
            'deskripsi'=>'',
            'aktif'=>'',
            );

        $this->load->view('design/header',$data);
        $this->load->view('master/add_unit',$data);
        $this->load->view('design/footer',$data);
    }

    function edit_unit(){
        $id= $this->uri->segment(4);        

        $s_p = "select * from m_unit where id_unit=".$id."";
        $q_p =$this->db->query($s_p);

        foreach ($q_p->result() as $key) {
            $data = array(
                'title'=>'Ubah Unit/ Stakeholder',
                'subtitle'=>'',
                'act'=>'edit',
                'id_unit'=>$key->id_unit,
                'unit'=>$key->unit,
                'deskripsi'=>$key->deskripsi,
                'aktif'=>$key->aktif,
                );
        }

        $this->load->view('design/header',$data);
        $this->load->view('master/add_unit',$data);
        $this->load->view('design/footer',$data);
    }

    function simpan_unit(){
        $act = $this->input->post('act');
        $id_unit = $this->input->post('id_unit');
        $unit = $this->input->post('unit');
        $deskripsi = $this->input->post('deskripsi');
        $aktif = $this->input->post('aktif');
        $tanggal = date('Y-m-d H:i:s');
        $upd = $this->session->userdata('u_id');

        $tb = 'm_unit';
        if($act=="add"){
            $in = array(
                'unit'=>$unit,
                'deskripsi'=>$deskripsi,
                'tanggal'=>$tanggal,
                'upd'=>$upd,
                'aktif'=>$aktif,
                );
            print_r(array('in'=>$in));
            $ins = $this->db->insert($tb,$in);
            $msg ="Data berhasil ditambahkan...";
        }else{
            $key = array(
                'id_unit'=>$id_unit
                );
            $up = array(
                'unit'=>$unit,
                'deskripsi'=>$deskripsi,
                'tanggal'=>$tanggal,
                'aktif'=>$aktif,
                'upd'=>$upd
                );
            print_r(array('key'=>$key,'up'=>$up));
            $u = $this->db->update($tb,$up,$key);
            $msg ="Data berhasil diubah...";
        }

        echo "<script>window.alert('".$msg."');
        window.location='".base_url('master/master/unit')."'</script>";

    }



    public function indikator(){
        $data['title'] = 'Master Indikator Kinerja Unit';
        $data['subtitle'] = '';
        $s_indikator = "select m.id_indikator,m.nama_indikator,ms.id_sasaran,ms.nama_sasaran
        from m_indikator m left join m_sasaran ms on m.id_sasaran=ms.id_sasaran";
        
        $data['q_indikator'] =$this->db->query($s_indikator);

        $this->load->view('design/header',$data);
        $this->load->view('master/m_indikator',$data);
        $this->load->view('design/footer',$data);
    }

    public function add_indikator(){
        $data['title'] = 'Add Indikator Kinerja Unit';
        $data['subtitle'] = '';
        
        $data['act']='add';
        $data['id_indikator']= '';
        $data['nama_indikator']= '';
        $data['id_sasaran']= '';
        $s_sasaran = "select * from m_sasaran";

        $data['q_s'] =$this->db->query($s_sasaran);

        $this->load->view('design/header',$data);
        $this->load->view('master/add_indikator',$data);
        $this->load->view('design/footer',$data);
    }

    public function Edit_indikator(){
        $data['title'] = 'Ubah Indikator Kinerja Unit';
        $data['subtitle'] = '';

        $id= $this->uri->segment(4);
        $s_indikator = "select m.id_indikator,m.nama_indikator,ms.id_sasaran,ms.nama_sasaran
        from m_indikator m left join m_sasaran ms on m.id_sasaran=ms.id_sasaran where m.id_indikator =".$id."";
        $data['act']='add';
        $data['id_indikator']= '';
        $data['nama_indikator']= '';
        $data['id_sasaran']= '';
        $q_indikator =$this->db->query($s_indikator);
        foreach ($q_indikator->result() as $key) {
            $data['act']='ubah';
            $data['id_indikator']= $key->id_indikator;
            $data['nama_indikator']= $key->nama_indikator;
            $data['id_sasaran']= $key->id_sasaran;
        }
        $s_sasaran = "select * from m_sasaran";
        $data['q_s'] =$this->db->query($s_sasaran);
        

        $this->load->view('design/header',$data);
        $this->load->view('master/add_indikator',$data);
        $this->load->view('design/footer',$data);
    }

    public function add_mak(){
        $data['title'] = 'Add Mata Anggaran Keuangan';
        $data['subtitle'] = '';

        
        $data['act']='add';
        $data['id_mak']= '';
        $data['mak']= '';
        $data['kmak']= '';
        $data['sd']= '';
        $data['alok']= '';
        $data['kbel']= '';
        $data['kban']= '';
        $data['kgdg']= '';        
        
        $s_sd = "select distinct(kode_sd) from m_mak";
        $s_alok = "select distinct(alokasi_belanja) from m_mak";
        $s_kbel = "select distinct(klasifikasi_belanja) from m_mak";
        $s_kban = "select distinct(klasifikasi_beban) from m_mak";
        $s_kgdg = "select distinct(klasifikasi_gudang) from m_mak";

        $data['q_sd'] =$this->db->query($s_sd);
        $data['q_alok'] =$this->db->query($s_alok);
        $data['q_kbel'] =$this->db->query($s_kbel);
        $data['q_kban'] =$this->db->query($s_kban);
        $data['q_kgdg'] =$this->db->query($s_kgdg);

        $this->load->view('design/header',$data);
        $this->load->view('master/add_mak',$data);
        $this->load->view('design/footer',$data);
    }

    public function edit_mak(){
        $data['title'] = 'Ubah Mata Anggaran Keuangan';
        $data['subtitle'] = '';
        $id= $this->uri->segment(4);
        $data['act']='edit';
        $s_mak = "select * from m_mak where id_mak = ".$id."";
        $q_mak = $this->db->query($s_mak);

        foreach ($q_mak->result() as $key) {
            $data['id_mak']= $key->id_mak;
            $data['mak']= $key->mak;
            $data['kmak']= $key->klasifikasi_akun_mak;
            $data['sd']= $key->kode_sd;
            $data['alok']= $key->alokasi_belanja;
            $data['kbel']= $key->klasifikasi_belanja;
            $data['kban']= $key->klasifikasi_beban;
            $data['kgdg']= $key->klasifikasi_gudang;
            
        }


        
        $s_sd = "select distinct(kode_sd) from m_mak";
        $s_alok = "select distinct(alokasi_belanja) from m_mak";
        $s_kbel = "select distinct(klasifikasi_belanja) from m_mak";
        $s_kban = "select distinct(klasifikasi_beban) from m_mak";
        $s_kgdg = "select distinct(klasifikasi_gudang) from m_mak";

        $data['q_sd'] =$this->db->query($s_sd);
        $data['q_alok'] =$this->db->query($s_alok);
        $data['q_kbel'] =$this->db->query($s_kbel);
        $data['q_kban'] =$this->db->query($s_kban);
        $data['q_kgdg'] =$this->db->query($s_kgdg);

        $this->load->view('design/header',$data);
        $this->load->view('master/add_mak',$data);
        $this->load->view('design/footer',$data);
    }

    function simpan_mak(){
        $act = $this->input->post('act');
        $id_mak = $this->input->post('id_mak');
        $mak = $this->input->post('mak');
        $kmak = $this->input->post('kmak');
        $sd = $this->input->post('sd');
        $alok = $this->input->post('alok');
        $kbel = $this->input->post('kbel');
        $kban = $this->input->post('kban');
        $kgdg = $this->input->post('kgdg');
        
        $tanggal = date('Y-m-d H:i:s');
        $upd = $this->session->userdata('u_id');

        $tb = 'm_mak';
        if($act=="add"){
            $in = array(
                'mak'=>$mak,
                'klasifikasi_akun_mak'=>$kmak,
                'kode_sd'=>$sd,
                'alokasi_belanja'=>$alok,
                'klasifikasi_belanja'=>$kbel,
                'klasifikasi_beban'=>$kban,
                'klasifikasi_gudang'=>$kgdg,
                'tanggal'=>$tanggal,
                'upd'=>$upd
                );
            print_r(array('in'=>$in));
            $ins = $this->db->insert($tb,$in);
            $msg ="Data berhasil ditambahkan...";
        }else{
            $key = array(
                'id_mak'=>$id_mak
                );
            $up = array(
                'mak'=>$mak,
                'klasifikasi_akun_mak'=>$kmak,
                'kode_sd'=>$sd,
                'alokasi_belanja'=>$alok,
                'klasifikasi_belanja'=>$kbel,
                'klasifikasi_beban'=>$kban,
                'klasifikasi_gudang'=>$kgdg,
                'tanggal'=>$tanggal,
                'upd'=>$upd
                );
            print_r(array('key'=>$key,'up'=>$up));
            $u = $this->db->update($tb,$up,$key);
            $msg ="Data berhasil diubah...";
        }

        echo "<script>window.alert('".$msg."');
        window.location='".base_url('master/master/mak')."'</script>";

    }



    function simpan_indikator(){
        $act = $this->input->post('act');
        $id_indikator = $this->input->post('id_indikator');
        $nama_indikator = $this->input->post('nama_indikator');
        $id_sasaran = $this->input->post('id_sasaran');
        
        $tanggal = date('Y-m-d H:i:s');
        $upd = $this->session->userdata('u_id');

        $tb = 'm_indikator';
        if($act=="add"){
            $in = array(
                'nama_indikator'=>$nama_indikator,
                'id_sasaran'=>$id_sasaran,
                'tanggal'=>$tanggal,
                'upd'=>$upd
                );
            print_r(array('in'=>$in));
            $ins = $this->db->insert($tb,$in);
            $msg ="Data berhasil ditambahkan...";
        }else{
            $key = array(
                'id_indikator'=>$id_indikator
                );
            $up = array(
                'nama_indikator'=>$nama_indikator,
                'id_sasaran'=>$id_sasaran,
                'tanggal'=>$tanggal,
                'upd'=>$upd
                );
            print_r(array('key'=>$key,'up'=>$up));
            $u = $this->db->update($tb,$up,$key);
            $msg ="Data berhasil diubah...";
        }

        echo "<script>window.alert('".$msg."');
        window.location='".base_url('master/master/indikator')."'</script>";

    }

    public function mak(){
        $data['title'] = 'Master Mata Anggaran Keuangan';
        $data['subtitle'] = '';
        $s_mak = "select * from m_mak";
        $data['q_mak'] =$this->db->query($s_mak);

        $this->load->view('design/header',$data);
        $this->load->view('master/m_mak',$data);
        $this->load->view('design/footer',$data);
    }



    public function program(){
        $data['title'] = 'Master Program Kerja';
        $data['subtitle'] = '';
        $s_program = "select mp.id_program,mp.nama_program,mi.id_indikator,mi.nama_indikator
        from m_program mp left join m_indikator mi on mp.id_indikator=mi.id_indikator";
        $data['q_program'] =$this->db->query($s_program);

        $this->load->view('design/header',$data);
        $this->load->view('master/m_program',$data);
        $this->load->view('design/footer',$data);
    }

    public function add_program(){
        $data['title'] = 'Add Program Kerja';
        $data['subtitle'] = '';
        
        $data['act']='add';
        $data['id_program']= '';
        $data['nama_program']= '';
        $data['id_indikator']= '';
        $s_indikator = "select * from m_indikator";

        $data['q_indikator'] =$this->db->query($s_indikator);

        $this->load->view('design/header',$data);
        $this->load->view('master/add_program',$data);
        $this->load->view('design/footer',$data);
    }

    public function edit_program(){
        $data['title'] = 'Ubah Program Kerja';
        $data['subtitle'] = '';
        $id=$this->uri->segment(4);

        $s_program = "select mp.id_program,mp.nama_program,mi.id_indikator,mi.nama_indikator
        from m_program mp left join m_indikator mi on mp.id_indikator=mi.id_indikator where mp.id_program=".$id." ";
        $q_program =$this->db->query($s_program);
        
        $data['act']='ubah';
        foreach ($q_program->result() as $key) {
            $data['id_program']= $key->id_program;
            $data['nama_program']= $key->nama_program;
            $data['id_indikator']= $key->id_indikator;
            
        }
        
        $s_indikator = "select * from m_indikator";

        $data['q_indikator'] =$this->db->query($s_indikator);

        $this->load->view('design/header',$data);
        $this->load->view('master/add_program',$data);
        $this->load->view('design/footer',$data);
    }

    function simpan_program(){
        $act = $this->input->post('act');
        $id_program = $this->input->post('id_program');
        $nama_program = $this->input->post('nama_program');
        $id_indikator = $this->input->post('id_indikator');
        
        $tanggal = date('Y-m-d H:i:s');
        $upd = $this->session->userdata('u_id');

        $tb = 'm_program';
        if($act=="add"){
            $in = array(
                'nama_program'=>$nama_program,
                'id_indikator'=>$id_indikator,
                'tanggal'=>$tanggal,
                'upd'=>$upd
                );
            print_r(array('in'=>$in));
            $ins = $this->db->insert($tb,$in);
            $msg ="Data berhasil ditambahkan...";
        }else{
            $key = array(
                'id_program'=>$id_program
                );
            $up = array(
                'nama_program'=>$nama_program,
                'id_indikator'=>$id_indikator,
                'tanggal'=>$tanggal,
                'upd'=>$upd
                );
            print_r(array('key'=>$key,'up'=>$up));
            $u = $this->db->update($tb,$up,$key);
            $msg ="Data berhasil diubah...";
        }

        echo "<script>window.alert('".$msg."');
        window.location='".base_url('master/master/program')."'</script>";

    }

    public function kegiatan(){
        $data['title'] = 'Master Kegiatan';
        $data['subtitle'] = '';
        $s_kegiatan = "select mk.id_kegiatan,mk.nama_kegiatan,mp.id_program,mp.nama_program 
        from m_kegiatan mk left JOIN m_program mp on mk.id_program=mp.id_program";
        $data['q_kegiatan'] =$this->db->query($s_kegiatan);

        $this->load->view('design/header',$data);
        $this->load->view('master/m_kegiatan',$data);
        $this->load->view('design/footer',$data);
    }

    public function add_kegiatan(){
        $data['title'] = 'Add kegiatan';
        $data['subtitle'] = '';
        
        $data['act']='add';
        $data['id_kegiatan']= '';
        $data['nama_kegiatan']= '';
        $data['id_program']= '';
        
        $s_program = "select * from m_program";

        $data['q_program'] =$this->db->query($s_program);

        $this->load->view('design/header',$data);
        $this->load->view('master/add_kegiatan',$data);
        $this->load->view('design/footer',$data);
    }

    public function edit_kegiatan(){
        $data['title'] = 'Ubah kegiatan';
        $data['subtitle'] = '';

        $id = $this->uri->segment(4);
        $s_kegiatan = "select mk.id_kegiatan,mk.nama_kegiatan,mp.id_program,mp.nama_program 
        from m_kegiatan mk left JOIN m_program mp on mk.id_program=mp.id_program where mk.id_kegiatan=".$id."";
        $q_kegiatan =$this->db->query($s_kegiatan);
        
        $data['act']='ubah';
        foreach ($q_kegiatan->result() as $key) {
            $data['id_kegiatan']= $key->id_kegiatan;
            $data['nama_kegiatan']= $key->nama_kegiatan;
            $data['id_program']= $key->id_program;
        }
        
        
        $s_program = "select * from m_program";

        $data['q_program'] =$this->db->query($s_program);

        $this->load->view('design/header',$data);
        $this->load->view('master/add_kegiatan',$data);
        $this->load->view('design/footer',$data);
    }

    function simpan_kegiatan(){
        $act = $this->input->post('act');
        $id_kegiatan = $this->input->post('id_kegiatan');
        $nama_kegiatan = $this->input->post('nama_kegiatan');
        $id_program = $this->input->post('id_program');
        
        $tanggal = date('Y-m-d H:i:s');
        $upd = $this->session->userdata('u_id');

        $tb = 'm_kegiatan';
        if($act=="add"){
            $in = array(
                'nama_kegiatan'=>$nama_kegiatan,
                'id_program'=>$id_program,
                'tanggal'=>$tanggal,
                'upd'=>$upd
                );
            print_r(array('in'=>$in));
            $ins = $this->db->insert($tb,$in);
            $msg ="Data berhasil ditambahkan...";
        }else{
            $key = array(
                'id_kegiatan'=>$id_kegiatan
                );
            $up = array(
                'nama_kegiatan'=>$nama_kegiatan,
                'id_program'=>$id_program,
                'tanggal'=>$tanggal,
                'upd'=>$upd
                );
            print_r(array('key'=>$key,'up'=>$up));
            $u = $this->db->update($tb,$up,$key);
            $msg ="Data berhasil diubah...";
        }

        echo "<script>window.alert('".$msg."');
        window.location='".base_url('master/master/kegiatan')."'</script>";

    }

    public function sub_kegiatan(){
        $data['title'] = 'Master Sub Kegiatan';
        $data['subtitle'] = '';
        $s_sub_kegiatan = "select msk.id_sub_kegiatan,msk.nama_sub_kegiatan,mk.id_kegiatan,mk.nama_kegiatan from m_sub_kegiatan msk 
        left join m_kegiatan mk on msk.id_kegiatan = mk.id_kegiatan";
        $data['q_sub_kegiatan'] =$this->db->query($s_sub_kegiatan);

        $this->load->view('design/header',$data);
        $this->load->view('master/m_sub_kegiatan',$data);
        $this->load->view('design/footer',$data);
    }

    public function add_sub_kegiatan(){
        $data['title'] = 'Add Sub kegiatan';
        $data['subtitle'] = '';
        
        $data['act']='add';
        $data['id_sub_kegiatan']= '';
        $data['nama_sub_kegiatan']= '';
        $data['id_kegiatan']= '';

        
        $s_kegiatan = "select * from m_kegiatan";

        $data['q_kegiatan'] =$this->db->query($s_kegiatan);

        $this->load->view('design/header',$data);
        $this->load->view('master/add_sub_kegiatan',$data);
        $this->load->view('design/footer',$data);
    }

    public function edit_sub_kegiatan(){
        $data['title'] = 'Ubah Sub kegiatan';
        $data['subtitle'] = '';

        $id = $this->uri->segment(4);
        $s_sub_kegiatan = "select msk.id_sub_kegiatan,msk.nama_sub_kegiatan,mk.id_kegiatan,mk.nama_kegiatan from m_sub_kegiatan msk 
        left join m_kegiatan mk on msk.id_kegiatan = mk.id_kegiatan where msk.id_sub_kegiatan =".$id."";
        $q_sub_kegiatan =$this->db->query($s_sub_kegiatan);
        
        $data['act']='ubah';
        foreach ($q_sub_kegiatan->result() as $key) {
            $data['id_sub_kegiatan']= $key->id_sub_kegiatan;
            $data['nama_sub_kegiatan']= $key->nama_sub_kegiatan;
            $data['id_kegiatan']= $key->id_kegiatan;
            
        }
        

        
        $s_kegiatan = "select * from m_kegiatan";

        $data['q_kegiatan'] =$this->db->query($s_kegiatan);

        $this->load->view('design/header',$data);
        $this->load->view('master/add_sub_kegiatan',$data);
        $this->load->view('design/footer',$data);
    }

    function simpan_sub_kegiatan(){
        $act = $this->input->post('act');
        $nama_sub_kegiatan = $this->input->post('nama_sub_kegiatan');
        $id_sub_kegiatan = $this->input->post('id_sub_kegiatan');
        $id_kegiatan = $this->input->post('id_kegiatan');
        
        
        $tanggal = date('Y-m-d H:i:s');
        $upd = $this->session->userdata('u_id');

        $tb = 'm_sub_kegiatan';
        if($act=="add"){
            $in = array(
                'nama_sub_kegiatan'=>$nama_sub_kegiatan,
                'id_kegiatan'=>$id_kegiatan,
                'tanggal'=>$tanggal,
                'upd'=>$upd
                );
            print_r(array('in'=>$in));
            $ins = $this->db->insert($tb,$in);
            $msg ="Data berhasil ditambahkan...";
        }else{
            $key = array(
                'id_sub_kegiatan'=>$id_sub_kegiatan
                );
            $up = array(
                'nama_sub_kegiatan'=>$nama_sub_kegiatan,
                'id_kegiatan'=>$id_kegiatan,
                'tanggal'=>$tanggal,
                'upd'=>$upd
                );
            print_r(array('key'=>$key,'up'=>$up));
            $u = $this->db->update($tb,$up,$key);
            $msg ="Data berhasil diubah...";
        }

        echo "<script>window.alert('".$msg."');
        window.location='".base_url('master/master/sub_kegiatan')."'</script>";

    }

    public function jenis_biaya(){
        $data['title'] = 'Master Jenis Biaya';
        $data['subtitle'] = '';
        $s_jbi = "select * from m_jenis_biaya";
        $data['q_jbi'] =$this->db->query($s_jbi);

        $this->load->view('design/header',$data);
        $this->load->view('master/m_jenis_biaya',$data);
        $this->load->view('design/footer',$data);
    }

    public function add_jenis_biaya(){
        $data['title'] = 'Add Jenis Biaya';
        $data['subtitle'] = '';
        
        $data['act']='add';
        $data['id_jbi']= '';
        $data['nama_jbi']= '';

        
        $s_jbi = "select * from m_jenis_biaya";

        $data['q_jbi'] =$this->db->query($s_jbi);

        $this->load->view('design/header',$data);
        $this->load->view('master/add_jenis_biaya',$data);
        $this->load->view('design/footer',$data);
    }

    public function edit_jenis_biaya(){
        $data['title'] = 'Ubah Jenis Biaya';
        $data['subtitle'] = '';

        $id = $this->uri->segment(4);
        $s_jbi = "select * from m_jenis_biaya where id_jenis_biaya=".$id."";
        $q_jbi =$this->db->query($s_jbi);

        $data['act']='ubah';

        foreach ($q_jbi->result() as $key) {
            $data['id_jbi']= $key->id_jenis_biaya;
            $data['nama_jbi']= $key->nama_jenis_biaya;;
        }
        $this->load->view('design/header',$data);
        $this->load->view('master/add_jenis_biaya',$data);
        $this->load->view('design/footer',$data);
    }

    function simpan_jbi(){
        $act = $this->input->post('act');
        $id_jbi = $this->input->post('id_jbi');
        $nama_jbi = $this->input->post('nama_jbi');
        
        $tanggal = date('Y-m-d H:i:s');
        $upd = $this->session->userdata('u_id');

        $tb = 'm_jenis_biaya';
        if($act=="add"){
            $in = array(
                'nama_jenis_biaya'=>$nama_jbi,
                'tanggal'=>$tanggal,
                'upd'=>$upd
                );
            print_r(array('in'=>$in));
            $ins = $this->db->insert($tb,$in);
            $msg ="Data berhasil ditambahkan...";
        }else{
            $key = array(
                'id_jenis_biaya'=>$id_jbi
                );
            $up = array(
             'nama_jenis_biaya'=>$nama_jbi,
             'tanggal'=>$tanggal,
             'upd'=>$upd
             );
            print_r(array('key'=>$key,'up'=>$up));
            $u = $this->db->update($tb,$up,$key);
            $msg ="Data berhasil diubah...";
        }

        echo "<script>window.alert('".$msg."');
        window.location='".base_url('master/master/jenis_biaya')."'</script>";

    }

    public function jenis_belanja(){
        $data['title'] = 'Master Jenis Belanja';
        $data['subtitle'] = '';
        $s_jb = "select * from vw_jb";
        $data['q_jb'] =$this->db->query($s_jb);

        $this->load->view('design/header',$data);
        $this->load->view('master/m_jenis_belanja',$data);
        $this->load->view('design/footer',$data);
    }

    public function add_jenis_belanja(){
        $data['title'] = 'Add Jenis Belanja';
        $data['subtitle'] = '';
        
        $data['act']='add';
        $data['id_jb']= '';
        $data['nama_jb']= '';
        /*$data['id_bb']= '';
        $data['mak']= '';*/

        /*$s_bb = "select * from vw_bb";
        $s_mak = "select * from m_mak";

        $data['q_bb'] =$this->db->query($s_bb);
        $data['q_mak'] =$this->db->query($s_mak);*/

        $this->load->view('design/header',$data);
        $this->load->view('master/add_jenis_belanja',$data);
        $this->load->view('design/footer',$data);
    }

    public function edit_jenis_belanja(){
        $data['title'] = 'Ubah Jenis Belanja';
        $data['subtitle'] = '';
        $id= $this->uri->segment(4);
        $s_jb = "select * from vw_jb where id_jenis_belanja =".$id." ";
        $q_jb =$this->db->query($s_jb);
        $data['act']='ubah';
        foreach ($q_jb->result() as $key) {
            $data['id_jb']= $key->id_jenis_belanja;
            $data['nama_jb']= $key->nama_jenis_belanja;
        }
        

        $this->load->view('design/header',$data);
        $this->load->view('master/add_jenis_belanja',$data);
        $this->load->view('design/footer',$data);
    }

    function simpan_jb(){
        $act = $this->input->post('act');
        $id_jb = $this->input->post('id_jb');
        $nama_jb = $this->input->post('nama_jb');

        $tanggal = date('Y-m-d H:i:s');
        $upd = $this->session->userdata('u_id');

        $tb = 'm_jenis_belanja';
        if($act=="add"){
            $in = array(
                'nama_jenis_belanja'=>$nama_jb,
                'tanggal'=>$tanggal,
                'upd'=>$upd
                );
            print_r(array('in'=>$in));
            $ins = $this->db->insert($tb,$in);
            $msg ="Data berhasil ditambahkan...";
        }else{
            $key = array(
                'id_jenis_belanja'=>$id_jb
                );
            $up = array(
             'nama_jenis_belanja'=>$nama_jb,
             'tanggal'=>$tanggal,
             'upd'=>$upd
             );
            print_r(array('key'=>$key,'up'=>$up));
            $u = $this->db->update($tb,$up,$key);
            $msg ="Data berhasil diubah...";
        }

        echo "<script>window.alert('".$msg."');
        window.location='".base_url('master/master/jenis_belanja')."'</script>";

    }

    public function jb_rka(){
        $data['title'] = 'Master Jenis Belanja RKAKL';
        $data['subtitle'] = '';
        $s_jbr = "select * from vw_jb_rka";
        $data['q_jbr'] =$this->db->query($s_jbr);

        $this->load->view('design/header',$data);
        $this->load->view('master/m_jenis_belanja_rka',$data);
        $this->load->view('design/footer',$data);
    }

    public function add_jb_rka(){
        $data['title'] = 'Add Jenis Belanja RKAKL';
        $data['subtitle'] = '';
        
        $data['act']='add';
        $data['id_jb']= '';
        $data['nama_jb']= '';
        $data['id_bb']= '';
        $data['mak']= '';

        $s_bb = "select * from vw_bb";
        $s_mak = "select * from m_mak";

        $data['q_bb'] =$this->db->query($s_bb);
        $data['q_mak'] =$this->db->query($s_mak);

        $this->load->view('design/header',$data);
        $this->load->view('master/add_jenis_belanja_rka',$data);
        $this->load->view('design/footer',$data);
    }

    public function edit_jb_rka(){
        $data['title'] = 'Ubah Jenis Belanja RKA';
        $data['subtitle'] = '';
        $id= $this->uri->segment(4);
        $s_jb = "select * from vw_jb_rka where id_jb_rka =".$id." ";
        $q_jb =$this->db->query($s_jb);
        $data['act']='ubah';
        foreach ($q_jb->result() as $key) {
            $data['id_jb']= $key->id_jb_rka;
            $data['nama_jb']= $key->nama_jb_rka;
            $data['id_bb']= $key->id_bb;
            $data['mak']= $key->kode_mak;
        }

        $s_bb = "select * from vw_bb";
        $s_mak = "select * from m_mak";

        $data['q_bb'] =$this->db->query($s_bb);
        $data['q_mak'] =$this->db->query($s_mak);

        $this->load->view('design/header',$data);
        $this->load->view('master/add_jenis_belanja_rka',$data);
        $this->load->view('design/footer',$data);
    }

    function simpan_jbr(){
        $act = $this->input->post('act');
        $id_jb = $this->input->post('id_jb');
        $nama_jb = $this->input->post('nama_jb');
        $id_bb = $this->input->post('bb');
        $mak = $this->input->post('mak');
        
        $tanggal = date('Y-m-d H:i:s');
        $upd = $this->session->userdata('u_id');

        $tb = 'm_jb_rka';
        if($act=="add"){
            $in = array(
                'nama_jb_rka'=>$nama_jb,
                'id_bb'=>$id_bb,
                'kode_mak'=>$mak,
                'tanggal'=>$tanggal,
                'upd'=>$upd
                );
            print_r(array('in'=>$in));
            $ins = $this->db->insert($tb,$in);
            $msg ="Data berhasil ditambahkan...";
        }else{
            $key = array(
                'id_jb_rka'=>$id_jb
                );
            $up = array(
             'nama_jb_rka'=>$nama_jb,
             'id_bb'=>$id_bb,
             'kode_mak'=>$mak,
             'tanggal'=>$tanggal,
             'upd'=>$upd
             );
            print_r(array('key'=>$key,'up'=>$up));
            $u = $this->db->update($tb,$up,$key);
            $msg ="Data berhasil diubah...";
        }

        echo "<script>window.alert('".$msg."');
        window.location='".base_url('master/master/jb_rka')."'</script>";

    }

    public function sub_jenis_belanja(){
        $data['title'] = 'Master Sub Jenis Belanja';
        $data['subtitle'] = '';
        /*$s_sjb = "SELECT sjb.id_sub_jenis_belanja,sjb.id_jenis_belanja,sjb.nama_sub_jenis,jb.nama_jenis_belanja
        FROM `m_sub_jenis_belanja` sjb left join m_jenis_belanja jb 
        on sjb.id_jenis_belanja = jb.id_jenis_belanja";*/
        $s_sjb ="select * from vw_sub_jenis_belanja";
        $data['q_sjb'] =$this->db->query($s_sjb);

        $this->load->view('design/header',$data);
        $this->load->view('master/m_sub_jenis_belanja',$data);
        $this->load->view('design/footer',$data);
    }

    function ambil_data_jb(){
        if ($this->input->post('load_data')=='true'):
            $id_jb = $this->input->post('id_jb');
        $sql = $this->db->query("SELECT * FROM vw_jb WHERE id_jenis_belanja = '".$id_jb."' limit 1");

        foreach ($sql->result() as $key) {
            $id_jenis_belanja = $key->id_jenis_belanja;
            $nama_jenis_belanja = $key->nama_jenis_belanja;
            $id_bb = $key->id_bb;
            $nama_bb = $key->nama_bb;
            $id_mak = $key->id_mak;
            $kode_mak = $key->kode_mak;
            $kmak = $key->klasifikasi_akun_mak;


            echo '#'.$id_jenis_belanja.'#'.$nama_jenis_belanja.'#'.$id_bb.'#'.$nama_bb.'#'.$id_mak.'#'.$kode_mak.'#'.$kmak;
        }

        endif;
    }

    function ambil_data_jbr(){
        if ($this->input->post('load_data')=='true'):
            $id_jb = $this->input->post('id_jb');
        $sql = $this->db->query("SELECT * FROM vw_jb_rka WHERE id_jb_rka = '".$id_jb."' limit 1");

        foreach ($sql->result() as $key) {
            $id_jenis_belanja = $key->id_jb_rka;
            $nama_jenis_belanja = $key->nama_jb_rka;
            $id_bb = $key->id_bb;
            $nama_bb = $key->nama_bb;
            $id_mak = $key->id_mak;
            $kode_mak = $key->kode_mak;
            $kmak = $key->klasifikasi_akun_mak;


            echo '#'.$id_jenis_belanja.'#'.$nama_jenis_belanja.'#'.$id_bb.'#'.$nama_bb.'#'.$id_mak.'#'.$kode_mak.'#'.$kmak;
        }

        endif;
    }

    public function add_sub_jenis_belanja(){
        $data['title'] = 'Add Sub Jenis Belanja';
        $data['subtitle'] = '';

        $s_jb = "select * from vw_jb";
        $data['q_jb'] =$this->db->query($s_jb);

        $data['act']='add';
        $data['id_jb']= '';
        $data['nama_jb']= '';
        $data['id_sjb']= '';
        $data['nama_sjb']= '';
        /*$data['mak']= '';
        $data['kmak']= '';
        $data['bb']= '';*/

        /*$s_sjb = "SELECT sjb.id_sub_jenis_belanja,sjb.id_jenis_belanja,sjb.nama_sub_jenis,jb.nama_jenis_belanja
        FROM `m_sub_jenis_belanja` sjb left join m_jenis_belanja jb 
        on sjb.id_jenis_belanja = jb.id_jenis_belanja";
        $data['q_sjb'] =$this->db->query($s_sjb);*/

        $this->load->view('design/header',$data);
        $this->load->view('master/add_sub_jenis_belanja',$data);
        $this->load->view('design/footer',$data);
    }

    public function edit_sub_jenis_belanja(){
        $data['title'] = 'Edit Sub Jenis Belanja';
        $data['subtitle'] = '';

        $id = $this->uri->segment(4);

        /*$s_sjb = "SELECT sjb.id_sub_jenis_belanja,sjb.id_jenis_belanja,sjb.nama_sub_jenis,jb.nama_jenis_belanja
        FROM `m_sub_jenis_belanja` sjb left join m_jenis_belanja jb 
        on sjb.id_jenis_belanja = jb.id_jenis_belanja where sjb.id_sub_jenis_belanja=".$id." ";*/
        $s_sjb = "select * from vw_sub_jenis_belanja where id_sub_jenis_belanja=".$id."";
        $q_sjb =$this->db->query($s_sjb);

        $data['act']='ubah';

        foreach ($q_sjb->result() as $key) {
            $data['id_jb']= $key->id_jenis_belanja;
            $data['nama_jb']= $key->nama_jenis_belanja;
            $data['id_sjb']= $key->id_sub_jenis_belanja;
            $data['nama_sjb']= $key->nama_sub_jenis;
            /*$data['mak']= $key->kode_mak;
            $data['kmak']= $key->klasifikasi_akun_mak;
            $data['bb']= $key->nama_bb;*/
        }
        

        $s_jb = "select * from m_jenis_belanja";
        $data['q_jb'] =$this->db->query($s_jb);

        $this->load->view('design/header',$data);
        $this->load->view('master/add_sub_jenis_belanja',$data);
        $this->load->view('design/footer',$data);
    }

    function simpan_sjb(){
        $act = $this->input->post('act');
        $id_sjb = $this->input->post('id_sjb');
        $nama_sjb = $this->input->post('nama_sjb');
        $id_jb = $this->input->post('id_jb');
        
        $tanggal = date('Y-m-d H:i:s');
        $upd = $this->session->userdata('u_id');

        $tb = 'm_sub_jenis_belanja';
        if($act=="add"){
            $in = array(
                'nama_sub_jenis'=>$nama_sjb,
                'id_jenis_belanja'=>$id_jb,                
                'tanggal'=>$tanggal,
                'upd'=>$upd
                );
            print_r(array('in'=>$in));
            $ins = $this->db->insert($tb,$in);
            $msg ="Data berhasil ditambahkan...";
        }else{
            $key = array(
                'id_sub_jenis_belanja'=>$id_sjb
                );
            $up = array(
             'nama_sub_jenis'=>$nama_sjb,
             'id_jenis_belanja'=>$id_jb,
             'tanggal'=>$tanggal,
             'upd'=>$upd
             );
            print_r(array('key'=>$key,'up'=>$up));
            $u = $this->db->update($tb,$up,$key);
            $msg ="Data berhasil diubah...";
        }

        echo "<script>window.alert('".$msg."');
        window.location='".base_url('master/master/sub_jenis_belanja')."'</script>";

    }


    public function sjb_rka(){
        $data['title'] = 'Master Sub Jenis Belanja RKAKL';
        $data['subtitle'] = '';
        $s_sjb ="select * from vw_sjb_rka";
        $data['q_sjb'] =$this->db->query($s_sjb);

        $this->load->view('design/header',$data);
        $this->load->view('master/m_sub_jenis_belanja_rka',$data);
        $this->load->view('design/footer',$data);
    }

    public function add_sjb_rka(){
        $data['title'] = 'Add Sub Jenis Belanja RKAKL';
        $data['subtitle'] = '';

        $s_jb = "select * from vw_jb_rka";
        $data['q_jb'] =$this->db->query($s_jb);

        $data['act']='add';
        $data['id_jb']= '';
        $data['nama_jb']= '';
        $data['id_sjb']= '';
        $data['nama_sjb']= '';
        $data['mak']= '';
        $data['kmak']= '';
        $data['bb']= '';        

        $this->load->view('design/header',$data);
        $this->load->view('master/add_sub_jenis_belanja_rka',$data);
        $this->load->view('design/footer',$data);
    }

    public function edit_sjb_rka(){
        $data['title'] = 'Edit Sub Jenis Belanja RKAKL';
        $data['subtitle'] = '';

        $id = $this->uri->segment(4);

        //$s_sjb = "select * from vw_sub_jenis_belanja where id_sub_jenis_belanja=".$id."";
        $s_sjb = "select * from vw_sjb_rka where id_sjb_rka=".$id."";
        $q_sjb =$this->db->query($s_sjb);

        $data['act']='ubah';

        foreach ($q_sjb->result() as $key) {
            $data['id_jb']= $key->id_jb_rka;
            $data['nama_jb']= $key->nama_jb_rka;
            $data['id_sjb']= $key->id_sjb_rka;
            $data['nama_sjb']= $key->nama_sjb_rka;
            $data['mak']= $key->kode_mak;
            $data['kmak']= $key->klasifikasi_akun_mak;
            $data['bb']= $key->nama_bb;
        }
        

        $s_jb = "select * from vw_jb_rka";
        $data['q_jb'] =$this->db->query($s_jb);

        $this->load->view('design/header',$data);
        $this->load->view('master/add_sub_jenis_belanja_rka',$data);
        $this->load->view('design/footer',$data);
    }

    function simpan_sjbr(){
        $act = $this->input->post('act');
        $id_sjb = $this->input->post('id_sjb');
        $nama_sjb = $this->input->post('nama_sjb');
        $id_jb = $this->input->post('id_jb');
        $mak = $this->input->post('mak');
        
        $tanggal = date('Y-m-d H:i:s');
        $upd = $this->session->userdata('u_id');

        $tb = 'm_sjb_rka';
        if($act=="add"){
            $in = array(
                'nama_sjb_rka'=>$nama_sjb,
                'id_jb_rka'=>$id_jb,
                'kode_mak'=>$mak,
                'tanggal'=>$tanggal,
                'upd'=>$upd
                );
            print_r(array('in'=>$in));
            //$ins = $this->db->insert($tb,$in);
            $msg ="Data berhasil ditambahkan...";
        }else{
            $key = array(
                'id_sjb_rka'=>$id_sjb
                );
            $up = array(
             'nama_sjb_rka'=>$nama_sjb,
             'id_jb_rka'=>$id_jb,
             'kode_mak'=>$mak,
             'tanggal'=>$tanggal,
             'upd'=>$upd
             );
            print_r(array('key'=>$key,'up'=>$up));
            //$u = $this->db->update($tb,$up,$key);
            $msg ="Data berhasil diubah...";
        }

        echo "<script>window.alert('".$msg."');
        window.location='".base_url('master/master/sjb_rka')."'</script>";

    }


    public function barang(){
        $data['title'] = 'Master Barang';
        $data['subtitle'] = '';

        $this->load->view('design/header',$data);
        $this->load->view('master/m_barang',$data);
        $this->load->view('design/footer',$data);
    }

    function add_barang(){
        $data['title'] = 'Add Barang';
        $data['subtitle'] = '';

        $data['act']='add';
        $data['id_barang']='';
        $data['kode_barang']='';
        $data['nama_barang']='';
        $data['harga']='';
        $data['aktif']='';
        $data['satuan']='';

        $this->load->view('design/header',$data);
        $this->load->view('master/add_barang',$data);
        $this->load->view('design/footer',$data);

    }

    function edit_barang(){
        $data['title'] = 'Ubah Barang';
        $data['subtitle'] = '';

        $id =$this->uri->segment(4);

        $s_barang ="select * from m_barang where id_barang =".$id." order by tanggal desc";

        $q_barang = $this->db->query($s_barang);

        $data['act']='edit';

        foreach ($q_barang->result() as $key) {
            $data['id_barang']=$key->id_barang;
            $data['kode_barang']=$key->kode_barang;
            $data['nama_barang']=$key->nama_barang;
            $data['harga']=$key->harga;
            $data['aktif']=$key->aktif;
            $data['satuan']=$key->satuan;
        }
        

        $this->load->view('design/header',$data);
        $this->load->view('master/add_barang',$data);
        $this->load->view('design/footer',$data);

    }

    function simpan_barang(){
        $act = $this->input->post('act');
        $id_barang = $this->input->post('id_barang');
        $kode_barang = $this->input->post('kode_barang');
        $nama_barang = $this->input->post('nama_barang');
        $satuan = $this->input->post('satuan');
        $harga = $this->input->post('harga');
        $aktif = $this->input->post('aktif');
        
        $tanggal = date('Y-m-d H:i:s');
        $upd = $this->session->userdata('u_id');

        $tb = 'm_barang';
        if($act=="add"){
            $in = array(
                'nama_barang'=>$nama_barang,
                'kode_barang'=>$kode_barang,
                'satuan'=>$satuan,
                'harga'=>$harga,
                'aktif'=>$aktif,
                'tanggal'=>$tanggal,
                'upd'=>$upd
                );
            print_r(array('in'=>$in));
            $ins = $this->db->insert($tb,$in);
            $msg ="Data berhasil ditambahkan...";
        }else{
            $key = array(
                'id_barang'=>$id_barang
                );
            $up = array(
             'nama_barang'=>$nama_barang,
             'kode_barang'=>$kode_barang,
             'satuan'=>$satuan,
             'harga'=>$harga,
             'aktif'=>$aktif,
             'tanggal'=>$tanggal,
             'upd'=>$upd
             );
            print_r(array('key'=>$key,'up'=>$up));
            $u = $this->db->update($tb,$up,$key);
            $msg ="Data berhasil diubah...";
        }

        echo "<script>window.alert('".$msg."');
        window.location='".base_url('master/master/barang')."'</script>";

    }

    public function test() {
        $data['title'] = 'Dashboard';
        $data['subtitle'] = '';
        $this->load->view('design/header',$data);
        $this->load->view('master/m_test',$data);
        $this->load->view('design/footer',$data);
    }

    public function generate_data(){
        echo $this->cekkode();

    }

    public function cekkode(){
        $query = $this->db->query("SELECT MAX(kode) as kode from barang");
        $hasil = $query->row();
        return $hasil->kode;
    }


}