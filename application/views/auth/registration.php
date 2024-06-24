<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=La+Belle+Aurore&family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/loginstyle.css')?>">
    <script src="<?php echo base_url('assets/js/login.js'); ?>" defer></script>
</head>
<body>
<form action="<?php echo base_url('auth/register') ?>" method="post">
    <h2>Registration</h2>
    <?php if (!empty($error)) { ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } elseif (isset($_GET["success"])) { ?>
        <p class="success"><?php echo $_GET["success"]; ?></p>
    <?php } ?>

    <label>Username</label>
    <input type="text" name="username" placeholder="Username" value="<?php echo set_value('username'); ?>" required><br>
    <div id="suggestions"></div>

    <label>Password</label>
    <input type="password" name="password" placeholder="Password" required><br>

    <label>Confirm Password</label>
    <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>

    <div id="feedback"></div>

    <button type="submit">Sign Up</button>
    <a href="<?php echo base_url('auth'); ?>" class="Registration">Already have an account?</a>
</form>
</body>
</html>
