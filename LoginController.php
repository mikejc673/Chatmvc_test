<?php
namespace Controllers;
require_once __DIR__ . '/../Models/LoginModel.php';
use App\Models\LoginModel;

class LoginController {
    private $model;

    public function __construct() {
        $this->model = new LoginModel();
    }

    public function loginIndex() {
        $this->render('login/LoginView', []);
    }

    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pseudo = $_POST['pseudo'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $color = sprintf('#%06X', rand(0, 0xFFFFFF)); // Couleur aléatoire
            $this->model->createUser($pseudo, $email, $password, $color);
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['color'] = $color;
            header('Location: index.php?action=chat/chatIndex');
        } else {
            $this->render('login/SignupView', []);
        }
    }

    public function forgotpassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $this->model->retrievePassword($email, $password);
            header('Location: index.php?action=login/loginIndex');
        } else {
            $this->render('login/ForgotPassword', []);
        }
    }

    public function render($view, $data = []) {
        extract($data);
        require_once "views/$view.php";
    }
}