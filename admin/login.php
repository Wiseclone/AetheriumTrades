<?php
    //require_once('util/secure_conn.php');
    require('../model/database.php'); 
    require('../model/admin_db.php'); 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim(filter_input(INPUT_POST, 'username'));
        $password = trim(filter_input(INPUT_POST, 'password'));

        if (empty($username)) $error_username = 'Please enter your username.';
        if (empty($password)) $error_password = 'Please enter your password.';

        if (empty($error_username) && empty($error_password)) {
            if (is_valid_admin_login($username, $password)) {
                //must start session to set a session variable
                session_start();
                $_SESSION['is_valid_admin'] = true;
                //go to admin home
                header("Location: admin.php");
            } else {
                $error_username = 'Username and password do not validate.';
            }
        }
    }
?>
<?php include '../view/header.php'; ?>
<main id="admin-login">
    <h2>Please fill in your credentials to login.</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="username">Username:<sup>*</sup></label>
            <input type="text" name="username" id="username" autofocus>
            <span class="error_message"><?php if(!empty($error_username)) echo $error_username; ?></span>
        </div>
        <div>
            <label for="password">Password:<sup>*</sup></label>
            <input type="password" name="password" id="password">
            <span class="error_message"><?php if(!empty($error_password)) echo $error_password; ?></span>
        </div>
        <div>
            <input type="submit" class="button blue" value="Sign In">
        </div>
        <div>
            <p><sup>*</sup> Indicates a required field.</p>
        </div>
    </form>
</main>
<?php include '../view/footer.php'; ?>