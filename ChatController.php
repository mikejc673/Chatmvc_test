<?php
declare(strict_types=1);
namespace Controllers;
require_once __DIR__ . '/../Models/ChatModel.php';
use Models\ChatModel;

class ChatController {
    private ChatModel $model;

    public function __construct() {
        $this->model = new ChatModel();
    }

    public function chatIndex() {
        $rooms = $this->model->getRooms();
        $messages = $this->model->getMessages(1); // Salon par défaut
        $this->render('chat/ChatView', ['rooms' => $rooms, 'messages' => $messages]);
    }

    public function render($view, $data = []) {
        extract($data);
        require_once "views/$view.php";
    }

    public function insertMessage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $this->model->insertMessage($_SESSION['user_id'], $data['room'], $data['message'], time());
        }
    }


	public function getMessages() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$data = json_decode(file_get_contents('php://input'), true);
			$messages = $this->model->getMessages($data['room']);
			echo json_encode($messages);
		}
	}
	
    public function search() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $keyword = $_POST['keyword'];
        $results = $this->model->searchMessages($keyword);
        $this->render('chat/SearchView', ['results' => $results]);
    } else {
        $this->render('chat/SearchView', []);
    }
}
}