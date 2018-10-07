<?php $this->load->view('proktor/header')?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>TOKEN UJIAN
                    <small>Karakter acak untuk mengikuti ujian</small>
                </h2>
            </div>

            <div class="row clearfix">

				<?php if(isset(($this->session->pesan))): ?>
					<?php if($this->session->pesan == 'sukses'): ?>
					  <div class="alert alert-success">Data sekolah telah diupdate</div>
					<?php endif?>
					<?php if($this->session->pesan == 'gagal_upload'): ?>
					  <div class="alert alert-warning">
					  	Gagal mengunggah logo, pastikan logo memenuhi kriteria berikut :
					  	<ol>
					  		<li>Tipe berkas : jpg, png atau gif</li>
					  		<li>Kapasitas berkas tidak melebihi 512 KB</li>
					  	</ol>
					  </div>
					<?php endif?>
				<?php endif?>

            	<div class="col-lg-12">
                    <div class="card loader">
                        <div class="header">
                            <h2>
                                TOKEN
                                <small>Pembangkitan Token</small>
                            </h2>
                        </div>
                        <div class="body">
                        	<form action="" method="post" id="frm-token">
                        		<label>Token aktif</label>
	                            <div class="form-group">
	                                <div class="form-line">
	                                	<input type="text" class="form-control" name="token" placeholder="Token aktif yang aktif saat ini" value="<?=get_app_config('TOKEN')?>" readonly>
	                                </div>
                                    <small class="help-block">Token merupakan karakter acak yang harus dimasukkan oleh peserta ujian setiap kali mereka akan mengikuti ujian</small>
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect">PERBARUI TOKEN</button>  
	                            <small class="help-block">Token yang telah diperbarui harus disosialisasikan kepada para peserta ujian agar mereka dapat mengikuti ujian</small>
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
        $(document).on('submit', '#frm-token', function(evt){
            evt.preventDefault();
            swal({
                title: "Anda yakin ?",
                text: "Anda akan memperbarui token, token yang diperbarui harus disosialisasikan kepada para peserta ujian, anda yakin ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, Saya ingin memperbarui token",
                cancelButtonText: "Tidak",
                closeOnConfirm: true                
            },function(keluar){
                if(keluar){
                    $(".loader").waitMe();
                    $.get('<?=site_url('?d=proktor&c=config&m=generate_token')?>', null, function(hasil){
                        $('[name="token"]').val(hasil.token);
                        $(".loader").waitMe('hide');
                    });
                }
            });
        });
    });
</script>
