<?php
session_start();
require('includes/auth_check.php');
$page_title = "Log Race Result | F1 Admin";

$errors = $_SESSION['result_errors'] ?? [];
$old    = $_SESSION['result_old'] ?? [];
unset($_SESSION['result_errors'], $_SESSION['result_old']);

include('includes/header.php');
include('includes/nav.php');
?>
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h2 class="pt-5" style="color: #e10600; text-transform: uppercase;">Log Driver Result</h2>

            <?php if ($errors): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <form action="save_result.php" method="POST" class="p-4 rounded" style="background-color: #1f1f27; color: #fff;">
                <!-- Hardcoded race_id for simplicity, could be a dropdown -->
                <input type="hidden" name="race_id" value="1"> 
                
                <div class="mb-3">
                    <label for="driver_name" class="form-label">Driver Name</label>
                    <input type="text" class="form-control" id="driver_name" name="driver_name"
                           value="<?= htmlspecialchars($old['driver_name'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label for="team_name" class="form-label">Constructor / Team</label>
                    <input type="text" class="form-control" id="team_name" name="team_name"
                           value="<?= htmlspecialchars($old['team_name'] ?? '') ?>">
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="position" class="form-label">Finishing Position</label>
                        <input type="number" class="form-control" id="position" name="position" min="1" max="20"
                               value="<?= htmlspecialchars($old['position'] ?? '') ?>">
                    </div>
                    <div class="col">
                        <label for="points" class="form-label">Points Awarded</label>
                        <input type="number" class="form-control" id="points" name="points" min="0" max="26"
                               value="<?= htmlspecialchars($old['points'] ?? '') ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-danger w-100 fw-bold">SAVE RESULT</button>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
