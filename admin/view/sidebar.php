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
        if($page == 2 || $page == 3 || $page == 4){
            echo 'active';
        }
        ?>
    ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-database"></i>
            <span>Data Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item 
                <?php
                    echo $var = $page == 2 ? 'active' : '';
                ?>
                " href="dataPegawai.php">Data Pegawai</a>
                <a class="collapse-item
                    <?php
                        echo $var = $page == 3 ? 'active' : '';
                    ?>
                " href="dataPelaporan.php">Data Pelaporan Kegiatan</a>
                </div>
        </div>
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