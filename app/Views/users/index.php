index.php

<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1><?= lang('App.users') ?></h1>
    <a href="<?= site_url('users/new') ?>" class="btn btn-primary mb-3"><?= lang('App.newUser') ?></a>

    <div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?= lang('App.name') ?></th>
                <th><?= lang('App.email') ?></th>
                <th><?= lang('App.active') ?></th>
                <th><?= lang('App.administrator') ?></th>
                <th><?= lang('App.createdAt') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $u): ?>
            <tr>
                <td><a href="<?= site_url('users/' . $u['id']) ?>"><?= esc($u['name']) ?></a></td>
                <td><?= esc($u['email']) ?></td>
                <td><?= $u['active'] ? lang('App.yes') : lang('App.no') ?></td>
                <td><?= $u['is_admin'] ? lang('App.yes') : lang('App.no') ?></td>
                <td><?= esc($u['created_at']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>

    <?= $pager->links('default', 'newer_older') ?>
<?= $this->endSection() ?>
