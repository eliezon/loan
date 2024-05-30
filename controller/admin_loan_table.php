<?php include_once '../controller/all_loan.php'; ?>
<div class="admin_loans" id="admin_loans">
    <div>
        <p style="font-size:40px;margin-top:0">Loan Transactions</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Date</th>
                <th>Transaction ID</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Payable Months</th>
                <th>Status</th>
                <th>Note</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($users_result->num_rows > 0) {
                    $counter = 1;
                    while ($row = $users_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $counter . "</td>";
                        echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['transaction_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['full_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['amount']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['payable_months']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['note']) . "</td>";
                        echo "<td><a href='../controller/user_detail.php?user_id=" . htmlspecialchars($row['id']) . "&transaction_id=" . htmlspecialchars($row['transaction_id']) . "'>View</a></td>";
                        echo "</tr>";
                        $counter++;
                    }
                } else {
                    echo "<tr><td colspan='9'>No users found</td></tr>";
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



