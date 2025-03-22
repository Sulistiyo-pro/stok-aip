<?php

class Stok_model extends CI_Model {

    function get_total_masuk($id, $tanggal) {
        $sql = "SELECT IFNULL(SUM(jumlah),0) as masuk FROM stok_masuk WHERE id='$id' AND tanggal='$tanggal'";
        return $this->db->query($sql)->row_array();
    }

    function get_total_keluar($id, $tanggal) {
        $sql = "SELECT IFNULL(SUM(jumlah),0) as keluar FROM stok_keluar WHERE id='$id' AND tanggal='$tanggal'";
        return $this->db->query($sql)->row_array();
    }

    function get_total_terjual($id, $tanggal) {
        $sql = "SELECT IFNULL(SUM(qty),0) as terjual FROM tr_penjualan WHERE stok='$id' AND waktu LIKE '$tanggal%'";
        return $this->db->query($sql)->row_array();
    }

}
