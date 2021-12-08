<?php
namespace Model;
use JsonSerializable;
class Friend implements JsonSerializable {
    private $username;
    private $status;

    public function __construct($username = NULL , $status = NULL, $usernameempfaengt = NULL) {
        $this->username = $username;
        $this->status = $status;
        $this->usernameempfaengt = $usernameempfaengt;
    }

    public function getUsername() {
        return $this->username;
        }
    
    public function getStatus() {
        return $this->status;
    }

    //serialize
    public function jsonSerialize() {
        return get_object_vars($this);
        }

    //deserialize
    public static function fromJson($data) {
        $friend = new Friend();
        foreach ($data as $key => $value) {
            $friend->{$key} = $value;
        }
        return $friend;
    }
   
    //not sure about that -> little informations given at page 11 
    public function accepted() {
        $this->usernameempfaengt = true;
    }

    public function dismissed() {
        $this->usernameempfaengt = false;
    }

}
?>