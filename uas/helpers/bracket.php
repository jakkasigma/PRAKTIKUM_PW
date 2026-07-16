<?php
function generateBracket($conn, $tournament_id, $team_ids, $max_teams = null) {
    $n = count($team_ids);
    if ($max_teams) {
        $slot = intval($max_teams);
    } else {
        $slot = nextPowerOfTwo($n);
    }
    $bye = $slot - $n;
    $rounds = log($slot, 2);

    shuffle($team_ids);

    $participants = $team_ids;
    for ($i = 0; $i < $bye; $i++) {
        $participants[] = null;
    }

    $current_round = $participants;

    for ($round = 1; $round <= $rounds; $round++) {
        $matches_in_round = count($current_round) / 2;
        $next_round = [];
        $match_order = 0;

        for ($m = 0; $m < $matches_in_round; $m++) {
            $match_order++;
            $team1 = $current_round[$m * 2];
            $team2 = $current_round[$m * 2 + 1];
            $is_bye = ($round == 1 && ($team1 === null || $team2 === null));

            $team1_id = $team1 !== null ? $team1 : 'NULL';
            $team2_id = $team2 !== null ? $team2 : 'NULL';
            $is_bye_val = $is_bye ? 1 : 0;

            $query = "INSERT INTO matches (tournament_id, round, match_order, team1_id, team2_id, is_bye, status)
                      VALUES ($tournament_id, $round, $match_order, $team1_id, $team2_id, $is_bye_val, 'pending')";

            if ($is_bye) {
                $winner = $team1 ?? $team2;
                $winner_id = $winner !== null ? $winner : 'NULL';
                $query = "INSERT INTO matches (tournament_id, round, match_order, team1_id, team2_id, is_bye, status, winner_id)
                          VALUES ($tournament_id, $round, $match_order, $team1_id, $team2_id, $is_bye_val, 'completed', $winner_id)";
                $next_round[] = $winner;
            } else {
                $next_round[] = null;
            }

            mysqli_query($conn, $query);
        }

        $current_round = $next_round;
    }

    return true;
}

function autoAdvanceWinner($conn, $match_id) {
    $query = "SELECT m.*, t.total_rounds
              FROM matches m
              JOIN (SELECT tournament_id, MAX(round) as total_rounds FROM matches GROUP BY tournament_id) t
              ON m.tournament_id = t.tournament_id
              WHERE m.id = $match_id";
    $result = mysqli_query($conn, $query);
    $match = mysqli_fetch_assoc($result);

    if (!$match || !$match['winner_id']) return false;

    if ($match['round'] == $match['total_rounds']) {
        $query = "UPDATE tournaments SET champion_team_id = {$match['winner_id']}, status = 'completed'
                  WHERE id = {$match['tournament_id']}";
        mysqli_query($conn, $query);
        return true;
    }

    $next_round = $match['round'] + 1;
    $next_match_order = ceil($match['match_order'] / 2);

    $query = "SELECT id, team1_id, team2_id FROM matches
              WHERE tournament_id = {$match['tournament_id']}
              AND round = $next_round
              AND match_order = $next_match_order";
    $result = mysqli_query($conn, $query);
    $next_match = mysqli_fetch_assoc($result);

    if (!$next_match) return false;

    $winner_id = $match['winner_id'];
    $next_id = $next_match['id'];

    if ($next_match['team1_id'] === null) {
        $col = 'team1_id';
    } elseif ($next_match['team2_id'] === null) {
        $col = 'team2_id';
    } else {
        return false;
    }

    $query = "UPDATE matches SET $col = $winner_id WHERE id = $next_id";
    mysqli_query($conn, $query);

    return true;
}

function resetBracket($conn, $tournament_id) {
    $query = "DELETE FROM matches WHERE tournament_id = $tournament_id";
    mysqli_query($conn, $query);

    $query = "UPDATE tournaments SET champion_team_id = NULL, status = 'draft' WHERE id = $tournament_id";
    mysqli_query($conn, $query);

    return true;
}
