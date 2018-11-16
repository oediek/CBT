<?php $this->load->view('proktor/header')?>

<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <h2>ALAT OPTIMASI PENYIMPANAN
        <small>
          Fasilitas optimasi media simpanan
        </small>
      </h2>
    </div>
    
    <div class="row clearfix">
      <div class="col-lg-12">
        <div class="card loader">
          <div class="header">
            <h2>
              AKSI OPTIMASI MEDIA SIMPANAN
              <small>Baca dengan seksama, petunjuk optimasi</small>
            </h2>
          </div>
          <div class="body">
            <p>Beberapa soal ujian terkadang mengalami kegagalan unggah karena alasan-alasan tertentu, seperti : gagal koneksi, format tidak sesuai dan lain sebagainya. 
              Kegagalan ini tidak berarti mencegah soal untuk mengunggah media. Soal tetap mengunggah media meskipun terdapat kegagalan dalam menyimpannya.
              Untuk mengurangi pembengkakan kapasitas simpanan diperlukan tindakan khusus berupa optimasi media simpanan.
            </p>
            <button class="btn btn-primary waves-effect btn-opti">OPTIMALKAN MEDIA SIMPANAN</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php $this->load->view('proktor/footer')?>

<script>
  $(function(){

    $(document).on('click', '.btn-opti', function(){
      swal({
        title: "Anda yakin ?",
        text: "Seluruh data media yang tidak diperlukan akan dihapus, anda yakin ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Saya yakin",
        cancelButtonText: "Tidak",
        closeOnConfirm: true
      },function(isOpti){
        if(isOpti){
          $('.loader').waitMe();
          const target = '<?=site_url("?d=proktor&c=alat&m=do_optimize")?>';
          console.log(target);
          $.getJSON(target, function(hasil){
            console.log(hasil);
            if(hasil.pesan == 'ok'){
              swal({
                title: "Reset",
                text: "Sebanyak "+ hasil.jml_media +" data media telah dihapus"
              });
              $('.loader').waitMe('hide');
            }
          });
        }
      });
    });

  });
</script>
