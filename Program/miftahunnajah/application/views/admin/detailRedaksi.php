<div class="container-fluid">

    <!-- <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div> -->

    <div class="row mb-6">
        <div class="col-lg">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row no-gutters">
                        <div class="col-lg">
                            <tbody>
                                <h5 class="card-title" style="text-align: center; color: red; font-weight: bold;">JUDUL
                                    REDAKSI</h5>
                                <tr>
                                    <td><b><?= $dtredaksi['judul']; ?></b></td>
                                </tr>
                                <hr>
                                <h5 class="card-title" style="text-align: center; color: red; font-weight: bold;">ISI
                                    REDAKSI</h5>
                                <tr>
                                    <td><?= $dtredaksi['isi_redaksi'] ?></td>
                                </tr>
                            </tbody>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>