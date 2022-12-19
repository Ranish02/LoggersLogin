function myFunction() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
var x = document.getElementById("password");
var clicker = document.getElementById("click");
var clickss = document.getElementById("clicks");
clicker.addEventListener("click", function () {
    if (x.type === "password") {
        x.type = "text";
        clickss.className = "bi bi-eye";

    } else {
        x.type = "password";
        clickss.className = "bi bi-eye-slash";
    }
});