function appendMsg(sender, msg, time) {
    const ts = new Date(time)
    window.msgBox.innerHTML += `<div class="el-vert">
        <p>${sender}: ${msg}</p> <p class="chat-timer"> ${ts.toLocaleString()} </p>
    </div>`;
    window.msgBox.scrollTop = window.msgBox.scrollHeight;
}

setInterval(() => {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = () => {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            const res = JSON.parse(xmlhttp.responseText);
            const msgLen = res.length;
            if (msgLen > window.messageLength) {
                res.splice(window.messageLength).forEach(msg => {
                    appendMsg(msg["from"], msg["msg"], msg["time"]);
                });
                window.messageLength = msgLen;
            }
        }
    };
    xmlhttp.open("GET", `${window.baseURL}/${window.chatCollectionId}/message/${window.partner}`, true);
    xmlhttp.setRequestHeader("Authorization", "Bearer " + window.chatToken);
    xmlhttp.send();
}, 1000);


window.msgForm.addEventListener("submit", e => {
    e.preventDefault();

    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 204) {
            console.log("done...");
        }
    };
    xmlhttp.open("POST", `${window.baseURL}/${window.chatCollectionId}/message`, true);
    xmlhttp.setRequestHeader("Content-type", "application/json");
    xmlhttp.setRequestHeader("Authorization", "Bearer " + window.chatToken);
    xmlhttp.send(JSON.stringify({
        message: window.msgInp.value,
        to: window.partner
    }));

    window.msgInp.value = "";
});