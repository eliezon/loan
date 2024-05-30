<?php include_once '../controller/user_billings.php'; ?>
<div class="admin_billing" id="admin_billing">
    <div>
        <p style="font-size:40px;margin-top:0">Billing Summary</p>
        <select name="" id="" style="padding:0 10px;font-size:15px">
            <option value="">Year</option>
        </select>
        
        <select name="" id="" style="padding:0 10px;font-size:15px">
            <option value="">Month</option>
        </select>
    </div>
    <br>
    <table>
        <thead>
        <tr>
            <th>No.</th>
            <th>Date</th>
            <th>Fullname</th>
            <th>Account Type</th>
            <th>Transaction ID</th>
            <th>Loaned Amount</th>
            <th>Interest</th>
            <th>Penalty</th>
            <th>Received Amount</th>
            <th>Amount to Pay</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($users_result->num_rows > 0) {
            $counter = 1;
            while ($row = $users_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $counter . "</td>";
                echo "<td>" . htmlspecialchars($row['b_date']) . "</td>";
                echo "<td>" . htmlspecialchars($row['full_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['acc_type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['transaction_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['loaned_amount']) . "</td>";
                echo "<td>" . htmlspecialchars($row['interest']) . "</td>";
                echo "<td>" . htmlspecialchars($row['penalty']) . "</td>";
                echo "<td>" . htmlspecialchars($row['received_amount']) . "</td>";
                echo "<td>" . htmlspecialchars($row['amount_to_pay']) . "</td>";
                echo "<td>" . htmlspecialchars($row['due_date']) . "</td>";
                echo "<td>" . htmlspecialchars($row['b_status']) . "</td>";
                echo "<td>Action</td>";
                echo "</tr>";
                $counter++;
            }
        } else {
            echo "<tr><td colspan='12'>No billings found</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <p style="border-bottom:1px solid rgb(143, 143, 143); width:100%;margin-top:0"></p>
    <p class="hr"></p>
    <div style="display:flex;justify-content:space-between;align-items:center">
        <div class="user-table-btn">
            <?php 
            // Count the number of rows in $users_result
            $rowCount = $users_result->num_rows;
            echo "<p class='entries'>Showing $rowCount of $rowCount entries</p>";
            ?>
        </div>
        <div class="pages">
            <button>Prev</button>
            <p>1</p>
            <button>Next</button>
        </div>
    </div>
</div>