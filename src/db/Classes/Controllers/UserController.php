<?php
use Classes\Dao\UserDao;
use Classes\Dao\NewsDao;
use Classes\Models\User;

class UserController {
    protected $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function login($dataForm) {
        $username = $dataForm['username'];
        $pass = $dataForm['password'];

        $userDao = new UserDao($this->container['db']);

        if (empty($username) || empty($pass)) {
            // Si no se rellena alguno de los campos del formulario se devuelve error
            return [
                "error" => [
                    "type" => "Warning",
                    "msg" => "Debe rellenar todos los campos",
                ],
            ];
        } else {
            $user = $userDao->login($username, $pass);
            if (!($user instanceof User)) {
                // Si la BD ha devuelto error
                return [
                    "error" => [
                        "type" => "Critical",
                        "msg" => $userDao->getError()
                    ],
                ];
            };
            return $user;
        }
    }

    public function register($dataForm) {
        $username = $dataForm['username'];
        $email = $dataForm['email'];
        $pass = $dataForm['password'];

        if (empty($username) || empty($email) || empty($pass)) {
            // Si no se rellena alguno de los campos del formulario se devuelve error
            return [
                "error" => [
                    "type" => "Warning",
                    "msg" => "Debe rellenar todos los campos",
                ],
            ];
        } else {
            $userDao = new UserDao($this->container['db']);
            $isInserted = $userDao->insertNewUser($username, $email, $pass);
            if ($isInserted) {
                return $this->login($dataForm);
            } else {
                return [
                    "error" => [
                        "type" => "Critical",
                        "msg" => $userDao->getError(),
                    ],
                ];
            }
        }
    }

    public function listAllNews($req, $res, $args) {
        $newsDao = new NewsDao($this->container['db']);
        if ($_SESSION['user']->getRole() == 'autor') {
            // Si es periodista solo se listaran las propias
            $news = $newsDao->listOwnNews($_SESSION['user']->getId());
        } else {
            $news = $newsDao->listAll();
        }

        if ($newsDao->getError()) {
            return $newsDao->getError();
        }

        return $news;
    }

    public function updateUser($dataForm) {
        $id = $_SESSION['user']->getId();
        $name = $dataForm['name'];
        $email = $dataForm['email'];
        $password = $dataForm['password'];

        $pass = null;
        if (!empty($password)) {
            $pass = password_hash($password, PASSWORD_DEFAULT);
        }
        $userDao = new UserDao($this->container['db']);
        $result = $userDao->updateUser($id, $name, $email, $pass);
        if ($userDao->getError()) {
            return $userDao->getError();
        }
        $_SESSION['user'] = UserDao::getbyId($userDao->getConn(), $id);
        return $result;
    }
}