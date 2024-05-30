<?php
class UserManager {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUsers() {
        // Join users table with loans table to get loan information and include loan status
        $users_sql = "
        SELECT 
            u.id, 
            u.acc_type, 
            u.f_name, 
            u.l_name, 
            u.email, 
            u.phone, 
            u.address, 
            u.birthdate,
            u.gender,
            u.age,
            u.bank_name,
            u.bank_account,
            u.card_holder,
            u.tin_number,
            u.company_working,
            u.company_name,
            u.company_address,
            u.company_contact,
            u.position,
            u.money_earnings,
            u.proof_of_billing,
            u.valid_id,
            u.coe,
            u.profile_img,
            u.registration_status, 
            u.rejection_timestamp,
            u.blocked,
            u.status,
            u.user_type,
            SUM(CASE WHEN l.status = 'Approved' THEN l.amount ELSE 0 END) AS total_loans
        FROM 
            users u
        LEFT JOIN 
            loans l 
        ON 
            u.id = l.id
        WHERE 
            user_type != 'Admin' OR registration_status = 'Pending'  OR registration_status = 'Approved'  OR registration_status = 'Rejected'
        GROUP BY 
            u.id, u.acc_type, u.f_name, u.l_name, u.email, u.phone, u.address, u.birthdate, u.gender, u.age, u.bank_name, u.bank_account, u.card_holder, u.tin_number, u.company_working, u.company_name, u.company_address, u.company_contact, u.position, u.money_earnings, u.proof_of_billing, u.valid_id, u.coe, u.profile_img, u.registration_status, u.blocked, u.status, u.user_type, u.rejection_timestamp
    ";
    
        $stmt = $this->conn->prepare($users_sql);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }
  
}
    

?>
