<?php
namespace Utils;
class BackendService {
    private $base;
    private $id;


    public function __construct($base, $id) {
        $this->base = $base;
        $this->id = $id;
    }

    public function test() {
        try {
        return HttpClient::get($this->base . '/test.json');
        } catch(\Exception $e) {
        error_log($e);
        }
        return false;
        }
    
    public function login($username, $password) {
        try {
            $result = HttpClient::post("https://online-lectures-cs.thi.de/chat/95caaad9-3863-4f4b-b28d-feb59be76b47/login", 
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
            $result = HttpClient::post("https://online-lectures-cs.thi.de/chat/95caaad9-3863-4f4b-b28d-feb59be76b47/register", 
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
            return HttpClient::get("https://online-lectures-cs.thi.de/chat/95caaad9-3863-4f4b-b28d-feb59be76b47/user/$username");
            //echo "Exists";
        } catch(\Exception $e) {
            //echo "Does not exist";
        }
    }

//----------------------------------------------------------------------------------------------------------------------------------------------
//Implement those methods you need, to do this use the following link to get the code-examples: https://online-lectures-cs.thi.de/chat/full/56ce2af0-ee84-4e78-85bc-6bba6c51c739
//dont forget to add our Collection ID
//after that try your methods in the test.php like i did

  public function loadUser($username) {
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