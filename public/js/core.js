!function( $ ) {
    var streamers = [];

    var checkStreams = function()
    {
        var streamers = ['horusstv', 'fenixcoaching', 'rommeltj', 'jimrsng', 'famousc2',
                         'zafhir', 'beefchief3', 'lowcloud1', 'xesk1e', 'day9tv',
                         'zapo_colorado', 'xgsrevenge', 'angryzergc'];

        $.getJSON('http://api.justin.tv/api/stream/list.json?jsonp=?', {channel: streamers.join(',')}, function(data) {
            if (data.length > 0) {
                $('#streams').show();
                $('#streams ul.nav li').remove();

                $.each(data, function(i, item) {
                    //$('#stream-list li[rel=' + item.channel.login + ']').css({color: '#0f0'});

                    var _a = $('<a />').attr('href', item.channel.channel_url)
                                   .text(item.channel.title)
                                   .click(function() {
                                       return false;
                                   });
                    var _li = $('<li />').append(_a);
                    $('#streams ul.nav').append(_li);;
                });
            }else{
                $('#streams').hide();
            }
        });

        setTimeout(checkStreams, 60000);
    }

    checkStreams();

}( window.jQuery )