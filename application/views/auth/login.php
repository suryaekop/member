<!-- Outer Row -->
<div class="row justify-content-center mt-5 pt-lg-5">
    <div class="col-xl-10 col-lg-12 col-md-10">
    <div class="card border-0 w-100 h-100 bg-transparent">
            <div class="card-body p-lg-5 p-0">
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center mb-4">
                                <h1 class="h3 text-white" style="font-family: 'Noto Sans JP';">Login</h1>
                                <span class="h4 text-white" style="font-family: 'Noto Sans JP';">Member</span>
                            </div>
                            <?= $this->session->flashdata('pesan'); ?>
                            <?php if (!empty($error)) : ?>
                             <div class="alert alert-danger" role="alert">
                                <?= $error ?>
                                </div>
                            <?php endif; ?>
                            <?php echo form_open_multipart('member/login_member'); ?>
                            <div class="form-group">
                                <input autofocus="autofocus" value="<?= set_value('email'); ?>" type="email" name="email" class="form-control form-control-user" placeholder="Masukkan Email">
                                <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Login
                            </button>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>