<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Form Edit Data Member
                </h4>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?php echo form_open_multipart('member/edit_member'); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="username">Nama Member</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <?php if(isset($member)){
                            foreach($member as $mb => $data){
                                ?>
                                <input type="text" name="namamember" id="namamember" value="<?=$data['namamember']?> ">
                                <?php
                            }
                        }
                        ?>
                        </div>
                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="username">Nomor Handphone</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <?php if(isset($member)){
                            foreach($member as $mb => $data){
                                ?>
                                <input type="text" name="nomor" id="nomor" value="<?=$data['nomor']?>" readonly>
                                <?php
                            }
                        }
                        ?>
                        </div>
                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="username">Email</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <?php if(isset($member)){
                            foreach($member as $mb => $data){
                                ?>
                                <input type="text" name="email" id="email" value="<?=$data['email']?>" placeholder="Masukkan Email">
                                <?php
                            }
                        }
                        ?>
                        </div>
                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="username">Alamat</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <?php if(isset($member)){
                            foreach($member as $mb => $data){
                                ?>
                                <textarea name="alamat" id="alamat" cols="20" rows="10"></textarea>
                                <?php
                            }
                        }
                        ?>
                        </div>
                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="username">Jenis Kelamin</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <?php if(isset($member)){
                            foreach($member as $mb => $data){
                                ?>
                            <select name="jeniskelamin" id="jeniskelamin">
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                                <?php
                            }
                        }
                        ?>
                        </div>
                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="username">Tempat Lahir</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <?php if(isset($member)){
                            foreach($member as $mb => $data){
                                ?>
                                <input type="text" name="tempatlahir" id="tempatlahir" value="<?=$data['tempatlahir']?>" placeholder="Masukkan Tempat Lahir">
                                <?php
                            }
                        }
                        ?>
                        </div>
                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="username">Tanggal Lahir</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <?php if(isset($member)){
                            foreach($member as $mb => $data){
                                ?>
                                <input type="date" name="tanggallahir" id="tanggallahir">
                                <?php
                            }
                        }
                        ?>
                        </div>
                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="username">Poin</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <?php if(isset($member)){
                            foreach($member as $mb => $data){
                                ?>
                                <input type="text" name="poin" id="poin" value="<?=$data['poin']?>" readonly>
                                <?php
                            }
                        }
                        ?>
                        </div>
                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>