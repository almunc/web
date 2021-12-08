<html>
    <head>
    </head>
    <body>
<?php
require("start.php");
echo "Hier ist User" . "<br>";
$user = new Model\User("Test");
$json = json_encode($user);
echo $json . "<br>";
$jsonObject = json_decode($json);
$newUser = Model\User::fromJson($jsonObject);
var_dump($newUser);
echo  "<br>" . "-------------------------------------------------------";
echo "<br>" . "Hier ist Friend" . "<br>";
$friend = new Model\Friend("Test");
$json = json_encode($friend);
echo $json . "<br>";
$jsonObject = json_decode($json);
$newFriend = Model\Friend::fromJson($jsonObject);
var_dump($newFriend);
echo  "<br>" . "-------------------------------------------------------" . "<br>";
echo "<br>" . "Hier ist Backend" . "<br>";
$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);
var_dump($service->test());
echo  "<br>" . "-------------------------------------------------------" . "<br>";
echo "<br>" . "Hier ist Login" . "<br>";
var_dump($service->login("Test777", "12345678"));
echo  "<br>" . "-------------------------------------------------------" . "<br>";
echo "<br>" . "Hier ist Register" . "<br>";
var_dump($service->register("Test222", "12345678"));
echo  "<br>" . "-------------------------------------------------------" . "<br>";
echo "<br>" . "Hier ist UserExists" . "<br>";
var_dump($service->userExists("Tom"));
echo  "<br>" . "-------------------------------------------------------" . "<br>";

?>
</body>
</html>
