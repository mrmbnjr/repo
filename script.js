// show login form and hide register form
var login = document.getElementById('loginForm');
var register = document.getElementById('registerForm');

function loginForm() {
    login.style.display = "block";
    register.style.display = "none";
}

function registerForm() {
    login.style.display = "none";
    register.style.display = "block";
}

// hide error messages when typing
document.addEventListener("DOMContentLoaded", function () {
    // Select all inputs inside the forms
    const inputs = document.querySelectorAll("input");

    inputs.forEach(input => {
        input.addEventListener("input", function () {
            // Remove 'is-invalid' class when typing
            this.classList.remove("is-invalid");

            // Hide the small error message
            let errorMsg = this.parentElement.querySelector(".text-danger");
            if (errorMsg) {
                errorMsg.style.display = "none";
            }
        });
    });
});