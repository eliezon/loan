function registerForm() {
    var regForm = document.getElementById('regForm');
    regForm.style.display = "flex";
    setTimeout(function() {
        regForm.style.opacity = "1";
    }, 10); 
}

function hideRegisterForm() {
    var regForm = document.getElementById('regForm');
    regForm.style.opacity = "0";
    setTimeout(function() {
        regForm.style.display = "none";
    }, 500);
}


function resetForm() {
    // Clear all input fields
    document.getElementById("first_name").value = "";
    document.getElementById("last_name").value = "";
    document.getElementById("email").value = "";
    document.getElementById("password").value = "";
    document.getElementById("confirm_password").value = "";
    document.getElementById("phone").value = "";
    document.getElementById("address").value = "";
    document.getElementById("age").value = "";
    document.getElementById("male").checked = false;
    document.getElementById("female").checked = false;
    document.getElementById("image2").src = "";
    document.getElementById("image3").src = "";
    document.getElementById("error_msg").textContent = "";

}


// function validateForm() {
//     // Getting form inputs
//     var firstName = document.getElementById("first_name").value;
//     var lastName = document.getElementById("last_name").value;
//     var email = document.getElementById("email").value;
//     var password = document.getElementById("password").value;
//     var confirmPassword = document.getElementById("confirm_password").value;
//     var errorMessage = document.getElementById('error_msg');
//     var fname = document.getElementById('first_name');
//     var lname = document.getElementById('last_name');
//     var email = document.getElementById('email');
//     var password = document.getElementById('password');

//     // Validating first name
//     var firstNameRegex = /^[A-Z][a-zA-Z]+$/;
//     if (!firstNameRegex.test(firstName)) {
//         fname.style.border="1px solid red";
        // errorMessage.innerHTML="What is your first name?";
//         return false;
//     }

//     // Validating last name
//     if (!firstNameRegex.test(lastName)) {
//         lname.style.border="1px solid red";
//         fname.style.border="1px solid gray";
//         errorMessage.innerHTML="What is your last name?";
//         return false;
//     }

//     // Validating email
//     var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//     if (!emailRegex.test(email)) {
//         email.style.border="1px solid red";
//         lname.style.border="1px solid gray";
//         errorMessage.innerHTML="Invalid email address.";
//         return false;
//     }

//     // Validating password
//      if (password === "") {
//         password.style.border="1px solid red";
//         errorMessage.innerHTML="Please enter your password.";
//         return false;
//     }
//     else if (password.length < 6) {
//         errorMessage.innerHTML="Password must be at least 6 characters long.";
//         return false;
//     }


//     // Validating password confirmation
//     else if (!password === confirmPassword) {
//         errorMessage.innerHTML="Passwords do not match.";
//         return false;
//     }
//     // if (firstName === "" || lastName === "" || email === "" || password === "" || confirmPassword === "") {
//     //     alert("All fields are required.");
//     //     return false;
//     // }

//     return true; // Form validated successfully
// }

function calculateAge() {
    var today = new Date();
    var birthDate = new Date(document.getElementById("year").value, document.getElementById("month").value - 1, document.getElementById("day").value);
    var age = today.getFullYear() - birthDate.getFullYear();
    var monthDiff = today.getMonth() - birthDate.getMonth();
    
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    
    var placeholderText = "Age: " + age;
    document.getElementById("age").placeholder = placeholderText;
    document.getElementById("age").value = ""; // Clear the value
}




function displayImage(imageId, input) {
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById(imageId).src = e.target.result;
    }
    reader.readAsDataURL(input.files[0]);
}


function setActive(link) {
    // Remove "active" class from all links
    const links = document.querySelectorAll('.sidebar button');
    links.forEach((el) => {
        el.classList.remove('active');
    });

    // Add "active" class to the clicked link
    link.classList.add('active');
}



// var acctype = document.getElementById("acc_type").value;
// var fname = document.getElementById("first_name").value;
// var lname = document.getElementById("last_name").value;
// var email = document.getElementById("email").value;
// var password = document.getElementById("password").value;
// var cpassword = document.getElementById("confirm_password").value;
// var phone = document.getElementById("phone").value;
// var address = document.getElementById("address").value;
// var month = document.getElementById("month").value;
// var day = document.getElementById("day").value;
// var year = document.getElementById("year").value;
// var gender = document.getElementById("gender").value;
// var bank_name = document.getElementById("bank_name").value;
// var bank_account = document.getElementById("bank_account").value;
// var card_holder = document.getElementById("card_holder").value;
// var tin_number = document.getElementById("tin_number").value;
// var com_working = document.getElementById("company_working_with").value;
// var com_name = document.getElementById("company_name").value;
// var com_address = document.getElementById("company_address").value;
// var com_contact = document.getElementById("company_contact").value;
// var postion = document.getElementById("position").value;
// var earnings = document.getElementById("money_earnings").value;
// var img1 = document.getElementById("image1").value;
// var img2 = document.getElementById("image2").value; 
// var img3 = document.getElementById("image3").value;
// function validateForm() {
//     var password = document.getElementById("password").value;
//     var confirmPassword = document.getElementById("confirm_password").value;

//     // Check if password meets minimum length requirement
//     if (password.length < 6) {
//         document.getElementById("error_msg").innerHTML = "Password must be at least 6 characters long.";
//         return false;
//     }

//     // Check if confirm password matches password
//     if (password !== confirmPassword) {
//         document.getElementById("error_msg").innerHTML = "Passwords do not match.";
//         return false;
//     }

//     // Additional validations can be added here

//     return true; // Form submission allowed if all validations pass
// }



