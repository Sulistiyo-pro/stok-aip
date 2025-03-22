<?php

class Kas_model extends CI_Model {

    function get_total_kas_masuk($id, $tanggal) {
        $sql = "SELECT IFNULL(SUM(jumlah),0) as masuk FROM kas_masuk WHERE id='$id' AND tanggal='$tanggal'";
        return $this->db->query($sql)->row_array();
    }

    function get_total_kas_keluar($id, $tanggal) {
        $sql = "SELECT IFNULL(SUM(jumlah),0) as keluar FROM kas_keluar WHERE id='$id' AND tanggal='$tanggal'";
        return $this->db->query($sql)->row_array();
    }
	
	function get_total_kas_penjualan($id, $tanggal) {
        $sql = "SELECT IFNULL(SUM(total),0) as penjualan FROM tr_penjualan WHERE kas='$id' AND waktu LIKE '$tanggal%'";
        return $this->db->query($sql)->row_array();
    }
}
