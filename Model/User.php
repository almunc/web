<?php
namespace Model;
use JsonSerializable;
class User implements JsonSerializable {
    private $username;
    private $firstName;
    private $lastName;
    private $description;
    private $coffeeOrTea;
    private $layout;

    public function __construct($username = NULL, $firstName = NULL, $lastName = NULL, $description = NULL, $coffeeOrTea = NULL, $layout = "on"){
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->description = $description;
        $this->coffeeOrTea = $coffeeOrTea;
        $this->layout = $layout;
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

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getCoffeeOrTea() {
        return $this->coffeeOrTea;
    }

    public function setCoffeeOrTea($coffeeOrTea) {
        $this->coffeeOrTea = $coffeeOrTea;
    }

    public function getLayout() {
        return $this->layout;
    }

    public function setLayout($layout) {
        $this->layout = $layout;
    }
}
?>