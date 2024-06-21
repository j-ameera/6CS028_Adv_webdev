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
</head>
  
    <link rel="stylesheet" href="<?php echo base_url('assets/css/loginstyle.css')?>">
  
  </head>
  <body>
    <form action="<?php echo site_url('Auth/process_login'); ?>" method="post">
      <h2>Login</h2>
       <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php } elseif ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php } ?>
      <input type="text" name="username" placeholder="Username">
      <input type="password" name="password" placeholder="Password">
      <button type="submit">Login</button>
      <a href="<?php echo base_url('auth/signup')?>" class="Registration">Sign Up</a>
    </form>
  </body>
</html>

<img src="https://as2.ftcdn.net/v2/jpg/00/98/35/31/1000_F_98353187_S0jkM3xjGLX53oqdZyiDMUuFCgNyFrFY.jpg"
