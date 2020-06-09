<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function inc_app($dir,$file)
{
    include(APPPATH.'views/'.$dir.'/'.$file.'.php');
}

function getUser()
{
    $CI=& get_instance();
    $CI->load->model('loginmodel');
    return $CI->loginmodel->getUser();
}

function getRole()
{
    $CI=& get_instance();
    $CI->load->model('loginmodel');
    return $CI->loginmodel->getRoleUser();
}

function getInfoUser($output)
{
    $CI=& get_instance();
    $CI->load->model('loginmodel');
    return $CI->loginmodel->getInfoUserBySession($output);
}


function getsystemhe()
{
    return '<a href="http://www.ilmuprogrammer.com">Heru Rahmat Akhnuari</a>';
}
function get_option($key)
{
    $CI=&get_instance();
    $CI->load->library('database_library');
    $CI->database_library->pake_table('options');
    $isData=$CI->database_library->ambil_satu_data('option_key',$key,'option_value');
    if(!empty($isData))
    {
        return $isData;
    }else{
        return "Config not found";
    }
}

function get_header()
{   
    inc_app('themes','header');
}

function get_footer()
{   
    inc_app('themes','footer');
}

function unik_id()
{
    $CI=& get_instance();
    $CI->load->helper('date');
    date_default_timezone_set('Asia/Jakarta');
    $datestring = "%Y-%m-%d %H:%i:%s";

    $id = md5( base64_encode( uniqid() ) );
    $idformat=substr(md5($id), 0, 6);
    return $idformat;
}

function tanggalindo()
{
    $CI=& get_instance();
    $CI->load->library('indonesia_library');
    return $CI->indonesia_library->format_tanggal();    
}

function getroleapotik()
{
    $CI=&get_instance();
    if($CI->session->userdata('role')=="apotik")
    {
        return "rs";
    }elseif($CI->session->userdata('role')=="apotikext")
    {
        return "pelengkap";
    }
}

function converttgl($tanggal)
{
    $CI=& get_instance();
    $CI->load->library('indonesia_library');
    return $CI->indonesia_library->konversi_tanggal($tanggal);
}

function converttgl1($tanggal)
{
    $CI=& get_instance();
    $CI->load->library('indonesia_library');
    return $CI->indonesia_library->konversi_tanggal1($tanggal);
}

function convertbln($tanggal)
{
    $CI=& get_instance();
    $CI->load->library('indonesia_library');
    return $CI->indonesia_library->konversi_bulan($tanggal);
}

function convertrp($angka)
{
    $CI=& get_instance();
    $CI->load->library('indonesia_library');
    return $CI->indonesia_library->format_rupiah($angka);
}

function convertrp2($angka)
{
    $CI=& get_instance();
    $CI->load->library('indonesia_library');
    return $CI->indonesia_library->format_rupiah2($angka);
}

function digit2($angka)
{
    $CI=& get_instance();
    $CI->load->library('indonesia_library');
    return $CI->indonesia_library->digit2($angka);
}

function digit21($angka)
{
    $CI=& get_instance();
    $CI->load->library('indonesia_library');
    return $CI->indonesia_library->digit21($angka);
}

function digit0($angka)
{
    $CI=& get_instance();
    $CI->load->library('indonesia_library');
    return $CI->indonesia_library->digit0($angka);
}

function digit01($angka)
{
    $CI=& get_instance();
    $CI->load->library('indonesia_library');
    return $CI->indonesia_library->digit01($angka);
}

function convertcomma($qty){
    $CI=& get_instance();
    $CI->load->library('indonesia_library');
    return $CI->indonesia_library->make_comma($qty);

}

function formatcomma($qty){
    $CI=& get_instance();
    $CI->load->library('indonesia_library');
    return $CI->indonesia_library->format_comma($qty);

}

function lower($str){
    $CI=& get_instance();
    $CI->load->library('indonesia_library');
    return $CI->indonesia_library->make_strlower($str);

}

function calc_age($birthdate){
    $CI=& get_instance();
    $CI->load->library('indonesia_library');
    return $CI->indonesia_library->calc_age($birthdate);

}

function calc_tmt($tmt){
    $CI=& get_instance();
    $CI->load->library('indonesia_library');
    return $CI->indonesia_library->calc_tmt($tmt);

}

function calc_age1($birthdate){
    $CI=& get_instance();
    $CI->load->library('indonesia_library');
    return $CI->indonesia_library->calc_age1($birthdate);

}

function hitung_usia($birthdate) {
    list($year,$month,$day) = explode("-",$birthdate);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($month_diff < 0) $year_diff--;
    elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
    return $year_diff." tahun".$month_diff." bln ".$day_diff." hari";
}

