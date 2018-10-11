<?php $this->load->view('proktor/header')?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>ALAT BACKUP SISTEM
                    <small>
                        Fasilitas pencadangan sistem
                    </small>
                </h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                AKSI PENCADANGAN SISTEM
                                <small>Baca dengan seksama, petunjuk pencadangan</small>
                            </h2>
                        </div>
                        <div class="body">
							<p>Pencadangan dapat dilakukan dengan cara yang cukup sederhana, cukup klik tombol cadangkan sistem, sistem akan secara otomatis melakukan pencadangan pada komputer lokal anda. Data yang dicadangkan meliputi : data ujian, peserta, soal, media (gambar maupun video) sekaligus jawaban yang pernah dimasukkan oleh peserta</p>
							<button class="btn btn-primary waves-effect btn-cadang">CADANGKAN SISTEM</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $this->load->view('proktor/footer')?>

<script>
    $(function(){
        $(document).on('click', '.btn-cadang', function(){
            document.location.href="<?=site_url('d=proktor&c=alat&m=do_backup')?>";
        });
    });
</script>
