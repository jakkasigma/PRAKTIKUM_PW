<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="max-w-xl fade-up form-compact">
    <div class="card card-accent">
        <div class="card-header">
            <div style="display:flex;align-items:center;gap:.75rem;">
                <span class="header-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><polyline points="17 11 19 13 23 9"/></svg>
                </span>
                <div>
                    <h1 class="card-header-title">Register Team</h1>
                    <p class="card-header-desc">Daftarkan tim ke: <strong><?= e($tournament['name']) ?></strong></p>
                </div>
            </div>
        </div>
        <div class="card-body">

            <?php if ($msg = getFlashMessage('error')): ?>
                <div class="alert alert-error"><?= e($msg) ?></div>
            <?php endif; ?>

            <form method="POST" action="?page=register&action=store">
                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                <input type="hidden" name="tournament_id" value="<?= $tournament['id'] ?>">

                <div class="form-group">
                    <label class="form-label">Pilih Team</label>
                    <div class="input-group">
                        <span class="input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </span>
                        <select name="team_id" class="form-select" required>
                            <option value="">-- Pilih Team --</option>
                            <?php foreach ($available_teams as $t): ?>
                            <option value="<?= $t['id'] ?>"><?= e($t['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php if (empty($available_teams)): ?>
                    <p class="field-hint">Semua tim sudah terdaftar. <a href="?page=team&action=create" style="color:var(--text);text-decoration:underline;">Buat tim baru</a></p>
                    <?php endif; ?>
                </div>

                <div class="action-row">
                    <button type="submit" class="btn btn-primary" <?= empty($available_teams) ? 'disabled' : '' ?>>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Daftarkan
                    </button>
                    <a href="?page=tournament&action=detail&id=<?= $tournament['id'] ?>" class="btn btn-secondary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        Batal
                    </a>
                </div>
            </form>

            <?php if (!empty($registered)): ?>
            <div class="form-divider"></div>
            <div class="form-group">
                <label class="form-label">Tim Terdaftar</label>
                <div class="reg-team-items" style="border:1px solid var(--border);border-radius:var(--radius-sm);">
                    <?php foreach ($registered as $reg): ?>
                    <div class="reg-team-item">
                        <div class="reg-team-info">
                            <span class="reg-team-avatar"><?= strtoupper(substr($reg['team_name'], 0, 1)) ?></span>
                            <span class="reg-team-name"><?= e($reg['team_name']) ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
