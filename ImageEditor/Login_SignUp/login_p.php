 <?php

session_start();

if (isset($_POST["email-login"]) && isset($_POST["password-login"])) {
    $email    = $_POST["email-login"];
    $password = $_POST["password-login"];

    $host     = "localhost"; // Host name
    $username = "root"; // Mysql username
    $pass     = "root"; // Mysql password
    $db_name  = "db_name"; // Database name
    $tbl_name = "user_accounts"; // Table name

    // Connect to server and select databse.
    mysql_connect("$host", "$username", "$pass") or die("cannot connect");
    mysql_select_db("$db_name") or die("cannot select DB");

    // To protect MySQL injection (more detail about MySQL injection)
    $email    = stripslashes($email);
    $password = stripslashes($password);
    $email    = mysql_real_escape_string($email);
    $password = mysql_real_escape_string($password);
    $sql      = "SELECT * FROM $tbl_name WHERE password='$password' and email='$email'";
    $result   = mysql_query($sql);

    // Mysql_num_row is counting table row
    $count = mysql_num_rows($result);

    //Only one entry login successful
    if ($count == 1) {
        $_SESSION['user']=$email; // Initializing Session

        header('Location: http://edit-image.orgfree.com/Upload/upload.html');
        exit;
    } else {
        echo '<script language="javascript"> window.location.href="http://edit-image.orgfree.com/Login_SignUp/login_signup.html"; alert("Error! Please try again");</script>';
        exit;
    }
}

?>
