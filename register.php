<?php
require("start.php");

if(isset($_POST["username"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];
    $errors = array();
    $data = $_POST;

    //validation
    if(strlen($data["username"]) < 3) {
        $errors[] = "Username too short";
    }
    if($service->userExists($username) == true) {
        $errors[] = "Username already exists";
    }
    if(strlen($data["password"]) < 8) {
        $errors[] = "Password too short";
    }
    if($data["password"] != $data["confirm"]) {
        $errors[] = "Password does not match";
    }

    if(!empty($data["username"]) && strlen($data["username"]) >= 3 && $service->userExists($username) == false && !empty($data["password"]) && strlen($data["password"]) >= 8 && $data["password"] == $data["confirm"] ) {
        if ($service->register($username, $password)) {
            $_SESSION["user"] = $username;  // SESSION MUST BE SET BEFORE ANY HTML WAS GENERATED
            header("Location: friends.php");
            die;
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link href="stylesheet.css" rel="stylesheet">
       <script defer src="js/register.js"></script>
    </head>
    <body>
        <br><br>
        <img src="./images/user.png" alt="user" style="width: 100px; height: 100px;" class="general-img"> <br>
        <h1 class="text-centered">
            Register yourself
        </h1> <br>
        <?php
        if (isset($_POST["username"])) {
            echo "<p style=\"color: red;margin-left: 380px; font-weight: bold;\">
                Registration failed!
            </p>";
        
            if(count($errors) > 0) {
                echo "<ul>";
                foreach ($errors as $error) {
                    echo '<li style="color: red;list-style: none;">' . $error . '</li>';
                }
                echo "</ul>";
            }
        }
        ?>
        <fieldset class="fieldset">
            <legend>Register</legend>
            <table class="text-centered">
            <form  id="form" action="register.php" method="POST">
                <script>
                    //window.chatToken = "...";
                    window.baseURL = "https://online-lectures-cs.thi.de/chat";
                    window.chatCollectionId = "<?= CHAT_SERVER_ID ?>";
                    window.chatServer = "<?= CHAT_SERVER_URL ?>";
                  </script>
                <tr>
                    <td class="lefttable">
                        <label for="Username">Username</label>
                    </td>
                    <td>
                        <input class="formularinput" type="text" id="Username"
                            name="username" placeholder="Username" required>
                    </td>
                </tr>
                <tr>
                    <td class="lefttable">
                        <label for="Password">Password</label>
                    </td>
                    <td>
                        <input class="formularinput" type="password" id="Password"
                            name="password" placeholder="Password" required>
                    </td>
                </tr>
                <tr>
                    <td class="lefttable">
                        <label for="ConfirmPassword"> Confirm Password</label>
                    </td>
                    <td>
                        <input class="formularinput" type="password" id="ConfirmPassword"
                            name="confirm" placeholder="Confirm Password" required>
                    </td>
                </tr>
                </table>
                </fieldset> <br>
                <table class="text-centered">
                <tr>
                    <td>
                        <a href="login.php">
                            <input class="greybutton" type="button" value="Cancel" id="button">
                            </a>
                    </td>
                    <td>
                            <input class="bluebutton" type="submit" value="Create Account">
                    </td>
                </tr>
                </table>
            </form>
    </body>
</html>