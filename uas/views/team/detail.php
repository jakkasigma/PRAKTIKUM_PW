<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="max-w-2xl fade-up">
    <div class="card card-accent">
        <div class="card-header">
            <div style="display:flex;align-items:center;gap:.75rem;">
                <span class="header-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </span>
                <div>
                    <h1 class="card-header-title"><?= e($team['name']) ?></h1>
                    <p class="card-header-desc"><?= e($team['description'] ?: 'Detail tim') ?></p>
                </div>
            </div>
            <div style="display:flex;gap:.5rem;">
                <a href="?page=team&action=edit&id=<?= $team['id'] ?>" class="btn btn-ghost btn-sm">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Edit Tim
                </a>
                <a href="javascript:history.back()" class="btn btn-ghost btn-sm">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <?php if (empty($players)): ?>
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <p class="text-muted">Belum ada pemain di tim ini</p>
                    <a href="?page=player&action=create&team_id=<?= $team['id'] ?>" class="btn btn-primary btn-sm mt-3">Tambah Pemain</a>
                </div>
            <?php else: ?>
                <div class="player-grid">
                    <?php foreach ($players as $p): ?>
                    <div class="player-card">
                        <div class="player-avatar">
                            <span class="player-initial"><?= strtoupper(substr($p['nickname'] ?: $p['name'], 0, 1)) ?></span>
                        </div>
                        <div class="player-info">
                            <div class="player-name"><?= e($p['nickname'] ?: $p['name']) ?></div>
                            <div class="player-role"><?= e($p['role'] ?: 'Player') ?></div>
                        </div>
                        <span class="player-id">#<?= $p['id'] ?></span>
                        <div class="player-actions">
                            <a href="?page=player&action=edit&id=<?= $p['id'] ?>" class="btn-icon" title="Edit">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </a>
                            <a href="?page=player&action=delete&id=<?= $p['id'] ?>&csrf_token=<?= csrf_token() ?>"
                               onclick="return confirm('Hapus pemain <?= e($p['nickname'] ?: $p['name']) ?>?')"
                               class="btn-icon btn-icon-danger" title="Hapus">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
