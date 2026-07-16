<?php include __DIR__ . '/../layouts/header.php'; ?>

<?php
$matches_by_round = [];
foreach ($matches as $m) {
    $matches_by_round[$m['round']][] = $m;
}
$tab = $_GET['tab'] ?? 'detail';
?>

<div class="page-header">
    <div>
        <a href="?page=tournament" class="btn btn-ghost btn-sm mb-2">&larr; Kembali</a>
        <h1 class="page-title"><?= e($tournament['name']) ?></h1>
        <p class="page-desc"><?= e($tournament['description'] ?: 'Tidak ada deskripsi') ?></p>
    </div>
    <div class="detail-header-actions">
        <?= statusBadge($tournament['status']) ?>
        <a href="?page=tournament&action=edit&id=<?= $tournament['id'] ?>" class="btn btn-ghost btn-sm">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            Edit
        </a>
        <a href="?page=tournament&action=delete&id=<?= $tournament['id'] ?>&csrf_token=<?= csrf_token() ?>"
           class="btn btn-ghost btn-sm"
           style="color:var(--destructive)"
           onclick="return confirm('Yakin hapus tournament ini?')">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
            Hapus
        </a>
    </div>
</div>

<?php if ($msg = getFlashMessage('success')): ?>
    <div class="alert alert-success"><?= e($msg) ?></div>
<?php endif; ?>
<?php if ($msg = getFlashMessage('error')): ?>
    <div class="alert alert-error"><?= e($msg) ?></div>
<?php endif; ?>

<div class="tab-bar">
    <a href="?page=tournament&action=detail&id=<?= $tournament['id'] ?>&tab=detail" class="tab-item <?= $tab == 'detail' ? 'active' : '' ?>">Detail</a>
    <a href="?page=tournament&action=detail&id=<?= $tournament['id'] ?>&tab=bracket" class="tab-item <?= $tab == 'bracket' ? 'active' : '' ?>">Bracket</a>
</div>

<?php if ($tab == 'detail'): ?>

<div class="stats-bar">
    <div class="stat-item">
        <div class="stat-item-label">Mulai</div>
        <div class="stat-item-value"><?= formatDate($tournament['start_date']) ?></div>
    </div>
    <div class="stat-item">
        <div class="stat-item-label">Selesai</div>
        <div class="stat-item-value"><?= formatDate($tournament['end_date']) ?></div>
    </div>
    <div class="stat-item">
        <div class="stat-item-label">Tim Terdaftar</div>
        <div class="stat-item-value"><?= count($registrations) ?> / <?= $tournament['max_teams'] ?></div>
    </div>
    <div class="stat-item">
        <div class="stat-item-label">Total Match</div>
        <div class="stat-item-value"><?= count($matches) ?></div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-header-title">Tim Terdaftar</span>
        <span class="team-count-label"><?= count($registrations) ?> / <?= $tournament['max_teams'] ?></span>
    </div>
    <div class="team-chips">
        <?php if (empty($registrations)): ?>
        <div class="empty-state" style="width:100%;padding:1rem;">
            <div class="empty-icon">👥</div>
            <p class="text-muted">Belum ada tim terdaftar</p>
        </div>
        <?php else: ?>
        <?php foreach ($registrations as $reg): ?>
        <div class="team-chip-wrap">
            <a href="?page=team&action=detail&id=<?= $reg['team_id'] ?>" class="team-chip"><?= e($reg['team_name']) ?></a>
            <a href="?page=register&action=delete&id=<?= $reg['id'] ?>&csrf_token=<?= csrf_token() ?>"
               onclick="return confirm('Hapus tim <?= e($reg['team_name']) ?>?')"
               class="team-chip-remove" title="Hapus">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </a>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php if ($slot_available > 0): ?>
    <div class="detail-add-team">
        <a href="?page=tournament&action=addteam&id=<?= $tournament['id'] ?>" class="btn btn-primary" style="text-decoration:none;">
            + Tambah Tim Baru
        </a>
    </div>
    <?php endif; ?>
</div>

<?php if (count($registrations) >= 2 && empty($matches)): ?>
<div class="hero-section">
    <div class="hero-title">Bracket siap digenerate</div>
    <div class="hero-desc"><?= count($registrations) ?> tim terdaftar dari <?= $tournament['max_teams'] ?> slot. Setelah generate, bracket tidak bisa diubah.</div>
    <a href="?page=match&action=generate&tournament_id=<?= $tournament['id'] ?>&csrf_token=<?= csrf_token() ?>"
       onclick="return confirm('Generate bracket? Tindakan ini tidak bisa diubah.')"
       class="btn btn-primary hero-btn">Generate Bracket</a>
</div>
<?php elseif (empty($matches) && count($registrations) < 2): ?>
<div class="hero-section">
    <div class="hero-title">Daftarkan tim terlebih dahulu</div>
    <div class="hero-desc">Minimal 2 tim diperlukan untuk generate bracket (saat ini <?= count($registrations) ?> tim).</div>
</div>
<?php endif; ?>

<?php if ($tournament['champion_team_id']): ?>
<div class="champion-banner">
    <span class="champion-icon">🏆</span>
    <span class="champion-name">Champion: <?= e($tournament['champion_name']) ?></span>
</div>
<?php endif; ?>

<?php elseif ($tab == 'bracket'): ?>

<?php if (empty($matches)): ?>
<div class="card">
    <div class="card-body">
        <div class="empty-state">
            <div class="empty-icon">🔮</div>
            <p class="text-muted">Bracket belum digenerate. Generate bracket dari tab Detail.</p>
        </div>
    </div>
