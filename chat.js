const socket = new WebSocket('ws://localhost:9000');

socket.onmessage = function(event) {
    const msg = JSON.parse(event.data);
    document.querySelector('.messages').innerHTML += `<p>${msg.name}: ${msg.message}</p>`;
};

function sendMessage() {
    const message = document.getElementById('message').value;
    const name = document.getElementById('username').value || 'Anonymous';
    const room = 1; // À adapter selon le salon
    const data = { message, name, room };
    socket.send(JSON.stringify(data));
    storeMessage(message, name, room);
    document.getElementById('message').value = '';
}

function storeMessage(message, name, room) {
    fetch('index.php?action=chat/insertMessage', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ message, name, room })
    });
}