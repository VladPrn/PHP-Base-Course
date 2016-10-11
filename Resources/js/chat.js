function updateChat() {
    var nickName = document.getElementById('usr').value;
    var message = document.getElementById('msg').value;
    var date = new Date().toLocaleString();
    
    var addedText = date + ' ' + nickName + '> ' + message + '\n';
    
    var textArea = document.getElementById('chat');
    textArea.value += addedText;
    textArea.scrollTop = textArea.scrollHeight;
    
    return addedText;
}

function loadChat() {
    $.ajax({
        url: 'app.php',
        type: 'GET',
        dataType: 'json',
        success: function(messages) {
            var textArea = document.getElementById('chat');
            textArea.value = '';
            for (var i = 0; i < messages.length; i++) {
                textArea.value += messages[i];
            }
        }
    });
}

function sendForm(form, event) {
    event.preventDefault();
    var addedText = updateChat();
    $.post('app.php', {addedText:addedText});
}

loadChat();