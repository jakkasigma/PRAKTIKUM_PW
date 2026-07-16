<?php include __DIR__ . '/../layouts/header.php'; ?>

<?php $errors = getFlashMessage('errors') ?? []; ?>

<div class="max-w-2xl">
    <div class="page-header">
        <div>
            <a href="?page=tournament&action=detail&id=<?= $tournament['id'] ?>" class="btn btn-ghost btn-sm mb-2" style="display:inline-flex;">&larr; Kembali</a>
            <h1 class="page-title">Tambah Tim</h1>
            <p class="page-desc">Daftarkan tim ke: <strong><?= e($tournament['name']) ?></strong></p>
            <p class="text-muted" style="font-size:0.8rem;">Slot tersedia: <?= e($slot_available) ?> / <?= e($tournament['max_teams']) ?></p>
        </div>
    </div>

    <?php if ($msg = getFlashMessage('error')): ?>
        <div class="alert alert-error"><?= e($msg) ?></div>
    <?php endif; ?>
    <?php if ($msg = getFlashMessage('success')): ?>
        <div class="alert alert-success"><?= e($msg) ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="?page=tournament&action=storeteam&id=<?= $tournament['id'] ?>">
                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                <div class="form-group">
                    <label class="form-label">Nama Tim <span style="color:var(--destructive);">*</span></label>
                    <input type="text" name="name" value="<?= e(old('name')) ?>"
                           class="form-input <?= isset($errors['name']) ? 'error' : '' ?>" placeholder="Cth: Evos">
                    <?php if (isset($errors['name'])): ?><div class="form-error"><?= e($errors['name']) ?></div><?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi Tim</label>
                    <textarea name="description" class="form-textarea" placeholder="Deskripsi tim (opsional)"><?= e(old('description')) ?></textarea>
                </div>

                <hr style="border-color:var(--border);margin:1.5rem 0;">

                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem;">
                    <label class="form-label" style="margin-bottom:0;font-size:1rem;">Anggota Pemain</label>
                    <button type="button" class="btn btn-sm btn-secondary" onclick="addPlayerRow()">+ Tambah Pemain</button>
                </div>

                <div id="players-container">
                    <div class="player-row" style="display:flex;gap:0.5rem;margin-bottom:0.5rem;align-items:flex-start;">
                        <div style="flex:2;min-width:0;">
                            <input type="text" name="players[nickname][]" class="form-input" placeholder="Nickname" style="min-height:36px;font-size:0.875rem;">
                        </div>
                        <div style="flex:1;min-width:0;">
                            <input type="text" name="players[role][]" class="form-input" placeholder="Role" style="min-height:36px;font-size:0.875rem;">
                        </div>
                        <button type="button" class="btn btn-ghost btn-sm" onclick="this.closest('.player-row').remove()" style="min-height:36px;flex-shrink:0;color:var(--destructive);">✕</button>
                    </div>
                </div>

                <div class="action-row" style="margin-top:1.5rem;">
                    <button type="submit" class="btn btn-primary">Simpan Tim & Anggota</button>
                    <a href="?page=tournament&action=detail&id=<?= $tournament['id'] ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function addPlayerRow() {
    const container = document.getElementById('players-container');
    const row = document.createElement('div');
    row.className = 'player-row';
    row.style.cssText = 'display:flex;gap:0.5rem;margin-bottom:0.5rem;align-items:flex-start;';
    row.innerHTML = `
        <div style="flex:2;min-width:0;">
            <input type="text" name="players[nickname][]" class="form-input" placeholder="Nickname" style="min-height:36px;font-size:0.875rem;">
        </div>
        <div style="flex:1;min-width:0;">
            <input type="text" name="players[role][]" class="form-input" placeholder="Role" style="min-height:36px;font-size:0.875rem;">
        </div>
        <button type="button" class="btn btn-ghost btn-sm" onclick="this.closest('.player-row').remove()" style="min-height:36px;flex-shrink:0;color:var(--destructive);">✕</button>
    `;
    container.appendChild(row);
}
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>