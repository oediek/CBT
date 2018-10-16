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

            <?php if(!empty($this->session->pesan)):?>
                <?=$this->session->pesan?>
            <?php endif?>

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

							<form action="?d=proktor&c=alat&m=do_restore" method="post" enctype="multipart/form-data" id="frm-restore">
                                <label>Arsip pencadangan</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" name="arsip" class="form-control">
                                    </div>
                                    <small class="help-block">Pilih salah satu arsip pencadangan yang pernah anda buat</small>
                                </div>
                                <button type="button" class="btn btn-primary waves-effect btn-restore">PULIHKAN SISTEM</button>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $this->load->view('proktor/footer')?>
<script>
$(function(){
    $('.btn-restore').on('click', function(){
        swal({
            title: "Anda yakin ?",
            text: "Seluruh data ujian dan peserta akan hilang dan dikondisikan seperti data pemulihan, anda yakin ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Saya yakin",
            cancelButtonText: "Tidak",
            closeOnConfirm: true
        },function(isRestore){
            if(isRestore){
                console.log('proses reset');
                $('#frm-restore').trigger('submit');
            }
        });
    });
})
 
</script>