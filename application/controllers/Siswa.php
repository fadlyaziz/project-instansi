<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    public function index()
    {
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Msiswa');

        //memanggil database melalui model dengan tidak membawa nilai apapun ke modelnya
        $data['dtsiswa'] = $this->Msiswa->siswa();
        // membuat variabel active untuk membedakan menu
        $data['msiswatampil'] = true;
        $data['title'] = "Siswa";
        //setelah itu model akan mengirimkan data sesuai permintaan yang akan diteruskan melalui view perhatikan parameter array yang ada di $data['dtsiswa] $data['dtsiswa]

        //untuk penamaan view_home bebas asalkan sama pada file yang ada di folder views
        $this->load->view('backend/part/header', $data);
        $this->load->view('backend/page/siswa/view_siswa_tampil');
        $this->load->view('backend/part/footer');
    }

    public function tambah()
    {
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Msiswa');

        // kita ambil nilai dulu yang ada didalam <form enctype="multipart/form-data" action="<?= base_url('siswa/tambah');
        $nama = $this->input->post('txtnama');
        $alamat = $this->input->post('txtalamat');
        $tanggallahir = $this->input->post('txttanggallahir');

        // PEMANGGILAN NAMA DARI SUATU FOTO YANG AKAN DIAMBIL TIPE FILENYA
        //  $_FILES MEMANGGIL TXTFOTO DENGAN ATTRIBUT NAME
        $e = $_FILES['txtfoto']['name'];
        // EXPLODE DIGUNAKAN UNTUK MEMISAHKAN KALIMAT DARI SEBELUM TITIK . DAN SESUDAH TITIK .
        $x = explode(".", $e);
        // strtolower(end($x)) MENGAMBIL NILAI PALING AKHIR DARI VARIABEL X
        $ekstensi = strtolower(end($x));
        // MEMBUAT FILE FOTO siswa YANG NNTINYA DIMASUKKAN KE DAABASE
        $foto = date('YmdHis') . "." . $ekstensi;

        /* Location FOTO YANG AKAN DISIMPAN */
        $location = "upload/siswa/" . $foto;

        /* Valid Extensions TIPE FOTO YANG BISA DISIMPAN */
        $valid_extensions = array("jpg", "jpeg", "png");


        // MEMBERI LOGIKA IF (JIKA HASIL FOTO YANG DIUPLOAD TIDAK SAMA DENGAN EKSTENSI YANG DITENTUKAN MAKA AKAN ERROR)
        if (!in_array($ekstensi, $valid_extensions)) {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN siswa
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Foto Salah!</strong> Kamu harus Upload foto dengan format JPG PNG JPEG.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE siswa
            redirect('siswa');
        } else {
            // LOGIKA IF [JIKA SISTEM SUDAH MEMINDAHKAN FOTO KEDALAM VARIABEL LOCATION DAN mengirimkan data yang ada di dalam kurung ini ($nama, $alamat, $tanggallahir, $foto)]
            if (move_uploaded_file($_FILES['txtfoto']['tmp_name'], $location) && $this->Msiswa->siswa_tambah($nama, $alamat, $tanggallahir, $foto)) {
                $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil Disimpan!</strong> Data ' . $nama . ' Sudah Tersimpan.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('siswa');
            } else {
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal Simpan Data!</strong> Data ' . $nama . ' Belum Disimpan.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('siswa');
            }
        }
    }

    // pada function kali ini berbeda dari yang diatas, dikarenakan ada parameter didalamnya function yaitu $id_siswa
    // APA ITU PARAMETER ADALAH SEBUAH PERINTAH UNTUK MENYIMPAN NILAI YANG DISIMPAN DI VARIABEL seperti contoh dibawah ini kita menggunakan variabel $id_siswa
    // $id_siswa=0  YANG DIMAKSUD PADA VARIABEL INI ADALAH UNTUK MELIHAT JIKA PADA PERINTAH TIDAK ADA NILAINYA MAKA NILAI 0 INILAH YANG AKANN  DIGUNAKAN
    public function edit($id_siswa = 0)
    {
        // melakukan logika terlebih dahulu untuk mengetahui $id_siswa sudah ada nilainya atau tidak
        if ($id_siswa == 0) {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN siswa
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ada yang Salah!</strong> URL tidak terdapat ID.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE siswa
            redirect('siswa');
        }

        // kita panggil dulu nama model yang kita buat
        $this->load->model('Msiswa');

        //memanggil database melalui model dengan  membawa nilai $id_siswa  ke modelnya
        $data['dtsiswaid'] = $this->Msiswa->siswa_edit($id_siswa);

        // melakukan logika terlebih dahulu untuk mengetahui hasil dari model siswa_edit sudah ada nilainya atau tidak
        if ($data['dtsiswaid'] == 0) {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN siswa
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ID Tidak Terdapat diDatabase!</strong> Silahkan Ulangi lagi.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE siswa
            redirect('siswa');
        }

        // membuat variabel active untuk membedakan menu
        $data['msiswatampil'] = true;
        $data['title'] = "Edit Siswa";

        //untuk penamaan view_siswa bebas asalkan sama pada file yang ada di folder views
        $this->load->view('backend/part/header', $data);
        $this->load->view('backend/page/siswa/view_siswa_edit');
        $this->load->view('backend/part/footer');
        // $data ini digunakan untuk mengirim nilai hasil dari pencarian melalui model $data['dtsiswa']
    }

    public function edit_proses()
    {
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Msiswa');

        // kita ambil nilai dulu yang ada didalam <form enctype="multipart/form-data" action="<?= base_url('siswa/tambah');
        $id_siswa = $this->input->post('txtid_siswa');
        $namafoto = $this->input->post('txtnamafoto');
        $nama = $this->input->post('txtnama');
        $alamat = $this->input->post('txtalamat');
        $tanggallahir = $this->input->post('txttanggallahir');

        // PEMANGGILAN NAMA DARI SUATU FOTO YANG AKAN DIAMBIL TIPE FILENYA
        //  $_FILES MEMANGGIL TXTFOTO DENGAN ATTRIBUT NAME
        $e = $_FILES['txtfoto']['name'];
        // membuat logika jika foto tidak diedit / dirubah / diganti
        if ($e == "") {
            // jika tidak diedit maka yang dieksekusi hanya dibawah inni

            // update data melalui model
            if ($this->Msiswa->siswa_edit_proses($id_siswa, $nama, $alamat, $tanggallahir)) {
                $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil Disimpan!</strong> Data ' . $nama . ' Sudah Tersimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                redirect('siswa');
            } else {
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal Simpan Data!</strong> Data ' . $nama . ' Belum Disimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                redirect('siswa');
            }
        } else {
            // EXPLODE DIGUNAKAN UNTUK MEMISAHKAN KALIMAT DARI SEBELUM TITIK . DAN SESUDAH TITIK .
            $x = explode(".", $e);
            // strtolower(end($x)) MENGAMBIL NILAI PALING AKHIR DARI VARIABEL X
            $ekstensi = strtolower(end($x));
            // MEMBUAT FILE FOTO siswa YANG NNTINYA DIMASUKKAN KE DAABASE
            $foto = date('YmdHis') . "." . $ekstensi;

            /* Location FOTO YANG AKAN DISIMPAN */
            $location = "upload/siswa/" . $foto;

            /* Valid Extensions TIPE FOTO YANG BISA DISIMPAN */
            $valid_extensions = array("jpg", "jpeg", "png");


            // MEMBERI LOGIKA IF (JIKA HASIL FOTO YANG DIUPLOAD TIDAK SAMA DENGAN EKSTENSI YANG DITENTUKAN MAKA AKAN ERROR)
            if (!in_array($ekstensi, $valid_extensions)) {
                // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN siswa
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Foto Salah!</strong> Kamu harus Upload foto dengan format JPG PNG JPEG.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                // REDIRECT BERPINDAH HALAMAN KE siswa
                redirect('siswa');
            } else {
                // sekarang proses untuk menghapus gambar yang ada di dalam directory
                unlink(realpath('upload/siswa/' . $namafoto));

                // LOGIKA IF [JIKA SISTEM SUDAH MEMINDAHKAN FOTO KEDALAM VARIABEL LOCATION DAN mengirimkan data yang ada di dalam kurung ini ($nama, $alamat, $tanggallahir, $foto)]
                if (move_uploaded_file($_FILES['txtfoto']['tmp_name'], $location) && $this->Msiswa->siswa_edit_prosesfoto($id_siswa, $nama, $alamat, $tanggallahir, $foto)) {
                    $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil Disimpan!</strong> Data ' . $nama . ' Sudah Tersimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('siswa');
                } else {
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal Simpan Data!</strong> Data ' . $nama . ' Belum Disimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('siswa');
                }
            }
        }
    }

    function hapus($id_siswa = 0, $foto = 0)
    {
        // melakukan logika terlebih dahulu untuk mengetahui $id_siswa sudah ada nilainya atau tidak
        if ($id_siswa == 0 or $foto == '0') {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN siswa
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ada yang Salah!</strong> gagal hapus data, URL tidak terdapat ID.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE siswa
            redirect('siswa');
        }
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Msiswa');

        if ($foto != 'foto') {
            // menghilangkan foto pada directory
            unlink(realpath('upload/siswa/' . $foto));
        }
        // LOGIKA IF [JIKA SISTEM SUDAH MEMINDAHKAN FOTO KEDALAM VARIABEL LOCATION DAN mengirimkan data yang ada di dalam kurung ini ($nama, $alamat, $tanggallahir, $foto)]
        if ($this->Msiswa->siswa_hapus($id_siswa)) {
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil Disimpan!</strong> Data Sudah Tersimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('siswa');
        } else {
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal Hapus Data!</strong> Data Belum Dihapus ID tidak ditemukan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('siswa');
        }
    }

}
