const recognition = new webkitSpeechRecognition();
recognition.lang = 'en-US';

document.getElementById('converter').addEventListener('click', () => {
    recognition.start();
});


recognition.onresult = event => {
    const transcript = event.results[0][0].transcript;
    sendRequest(transcript);
};

recognition.onerror = event => {
    console.error('Error: ', event);
};

function sendRequest(transcript) {
    fetch('controller.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `text=${transcript}`
        })
    .then(response => response.text())
    .then(data => {
    document.getElementById('output').value = data;
    });
}