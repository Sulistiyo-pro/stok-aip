<?php
function get_info_menu($id){
    $ci = &get_instance();
    $ci->load->model('Crud_model','crud');
    return $ci->crud->read('ms_menu',['id' => $id])[0];
}
function get_info_stok($id){
    $ci = &get_instance();
    $ci->load->model('Crud_model','crud');
    return $ci->crud->read('ms_stok',['id' => $id])[0];
}
function get_info_kas($id){
    $ci = &get_instance();
    $ci->load->model('Crud_model','crud');
    return $ci->crud->read('ms_kas',['id' => $id])[0];
}
function get_info_user($username){
    $ci = &get_instance();
    $ci->load->model('Crud_model','crud');
    return $ci->crud->read('ms_user',['username' => $username])[0];
}
function get_total_masuk($id,$tanggal){
    $ci = &get_instance();
    $ci->load->model('Stok_model','stok');
    return $ci->stok->get_total_masuk($id,$tanggal)['masuk'];
}
function get_total_keluar($id,$tanggal){
    $ci = &get_instance();
    $ci->load->model('Stok_model','stok');
    return $ci->stok->get_total_keluar($id,$tanggal)['keluar'];
}
function get_total_terjual($id,$tanggal){
    $ci = &get_instance();
    $ci->load->model('Stok_model','stok');
    return $ci->stok->get_total_terjual($id,$tanggal)['terjual'];
}
function get_total_kas_masuk($id,$tanggal){
    $ci = &get_instance();
    $ci->load->model('Kas_model','kas');
    return $ci->kas->get_total_kas_masuk($id,$tanggal)['masuk'];
}
function get_total_kas_keluar($id,$tanggal){
    $ci = &get_instance();
    $ci->load->model('Kas_model','kas');
    return $ci->kas->get_total_kas_keluar($id,$tanggal)['keluar'];
}
function get_total_kas_penjualan($id,$tanggal){
    $ci = &get_instance();
    $ci->load->model('Kas_model','kas');
    return $ci->kas->get_total_kas_penjualan($id,$tanggal)['penjualan'];
}


if ( ! function_exists('number_to_words'))
{
	function number_to_words($number)
	{
		$before_comma = trim(to_word($number));
		$after_comma = trim(comma($number));
		//return ucwords($results = $before_comma.' koma '.$after_comma);
		return $results = $before_comma;
	}

	function to_word($number)
	{
		$words = "";
		$arr_number = array(
		"",
		"satu",
		"dua",
		"tiga",
		"empat",
		"lima",
		"enam",
		"tujuh",
		"delapan",
		"sembilan",
		"sepuluh",
		"sebelas");

		if($number<12)
		{
			$words = " ".$arr_number[$number];
		}
		else if($number<20)
		{
			$words = to_word($number-10)." belas";
		}
		else if($number<100)
		{
			$words = to_word($number/10)." puluh ".to_word($number%10);
		}
		else if($number<200)
		{
			$words = "seratus ".to_word($number-100);
		}
		else if($number<1000)
		{
			$words = to_word($number/100)." ratus ".to_word($number%100);
		}
		else if($number<2000)
		{
			$words = "seribu ".to_word($number-1000);
		}
		else if($number<1000000)
		{
			$words = to_word($number/1000)." ribu ".to_word($number%1000);
		}
		else if($number<1000000000)
		{
			$words = to_word($number/1000000)." juta ".to_word($number%1000000);
		}
		else
		{
			$words = "undefined";
		}
		return $words;
	}

	function comma($number)
	{
		$after_comma = stristr($number,',');
		$arr_number = array(
		"nol",
		"satu",
		"dua",
		"tiga",
		"empat",
		"lima",
		"enam",
		"tujuh",
		"delapan",
		"sembilan");

		$results = "";
		$length = strlen($after_comma);
		$i = 1;
		while($i<$length)
		{
			$get = substr($after_comma,$i,1);
			$results .= " ".$arr_number[$get];
			$i++;
		}
		return $results;
	}
}
