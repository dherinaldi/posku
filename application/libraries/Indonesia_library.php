<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Indonesia_library {	

	function format_rupiah($angka)

	{

		$rupiah="";

		$rp=strlen($angka);

		while ($rp>3)

		{

			$rupiah = ".". substr($angka,-3). $rupiah;

			$s=strlen($angka) - 3;

			$angka=substr($angka,0,$s);

			$rp=strlen($angka);

		}

		$rupiah = "Rp " . $angka . $rupiah . "";

		return $rupiah;

	}

	function format_rupiah2($angka){
		$rupiah = "";
		$rupiah = number_format($angka,2,",",".");

		return "Rp. ".$rupiah;

	}

	function digit2($angka){
		$rupiah = "";
		$rupiah = number_format($angka,2,",",".");

		return $rupiah;

	}

	function digit21($angka){
		$rupiah = "";
		$rupiah = number_format($angka,2,".",",");
		return $rupiah;

	}

	function digit0($angka){
		$rupiah = "";
		$rupiah = number_format($angka,0,",","");

		return $rupiah;

	}

	function digit01($angka){
		$rupiah = "";
		$rupiah = number_format($angka,2,".","");

		return $rupiah;

	}

	function format_tanggal()

	{

		date_default_timezone_set('Asia/Jakarta');

		$skrg=date("Y-m-d");	

		return $skrg;

	}	

	

	function format_tanggal_jam()

	{

		date_default_timezone_set('Asia/Jakarta');

		$skrg=date("Y-m-d H:i:s");	

		return $skrg;

	}

	

	function konversi_tanggal($tanggal)

	{
		$format = array(
			'Sun' => 'Minggu', 'Mon' => 'Senin', 'Tue' => 'Selasa', 'Wed' => 'Rabu', 'Thu' => 'Kamis', 'Fri' => 'Jumat', 'Sat' => 'Sabtu', 'Jan' => 'Januari', 'Feb' => 'Februari', 'Mar' => 'Maret', 'Apr' => 'April', 'May' => 'Mei', 'Jun' => 'Juni', 'Jul' => 'Juli', 'Aug' => 'Agustus', 'Sep' => 'September', 'Oct' => 'Oktober', 'Nov' => 'November', 'Dec' => 'Desember'
			);

		/*$tanggal = date('D, d M Y', strtotime($tanggal));*/
		$tanggal = date('d M Y', strtotime($tanggal));

		return strtr($tanggal, $format);
	}

	function konversi_tanggal1($tanggal)

	{
		
		/*$tanggal = date('D, d M Y', strtotime($tanggal));*/
		$tanggal = date('d-m-Y', strtotime($tanggal));
		return $tanggal;
		//return strtr($tanggal, $format);
	}

	function konversi_bulan($tanggal)

	{
		$format = array(
			'Sun' => 'Minggu', 'Mon' => 'Senin', 'Tue' => 'Selasa', 'Wed' => 'Rabu', 'Thu' => 'Kamis', 'Fri' => 'Jumat', 'Sat' => 'Sabtu', 'Jan' => 'Januari', 'Feb' => 'Februari', 'Mar' => 'Maret', 'Apr' => 'April', 'May' => 'Mei', 'Jun' => 'Juni', 'Jul' => 'Juli', 'Aug' => 'Agustus', 'Sep' => 'September', 'Oct' => 'Oktober', 'Nov' => 'November', 'Dec' => 'Desember'
			);

		/*$tanggal = date('D, d M Y', strtotime($tanggal));*/
		$tanggal = date('M Y', strtotime($tanggal));

		return strtr($tanggal, $format);
	}
	//input data
	function make_comma($qty){
		$qty_hasil = str_replace('.' , '', $qty); //hilangkan pemisah ribuan
		$qty_hasil = str_replace(',' , '.', $qty_hasil);

		return $qty_hasil;
	}
	//display data
	function format_comma($qty){
		return number_format($qty,2,",",".");
	}

	function make_strlower($str){
		return strtolower($str);
	}

	function calc_age($birthdate) {
		list($year,$month,$day) = explode("-",$birthdate);
		$year_diff  = date("Y") - $year;
		$month_diff = date("m") - $month;
		$day_diff   = date("d") - $day;
		if ($month_diff < 0) $year_diff--;
		elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
		return $year_diff." thn ".$month_diff." bln ".$day_diff." hr ";
	}

	function calc_tmt($birthdate) {
		list($year,$month,$day) = explode("-",$birthdate);
		$year_diff  = date("Y") - $year;
		$month_diff = date("m") - $month;
		$day_diff   = date("d") - $day;
		if ($month_diff < 0) $year_diff--;
		elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
		return $year_diff." thn ".$month_diff." bln ";
	}

	function calc_age1($birthdate) {
		list($day,$month,$year) = explode("-",$birthdate);
		$year_diff  = date("Y") - $year;
		$month_diff = date("m") - $month;
		$day_diff   = date("d") - $day;
		if ($month_diff < 0) $year_diff--;
		elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
		return $year_diff." thn ".$month_diff." bln ".$day_diff." day ";
	}

}