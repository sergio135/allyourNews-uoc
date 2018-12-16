<?php
namespace Classes\Models;

class User {

    private $id_user;
    private $username;
    private $email;
    private $password;

    public function getId() {
        return $this->id_user;
    }

    public function setId($id_user) {
        $this->id_user = $id_user;
    }

    public function getName() {
        return $this->username;
    }

    public function setName($username) {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getDateRegistered() {
        return $this->date_registered;
    }

    public function setDateRegistered($date_registered) {
        $this->date_registered = $date_registered;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function fill(array $row) {
        $this->id_user = $row['id_user'];
        $this->username = $row['username'];
        $this->password = $row['pass'];
    }
}

?>