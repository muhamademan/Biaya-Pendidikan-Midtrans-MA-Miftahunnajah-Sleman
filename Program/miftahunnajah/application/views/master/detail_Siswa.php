<div class="card-body">
    <div class="card shadow mb-4 border-bottom-secondary" id="infosiswa" value="0">
        <!-- Card Header - Accordion -->
        <a href="#informasisantri" class="d-block bg-secondary border border-secondary card-header py-3"
            data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-white">Data Siswa</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="informasisantri">
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <?php foreach ($dtsiswa as $u) { ?>
                        <tr>
                            <td>No. Induk Siswa </td>
                            <td>: <?php echo $u->nis ?></td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>: <span><?php echo $u->nama ?></span></td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>: <span><?php echo $u->tgl_lahir ?></span></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>: <?php echo $u->jenis_kelamin ?></td>
                        </tr>
                        <tr>
                            <td>Email Siswa</td>
                            <td>: <span><?php echo $u->email ?></span></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: <?php echo $u->alamat ?></td>
                        </tr>
                        <tr>
                            <td>Nama Wali</td>
                            <td>: <?php echo $u->nama_wali ?></td>
                        </tr>
                        <tr>
                            <td>No.telp</td>
                            <td>: <?php echo $u->no_hp ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>