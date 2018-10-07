    <!-- Jquery Core Js -->
    <script src="<?=base_url('theme/adminbsb/')?>plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?=base_url('theme/adminbsb/')?>plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Select Plugin Js -->
    <script src="<?=base_url('theme/adminbsb/')?>plugins/bootstrap-select/js/bootstrap-select.min.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?=base_url('theme/adminbsb/')?>plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?=base_url('theme/adminbsb/')?>plugins/node-waves/waves.min.js"></script>

    <!-- plugin wait me -->
    <script src="<?=base_url('theme/adminbsb/')?>plugins/waitme/waitMe.min.js"></script>    

    <!-- plugin sweetalert -->
    <script src="<?=base_url('theme/adminbsb/')?>plugins/sweetalert/sweetalert.min.js"></script> 

    <!-- Custom Js -->
    <script src="<?=base_url('theme/adminbsb/')?>js/admin.js"></script>
    <script src="<?=base_url('theme/adminbsb/')?>js/pages/ui/animations.js"></script>

    <!-- Demo Js -->
    <script src="<?=base_url('theme/adminbsb/')?>js/demo.js"></script>
</body>

<script>
    $(function(){
        $(document).on('click', '.tombol_logout', function(evt){
            evt.preventDefault();
            swal({
                title: "Anda yakin ?",
                text: "Jika anda sedang mengerjakan soal, maka akan dianggap mengakhiri sesi ujian, jika belum, status anda akan dianggap belum melaksanakan ujian. Apakah anda yakin ingin keluar ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, Saya ingin keluar",
                cancelButtonText: "Tidak",
                closeOnConfirm: false                
            },function(keluar){
                if(keluar){
                    location.href = "<?=site_url('?c=login&m=logout_siswa')?>";
                }
            });
        });
    });
</script>
</html>
