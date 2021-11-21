<div class="card-body">
    <div class="card shadow mb-4 border-bottom-primary" id="tagihanbulanan" value="0">
        <a href="#tagihantahunan" class="d-block bg-primary border border-primary card-header py-3"
            data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-white">Tagihan Pembayaran Tahunan</h6>
        </a>

        <div class="collapse show" id="tagihantahunan">

            <div class="table-responsive">
                <div class="card-body">
                    <table class="table table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Tahun Ajaran</th>
                                <th>Jenis Pembayaran</th>
                                <th>Total Bayar</th>
                                <!-- <th>Dibayar</th> -->
                                <th>Status Bayar</th>
                                <th>Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = 1;

                            foreach ($bayaran_tahunan as $u) {
                            ?>
                            <tr>
                                <td><?php echo $id++ ?></td>
                                <td><?php echo $u->tahun_ajaran ?></td>
                                <td style="font-weight: bold;"><?php echo $u->jenis_pembayaran ?></td>
                                <!-- <td><?php echo $u->besar_spp ?></td> -->
                                <td style="font-weight: bold;">
                                    <?php echo 'Rp. ' . number_format($u->total_tahunan, 0, ',', '.'); ?></td>

                                <!-- BATAS TAMBAHAN -->
                                <td
                                    style="font-weight: bold; <?= ($u->status_bayar == 'Lunas' ? 'color: green' : 'color: red') ?>">
                                    <?php echo $u->status_bayar ?></td>
                                <td>
                                    <?php
                                        if ($u->status_bayar != 'Lunas') {
                                            echo anchor('bayar_ditempat/bayar_Tahunan/' . $u->id_tahunan . '/' . $u->id_siswa, '<input type=submit class="btn btn-warning" value=\'bayar\'>');
                                        }
                                        echo anchor('bayar_ditempat/cetak_tahunan/' . $u->id_tahunan . '/' . $u->id_siswa, 'Cetak', array('title' => 'Cetak kartu Pembayaran SPP', 'class' => 'btn btn-info'));

                                        // echo anchor('bayar_ditempat/kwitansiTahunan/' . $u->nis . '/' . $u->id_siswa, 'Kwitansi', array('title' => 'Cetak Kwitansi Pembayaran', 'class' => 'btn btn-outline-info btn-sm'));
                                        ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>