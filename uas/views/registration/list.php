<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
    <div>
        <h1 class="page-title">Pendaftaran Tim</h1>
        <p class="page-desc">Atur tim yang terdaftar di setiap turnamen</p>
    </div>
</div>

<?php if ($msg = getFlashMessage('success')): ?>
    <div class="alert alert-success"><?= e($msg) ?></div>
<?php endif; ?>
<?php if ($msg = getFlashMessage('error')): ?>
    <div class="alert alert-error"><?= e($msg) ?></div>
<?php endif; ?>

<?php if (empty($data)): ?>
<div class="card">
    <div class="card-body">
        <div class="empty-state">
            <div class="empty-icon">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
            </div>
            <p class="text-muted">Belum ada turnamen</p>
            <a href="?page=tournament&action=create" class="btn btn-primary btn-sm mt-3">Buat Tournament</a>
        </div>
    </div>
</div>
<?php else: ?>
<div class="tournament-grid">
    <?php foreach ($data as $d): $t = $d['tournament']; $regs = $d['registrations']; ?>
    <div class="tournament-card" style="cursor:default;">
        <div class="tcard-header">
            <span class="tcard-name"><?= e($t['name']) ?></span>
            <?= statusBadge($t['status']) ?>
        </div>
        <div class="tcard-meta">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            <?= count($regs) ?> / <?= $t['max_teams'] ?> Tim
        </div>
        <div class="reg-team-list">
            <?php if (!empty($regs)): ?>
                <?php foreach ($regs as $r): ?>
                <span class="reg-team-tag"><?= e($r['team_name']) ?></span>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="tcard-desc">Belum ada tim terdaftar</p>
            <?php endif; ?>
        </div>
        <div class="tcard-footer">
            <a href="?page=registrations&action=manage&id=<?= $t['id'] ?>" class="btn btn-sm btn-primary">Atur Tim</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
