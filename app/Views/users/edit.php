<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1><?= lang('App.editUser') ?></h1>

    <form action="<?= site_url('users/' . $user['id'] . '/update') ?>" method="post" style="max-width:600px">
        <div class="mb-3">
            <label class="form-label"><?= lang('App.name') ?></label>
            <input type="text" name="name" class="form-control" required value="<?= esc(old('name', $user['name'])) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label"><?= lang('App.email') ?></label>
            <input type="email" name="email" class="form-control" required value="<?= esc(old('email', $user['email'])) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label"><?= lang('App.password') ?></label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label"><?= lang('App.repeatPassword') ?></label>
            <input type="password" name="password_confirm" class="form-control">
        </div>
        <div class="form-check">
            <input type="checkbox" name="active" value="1" class="form-check-input" id="active" <?= $user['active'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="active"><?= lang('App.active') ?></label>
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" name="is_admin" value="1" class="form-check-input" id="is_admin" <?= $user['is_admin'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="is_admin"><?= lang('App.administrator') ?></label>
        </div>
        <button type="submit" class="btn btn-success"><?= lang('App.save') ?></button>
        <a href="<?= site_url('users') ?>" class="btn btn-link"><?= lang('App.cancel') ?></a>
    </form>
<?= $this->endSection() ?>