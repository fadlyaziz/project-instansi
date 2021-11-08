
    <div class="container">
        <h1>Edit Data Guru</h1>

        <?php
        // memanggil nilai yang telah dikirim di file ini
        foreach ($dtguruid as $dg);
        ?>
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        <form enctype="multipart/form-data" action="<?= base_url('guru/edit_proses'); ?>" method="POST">
            <div class="form-group">
                <label for="txtnama">Nama</label>
                <!-- penting di masukkan script dibawah ini digunakan untuk penanda bahwa yang akan dirubah ini adalah id_guru sesuai yang dirubah -->
                <!-- type="hidden" difungsikan agar input text tersebut tidak kelihatan -->
                <input value="<?php echo $dg->id_guru; ?>" type="hidden" class="form-control" id="txtid_guru" name="txtid_guru" required>
                <input value="<?php echo $dg->nama; ?>" type="text" class="form-control" id="txtnama" name="txtnama" placeholder="Nama" required>
            </div>
            <div class="form-group">
                <label for="txtalamat">Alamat</label>
                <textarea class="form-control" id="txtalamat" name="txtalamat" required><?php echo $dg->alamat; ?></textarea>
            </div>
            <div class="form-group">
                <label for="txttanggallahir" class="col-form-label">TTL:</label>
                <input value="<?php echo $dg->tgl_lahir; ?>" type="date" class="form-control" id="txttanggallahir" name="txttanggallahir" required>
            </div>
            <div width="30%">
                <?php
                if ($dg->foto == "kosong") {
                    echo 'Tidak Ada Gmbar';
                } else {
                    // kita menambahkan fungsi base_url agar gambar bisa dipanggil
                    $lokasi = base_url('upload/guru/' . $dg->foto);
                    // MENCARI LOKASI DIMANA FOTO GURU DI SIMPAN DAN NAMA FOTO GURU SUDAH TERCANTUM DI DATABASE
                    echo '<img width="10%" src="' . $lokasi . '" alt="Avatar">';
                }
                ?>
            </div>
            <div class="form-group">
                <label for="txtfoto" class="col-form-label">Foto:</label><code class="highlighter-rouge"> *Size kurang dari 2mb</code>
                <input value="<?php echo $dg->foto; ?>" type="hidden" class="form-control" id="txtnamafoto" name="txtnamafoto" required>
                <input type="file" class="form-control" id="txtfoto" name="txtfoto">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
