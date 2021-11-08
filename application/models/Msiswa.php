<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Msiswa extends CI_Model
{
    public function siswa()
    {
        // pada variabel sql kita menampilkan data siswa semuanya dilihat dari
        // * menandakan bahwa kita menampilkan field semuanya jika kita hanya butuh menampilkan nama siswa seperti ini "SELECT nama FROM siswa ORDER BY id_siswa DESC"
        $sql = "SELECT * FROM siswa ORDER BY id_siswa DESC";
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
    public function siswa_tambah($nama, $alamat, $tgl_lahir, $foto)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "INSERT INTO siswa(`nama`, `alamat`, `tgl_lahir`, `foto`) VALUES ('$nama', '$alamat', '$tgl_lahir', '$foto')";
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

    public function siswa_edit($id_siswa)
    {
        // pada variabel sql kita menampilkan data siswa semuanya dilihat dari
        // * menandakan bahwa kita menampilkan field semuanya jika kita hanya butuh menampilkan nama siswa seperti ini "SELECT nama FROM siswa ORDER BY id_siswa DESC"
        // WHERE id_siswa='$id_siswa' == fungsi tersebut digunakan untuk mencari data yang sesuai id_siswa
        $sql = "SELECT * FROM siswa WHERE id_siswa='$id_siswa'";
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
    public function siswa_edit_proses($id_siswa, $nama, $alamat, $tgl_lahir)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "UPDATE siswa SET `nama`='$nama', `alamat`='$alamat', `tgl_lahir`='$tgl_lahir' WHERE id_siswa='$id_siswa'";
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
    public function siswa_edit_prosesfoto($id_siswa, $nama, $alamat, $tgl_lahir, $foto)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "UPDATE siswa SET `nama`='$nama', `alamat`='$alamat', `tgl_lahir`='$tgl_lahir', `foto`='$foto' WHERE id_siswa='$id_siswa'";
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
    public function siswa_hapus($id_siswa)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "DELETE FROM `siswa` WHERE id_siswa='$id_siswa'";
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
