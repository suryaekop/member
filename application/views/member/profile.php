<?php
    include APPPATH . 'views/fragment/header.php'; 
    include APPPATH . 'views/fragment/sidebar.php' ;
    include APPPATH . 'views/fragment/topbar.php' ;
?>
<?php if ($member): ?>
<h1 align="center">Selamat Datang <?= $member->namamember ;?></h1>
<?php endif; ?>
<div class="row justify-content-center mt-1 pt-lg-5">
    <div class="col-xl-7 col-lg-7 col-md-10">
    <div class="card border-0 w-100 h-100 bg-white">
            <div class="card-body p-lg-3 p-0">
                <div class="row align-items-left">
                    <div class="col-6 mb-3 mb-md-1">
                    <img src="<?= base_url() . '/fotouser/' . $member->foto; ?>" alt="User Cw" class="img-fluid"  width="200" height="200">
                    </div>
                    <div class="col-6">
                        <div class="p-1">
                            <div class="text-left">
                                <table style="padding :10px;">
                                <?php if ($member): ?>
                                    <tr style="font-size: 16pt; ">
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td><?= $member->namamember ?></td>
                                    </tr>
                                    <tr style="font-size: 16pt;">
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td><?= $member->alamat ?></td>
                                    </tr>
                                    <tr style="font-size: 16pt;">
                                        <td>Saldo</td>
                                        <td>:</td>
                                        <td><?= $member->saldo ?></td>
                                    </tr>
                                    <tr style="font-size: 16pt;">
                                        <td>Total Poin</td>
                                        <td>:</td>
                                        <td><strong><?= $member->poin ?></strong></td>
                                    </tr>
                                </table>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    include APPPATH . 'views/fragment/footer.php'; 
?>