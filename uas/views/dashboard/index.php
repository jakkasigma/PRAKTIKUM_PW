<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="dash-welcome card-accent">
    <div class="dash-welcome-inner">
        <div class="dash-welcome-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
        </div>
        <div>
            <h2 class="dash-welcome-title">Selamat datang, <?= e($_SESSION['username'] ?? 'Admin') ?>!</h2>
            <p class="dash-welcome-sub">Panel administrasi Tournament Bracket Management System.</p>
        </div>
    </div>
</div>

<?php if ($msg = getFlashMessage('success')): ?>
    <div class="alert alert-success"><?= e($msg) ?></div>
<?php endif; ?>
<?php if ($msg = getFlashMessage('error')): ?>
    <div class="alert alert-error"><?= e($msg) ?></div>
<?php endif; ?>

<div class="stat-cards">
    <div class="stat-card">
        <div class="stat-card-icon" style="color:#818cf8;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
        </div>
        <div class="stat-label">Tournaments</div>
        <div class="stat-value"><?= $tournament_count ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon" style="color:#34d399;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <div class="stat-label">Teams</div>
        <div class="stat-value"><?= $team_count ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon" style="color:#fbbf24;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <div class="stat-label">Players</div>
        <div class="stat-value"><?= $player_count ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon" style="color:#f472b6;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="12" x2="2" y2="12"/><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>
        </div>
        <div class="stat-label">Matches Done</div>
        <div class="stat-value"><?= $match_count ?></div>
    </div>
</div>

<div class="dash-actions">
    <a href="?page=tournament&action=create" class="dash-action-btn">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
        Buat Tournament
    </a>
    <a href="?page=registrations" class="dash-action-btn">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><polyline points="17 11 19 13 23 9"/></svg>
        Registrasi Tim
    </a>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-header-title">Tournaments Terbaru</span>
        <a href="?page=tournament" class="btn btn-ghost btn-sm">Lihat Semua →</a>
    </div>
    <div class="card-body dash-list-body">
        <?php if (empty($recent_tournaments)): ?>
            <div class="empty-state">
                <div class="empty-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
                </div>
                <p class="text-muted">Belum ada tournament</p>
                <a href="?page=tournament&action=create" class="btn btn-primary btn-sm mt-3">Buat Tournament</a>
            </div>
        <?php else: ?>
            <?php foreach ($recent_tournaments as $t): ?>
            <div class="dash-list-item">
                <div class="dash-list-info">
                    <div class="dash-list-name"><?= e($t['name']) ?></div>
                    <div class="dash-list-meta"><?= formatDate($t['start_date']) ?> - <?= formatDate($t['end_date']) ?></div>
                </div>
                <div class="dash-list-right">
                    <div class="dash-list-slots">
                        <span class="dash-list-count"><?= $t['team_count'] ?? 0 ?>/<?= $t['max_teams'] ?? '?' ?></span>
                        <div class="slot-bar">
                            <div class="slot-bar-fill" style="width:<?= $t['max_teams'] > 0 ? min(100, round(($t['team_count']??0)/$t['max_teams']*100)) : 0 ?>%"></div>
                        </div>
                    </div>
                    <?= statusBadge($t['status']) ?>
                    <a href="?page=tournament&action=detail&id=<?= $t['id'] ?>" class="btn btn-ghost btn-sm">Detail</a>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
