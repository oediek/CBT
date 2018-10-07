<?php $this->load->view('siswa/header') ?>
<main class="main-content bgc-grey-100">
   <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <h4 class="c-grey-900 mB-20">Ujian yang tersedia</h4>
                    <form action="">
                        <div class="form-group">
                            <label>Nama ujian</label>
                            <input type="text" disabled="" value="Bahasa Indonesia" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Jenis ujian</label>
                            <input type="text" disabled="" value="Ulangan Harian" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tanggal dan jam ujian</label>
                            <input type="text" disabled="" value="14 Agustus 2018, 07:00" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Alokasi waktu</label>
                            <input type="text" disabled="" value="120 menit" class="form-control">
                        </div>  
                        <div class="form-group">
                            <label>Sisa waktu</label>
                            <input type="text" disabled="" value="Ujian belum berlangsung" class="form-control">
                        </div>                                  
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <h4 class="c-grey-900 mB-20">Ikuti ujian ini</h4>
                    <form action="">
                        <div class="form-group">
                            <label>Token</label>
                            <input type="text" placeholder="Token" class="form-control">
                            <small id="emailHelp" class="form-text text-muted">Masukkan token untuk mengikuti ujian.</small>
                        </div>
                        <input type="submit" value="Ikuti ujian ini" class="btn btn-primary btn-block">
                    </form>
                </div>
            </div>  
        </div>
   </div>
</main>
<?php $this->load->view('siswa/footer') ?>
<?php $this->load->view('siswa/js/dashboard_peserta') ?>
