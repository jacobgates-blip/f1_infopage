<?php
// Included at the top of protected pages.
// Ensures only a signed-in Race Control admin can access the page.
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}
