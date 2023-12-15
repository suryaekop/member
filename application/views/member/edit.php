<?php
    include APPPATH . 'views/fragment/header.php'; 
    include APPPATH . 'views/fragment/sidebar.php' ;
    include APPPATH . 'views/fragment/topbar.php' ;
?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm mb-4 border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Edit Data Member
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('member') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body pb-2">
                <?= $this->session->flashdata('pesan'); ?>
                <?php echo form_open_multipart('member/edit_member'); ?>
                <!-- Tambahkan input hidden untuk menyimpan ID member -->
                
                
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="namamember">Nama Member</label>
                    <div class="col-md-6">
                    <?php if ($member) : ?>
                                <!-- Tampilkan nilai yang akan di-edit -->
                                <input type="hidden" name="id" value="<?= $member->id; ?>">
                        <input type="text" id="namamember" name="namamember" value= "<?= $member->namamember;?>" class="form-control" placeholder="Masukkan Nama Member">
                        <?= form_error('namamember', '<span class="text-danger small">', '</span>'); ?>
                        
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="nomor">Nomor Handphone</label>
                    <div class="col-md-6">
                        <input type="text" id="nomor" name="nomor" class="form-control" placeholder="nomor" value="<?= $member->nomor; ?>" readonly>
                        <?= form_error('nomor', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="alamat">Alamat</label>
                    <div class="col-md-6">
                        <textarea name="alamat" id="alamat" cols="20" rows="10"><?= $member->alamat;?></textarea>
                        <?= form_error('nomor', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="email">Email</label>
                    <div class="col-md-6">
                        <input type="email" id="email" name="email" class="form-control" placeholder="email" value="<?= $member->email; ?>" readonly>
                        <?= form_error('email', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="jeniskelamin">Jenis Kelamin</label>
                    <div class="col-md-6">
                                <select name="jeniskelamin" id="jeniskelamin">
                                        <option value="L" <?php echo ($member->jeniskelamin == 'L') ? 'selected' : ''; ?>>Laki-Laki</option>
                                        <option value="P" <?php echo ($member->jeniskelamin == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="tanggallahir">Tanggal Lahir</label>
                    <div class="col-md-6">
                        <input type="date" id="tanggallahir" name="tanggallahir" class="form-control" placeholder="tanggallahir" value="<?= $member->tanggallahir; ?>">
                        <?= form_error('tanggallahir', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="tempatlahir">Tempat Lahir</label>
                    <div class="col-md-6">
                        <input type="text" id="tempatlahir" name="tempatlahir" class="form-control" placeholder="tempatlahir" value="<?= $member->tempatlahir; ?>">
                        <?= form_error('tempatlahir', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="email">Poin</label>
                    <div class="col-md-6">
                        <input type="text" id="poin" name="poin" class="form-control" placeholder="poin" value="<?= $member->poin; ?>" readonly>
                        <?= form_error('poin', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group justify-content-end">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon"><i class="fa fa-save"></i></span>
                            <span class="text">Update</span>
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            Reset
                        </button>
                    </div>
                </div>
                <?php endif; ?>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<?php
    include APPPATH . 'views/fragment/footer.php'; 
?>