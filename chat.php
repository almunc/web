<?php
require "start.php";

//check auth
if(empty($_SESSION["user"])) {
    header("Location: login.php");
    die;
}

if(empty($_GET["partner"])) {
    header("Location: friends.php");
    die;
}

$partner = $_GET["partner"];
echo "<script>window.partner = '{$partner}'</script>";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="stylesheet.css" rel="stylesheet">
        <?php
        ?>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chat</title>
    </head>
    <body>
        <h1>
            Chat with <?= $partner ?>
        </h1>
        <a href="friends.php" class="blue-links"> &lt;Back </a>
        <b>|</b>
        <a href="profile.php?user=<?= $partner ?>" class="blue-links"> Profile </a>
        <b>|</b>
        <a href="friends.php?remove=" class="red-links"> Remove Friend </a>
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

            window.chatToken = "<?= $_SESSION['chat_token'] ?>";
            window.chatCollectionId = "<?= CHAT_SERVER_ID ?>";
            window.baseURL = "<?= CHAT_SERVER_URL ?>";
        </script>
        <script defer src="js/chat.js"></script>
    </body>
</html>