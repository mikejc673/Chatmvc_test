<?php
class ChatModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=messagerie', 'root', '');
    }

    public function getRooms() {
        $stmt = $this->db->query("SELECT * FROM rooms");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMessages($room_id) {
        $stmt = $this->db->prepare("SELECT m.*, u.pseudo FROM messages m JOIN users u ON m.user_id = u.id WHERE m.room_id = ? ORDER BY m.timestamp DESC LIMIT 10");
        $stmt->execute([$room_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertMessage($user_id, $room_id, $msg_text, $timestamp) {
        $stmt = $this->db->prepare("INSERT INTO messages (user_id, room_id, msg_text, timestamp) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $room_id, $msg_text, $timestamp]);
    }

    public function searchMessages(string $keyword) {
        $stmt = $this->db->prepare("SELECT * FROM messages WHERE message LIKE :keyword");
        $stmt->execute(['keyword' => '%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}