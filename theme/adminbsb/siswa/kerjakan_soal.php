<?php $this->load->view('siswa/header')?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>SOAL UJIAN</h2>
            </div>
            <div class="row clearfix">
            	<!-- Infobox -->
            	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            		<div class="info-box bg-pink hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">JML SOAL</div>
                            <div class="number info-jml-soal">0</div>
                        </div>
                    </div>
            	</div>

            	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-purple hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">SELESAI</div>
                            <div class="number info-selesai">10</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">devices</i>
                        </div>
                        <div class="content">
                            <div class="text">PROGRES</div>
                            <div class="number info-progres">92%</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                	<div class="info-box bg-light-blue hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">access_alarm</i>
                        </div>
                        <div class="content">
                            <div class="text">SISA WAKTU</div>
                            <div class="number info-sisa-waktu">00:00:00</div>
                        </div>
                    </div>
                </div>
            	<!-- Akhir Infobox -->
            </div>
            <div class="row clearfix">           	

                <!-- Detail soal -->
                <div class="col-lg-12">
                    <div class="card loader">
                        <div class="header bg-cyan">
                            <h2>
                            	<?=strtoupper(jenis_ujian($ujian_jenis))?> :
                            	<?=strtoupper($ujian_nama)?>
                            	<small>Kerjakan soal dengan seksama</small>
                            </h2>

							<ul class="header-dropdown m-r--5">
                                <li  data-toggle="tooltip" data-placement="top" data-original-title="Periksa jawaban" class="btn-tooltip">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-periksa-jawaban">
                                        <i class="material-icons">screen_share</i>
                                    </a> 
                                </li>
                            </ul>

                        </div>
                        <div class="body">
                        	<div id="soal"></div>
                        	<div id="pilihan_jawaban"></div>
							<p>&nbsp;</p>
							<div class="row clearfix">
								<div class="col-lg-4 col-md-12 col-sm-12">
									<button class="btn bg-pink btn-lg btn-prev btn-block">SEBELUMNYA</button>
								</div>
								<div class="col-lg-4 col-md-12 col-sm-12 text-center">
									<input type="checkbox" id="chkRagu" class="filled-in chk-col-red" checked="">
									<label for="chkRagu">RAGU</label>
								</div>
								<div class="col-lg-4 col-md-12 col-sm-12">
									<button class="btn bg-pink btn-lg pull-right btn-next btn-block">SELANJUTNYA</button>
									<button class="btn bg-pink btn-lg pull-right btn-selesai btn-block" style="display: none;">SELESAI / KUMPULKAN JAWABAN
								</div>
							</div>
                    </div>
                </div>
                <!-- Akhir Detail soal -->

            </div>
        </div>
    </section>


<div class="modal fade" id="modal-periksa-jawaban" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">PERIKSA JAWABAN SAYA</h4>
            </div>
            <div class="modal-body">
            	<div class="icon-jawaban-saya icon-button-demo"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">TUTUP</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('siswa/footer')?>