function GetRequest($key, $default = null, $source = '') 
{
  if ($source == 'get') {
    if (isset($_GET[$key])) { 
      return $_GET[$key]; 
  } else { 
      return $default; 
  }
} else if ($source == 'post') {
    if (isset($_POST[$key])) { 
      return $_POST[$key]; 
  } else { 
      return $default; 
  }
} else if ($source == 'cookie') {
    if (isset($_COOKIE[$key])) { 
      return $_COOKIE[$key]; 
  } else { 
      return $default; 
  }
} else {
    // no source specified, then find in GPC
    if (isset($_GET[$key])) {
      return $_GET[$key];     
  } else if (isset($_POST[$key])) {
      return $_POST[$key]; 
  } else if (isset($_COOKIE[$key])) {
      return $_COOKIE[$key]; 
  } else {
      return $default; 
  } 
}
}

function terbilang($angka) {
    // pastikan kita hanya berususan dengan tipe data numeric
    $angka = (float)$angka;
    
    // array bilangan
    // sepuluh dan sebelas merupakan special karena awalan 'se'
    $bilangan = array(
        '',
        'satu',
        'dua',
        'tiga',
        'empat',
        'lima',
        'enam',
        'tujuh',
        'delapan',
        'sembilan',
        'sepuluh',
        'sebelas'
        );
    
    // pencocokan dimulai dari satuan angka terkecil
    if ($angka < 12) {
        // mapping angka ke index array $bilangan
        return $bilangan[$angka];
    } else if ($angka < 20) {
        // bilangan 'belasan'
        // misal 18 maka 18 - 10 = 8
        return $bilangan[$angka - 10] . ' belas';
    } else if ($angka < 100) {
        // bilangan 'puluhan'
        // misal 27 maka 27 / 10 = 2.7 (integer => 2) 'dua'
        // untuk mendapatkan sisa bagi gunakan modulus
        // 27 mod 10 = 7 'tujuh'
        $hasil_bagi = (int)($angka / 10);
        $hasil_mod = $angka % 10;
        return trim(sprintf('%s puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
    } else if ($angka < 200) {
        // bilangan 'seratusan' (itulah indonesia knp tidak satu ratus saja? :))
        // misal 151 maka 151 = 100 = 51 (hasil berupa 'puluhan')
        // daripada menulis ulang rutin kode puluhan maka gunakan
        // saja fungsi rekursif dengan memanggil fungsi terbilang(51)
        return sprintf('seratus %s', terbilang($angka - 100));
    } else if ($angka < 1000) {
        // bilangan 'ratusan'
        // misal 467 maka 467 / 100 = 4,67 (integer => 4) 'empat'
        // sisanya 467 mod 100 = 67 (berupa puluhan jadi gunakan rekursif terbilang(67))
        $hasil_bagi = (int)($angka / 100);
        $hasil_mod = $angka % 100;
        return trim(sprintf('%s ratus %s', $bilangan[$hasil_bagi], terbilang($hasil_mod)));
    } else if ($angka < 2000) {
        // bilangan 'seribuan'
        // misal 1250 maka 1250 - 1000 = 250 (ratusan)
        // gunakan rekursif terbilang(250)
        return trim(sprintf('seribu %s', terbilang($angka - 1000)));
    } else if ($angka < 1000000) {
        // bilangan 'ribuan' (sampai ratusan ribu
        $hasil_bagi = (int)($angka / 1000); // karena hasilnya bisa ratusan jadi langsung digunakan rekursif
        $hasil_mod = $angka % 1000;
        return sprintf('%s ribu %s', terbilang($hasil_bagi), terbilang($hasil_mod));
    } else if ($angka < 1000000000) {
        // bilangan 'jutaan' (sampai ratusan juta)
        // 'satu puluh' => SALAH
        // 'satu ratus' => SALAH
        // 'satu juta' => BENAR
        // @#$%^ WT*
     
        // hasil bagi bisa satuan, belasan, ratusan jadi langsung kita gunakan rekursif
        $hasil_bagi = (int)($angka / 1000000);
        $hasil_mod = $angka % 1000000;
        return trim(sprintf('%s juta %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
    } else if ($angka < 1000000000000) {
        // bilangan 'milyaran'
        $hasil_bagi = (int)($angka / 1000000000);
        // karena batas maksimum integer untuk 32bit sistem adalah 2147483647
        // maka kita gunakan fmod agar dapat menghandle angka yang lebih besar
        $hasil_mod = fmod($angka, 1000000000);
        return trim(sprintf('%s milyar %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
    } else if ($angka < 1000000000000000) {
        // bilangan 'triliun'
        $hasil_bagi = $angka / 1000000000000;
        $hasil_mod = fmod($angka, 1000000000000);
        return trim(sprintf('%s triliun %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
    } else {
        return 'Wow...';
    }
}




