<?php include __DIR__ . '/../layouts/header.php'; ?>

<?php $is_edit = isset($player); ?>
<?php $errors = getFlashMessage('errors') ?? []; ?>

<div class="max-w-xl fade-up form-compact">
    <div class="card card-accent">
        <div class="card-header">
            <div style="display:flex;align-items:center;gap:.75rem;">
                <span class="header-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </span>
                <div>
                    <h1 class="card-header-title"><?= $is_edit ? 'Edit Player' : 'Tambah Player' ?></h1>
                    <p class="card-header-desc"><?= $is_edit ? 'Ubah data pemain' : 'Tambah pemain baru' ?></p>
                </div>
            </div>
        </div>
        <div class="card-body">

            <?php if ($msg = getFlashMessage('error')): ?>
                <div class="alert alert-error"><?= e($msg) ?></div>
            <?php endif; ?>

            <form method="POST" action="<?= $is_edit ? "?page=player&action=update&id={$player['id']}" : '?page=player&action=store' ?>" id="player_form">
                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">

                <div class="form-group">
                    <label class="form-label">Nama <span class="required-star">*</span></label>
                    <div class="input-group">
                        <span class="input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </span>
                        <input type="text" name="name" value="<?= e($is_edit ? $player['name'] : old('name')) ?>"
                               class="form-input <?= isset($errors['name']) ? 'error' : '' ?>" placeholder="Nama lengkap" autofocus>
                    </div>
                    <?php if (isset($errors['name'])): ?><div class="form-error"><?= e($errors['name']) ?></div><?php endif; ?>
                </div>

                <div class="row-half">
                    <div class="col-half">
                        <label class="form-label">Nickname</label>
                        <div class="input-group">
                            <span class="input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </span>
                            <input type="text" name="nickname" value="<?= e($is_edit ? $player['nickname'] : old('nickname')) ?>"
                                   class="form-input" placeholder="In-game name">
                        </div>
                    </div>
                    <div class="col-half">
                        <label class="form-label">Role</label>
                        <div class="input-group">
                            <span class="input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                            </span>
                            <input type="text" name="role" value="<?= e($is_edit ? $player['role'] : old('role')) ?>"
                                   class="form-input" placeholder="Posisi (MID/EXP/GOLD)">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Team</label>
                    <div class="input-group">
                        <span class="input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </span>
                        <select name="team_id" class="form-select">
                            <option value="">-- Tanpa Team --</option>
                            <?php foreach ($teams as $t): ?>
                            <option value="<?= $t['id'] ?>" <?= ($is_edit && $player['team_id'] == $t['id']) ? 'selected' : ($selected_team_id == $t['id'] ? 'selected' : '') ?>><?= e($t['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="action-row">
                    <button type="submit" class="btn btn-primary" id="player_btn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        <span class="btn-text"><?= $is_edit ? 'Update' : 'Simpan' ?></span>
                        <span class="btn-spinner" style="display:none;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="spin"><circle cx="12" cy="12" r="10" stroke-dasharray="32" stroke-dashoffset="32"/></svg>
                        </span>
                    </button>
                    <a href="?page=player" class="btn btn-secondary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('player_form').addEventListener('submit', function() {
    var btn = document.getElementById('player_btn');
    btn.disabled = true;
    btn.classList.add('loading');
    btn.querySelector('.btn-text').textContent = 'Menyimpan...';
    btn.querySelector('.btn-spinner').style.display = 'inline';
});
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
