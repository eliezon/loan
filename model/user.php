<?php
class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUserById($user_id) {
        $sql = "SELECT id, acc_type, f_name, l_name, email, phone, address, birthdate, gender, age, bank_name, bank_account, card_holder, tin_number, company_working, company_name, company_address, company_contact, position, money_earnings, proof_of_billing, valid_id, coe, profile_img FROM users WHERE id = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $user_id);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $acc_type, $f_name, $l_name, $email, $phone, $address, $birthdate, $gender, $age, $bank_name, $bank_account, $card_holder, $tin_number, $company_working, $company_name, $company_address, $company_contact, $position, $money_earnings, $proof_of_billing, $valid_id, $coe, $profile_img);
                    if ($stmt->fetch()) {
                        return [
                            'id' => $id,
                            'acc_type' => $acc_type,
                            'f_name' => $f_name,
                            'l_name' => $l_name,
                            'email' => $email,
                            'phone' => $phone,
                            'address' => $address,
                            'birthdate' => (new DateTime($birthdate))->format('F j, Y'),
                            'gender' => $gender,
                            'age' => $age,
                            'bank_name' => $bank_name,
                            'bank_account' => $bank_account,
                            'card_holder' => $card_holder,
                            'tin_number' => $tin_number,
                            'company_working' => $company_working,
                            'company_name' => $company_name,
                            'company_address' => $company_address,
                            'company_contact' => $company_contact,
                            'position' => $position,
                            'money_earnings' => $money_earnings,
                            'proof_of_billing' => $proof_of_billing,
                            'valid_id' => $valid_id,
                            'coe' => $coe,
                            'profile_img' => $profile_img
                        ];
                    }
                }
            }
            $stmt->close();
        }
        return null;
    }

    public function getAllUsers() {
        $users = [];
        $sql = "SELECT id, acc_type, f_name, l_name, email, phone, address FROM users";
        $result = $this->conn->query($sql);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }
}
?>
