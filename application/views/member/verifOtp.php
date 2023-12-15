<!-- Outer Row -->
<div class="row justify-content-center mt-5 pt-lg-5">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card border-0 w-100 h-100 bg-transparent">
            <div class="card-body p-lg-5 p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center mb-4">
                                <h1 class="h4 text-gray-900">Verify OTP</h1>
                                <span class="text-muted">Member Email</span>
                            </div>
                            <?php if (!empty($error)) : ?>
                             <div class="alert alert-danger" role="alert">
                                <?= $error ?>
                                </div>
                            <?php endif; ?>
                            <?php echo form_open_multipart('member/proses_verify'); ?>
                            <div class="form-group">
                                <input autofocus="autofocus" autocomplete="off" value="<?= set_value('otp'); ?>" type="text" name="otp" class="form-control form-control-user" placeholder="Masukkan Kode OTP">
                                <?= form_error('otp', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Login To System
                            </button>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>