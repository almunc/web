const users = document.getElementById("users");
const search = document.getElementById("Add");
const submit = document.getElementById("friendForm");
let userData;

search.addEventListener("keyup", () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            userData = JSON.parse(xmlhttp.responseText);
            listUser(userData);
        }
    };
    xmlhttp.open("GET", `${window.baseURL}/${window.chatCollectionId}/user`, true);
    xmlhttp.setRequestHeader("Authorization", "Bearer " + window.chatToken);
    xmlhttp.send();
});

function listUser(listUser){
    users.innerHTML = null;
    for(let userPosition in listUser){
        let equal = 0;
        for(let position = 0; position < search.value.length; position++){
            if(listUser[userPosition][position] === search.value[position]){
                equal = 1;
            } else {
                equal = 0;
            }
        }
        if(equal === 1){
            let user = document.createElement("p");
            user.className = "userList";
            user.innerHTML = listUser[userPosition];
            users.appendChild(user);
        }
    }
}

document.addEventListener('click', function(e){
    if(e.target && e.target.className === "userList"){
        putName(e);
    }
})

function putName(event){
    console.log(event);
    search.value = event.target.innerHTML;
}

submit.addEventListener("submit", e => {
    let existing = 0;
    for(let i in userData){
        if(search.value === userData[i]){
            existing = 1;
        }
    }
    
    if(existing === 0){
        e.preventDefault();
    }
});