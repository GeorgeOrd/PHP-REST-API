function jsonShow() {
    let x = document.getElementById("jsonDIV");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function redirectToXML(){
    window.location="xmlVenta.php";
}
