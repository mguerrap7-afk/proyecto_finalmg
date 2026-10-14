<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1><?= lang('App.tasks') ?></h1>

    <a href="<?= site_url('tasks/new') ?>" class="btn btn-primary mb-3"><?= lang('App.newTask') ?></a>

    <form method="get" action="<?= site_url('tasks') ?>" class="mb-3" style="max-width:400px">
        <label class="form-label"><?= lang('App.search') ?></label>
        <input type="text" name="q" class="form-control" value="<?= esc($search) ?>">
    </form>

    <ul class="list-group mb-3">
        <?php foreach ($tasks as $t): ?>
            <li class="list-group-item">
                <a href="<?= site_url('tasks/' . $t['id']) ?>"><?= esc($t['description']) ?></a>
            </li>
        <?php endforeach; ?>
        <?php if (empty($tasks)): ?>
            <li class="list-group-item text-muted"><?= lang('App.noTasks') ?></li>
        <?php endif; ?>
    </ul>

    <?= $pager->links('default', 'newer_older') ?>
<?= $this->endSection() ?>

