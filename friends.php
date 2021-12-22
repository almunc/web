<?php

use Model\Friend;

require "start.php";

if(empty($_SESSION["user"])) {
    header("Location: login.php");
    die;
}

if(isset($_POST["action"])){
    if(!empty($_POST["addName"])){
        $addName = $_POST["addName"];
        $newFriend = new Model\Friend($addName, "requested");
        $service->friendRequest($newFriend);
    }
}

if(isset($_POST["accept"])){
    $acceptFriend = new Model\Friend($_POST["accept"]);
    $service->friendAccept($acceptFriend);
}

if(isset($_POST["decline"])){
    $declineFriend = new Model\Friend($_POST["decline"]);
    $service->friendDismissed($declineFriend);
}

if(isset($_GET["remove"])){
    $removeFriend = new Friend($_GET["remove"]);
    $service->friendRemove($removeFriend);
}

$friendsList = $service->loadFriends();
$unreadMessages = $service->getUnread();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheet.css" rel="stylesheet">
    <script>
        window.chatToken = "<?= $_SESSION['chat_token'] ?>"; 
        window.chatCollectionId = "<?= CHAT_SERVER_ID ?>"; 
        window.chatServer = "<?= CHAT_SERVER_URL ?>";
    </script>
    <title>Friends</title>
</head>
<body>
    <h1>Friends</h1>
    <table>
        <tr>
            <td>
        <a href="logout.php" class="blue-links"> &lt;Logout </a>
        <b>|</b><a href= "settings.php" class="blue-links"> Settings</a>
        </td>
    </tr>
    </table>
    <hr class="hr">
    <ul class="field-layout"> <br>
            <?php if(!empty($friendsList)){
                foreach($friendsList as $value) { 
                    $friendName = $value->getUsername();
                    if(($value->getStatus()) === "accepted"){
            ?>
                <div class="el-vert">
                <a href="chat.php?partner=<?= $value->getUsername()?>" class="blanco-links"><li><?= $value->getUsername()?></li></a>
                <li class="li-right">&ensp; <?php 
                    if(isset($unreadMessages-> $friendName)){
                        echo $unreadMessages-> $friendName;
                    } else {
                        echo 0;
                    }  
                ?>&ensp;</li>
                </div><br>
            <?php }}} else { ?>
                <div class="el-vert">
                    <li>Keine Freunde gefunden</li>
                </div>
            <?php } ?>
    </ul>
    <hr class="hr">
    <h1>New Requests</h1>
    <ol>
        <?php
            foreach($friendsList as $value){
                if(($value->getStatus()) === "requested"){
        ?>
            <li><a>Friend request from <b><?=$value->getUsername()?></b></a>
            <form method="POST">
                <button class="acceptButton" name="accept" value="<?= $value->getUsername()?>"> Accept </button>
                <button class="declineButton" name="decline" value="<?= $value->getUsername()?>"> Decline </button></li>
            </form>
        <?php }} ?>
    </ol>
    <hr class="hr">

    <form method="post" id="friendForm">

        <input class="messageinput" type="text" id="Add" name="addName" placeholder="Add Friend to List">

        <input class="submitbutton" type="submit" id="submitbutton" name="action" value="Add">
    </form>
    <div id="users">

    </div>
</body>
</html>