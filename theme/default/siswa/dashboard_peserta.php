<?php $this->load->view('siswa/header')?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php if($this->session->pesan == 'token_gagal'):?>
            <div class="col-lg-12">
                <div class="alert alert-danger">
                    Token yang anda masukkan tak dikenali
                </div>
            </div>
            <?php else:?>
            <div style="height:30px;"></div>
            <?php endif?>
        </div>
    </div>
    <form method="POST" id="form_mulai" action="<?=site_url('?d=siswa&c=ujian&m=start')?>">
        <div class="row">
            <div class="col-md-8">
                <div id="loginbox" class="konfirm konfirm2">
                    <div id="logintitle">
                        <p>Konfirmasi Test</p>
                    </div>
                    <div id="loginbody">
                        <input type="hidden" name="mapel" id="mapel" value="ZZZZ">
                        <input type="hidden" name="userid" id="userid" value="zz">
                        <div class="datasiswa">
                            <p class="bold">Nama Test</p>
                            <p><?=$ujian_nama?></p>
                        </div>
                        <?php
                        $tgl_waktu = mysqldate_to_str($ujian_mulai);
                        $tgl_waktu = explode(',', $tgl_waktu);
                        ?>
                        <div class="datasiswa">
                            <p class="bold">Tanggal Test</p>
                            <p><?=$tgl_waktu[0]?></p>
                        </div>
                        <div class="datasiswa">
                            <p class="bold">Waktu Test</p>
                            <p><?=$tgl_waktu[1]?></p>
                        </div>
                        <div class="datasiswa">
                            <p class="bold">Alokasi Waktu Test</p>
                            <p><?=$ujian_alokasi?> menit</p>
                        </div>
                        <div class="datasiswa">
                            <p class="bold">Token</p>
                            <p><input type="text" name="token" id="token" placeholder="masukan token" required></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <input type="hidden" name="step" value="3">
                <p class="bg-warning warn"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;TOMBOL MULAI hanya akan aktif apabila waktu sekarang sudah melewati waktu mulai test. Tekan tombol F5 untuk merefresh halaman</p>
                <input id="mulai" type="submit" class="btn-danger" value="MULAI">
            </div>
        </div>
    </form>
    
</div>

<?php $this->load->view('siswa/footer')?>