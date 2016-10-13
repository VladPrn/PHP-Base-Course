function updateChat(isPost) {
    $.ajax({
        url: 'app.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var $chat = $('#chat'),
                messages = [];
            for (var i = 0; i < data.length; i++) {
                var date = '<span class="chat_time">' + data[i].date + '</span>',
                    name = data[i].name,
                    text =  data[i].text;
                messages.push('<div class="chat_message">' + date + ' ' + name + ' > ' + text + '</div>');
            }

            $chat.html(messages.join(''));
            $chat.parent().scrollTop($chat.height() + 100);

            if (isPost != true)
            {
                setTimeout('updateChat(false)', 2000);
            }
        },
        error: function(xhr) {
            alert(xhr.responseText);
        }
    });
}

function sendForm(event) {
    event.preventDefault();
    var name = $('#usr').val();
    var text = $('#msg').val();
    var date = new Date().toLocaleString();
    $.ajax({
        url: 'app.php',
        type: 'POST',
        data: {message:{name:name, text:text, date:date}},
        success: function() {
            updateChat(true);
        },
        error: function(xhr) {
            alert(xhr.responseText);
        }
    });
}

updateChat(false);