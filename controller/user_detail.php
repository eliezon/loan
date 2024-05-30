<?php include "../controller/fetch_user_detail.php" ?>

<link rel="stylesheet" href="../view/user_detail.css">

<div class="user_detail" id="user_detail">
    <?php if (!empty($user_loans)): ?>

        <div style="display:flex;gap:100px;align-items:center;">
            <div>
                <img src="<?php echo htmlspecialchars($user_loans[0]['profile_img']); ?>" alt="Profile Image">
           </div>

           <div class="asd">
                <p style="font-size:70px"><?php echo htmlspecialchars($user_loans[0]['f_name'] . ' ' . $user_loans[0]['l_name']); ?></p>
                <p><?php echo htmlspecialchars($user_loans[0]['email']); ?></p>
                <p><?php echo htmlspecialchars($user_loans[0]['phone']); ?></p>
            </div>
        </div>
        <br><br><br><br>

        <div style="display:flex;gap:30px">
            <div>
                <p>Address: <span><?php echo htmlspecialchars($user_loans[0]['address']); ?></span></p>
                <p>Birthdate: <span><?php echo htmlspecialchars($user_loans[0]['birthdate']); ?></span></p>
                <p>Gender: <span><?php echo htmlspecialchars($user_loans[0]['gender']); ?></span></p>
                <p>Age: <span><?php echo htmlspecialchars($user_loans[0]['age']); ?></span></p>
            </div>
            <br>

            <div>
                <p>Bank Name: <span><?php echo htmlspecialchars($user_loans[0]['bank_name']); ?></span></p>
                <p>Bank Account: <span><?php echo htmlspecialchars($user_loans[0]['bank_account']); ?></span></p>
                <p>Card Holder: <span><?php echo htmlspecialchars($user_loans[0]['card_holder']); ?></span></p>
                <p>TIN Number: <span><?php echo htmlspecialchars($user_loans[0]['tin_number']); ?></span></p>
            </div>

            <div>
                <p>Company Working: <span><?php echo htmlspecialchars($user_loans[0]['company_working']); ?></span></p>
                <p>Company Name: <span><?php echo htmlspecialchars($user_loans[0]['company_name']); ?></span></p>
                <p>Company Address: <span><?php echo htmlspecialchars($user_loans[0]['company_address']); ?></span></p>
                <p>Company Contact: <span><?php echo htmlspecialchars($user_loans[0]['company_contact']); ?></span></p>
            </div>

        </div>

        <br>
        <p>Position: <span><?php echo htmlspecialchars($user_loans[0]['position']); ?></span></p>
        <p>Money Earnings: <span><?php echo htmlspecialchars($user_loans[0]['money_earnings']); ?></span></p>

        <div style="display:flex;justify-content:space-between;align-items:end" class="uploads">
            <div>
                <img src="<?php echo htmlspecialchars($user_loans[0]['proof_of_billing']); ?>" alt="Proof of Billing">
                <p>Proof of Billing</p>
            </div>

            <div>
                <img src="<?php echo htmlspecialchars($user_loans[0]['valid_id']); ?>" alt="Valid ID">
                <p>Valid ID</p>
            </div>

            <div>
                <img src="<?php echo htmlspecialchars($user_loans[0]['coe']); ?>" alt="Certificate of Employment">
                <p>Certificate of Employment</p>
            </div>
        </div>

        <br>
    
        <!-- LOAN ACTIONS -->
        <div class="loan-actions">
            <?php if ($user_loans[0]['status'] !== 'Approved' && $user_loans[0]['status'] !== 'Rejected'): ?>
            <!-- Reject loan button -->
            <a onclick="showRejectForm('<?php echo htmlspecialchars($user_loans[0]['transaction_id']); ?>')">Reject</a>
            <!-- Approve loan button -->
            <a onclick="approveLoan('<?php echo htmlspecialchars($user_loans[0]['transaction_id']); ?>')">Approve</a>
            <?php endif; ?>
        </div>

            <?php else: ?>
                <p>No details found for the provided user ID and transaction ID.</p>
            <?php endif; ?>
     </div>


<!-- Hidden form for rejecting loan -->
<div class="reject-form" id="reject-form">
<form action="../controller/update_loan_status.php" method="POST">
<p style="color:rgb(10,10,10)">Reason for rejection:</p>
<button type="button" onclick="closeNoteForm()">&#10006</button>
    <input type="hidden" name="status" value="Rejected">
    <input type="hidden" name="transaction_id" id="rejectTransactionId">
    <textarea name="note" id="note"></textarea>
    <button type="submit">Submit</button>
</form>
</div>


<!-- Hidden form for approving loan -->
<form id="approveForm" style="display: none;" action="../controller/update_loan_status.php" method="POST">
    <input type="hidden" name="status" value="Approved">
    <input type="hidden" name="transaction_id" id="approveTransactionId">
    <input type="hidden" name="note" value="None"> <!-- Default value for note -->
    <button type="submit">Submit</button>
</form>

<!-- Modal for Image Viewing -->
<div id="imageModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
</div>

<script src="../view/user_detail.js"></script>
