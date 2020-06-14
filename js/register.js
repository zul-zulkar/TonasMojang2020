function validatePassword(){
    var password = document.getElementById("password"), passconf = document.getElementById("passconf");
    if(password.value != passconf.value) {
        confirm_password.setCustomValidity("Passwords tidak cocok");
    } else {
        confirm_password.setCustomValidity('');
    }
}
