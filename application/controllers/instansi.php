<?php
defined('BASEPATH') or exit('No direct script access allowed');

class instansi extends CI_Controller
{
    public function index()
    {
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Minstansi');

        //memanggil database melalui model dengan tidak membawa nilai apapun ke modelnya
        $data['dtinstansi'] = $this->Minstansi->instansi();
        // membuat variabel active untuk membedakan menu
        $data['minstansitampil'] = true;
        $data['title'] = "instansi";
        //setelah itu model akan mengirimkan data sesuai permintaan yang akan diteruskan melalui view perhatikan parameter array yang ada di $data['dtguru] $data['dtsiswa]

        //untuk penamaan view_home bebas asalkan sama pada file yang ada di folder views
        $this->load->view('backend/part/header', $data);
        $this->load->view('backend/page/instansi/view_instansi_tampil');
        $this->load->view('backend/part/footer');
    }

    public function tambah()
    {
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Minstansi');

        // kita ambil nilai dulu yang ada didalam <form enctype="multipart/form-data" action="<?= base_url('guru/tambah');
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
        // MEMBUAT FILE FOTO GURU YANG NNTINYA DIMASUKKAN KE DAABASE
        $foto = date('YmdHis') . "." . $ekstensi;

        /* Location FOTO YANG AKAN DISIMPAN */
        $location = "upload/instansi/" . $foto;

        /* Valid Extensions TIPE FOTO YANG BISA DISIMPAN */
        $valid_extensions = array("jpg", "jpeg", "png");

        // MEMBERI LOGIKA IF (JIKA HASIL FOTO YANG DIUPLOAD TIDAK SAMA DENGAN EKSTENSI YANG DITENTUKAN MAKA AKAN ERROR)
        if (!in_array($ekstensi, $valid_extensions)) {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN GURU
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Foto Salah!</strong> Kamu harus Upload foto dengan format JPG PNG JPEG.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE GURU
            redirect('instansi');
        } else {
            // LOGIKA IF [JIKA SISTEM SUDAH MEMINDAHKAN FOTO KEDALAM VARIABEL LOCATION DAN mengirimkan data yang ada di dalam kurung ini ($nama, $alamat, $tanggallahir, $foto)]
            if (move_uploaded_file($_FILES['txtfoto']['tmp_name'], $location) && $this->Minstansi->instansi_tambah($nama, $alamat, $tanggallahir, $foto)) {
                $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil Disimpan!</strong> Data '.$nama.' Sudah Tersimpan.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('instansi');
            } else {
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal Simpan Data!</strong> Data ' . $nama . ' Belum Disimpan.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('instansi');
            }
        }
    }

    // pada function kali ini berbeda dari yang diatas, dikarenakan ada parameter didalamnya function yaitu $id_guru
    // APA ITU PARAMETER ADALAH SEBUAH PERINTAH UNTUK MENYIMPAN NILAI YANG DISIMPAN DI VARIABEL seperti contoh dibawah ini kita menggunakan variabel $id_guru
    // $id_guru=0  YANG DIMAKSUD PADA VARIABEL INI ADALAH UNTUK MELIHAT JIKA PADA PERINTAH TIDAK ADA NILAINYA MAKA NILAI 0 INILAH YANG AKANN  DIGUNAKAN
    public function edit($id_instansi=0)
    {
        // melakukan logika terlebih dahulu untuk mengetahui $id_guru sudah ada nilainya atau tidak
        if ($id_instansi==0) {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN GURU
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ada yang Salah!</strong> URL tidak terdapat ID.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE GURU
            redirect('instansi');        
        }

        // kita panggil dulu nama model yang kita buat
        $this->load->model('Minstansi');

        //memanggil database melalui model dengan  membawa nilai $id_guru  ke modelnya
        $data['dtinstansiid'] = $this->Minstansi->instansi_edit($id_instansi);

        // melakukan logika terlebih dahulu untuk mengetahui hasil dari model guru_edit sudah ada nilainya atau tidak
        if ($data['dtinstansiid']==0) {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN GURU
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ID Tidak Terdapat diDatabase!</strong> Silahkan Ulangi lagi.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE GURU
            redirect('instansi');
        }

        // membuat variabel active untuk membedakan menu
        $data['minstansitampil'] = true;
        $data['title'] = "Edit instansi";

        //untuk penamaan view_guru bebas asalkan sama pada file yang ada di folder views
        $this->load->view('backend/part/header', $data);
        $this->load->view('backend/page/instansi/view_instansi_edit');
        $this->load->view('backend/part/footer');
        // $data ini digunakan untuk mengirim nilai hasil dari pencarian melalui model $data['dtguru']
    }


