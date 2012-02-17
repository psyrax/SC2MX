!function( $ ) {
    var streamers = [];

    var checkStreams = function()
    {
        $('#stream-list li').each(function(i, el) {
            streamers.push($(el).html());
            if (!$(el).attr('rel')) {
                $(el).attr('rel', $(el).html());
            }
        });

        $.getJSON('http://api.justin.tv/api/stream/list.json?jsonp=?', {channel: streamers.join(',')}, function(data) {
            $.each(data, function(i, item) {
                $('#stream-list li[rel=' + item.channel.login + ']').css({color: '#0f0'});

            });
        });

        setTimeout(checkStreams, 60000);
    }

    checkStreams();

}( window.jQuery )