<?php
session_start(); // Start the session

// Check if user is not logged in
if (!isset($_SESSION["id"])) {
    // Redirect user to login page
    header("location: login_page.php");
    exit;
}

include_once '../model/database.php';

// Connect to the database
$conn = $database->connect();

// Get the user ID from session
$user_id = $_SESSION['id'];

// Fetch user data from the database
$sql = "SELECT id, acc_type, f_name, l_name, email, phone, address, birthdate, gender, age, bank_name, bank_account, card_holder, tin_number, company_working, company_name, company_address, company_contact, position, money_earnings, proof_of_billing, valid_id, coe, profile_img FROM users WHERE id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $acc_type, $f_name, $l_name, $email, $phone, $address, $birthdate, $gender, $age, $bank_name, $bank_account, $card_holder, $tin_number, $company_working, $company_name, $company_address, $company_contact, $position, $money_earnings, $proof_of_billing, $valid_id, $coe, $profile_img);
            if ($stmt->fetch()) {
                // Format the birthdate
                $birthdateFormatted = (new DateTime($birthdate))->format('F j, Y');
            }
        }
    } else {
        echo "Failed to execute the SQL statement.";
    }
    $stmt->close();
} else {
    echo "Failed to prepare the SQL statement.";
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../view/main.css">
    <script src="../view/main.js"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">

        <?php include '../view/template/dheader.php' ?>
        

        <!-- start of sidebar -->
        <div class="sidebar" id="sidebar">
            <div style="text-align:center">
            <img src="../view/images/eloan3.png" alt="">
            </div>
            <div class="button" id="sidebar-button">
            <button id="sb1" class="active" onclick="setActive(this);showDashboard()"><i class='bx bxs-dashboard'></i>Home</button>
            <button id="sb2" onclick="setActive(this);showLoans()"><i class='bx bxs-coin-stack'></i>Loans</button>

                <?php if ($_SESSION['acc_type'] === 'Premium') : ?>
                    <button id="sb" onclick="setActive(this);showSavingsTable()"><i class='bx bxs-detail'></i>Savings</button>
                <?php endif; ?>

            <button id="sb3" onclick="setActive(this);showUserBillingTable()"><i class='bx bxs-detail'></i>Billing</button>
            </div>
        </div>
        <!-- end of sidebar -->


        <div class="content" id="content">
        <div class="c1" id="c1">
            <p style="color:rgb(120,120,120);font-weight:550;padding:20px" id="loan-txt">DASHBOARD</p>
        </div>

        <!-- start of dashboard -->
        <div class="dashboard" id="dashboard">

        </div>
        <!-- end of dashboard -->


        <!-- start of loans -->
        <?php include '../controller/user_loans_table.php' ?>
        <!-- end of loans -->


        <!-- start of loan form -->
        <?php include '../view/add_loan_form.php' ?>
        <!-- end of loan form -->


        <!-- start of loan form -->
        <?php include '../controller/account1.php' ?>
        <!-- end of loan form -->
 

        <!-- start of account -->
        <?php include '../controller/account.php' ?>
        <!-- end of account -->


        <!-- start of account settings -->
        <?php include '../controller/account_settings.php' ?>
        <!-- end of account settings -->

         <!-- start of edit profile -->
         <?php include '../controller/edit_profile.php' ?>
        <!-- end of edit profile -->


         <!-- start of edit profile -->
         <?php include '../controller/user_billing_table.php' ?>
        <!-- end of edit profile -->

        <!-- start of edit profile -->
        <?php include '../controller/user_savings_table.php' ?>
        <!-- end of edit profile -->

    
        </div>
    </div>
    <script>

var account = document.getElementById('account');
var accsettings = document.getElementById('acc_settings');
var c1 = document.getElementById('c1');
var editaccount = document.getElementById('edit_account1');
var userbilling = document.getElementById('user_billing');
var loantext = document.getElementById('loan-txt');
var loans = document.getElementById('loans');
var dashboard = document.getElementById('dashboard');
var addloan = document.getElementById('add-loan');
var usersavings = document.getElementById('user_savings');


function showSavingsTable() {
        accsettings.style.display="none";
        account.style.display="none";
        c1.style.display="block";
        editaccount.style.display="none";
        userbilling.style.display="none";
        loans.style.display="none";
        usersavings.style.display="block";
        loantext.textContent="LOAN MANAGEMENT SYSTEM";
    }

function showUserBillingTable() {
        accsettings.style.display="none";
        account.style.display="none";
        c1.style.display="block";
        editaccount.style.display="none";
        userbilling.style.display="block";
        loans.style.display="none";
        usersavings.style.display="none";
        loantext.textContent="LOAN MANAGEMENT SYSTEM";
    }


function showAccSettings() {
        accsettings.style.display="flex";
        accsettings.style.zIndex="10";
        account.style.display="none";
        c1.style.display="none";
        editaccount.style.display="none";
    }

    function closeAccSettings() {
        accsettings.style.display="none";
        c1.style.display="block";
        editaccount.style.display="none";
    }

    function showEditAccount() {
        accsettings.style.display="none";
        account.style.display="none";
        c1.style.display="none";
        editaccount.style.display="flex";
        editaccount.style.zIndex="10";
    }


    // Add event listener to the profile button
document.querySelector('.profile').addEventListener('click', toggleAccount);

// Add event listener to the close button in the account section
document.querySelector('.close-acc').addEventListener('click', toggleAccount);
function toggleAccount() {
    if (account.style.display === 'flex') {
        account.style.display = 'none';
    } else {
        account.style.display = 'flex';
    }
}

var sidebar = document.getElementById('sidebar');
var content = document.getElementById('content');
var sb = document.getElementById('sidebar-button');
var sb1 = document.getElementById('sb1');
var sb2 = document.getElementById('sb2');
var sb3 = document.getElementById('sb3');


function toggleSidebar() {
    if (sidebar.style.transform === 'translateX(0px)') {
        sidebar.style.transform = 'translateX(-90%)';
        content.style.width = '98%';
        sb.style.width = '100%';
        content.style.transition = '0.3s';
        sb1.style.justifyContent = "end";
        sb2.style.justifyContent = "end";
        sb3.style.justifyContent = "end";
        sb1.style.flexDirection = "row-reverse";
        sb2.style.flexDirection = "row-reverse";
        sb3.style.flexDirection = "row-reverse";
        sb1.style.gap = "50px";
        sb2.style.gap = "50px";
        sb3.style.gap = "50px";
    } else {
        sidebar.style.transform = 'translateX(0px)';
        content.style.width = '80%';
        sb.style.width = '90%';
        content.style.transition = '0.3s';
        sb1.style.justifyContent = "start";
        sb2.style.justifyContent = "start";
        sb3.style.justifyContent = "start";
        sb1.style.flexDirection = "row";
        sb2.style.flexDirection = "row";
        sb3.style.flexDirection = "row";
        sb1.style.gap = "10px";
        sb2.style.gap = "10px";
        sb3.style.gap = "10px";
    }
}
document.querySelector('.sidebar-btn').addEventListener('click', toggleSidebar);



    

    function showLoans() {
        loantext.textContent="LOAN MANAGEMENT SYSTEM";
        loans.style.display="block";
        account.style.display="none";
        accsettings.style.display="none";
        c1.style.display="block";
        editaccount.style.display="none";
        userbilling.style.display="none";
        usersavings.style.display="none";
    }

    function showDashboard() {
        loantext.textContent="DASHBOARD";
        loans.style.display="none";
        dashboard.style.display="block";
        account.style.display="none";
        accsettings.style.display="none";
        c1.style.display="block";
        editaccount.style.display="none";
        userbilling.style.display="none";
        usersavings.style.display="none";
    }

    function showAddLoan() {
        addloan.style.display="flex";
        account.style.display="none";
        c1.style.display="block";
        editaccount.style.display="none";
    }

    function closeAddLoan() {
        addloan.style.display="none";
        account.style.display="none";
        account.style.display="none";
        c1.style.display="block";
        editaccount.style.display="none";
        document.getElementById('loanAmount').value="";
    }

    let totalLoanedAmount = 0;
  const maxLoan = 50000;
  let transactionCount = 0;

  document.getElementById('loanForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const loanAmount = parseInt(document.getElementById('loanAmount').value);
    const payableMonths = document.getElementById('payableMonths').value;
    const loanAmountError = document.getElementById('loanAmountError');
    const payableMonthsError = document.getElementById('payableMonthsError');
    
    loanAmountError.innerHTML = '';
    payableMonthsError.innerHTML = '';

    if (!loanAmount) {
      loanAmountError.innerHTML = 'Loan amount is required.';
      return;
    }
    
    if (loanAmount < 5000 || loanAmount > 10000 || loanAmount % 1000 !== 0) {
      loanAmountError.innerHTML = 'Loan amount must be between 5000 and 10000, in multiples of 1000.';
      return;
    }

    if (!payableMonths) {
      payableMonthsError.innerHTML = 'Please select the number of payable months.';
      return;
    }

    if (totalLoanedAmount + loanAmount > maxLoan) {
      loanAmountError.innerHTML = 'Total loan amount cannot exceed 50000.';
      return;
    }

    totalLoanedAmount += loanAmount;
    transactionCount++;
    addTransaction(loanAmount, payableMonths, 'Pending', '');

    document.getElementById('loanForm').reset();
  });

  function addTransaction(amount, months, status, response) {
    const transactionTable = document.getElementById('transactionTable').getElementsByTagName('tbody')[0];
    const newRow = transactionTable.insertRow();
    
    const cellNo = newRow.insertCell(0);
    const cellTransactionId = newRow.insertCell(1);
    const cellLoanAmount = newRow.insertCell(2);
    const cellPayableMonths = newRow.insertCell(3);
    const cellStatus = newRow.insertCell(4);
    const cellAdminResponse = newRow.insertCell(5);

    cellNo.innerHTML = transactionCount;
    cellTransactionId.innerHTML = generateTransactionId();
    cellLoanAmount.innerHTML = amount;
    cellPayableMonths.innerHTML = months;
    cellStatus.innerHTML = status;
    cellAdminResponse.innerHTML = response;
  }

  function generateTransactionId() {
    return 'TXN' + new Date().getTime();
  }

    </script>
</body>
</html>
