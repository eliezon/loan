<div class="add-loan" id="add-loan">
    <div>
        <form action="../controller/insert_loan.php" id="loanForm" method="post">
            <h2>Apply for Loan</h2>
            <button type="button" onclick="closeAddLoan()" class="close">✖</button>

            <input type="hidden" name="transaction_id" id="transaction_id">

            <label for="loanAmount">Loan Amount (in thousands):</label>
            <input type="number" id="loanAmount" name="loanAmount">
            <label for="payableMonths">Payable Months</label>
            <select name="payableMonths" id="payableMonths">
                <option value="1">1</option>
                <option value="3">3</option>
                <option value="6">6</option>
                <option value="12">12</option>
            </select>
            
            <div id="loanAmountError" class="error" style="color:red"></div>
            <br>
            <button type="button" onclick="validateAndSubmit()" class="submit">Submit</button>
          
        </form>


    </div>
</div>

<script>
    // Function to generate a random numeric transaction ID
    function generateTransactionId() {
        const timestamp = Date.now(); // Get current timestamp
        const randomId = Math.floor(1000 + Math.random() * 9000); // Generate a random 4-digit number
        return timestamp.toString() + randomId.toString(); // Concatenate timestamp and random number
    }

    // Function to validate loan amount and submit the form
    function validateAndSubmit() {
        // Validate loan amount
        if (validateLoanAmount()) {
            // Generate the transaction ID
            const transactionId = generateTransactionId();

            // Set the generated transaction ID to the hidden input field
            document.getElementById('transaction_id').value = transactionId;

            // Submit the form
            document.getElementById('loanForm').submit();
        }
    }

    // Function to validate loan amount
    function validateLoanAmount() {
        const loanAmount = document.getElementById('loanAmount').value;
        const loanAmountError = document.getElementById('loanAmountError');

        if (loanAmount === '') {
            loanAmountError.innerHTML = 'Loan amount is required.';
            return false;
        } else if (loanAmount < 5000 || loanAmount > 10000) {
            loanAmountError.innerHTML = 'Loan amount must be between 5000 and 10000.';
            return false;
        } else {
            loanAmountError.innerHTML = ''; // Clear error message
            return true;
        }
    }
</script>
