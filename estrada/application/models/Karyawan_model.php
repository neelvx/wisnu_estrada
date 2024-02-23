<?php 

class Karyawan_model extends CI_Model {

    private $table = "m_karyawan";
    public function get_karyawan()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }
}

?>