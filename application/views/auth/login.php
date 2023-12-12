<!-- Outer Row -->
<div class="row justify-content-center mt-5 pt-lg-5">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg">
            <div class="card-body p-lg-5 p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center mb-4">
                                <h1 class="h4 text-gray-900">Login</h1>
                                <span class="text-muted">Member</span>
                            </div>
                            <?= $this->session->flashdata('pesan'); ?>
                            <?php echo form_open_multipart('member/login_member'); ?>
                            <div class="form-group">
                                <input autofocus="autofocus" autocomplete="off" value="<?= set_value('nomor'); ?>" type="text" name="nohp" class="form-control form-control-user" placeholder="Masukkan Email">
                                <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Login
                            </button>
                            <div class="text-center mt-4">
                                <h6>Belum Memiliki Email?<a href="<?= base_url(''); ?>">Update Sekarang</a></h6>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>