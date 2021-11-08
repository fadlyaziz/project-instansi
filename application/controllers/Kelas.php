<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    public function index()
    {
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mkelas');

        //memanggil database melalui model dengan tidak membawa nilai apapun ke modelnya
        $data['dtkelas'] = $this->Mkelas->kelas();
        // membuat variabel active untuk membedakan menu
        $data['mkelastampil'] = true;
        $data['title'] = "Kelas";
        //setelah itu model akan mengirimkan data sesuai permintaan yang akan diteruskan melalui view perhatikan parameter array yang ada di $data['dtkelas] $data['dtkelas]

        //untuk penamaan view_home bebas asalkan sama pada file yang ada di folder views
        $this->load->view('backend/part/header', $data);
        $this->load->view('backend/page/kelas/view_kelas_tampil');
        $this->load->view('backend/part/footer');
    }

    public function tambah()
    {
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mkelas');

        // kita ambil nilai dulu yang ada didalam <form enctype="multipart/form-data" action="<?= base_url('kelas/tambah');
        $nama = $this->input->post('txtnama');


        // LOGIKA IF [JIKA SISTEM SUDAH MEMINDAHKAN FOTO KEDALAM VARIABEL LOCATION DAN mengirimkan data yang ada di dalam kurung ini ($nama, $alamat, $tanggallahir, $foto)]
        if ($this->Mkelas->kelas_tambah($nama)) {
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil Disimpan!</strong> Data ' . $nama . ' Sudah Tersimpan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('kelas');
        } else {
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal Simpan Data!</strong> Data ' . $nama . ' Belum Disimpan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('kelas');
        }
    }

    // pada function kali ini berbeda dari yang diatas, dikarenakan ada parameter didalamnya function yaitu $id_kelas
    // APA ITU PARAMETER ADALAH SEBUAH PERINTAH UNTUK MENYIMPAN NILAI YANG DISIMPAN DI VARIABEL seperti contoh dibawah ini kita menggunakan variabel $id_kelas
    // $id_kelas=0  YANG DIMAKSUD PADA VARIABEL INI ADALAH UNTUK MELIHAT JIKA PADA PERINTAH TIDAK ADA NILAINYA MAKA NILAI 0 INILAH YANG AKANN  DIGUNAKAN
    public function edit($id_kelas = 0)
    {
        // melakukan logika terlebih dahulu untuk mengetahui $id_kelas sudah ada nilainya atau tidak
        if ($id_kelas == 0) {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN kelas
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ada yang Salah!</strong> URL tidak terdapat ID.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE kelas
            redirect('kelas');
        }

        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mkelas');

        //memanggil database melalui model dengan  membawa nilai $id_kelas  ke modelnya
        $data['dtkelasid'] = $this->Mkelas->kelas_edit($id_kelas);

        // melakukan logika terlebih dahulu untuk mengetahui hasil dari model kelas_edit sudah ada nilainya atau tidak
        if ($data['dtkelasid'] == 0) {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN kelas
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ID Tidak Terdapat diDatabase!</strong> Silahkan Ulangi lagi.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE kelas
            redirect('kelas');
        }


        // membuat variabel active untuk membedakan menu
        $data['mkelastampil'] = true;
        $data['title'] = "Edit Kelas";

        //untuk penamaan view_kelas bebas asalkan sama pada file yang ada di folder views
        $this->load->view('backend/part/header', $data);
        $this->load->view('backend/page/kelas/view_kelas_edit');
        $this->load->view('backend/part/footer');
        // $data ini digunakan untuk mengirim nilai hasil dari pencarian melalui model $data['dtkelas']
    }


    public function edit_proses()
    {
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mkelas');

        // kita ambil nilai dulu yang ada didalam <form enctype="multipart/form-data" action="<?= base_url('kelas/tambah');
        $id_kelas = $this->input->post('txtid_kelas');
        $nama = $this->input->post('txtnama');

        // update data melalui model
        if ($this->Mkelas->kelas_edit_proses($id_kelas, $nama)) {
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil Disimpan!</strong> Data ' . $nama . ' Sudah Tersimpan.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('kelas');
        } else {
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal Simpan Data!</strong> Data ' . $nama . ' Belum Disimpan.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('kelas');
        }
    }


    function hapus($id_kelas = 0)
    {
        // melakukan logika terlebih dahulu untuk mengetahui $id_kelas sudah ada nilainya atau tidak
        if ($id_kelas == 0) {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN kelas
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ada yang Salah!</strong> gagal hapus data, URL tidak terdapat ID.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE kelas
            redirect('kelas');
        }
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mkelas');

        // LOGIKA IF [mengirimkan data yang ada di dalam kurung ini ($nama, $alamat, $tanggallahir, $foto)]
        if ($this->Mkelas->kelas_hapus($id_kelas)) {
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil Disimpan!</strong> Data Sudah Tersimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('kelas');
        } else {
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal Hapus Data!</strong> Data Belum Dihapus ID tidak ditemukan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('kelas');
        }
    }

    
}
