<?php
namespace Model;
use JsonSerializable;
class User implements JsonSerializable {
    private $username;

    public function __construct($username = NULL,) {
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username;
    }

    //serialize
    public function jsonSerialize() {
        return get_object_vars($this);
    }

    //deserialize
    public static function fromJson($data) {
        $user = new User();
        foreach ($data as $key => $value) {
            $user->{$key} = $value;
        }
        return $user;
    }
}
?>