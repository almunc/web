<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="stylesheet.css" rel="stylesheet">
        <?php
        require("start.php");
        ?>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chat</title>
    </head>
    <body>
        <h1>
            Chat with Tom
        </h1>
        <a href="friends.html" class="blue-links"> &lt;Back </a>
        <b>|</b>
        <a href="profile.html" class="blue-links"> Profile </a>
        <b>|</b>
        <a href="friends.html" class="red-links"> Remove Friend </a>
        <hr style="border-style: dashed;">

        <div id="msg-box" class="field-layout">
            <!-- will be filled by js -->
        </div>
        <hr class="hr">
        <form id="msg-form">
            <input id="msg-inp" class="messageinput" type="text" id="message"
                name="message" placeholder="New Message">
            <button id="msg-submit" class="submitbutton" type="submit">Send</button>
        </form>

        <script>
            window.msgBox = document.getElementById("msg-box");
            window.messageLength = 0;
            window.msgForm = document.getElementById("msg-form");
            window.msgInp = document.getElementById("msg-inp");

            window.chatToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNjM1ODU2MzYzfQ.w-ELZ7Kml1qEPaJi9JJyQaeRh0Z6bUKK1jBWM4FWWMY";
            window.chatCollectionId = "95caaad9-3863-4f4b-b28d-feb59be76b47";
            window.baseURL = "https://online-lectures-cs.thi.de/chat";
        </script>
        <script defer src="js/chat.js"></script>
    </body>
</html>