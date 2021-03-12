var http;

if (window.XMLHttpRequest) {

    http = new XMLHttpRequest();
}
else {

    http = new ActiveXObject("Microsoft.XMLHTTP");
}

function pageLoad(page) {
    var time = new Date().getTime();

    http.open("GET", "menu_" + page + ".php?time=" + time, true);

    http.onreadystatechange = function () {
        if (http.readyState == 4) {
            document.getElementById('content').innerHTML = http.responseText;
        }
    }

    http.send(null);
}




function addInput() {
    let value = document.getElementById("numbersOfChildren").value;

    const collection = document.querySelectorAll('.rem');

    for (let i = 0; i < collection.length; i++) {
        collection[i].remove();
    }

    for (i = 1; i <= value; i++) {
        let x = document.createElement("INPUT");
        x.setAttribute("type", "date");
        x.setAttribute("id", i);
        x.setAttribute("class", "rem");
        document.getElementById("form").insertBefore(x, document.getElementById("button"));

        let y = document.createElement("BR");
        y.setAttribute("class", "rem");
        document.getElementById("form").insertBefore(y, document.getElementById(i));

        let z = document.createElement("LABEL");
        let t = document.createTextNode(i + ". gyermek születési ideje");
        z.setAttribute("for", i);
        z.setAttribute("class", "rem");
        z.appendChild(t);
        document.getElementById("form").insertBefore(z, document.getElementById(i));

        let w = document.createElement("BR");
        w.setAttribute("class", "rem");
        document.getElementById("form").insertBefore(w, document.getElementById(i));

    }
}