<?php
namespace Classes\Dao;

use Classes\Models\User;
use Exception;
use PDO;

class UserDao {

    private $conn;
    private $error;


    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getConn() {
        return $this->conn;
    }

    public function getError() {
        return $this->error;
    }

    public function setError($error) {
        $this->error = $error;
    }

    public static function getbyId($db, $id) {
        $user = new User();
        try {
            $stmt = $db->prepare("SELECT u.id, u.name, u.email, u.password, u.date_registered, r.name as role
                               FROM table_user u, table_role r
                               WHERE u.role_id = r.id
                               AND u.id = :id");
            $stmt->execute(['id' => $id]);
            while ($row = $stmt->fetch()) {
                $user->fill($row);
            }
            return $user;
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    public function login($username, $pass) {
        $db = $this->getConn();
        $db->beginTransaction();

        try {
            $stmt = $db->prepare("SELECT id_user, username, pass FROM users WHERE username = :username");
            $stmt->execute(['username' => $username]);
            $row = $stmt->fetch();
            $user = new User();
            if (!$row) throw new Exception('El usuario no existe');
            $user->fill($row);

            $result = password_verify('1234', '$2y$10$dk6q.i/ZpVns7J5liMxe1.7Ho');

            if (!password_verify($pass, $user->getPassword())) {
                throw new Exception('Usuario o contraseña incorrecto');
            }
            $db->commit();
            return $user;
        } catch (Exception $e) {
            $db->rollBack();
            switch ($e->getCode()) {
                case '42S22':
                    $this->setError('Usuario no existe');
                    break;
                default:
                    $this->setError($e->getMessage());
            }
        }
    }

    public function insertNewUser($username, $email, $pass) {
        $db = $this->getConn();
        $stmt = $db->prepare("INSERT INTO users(username, pass) VALUES (:username, :password)");
        $result = $stmt->execute(['username' => $username, 'password' => password_hash($pass, PASSWORD_DEFAULT)]);
        return $result;
    }

    public function updateUser($id, $name, $email, $pass = null) {
        $db = $this->getConn();
        $db->beginTransaction();
        try {
            $sql = "UPDATE table_user 
                    SET name = :name,
                        email = :email";
            if ($pass) $sql .= ", password = :password";
            $sql .= " WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam('name', $name);
            $stmt->bindParam('email', $email);
            if ($pass) $stmt->bindParam('password', $pass);
            $stmt->bindParam('id', $id, PDO::PARAM_INT);

            $result = $stmt->execute();
            if ($result) {
                $db->commit();
            }
            return $result;
        } catch (Exception $e) {
            $db->rollBack();
            var_dump($this->getError()); die();
            $this->setError($e->getMessage());
        }
    }
}