<!--Proses Pendaftaran-->

<?php

if (isset($_POST['daftar'])) {

    session_start();

    if ($_SESSION['captcha'] == $_POST['kode']) {
        //isi dengan kode pendaftaran ke database mysql teman-teman
        echo "Pendaftaran Berhasil";
    } else {
        echo "Opsss! Kode captcha salah.";
    }
}
?>

<!--Akhir Proses Pendaftaran-->

<body style="background-image:url(assets/img/bg1.jpg);background-size:cover;">
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
                                                <img src="<?= base_url('assets/img/madrasah.png'); ?>" alt=""
                                                    height="50" class="mr-3">
                                            </a>
                                        </td>
                                    </div>

                                    <?= $this->session->flashdata('message'); ?>

                                    <form class="user" method="POST" action="<?= base_url('auth'); ?>">
                                        <div class="form-group">
                                            <input type="email"
                                                class="form-control shadow form-control-user font-weight-bold text-primary"
                                                id="email" name="email" placeholder="Masukan email"
                                                value="<?= set_value('email'); ?>">
                                            <?= form_error('email', '<small class="text-danger font-weight-bold pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password"
                                                class="form-control shadow form-control-user font-weight-bold text-primary"
                                                id="password" name="password" placeholder="Password">
                                            <?= form_error('password', '<small class="text-danger font-weight-bold pl-3">', '</small>'); ?>
                                        </div>

                                        <!-- captcha -->
                                        <!-- <div class="form-group">
                                            <img src="generate.php?date=<?php echo date('YmdHis'); ?>" alt="">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="kode"
                                                placeholder="kode captcha" required>
                                        </div> -->





                                        <button type="submit"
                                            class="btn btn-primary shadow btn-user btn-block font-weight-bold text-capitalize">
                                            LOGIN ADMIN
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small text-primary font-weight-bold"
                                            href="<?= base_url('auth/lupa_password'); ?>">Lupa
                                            Password?</a>
                                    </div>
                                    <!-- <div class="text-center">
                                    <a class="small font-weight-bold" href="<?= base_url('auth/registrasi'); ?>">Buat
                                        akun baru!</a>
                                </div> -->
                                    <div class="text-center">
                                        <a class="small font-weight-bold"
                                            href="<?= base_url('auth/login_siswa'); ?>">Login <b>SISWA</b></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>