<?php $this->load->view('siswa/js/count_down_timer')?>
<script>
	$(function(){
		var cur_no_soal = 0;
		var soal = [];

		var tampilkan_soal = function(what){
			$(".loader").waitMe();
			if(what == "prev"){
				cur_no_soal -= 1;
			}else if(what == "next"){
				cur_no_soal += 1;
			}else{
				cur_no_soal = what;
			}
			var butir = soal[cur_no_soal];
			$("#soal").html((cur_no_soal +1) + ". " + butir.konten);
			var konten_pilihan = "";
			$.each(butir.pilihan_jawaban, function(k, v){
				var radio_id = "radio_" + k;
				var data = 'data-no_soal="'+ butir.no +'" ' + 
							'data-pilihan="'+ v.ke +'" ';
				var checked = (v.ke == butir.jawaban_terpilih) ? ' checked' : '';
				konten_pilihan += '<input name="jawaban" type="radio" id="'+ radio_id +'" class="radio-col-red btn-jawaban" '+ data + checked +'>';
				konten_pilihan += '<label for="'+ radio_id +'">' + v.konten + '</label><br>';
			});
			$("#pilihan_jawaban").html(konten_pilihan);
			$("#chkRagu").prop("checked", (butir.jawaban_terpilih_ragu == "1"));
			
			
			kondisikan_navigasi();
			update_info_progres();
			$(".loader").waitMe('hide');
		}

		var kondisikan_navigasi = function(){			
			if(cur_no_soal == 0){
				$(".btn-prev").prop("disabled", true);
				if(soal.length > 1){
					$(".btn-next").prop("disabled", false);
				}
			}
			if(cur_no_soal == (soal.length - 1)){
				$(".btn-next").prop("style", "display: none;");
				$(".btn-selesai").prop("style", "display: inline;");
				if(soal.length > 1){
					$(".btn-prev").prop("disabled", false);
				}
			}else{
				$(".btn-next").prop("style", "display: inline;");
				$(".btn-selesai").prop("style", "display: none;");
			}
		}

		var update_info_progres = function(){
			$('.info-selesai').text('...');
			$('.info-progres').text('...');
			var jml_soal_selesai = 0;
			$.each(soal, function(k, v){
				if((v.jawaban_terpilih != '') && (v.jawaban_terpilih_ragu != '1')){
					jml_soal_selesai++;
				}
			});
			$('.info-selesai').text(jml_soal_selesai);
			var persen = (jml_soal_selesai/soal.length) * 100;
			$('.info-progres').text(persen + ' %');
		}

		var muat_navigasi_soal = function(){
			$.each(soal, function(k, v){
				var cls = '';
				if(v.jawaban_terpilih != ''){
					cls = 'btn-primary';
					if(v.jawaban_terpilih_ragu == '1'){
						cls = 'btn-warning';
					}
				}else{
					cls = 'btn-default';
				}
				cls = 'btn '+ cls +' btn-circle-lg waves-effect waves-circle waves-float font-bold btn-navigasi-soal';
				$('[data-no-soal="'+ k +'"]').prop('class', cls);
			});
		}

		<?php foreach($soal as $key => $butir):?>

			var pilihan_jawaban = [];
			<?php foreach($butir->pilihan_jawaban as $pilihan_jawaban):?>
				pilihan_jawaban.push({
					"ke" : "<?=$pilihan_jawaban->pilihan_ke?>",
					"konten" : "<?=addslashes($pilihan_jawaban->konten)?>",
				});
			<?php endforeach?>

			var item = {
				"no" : "<?=$butir->no_soal?>",
				"konten" : "<?=addslashes($butir->konten)?>",
				"jawaban_terpilih" : "<?=$butir->pilihan?>",
				"jawaban_terpilih_ragu" : "<?=$butir->ragu?>",
				"pilihan_jawaban" : pilihan_jawaban,
			}

			var konten = '<button type="button" class="btn btn-circle-lg waves-effect waves-circle waves-float font-bold btn-navigasi-soal" data-no-soal="<?=$key?>" style="font-size: 120%"><?=($key + 1)?></button>';
			$('.icon-jawaban-saya').append(konten);

			soal.push(item);

		<?php endforeach?>

		// klik tombol prev
		$(".btn-prev").on("click", function(){
			tampilkan_soal("prev");
		});

		// klik tombol next
		$(".btn-next").on("click", function(){
			tampilkan_soal("next");
		});

		// klik tombol jawaban
		$(document).on("click", ".btn-jawaban", function(){			
			$(".loader").waitMe();
			var data = $(this).data();
			soal[cur_no_soal].jawaban_terpilih = data.pilihan;
			$.post("<?=site_url('?d=siswa&c=ujian&m=submit_jawaban')?>", data, function(hasil){
				if(hasil == 'ok'){
					$(".loader").waitMe('hide');
					update_info_progres();
					muat_navigasi_soal();
				}
			});
		});

		// klik tombol navigasi soal
		$(document).on('click', '.btn-navigasi-soal', function(){
			$('#modal-periksa-jawaban').modal('hide');
			tampilkan_soal($(this).data('no-soal'));
		});

		// klik tombol selesai
		$(document).on('click', '.btn-selesai',async function(){
			var ada_ragu = false;
			$.each(soal, function(k, v){
				if(v.jawaban_terpilih_ragu == '1'){
					ada_ragu = true;
					return false;
				}
			});
			if(ada_ragu){
				swal({
					title: "Jawaban Ragu ?",
					text: "Anda tidak bisa menyelesaikan ujian sekarang, terdapat jawaban yang berstatus ragu-ragu",
					type: "warning",
				});
				return;
			}
            swal({
            	title: "Anda yakin ?",
                text: "Periksa seluruh jawaban sebelum menyelesaikan ujian. Pastikan seluruh jawaban telah terpenuhi. Apakah anda yakin ingin menyelesaikan ujian ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                closeOnConfirm: false                
            },function(keluar){
                if(keluar){
                    location.href = "<?=site_url('?c=login&m=logout_siswa')?>";
                }
            });
		});

		// klik tombol ragu
		$(document).on('click', '#chkRagu', function(){
			var no_soal = $('[type="radio"]:first').data('no_soal');
			var data = {
				'no_soal' : no_soal,
				'ragu' : $(this).prop('checked')
			}
			$.post('<?=site_url("?d=siswa&c=ujian&m=jawaban_ragu")?>', data, function(hasil){
				if(hasil == 'ok'){
					soal[cur_no_soal].jawaban_terpilih_ragu = (data.ragu) ? '1' : '0';
					tampilkan_soal(cur_no_soal);
					muat_navigasi_soal();
				}
			});
		});

		// kondisi awal
		tampilkan_soal(0);
		muat_navigasi_soal();
		$(".info-jml-soal").text(soal.length);
		$(".btn-tooltip").tooltip({
			container: "body"
		});
	});

</script>