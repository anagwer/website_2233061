<?php
class M_data extends CI_Model {

    // Fungsi untuk mengambil data dari database
    function get_data($table) {
        return $this->db->get($table);
    }

    // Fungsi untuk menambahkan data ke database
    function insert_data($table, $data) {
        return $this->db->insert($table, $data);
    }

    // Fungsi untuk mengedit data dari database
    function edit_data($table, $where) {
        return $this->db->get_where($table, $where);
    }

    // Fungsi untuk update data pada database
    function update_data($table, $data, $where) {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    // Fungsi untuk menghapus data dari database
    function delete_data($table, $where) {
        return $this->db->delete($table, $where);
    }
}
?>
