<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1><?= lang('App.deleteImage') ?></h1>
    <p><?= lang('App.areYouSure') ?></p>

    <form action="<?= site_url('profile/image/delete') ?>" method="post" class="d-inline">
        <button type="submit" class="btn btn-success"><?= lang('App.save') ?></button>
    </form>
    <a href="<?= site_url('profile') ?>" class="btn btn-danger"><?= lang('App.cancel') ?></a>
<?= $this->endSection() ?>