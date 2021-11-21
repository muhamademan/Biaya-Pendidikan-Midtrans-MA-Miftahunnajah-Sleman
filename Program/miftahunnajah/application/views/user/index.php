<div class="container-fluid">

    <?php
    $UserId = $user['id'];
    $QueryUser = "SELECT * FROM
                user u JOIN user_role ur
                ON u.role_id = ur.id
                WHERE u.id = '$UserId'";
    $DataUser = $this->db->query($QueryUser)->row_array();
    ?>

    <!-- <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div> -->

    <!-- <div class="row mb-6">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img m-2"
                                alt="...">
                        </div>
                        <div class="col-md-5 ml-5 mt-4">
                            <h5 class="card-title mb-3"><b><?= $user['name']; ?></b></h5>
                            <p class="card-text mb-3"><?= $user['email']; ?></p>
                            <p class="card-text mb-3"><?= $DataUser['role']; ?></p> -->
    <!-- <p class="card-text mb-1"><small class="text-muted"><i
                                        class="fas fa-circle text-success mr-1"></i><?= $user['is_active']; ?></small>
                            </p> -->
    <!-- <p class="card-text mt-4 mb-3"><a href="<?= base_url('pengaturan/changepassword') ?>"
                                    class="badge badge-dark"><i class="fa fa-lock text-light mx-1"></i>Ganti
                                    Password</a></p>
                            <a href="<?= base_url('user/edit'); ?>" class="btn btn-primary mb-0 shadow">Edit Profile</a> -->
    <!-- </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div> -->

    <div class="main-body shadow">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-0">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="Admin"
                                class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4><?= $user['name']; ?></h4>
                                <p class="text-secondary mb-1"><?= $DataUser['role']; ?></p>
                                <p class="text-muted font-size-sm"><?= $user['email']; ?></p>
                                <!-- <button class="btn btn-primary">Follow</button>
                                <button class="btn btn-outline-primary">Message</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nama Lengkap</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $user['name']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $user['email']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">No.Telpon</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $user['no_hp']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Mobile</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                (021) 380-4539
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Alamat</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                Madrasah Aliyah Miftahunnajah Sleman
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>