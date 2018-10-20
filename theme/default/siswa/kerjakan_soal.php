<?php $this->load->view('siswa/header')?>
<?php $soal_json = json_encode($soal ) ?>

<div class="container-fluid">
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
    
    <div class="row" id="app-vue">
        <div class="col-md-12">
            <div id="soal">
                <div id="soal-head" class="">
                    <div id="nomor">
                        SOAL NO <span>{{idxSoal+1}}</span>
                    </div>
                    <div id="waktu">
                        <span>Sisa Waktu</span>
                        <span class="sisa" id="countdown">{{sisaWaktu}}</span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div id="font-size">
                    Ukuran font soal : <span class="a1">A</span><span class="a2">A</span><span class="a3">A</span>
                </div>
                <div id="soal-body" style="display: block;">
                    <div class="soal active">
                        <div class="isi-soal" v-html="soalJson[idxSoal].konten"></div>
                        <div class="options-group">
                            <div class="options" v-for="pilihan, idx in soalJson[idxSoal].pilihan_jawaban" :data-pilihan_ke="pilihan.pilihan_ke">
                                <span :class="(pilihan.pilihan_ke == soalJson[idxSoal].pilihan) ? 'option checked' : 'option'" >
                                    <span class="inneroption"> {{String.fromCharCode(65 + idx)}} </span>
                                </span>
                                <p><span style="font-family:Arial; font-size:14pt" v-html="pilihan.konten"></span></p>
                            </div>

                        </div>
                    </div>
                </div>
                <div id="pilihan-body">
                    
                </div>
                <div id="soal-foot">
                    <table width="100%">
                        <tbody><tr>
                            <td align="left">
                                <button type="button" id="btn-prev" class="btn btn-primary" :disabled="idxSoal == 0">
                                    <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> SOAL SEBELUMNYA
                                </button>
                            </td>
                            <td align="center">
                                <button type="button" class="btn btn-warning btn-ragu" :disabled="soalJson[idxSoal].pilihan == null">
                                    <span :class="(soalJson[idxSoal].ragu != 1) ? 'glyphicon glyphicon-unchecked' : 'glyphicon glyphicon-check'" aria-hidden="true"></span> RAGU - RAGU
                                </button></td>
                            <td align="right">
                                <button type="button" id="btn-next" class="btn btn-primary" :style="(idxSoal == (soalJson.length - 1)) ? 'display:none' : ''">SOAL BERIKUTNYA 
                                    <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                                </button>
                            </td>
                            <td align="right"><button :style="(idxSoal == (soalJson.length - 1)) ? '' : 'display:none'" type="button" id="last-soal" class="btn btn-primary">KUMPULKAN JAWABAN<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></button></td>
                        </tr>
                    </tbody></table>
                </div>
            </div>
        </div>
    </div>
    
</div>

<?php $this->load->view('siswa/footer')?>
<!-- plugin vue -->
<script src="<?=base_url('theme/adminbsb/')?>plugins/vue/vue.js"></script> 

<script>
    $(function(){
        var vueApp = new Vue({
            el: '#app-vue',
            data: {
                idxSoal: 0,
                sisaWaktu: '00:00',
                soalJson : <?=$soal_json?>
            }
        });
        
        $('#btn-next').on('click', function(){
            if(vueApp.idxSoal < vueApp.soalJson.length - 1){
                vueApp.idxSoal += 1;
            }
        });
        
        $('#btn-prev').on('click', function(){
            if(vueApp.idxSoal > 0){
                vueApp.idxSoal += -1;
            }
        });

        $(document).on('click', '.options', function(){
            $('.options .option').removeClass('checked');
            $(this).find('.option').addClass('checked');
            $('#soal').waitMe();
            var data = {
                no_soal : vueApp.soalJson[vueApp.idxSoal].no_soal,
                pilihan : $(this).data('pilihan_ke')
            }
            console.log(data);
            $.post("<?=site_url('?d=siswa&c=ujian&m=submit_jawaban')?>", data, function(hasil){
                if(hasil == 'ok'){
                    $("#soal").waitMe('hide');
                    vueApp.soalJson[vueApp.idxSoal].pilihan = data.pilihan;
                }
            });
        })

        $(document).on('click', '.btn-ragu', function(){
            var btnRagu = $(this).find('span');
            $('#soal').waitMe();
            btnRagu.toggleClass('glyphicon-unchecked');
            btnRagu.toggleClass('glyphicon-check');
            var data = {
                no_soal: vueApp.soalJson[vueApp.idxSoal].no_soal,
                ragu: btnRagu.hasClass('glyphicon-check')
            }
            $.post('<?=site_url("?d=siswa&c=ujian&m=jawaban_ragu")?>', data, function(hasil){
                if(hasil == 'ok'){
                    vueApp.soalJson[vueApp.idxSoal].ragu = data.ragu;
                    $('#soal').waitMe('hide');
                }
            });
            console.log(data);
        });

        console.log(vueApp.soalJson);
    
  
    });


</script>