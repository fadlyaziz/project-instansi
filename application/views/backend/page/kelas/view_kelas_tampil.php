
    <div class="container">
        <h1>Data Keseluruhan kelas</h1>

        <button type="button" class="btn btn-success m-1" data-toggle="modal" data-target="#modal_kelas" data-whatever="@mdo">Tambah Kelas</button>

        <?php
        // digunakan untuk menampilkan notifikasi setelah dieksekusi
        $data = $this->session->flashdata('notif');
        if (isset($data)) {
            echo $this->session->flashdata('notif');
        } ?>
        <div class="modal fade" id="modal_kelas" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah kelas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- untuk menambahkan foto atau menyimpan foto kita wajib menggunakan enctype="multipart/form-data" -->
                    <form action="<?= base_url('kelas/tambah'); ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="txtnama" class="col-form-label">Nama Kelas:</label>
                                <input type="text" class="form-control" id="txtnama" name="txtnama" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">nama</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // membuat fariabel $no untuk membuat nomer otomatis
                $no = 0;

                // membuat logika if pada variabel $dtkelas jika datanya 0 maka akan terbilang data kosong
                if ($dtkelas != 0) {

                    // membuat nilai $dtkelas menjadi array dengan alias $dg
                    foreach ($dtkelas as $dg) {
                        // ini akan menambahkan kondisi dari variabel $no
                        $no++;
                ?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $dg->kelas; ?></td>
                            <td>
                                <a href="<?php echo base_url('kelas/edit/' . $dg->id_kelas); ?>" class="btn btn-primary">Edit</a>
                                <a href="#" onclick="btn_hapus('<?php echo $dg->id_kelas; ?>','<?php echo $dg->kelas; ?>')" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <th colspan="4">Data Kosong</th>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script>
        function btn_hapus(id_kelas, kelas) {

            swal({
                    title: "Data " + kelas + " akan dihapus?",
                    text: "data akan hilang di database",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "<?php echo base_url('kelas/hapus/'); ?>" + id_kelas;
                    }
                });
        }
    </script>
