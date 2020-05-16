<?php
    session_start();
    //require_once('util/secure_conn.php');
    require_once('../util/valid_admin.php');
    require('../model/database.php'); 
    require('../model/admin_db.php'); 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim(filter_input(INPUT_POST, 'username'));
        $password = trim(filter_input(INPUT_POST, 'password'));
        $password2 = trim(filter_input(INPUT_POST, 'confirm_password'));

        //check for empty username
        if (empty($username)) {
            $error_username = "Please enter a username.";
        } else if (strlen($username) < 6) {
            $error_username = "Username must be six characters or longer.";
        } else { 
            // see if the username already exists
            $query = "SELECT COUNT(*) FROM administrators WHERE username = :username";
            $statement = $db->prepare($query);
            $statement->bindParam(':username', $username);
            $statement->execute();
            // fetchColumn() returns the number of rows from the SELECT COUNT(*) 
            // query above. 0 is false. Our if statement below checks IF true.
            if ($statement->fetchColumn()) {
                $error_username = "The username you entered is already taken.";
            } 
        }

        //check for empty password
        if (empty($password)) $error_password = "Please enter a password.";
        
        //check password against regex
        $res = array("options"=>array("regexp"=>"/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/"));
        if(!filter_var($password, FILTER_VALIDATE_REGEXP, $res)) {
            $error_password = "Your password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters";
        }
        //check if password and password confirmation match
        if ($password != $password2) {
            $error_password_confirmation = "The passwords you entered did not match.";
        }
        //if no errors exist
        if (empty($error_username) && empty($error_password) && empty($error_password_confirmation)) {
            //register new admin
            add_admin($username, $password);
            //go to admin home
            header("Location: admin.php");
        }
    }
    
?>
<?php include '../view/header-admin.php'; ?>
<main id="admin-login">
    <h2>Register a new admin user</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="username">Username:<sup>*</sup></label>
            <input type="text" name="username" id="username" autofocus>
            <span class="error_message"><?php if(!empty($error_username)) echo $error_username; ?></span>
        </div>
        <div>
            <label for="password">Password:<sup>*</sup></label>
            <input type="password" name="password" id="password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
            <span class="error_message"><?php if(!empty($error_password)) echo $error_password; ?></span>
        </div>
        <div>
            <label for="confirm_password">Confirm Password:<sup>*</sup></label>
            <input type="password" name="confirm_password" id="confirm_password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
            <span class="error_message"><?php if(!empty($error_password_confirmation)) echo $error_password_confirmation; ?></span>
        </div>
        <div>
            <input type="submit" class="button blue" value="Register">
        </div>
        <div>
            <p><sup>*</sup> Indicates a required field.</p>
        </div>
    </form>
</main>
<?php include '../view/footer.php'; ?>