<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1><?= lang('App.user') ?></h1>
    <a href="<?= site_url('users') ?>">&laquo; <?= lang('App.backToIndex') ?></a>

    <dl class="mt-3">
        <dt><?= lang('App.name') ?></dt>
        <dd><?= esc($user['name']) ?></dd>
        <dt><?= lang('App.email') ?></dt>
        <dd><?= esc($user['email']) ?></dd>
        <dt><?= lang('App.active') ?></dt>
        <dd><?= $user['active'] ? lang('App.yes') : lang('App.no') ?></dd>
        <dt><?= lang('App.administrator') ?></dt>
        <dd><?= $user['is_admin'] ? lang('App.yes') : lang('App.no') ?></dd>
        <dt><?= lang('App.createdAt') ?></dt>
        <dd><?= esc($user['created_at']) ?></dd>
        <dt><?= lang('App.updatedAt') ?></dt>
        <dd><?= esc($user['updated_at']) ?></dd>
    </dl>

    <a href="<?= site_url('users/' . $user['id'] . '/edit') ?>" class="btn btn-primary"><?= lang('App.edit') ?></a>
    <form action="<?= site_url('users/' . $user['id'] . '/delete') ?>" method="post" class="d-inline"
          onsubmit="return confirm('<?= esc(lang('App.confirmDelete'), 'js') ?>');">
        <button type="submit" class="btn btn-danger"><?= lang('App.delete') ?></button>
    </form>
<?= $this->endSection() ?>
