<?php include __DIR__ . '/../layouts/public_header.php'; ?>

<?php
$matches_by_round = [];
foreach ($matches as $m) {
    $matches_by_round[$m['round']][] = $m;
}
?>

<div class="page-header">
    <div>
        <a href="?page=public" class="btn btn-ghost btn-sm mb-2">&larr; Kembali</a>
        <h1 class="page-title" style="font-size:1.5rem;"><?= e($tournament['name']) ?></h1>
        <div class="public-bracket-meta">
            <?= statusBadge($tournament['status']) ?>
            <?php if ($tournament['champion_team_id']): ?>
                <span class="public-champion-label">Champion: <strong><?= e($tournament['champion_name']) ?></strong></span>
            <?php endif; ?>
        </div>
    </div>
    <?php if ($tournament['champion_team_id']): ?>
    <div class="champion-banner" style="margin:0;padding:.6rem 1.25rem;">
        <div class="champion-inline">
            <span style="font-size:1.25rem;">🏆</span>
            <span style="font-weight:700;"><?= e($tournament['champion_name']) ?></span>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php if (empty($matches)): ?>
    <div class="card" style="border-color:#1e293b;">
        <div class="card-body">
            <div class="empty-state" style="padding:2rem 0;">
                <div class="empty-icon" style="font-size:2.5rem;">🔮</div>
                <p class="text-muted">Belum ada bracket yang digenerate</p>
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
<div class="card" style="border-color:#1e293b;">
    <div class="card-body" style="overflow-x:auto;">
        <div class="bracket-tree" style="grid-template-columns:repeat(<?= $total_cols ?>, minmax(280px, 1fr));grid-template-rows:repeat(<?= $grid_rows ?>, auto);">

            <?php for ($r = 1; $r <= $total_rounds; $r++): ?>
            <?php
            $matches_in_r = $slot / pow(2, $r);
            $span = $grid_rows / $matches_in_r;
            $round_matches = $matches_by_round[$r] ?? [];
            ?>
            <div class="round-header" style="grid-column:<?= $r ?>;grid-row:1/2;color:var(--text-muted);"><?= $round_labels[$r] ?></div>

            <?php foreach ($round_matches as $i => $m):
            $row_start = $i * $span + 2;
            ?>
            <div class="bracket-match" style="grid-column:<?= $r ?>;grid-row:<?= $row_start ?>/span <?= $span ?>;">
                    <div class="bracket-match-inner" style="border-color:#1e293b;background:#0f172a;">
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
                <?php if ($r < $total_rounds): ?>
                <div class="connector-right"></div>
                <div class="bracket-vline <?= $i % 2 == 0 ? 'vline-top' : 'vline-bottom' ?>" style="background:#1e293b;"></div>
                <?php endif; ?>
                <?php if ($r > 1): ?>
                <div class="connector-left" style="border-color:#1e293b;"></div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
            <?php endfor; ?>

            <div class="round-header" style="grid-column:<?= $total_cols ?>;grid-row:1/2;color:var(--text-muted);">CHAMPION</div>
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
                <div class="connector-left" style="border-color:#1e293b;"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
setTimeout(function() { location.reload(); }, 30000);
</script>

<?php include __DIR__ . '/../layouts/public_footer.php'; ?>
