<?php
//mendapatkan uri segment (divisi,karyawan,users) utk css active pada menu
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
$folder = $uri_segments[3];
if(count($uri_segments) >3){
    $folder = $uri_segments[3];
}
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">SimPB</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
				<?php
				if($this->ion_auth->is_admin()){
					$user = $this->ion_auth->user()->row();
				?>
            <li <?= $folder == 'welcome' ? 'class="active"' : '' ?>><a href="<?= base_url() ?>welcome">Pencarian <span class="sr-only">(current)</span></a></li>
                <li <?= $folder == 'buku' ? 'class="active"' : '' ?>><a href="<?= base_url() ?>buku">Buku</a></li>
                <li <?= $folder == 'kategori' ? 'class="active"' : '' ?>><a href="<?= base_url() ?>kategori">Kategori</a></li>
                <li <?= $folder == 'auth' ? 'class="active"' : '' ?>><a href="<?= base_url() ?>auth">User</a></li>
				<li <?= $folder == 'auth' ? 'class="active"' : '' ?>><a href="<?= base_url() ?>auth/logout" onclick="return confirm('Yakin Akan Logout')">Logout (<?= $user->email ?>)</a></li>
           <?php
				} else{
		   ?>
			<li <?= $folder == 'search' ? 'class="active"' : '' ?>><a href="<?= base_url() ?>welcome">Pencarian <span class="sr-only">(current)</span></a></li>
			<li <?= $folder == 'karyawan' ? 'class="active"' : '' ?>><a href="<?= base_url() ?>auth/login">Login</a></li>
			<?php
				}
			?>
			</ul>
        </div>
    </div>
</nav>
