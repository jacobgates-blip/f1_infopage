<?php
session_start();
require('includes/auth_check.php');
require('includes/conn_1dt.php');

$id = (int) ($_GET['id'] ?? 0);

if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM results WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header('Location: manage_results.php?deleted=1');
exit;
