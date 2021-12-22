<?php
    require("start.php");
    
    if(empty($_SESSION["user"])) {
        header("Location: login.php");
        die;
    }

    if(isset($_POST["saveSettings"])){
        $user = Model\User::fromJson($service->loadUser($_SESSION["user"]));
        $user->setFirstName($_POST["firstName"]);
        $user->setLastName($_POST["lastName"]);
        $user->setCoffeeOrTea($_POST["coffeOrTea"]);
        $user->setDescription($_POST["aboutMe"]);
        $user->setLayout($_POST["inOrOutline"]);
        $service->saveUser($user);
        header("Location: friends.php");
    }

    $user = Model\User::fromJson($service->loadUser($_SESSION["user"]));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheet.css" rel="stylesheet">
    <title>Settings</title>
</head>
<body>
    <h1>Profile Settings</h1>
        <form method="POST">
            <fieldset class="fieldset">
                <legend>Base Data</legend>
                <table class="text-centered">
                    <tr>
                        <td class="lefttable">
                            <label for="fristName">First Name</label> 
                        </td>
                        <td class="righttable">
                            <?php if(($user->getFirstName())===NULL){ ?>
                                <input class="formularinput" type="text" name="firstName" id="firstName" placeholder="First Name">
                            <?php } else {?>
                                <input class="formularinput" type="text" name="firstName" id="firstName" placeholder="First Name" value="<?=$user->getFirstName()?>">
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="lefttable">
                            <label for="fristName">Last Name</label>
                        </td>
                        <td class="righttable">
                            <?php if(($user->getLastName())===NULL){ ?>
                                <input class="formularinput" type="text" name="lastName" id="lastName" placeholder="Last Name">
                            <?php } else {?>
                                <input class="formularinput" type="text" name="lastName" id="lastName" placeholder="Last Name" value="<?=$user->getLastName()?>">
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="lefttable">
                            <label for="coffeeOrTea">Coffe or Tea?</label>
                        </td>
                        <td class="righttable">
                            <?php 
                                switch($user->getCoffeeOrTea()){
                                    case "Neither nor":
                                        ?>
                                        <select class="settingSelect" name="coffeOrTea" id="coffeeOrTea">
                                            <option selected value="Neither nor">Neither nor</option>
                                            <option value="Coffee">Coffee</option>
                                            <option value="Tea">Tea</option>
                                        </select>
                            <?php
                                        break;

                                    case "Coffee":
                                        ?>
                                        <select class="settingSelect" name="coffeOrTea" id="coffeeOrTea">
                                            <option value="Neither nor">Neither nor</option>
                                            <option selected value="Coffee">Coffee</option>
                                            <option value="Tea">Tea</option>
                                        </select>
                            <?php
                                        break;
                                    
                                    case "Tea":
                                        ?>
                                        <select class="settingSelect" name="coffeOrTea" id="coffeeOrTea">
                                            <option value="Neither nor">Neither nor</option>
                                            <option value="Coffee">Coffee</option>
                                            <option selected value="Tea">Tea</option>
                                        </select>
                            <?php
                                        break;

                                    default:
                                        ?>
                                        <select class="settingSelect" name="coffeOrTea" id="coffeeOrTea">
                                            <option value="Neither nor">Neither nor</option>
                                            <option value="Coffee">Coffee</option>
                                            <option value="Tea">Tea</option>
                                        </select>
                            <?php
                                        break;
                                }
                            ?>
                                
                        </td>
                    </tr>
                </table>
            </fieldset> <br>
            <fieldset class="fieldset">
                <legend>Tell Something About You</legend>
                <?php if(($user->getDescription())===NULL){ ?>
                    <textarea class="settingsTextArea" name="aboutMe" id="aboutMe" cols="20" rows="10" placeholder="Leave a comment here"></textarea>
                <?php } else {?>
                    <textarea class="settingsTextArea" name="aboutMe" id="aboutMe" cols="20" rows="10" placeholder="Leave a comment here"><?= $user->getDescription() ?></textarea>
                <?php } ?>
            </fieldset> <br>
            <fieldset class="fieldset">
                <legend>Preferred Chat Layout</legend>
                <?php if(($user->getLayout())=== "off"){ ?>
                    <p><input checked type="radio" name="inOrOutline" id="inline" value="off">Username and message in one line</p>
                    <p><input type="radio" name="inOrOutline" id="outline" value="on">Username and message in separated lines</p>
                <?php } else {?>
                    <p><input type="radio" name="inOrOutline" id="inline" value="off">Username and message in one line</p>
                    <p><input checked type="radio" name="inOrOutline" id="outline" value="on">Username and message in separated lines</p>
                <?php } ?>
            </fieldset>
            <table class="text-centered">
                <tr>
                    <td>
                        <a href="friends.php"><input class="greybutton" type="button" value="Cancel"></a>
                    </td>
                    <td>
                        <button class="bluebutton" type="submit" name="saveSettings" >Save</button>
                    </td>
                </tr>
            </table>
        </form>
</body>
</html>