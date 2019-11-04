<?php
if($_SERVER["REQUEST_METHOD"] === "POST") {
 require_once 'dbh.php';

 //define variable

    $username = $conn->real_escape_string(trim($_POST['uname']));
    $password = $conn->real_escape_string($_POST['password']);

// Check if the fields are empty
    if(empty($username) || empty($password)) {
        header("Location: ../login.php");
        exit();
    }

/* Select all from users table where username or email matches user input*/

        $query = "SELECT * FROM users WHERE username=?";
        $stmt = $conn->stmt_init();
        if(!$stmt->prepare($query)) {
            header("Location: ../login.php");
            exit();
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();


if($row = $result->fetch_assoc()) {
            $pwdCheck = password_verify($password, $row["password"]);
            $userCheck = $row["username"];
            if($username === $userCheck && $pwdCheck === TRUE) {
                session_start();
                $_SESSION['username'] = $row['username'];
                header("Location: ../index.php?ng=home");
                exit();
            } else {
                header("Location: ../login.php");
                exit();
            }
        } else {
            header("Location: ../login.php");
            exit();
        }

} else {

 header("Location: ../login.php");
 exit();
}
