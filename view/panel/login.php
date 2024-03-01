<?php include 'header.php' ?>

<body>

<!-- auth-page wrapper -->
<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay"></div>
    <!-- auth-page content -->
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-hidden border-0">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4 auth-one-bg h-100">
                                    <div class="bg-overlay"></div>
                                    <div class="position-relative h-100 d-flex flex-column">
                                        <div class="mb-4">
                                            <a href="index-2.html" class="d-block">
                                                <img src="view/panel/assets/images/logo-light.png" alt="" height="18">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-lg-6 d-block" id="login">
                                <div class="toast-container position-absolute p-3 top-0 start-50 translate-middle-x" id="danger" style="display: none" data-original-class="toast-container position-absolute p-3">
                                    <div class="toast fade show">
                                        <div class="toast-header">
                                            <strong class="me-auto">Hata</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                        </div>
                                        <div class="toast-body">
                                            <div class="alert alert-danger mb-xl-0" role="alert">
                                                <strong> Kullanıcı Adı veya Şifre Hatalı!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-lg-5 p-4">
                                    <div>
                                        <h5 class="text-primary">Hoş geldiniz...</h5>
                                        <p class="text-muted">xxx'ya giriş yapın</p>
                                    </div>

                                    <div class="mt-4">


                                            <div class="mb-3">
                                                <label for="username" class="form-label">Kullanıcı Adı</label>
                                                <input type="text" class="form-control" id="kullaniciadi" name="kullaniciadi" placeholder="Kullanıcı Adı">
                                            </div>

                                            <div class="mb-3">
                                                <div class="float-end">
                                                    <a href="auth-pass-reset-cover.html" class="text-muted">Şifremi unuttum</a>
                                                </div>
                                                <label class="form-label" for="password-input">Şifre</label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" class="form-control pe-5 password-input" placeholder="Şifre" id="sifre" name="sifre">
                                                    <input type="hidden" name="token" id="token"  value="<?=setFormTokenSession()?>">
                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                </div>
                                            </div>

                                           <!-- <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                                <label class="form-check-label" for="auth-remember-check">Beni Hatırla</label>
                                            </div>-->

                                            <div class="mt-4">
                                                <button class="btn btn-success w-100" onclick="login()" type="submit">Giriş Yap</button>
                                            </div>

                                    </div>

                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->

    <!-- end Footer -->
</div>
<!-- end auth-page-wrapper -->
<?php include 'footer.php' ?>
