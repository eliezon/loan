<?php 
$sql = "SELECT id, f_name, l_name, email, phone, address, birthdate, gender, age, profile_img, user_type FROM users WHERE id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $f_name, $l_name, $email, $phone, $address, $birthdate, $gender, $age, $profile_img, $user_type);
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
?>