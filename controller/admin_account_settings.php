
<div class="acc_settings" id="acc_settings">
   <div style="display:flex;flex-direction:column;justify-content:center;align-items:center;width:950px;position:relative">
    <button class="acc-close" onclick="closeAccSettings()"><i class='bx bx-arrow-back'></i></button>
    <p style="font-size:25px;color:rgb(50,50,50);margin-bottom:0">Personal Info</p>
    <p style="color:rgb(76,76,76);padding-top:20px">Info about you and your preferences across Loan services</p>
    <br>
    <div style="display:flex;width:950px;align-items:center;justify-content:space-between">
            <p style="font-size: 25px;color: rgb(50,50,50);">Your profile in Loan services</p>
             <img src="../view/images/eloan.png" alt="" style="width:100px">
             <button type="button" id="edit-profile" onclick="showEditAccount2()"><i class='bx bx-pencil'></i>Edit Profile</button>
    </div>


    <div class="basic-info">
        <p style="padding:0 20px;padding-top:30px">Basic Info</p><br>

        <label for="" class="basic_profile">Profile picture <p style="font-size:15px">A profile picture helps personalize your account</p> <img src="" alt="">  <img src="<?php echo htmlspecialchars($profile_img); ?>" alt="Profile Image" class="profile_img" style="width:60px;height:60px"></label>
        <p class="hr"></p>

        <div class="bla">
        <label for="">User Type <p><?php echo htmlspecialchars($user_type); ?></p></label><p class="hr"></p>
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

   
  


    </div>
</div>