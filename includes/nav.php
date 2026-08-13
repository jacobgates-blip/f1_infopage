<!-- Start of Nav bar -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1f1f27; border-bottom: 3px solid #e10600;">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-uppercase" href="index.php" style="letter-spacing: 1px;">
            <i class="fa-solid fa-flag-checkered me-2" style="color: #e10600;"></i>F1 Dashboard
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto text-uppercase fw-bold" style="font-size: 0.9rem;">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Race Results</a>
                </li>
                <?php if (isset($_SESSION['id'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="manage_results.php">Manage Results</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_result.php">Log Result</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php">Log out</a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php" style="color: #e10600;">Race Control Login</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
