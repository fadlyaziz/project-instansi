
    <div class="container">
        <h1>Edit Data kelas</h1>

        <?php
        // memanggil nilai yang telah dikirim di file ini
        foreach ($dtkelasid as $dg);
        ?>
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        <form enctype="multipart/form-data" action="<?= base_url('kelas/edit_proses'); ?>" method="POST">
            <div class="form-group">
                <label for="txtnama">Nama</label>
                <!-- penting di masukkan script dibawah ini digunakan untuk penanda bahwa yang akan dirubah ini adalah id_kelas sesuai yang dirubah -->
                <!-- type="hidden" difungsikan agar input text tersebut tidak kelihatan -->
                <input value="<?php echo $dg->id_kelas; ?>" type="hidden" class="form-control" id="txtid_kelas" name="txtid_kelas" required>
                <input value="<?php echo $dg->kelas; ?>" type="text" class="form-control" id="txtnama" name="txtnama" placeholder="Nama" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
