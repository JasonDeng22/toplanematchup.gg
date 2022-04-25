/* Sources used:
1)https://cs4640.cs.virginia.edu/lectures/examples/trivia-js.html
2)
3)
4)
5)
*/

// This JS code will be used to validate inputs when logging in / signing out


// Password validate function has default length 5, but can
// be updated by parameter
$(document).ready(function () {
    document.getElementById("password").addEventListener("keyup", function () {
        passwordValidate(8);
    })
    document.getElementById("email").addEventListener("keyup", function () {
        emailValidate();
    })

    // jQuery to check if name field exists
    if ($("#name").length != 0) {
        document.getElementById("name").addEventListener("keyup", function () {
            usernameValidate();
        })
    };

    function passwordValidate(len = 8) {
        var pass = document.getElementById("password");
        var submit = document.getElementById("submit");
        var pwhelp = document.getElementById("pwhelp");
        var passval = pass.value;

        if (passval.length < len) {
            pass.classList.add("is-invalid");
            submit.disabled = true;
            pwhelp.textContent = "Please enter a " + len + "-character password. Only letters and numbers allowed. ";
        } else {
            pass.classList.remove("is-invalid");
            submit.disabled = false;
            pwhelp.textContent = "";
        }
    }

    // email validation using regex
    function emailValidate() {
        var email = document.getElementById("email");
        var submit = document.getElementById("submit");
        var emhelp = document.getElementById("emhelp");
        var emailval = email.value;

        // anystring@anystring.anystring regex
        var re = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;

        // actual domain exclusive regex
        // var re = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[A-Z]{2}|com|org|net|gov|mil|biz|info|mobi|name|aero|jobs|museum)\b/;

        if (re.test(emailval)) {
            email.classList.remove("is-invalid");
            submit.disabled = false;
            emhelp.textContent = "";
        }
        else {
            email.classList.add("is-invalid");
            submit.disabled = true;
            emhelp.textContent = "Invalid email format. Needs to contain '@' and a domain. For example: email@domain.com";
        }
    }

    // username "validation", we just show the requirements and make the server 
    function usernameValidate() {
        var name = document.getElementById("name");
        var submit = document.getElementById("submit");
        var nmhelp = document.getElementById("nmhelp");
        var nameval = name.value;

        if (nameval.length < 3 || nameval.length > 25) {
            name.classList.add("is-invalid");
            submit.disabled = true;
            nmhelp.textContent = "Names can only contain characters, numbers, and white spaces. Length must between 3 - 25 characters inclusive.";
        } else {
            name.classList.remove("is-invalid");
            submit.disabled = false;
            nmhelp.textContent = "";
        }
    }
});