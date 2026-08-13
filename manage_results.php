<?php
session_start();
require('includes/auth_check.php');
require('includes/conn_1dt.php');

$page_title = "Manage Results | F1 Admin";

// Join results with admins and races
$stmt = $pdo->query(
    "SELECT results.*, admins.firstname AS logged_by_name, races.race_name 
     FROM results
     LEFT JOIN admins ON results.logged_by = admins.id
     LEFT JOIN races ON results.race_id = races.id
     ORDER BY races.round_number DESC, results.position ASC"
);
$results = $stmt->fetchAll();

include('includes/header.php');
include('includes/nav.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <h1 class="pt-5 pb-4" style="text-transform: uppercase; font-weight: 900;">Manage Results</h1>

            <?php if (isset($_GET['logged'])): ?><div class="alert alert-success">Result securely logged.</div><?php endif; ?>
            <?php if (isset($_GET['deleted'])): ?><div class="alert alert-warning">Result removed from database.</div><?php endif; ?>

            <table class="table table-dark table-hover table-striped">
                <thead style="border-bottom: 3px solid #e10600;">
                    <tr>
                        <th>Pos</th>
                        <th>Driver</th>
                        <th>Constructor</th>
                        <th>Race</th>
                        <th>Pts</th>
                        <th>Logged By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($row['position']) ?></strong></td>
                            <td><?= htmlspecialchars($row['driver_name']) ?></td>
                            <td class="text-muted"><?= htmlspecialchars($row['team_name']) ?></td>
                            <td><?= htmlspecialchars($row['race_name']) ?></td>
                            <td style="color: #e10600; font-weight: bold;"><?= htmlspecialchars($row['points']) ?></td>
                            <td><?= htmlspecialchars($row['logged_by_name'] ?? 'System') ?></td>
                            <td>
                                <a href="delete_result.php?id=<?= (int)$row['id'] ?>"
                                   onclick="return confirm('Delete <?= htmlspecialchars($row['driver_name']) ?>\'s result? This impacts championship standings.');">
                                    <button type="button" class="btn btn-outline-danger btn-sm">Disqualify (Delete)</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-1"></div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
