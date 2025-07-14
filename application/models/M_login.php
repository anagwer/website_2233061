<?php  
class M_login extends CI_Model { 
     
    // Fungsi untuk login
    function cek_login($table, $where) { 
        return $this->db->get_where($table, $where); 
    } 

    // ✅ Fungsi tambahan untuk ambil data user berdasarkan ID
    public function get_user_by_id($id) {
        return $this->db->get_where('pengguna', ['pengguna_id' => $id])->row();
    }
} 
?>
