
    <div class="container">
        <h1>Guru 5 Terbaru</h1>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Tanggal Lahir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // membuat fariabel $no untuk membuat nomer otomatis
                $no = 0;

                // membuat logika if pada variabel $dtguru jika datanya 0 maka akan terbilang data kosong
                if ($dtguru != 0) {

                    // membuat nilai $dtguru menjadi array dengan alias $dg
                    foreach ($dtguru as $dg) {
                        // ini akan menambahkan kondisi dari variabel $no
                        $no++;
                ?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $dg->nama; ?></td>
                            <td><?= $dg->alamat; ?></td>
                            <td><?= $dg->tgl_lahir; ?></td>
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

        <h1>Siswa 5 Terbaru</h1>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                if ($dtsiswa != 0) {
                    foreach ($dtsiswa as $ds) {
                        $no++;
                ?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $ds->nama; ?></td>
                            <td><?= $ds->alamat; ?></td>
                            <td><?= $ds->tgl_lahir; ?></td>
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