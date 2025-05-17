<!-- Simple Floating Chatbot -->
<style>
#chatbot-toggle {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #007bff;
    color: white;
    border-radius: 50%;
    padding: 15px;
    cursor: pointer;
    font-size: 20px;
    z-index: 1000;
}

#chatbot-box {
    position: fixed;
    bottom: 80px;
    right: 20px;
    width: 300px;
    background: white;
    border: 1px solid #ccc;
    border-radius: 10px;
    display: none;
    z-index: 999;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
}

#chatbot-messages {
    max-height: 200px;
    overflow-y: auto;
    padding: 10px;
}

#chatbot-input {
    display: flex;
    border-top: 1px solid #ccc;
}

#chatbot-input input {
    flex: 1;
    padding: 10px;
    border: none;
}

#chatbot-input button {
    background: #007bff;
    color: white;
    border: none;
    padding: 10px 15px;
}
</style>

<div id="chatbot-toggle">💬</div>

<div id="chatbot-box">
    <div id="chatbot-messages">
        <p><strong>JIMIA:</strong> 
<?php
$name = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'there';
echo "Hello $name, how can I help you today?";
?>
</p>

    </div>
    <div id="chatbot-input">
        <input type="text" id="chatbot-question" placeholder="Type your question...">
        <button onclick="sendChat()">Send</button>
    </div>
</div>

<script>
document.getElementById('chatbot-toggle').onclick = function () {
    var box = document.getElementById('chatbot-box');
    box.style.display = (box.style.display === 'block') ? 'none' : 'block';
};

<script>
let voices = [];

function loadVoices() {
    voices = speechSynthesis.getVoices();
    // Reload voices if not loaded yet (Chrome issue)
    if (voices.length === 0) {
        setTimeout(loadVoices, 100);
    }
}
loadVoices(); // Load voices on page load

function speak(text) {
    if ('speechSynthesis' in window) {
        const utterance = new SpeechSynthesisUtterance(text);
        const female = voices.find(voice =>
            voice.name.includes("Female") ||
            voice.name.includes("Google UK English Female") ||
            voice.name.includes("Microsoft Zira")
        );
        if (female) utterance.voice = female;
        utterance.pitch = 1.2;
        utterance.rate = 1;
        speechSynthesis.speak(utterance);
    }
}
</script>
