<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_laporan extends CI_Model {

	function manualQuery($q)
    {
        return $this->db->query($q);
    }
    function getDataPengadaan($id){
        $q = $this->db->query("select * from tbl_pengadaan_header where id_pengadaan ='".$id."'");
        return $q;
    }
    function getBarangPengadaan($id){
        $q= $this->db->query("select * ,(a.qty*a.harga) as subtotal from tbl_pengadaan_detail a 
left join data_barang b on a.id_barang = b.id_barang where a.id_pengadaan = '".$id."'");

        return $q;
    }
     public function getSelectedData($table,$data)
    {
        return $this->db->get_where($table, $data);
    }

    function detail_pengadaan($start,$end,$bulan,$tahun){
        if ($start!="" and $end!=""){
            $q = $this->db->query("select * from v_pengadaan where tanggal_pengadaan between '".$start."' and '".$end."'");
        }
        elseif($bulan!="" and $tahun!="" and $bulan!=0){
            $q = $this->db->query("select * from v_pengadaan where MONTH(tanggal_pengadaan) =".$bulan."  and YEAR(tanggal_pengadaan) = ".$tahun."");
        }
        else{
            $q = $this->db->query("select * from v_pengadaan ");
        }
        return $q;

    }

}

/* End of file m_laporan.php */
/* Location: ./application/models/m_laporan.php */