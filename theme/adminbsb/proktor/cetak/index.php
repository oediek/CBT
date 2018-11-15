<?php $this->load->view('proktor/header')?>
<section class="content">
  <div class="container-fluid">
    
    <div class="block-header">
      <h2>CETAK LAPORAN
        <small>
          Fasilitas Cetak Laporan
        </small>
      </h2>
    </div>
    
    <div class="col-lg-12">
      <div class="card">
        <div class="header">
          <h2>
            DAFTAR UJIAN
            <small>Berikut ini merupakan daftar ujian yang tersimpan pada database</small>
          </h2>
        </div>
        <div class="body">
          <table class="table table-striped table-hover tabel-ujian dataTable">
            <thead>
              <tr>
                <td>#</td>
                <td>Nama Ujian</td>
                <td>Mulai</td>
                <td>Selesai</td>
                <td>Cetak</td>
              </tr>
            </thead>
            <tbody>
              <?php $n = 1?>
              <?php foreach($ujian as $r):?>
                <tr>
                  <td><?=$n++?></td>
                  <td><?=$r->judul?></td>
                  <td><?=$r->mulai?></td>
                  <td><?=$r->selesai?></td>
                  <td>
                    <a href="<?=site_url('?d=proktor&c=cetak&m=kartu_peserta&ujian_id=' . $r->ujian_id)?>" target="_blank"><i class="material-icons" data-toggle="tooltip" data-placement="top" title data-original-title="Kartu peserta ujian">class</i></a>
                    <a href="<?=site_url('?d=proktor&c=cetak&m=presensi&ujian_id=' . $r->ujian_id)?>" target="_blank"><i class="material-icons" data-toggle="tooltip" data-placement="top" title data-original-title="Presensi">fingerprint</i></a>
                    <a href="<?=site_url('?d=proktor&c=cetak&m=berita_acara&ujian_id=' . $r->ujian_id)?>" target="_blank"><i class="material-icons" data-toggle="tooltip" data-placement="top" title data-original-title="Berita acara">gavel</i></a>
                  </td>
                </tr>                
              <?php endforeach?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
  </div>
</section>

  
<?php $this->load->view('proktor/footer')?>
<script>
  $(function(){
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
  });
</script>