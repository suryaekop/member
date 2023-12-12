
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SIPB</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Administrator
            </div>
            <?php
				if($this->ion_auth->is_admin()){
					$user = $this->ion_auth->user()->row();
				?>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>welcome">
                    <i class="fas fa-search"></i>
                    <span>Pencarian Judul</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>welcome/cari_kategori">
                    <i class="fas fa-search"></i>
                    <span>Pencarian Kategori</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data
            </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>buku">
                    <i class="fas fa-book"></i>
                    <span>Buku</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>kategori">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Kategori</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>auth">
                    <i class="fas fa-user"></i>
                    <span>User</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Proses
            </div>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>auth/logout">
                <i class="fas fa-sign-out-alt fa-sm fa-fw "></i>
                    <span>Logout</span></a>
            </li>
            <?php }else{ ?>
                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>welcome">
                    <i class="fas fa-search"></i>
                    <span>Pencarian Judul</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>welcome/cari_kategori">
                    <i class="fas fa-search"></i>
                    <span>Pencarian Kategori</span></a>
            </li>
                <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>auth/logout">
                <i class="fas fa-sign-out-alt fa-sm fa-fw "></i>
                    <span>Logout</span></a>
            </li>
            <?php } ?>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
