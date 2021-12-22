<?php
require "start.php";

if(empty($_SESSION["user"])) {
    header("Location: login.php");
    die;
}

if(empty($_GET["user"])) {
    header("Location: friends.php");
    die;
}

$username = $_GET["user"];

$data = $service->loadUser($username);
$user = Model\User::fromJson($data);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheet.css" rel="stylesheet">
    <title>Profile of <?= $username ?></title>
</head>

<body>
    <h1>Profile of <?= $username ?></h1>
    <p>
        <a href="chat.php?partner=<?= $username ?>" class="blue-links">&lt; Back to Chat</a>
        |
        <a href="friends.php" class="red-links">Remove Friend</a>
    </p>
    <div class="grid">
        <div class="col1">
            <img src="images/profile.png" alt="profile" class="profile-img">	
        </div>
        <div class="col2">
            <fieldset class="profile-fieldset">
                <p>
                    <?= $user->getDescription() ?>
                </p>
                <dt><b>Coffe or Tea?</b></dt>
                <dd><?= $user->getCoffeeOrTea() ?></dd>
                <dt><b>Name</b></dt>
                <dd><?= "{$user->getFirstName()} {$user->getLastName()}" ?></dd>
            </fieldset>
        </div>
    </div>
</body>
</html>