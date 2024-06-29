function changePlaceholders() {
    var userType = document.getElementById("user_type").value;
    var usernameInput = document.getElementsByName("username")[0];
    var fullnameInput = document.getElementsByName("fullname")[0];
    var emailInput = document.getElementsByName("email")[0];

    if (userType === "company") {
        usernameInput.placeholder = "Company Username";
        fullnameInput.placeholder = "Company Type";
        emailInput.placeholder = "Company E-Mail";
    } else {
        usernameInput.placeholder = "Username";
        fullnameInput.placeholder = "Name";
        emailInput.placeholder = "E-Mail";
    }
}