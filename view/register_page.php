<div class="regform" id="regForm">
    <form action="../controller/register.php" method="post" class="register-form" enctype="multipart/form-data" onsubmit="return validateForm()">

        <div class="r1">
            <div>
                <h1>Sign Up</h1>
                <p>It's quick and easy</p>
            </div>
            <div>
                <button type="button" onclick="hideRegisterForm();resetForm()">✖</button>
            </div>
        </div>
        <hr style="margin:-5px 0 -10px 0">

        <div style="display:flex;gap:20px;flex-wrap:wrap">
            <div>
                <div>
                    <p style="font-size:15px;color:black;font-weight:bold;margin-bottom:5px">Account Type<span> *</span></p>
                    <label style="padding-right:50px"><input type="radio" name="account_type" value="Basic" id="acc_type"> Basic</label>
                    <label><input type="radio" name="account_type" value="Premium" id="acc_type"> Premium</label>
                </div>
                <br>
                <div class="r3">
                    <input type="text" placeholder="First name" name="first_name" id="first_name">
                    <input type="text" placeholder="Last name" name="last_name" id="last_name">
                </div>
                <div class="r4">
                    <input type="text" placeholder="Email" name="email" id="email">
                    <input type="password" placeholder="Password" name="password" id="password">
                    <input type="password" placeholder="Confirm password" name="confirm_password" id="confirm_password">
                    <input type="tel" placeholder="Contact number" name="phone" id="phone">
                    <input type="text" placeholder="Address" name="address" id="address">
                    <input type="text" placeholder="Age (automatically set, proceed to birthdate)" name="age" id="age" readonly>
                </div>
                <p style="font-size:15px;color:black;font-weight:bold;margin:68px 0 5px 0">Birthdate<span> *</span></p>
                <div class="r5">
                    <select name="month" id="month">
                        <option value="">Month</option>
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            echo '<option value="' . $i . '">' . date("F", mktime(0, 0, 0, $i, 1)) . '</option>';
                        }
                        ?>
                    </select>
                    <select name="day" id="day">
                        <option value="">Day</option>
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                        ?>
                    </select>
                    <select name="year" id="year" onchange="calculateAge()">
                        <option value="">Year</option>
                        <?php
                        $currentYear = date("Y");
                        $startYear = $currentYear - 100;
                        for ($i = $currentYear; $i >= $startYear; $i--) {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div>
                <p style="font-size:15px;color:black;font-weight:bold;margin:18px 0 5px 0">Gender</p>
                <input type="radio" id="male" name="gender" value="Male" id="gender"><label for="male" style="padding-right:50px"> Male</label>
                <input type="radio" id="female" name="gender" value="Female" id="gender"><label for="female"> Female</label>
                <br><br>
                <div class="b1">
                    <input type="text" placeholder="Bank name" name="bank_name" id="bank_name">
                    <input type="text" placeholder="Bank account number" name="bank_account" id="bank_account">
                </div>
                <div class="b2">
                    <input type="text" placeholder="Card holder's name" name="card_holder" id="card_holder">
                    <pre>
Please ensure that the Card Holder's Name provided matches the name on the 
payment card to avoid transaction interruptions.
                    </pre>
                    <input type="text" placeholder="Tin number" name="tin_number" id="tin_number">
                    <input type="text" placeholder="Company working with" name="company_working_with" id="company_working_with">
                    <input type="text" placeholder="Company name" name="company_name" id="company_name">
                    <input type="text" placeholder="Company address" name="company_address" id="company_address">
                    <input type="text" placeholder="Company contact number" name="company_contact" id="company_contact">
                    <pre>
Please provide a Company Phone Number for verifying employment status with
HR, ensuring smooth loan processing.
                    </pre>
                </div>
                <div class="b3">
                    <input type="text" placeholder="Position" name="position" id="position">
                    <input type="text" placeholder="Monthly earnings" name="money_earnings" id="money_earnings">
                </div>
            </div>

            <div class="proof" style="text-align:left">
                <div class="uploads">

                    <div>
                    <p style="font-size:15px;color:black;font-weight:bold;margin-bottom:5px">Proof of Billing<span> *</span></p>
                        <img id="image1" src="" alt="">
                        <input type="file" name="proof_of_billing" onchange="displayImage('image1', this)" id="image1">
                    </div>

                    <div>
                    <p style="font-size:15px;color:black;font-weight:bold;margin-bottom:5px">Valid ID (Primary)<span> *</span></p>
                        <img id="image2" src="" alt="">
                        <input type="file" name="valid_id" onchange="displayImage('image2', this)" id="image2">
                    </div>

                    <div>
                    <p style="font-size:15px;color:black;font-weight:bold;margin-bottom:5px">Certificate of Employment<span> *</span></p>
                        <img id="image3" src="" alt="">
                        <input type="file" name="certificate_of_employment" onchange="displayImage('image3', this)" id="image3">
                    </div>
                </div>
            </div>
        </div>

        <div style="text-align:center">
            <p>By clicking Sign Up, you agree to our <a href="#">Terms</a>, <a href="#">Privacy Policy</a> and <a href="#">Cookies Policy</a>.</p>
        </div>

        <div id="error_msg" style="color:red;text-align:center"></div><br>
        <div class="regbtn">
            <button type="submit">Sign Up</button>
        </div>
    </form>
</div>



