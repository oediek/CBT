<?php $this->load->view('proktor/header')?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>SUNTING PROFIL
                    <small>
                        Fasilitas penyuntingan profil
                    </small>
                </h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                SUNTING PROFIL SAYA
                                <small>Edit detail profil saya</small>
                            </h2>
                        </div>
                        <div class="body">
							<form action="" method="post">
                                <label>Nama Lengkap</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nama" value="" placeholder="Nama lengkap" required="">
                                    </div>
                                </div>
                                <label>Alamat Surel</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="email" class="form-control" name="email" value="" placeholder="Alamat surat elektronik">
                                    </div>
                                </div>
                                <label>Password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="email" value="">
                                    </div>
                                    <small class="help-block">Biarkan kosong jika tak ingin mengganti password</small>
                                </div>
                                <label>Konfirmasi Password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password2" class="form-control" name="email" value="">
                                    </div>
                                    <small class="help-block">Ketik ulang password</small>
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect">SIMPAN</button>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $this->load->view('proktor/footer')?>
