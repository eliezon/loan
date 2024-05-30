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
          <?php
            include '../controller/session.php';
            include '../controller/fetch_user_data.php';
            include '../view/template/dheader.php' 
          ?>
        <div class="sidebar" id="sidebar">
          <div style="text-align:center">
          <img src="../view/images/eloan3.png" alt="">
          </div>
            <div class="button" id="sidebar-button">
            <button id="sb1" class="active" onclick="setActive(this);showDashboard()"><i class='bx bxs-dashboard'></i>Dashboard</button>
            <button id="sb2" onclick="setActive(this);showAdminLoanTable()"><i class='bx bxs-coin-stack'></i>Loans</button>
            <button id="sb4" onclick="setActive(this);showAdminBilling()"><i class='bx bxs-detail'></i>Billing</button>
            <button id="sb3" onclick="setActive(this);showAdminSavings()"><i class='bx bxs-wallet' style='color:#ffffff' ></i>Savings</button>
            <button id="sb5" onclick="setActive(this);showUsersTable()"><i class='bx bxs-user'></i>Manage Users</button>
            </div>
        </div>

        <div class="content" id="content">
        <div class="c1">
            <p style="color:rgb(120,120,120);font-weight:550;padding:20px" id="loan-txt">DASHBOARD</p>
        </div>

        <!-- start of dashboard -->
        <div class="dashboard" id="dashboard">
          <div class="card">
            <p>Total Earnings</p>
            <code>0</code>
          </div>
        </div>
        <!-- end of dashboard -->

        
        <!-- start of admin_loan_table -->
        <?php include '../controller/admin_loan_table.php' ?>
        <!-- end of admin_loan_table -->


        <!-- start of admin_savings_table -->
        <?php include '../controller/admin_savings_table.php' ?>
        <!-- end of admin_savings_table -->


        <!-- start of admin_billing_table -->
        <?php include '../controller/admin_billing_table.php' ?>
        <!-- end of admin_billing_table -->


        <!-- start of manage_users -->
        <?php include '../controller/manage_users.php' ?>
        <!-- end of manage_users-->


          <!-- start of account-->
          <?php include '../controller/account.php' ?>
          <!-- end of account -->
 

        <!-- start of account -->
        <?php include '../controller/account1.php' ?>
        <!-- end of account -->


        <!-- start of admin_account_settings -->
        <?php include '../controller/admin_account_settings.php' ?>
        <!-- end of admin_account_settings -->


         <!-- start of admin_edit_profile -->
         <?php include '../controller/admin_edit_profile.php' ?>
         <!-- end of admin_edit_rofile -->

          <!-- start of admin_edit_profile -->
          <?php include '../controller/user-detail.php' ?>
         <!-- end of admin_edit_rofile -->
  
    

        </div>
    </div>




<script>
var loantext = document.getElementById('loan-txt');
var dashboard = document.getElementById('dashboard');
var adminloan = document.getElementById('admin_loans');
var manageusers = document.getElementById('manage_users');
var adminbilling = document.getElementById('admin_billing');
var adminsavings = document.getElementById('admin_savings');
var account = document.getElementById('account');
var accsettings = document.getElementById('acc_settings');
var c1 = document.getElementById('c1');
var editaccount = document.getElementById('edit_account2');
var db = document.getElementById('dashboard');

function showAccSettings() {
        accsettings.style.display="flex";
        accsettings.style.zIndex="100";
        account.style.display="none";
        c1.style.display="none";
        editaccount.style.display="none";
        editaccount.style.zIndex="100";
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
        editaccount.style.zIndex="100";

    }

document.querySelector('.close-acc').addEventListener('click', toggleAccount);
document.querySelector('.profile').addEventListener('click', toggleAccount);
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
var sb4 = document.getElementById('sb4');
var sb5 = document.getElementById('sb5');


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
        sb4.style.flexDirection = "row-reverse";
        sb5.style.flexDirection = "row-reverse";
        sb1.style.gap = "50px";
        sb2.style.gap = "50px";
        sb3.style.gap = "50px";
        sb4.style.gap = "50px";
        sb5.style.gap = "50px";
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
        sb4.style.flexDirection = "row";
        sb5.style.flexDirection = "row";
        sb1.style.gap = "10px";
        sb2.style.gap = "10px";
        sb3.style.gap = "10px";
        sb4.style.gap = "10px";
        sb5.style.gap = "10px";
    }
}
document.querySelector('.sidebar-btn').addEventListener('click', toggleSidebar);

// Add event listener to the profile button


// Add event listener to the close button in the account section


function showAdminSavings() {
  loantext.textContent="LOAN MANAGEMENT SYSTEM";
    adminloan.style.display="none";
    adminbilling.style.display="none";
    manageusers.style.display="none";
    adminsavings.style.display="block";
    db.style.display="none";
}

function showAdminLoanTable() {
  loantext.textContent="LOAN MANAGEMENT SYSTEM";
    adminloan.style.display="block";
    adminbilling.style.display="none";
    manageusers.style.display="none";
    adminsavings.style.display="none";
    db.style.display="none";
}

function showAdminBilling() {
  loantext.textContent="LOAN MANAGEMENT SYSTEM";
    adminbilling.style.display="block";
    adminloan.style.display="none";
    manageusers.style.display="none";
    adminsavings.style.display="none";
    db.style.display="none";
}

function showUsersTable() {
  loantext.textContent="LOAN MANAGEMENT SYSTEM";
    manageusers.style.display="block";
    adminloan.style.display="none";
    adminbilling.style.display="none";
    adminsavings.style.display="none";
    db.style.display="none";
}

        

function showDashboard() {
    loantext.textContent="DASHBOARD";
    dashboard.style.display="block";
    manageusers.style.display="none";
    adminloan.style.display="none";
    adminbilling.style.display="none";
    adminsavings.style.display="none";
    db.style.display="flex";
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


  var userdetail = document.getElementById('user_detail');
   
  function showUserDetail() {
    userdetail.style.display="block";
  }


    </script>

<script>
    function showRejectForm(loanId) {
        // Set the loan ID in the hidden input field
        document.getElementById('rejectLoanId').value = loanId;
        // Show the reject form
        document.getElementById('rejectForm').style.display = "block";
    }
</script>

</body>
</html>