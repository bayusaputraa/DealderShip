<?= $this->extend('auth/tamplate'); ?>

<?= $this->Section('content'); ?>

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4"><?=lang('Auth.forgotPassword')?></h3>
                    </div>
                    <div class="card-body">
                        <!-- Alert Error Register -->
                        <?= view('Myth\Auth\Views\_message_block') ?>
                        <p><?= lang('Auth.enterCodeEmailPassword') ?></p>

                        <form action="<?= url_to('reset-password') ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" id="inputFirstName" type="email" name="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" />
                                        <label for="inputFirstName"><?= lang('Auth.email') ?></label>
                                    </div>
                                </div>
                                <!-- Token -->
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input type="text" class="form-control <?php if (session('errors.token')) : ?>is-invalid<?php endif ?>" name="token" placeholder="<?= lang('Auth.token') ?>" value="<?= old('token', $token ?? '') ?>">
                                        <label for="token"><?= lang('Auth.token') ?></label>
                                        <div class="invalid-feedback">
                                            <?= session('errors.token') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Default -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password">
                                        <label for="password"><?= lang('Auth.newPassword') ?></label>

                                    </div>
                                </div>
                                <!-- Reapet -->
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm">
                                        <label for="pass_confirm"><?= lang('Auth.newPasswordRepeat') ?></label>

                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-block">Reset Account</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="<?= base_url('login') ?>">Ayo login!</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection('content'); ?>