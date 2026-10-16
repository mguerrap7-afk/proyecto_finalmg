<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1><?= lang('App.forgotTitle') ?></h1>

    <form action="<?= site_url('forgot-password') ?>" method="post" style="max-width:600px">
        <div class="mb-3">
            <label class="form-label"><?= lang('App.email') ?></label>
            <input type="email" name="email" class="form-control" required value="<?= esc(old('email')) ?>">
        </div>
        <button type="submit" class="btn btn-success"><?= lang('App.send') ?></button>
        <a href="<?= site_url('login') ?>" class="btn btn-danger"><?= lang('App.cancel') ?></a>
    </form>
<?= $this->endSection() ?>