<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">Dashboard Admin</span>
    </a>
    <div class="sidebar">
        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['nama_user']; ?></a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="manage_users.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage_users.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Kelola Pengguna</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="data_pkl.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'data_pkl.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>Data PKL</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="reports.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'reports.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>Laporan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
