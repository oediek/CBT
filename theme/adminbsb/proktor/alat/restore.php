<?php $this->load->view('proktor/header')?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>ALAT PEMULIHAN SISTEM
                    <small>
                        Fasilitas pemulihan sistem
                    </small>
                </h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                AKSI PEMULIHAN SISTEM
                                <small>Baca dengan seksama, petunjuk pemulihan</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="alert alert-warning">
                                <strong>Peringatan!</strong> Pemulihan akan mengganti seluruh kondisi sistem terkini menjadi sama persis dengan kondisi ketika dilakukan pencadangan .
                            </div>
							<p>Pemulihan merupakan tindakan pengembalian kondisi sistem agar sama persis dengan kondisi ketika dilakukan pencadangan. Oleh sebab itu, tindakan pemulihan hanya dapat dilakukan ketika kita pernah melakukan pencadangan dan memiliki arsip pencadangan pada komputer lokal. Pilih salah satu arsip pencadangan sesuai dengan kebutuhan.</p>

							<form action="" method="post" enctype="multipart/form-data">
                                <label>Arsip pencadangan</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" name="arsip" class="form-control">
                                    </div>
                                    <small class="help-block">Pilih salah satu arsip pencadangan yang pernah anda buat</small>
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect">PULIHKAN SISTEM</button>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $this->load->view('proktor/footer')?>
