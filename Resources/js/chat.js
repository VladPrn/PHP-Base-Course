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

function sendForm(form, event) {
    event.preventDefault();
    var addedText = updateChat();
    $.post('index.php',{addedText:addedText});
}