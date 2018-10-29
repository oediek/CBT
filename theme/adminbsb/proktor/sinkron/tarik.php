<?php $this->load->view('proktor/header')?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Sinkronisasi
                    <small>
                        Fasilitas sinkronisasi data dengan server lain
                    </small>
                </h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                TARIK DATA
                                <small>Tarik data dari server</small>
                            </h2>
                        </div>
                        <div class="body loader">

                           <div class="alert alert-warning">
                                <strong>Peringatan!</strong> Penarikan data akan menyebabkan seluruh data ujian pada server lokal sama persis dengan data ujian pada server remote.
                            </div>
							<p>Penarikan data merupakan tindakan sinkronisasi data ujian server lokal dengan server remote.</p>

                            <form method="post" id="frm-sinkron">
                        		<label>Alamat server remote</label>
	                            <div class="form-group">
	                                <div class="form-line">
	                                	<input type="text" class="form-control" name="server_remote" placeholder="http://server-remote" value=""" required="">
	                                </div>
	                            </div>
                                <label>ID server lokal</label>
	                            <div class="form-group">
	                                <div class="form-line">
	                                	<input type="text" class="form-control" name="id_server" placeholder="ID pada server lokal, misal : smp1" value=""" required="">
	                                </div>
	                            </div>
	                            <button type="submit" class="btn btn-primary waves-effect btn-sinkron">SIMPAN</button>	
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
        $('#frm-sinkron').on('submit', function(evt){
            evt.preventDefault();
            var frm = $(this);
            swal({
                title: "Anda yakin ?",
                text: "Penarikan data akan menyebabkan seluruh data ujian pada server lokal sama persis dengan data ujian pada server remote. anda yakin ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, Tindas data server lokal",
                cancelButtonText: "Tidak",
                closeOnConfirm: true                
            },function(tindas){
                if(tindas){
                    var action = '<?=site_url("?d=proktor&c=sinkron&m=do_tarik")?>';
                    var data = frm.serialize();
                    $('.loader').waitMe({text: 'Sinkronisasi server lokal dengan remote, mohon tunggu ... => (1/2)'});
                    $.post(action, data, function(hasil){
                        // console.log(hasil);
                        if(hasil.pesan == 'konek_gagal'){
                            swal({
                                title: "Koneksi gagal",
                                text: "Koneksi server lokal dengan server remote gagal",
                                type: "warning"
                            });
                            $('.loader').waitMe('hide');
                            return;
                        }else if(hasil.pesan == 'token_gagal'){
                            swal({
                                title: "Token gagal",
                                text: "Token server lokal tak dikenali atau server remote tidak tepat sasaran, mohon periksa kembali",
                                type: "warning"
                            });
                            $('.loader').waitMe('hide');
                            return;
                        }
                        $('.loader').waitMe({text: 'Pemasangan data sinkronisasi, mohon tunggu ... => (2/2)'});
                        $.get('<?=site_url("?d=proktor&c=sinkron&m=do_restore&arsip_sinkron=")?>' + hasil.arsip_sinkron, function(hasil){
                            if(hasil.pesan == 'ok'){
                                $('.loader').waitMe('hide');
                            }
                        });
                    });
                }
            });

            
        });
    });
</script>