<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Welcome to chat!</title>
        <link rel="stylesheet" type="text/css" href="./Resources/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./Resources/css/style.css">
    </head>
    <body>

        <div class="header">
            <div class="header__content">
                <img class="header__pic" src="./Resources/img/chat.png" />
                <p class="header__logotext">Simbirsoft Chat Application</p>
                <div class="clear"></div>
            </div>
        </div>

        <div class="middle">
            <div class="middle__content">
                <form onsubmit="sendForm(this, event)">                
                    <div class="form-group">
                      <label for="usr">Name:</label>
                      <input type="text" class="form-control middle__content__user" id="usr" placeholder="Nickname" maxlength="16" pattern="[A-Za-z]{1,20}" required>
                    </div>
                    <div class="form-group">
                      <label for="pwd">Message:</label>
                      <input type="text" class="form-control middle__content__msg" id="msg" placeholder="Message" maxlength="255" required>
                    </div>
                    <button class="btn btn-default middle__content__btn" id="send">Send</button>
                </form>
                <div class="form-group">
                  <textarea class="form-control middle__content__chat" rows="5" id="chat" readonly><?php
                    $db = fopen("DataBase.txt","r");
					if ($db != 0) {
                        while(!feof($db)) {
                            echo fgets($db);
                        }
                        fclose($db);
					}
                  ?></textarea>
                </div>
            </div>
        </div>

        <script src="./Resources/js/jquery-3.1.1.min.js"></script>
        <script src="./Resources/js/bootstrap.min.js"></script>
        <script src="./Resources/js/chat.js"></script>
    </body>
</html>

<?php
    if (isset($_POST['addedText'])) {
        $db = fopen("DataBase.txt","a+");
        fwrite($db, $_POST['addedText']);
        fclose($db);
    }
?>