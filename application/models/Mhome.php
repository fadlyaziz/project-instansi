<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mhome extends CI_Model
{
    public function guru_limit()
    {
        $sql = "SELECT * FROM guru ORDER BY id_guru DESC LIMIT 5";
        $query = $this->db->query($sql);

        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->result();
        }
    }
    public function siswa_limit()
    {
        $sql = "SELECT * FROM siswa ORDER BY id_siswa DESC LIMIT 5";
        $query = $this->db->query($sql);

        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->result();
        }
    }
}
