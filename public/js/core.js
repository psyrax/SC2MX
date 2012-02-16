!function( $ ) {
    var streamers = [];

    var checkStreams = function()
    {
        $('#stream-list li').each(function(i, el) {
            streamers.push($(el).html());
        });

        $.getJSON('http://api.justin.tv/api/stream/list.json?channel=' + streamers.join(',') + '&callback=?', function(data) {
            if(data.length == 0)) {
                return;
            }
        });
    }

    checkStreams();

}( window.jQuery )