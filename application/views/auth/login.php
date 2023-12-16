<div class="row justify-content-center mt-3 pt-lg-5">
    <div class="col-xl-6 col-lg-6 col-md-0">
        <div class="card border-0" style="height: 500px; background-color: rgba(255, 255, 255, 0);">
            <div class="card-body p-lg-5 p-3 shadow-lm">
                <div class="row">
                    <!-- Menambahkan gambar di sini -->
                    <div class="col-lg-12 text-center mb-4">
                        <img src="<?= base_url('assets/img1/logo.png')?>" alt="Your Image Alt Text" style="max-width: 100%; max-height: 200px;">
                    </div>

                    <div class="col-lg-12 text-center mb-4">
                        <h1 class="h3" style="font-family: 'Noto Sans JP'; color: black;">LOGIN MEMBER</h1>
                    </div>

                    <?= $this->session->flashdata('pesan'); ?>
                    <?php if (!empty($error)) : ?>
                        <div class="col-lg-12">
                            <div class="alert alert-danger" role="alert">
                                <?= $error ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="col-lg-12">
                        <?php echo form_open_multipart('member/login_member'); ?>
                        <div class="form-group">
                            <input autofocus="autofocus" value="<?= set_value('email'); ?>" type="email" name="email" class="form-control form-control-user" placeholder="Masukkan Email">
                            <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Login
                        </button>
                        <div class="text-center mt-4">
                                <a class="small" style="color: black; font-size: 14pt; font-weight: bold;" href="<?= base_url('member') ?>">Login Via WhatsApp</a>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
