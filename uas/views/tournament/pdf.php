<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bracket - <?= e($tournament['name']) ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 9pt; color: #fafafa;
            background: #09090b; padding: 0;
        }
        .header {
            text-align: center; padding: 8px 0 6px;
            border-bottom: 1px solid #27272a; margin-bottom: 10px;
        }
        .header h1 { font-size: 15pt; font-weight: 700; color: #ffffff; }
        .header .info { font-size: 7.5pt; color: #a1a1aa; margin-top: 3px; }
        .header .info span { margin: 0 10px; }

        .bracket-tree { position: relative; }
        .match-card {
            position: absolute;
            border: 1px solid #27272a;
            border-radius: 6px;
            background: #18181b;
            overflow: hidden;
            height: 56px;
        }
        .match-card table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .match-entry td {
            height: 27px;
            line-height: 27px;
            vertical-align: middle;
        }
        .match-card.has-mvp .match-entry td {
            height: 20px;
            line-height: 20px;
        }
        tr.match-entry + tr.match-entry td {
            border-top: 1px solid #27272a;
        }
        .match-entry.winner {
            background: rgba(255, 255, 255, 0.04);
        }
        .seed-cell {
            width: 22px;
            padding: 0 0 0 6px;
            vertical-align: middle;
        }
        .seed {
            display: inline-block;
            text-align: center;
            line-height: 12px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: 1px solid #3f3f46;
            color: #a1a1aa;
            font-size: 5.5pt;
            font-weight: 700;
        }
        .match-entry.winner .seed {
            border-color: rgba(255, 255, 255, 0.3);
            color: #ffffff;
        }
        .team-cell {
            padding: 0 6px;
            font-weight: 500;
            color: #fafafa;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 7.5pt;
            vertical-align: middle;
        }
        .match-entry.winner .team-cell {
            font-weight: 700;
            color: #ffffff;
        }
        .score-cell {
            width: 28px;
            padding: 0 8px 0 2px;
            font-weight: 700;
            color: #a1a1aa;
            font-size: 7.5pt;
            text-align: right;
            vertical-align: middle;
        }
        .match-entry.winner .score-cell { color: #ffffff; }

        .match-tbd {
            height: 56px;
            line-height: 56px;
            font-size: 7.5pt;
            color: #71717a;
            font-style: italic;
            text-align: center;
        }
        .mvp-badge {
            font-size: 5.5pt;
            color: #a1a1aa;
            background: #18181b;
            height: 14px;
            line-height: 14px;
            border-top: 1px solid #27272a;
            text-align: center;
            font-weight: 600;
        }

        .round-title {
            position: absolute; left: 0; right: 0;
            text-align: center; font-size: 6.5pt; font-weight: 700; color: #a1a1aa;
            text-transform: uppercase; letter-spacing: 1px;
            border-bottom: 2px solid #27272a;
            padding-bottom: 4px;
        }
        .champ-col {
            position: absolute;
            display: flex; flex-direction: column;
            justify-content: center; align-items: center;
            text-align: center;
        }
        .champ-col .champion-icon { font-size: 24pt; margin-bottom: 4px; }
        .champ-col .champion-name { font-size: 9pt; font-weight: 800; color: #ffffff; }

        .conn-h {
            position: absolute; height: 2px; background: #27272a;
        }
        .conn-v {
            position: absolute; width: 2px; background: #27272a;
        }

        .footer { text-align: center; color: #52525b; font-size: 6pt; padding-top: 6px; border-top: 1px solid #27272a; position: absolute; left: 0; right: 0; }
        @page { margin: 10px; }
    </style>
</head>
<body>

<?php
$slot = (int)$tournament['max_teams'];
$total_rounds_display = $total_rounds;
$cols = $total_rounds_display + 1;

// KONFIGURASI LAYOUT DINAMIS
if ($slot <= 8) {
    $page_w = 822; // A4 Usable Width (842 - 20)
    $page_h = 575; // A4 Usable Height (595 - 20)
    $header_h = 80;
    $col_gap = 10;
    $match_h = 56;
    $champ_w = 140;
    $margin_x = 10;
    $margin_y = 10;
} elseif ($slot == 16) {
    $page_w = 1171; // A3 Usable Width (1191 - 20)
    $page_h = 822;  // A3 Usable Height (842 - 20)
    $header_h = 80;
    $col_gap = 12;
    $match_h = 56;
    $champ_w = 160;
    $margin_x = 10;
    $margin_y = 10;
} else { // 32 tim atau lebih
    $page_w = 1664; // A2 Usable Width (1684 - 20)
    $page_h = 1171; // A2 Usable Height (1191 - 20)
    $header_h = 90;
    $col_gap = 16;
    $match_h = 56;
    $champ_w = 180;
    $margin_x = 10;
    $margin_y = 10;
}

// Hitung lebar kolom presisi (dikurangi gap untuk menghindari overflow kanan)
$col_w = ($page_w - 2 * $margin_x - $champ_w - ($total_rounds_display * $col_gap)) / $total_rounds_display;

// Bracket usable height
$usable_h = $page_h - $header_h - $margin_y - 28; // 28 untuk footer

// For spacing calculations
$grid_rows = $slot * 5;
?>

<div class="header" style="position:absolute;left:0;right:0;top:0;">
    <h1><?= e($tournament['name']) ?></h1>
    <div class="info">
        <span>Jadwal: <?= formatDate($tournament['start_date']) ?> - <?= formatDate($tournament['end_date']) ?></span>
        <span>Kuota: <?= e($tournament['max_teams']) ?> Tim</span>
    </div>
</div>

<?php if (empty($matches)): ?>
    <p style="position:absolute;top:45%;left:0;right:0;text-align:center;color:#52525b;padding:40px;">Bracket belum digenerate.</p>
<?php else: ?>

<?php
// Calculate positions for each match
$match_positions = [];

for ($r = 1; $r <= $total_rounds_display; $r++):
    $matches_in_r = $slot / pow(2, $r);
    $span = $grid_rows / $matches_in_r;
    $round_matches = $matches_by_round[$r] ?? [];

    foreach ($round_matches as $i => $m):
        $row_center = $i * $span + $span / 2;
        $top_ratio = $row_center / $grid_rows;
        $top = $header_h + $margin_y + $top_ratio * $usable_h - $match_h / 2;
        $left = $margin_x + ($r - 1) * ($col_w + $col_gap);

        $match_positions[] = [
            'r' => $r, 'i' => $i,
            'm' => $m,
            'top' => $top,
            'left' => $left,
            'width' => $col_w,
        ];
    endforeach;
endfor;

// RENDER MATCH CARDS
foreach ($match_positions as $mp):
$m = $mp['m'];
$r = $mp['r'];
$i = $mp['i'];
$top = round($mp['top'], 1);
$left = round($mp['left'], 1);
$w = round($mp['width'], 1);
?>
<div class="match-card <?= $m['mvp_name'] ? 'has-mvp' : '' ?>" style="top:<?= $top ?>px;left:<?= $left ?>px;width:<?= $w ?>px;">
    <?php
    $t1w = $m['winner_id'] && $m['winner_id'] == $m['team1_id'];
    $t2w = $m['winner_id'] && $m['winner_id'] == $m['team2_id'];

    if ($m['is_bye']) {
        $t1_name = $m['team1_id'] ? e($m['team1_name']) : 'BYE';
        $t2_name = $m['team2_id'] ? e($m['team2_name']) : 'BYE';
        $t1_style = !$m['team1_id'] ? 'color: #71717a; font-style: italic;' : '';
        $t2_style = !$m['team2_id'] ? 'color: #71717a; font-style: italic;' : '';
        $t1_score = $m['team1_id'] ? 'W' : '';
        $t2_score = $m['team2_id'] ? 'W' : '';
        $t1w = (bool)$m['team1_id'];
        $t2w = (bool)$m['team2_id'];
    } elseif (!$m['team1_id'] && !$m['team2_id']) {
        $t1_name = 'Menunggu';
        $t2_name = 'Menunggu';
        $t1_style = 'color: #71717a; font-style: italic;';
        $t2_style = 'color: #71717a; font-style: italic;';
        $t1_score = '';
        $t2_score = '';
    } else {
        $t1_name = e($m['team1_name'] ?? 'TBD');
        $t2_name = e($m['team2_name'] ?? 'TBD');
        $t1_style = !$m['team1_id'] ? 'color: #71717a; font-style: italic;' : '';
        $t2_style = !$m['team2_id'] ? 'color: #71717a; font-style: italic;' : '';
        $t1_score = $m['score_team1'] !== null ? $m['score_team1'] : '';
        $t2_score = $m['score_team2'] !== null ? $m['score_team2'] : '';
    }
    ?>
    <table cellpadding="0" cellspacing="0">
        <tr class="match-entry <?= $t1w ? 'winner' : '' ?>">
            <td class="seed-cell"><span class="seed"><?= $i * 2 + 1 ?></span></td>
            <td class="team-cell" style="<?= $t1_style ?>"><?= $t1_name ?></td>
            <td class="score-cell"><?= e($t1_score) ?></td>
        </tr>
        <tr class="match-entry <?= $t2w ? 'winner' : '' ?>">
            <td class="seed-cell"><span class="seed"><?= $i * 2 + 2 ?></span></td>
            <td class="team-cell" style="<?= $t2_style ?>"><?= $t2_name ?></td>
            <td class="score-cell"><?= e($t2_score) ?></td>
        </tr>
    </table>
    <?php if ($m['mvp_name']): ?>
    <div class="mvp-badge"><span style="color: #fbbf24;">★</span> <?= e($m['mvp_name']) ?> (MVP)</div>
    <?php endif; ?>
</div>
<?php endforeach; ?>

<?php
// RENDER CONNECTOR LINES
foreach ($match_positions as $mp):
$r = $mp['r'];
$m = $mp['m'];
if ($r < $total_rounds_display):
    $top = round($mp['top'] + $match_h / 2, 1);
    $left = round($mp['left'] + $mp['width'], 1);
    $conn_w = $col_gap;
    echo "<div class='conn-h' style='top:{$top}px;left:{$left}px;width:{$conn_w}px;'></div>\n";

    // Find matches in next round to connect vertically
    $next_matches = array_filter($match_positions, fn($p) => $p['r'] == $r + 1);
    $next_matches = array_values($next_matches);
    $next_idx = floor($mp['i'] / 2);
    if (isset($next_matches[$next_idx])):
        $nm = $next_matches[$next_idx];
        $n_top = round($nm['top'] + $match_h / 2, 1);
        $v_top = min($top, $n_top);
        $v_h = abs($top - $n_top);
        $v_left = round($mp['left'] + $mp['width'] + $col_gap, 1);
        echo "<div class='conn-h' style='top:{$n_top}px;left:" . round($mp['left'] + $mp['width'], 1) . "px;width:{$col_gap}px;'></div>\n";
        if ($v_h > 2):
            echo "<div class='conn-v' style='top:{$v_top}px;left:{$v_left}px;height:{$v_h}px;'></div>\n";
        endif;
    endif;
endif;
endforeach;

// CONNECT MATCHES FROM PREVIOUS ROUND (connector-left side)
foreach ($match_positions as $mp):
$r = $mp['r'];
$m = $mp['m'];
if ($r > 1):
    $top = round($mp['top'] + $match_h / 2, 1);
    $left = round($mp['left'] - $col_gap, 1);
    echo "<div class='conn-h' style='top:{$top}px;left:{$left}px;width:{$col_gap}px;'></div>\n";
endif;
endforeach;

// RENDER ROUND TITLES
for ($r = 1; $r <= $total_rounds_display; $r++):
    $left = round($margin_x + ($r - 1) * ($col_w + $col_gap), 1);
    $label = e($round_labels[$r] ?? "Round $r");
?>
<div class="round-title" style="top:<?= $header_h ?>px;left:<?= $left ?>px;width:<?= $col_w ?>px;"><?= $label ?></div>
<?php endfor; ?>

<?php
// CHAMPION COLUMN
$champ_left = round($margin_x + $total_rounds_display * ($col_w + $col_gap), 1);
$champ_top = round($header_h + $margin_y + $usable_h / 2 - 30, 1);
?>
<div class="round-title" style="top:<?= $header_h ?>px;left:<?= $champ_left ?>px;width:<?= $champ_w ?>px;">CHAMPION</div>
<div class="champ-col" style="top:<?= $champ_top ?>px;left:<?= $champ_left ?>px;width:<?= $champ_w ?>px;">
    <?php if ($tournament['champion_team_id']): ?>
    <div class="champion-icon">🏆</div>
    <div class="champion-name"><?= e($tournament['champion_name']) ?></div>
    <?php else: ?>
    <div style="font-size:7pt;color:#52525b;">Menunggu<br>juara</div>
    <?php endif; ?>
</div>

<?php
// CONNECTION FROM FINAL TO CHAMPION
$final_matches = array_filter($match_positions, fn($p) => $p['r'] == $total_rounds_display);
$final_matches = array_values($final_matches);
if (isset($final_matches[0])):
    $fm = $final_matches[0];
    $f_top = round($fm['top'] + $match_h / 2, 1);
    $f_left = round($fm['left'] + $fm['width'], 1);
    $gap = $champ_left - $f_left - 4;
    echo "<div class='conn-h' style='top:{$f_top}px;left:{$f_left}px;width:{$gap}px;'></div>\n";
endif;
?>

<?php endif; ?>

<div class="footer" style="bottom:0;">
    Generated on <?= date('d M Y H:i') ?> — Tournament Bracket System
</div>

</body>
</html>
