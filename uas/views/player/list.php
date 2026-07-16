<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
    <div>
        <h1 class="page-title">Players</h1>
        <p class="page-desc">Kelola data pemain</p>
    </div>
    <a href="?page=player&action=create" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Player
    </a>
</div>

<?php if ($msg = getFlashMessage('success')): ?>
    <div class="alert alert-success"><?= e($msg) ?></div>
<?php endif; ?>
<?php if ($msg = getFlashMessage('error')): ?>
    <div class="alert alert-error"><?= e($msg) ?></div>
<?php endif; ?>

<?php if (empty($players)): ?>
<div class="card">
    <div class="card-body">
        <div class="empty-state">
            <div class="empty-icon">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </div>
            <p class="text-muted">Belum ada player</p>
            <a href="?page=player&action=create" class="btn btn-primary btn-sm mt-3">Tambah Player</a>
        </div>
    </div>
</div>
<?php else: ?>
<div class="card">
    <div class="card-body table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:40px;">#</th>
                    <th>Nama</th>
                    <th>Nickname</th>
                    <th>Role</th>
                    <th>Team</th>
                    <th style="width:100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($players as $i => $p): ?>
                <tr>
                    <td data-label="#"><?= $i + 1 ?></td>
                    <td data-label="Nama">
                        <div style="display:flex;align-items:center;gap:.5rem;">
                            <span class="player-mini-avatar"><?= strtoupper(substr($p['name'], 0, 1)) ?></span>
                            <span class="cell-primary"><?= e($p['name']) ?></span>
                        </div>
                    </td>
                    <td data-label="Nickname"><?= e($p['nickname'] ?: '-') ?></td>
                    <td data-label="Role"><?= e($p['role'] ?: '-') ?></td>
                    <td data-label="Team"><?= e($p['team_name'] ?: '-') ?></td>
                    <td data-label="Aksi">
                        <div class="cell-actions">
                            <a href="?page=player&action=edit&id=<?= $p['id'] ?>" class="btn-action" title="Edit">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </a>
                            <a href="?page=player&action=delete&id=<?= $p['id'] ?>&csrf_token=<?= csrf_token() ?>"
                               class="btn-action danger" title="Hapus"
                               onclick="return confirm('Yakin ingin menghapus pemain <?= e($p['name']) ?>?')">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
