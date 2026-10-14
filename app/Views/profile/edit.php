<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1><?= lang('App.editProfile') ?></h1>

    <form action="<?= site_url('profile/update') ?>" method="post" style="max-width:600px">
        <div class="mb-3">
            <label class="form-label"><?= lang('App.name') ?></label>
            <input type="text" name="name" class="form-control" required
                   value="<?= esc(old('name', $user['name'])) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label"><?= lang('App.email') ?></label>
            <input type="email" name="email" class="form-control" required
                   value="<?= esc(old('email', $user['email'])) ?>">
        </div>
        <button type="submit" class="btn btn-success"><?= lang('App.save') ?></button>
        <a href="<?= site_url('profile') ?>" class="btn btn-danger"><?= lang('App.cancel') ?></a>
    </form>
<?= $this->endSection() ?>