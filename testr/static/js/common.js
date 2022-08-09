function toggleElement(e,d) {
    var x = document.getElementById(e);
    if (x.style.display === d)
        x.style.display = "none";
    else
        x.style.display = d;
}

function approve_deny(u, e) {
    var data = new FormData();
    data.append('email',e);
    var xhr = new XMLHttpRequest();
    xhr.open('POST',u);
    xhr.send(data);
}

function classRow(r,c) {
    var x = document.getElementById("applications-table");
    x.rows[r].className = c;
}