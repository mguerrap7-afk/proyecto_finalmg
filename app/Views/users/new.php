<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1><?= lang('App.newUser') ?></h1>
    <a href="<?= site_url('users') ?>">&laquo; <?= lang('App.backToIndex') ?></a>

    <form action="<?= site_url('users/create') ?>" method="post" style="max-width:600px" class="mt-3">
        <div class="mb-3">
            <label class="form-label"><?= lang('App.name') ?></label>
            <input type="text" name="name" class="form-control" required value="<?= esc(old('name')) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label"><?= lang('App.email') ?></label>
            <input type="email" name="email" class="form-control" required value="<?= esc(old('email')) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label"><?= lang('App.password') ?></label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label"><?= lang('App.repeatPassword') ?></label>
            <input type="password" name="password_confirm" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success"><?= lang('App.save') ?></button>
        <a href="<?= site_url('users') ?>" class="btn btn-link"><?= lang('App.cancel') ?></a>
    </form>
<?= $this->endSection() ?>