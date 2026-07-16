<?php include __DIR__ . '/../layouts/header.php'; ?>

<?php $errors = getFlashMessage('errors') ?? []; ?>

<div class="max-w-2xl fade-up">
    <div class="card card-accent">
        <div class="card-header">
            <div style="display:flex;align-items:center;gap:.75rem;">
                <span class="header-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </span>
                <div>
                    <h1 class="card-header-title">Atur Tim</h1>
                    <p class="card-header-desc">Kelola tim untuk: <strong><?= e($tournament['name']) ?></strong></p>
                </div>
            </div>
            <?= statusBadge($tournament['status']) ?>
        </div>
        <div class="card-body">

            <?php if ($msg = getFlashMessage('success')): ?>
                <div class="alert alert-success"><?= e($msg) ?></div>
            <?php endif; ?>
            <?php if ($msg = getFlashMessage('error')): ?>
                <div class="alert alert-error"><?= e($msg) ?></div>
            <?php endif; ?>

            <div class="reg-manage-card">
                <div class="reg-manage-header">
                    <span class="card-header-title">Tim Terdaftar</span>
                    <span class="reg-count"><?= count($registrations) ?> / <?= $tournament['max_teams'] ?></span>
                </div>

                <?php if (empty($registrations)): ?>
                    <div class="empty-state">
                        <div class="empty-icon">
                            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <p class="text-muted">Belum ada tim terdaftar</p>
                    </div>
                <?php else: ?>
                    <div class="reg-team-items">
                        <?php foreach ($registrations as $reg): ?>
                        <div class="reg-team-item">
                            <div class="reg-team-info">
                                <span class="reg-team-avatar"><?= strtoupper(substr($reg['team_name'], 0, 1)) ?></span>
                                <a href="?page=team&action=detail&id=<?= $reg['team_id'] ?>" class="reg-team-name"><?= e($reg['team_name']) ?></a>
                            </div>
                            <div style="display:flex;gap:.35rem;">
                                <a href="?page=team&action=detail&id=<?= $reg['team_id'] ?>"
                                   class="btn btn-ghost btn-sm">Edit</a>
                                <a href="?page=register&action=delete&id=<?= $reg['id'] ?>&csrf_token=<?= csrf_token() ?>"
                                   class="btn btn-ghost btn-sm reg-delete-btn"
                                   onclick="return confirm('Hapus tim <?= e($reg['team_name']) ?> dari turnamen?')">Hapus</a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($slot_available > 0): ?>
                <div class="reg-add-form">
                    <form method="POST" action="?page=register&action=store">
                        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                        <input type="hidden" name="tournament_id" value="<?= $tournament['id'] ?>">
                        <div class="reg-add-row">
                            <div class="input-group" style="flex:1;">
                                <span class="input-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                </span>
                                <select name="team_id" class="form-select" required>
                                    <option value="">-- Pilih Tim --</option>
                                    <?php foreach ($available_teams as $t): ?>
                                    <option value="<?= $t['id'] ?>"><?= e($t['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" <?= empty($available_teams) ? 'disabled' : '' ?>>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                Tambah
                            </button>
                        </div>
                        <?php if (empty($available_teams)): ?>
                        <p class="field-hint" style="margin-top:.5rem;">Semua tim sudah terdaftar. <a href="?page=tournament&action=addteam&id=<?= $tournament['id'] ?>" style="text-decoration:underline;color:var(--text);">Buat tim baru</a></p>
                        <?php endif; ?>
                    </form>
                </div>
                <?php endif; ?>
            </div>

            <div class="action-row" style="margin-top:1rem;">
                <a href="?page=registrations" class="btn btn-secondary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
