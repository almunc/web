<?php
namespace Utils;

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
            echo $e . "<br>";
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
            return HttpClient::get($this->bUrl . $username);
        } catch(\Exception $e) {
            return false;
        }
    }

//----------------------------------------------------------------------------------------------------------------------------------------------
//Implement those methods you need, to do this use the following link to get the code-examples: https://online-lectures-cs.thi.de/chat/full/56ce2af0-ee84-4e78-85bc-6bba6c51c739
//dont forget to add our Collection ID
//after that try your methods in the test.php like i did

  public function loadUser($username, $token) {
    try {
        return HttpClient::get($this->bUrl . "user/" . $username, $token);
    } catch(\Exception $e) {
        echo $e;
    }
  }
  
  public function saveUser($user) {
  }

  public function loadFriends() {
  }

  public function friendRequest($friend) {
  }

  public function friendAccept($friend) {
  }

  public function friendDismissed($friend) {
  }

  public function friendRemove($friend) {   
  }

  public function getUnread() {
  }    
}
?>