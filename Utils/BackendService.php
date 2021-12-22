<?php
namespace Utils;

use Model\Friend;

class BackendService {
    private $base;
    private $id;
    private $bUrl;

    public function __construct($base, $id) {
        $this->base = $base;
        $this->id = $id;
        $this->bUrl = "{$base}/{$id}/";
    }

    public function test() {
        try {
        return HttpClient::get($this->bUrl . '/test.json');
        } catch(\Exception $e) {
        error_log($e);
        }
        return false;
        }
    
    public function login($username, $password) {
        try {
            $result = HttpClient::post($this->bUrl . "login", 
                array("username" => $username, "password" => $password));
            //echo "Token: " . $result->token;
            $_SESSION['chat_token'] = $result->token;
            return true;
        } catch(\Exception $e) {
            //echo "Authentification failed" . "<br>";
            return false;
        }
    }

    public function register($username, $password) {
        try {
            $result = HttpClient::post($this->bUrl . "register", 
                array("username" => $username, "password" => $password));
            //echo "Token: " . $result->token;
            $_SESSION['chat_token'] = $result->token;
            return true;
        } catch(\Exception $e) {
            //echo "Registration failed" . "<br>";
            return false;
        }
    }

    public function userExists($username) {
        try {
            return HttpClient::get($this->bUrl . "user/" . $username);
        } catch(\Exception $e) {
            //var_dump($e);
            return false;
        }
    }

//----------------------------------------------------------------------------------------------------------------------------------------------
//Implement those methods you need, to do this use the following link to get the code-examples: https://online-lectures-cs.thi.de/chat/full/56ce2af0-ee84-4e78-85bc-6bba6c51c739
//dont forget to add our Collection ID
//after that try your methods in the test.php like i did

  public function loadUser($username) {
    try {
        return HttpClient::get($this->bUrl . "user/" . $username, $_SESSION["chat_token"]); 
    } catch(\Exception $e) {
        echo $e;
    }
  }
  
  public function saveUser($user) {
      try {
          return HttpClient::post($this->bUrl . "user/", $user, $_SESSION["chat_token"]);
      } catch(\Exception $e){
          error_log($e);
      }
      return false;
  }

  public function loadFriends() {
      
      try {
          $response = HttpClient::get($this->bUrl . "friend/", $_SESSION["chat_token"]);
          $friends = array();
          foreach($response as $friend){
            array_push($friends, Friend::fromJson($friend));
          }
          return $friends;
      } catch(\Exception $e){
          error_log($e);
      } 
      return false;
  }

  public function friendRequest($friend) {
        try {
            return HttpClient::post($this->bUrl . "friend/", $friend, $_SESSION["chat_token"]);
        } catch(\Exception $e) {
            error_log($e);
        }
        return false;
  }

  public function friendAccept($friend) {
        try {
            return HttpClient::put($this->bUrl . "friend/" . $friend->getUsername(), array("status" => "accepted"), $_SESSION["chat_token"]);
        } catch(\Exception $e) {
            error_log($e);
        }
        return false;
  }

  public function friendDismissed($friend) {
        try {
            return HttpClient::put($this->bUrl . "friend/" . $friend->getUsername(), array("status" => "dismissed"), $_SESSION["chat_token"]);
        } catch(\Exception $e) {
            error_log($e);
        }
        return false;
  }

  public function friendRemove($friend) {
    try {
        return HttpClient::delete($this->bUrl . "friend/" . $friend->getUsername(), $_SESSION["chat_token"]);
    } catch(\Exception $e) {
        error_log($e);
    }
    return false;
  }

  public function getUnread() {
      try {
          return HttpClient::get($this->bUrl. "unread/", $_SESSION["chat_token"]);
      } catch(\Exception $e){
          error_log($e);
      }
      return false;
  }    
}
?>