    public function edit_proses()
    {
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Minstansi');

        // kita ambil nilai dulu yang ada didalam <form enctype="multipart/form-data" action="<?= base_url('guru/tambah');
        $id_instansi = $this->input->post('txtid_instansi');
        $namafoto = $this->input->post('txtnamafoto');
        $nama = $this->input->post('txtnama');
        $alamat = $this->input->post('txtalamat');
        $tanggallahir = $this->input->post('txttanggallahir');

        // PEMANGGILAN NAMA DARI SUATU FOTO YANG AKAN DIAMBIL TIPE FILENYA
        //  $_FILES MEMANGGIL TXTFOTO DENGAN ATTRIBUT NAME
        $e = $_FILES['txtfoto']['name'];
        // membuat logika jika foto tidak diedit / dirubah / diganti
        if ($e=="") {
            // jika tidak diedit maka yang dieksekusi hanya dibawah inni

            // update data melalui model
            if ($this->Minstansi->instansi_edit_proses($id_instansi, $nama, $alamat, $tanggallahir)) {
                $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil Disimpan!</strong> Data ' . $nama . ' Sudah Tersimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                redirect('instansi');
            } else {
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal Simpan Data!</strong> Data ' . $nama . ' Belum Disimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                redirect('instansi');
            }
        }else{
            // EXPLODE DIGUNAKAN UNTUK MEMISAHKAN KALIMAT DARI SEBELUM TITIK . DAN SESUDAH TITIK .
            $x = explode(".", $e);
            // strtolower(end($x)) MENGAMBIL NILAI PALING AKHIR DARI VARIABEL X
            $ekstensi = strtolower(end($x));
            // MEMBUAT FILE FOTO GURU YANG NNTINYA DIMASUKKAN KE DAABASE
            $foto = date('YmdHis') . "." . $ekstensi;

            /* Location FOTO YANG AKAN DISIMPAN */
            $location = "upload/instansi/" . $foto;

            /* Valid Extensions TIPE FOTO YANG BISA DISIMPAN */
            $valid_extensions = array("jpg", "jpeg", "png");


            // MEMBERI LOGIKA IF (JIKA HASIL FOTO YANG DIUPLOAD TIDAK SAMA DENGAN EKSTENSI YANG DITENTUKAN MAKA AKAN ERROR)
            if (!in_array($ekstensi, $valid_extensions)) {
                // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN GURU
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Foto Salah!</strong> Kamu harus Upload foto dengan format JPG PNG JPEG.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                // REDIRECT BERPINDAH HALAMAN KE GURU
                redirect('instansi');
            } else {
                // sekarang proses untuk menghapus gambar yang ada di dalam directory
                unlink(realpath('upload/instansi/' . $namafoto));                

                // LOGIKA IF [JIKA SISTEM SUDAH MEMINDAHKAN FOTO KEDALAM VARIABEL LOCATION DAN mengirimkan data yang ada di dalam kurung ini ($nama, $alamat, $tanggallahir, $foto)]
                if (move_uploaded_file($_FILES['txtfoto']['tmp_name'], $location) && $this->Minstansi->instansi_edit_prosesfoto($id_instansi, $nama, $alamat, $tanggallahir, $foto)) {
                    $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil Disimpan!</strong> Data ' . $nama . ' Sudah Tersimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('instansi');
                } else {
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal Simpan Data!</strong> Data ' . $nama . ' Belum Disimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('instansi');
                }
            }
        }
    }

    function hapus($id_instansi = 0, $foto = 0)
    {
        // melakukan logika terlebih dahulu untuk mengetahui $id_guru sudah ada nilainya atau tidak
        if ($id_instansi == 0 or $foto == '0') {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN GURU
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ada yang Salah!</strong> gagal hapus data, URL tidak terdapat ID.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE GURU
            redirect('instansi');
        }
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Minstansi');

        if ($foto != 'foto') {
            // menghilangkan foto pada directory
            unlink(realpath('upload/instansi/' . $foto));
        }
        // LOGIKA IF [JIKA SISTEM SUDAH MEMINDAHKAN FOTO KEDALAM VARIABEL LOCATION DAN mengirimkan data yang ada di dalam kurung ini ($nama, $alamat, $tanggallahir, $foto)]
        if ($this->Minstansi->instansi_hapus($id_instansi)) {
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil Disimpan!</strong> Data Sudah Tersimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('instansi');
        } else {
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal Hapus Data!</strong> Data Belum Dihapus ID tidak ditemukan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('instansi');
        }
    }

}
