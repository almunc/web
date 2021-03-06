/*getting elements*/
const username = document.getElementById("Username");
const password = document.getElementById("Password");
const form = document.getElementById("form");
const confirm = document.getElementById("ConfirmPassword");
/*--------------------------------------------------- */

/*Events */
username.addEventListener("keyup", () => {
    if (username.value.length < 3) {
        username.className = "error-input";
    } else {
        username.className = "valid-input";
    }
    
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = () => {
        if (xmlhttp.readyState == 4) {
            if (xmlhttp.status == 204) {
                console.log("Exists");
                username.className = "error-input";
            } else if (xmlhttp.status == 404) {
                console.log("Does not exist");
            }
        }
    };
    xmlhttp.open("GET", `https://online-lectures-cs.thi.de/chat/95caaad9-3863-4f4b-b28d-feb59be76b47/user/${username.value}`, true);
    xmlhttp.send();
});

password.addEventListener("keyup", () => {
    if (password.value.length < 8) {
        password.className = "error-input";
    } else {
        password.className = "valid-input";
    }
});

confirm.addEventListener("keyup", () => {
    if (confirm.value != password.value) {
        confirm.className = "error-input";
    } else {
        confirm.className = "valid-input";
    }
});

/*user cant submit without any given correct informations */
/*form.addEventListener("submit", e => {
    if (username.className == "error-input" || password.className == "error-input" || confirm.className == "error-input") {       
        //var msg = document.getElementById("error");
        //msg.style.display = "block";
        //e.preventDefault();
    }
});

/*------------------------------------------- */