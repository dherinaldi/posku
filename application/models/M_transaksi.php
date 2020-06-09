<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {
	function manualQuery($q)
    {
        return $this->db->query($q);
    }

	function tampilTmp(){
        return $this->db->get("tmp");
        //return $this->db->query("select *,SUM(tmp.subtotal) as total from tmp group by tmp.kode_barang WITH ROLLUP");
    }

    function tampilTmp_Amprah(){
        return $this->db->get("tmp_amprah");
    }
    function tampilTmp_Pengeluaran(){
        return $this->db->get("tmp_keluar");
    }

    function simpanTmp($info){
        $this->db->insert("tmp",$info);
    }
    function simpanTmp_Amprah($info){
        $this->db->insert("tmp_amprah",$info);
    }
    function simpanTmp_Pengeluaran($info){
        $this->db->insert("tmp_keluar",$info);
    }
    public function getKodePengadaan()
    {
        $q = $this->db->query("select MAX(RIGHT(kd_pengadaan,7)) as kd_max from tbl_pengadaan_header");
        $kd = "";
        if($q->num_rows()>0)
        {
            foreach($q->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%07s", $tmp);
            }
        }
        else
        {
            $kd = "0000001";
        }
        return "PEN-". $kd;
    }
    function get_id_pengadaan(){
        $q = $this->db->query("select MAX(id_pengadaan) as kd_max from tbl_pengadaan_header");
        $kd= 0;
         if($q->num_rows()>0)
        {
            foreach($q->result() as $k)
            {
                $kd = ((int)$k->kd_max)+1;
                /*$kd = sprintf("%07s", $tmp);*/
            }
        }
        return $kd;
    }
    function get_id_pengeluaran(){
        $q = $this->db->query("select MAX(id_pengeluaran) as kd_max from tbl_pengeluaran_header");
        $kd= 0;
         if($q->num_rows()>0)
        {
            foreach($q->result() as $k)
            {
                $kd = ((int)$k->kd_max)+1;
                /*$kd = sprintf("%07s", $tmp);*/
            }
        }
        return $kd;
    }

    function get_id_tmp(){
        $q = $this->db->query("select MAX(id_tmp) as kd_max from tmp");
        $kd= 0;
         if($q->num_rows()>0)
        {
            foreach($q->result() as $k)
            {
                $kd = ((int)$k->kd_max)+1;
            }
        }
        return $kd;
    }

    function get_id_amprah(){
        $q = $this->db->query("select MAX(id_amprah) as kd_max from tbl_amprah");
        $kd= 0;
         if($q->num_rows()>0)
        {
            foreach($q->result() as $k)
            {
                $kd = ((int)$k->kd_max)+1;
                /*$kd = sprintf("%07s", $tmp);*/
            }
        }
        return $kd;
    }

     function insertData($table,$data)
    {
        $this->db->insert($table,$data);
    }

    public function getTambahStok1($id_barang,$tambah)
    {

        // $q = $this->db->query("select masuk, stok_akhir, stok_tersedia from data_persediaan where kode_barang='".$kode_barang."'");
        $q = $this->db->query("select masuk, stok_akhir, stok_tersedia from data_barang where id_barang='".$id_barang."'");
        $masuk = "";
        $stok_akhir ="";
        $stok_tersedia = "";
        foreach($q->result() as $d)
        {

            $masuk = $d->masuk + $tambah;
            $stok_akhir = $d->stok_akhir + $tambah;
            $stok_tersedia = $d->stok_tersedia + $tambah;
            
        }
        return $masuk."-".$stok_akhir."-".$stok_tersedia;
    }

     public function getKurangStok1($id_barang,$kurang)
    {
        /*$q = $this->db->query("select masuk, stok_akhir, stok_tersedia from data_persediaan where kode_barang='".$kode_barang."'");*/
        $q = $this->db->query("select masuk, stok_akhir, stok_tersedia from data_barang where id_barang='".$id_barang."'");
        $masuk = "";
        $stok_akhir ="";
        $stok_tersedia = "";
        foreach($q->result() as $d)
        {
            $masuk = $d->masuk - $kurang;
            //$stok_awal = $d->stok_awal - $kurang;
            $stok_akhir = $d->stok_akhir - $kurang;
            $stok_tersedia = $d->stok_tersedia - $kurang;
            //$stok_tersedia = $d->stok_tersedia - $stok;
        }
        return $masuk."-".$stok_akhir."-".$stok_tersedia;
    }

    /*kurang amprah*/
   public function getKurangStok1_copy($id_barang,$kurang)
    {
        $q = $this->db->query("select stok_akhir,stok_tersedia,keluar from data_barang where id_barang='".$id_barang."'");
        $stok_akhir = "";
        $stok_tersedia ="";
        $keluar = "";
        foreach($q->result() as $d)
        {
            $stok_akhir = $d->stok_akhir - $kurang;
            $keluar = $d->keluar + $kurang;
        }
        $stok_tersedia = $stok_akhir;
        return $stok_akhir."-".$stok_tersedia."-".$keluar;
    }

    function updateData($table,$data,$field_key)
    {
        $this->db->update($table,$data,$field_key);
    }

     public function getSelectedData($table,$data)
    {
        return $this->db->get_where($table, $data);
    }

 /*   function get_all_contacts($special = false) {
    $query = $this->db->query('SELECT * FROM person');
    if($special)
    {
        return $query;
    }
    return $query->result();
}*/

    function deleteData($table,$data)
    {
        return $this->db->delete($table,$data);
    }

    function deleteData1($table,$data,$special=false)
    {
        $q = $this->db->delete($table,$data);
        if($special)
            {
                return $q;
            }
        return $q->result();
    }



    function hapusTmp($kode){
        /*$this->db->where("kode_barang",$kode);*/
        $this->db->where("id_tmp",$kode);
        $this->db->delete("tmp");
    }

    function hapusTmp_Amprah($kode){
        /*$this->db->where("kode_barang",$kode);*/
        $this->db->where("id_tmp",$kode);
        $this->db->delete("tmp_amprah");
    }
    function hapusTmp_Pengeluaran($kode){
        /*$this->db->where("kode_barang",$kode);*/
        $this->db->where("id_tmp",$kode);
        $this->db->delete("tmp_keluar");
    }

    function getDataPengadaan($id){
        $q = $this->db->query("select * from tbl_pengadaan_header where id_pengadaan ='".$id."'");
        return $q;
    }

    function getBarangPengadaan($id){
        /*$q= $this->db->query("select * ,(a.qty*a.harga) as subtotal from tbl_pengadaan_detail a 
left join data_barang b on a.kd_barang = b.kode_barang where a.kd_pengadaan = '".$id."'");*/
        $q= $this->db->query("select * ,(a.qty*a.harga) as subtotal from tbl_pengadaan_detail a 
left join data_barang b on a.id_barang = b.id_barang where a.id_pengadaan = '".$id."'");

        return $q;
    }

     public function getTambahStok_Amprah($id_barang,$tambah)
    {
        /*$q = $this->db->query("select stok_akhir,stok_tersedia from data_persediaan where kode_barang='".$kode_barang."'");*/
        $q = $this->db->query("select stok_akhir,stok_tersedia,keluar from data_barang where id_barang='".$id_barang."'");
        $stok_akhir = "";
        $stok_tersedia ="";
        $keluar ="";
        foreach($q->result() as $d)
        {
            $stok_akhir = $d->stok_akhir + $tambah;
            $keluar = $d->keluar - $tambah;
        }
        $stok_tersedia = $stok_akhir;
        return $stok_akhir."-".$stok_tersedia."-".$keluar;
    }

    /*untuk datapengeluaran*/

    public function getKurangStok_pengeluaran($id_barang,$kurang)
    {
        
        // $q = $this->db->query("select keluar, stok_akhir, stok_tersedia from data_persediaan where kode_barang='".$kode_barang."'");
        $q = $this->db->query("select keluar, stok_akhir, stok_tersedia from data_barang where id_barang='".$id_barang."'");
        $keluar = "";
        $stok_akhir ="";
        $stok_tersedia = "";
        foreach($q->result() as $d)
        {
            /*$stok = $d->masuk + $tambah;*/
            $keluar = $d->keluar + $kurang;
            $stok_akhir = $d->stok_akhir - $kurang;
            //$stok_tersedia = $d->stok_tersedia + $tambah;
        }
        $stok_tersedia = $stok_akhir;
        return $keluar."-".$stok_akhir."-".$stok_tersedia;
    }

    function getDataPengeluaran($id){
        $q = $this->db->query("select * from tbl_pengeluaran_header tph
left join data_divisi dd on tph.kd_pelanggan = dd.kode_divisi
where id_pengeluaran ='".$id."'");
        return $q;
    }

    function getBarangPengeluaran($id){
         $q= $this->db->query("select a.id_pengeluaran ,a.id_barang,a.kd_pengeluaran,a.kd_barang,a.qty,a.harga,a.subtotal, b.nama_barang 
from tbl_pengeluaran_detail a left join data_barang b on a.id_barang = b.id_barang where a.id_pengeluaran = '".$id."'");
        return $q;
    }

    public function getTambahStok_Pengeluaran($id_barang,$tambah)
    {
        //$q = $this->db->query("select stok from tbl_barang where kd_barang='".$kd_barang."'");
        $q = $this->db->query("select keluar, stok_akhir, stok_tersedia from data_barang where id_barang='".$id_barang."'");
        $keluar = "";
        $stok_akhir ="";
        $stok_tersedia = "";
        foreach($q->result() as $d)
        {

            $keluar = $d->keluar - $tambah;
            $stok_akhir = $d->stok_akhir + $tambah;
        }
        $stok_tersedia = $stok_akhir;
        return $keluar."-".$stok_akhir."-".$stok_tersedia;
    }



}

/* End of file m_transaksi.php */
/* Location: ./application/models/m_transaksi.php */