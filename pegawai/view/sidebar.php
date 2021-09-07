<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">
<!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
        <i class="far fa-folder-open 2x"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Pelaropan Kegiatan</div>
    </a>
<!-- Divider -->
    <hr class="sidebar-divider my-0">
<!-- Nav Item - Dashboard -->
    <li class="nav-item
        <?php
        echo $var = $page == 1 ? 'active' : '';
        ?>
    ">
        <a class="nav-link" href="index.php">
            <i class="fas fa-home"></i>
            <span>Beranda</span></a>
    </li>
<!-- Divider -->
    <hr class="sidebar-divider my-0">
<!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item
        <?php
        echo $var = $page == 3 ? 'active' : '';
        ?>
    ">
        <a class="nav-link" href="dataPelaporan.php">
            <i class="fas fa-database"></i>
            <span>Data Pelaporan Kegiatan</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">
<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->