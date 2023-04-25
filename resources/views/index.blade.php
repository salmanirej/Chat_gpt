<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>OpenAI Chatbot Example</title>
</head>
<body>
    <h1>OpenAI Chatbot Example</h1>
    <div id="chatbox"></div>

    <script>
        // Make API request
        fetch("https://api.openai.com/v1/chat", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": "Bearer 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" // Replace with your API key
            },
            body: JSON.stringify({
                "model": "text-davinci-003",
                "prompt": "Hello, how are you?",
                "temperature": 0.5,
                "max_tokens": 50,
                "n": 1,
                "stop": "\n"
            })
        })
        .then(response => response.json())
        .then(data => {
            // Display response
            const chatbox = document.getElementById("chatbox");
            chatbox.innerHTML += "<p><strong>User:</strong> Hello, how are you?</p>";
            chatbox.innerHTML += "<p><strong>AI:</strong> " + data.choices[0].text + "</p>";
        })
        .catch(error => console.error(error));
    </script>
</body>
</html>
