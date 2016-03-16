$('#filters img').addClass('dark-shadow');

$('#filters img').each(function(index) {
    var rand = Math.floor(Math.random() * 15);
    if (index % 2 == 0) {
        rand *= -1;
    }
    $(this).css('-moz-transform', 'rotate(' + rand + 'deg)');
    $(this).css('-webkit-transform', 'rotate(' + rand + 'deg)');
    $(this).css('transform', 'rotate(' + rand + 'deg)');
    $(this).css('opacity', 0.66);
});

$('#filters img').click(function(e) {
    $('#filters img').each(function(index) {
        $(this).css('opacity', 0.66);
    });

    $('#result').hide();
    $('#resultMessage').hide();
    $('#processingMessage').show();
    e.preventDefault();
    $(this).css('opacity', 1);

    var url = $('input[name=url]').val();
    if (!url) {
        alert('URL is missing!');
        return;
    }

    var filter = $(this).data('filter');
    $('input[name=filter]').val(filter);
    $('#result').attr('src', '/index.php?__ajax=1&url=' + url + '&filter=' + filter);
    $('#processingMessage').hide();
    $('#result').fadeIn();
    $('#resultMessage').fadeIn();
});