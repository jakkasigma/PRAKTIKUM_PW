<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
    <div>
        <h1 class="page-title">Tournaments</h1>
        <p class="page-desc">Kelola data turnamen</p>
    </div>
    <a href="?page=tournament&action=create" class="btn btn-primary">+ Add Tournament</a>
</div>

<?php if ($msg = getFlashMessage('success')): ?>
    <div class="alert alert-success"><?= e($msg) ?></div>
<?php endif; ?>
<?php if ($msg = getFlashMessage('error')): ?>
    <div class="alert alert-error"><?= e($msg) ?></div>
<?php endif; ?>

<?php if (empty($tournaments)): ?>
<div class="card">
    <div class="card-body">
        <div class="empty-state">
            <div class="empty-icon">🏆</div>
            <p class="text-muted">Belum ada tournament</p>
        </div>
    </div>
</div>
<?php else: ?>
<div class="tournament-grid">
    <?php foreach ($tournaments as $t): ?>
    <a href="?page=tournament&action=detail&id=<?= $t['id'] ?>" class="tournament-card">
        <div class="tcard-header">
            <span class="tcard-name"><?= e($t['name']) ?></span>
            <?= statusBadge($t['status']) ?>
        </div>
        <?php if ($t['description']): ?>
        <p class="tcard-desc"><?= e(strlen($t['description']) > 80 ? substr($t['description'], 0, 80) . '...' : $t['description']) ?></p>
        <?php endif; ?>
        <div class="tcard-meta">
            <span>📅 <?= formatDate($t['start_date']) ?></span>
            <span>👥 <?= $t['team_count'] ?> / <?= $t['max_teams'] ?? '?' ?> Tim</span>
        </div>
    </a>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
