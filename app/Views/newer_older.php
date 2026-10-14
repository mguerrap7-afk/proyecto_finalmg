<?php $pager->setSurroundCount(0); ?>
<nav>
    <?php if ($pager->hasPreviousPage()): ?>
        <a class="btn btn-primary" href="<?= $pager->getPreviousPage() ?>"><?= lang('App.newer') ?></a>
    <?php endif; ?>
    <?php if ($pager->hasNextPage()): ?>
        <a class="btn btn-primary" href="<?= $pager->getNextPage() ?>"><?= lang('App.older') ?></a>
    <?php endif; ?>
</nav>
