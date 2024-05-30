
<div class="acc_settings" id="acc_settings">
   <div style="display:flex;flex-direction:column;justify-content:center;align-items:center;width:950px;position:relative">
    <button class="acc-close" onclick="closeAccSettings()"><i class='bx bx-arrow-back'></i></button>
    <p style="font-size:25px;color:rgb(50,50,50);margin-bottom:0">Personal Info</p>
    <p style="color:rgb(76,76,76);padding-top:20px">Info about you and your preferences across Loan services</p>
    <br>
    <div style="display:flex;width:950px;align-items:center;justify-content:space-between">
            <p style="font-size: 25px;color: rgb(50,50,50);">Your profile in Loan services</p>
             <img src="../view/images/eloan.png" alt="" style="width:100px">
             <button type="button" id="edit-profile" onclick="showEditAccount()"><i class='bx bx-pencil'></i>Edit Profile</button>
    </div>


    <div class="basic-info">
        <p style="padding:0 20px;padding-top:30px">Basic Info</p><br>

        <label for="" class="basic_profile">Profile picture <p style="font-size:15px">A profile picture helps personalize your account</p> <img src="" alt="">  <img src="<?php echo htmlspecialchars($profile_img); ?>" alt="Profile Image" class="profile_img" style="width:60px;height:60px"></label>
        <p class="hr"></p>

        <div class="bla">
        <label for="">Account Type <p><?php echo htmlspecialchars($acc_type); ?></p></label><p class="hr"></p>
        <label for="">Name <p><?php echo htmlspecialchars($f_name); ?> <?php echo htmlspecialchars($l_name); ?></p></label><p class="hr"></p>
        <label for="">Birthday <p><?php echo htmlspecialchars( $birthdateFormatted ); ?></p></label><p class="hr"></p>
        <label for="">Age <p><?php echo htmlspecialchars( $age); ?></p></label><p class="hr"></p>
        <label for="">Gender <p><?php echo htmlspecialchars($gender); ?></p>
        </div>
    </div><br>
     


    <div class="basic-info">
        <div class="bla">
        <label for="">Username or email <p><?php echo htmlspecialchars($email); ?></p></label><p class="hr"></p>
            <label for="">Email <p><?php echo htmlspecialchars($email); ?></p></label><p class="hr"></p>
            <label for="">Phone <p><?php echo htmlspecialchars($phone); ?></p></label>
        </div>
    </div><br>


    <div class="basic-info">
        <p style="padding:0 20px;padding-top:30px">Addresses</p><br>
        <div class="bla">  
            <label for="">Home <p><?php echo htmlspecialchars($address); ?></p></label><p class="hr"></p>
            <label for="">Work <p>Not set</p></label>
        </div>
    </div><br>

    <div class="basic-info">
        <p style="padding:0 20px;padding-top:30px">Bank Details</p><br>
        <div class="bla">  
            <label for="">Bank name <p><?php echo htmlspecialchars($bank_name); ?></p></label><p class="hr"></p>
            <label for="">Bank account <p><?php echo htmlspecialchars($bank_account); ?></p></label> <p class="hr"></p>
            <label for="">Card holder <p><?php echo htmlspecialchars($card_holder); ?></p></label> <p class="hr"></p>
            <label for="">Tin number <p><?php echo htmlspecialchars($tin_number); ?></p></label> <p class="hr"></p>
            <label for="">Bank Account <p><?php echo htmlspecialchars($bank_account); ?></p></label>
        </div>
    </div><br>

    <div class="basic-info">
        <p style="padding:0 20px;padding-top:30px">Company Details</p><br>
        <div class="bla">  
            <label for="">Company working with <p><?php echo htmlspecialchars($company_working); ?></p></label><p class="hr"></p>
            <label for="">Company name <p><?php echo htmlspecialchars($company_name); ?></p></label> <p class="hr"></p>
            <label for="">Company address <p><?php echo htmlspecialchars($company_address); ?></p></label> <p class="hr"></p>
            <label for="">Company contact# <p><?php echo htmlspecialchars($company_contact); ?></p></label> <p class="hr"></p>
            <label for="">Position <p><?php echo htmlspecialchars($position); ?></p></label> <p class="hr"></p>
            <label for="">Money earnings <p><?php echo htmlspecialchars($money_earnings); ?></p></label>
        </div>
    </div><br>

    <div class="basic-info">
        <p style="padding:0 20px;padding-top:30px">Other Details</p><br>
        <div class="bla bla1">  

        <div>
        <label for="" class="basic_profile">Proof of billing <p style="font-size:15px"><img src="" alt=""><img src="<?php echo htmlspecialchars($proof_of_billing); ?>" alt="Profile of Billing" class="profile_img" style="width:60px;height:60px"></label>
        </div>
        <p class="hr"></p>
        
        <div>
        <label for="" class="basic_profile">Valid ID <p style="font-size:15px"><img src="" alt=""><img src="<?php echo htmlspecialchars($valid_id); ?>" alt="Valid ID" class="profile_img" style="width:60px;height:60px"></label>
        </div>
        <p class="hr"></p>

        <div>
        <label for="" class="basic_profile">Certificate of employment <p style="font-size:15px"><img src="" alt="">  <img src="<?php echo htmlspecialchars($coe); ?>" alt="Certificate of Employment" class="profile_img" style="width:60px;height:60px"></label>
        </div>
        <p class="hr"></p>
        </div>
    </div><br>


    </div>
</div>