</div>
<?php else: ?>
<?php
$slot = (int)$tournament['max_teams'];
$round_labels = getRoundLabels($total_rounds);
$total_cols = $total_rounds + 1;
$grid_rows = $slot * 5;
?>
<div class="bracket-toolbar">
    <a href="?page=tournament&action=pdf&id=<?= $tournament['id'] ?>" class="btn btn-ghost btn-sm" target="_blank">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
        PDF
    </a>
    <a href="?page=match&action=reset&tournament_id=<?= $tournament['id'] ?>&csrf_token=<?= csrf_token() ?>"
       onclick="return confirm('Reset bracket? Semua data match akan dihapus.')"
       class="btn btn-ghost btn-sm" style="color:var(--destructive);">Reset</a>
</div>
<div class="bracket-tree" style="grid-template-columns:repeat(<?= $total_cols ?>, minmax(280px, 1fr));grid-template-rows:repeat(<?= $grid_rows ?>, auto);">

    <?php for ($r = 1; $r <= $total_rounds; $r++): ?>
    <?php
    $matches_in_r = $slot / pow(2, $r);
    $span = $grid_rows / $matches_in_r;
    $round_matches = $matches_by_round[$r] ?? [];
    ?>
    <div class="round-header" style="grid-column:<?= $r ?>;grid-row:1/2;"><?= $round_labels[$r] ?></div>

    <?php foreach ($round_matches as $i => $m):
    $row_start = $i * $span + 2;
    ?>
    <div class="bracket-match" style="grid-column:<?= $r ?>;grid-row:<?= $row_start ?>/span <?= $span ?>;">
        <?php
        $card_link = ($m['status'] != 'completed' && !$m['is_bye'] && $m['team1_id'] && $m['team2_id']);
        if ($card_link): ?><a href="?page=match&action=input&id=<?= $m['id'] ?>" class="bracket-match-link"><?php endif; ?>
        <div class="bracket-match-inner">
            <?php
            $t1_winner = $m['winner_id'] && $m['winner_id'] == $m['team1_id'];
            $t2_winner = $m['winner_id'] && $m['winner_id'] == $m['team2_id'];

            if ($m['is_bye']) {
                $t1_name = $m['team1_id'] ? e($m['team1_name']) : 'BYE';
                $t2_name = $m['team2_id'] ? e($m['team2_name']) : 'BYE';
                $t1_style = !$m['team1_id'] ? 'color:var(--text-dim);font-style:italic;' : '';
                $t2_style = !$m['team2_id'] ? 'color:var(--text-dim);font-style:italic;' : '';
                $t1_score = $m['team1_id'] ? 'W' : '';
                $t2_score = $m['team2_id'] ? 'W' : '';
                $t1_winner = (bool)$m['team1_id'];
                $t2_winner = (bool)$m['team2_id'];
            } elseif (!$m['team1_id'] && !$m['team2_id']) {
                $t1_name = 'Menunggu'; $t2_name = 'Menunggu';
                $t1_style = 'color:var(--text-dim);font-style:italic;';
                $t2_style = 'color:var(--text-dim);font-style:italic;';
                $t1_score = ''; $t2_score = '';
            } else {
                $t1_name = e($m['team1_name'] ?? 'TBD');
                $t2_name = e($m['team2_name'] ?? 'TBD');
                $t1_style = !$m['team1_id'] ? 'color:var(--text-dim);font-style:italic;' : '';
                $t2_style = !$m['team2_id'] ? 'color:var(--text-dim);font-style:italic;' : '';
                $t1_score = $m['score_team1'] !== null ? $m['score_team1'] : '';
                $t2_score = $m['score_team2'] !== null ? $m['score_team2'] : '';
            }
            ?>
            <div class="match-entry <?= $t1_winner ? 'winner' : '' ?>">
                <span class="match-seed"><?= $i * 2 + 1 ?></span>
                <span class="match-name" style="<?= $t1_style ?>"><?= $t1_name ?></span>
                <span class="match-score-val"><?= e($t1_score) ?></span>
            </div>
            <div class="match-entry <?= $t2_winner ? 'winner' : '' ?>">
                <span class="match-seed"><?= $i * 2 + 2 ?></span>
                <span class="match-name" style="<?= $t2_style ?>"><?= $t2_name ?></span>
                <span class="match-score-val"><?= e($t2_score) ?></span>
            </div>
            <?php if ($m['mvp_name']): ?>
            <div class="match-mvp-badge">⭐ <?= e($m['mvp_name']) ?> (MVP)</div>
            <?php endif; ?>
        </div>
        <?php if ($card_link): ?></a><?php endif; ?>
        <?php if ($r < $total_rounds): ?><div class="connector-right"></div><?php endif; ?>
        <?php if ($r > 1): ?><div class="connector-left"></div><?php endif; ?>
        <?php if ($r < $total_rounds): ?>
        <div class="bracket-vline <?= $i % 2 == 0 ? 'vline-top' : 'vline-bottom' ?>"></div>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
    <?php endfor; ?>

    <div class="round-header" style="grid-column:<?= $total_cols ?>;grid-row:1/2;">CHAMPION</div>
    <div class="bracket-match" style="grid-column:<?= $total_cols ?>;grid-row:2/span <?= $grid_rows ?>;">
        <div class="bracket-champion-col">
            <?php if ($tournament['champion_team_id']): ?>
            <div class="champion-icon">🏆</div>
            <div class="champion-name"><?= e($tournament['champion_name']) ?></div>
            <?php else: ?>
            <div class="champion-waiting">Menunggu<br>juara</div>
            <?php endif; ?>
        </div>
        <?php if ($total_rounds > 0): ?>
        <div class="connector-left"></div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>
<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
