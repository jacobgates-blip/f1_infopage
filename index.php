<?php
// Reuse your existing connection method
require('includes/conn_1dt.php');

// 1. Fetch the most recent race based on the date
$raceStmt = $pdo->query("SELECT * FROM races ORDER BY race_date DESC LIMIT 1");
$latestRace = $raceStmt->fetch();

// 2. If a race exists, fetch all results for it, ordered by position
if ($latestRace) {
    $resultsStmt = $pdo->prepare("SELECT * FROM results WHERE race_id = :race_id ORDER BY position ASC");
    $resultsStmt->execute([':race_id' => $latestRace['id']]);
    $results = $resultsStmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>F1 Dynamic Results</title>
    <link rel="stylesheet" href="css/f1_style.css">
</head>
<body>

<div class="container">
    <?php if (!$latestRace): ?>
        <div class="race-header">
            <h1>No Race Data Available</h1>
        </div>
    <?php else: ?>
        <!-- Dynamic Race Header -->
        <header class="race-header">
            <span class="race-date">
                Round <?= htmlspecialchars($latestRace['round_number']) ?> • 
                <?= date('d M Y', strtotime($latestRace['race_date'])) ?>
            </span>
            <h1><?= htmlspecialchars($latestRace['race_name']) ?></h1>
            <p class="team"><?= htmlspecialchars($latestRace['circuit_name']) ?></p>
        </header>

        <!-- Dynamic Results List -->
        <main class="results-grid">
            <?php foreach ($results as $result): ?>
                <div class="result-row">
                    <div class="position">
                        <?= htmlspecialchars($result['position']) ?>
                    </div>
                    <div class="driver">
                        <?= htmlspecialchars($result['driver_name']) ?>
                    </div>
                    <div class="team">
                        <?= htmlspecialchars($result['team_name']) ?>
                    </div>
                    <div class="points">
                        <?= htmlspecialchars($result['points']) ?> PTS
                    </div>
                </div>
            <?php endforeach; ?>
        </main>
    <?php endif; ?>
</div>

</body>
</html>
