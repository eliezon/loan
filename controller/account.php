<div class="account" id ="account">
    <div class="account-con">
    <button class="close-acc">&#10006</button>
        <p><?php echo htmlspecialchars($email); ?></p>
        <div class="profile-con">
        <button class="img-btn" onclick="showEdit()">
        <img src="<?php echo htmlspecialchars($profile_img); ?>" alt="" class="profile_img">
        </button>
        <button class="edit" onclick="showEdit()"><i class='bx bx-pencil'></i></button>
        </div>
        <h1>Hi, <?php echo htmlspecialchars($l_name); ?>,!</h1>
        <br>

        <div>
        <a href="#" class="as" onclick="showAccSettings()">Account Settings</a>
        <a href="../controller/logout.php" class="so">Sign out</a>
        </div>
        <br>

        <div style="display:flex;align-items:center;gap:10px">
        <a href="" class="policy">Privacy Policy</a>
        <p>•</p>
        <a href="" class="terms">Terms of Service</a>
        </div>
    </div>
</div>