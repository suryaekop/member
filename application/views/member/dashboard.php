<?php
    include APPPATH . 'views/fragment/header.php'; 
    include APPPATH . 'views/fragment/sidebar.php' ;
    include APPPATH . 'views/fragment/topbar.php' ;
?>
<h1 align="center">Selamat Datang</h1>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm mb-4 border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                    <?php if ($member): ?>
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Member <?= $member->namamember ?>
                        </h4>
                        <?php endif; ?>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('member/edit'); ?>" class="btn btn-sm btn-primary btn-icon-split">
                        <span class="icon">
                        <i class="fa fa-user-plus"></i>
                        </span>
                            <span class="text">
                                Update Member
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <img src="<?= base_url() . '/fotouser/' . $member->foto; ?>" alt="User Cw" width="150" height="150">
                <br>
                <br>
                <table>
                <?php if ($member): ?>
                    <tr>
                        <td>Nama Member</td>
                        <td>:</td>
                        <td><strong><?= $member->namamember ?></strong></td>
                    </tr>
                    <tr>
                        <td>Nomor Telepon</td>
                        <td>:</td>
                        <td><strong><?= $member->nomor ?></strong></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><strong><?= $member->alamat ?></strong></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><strong><?= $member->email ?></strong></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td><strong><?= $member->jeniskelamin ?></strong></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td><strong><?= $member->tanggallahir ?></strong></td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <td>:</td>
                        <td><strong><?= $member->tempatlahir ?></strong></td>
                    </tr>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
    include APPPATH . 'views/fragment/footer.php'; 
?>