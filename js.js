<script>
    $.getJSON('MapRenderer.php', function(data) {
        $.each(data, function(x, y) {
            $(".block-" + x +"-"+ y).attr("location");
        })
    };
</script>