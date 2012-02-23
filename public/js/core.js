!function( $ ) {
    var streamers = [];
    var player = false;
    var hasRun = false;


    var checkStreams = function()
    {
        streamers = ['horusstv', 'fenixcoaching', 'rommeltj', 'jimrsng', 'famousc2',
                     'zafhir', 'beefchief3', 'lowcloud1', 'xesk1e', 'day9tv',
                     'zapo_colorado', 'xgsrevenge', 'angryzerg', 'ignproleague', 'playhemtv'];

        $.getJSON('http://api.justin.tv/api/stream/list.json?jsonp=?', {channel: streamers.join(',')}, function(data) {
            if (data.length > 0) {
                $('#streams').show();
                $('#streams ul.nav li').remove();

                $.each(data, function(i, item) {

                    var _a = $('<a />').attr('href', item.channel.channel_url)
                                   .text(item.channel.title)
                                   .click(function() {
                                        $('#streams ul.nav li').removeClass('active');
                                        $(this).parent('li').addClass('active');

                                        player = showPlayer(item.channel.login);
                                        return false;
                                   });
                    var _li = $('<li />')
                    if (i == 0) {
                        _li.addClass('active');
                        if (!hasRun) {
                            showPlayer(item.channel.login);
                            hasRun = true;
                        }
                    }
                    _li.append(_a);
                    $('#streams ul.nav').append(_li);;
                });
            }else{
                $('#streams').hide();
            }
        });

        setTimeout(checkStreams, 60000);
    }

    checkStreams();

    var showPlayer = function(channel)
    {
        $.ajaxSetup({cache: false});
        $.get('get_embed.php?channel=' + channel, function (data) {
            $('#stream_content').html(data);
        });
        $.get('get_embed.php?type=chat&channel=' + channel, function (data) {
            $('#stream_chat').html(data);
        });
    }
}( window.jQuery )