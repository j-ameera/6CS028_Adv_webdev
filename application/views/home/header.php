<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- CSS file/style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/navbar.css'); ?>" />
    <!-- Test of custom font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=La+Belle+Aurore&family=Playfair+Display&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navigation bar -->
    <nav>
        <h2>J.Ameera</h2>
        <ul class="links">
            <li><a href="<?php echo base_url('home'); ?>">Home</a></li>
            <?php if ($this->session->userdata('role') == 'admin'): ?>
                <li><a href="<?php echo base_url('blog/create'); ?>">Create</a></li>
            <?php endif; ?>
            <li><a href="<?php echo base_url('auth/logout'); ?>">Logout</a></li>
        </ul>
    </nav>
    <!-- Content goes here -->
</body>
</html>
