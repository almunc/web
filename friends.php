<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheet.css" rel="stylesheet">
    <?php
        require("start.php");
        ?>
    <script defer src="js/friends.js"></script>
    <script>
        window.chatToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNjM1ODU2MzYzfQ.w-ELZ7Kml1qEPaJi9JJyQaeRh0Z6bUKK1jBWM4FWWMY";
        window.chatCollectionId = "95caaad9-3863-4f4b-b28d-feb59be76b47";
        window.baseURL = "https://online-lectures-cs.thi.de/chat";
    </script>
    <title>Friends</title>
</head>
<body>
    <h1>Friends</h1>
    <table>
        <tr>
            <td>
        <a href="logout.php" class="blue-links"> &lt;Logout </a>
        <b>|</b><a href= "settings.html" class="blue-links"> Settings</a>
        </td>
    </tr>
    </table>
    <hr class="hr">
    <ul class="field-layout"> <br>
        <div class="el-vert">
      <a href="chat.html" class="blanco-links"><li>Tom</li></a>
      <li class="li-right">&ensp;3&ensp;</li>
      </div> <br>
      <div class="el-vert">
      <a href="chat.html" class="blanco-links"><li>Marvin</li></a>
      <li class="li-right">&ensp;1&ensp;</li>
      </div> <br>
      <a href="chat.html" class="blanco-links"><li>Tick</li></a> <br>
      <a href="chat.html" class="blanco-links"><li>Trick</li></a> <br>
    </ul>
    <hr class="hr">
    <h1>New Requests</h1>
    <ol>
       <li><a href="" class="blue-links">Friend request from <b>Track</b></a></li>
    </ol>
    <hr class="hr">
    
    <form action="friends.html" method="get" id="friendForm">

        <input class="messageinput" type="text" id="Add" name="Add" placeholder="Add Friend to List">

        <input class="submitbutton" type="submit" id="submitbutton" value="Add">
    </form>
    <div id="users">

    </div>
</form>
</body>
</html>