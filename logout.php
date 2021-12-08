<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheet.css" rel="stylesheet">
    <?php
        require("start.php");
        session_unset();
        ?>
    <title>Logout</title>
</head>
<body>
    <br><br>
    <img src="images/logout.png" width="100" height="100" class="general-img"> <br> <br>
    <h1 class="text-centered">Logged out...</h1> <br>
    <p class="text-centered">See u!</p> <br>
    <table class="text-centered">
        <tr>
            <td>     
        <a href="login.php" class="blue-links">Login again</a>
        </td>    
    </tr>
</table>
</body>
</html>