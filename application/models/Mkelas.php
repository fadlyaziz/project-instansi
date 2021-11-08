<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mkelas extends CI_Model
{
    public function kelas()
    {
        // pada variabel sql kita menampilkan data kelas semuanya dilihat dari
        // * menandakan bahwa kita menampilkan field semuanya jika kita hanya butuh menampilkan nama kelas seperti ini "SELECT nama FROM kelas ORDER BY id_kelas DESC"
        $sql = "SELECT * FROM kelas ORDER BY id_kelas DESC";
        // code untuk memanggil pada query di database sesuai variabel $sql
        $query = $this->db->query($sql);

        // logika jika num_rows = menghitung pencarian didatabase sesuai variabel $query terdapat berapa baris?
        // jika hasilnya barisnya terdeteksi 0
        if ($query->num_rows() == 0) {
            // ini yang akan dijalankan hasilnya 0
            return 0;
        } else {
            // ini jika hasil barisnya lebih dari 0
            // result() perintah result() digunakan untuk memberikan hasil data dari variabel $query
            return $query->result();
        }
    }

    // ($nama, $alamat, $tgl_lahir, $foto) didalam kurung ini termasuk parameter yang dikirim dari controller
    public function kelas_tambah($nama)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "INSERT INTO kelas(`kelas`) VALUES ('$nama')";
        // code untuk memanggil pada query di database sesuai variabel $sql
        $query = $this->db->query($sql);

        // jika hasilnya berhasil disimpan
        if ($query) {
            // ini yang akan dijalankan hasilnya 1
            return 1;
        } else {
            return 0;
        }
    }


    public function kelas_edit($id_kelas)
    {
        // pada variabel sql kita menampilkan data kelas semuanya dilihat dari
        // * menandakan bahwa kita menampilkan field semuanya jika kita hanya butuh menampilkan nama kelas seperti ini "SELECT nama FROM kelas ORDER BY id_kelas DESC"
        // WHERE id_kelas='$id_kelas' == fungsi tersebut digunakan untuk mencari data yang sesuai id_kelas
        $sql = "SELECT * FROM kelas WHERE id_kelas='$id_kelas'";
        // code untuk memanggil pada query di database sesuai variabel $sql
        $query = $this->db->query($sql);

        // logika jika num_rows = menghitung pencarian didatabase sesuai variabel $query terdapat berapa baris?
        // jika hasilnya barisnya terdeteksi 0
        if ($query->num_rows() == 0) {
            // ini yang akan dijalankan hasilnya 0
            return 0;
        } else {
            // ini jika hasil barisnya lebih dari 0
            // result() perintah result() digunakan untuk memberikan hasil data dari variabel $query
            return $query->result();
        }
    }

    // ($nama, $alamat, $tgl_lahir, $foto) didalam kurung ini termasuk parameter yang dikirim dari controller
    public function kelas_edit_proses($id_kelas, $nama)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "UPDATE kelas SET `kelas`='$nama' WHERE id_kelas='$id_kelas'";
        // code untuk memanggil pada query di database sesuai variabel $sql
        $query = $this->db->query($sql);

        // jika hasilnya berhasil disimpan
        if ($query) {
            // ini yang akan dijalankan hasilnya 1
            return 1;
        } else {
            return 0;
        }
    }

    // ($nama, $alamat, $tgl_lahir, $foto) didalam kurung ini termasuk parameter yang dikirim dari controller
    public function kelas_hapus($id_kelas)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "DELETE FROM `kelas` WHERE id_kelas='$id_kelas'";
        // code untuk memanggil pada query di database sesuai variabel $sql
        $query = $this->db->query($sql);

        // jika hasilnya berhasil disimpan
        if ($query) {
            // ini yang akan dijalankan hasilnya 1
            return 1;
        } else {
            return 0;
        }
    }

}
