<div class="edit_account2" id="edit_account2">
    <div style="width:62%">
        <form action="../controller/update_profile.php" method="post" enctype="multipart/form-data">
            <button type="button" class="edit-close" onclick="showAccSettings();resetForm()"><i class='bx bx-arrow-back'></i></button>
            <p style="font-size:40px;color:rgb(40,40,40)">Edit Personal Information</p>

            <!-- Basic Info -->
            <p style="font-size:25px;color:rgb(40,40,40);margin-bottom:0">Basic Info</p><br><br>
            <label for="account_type">Account Type</label><br><br>
            <label for="" style="display:flex;align-items:center;gap:20px">
                <input type="radio" id="account_type" name="account_type" style="transform:translateY(-2px);accent-color:green" checked><?php echo htmlspecialchars($acc_type); ?>
            </label>

            <div style="display:flex;align-items:end;gap:20px;justify-content:space-between">
                <div style="display:flex; align-items:space-between;flex-direction:column">
                    <p>Profile picture</p>
                    <input type="file" name="profile_img" id="profile_img" onchange="displayImage('image5', this)">
                </div>
                <img src="<?php echo htmlspecialchars($profile_img); ?>" alt="" style="border-radius: 50%;width:100px;height:100px" id="image5">
            </div>

            <div class="infos">
                <!-- Other input fields -->
                <label for="first_name">First name</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($f_name); ?> " oninput="enableSaveButton()">

                <label for="last_name">Last name</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($l_name); ?>" oninput="enableSaveButton()">

                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" oninput="enableSaveButton()">

                <!-- <label for="password">Password</label>
                <input type="password" id="password" name="password"> -->

                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" oninput="enableSaveButton()">

                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" oninput="enableSaveButton()">

                <label for="birthdate">Birthday</label>
                <input type="date" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" onchange="calculateAge()" oninput="enableSaveButton()">

                <label for="gender">Gender</label>
                <input type="text" id="gender" name="gender" value="<?php echo htmlspecialchars($gender); ?>" oninput="enableSaveButton()" readonly>

                <label for="age">Age</label>
                <input type="text" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>" readonly oninput="enableSaveButton()">
                <br>

            

            <div class="edit-btn">
                <button type="button" onclick="showAccSettings();resetForm()">Cancel</button>
                <button type="submit" id="saveButton">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
// Store the initial value of account_type
const initialAccountType = '<?php echo htmlspecialchars($acc_type); ?>';

// Function to enable the Save button
function enableSaveButton() {
    document.getElementById('saveButton').disabled = false;
}

// Function to disable the Save button
function disableSaveButton() {
    document.getElementById('saveButton').disabled = true;
}

// Add event listeners to input fields to detect clicks
document.querySelectorAll('input[type="text"], input[type="date"]').forEach(input => {
    input.addEventListener('input', enableSaveButton);
});

// Add event listener to reset the form when the cancel button is clicked
document.querySelector('.edit-btn button[type="button"]').addEventListener('click', function() {
    resetForm();
    disableSaveButton(); // Disable save button after resetting the form
});

// Function to populate the account_type input field if no changes are made
function populateAccountTypeIfUnchanged() {
    const accountTypeInput = document.getElementById('account_type');
    if (!document.getElementById('edit_account1').querySelector('input:not([type="radio"]):not([readonly])').value.trim()) {
        accountTypeInput.value = initialAccountType;
    }
}

// Function to handle form submission
function handleSubmit(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    // Check if any other input fields have been modified
    const isFormModified = Array.from(document.querySelectorAll('input:not([type="radio"]):not([readonly])')).some(input => input.value.trim() !== input.defaultValue.trim());

    // If no changes are made, populate the account_type input field with the initial value before submitting
    if (!isFormModified) {
        populateAccountTypeIfUnchanged();
    }

    // Submit the form
    event.target.submit();
}


    function calculateAge() {
        const birthdate = new Date(document.getElementById('birthdate').value);
        const today = new Date();
        let age = today.getFullYear() - birthdate.getFullYear();
        const monthDiff = today.getMonth() - birthdate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
            age--;
        }
        document.getElementById('age').value = age;
    }

    function reload() {
        location.reload();
    }
</script>
