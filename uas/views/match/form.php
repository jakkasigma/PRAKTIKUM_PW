<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="max-w-xl fade-up form-compact">
    <div class="card card-accent">
        <div class="card-header">
            <div style="display:flex;align-items:center;gap:.75rem;">
                <span class="header-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="12" x2="2" y2="12"/><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>
                </span>
                <div>
                    <h1 class="card-header-title">Input Match Result</h1>
                    <p class="card-header-desc">Round <?= $match['round'] ?> - Masukkan skor pertandingan</p>
                </div>
            </div>
            <a href="?page=tournament&action=detail&id=<?= $match['tournament_id'] ?>&tab=bracket" class="btn btn-ghost btn-sm">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Bracket
            </a>
        </div>
        <div class="card-body">

            <?php if ($msg = getFlashMessage('error')): ?>
                <div class="alert alert-error"><?= e($msg) ?></div>
            <?php endif; ?>

            <div class="match-vs">
                <div class="match-vs-team"><?= e($match['team1_name'] ?? 'TBD') ?></div>
                <div class="match-vs-divider">
                    <span class="match-vs-text">VS</span>
                </div>
                <div class="match-vs-team"><?= e($match['team2_name'] ?? 'TBD') ?></div>
            </div>

            <form method="POST" action="?page=match&action=save&id=<?= $match['id'] ?>" id="match_form">
                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">

                <div class="match-score-grid">
                    <div class="match-score-side">
                        <label class="form-label" style="text-align:center;"><?= e($match['team1_name'] ?? 'Team 1') ?></label>
                        <input type="number" name="score_team1" min="0" value="<?= old('score_team1') ?>"
                               class="form-input match-score-input" placeholder="0">
                    </div>
                    <div class="match-score-side">
                        <label class="form-label" style="text-align:center;"><?= e($match['team2_name'] ?? 'Team 2') ?></label>
                        <input type="number" name="score_team2" min="0" value="<?= old('score_team2') ?>"
                               class="form-input match-score-input" placeholder="0">
                    </div>
                </div>

                <div class="form-group" style="margin-top:1rem;">
                    <label class="form-label">
                        MVP
                        <span style="color:var(--text-dim);font-weight:400;">(opsional)</span>
                    </label>
                    <div class="input-group">
                        <span class="input-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        </span>
                        <select name="mvp_player_id" class="form-select">
                            <option value="">-- Tidak Ada --</option>
                            <?php if (!empty($mvp_candidates)): ?>
                                <?php foreach ($mvp_candidates as $p): ?>
                                <option value="<?= $p['id'] ?>"><?= e($p['name']) ?> (<?= e($p['nickname'] ?: $p['name']) ?>)</option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>

                <div class="action-row" style="margin-top:.75rem;">
                    <button type="submit" class="btn btn-primary" id="match_btn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        <span class="btn-text">Simpan Skor</span>
                        <span class="btn-spinner" style="display:none;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="spin"><circle cx="12" cy="12" r="10" stroke-dasharray="32" stroke-dashoffset="32"/></svg>
                        </span>
                    </button>
                    <a href="?page=tournament&action=detail&id=<?= $match['tournament_id'] ?>&tab=bracket" class="btn btn-secondary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('match_form').addEventListener('submit', function() {
    var btn = document.getElementById('match_btn');
    btn.disabled = true;
    btn.classList.add('loading');
    btn.querySelector('.btn-text').textContent = 'Menyimpan...';
    btn.querySelector('.btn-spinner').style.display = 'inline';
});
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
