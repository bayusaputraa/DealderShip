<?= $this->extend('auth/tamplate') ?>

<?= $this->Section('content') ?>

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Login</h3>
                    </div>
                    <div class="card-body">

                        <!-- alert, massage -->
                        <?= view('Myth\Auth\Views\_message_block') ?>

                        <form action="<?= url_to('login') ?>" method="post">
                            <?= csrf_field() ?>

                            <?php if ($config->validFields === ['email']) : ?>
                                <div class="form-group">
                                    <label for="login"><?= lang('Auth.email') ?></label>
                                    <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">

                                    <div class="invalid-feedback">
                                        <?= session('errors.login') ?>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="form-group">
                                    <label for="login"><?= lang('Auth.emailOrUsername') ?></label>
                                    <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">

                                    <div class="invalid-feedback">
                                        <?= session('errors.login') ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="password"><?= lang('Auth.password') ?></label>
                                <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">

                                <div class="invalid-feedback">
                                    <?= session('errors.password') ?>
                                </div>

                            </div>

                            <?php if ($config->allowRemembering) : ?>
                            <div class="form-check mb-3">
                                <input class="form-check-input <?php if (old('remember')) : ?> checked <?php endif ?>"  id="inputRememberPassword" type="checkbox" name="remeber"  />
                                <label class="form-check-label" for="inputRememberPassword"><?= lang('Auth.rememberMe') ?></label>
                            </div>
                            <?php endif; ?>
                            
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="<?= url_to('forgot') ?>">Reset Password</a>
                                <button type="submint" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="<?= url_to('register') ?>">Registrasi Akun</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection('content') ?>