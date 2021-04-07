function pageLoad(page) {
	$("#content").load("menu_" + page + ".php");
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
        x.setAttribute("name", "child"+i);
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