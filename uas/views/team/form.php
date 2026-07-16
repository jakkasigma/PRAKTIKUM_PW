<?php include __DIR__ . '/../layouts/header.php'; ?>

<?php $is_edit = isset($team); ?>
<?php $errors = getFlashMessage('errors') ?? []; ?>

<div class="max-w-xl fade-up form-compact">
    <div class="card card-accent">
        <div class="card-header">
            <div style="display:flex;align-items:center;gap:.75rem;">
                <span class="header-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </span>
                <div>
                    <h1 class="card-header-title"><?= $is_edit ? 'Edit Team' : 'Tambah Team' ?></h1>
                    <p class="card-header-desc"><?= $is_edit ? 'Ubah informasi tim' : 'Tambah tim baru' ?></p>
                </div>
            </div>
        </div>
        <div class="card-body">

            <?php if ($msg = getFlashMessage('error')): ?>
                <div class="alert alert-error"><?= e($msg) ?></div>
            <?php endif; ?>

            <form method="POST" action="<?= $is_edit ? "?page=team&action=update&id={$team['id']}" : '?page=team&action=store' ?>" id="team_form">
                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">

                <div class="form-group">
                    <label class="form-label">Nama Team <span class="required-star">*</span></label>
                    <div class="input-group">
                        <span class="input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </span>
                        <input type="text" name="name" value="<?= e($is_edit ? $team['name'] : old('name')) ?>"
                               class="form-input <?= isset($errors['name']) ? 'error' : '' ?>" placeholder="Nama tim" autofocus>
                    </div>
                    <?php if (isset($errors['name'])): ?><div class="form-error"><?= e($errors['name']) ?></div><?php endif; ?>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <div class="input-group">
                        <span class="input-icon input-icon-top">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        </span>
                        <textarea name="description" class="form-textarea <?= isset($errors['description']) ? 'error' : '' ?>" placeholder="Deskripsi tim (opsional)"><?= e($is_edit ? $team['description'] : old('description')) ?></textarea>
                    </div>
                </div>

                <div class="action-row">
                    <button type="submit" class="btn btn-primary" id="team_btn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        <span class="btn-text"><?= $is_edit ? 'Update' : 'Simpan' ?></span>
                        <span class="btn-spinner" style="display:none;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="spin"><circle cx="12" cy="12" r="10" stroke-dasharray="32" stroke-dashoffset="32"/></svg>
                        </span>
                    </button>
                    <a href="?page=team" class="btn btn-secondary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('team_form').addEventListener('submit', function() {
    var btn = document.getElementById('team_btn');
    btn.disabled = true;
    btn.classList.add('loading');
    btn.querySelector('.btn-text').textContent = 'Menyimpan...';
    btn.querySelector('.btn-spinner').style.display = 'inline';
});
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
