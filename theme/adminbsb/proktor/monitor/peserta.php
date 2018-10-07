<?php $this->load->view('proktor/header')?>

<!-- Bootstrap Select Css -->
<link href="<?=base_url('theme/adminbsb/')?>plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<!-- JQuery DataTable Css -->
<link href="<?=base_url('theme/adminbsb/')?>/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>MONITOR PESERTA
                    <small>
                        Fasilitas penggawasan peserta ujian
                    </small>
                </h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                AKTIVITAS PESERTA TERBARU
                                <small>Daftar aktivitas peserta untuk ujian yang berlangsung</small>
                            </h2>
                        </div>
                        <div class="body">
                        	<p>
                        	<select class="form-control show-tick" id="combo-ujian">
							  <option value="">-- Pilih ujian --</option>
							  <?php foreach($ujian as $r):?>
							  	<?php $selected=($ujian_id==$r->ujian_id)?'selected':'' ?>
							  	<option value="<?=$r->ujian_id?>" <?=$selected?>><?=$r->judul?></option>
							  <?php endforeach?>
							</select>
                        	</p>

                            <table class="table table-striped table-hover tabel-peserta dataTable" id="app">
                                <thead>
                                    <tr>
                                        <th width="25%">Nama</th>
                                        <th width="60%">Progres</th>
                                        <th width="15%">Terakhir Login</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<tr v-for="item in ujian.peserta">
                                		<td>
                                			<a href="javascript:void(0);"  :data-login="item.login" :data-ujian_id="item.ujian_id" class="btn-detail-peserta">{{item.nama}}</a>
                                			<span :class="'badge bg-' + getWarnaStatus(item.status)"><small>{{getStatus(item.status)}} </small> </span>
                                		</td>
                                		<td>
                                			<div class="progress">
	                                            <div class="progress-bar progress-bar-success" :style="'width:' + getPersenSoal(item.terjawab) + '%;'">
	                                            {{item.terjawab}} terjawab</div>
	                                            <div class="progress-bar progress-bar-warning" :style="'width:' + getPersenSoal(item.ragu) + '%;'">
	                                            {{item.ragu}} ragu</div>
	                                            <div class="progress-bar progress-bar-danger" :style="'width:' + getPersenSoal((ujian.jml_soal - item.ragu - item.terjawab)) + '%;'">
	                                            {{(ujian.jml_soal - item.ragu - item.terjawab)}} kosong</div>
	                                        </div>
                                		</td>
                                		<td>{{item.last_login}}</td>
                                	</tr>
                                	                           	
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

	<div class="modal fade in app2" id="modal-detil-peserta" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content detail-peserta">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Rincian {{namaPeserta}}</h4>
                </div>
                <div class="modal-body">
                    <ul>
                    	<li>Ujian : {{namaUjian}}</li>
                    	<li>Sisa waktu : <strong>{{sisaWaktu}}</strong></li>
                    </ul>
					<p></p>
					<p>Jawaban :</p>

					<div class="icon-jawaban-saya icon-button-demo">
						<span v-for="item in jawaban">
							<button type="button" :class="'btn btn-circle-lg waves-effect waves-circle waves-float font-bold ' + clsJawaban(item.pilihan, item.ragu)">
								{{item.no_soal}}
							</button>
						</span>
					</div>


                </div>
                <div class="modal-footer">
					<button type="button" class="btn-reset-peserta btn btn-primary waves-effect pull-left" v-if="(status=='2' || status=='1')">Reset login</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">SELESAI</button>
                </div>
            </div>
        </div>
    </div>    

<?php $this->load->view('proktor/footer')?>
<!-- Plugin vue -->
<script src="<?=base_url('theme/adminbsb/')?>plugins/vue/vue.js"></script>
<!-- Select Plugin Js -->
<script src="<?=base_url('theme/adminbsb/')?>plugins/bootstrap-select/js/bootstrap-select.js"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="<?=base_url('theme/adminbsb/')?>plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?=base_url('theme/adminbsb/')?>plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script>
	$(document).on('change', '#combo-ujian', function(){
		var ujian_id = $(this).val();
		document.location.href="<?=site_url('?d=proktor&c=monitor&m=peserta&ujian_id=')?>" + ujian_id;
	});
	$(function(){
		var tbPeserta = $('.tabel-peserta').DataTable({
			responsive: true
		});
		
		var app = new Vue({
			el: '#app',
			data: {
				ujian: [],
				getStatus: function(idx){
					var status = ['belum login', 'pending', 'sedang bekerja', 'selesai'];
					return status[idx];
				},
				getWarnaStatus: function(idx){
					var status = ['pink', 'purple', 'orange', 'cyan'];
					return status[idx];
				},
				getPersenSoal: function(nilai){
					return Math.floor(nilai / this.ujian.jml_soal * 100);
				}
			},
			created : function(){
				this.segarkanPeserta();
				this.timer = setInterval(function(){
	                this.segarkanPeserta();
	                console.log('penyegaran data');
	            }.bind(this), 10000);
			},
			methods : {
				segarkanPeserta : function(){
					$.get('?d=proktor&c=monitor&m=get_peserta&ujian_id=<?=$ujian_id?>', function(hasil){
						this.ujian = hasil;
					}.bind(this));
				}
			}
		});

		var app2 = new Vue({
			el: '.app2',
			data: {
				login: '',
				ujian_id: '',
				namaPeserta: '...',
				namaUjian: '...',
				sisaWaktu: '...',
				jawaban: [],
				clsJawaban: function(jawaban, ragu){
					var cls = '';
					if(jawaban != null){
						cls = 'btn-primary';
						if(ragu == '1'){
							cls = 'btn-warning';
						}
					}else{
						cls = 'btn-default';
					}
					return cls;
				},				
				status: 0,
			}
		});

		$(document).on('click', '.btn-detail-peserta', function(){
			$('#modal-detil-peserta').modal('show');
			$('.detail-peserta').waitMe();
			var data = {
				d: 'proktor',
				c: 'monitor',
				m: 'get_detail_peserta',
				login: $(this).data('login'),
				ujian_id: $(this).data('ujian_id'),
			}
			$.get('<?=site_url()?>', data, function(hasil){
				app2.namaPeserta = hasil.nama_peserta;
				app2.namaUjian = hasil.nama_ujian;
				app2.sisaWaktu = hasil.waktu_selesai;
				app2.jawaban = hasil.jawaban;
				app2.status = hasil.status;
				app2.login = $(this).data('login');
				app2.ujian_id = $(this).data('ujian_id');
				$('.detail-peserta').waitMe('hide');
			}.bind(this));
		});

		$(document).on('click', '.btn-reset-peserta', function(){
			swal({
                title: "Anda yakin ?",
                text: "Anda akan me-reset login "+ app2.namaPeserta +", anda yakin ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, Saya yakin",
                cancelButtonText: "Tidak",
                closeOnConfirm: true
            },function(isReset){
                if(isReset){
                	var data = {
                		d: 'proktor',
                		c: 'monitor',
                		m: 'reset_peserta',
                		login: app2.login,
                		ujian_id: app2.ujian_id
                	}
                	$('.detail-peserta').waitMe();
                	$.get('<?=site_url()?>', data, function(hasil){
                		if(hasil.message == 'ok'){
		                	$('#modal-detil-peserta').modal('hide');
                			app.segarkanPeserta();
                		}
                	});
                }
            });
		});

	});
</script>
