<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0 shadow-lg">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center mb-4">
                                    <!-- <h1 class="h4 text-gray-900 mb-4">Halaman Login</h1> -->
                                    <td>
                                        <a href="<?= base_url(''); ?>">
                                            <img src="<?= base_url('assets/img/madrasah.png'); ?>" alt="" height="50"
                                                class="mr-3">
                                        </a>
                                    </td>
                                </div>
                                <?php $cek1 = $this->session->userdata('email'); ?>
                                <?= $this->session->flashdata('message'); ?>
                                <form class="user" method="post"
                                    action="<?= base_url("reset_pass_admin/updatePass"); ?>">
                                    <div class="form-group">
                                        <input type="text"
                                            class="form-control shadow text-primary form-control-user font-weight-bold"
                                            id="email" name="email" placeholder="<?= $cek1; ?>" value="<?= $cek1; ?>"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <input type="password"
                                            class="form-control shadow text-primary form-control-user font-weight-bold"
                                            id="password" name="password" placeholder="Masukan password baru">
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary btn-user btn-block shadow font-weight-bold">
                                        GANTI PASSWORD
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small font-weight-bold" href="<?= base_url('auth/logout'); ?>">Kembali
                                        Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>