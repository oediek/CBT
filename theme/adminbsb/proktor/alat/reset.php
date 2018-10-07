<?php $this->load->view('proktor/header')?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>ALAT RESET SISTEM
                    <small>
                        Fasilitas reset sistem
                    </small>
                </h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                AKSI RESET SISTEM
                                <small>Baca dengan seksama, petunjuk dan dampak tindakan ini !</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="alert alert-warning">
                                <strong>Peringatan!</strong> Tindakan ini akan menyebabkan seluruh data ujian dan peserta menjadi kosong.
                            </div>
							<p>Reset merupakan tindakan pengosongan sistem ujian. Seluruh data ujian, soal, peserta maupun jawaban akan menjadi kosong. Lakukan tindakan ini hanya jika anda yakin ingin mengosongkan seluruh data.</p>
							<button class="btn btn-primary waves-effect">RESET SISTEM</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $this->load->view('proktor/footer')?>
