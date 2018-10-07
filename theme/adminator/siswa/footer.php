            <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600"><span>Copyright © <script>document.write((new Date()).getFullYear())</script> DIKPORA Kota Probolinggo, Designed by <a href="https://colorlib.com" target="_blank" title="Colorlib">Colorlib</a>. All rights reserved.</span></footer>
        </div>
    </div>
    <?php $this->load->view('base_theme_url')?>
    <script type="text/javascript" src="<?=base_url('theme/adminator/')?>vendor.js"></script>
    <script type="text/javascript" src="<?=base_url('theme/adminator/')?>bundle.js"></script>
    <script type="text/javascript" src="<?=base_url('theme/adminator/')?>jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="<?=base_url('theme/adminator/')?>bootbox.min.js"></script>
</body>

</html>

<script>
$(function(){
	$('.tombol_logout').on('click', function(evt){
		evt.preventDefault();
		bootbox.alert("Your message here…", function(){ /* your callback code */ });

		// bootbox.confirm("Anda ingin keluar dari sistem ?", function(keluar){ 
		// 	if(keluar){
		// 	}
		// });
	});
});
</script>