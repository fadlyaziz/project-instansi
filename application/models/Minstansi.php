<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mguru extends CI_Model
{
    public function instansi()
    {
        // pada variabel sql kita menampilkan data guru semuanya dilihat dari
        // * menandakan bahwa kita menampilkan field semuanya jika kita hanya butuh menampilkan nama guru seperti ini "SELECT nama FROM guru ORDER BY id_guru DESC"
        $sql = "SELECT * FROM instansi ORDER BY id_instansi DESC";
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
    public function instansi_tambah($nama, $alamat, $tgl_lahir, $foto)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "INSERT INTO instansi(`nama`, `alamat`, `tgl_lahir`, `foto`) VALUES ('$nama', '$alamat', '$tgl_lahir', '$foto')";
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


    public function instansi_edit($id_instansi)
    {
        // pada variabel sql kita menampilkan data guru semuanya dilihat dari
        // * menandakan bahwa kita menampilkan field semuanya jika kita hanya butuh menampilkan nama guru seperti ini "SELECT nama FROM guru ORDER BY id_guru DESC"
        // WHERE id_guru='$id_guru' == fungsi tersebut digunakan untuk mencari data yang sesuai id_guru
        $sql = "SELECT * FROM instansi WHERE id_instansi='$id_instansi'";
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
    public function instansi_edit_proses($id_instansi, $nama, $alamat, $tgl_lahir)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "UPDATE instansi SET `nama`='$nama', `alamat`='$alamat', `tgl_lahir`='$tgl_lahir' WHERE id_instansi='$id_instansi'";
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
    public function instansi_edit_prosesfoto($id_instansi, $nama, $alamat, $tgl_lahir, $foto)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "UPDATE instansi SET `nama`='$nama', `alamat`='$alamat', `tgl_lahir`='$tgl_lahir', `foto`='$foto' WHERE id_instansi='$id_instansi'";
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

    // ($id_guru) didalam kurung ini termasuk parameter yang dikirim dari controller
    public function instansi_hapus($id_instansi)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "DELETE FROM `instansi` WHERE id_instansi='$id_instansi'";
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
