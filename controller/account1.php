<div class="edit_profile" id="edit_profile">
    <div class="edit-con">
        <form action="../controller/insert_profile.php" method="post" enctype="multipart/form-data">
            <button type="button" class="close-acc1" onclick="closeEdit();resetForm()">&#10006;</button>
            <div style="text-align:center">
                <p style="font-weight:600;font-size:22px"><span style="color:#105f77">Loan</span> Account</p>
            </div>
            <p style="font-size:20px">Profile Picture</p>
            <p>A picture helps people recognize you and lets you know when you’re signed in to your account</p>
            <div style="text-align:center"><br><br>
                <img src="<?php echo htmlspecialchars($profile_img); ?>" alt="" style="border-radius: 50%;width:300px;height:300px" id="image1">
            </div>
            <br><br>
            <input type="file" name="profile_img" onchange="displayImage('image1', this)" id="profile_img"><br>
            <div style="text-align:center"><br>
                <button type="submit" class="account-btn">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    function displayImage(imgId, input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById(imgId).src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    var edit = document.getElementById('edit_profile');

    function showEdit() {
        edit.style.display = "flex";
    }

    function closeEdit() {
        edit.style.display = "none";
    }


    const initialValues = {
        profile_img: '<?php echo htmlspecialchars($profile_img); ?>',
    };

    function resetForm() {
        // Reset images
        document.getElementById('profile_img').value = '';
        document.getElementById('image1').src = initialValues.profile_img;
    }
    
</script>

