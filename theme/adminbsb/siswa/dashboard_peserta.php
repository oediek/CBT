<?php $this->load->view('siswa/header')?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD PESERTA</h2>
            </div>
            <div class="row clearfix">
                <?php if($this->session->pesan == 'token_gagal'):?>
                    <div class="col-lg-12">
                        <div class="alert alert-danger">
                            Token yang anda masukkan tak dikenali
                        </div>
                    </div>
                <?php endif?>
                <!-- Detail Ujian -->
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                UJIAN TERSEDIA
                                <small>Saat ini terdapat ujian yang siap untuk anda kerjakan dengan rincian sebagai berikut :</small>
                            </h2>
                        </div>
                        <div class="body">
                            <label>Nama Ujian</label>
                            <div class="form-group">
                                <div class="form-line"><input type="text" class="form-control" value="<?=$ujian_nama?>" disabled=""></div>
                            </div>
                            <label>Jenis Ujian</label>
                            <div class="form-group">
                                <div class="form-line"><input type="text" class="form-control" value="<?=jenis_ujian($ujian_jenis)?>" disabled=""></div>
                            </div>
                            <label>Tanggal dan Jam</label>
                            <div class="form-group">
                                <div class="form-line"><input type="text" class="form-control" value="<?=mysqldate_to_str($ujian_mulai)?>" disabled=""></div>
                            </div>
                            <label>Alokasi Waktu</label>
                            <div class="form-group">
                                <div class="form-line"><input type="text" class="form-control" value="<?=$ujian_alokasi?> Menit" disabled=""></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Akhir Detail Ujian -->

                <!-- Ikuti Ujian -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                    <div class="info-box hover-zoom-effect bg-cyan">
                        <div class="icon ">
                            <i class="material-icons">access_alarm</i>
                        </div>
                        <div class="content">
                            <div class="text">WAKTU TERSISA</div>
                            <div class="number info-sisa-waktu">00:00:00</div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="header">
                            <h2>IKUTI UJIAN INI</h2>
                        </div>
                        <div class="body">
                            <form action="<?=site_url('?d=siswa&c=ujian&m=start')?>" method="post">
                                <div class="form">
                                    <label>Token</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="" placeholder="Masukkan Token" required="" name="token">
                                        </div>
                                    </div>
                                    <small class="help-block">
                                        Anda hanya bisa mengikuti ujian ketika masih ada waktu tersisa
                                    </small>
                                    <input type="submit" class="btn btn-primary btn-block btn-ikuti-ujian" value="Ikuti Ujian">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Akhir Ikuti Ujian -->

            </div>
        </div>
    </section>
<?php $this->load->view('siswa/footer')?>
<?php $this->load->view('siswa/js/count_down_timer')?>
