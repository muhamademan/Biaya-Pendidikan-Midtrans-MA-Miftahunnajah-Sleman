<div class="container-fluid">
    <table class="table table-striped shadow" width="100%" cellspacing="0">
        <thead>
            <tr style="background-color: blue; color: white; text-align: center;">
                <!-- <th>NO</th> -->
                <th>Tahun Ajaran</th>
                <th>Jenis Pembayaran</th>
                <th>Total Pembayaran</th>
                <th>Keterangan</th>
            </tr>
        </thead>

        <!-- body tagihan pembayaran bulanan SPP -->
        <tbody style="text-align: center;">
            <?php
            $id = 1;

            foreach ($bayaran_spp as $u) {
            ?>
            <tr>
                <!-- <td><?php echo $id++ ?></td> -->
                <td><?php echo $u->tahun_ajaran ?></td>
                <td style="font-weight: bold;"><?php echo $u->jenis_pembayaran ?></td>
                <td style="font-weight: bold;">
                    <?php echo 'Rp. ' . number_format($u->total_spp, 0, ',', '.'); ?></td>
                <td style="font-weight: bold; <?= ($u->status_bayar == 'Lunas' ? 'color: green' : 'color: red') ?>">
                    <?php echo $u->status_bayar ?></td>
            </tr>
            <?php } ?>
        </tbody>

        <!-- body tagihan pembayaran tahunan -->
        <tbody style="text-align: center;">
            <?php
            $id = 1;
            foreach ($bayaran_th as $u) {
            ?>
            <tr>
                <!-- <td><?php echo $id++ ?></td> -->
                <td><?php echo $u->tahun_ajaran ?></td>
                <td style="font-weight: bold;"><?php echo $u->jenis_pembayaran ?></td>
                <!-- <td><?php echo $u->besar_tahunan ?></td> -->
                <td style="font-weight: bold;">
                    <?php echo 'Rp. ' . number_format($u->total_tahunan, 0, ',', '.'); ?></td>

                <!-- BATAS TAMBAHAN -->
                <td style="font-weight: bold; <?= ($u->status_bayar == 'Lunas' ? 'color: green' : 'color: red') ?>">
                    <?php echo $u->status_bayar ?></td>
            </tr>
            <?php } ?>
        </tbody>

        <!-- body tagihan pembayaran bangunan -->
        <tbody style="text-align: center;">
            <?php
            $id = 1;

            foreach ($bayaran_bangunan as $u) {
            ?>
            <tr>
                <!-- <td><?php echo $id++ ?></td> -->
                <td><?php echo $u->tahun_ajaran ?></td>
                <td style="font-weight: bold;"><?php echo $u->jenis_pembayaran ?></td>
                <!-- <td><?php echo $u->besar_spp ?></td> -->
                <td style="font-weight: bold;">
                    <?php echo 'Rp. ' . number_format($u->total_bangunan, 0, ',', '.'); ?></td>

                <!-- BATAS TAMBAHAN -->
                <td style="font-weight: bold; <?= ($u->status_bayar == 'Lunas' ? 'color: green' : 'color: red') ?>">
                    <?php echo $u->status_bayar ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Bagian cara pembayaran -->
    <div class="row mb-6">
        <div class="col-lg">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row no-gutters">
                        <div class="col-lg">
                            <tbody>
                                <?php foreach ($dtredaksi as $dt) { ?>
                                <tr>
                                    <td>
                                        <h3 style="color: red; text-align: center;"><b><?= $dt['judul']; ?></b></h3>
                                    </td>
                                </tr>
                                <hr>
                                <tr>
                                    <td><?= $dt['isi_redaksi'] ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>