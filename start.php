<?php
session_start();
define('CHAT_SERVER_URL', 'https://online-lectures-cs.thi.de/chat');
define('CHAT_SERVER_ID', '95caaad9-3863-4f4b-b28d-feb59be76b47'); # Ihre Collection ID

spl_autoload_register(function($class) {
    include str_replace('\\', '/', $class) . '.php';
});
    
$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID); 
?>
