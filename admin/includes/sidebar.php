<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <!-- Dashboard -->
                <li class="<?= (basename($_SERVER['PHP_SELF']) == 'dashboard.php' || basename($_SERVER['PHP_SELF']) == 'dashboard') ? 'active' : '' ?>">
                    <a href="dashboard"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
                </li>
                <li class="list-divider"></li>

                <!-- Registrations -->
                <li class="<?= (basename($_SERVER['PHP_SELF']) == 'registrations.php' || basename($_SERVER['PHP_SELF']) == 'registrations') ? 'active' : '' ?>">
                    <a href="registrations"><i class="fas fa-user-plus"></i> <span>Registrations</span></a>
                </li>

                <!-- Tourguide -->
                <li class="<?= (basename($_SERVER['PHP_SELF']) == 'tourguide.php' || basename($_SERVER['PHP_SELF']) == 'tourguide') ? 'active' : '' ?>">
                    <a href="tourguide"><i class="fas fa-map-signs"></i> <span>Tourguide</span></a>
                </li>

                <!-- Parking -->
                <li class="<?= (basename($_SERVER['PHP_SELF']) == 'parking.php' || basename($_SERVER['PHP_SELF']) == 'parking') ? 'active' : '' ?>">
                    <a href="parking"><i class="fas fa-parking"></i> <span>Parking</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>