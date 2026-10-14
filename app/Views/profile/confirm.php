<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1><?= lang('App.enterPassword') ?></h1>

    <form action="<?= site_url('profile/confirm') ?>" method="post" style="max-width:600px">
        <div class="mb-3">
            <label class="form-label"><?= lang('App.password') ?></label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success"><?= lang('App.send') ?></button>
        <a href="<?= site_url('profile') ?>" class="btn btn-danger"><?= lang('App.cancel') ?></a>
    </form>
<?= $this->endSection() ?>