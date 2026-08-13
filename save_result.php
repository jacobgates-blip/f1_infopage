<?php
session_start();
require('includes/auth_check.php');
require('includes/conn_1dt.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: add_result.php');
    exit;
}

$race_id = (int)($_POST['race_id'] ?? 0);
$driver  = trim($_POST['driver_name'] ?? '');
$team    = trim($_POST['team_name'] ?? '');
$pos     = (int)($_POST['position'] ?? 0);
$points  = (int)($_POST['points'] ?? -1);

$errors = [];

if ($driver === '') $errors[] = 'Driver name is required.';
if ($team === '') $errors[] = 'Team name is required.';
if ($pos < 1 || $pos > 20) $errors[] = 'Position must be between 1 and 20.';
if ($points < 0 || $points > 26) $errors[] = 'Points must be between 0 and 26.';

if ($errors) {
    $_SESSION['result_errors'] = $errors;
    $_SESSION['result_old']    = ['driver_name' => $driver, 'team_name' => $team, 'position' => $pos, 'points' => $points];
    header('Location: add_result.php');
    exit;
}

$sql = "INSERT INTO results (race_id, driver_name, team_name, position, points, logged_by)
        VALUES (:race_id, :driver, :team, :pos, :points, :logged_by)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':race_id'   => $race_id,
    ':driver'    => $driver,
    ':team'      => $team,
    ':pos'       => $pos,
    ':points'    => $points,
    ':logged_by' => $_SESSION['id']
]);

header('Location: manage_results.php?logged=1');
exit;
