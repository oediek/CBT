<script>
    $(function(){
        // Set the date we're counting down to
        var countDownDate = new Date("<?=$ujian_selesai?>").getTime();

        var now = new Date("<?=$skrg?>").getTime();
        var distance = countDownDate - now;

        // Update the count down every 1 second
        var x = setInterval(function() {

            distance = distance - 1000;

            var hours = Math.floor(distance  / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            $('.info-sisa-waktu').html(hours + ':' + minutes + ':' + seconds);

            
            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                $('.btn-ikuti-ujian').attr('disabled', true);
                $('.info-sisa-waktu').html("KADALUARSA");
            }
        }, 1000);
    })
</script>