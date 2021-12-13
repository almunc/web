<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheet.css" rel="stylesheet">
    <?php
        require("start.php");
        if(isset( $_SESSION['user'])) {
        header("Location: friends.php");    
        }
        ?>
    <title>Login</title>
</head>
<body>
    <br> <br>
    <img src="images/chat.png" width="100" height="100" class="general-img"> <br>
    <h1 class="text-centered">Please sign in</h1><br>
    <?php
    if(isset($_POST["username"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $service->login($username, $password);
    if($service->login($username, $password) == true) {
        $_SESSION['user'] = $username;
        header("Location: friends.php");
    } else 
    echo "
    <p style=\"color: red;margin-left: 380px; font-weight: bold;\">Authentification failed!</p>
    ";
    }
    ?>
    <fieldset class="fieldset">
        <legend>Login</legend>
        <div class="text-centered">
    <form action='login.php' method='POST'>
        <table class="text-centered">
            <tr>
                <td class="lefttable">
                    <label for='username'>Username</label>
                </td>
                <td>
                    <input class="formularinput" type='text' id='Username'
                    name='username' placeholder='Username' required>
                </td>
            </tr>
            <tr>
                <td class="lefttable">
                    <label for='password'>Password</label>
                </td>
                <td>
                    <input class="formularinput" type='Password' id='Password'
                    name='password' placeholder='Password' required>
                </td>
            </tr>
        </table>
    </div>
        </fieldset> <br>
        <table class="text-centered"> 
            <tr>
                <td>
                    <a href="register.php">
                    <input class="greybutton" type="button" value="Register">
                    </a>
                </td>
                <td>
                        <input class="bluebutton" type="submit" value="Login">
                </td>
            </tr>
        </table>
    </form>
    </body>
    </html>
