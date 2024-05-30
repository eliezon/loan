<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../view/main.css">
    <script src="../view/main.js"></script>
</head>
<style>
.container {
    box-sizing: border-box;
    margin: 0 auto;
    display: flex;
    flex-direction: row;
    align-items: center;
    min-height: 100vh;
    width: 100%;
    gap: 50px;
    position: absolute;
    top: 0;
    left: 0;
    flex-wrap: wrap;
    background-color: #126c87;
    overflow: scroll;
}
.container1 {
    max-width: 1000px;
    display:flex;
    justify-content: center;
    align-items: center;
    gap: 50px;
    flex-wrap:wrap; 
}
</style>
<body>
    <div class="container">
        <div class="container1">
     <!-- START OF LOGIN FORM -->
     <div class="left">
        <h1>eLoan</h1>
        <h2>Manage Your Loans with Ease</h2>
        <p>From application to repayment, experience unparalleled convenience and control over your loans, ensuring smooth and stress-free management at every step.</p>

    </div>
    <div class="right">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="loginpage">
        <a href="../index.php">
        <img src="../view/images/eloan3.png" alt="">
        </a>
        <p>Please sign in</p>
        <div class="input">
        <img src="../view/images/user.png" alt="">
        <input type="text" name="username" placeholder="Mobile number or email" id="username" value="<?php if(isset($_POST['username'])) echo htmlspecialchars($_POST['username']); ?>">
        </div>
        <div class="input">
        <img src="../view/images/password.png" alt="">
        <input type="password" name="password" placeholder="Password" id="password" value="<?php if(isset($_POST['password'])) echo htmlspecialchars($_POST['password']); ?>">

        </div>
         <br>
        <div class="remember-me">
            <div class="check">
            <input type="checkbox"> <label>Remember me</label>
            </div>
            <div>
            <a href="#">Forgot password?</a>
            </div>
        </div>
        <br>
        <?php include_once '../controller/login.php'; ?>
        
        <button type="submit">Sign in</button>
        <br>
        <hr>
        <p id="reg">New here? <a href="#" id="signup" onclick="registerForm()">Sign up</a></p>
        <br>
        <p id="copywrite">© 2024 ITech Solutions. All Rights Reserved. </p>
    </form>
    </div>
    <!-- END OF LOGIN FORM -->

    
     <!-- START OF REGISTER FORM -->
      <?php include '../view/register_page.php' ?>
     <!-- END OF REGISTER FORM -->

   
     </div>
    </div>
</body>
</html>
