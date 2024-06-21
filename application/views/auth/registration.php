<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration</title>
<link rel="stylesheet" href="<?php echo base_url('assets/css/loginstyle.css') ?>">

</head>
<body>
<form action="<?php echo base_url('auth/register') ?>" method="post">
    <h2>Registration</h2>
    <?php if (!empty($error)) { ?>
        <p   class="error"><?php echo $error; ?></p>
    <?php } elseif (isset($_GET["success"])) { ?>
        <p class="success"><?php echo $_GET["success"]; ?></p>
    <?php } ?>

    <label>Username</label>
    <input type="text" name="username" placeholder="Username"
           value="<?php echo set_value('username'); ?>"><br>

    <label>Password</label>
    <input type="password" name="password" placeholder="Password"><br>

    <label>Confirm Password</label>
    <input type="password" name="confirm_password" placeholder="Confirm Password"><br>

    <button type="submit">Sign Up</button>
    <a href="<?php echo base_url('auth'); ?>" class="Registration">Already have an account?</a>
</form>
</body>
</html>
