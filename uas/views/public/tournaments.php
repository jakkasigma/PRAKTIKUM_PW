<?php include __DIR__ . '/../layouts/public_header.php'; ?>

<div class="page-header">
    <div>
        <h1 class="page-title" style="font-size:1.5rem;">Live Tournaments</h1>
        <p class="page-desc">Lihat perkembangan turnamen secara real-time</p>
    </div>
</div>

<?php if (empty($tournaments)): ?>
    <div class="card" style="border-color:#1e293b;">
        <div class="card-body">
            <div class="empty-state" style="padding:2rem 0;">
                <div class="empty-icon" style="font-size:2.5rem;">🏆</div>
                <p class="text-muted">Belum ada turnamen yang sedang berlangsung</p>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="public-tournament-list">
    <?php foreach ($tournaments as $t): ?>
        <div class="card" style="border-color:#1e293b;">
            <div class="card-body public-tournament-card">
                <div class="public-tournament-info">
                    <h3 class="public-tournament-name"><?= e($t['name']) ?></h3>
                    <?php if ($t['description']): ?>
                    <p class="public-tournament-desc"><?= e(substr($t['description'], 0, 100)) ?><?= strlen($t['description']) > 100 ? '...' : '' ?></p>
                    <?php endif; ?>
                    <div class="public-tournament-meta">
                        <?= statusBadge($t['status']) ?>
                        <span class="public-tournament-teams">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            <?= (int)$t['team_count'] ?> tim
                        </span>
                    </div>
                </div>
                <a href="?page=public&action=bracket&id=<?= $t['id'] ?>" class="btn btn-primary">Lihat Bracket</a>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="public-footer-link">
    <a href="?page=login">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        Admin Login
    </a>
</div>

<?php include __DIR__ . '/../layouts/public_footer.php'; ?>
