<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1><?= lang('App.task') ?></h1>
    <a href="<?= site_url('tasks') ?>">&laquo; <?= lang('App.backToIndex') ?></a>

    <dl class="mt-3">
        <dt>ID</dt>
        <dd><?= esc($task['id']) ?></dd>
        <dt><?= lang('App.description') ?></dt>
        <dd><?= esc($task['description']) ?></dd>
        <dt><?= lang('App.createdAt') ?></dt>
        <dd><?= esc($task['created_at']) ?></dd>
        <dt><?= lang('App.updatedAt') ?></dt>
        <dd><?= esc($task['updated_at']) ?></dd>
    </dl>

    <a href="<?= site_url('tasks/' . $task['id'] . '/edit') ?>" class="btn btn-primary"><?= lang('App.edit') ?></a>
    <form action="<?= site_url('tasks/' . $task['id'] . '/delete') ?>" method="post" class="d-inline"
          onsubmit="return confirm('<?= esc(lang('App.confirmDelete'), 'js') ?>');">
        <button type="submit" class="btn btn-danger"><?= lang('App.delete') ?></button>
    </form>
<?= $this->endSection() ?>