<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1><?= lang('App.login') ?></h1>

    <form action="<?= site_url('login') ?>" method="post" style="max-width:600px">
        <div class="mb-3">
            <label class="form-label"><?= lang('App.email') ?></label>
            <input type="email" name="email" class="form-control" value="<?= esc(old('email')) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label"><?= lang('App.password') ?></label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" name="remember" value="1" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember"><?= lang('App.rememberMe') ?></label>
        </div>
        <button type="submit" class="btn btn-success"><?= lang('App.login') ?></button>
        <a href="#" class="ms-2"><?= lang('App.forgotPassword') ?></a>
    </form>
<?= $this->endSection() ?>