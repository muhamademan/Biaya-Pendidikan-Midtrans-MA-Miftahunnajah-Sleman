    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5 col-lg-5 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center mb-3">
                                <!-- <h1 class="h4 text-gray-900 mb-4">Halaman Registrasi</h1> -->
                                <td>
                                    <a href="<?= base_url(''); ?>">
                                        <img src="<?= base_url('assets/img/madrasah.png'); ?>" alt="" height="50"
                                            class="mr-3">
                                    </a>
                                </td>
                            </div>
                            <form class="user" method="POST" action="<?= base_url('auth/registrasi'); ?>">
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-user text-primary font-weight-bold" id="name"
                                        name="name" placeholder="Nama Lengkap" value="<?= set_value('name'); ?>">
                                    <?= form_error('name', '<small class="text-danger font-weight-bold pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="email"
                                        class="form-control form-control-user text-primary font-weight-bold" id="email"
                                        name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                                    <?= form_error('email', '<small class="text-danger font-weight-bold pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="no_hp"
                                        class="form-control form-control-user text-primary font-weight-bold" id="no_hp"
                                        name="no_hp" placeholder="No.Telepon" value="<?= set_value('no_hp'); ?>">
                                    <?= form_error('no_hp', '<small class="text-danger font-weight-bold pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password"
                                            class="form-control form-control-user text-primary font-weight-bold"
                                            id="password1" name="password1" placeholder="Password">
                                        <?= form_error('password1', '<small class="text-danger font-weight-bold pl-3>', '</small>'); ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password"
                                            class="form-control form-control-user text-primary font-weight-bold"
                                            id="password2" name="password2" placeholder="Ulangi Password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block font-weight-bold">
                                    REGISTRASI
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small font-weight-bold" href="<?= base_url('auth'); ?>">Kembali Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>