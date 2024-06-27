<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=La+Belle+Aurore&family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/registration.css')?>">
    <script src="<?php echo base_url('assets/js/login.js'); ?>" defer></script>
</head>
<body>
    <form action="<?php echo site_url('Auth/register'); ?>" method="post" id="registrationForm">
        <h2>Sign Up</h2>
        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php } ?>
        <input type="text" name="username" placeholder="Username" required data-field="username">
        <small class="form-text text-danger" id="username-error"></small>
        <input type="password" name="password" placeholder="Password" required data-field="password">
        <small class="form-text text-danger" id="password-error"></small>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required data-field="confirm_password">
        <small class="form-text text-danger" id="confirm_password-error"></small>
        <button type="submit">Sign Up</button>
        <a href="<?php echo base_url('auth'); ?>" class="Registration">Already have an account?</a>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registrationForm');
            const fields = form.querySelectorAll('input[data-field]');
            const csrfToken = '<?php echo $this->security->get_csrf_hash(); ?>';

            fields.forEach(field => {
                field.addEventListener('input', function() {
                    const fieldName = field.getAttribute('data-field');
                    const fieldValue = field.value;

                    const data = new FormData();
                    data.append('field', fieldName);
                    data.append('value', fieldValue);
                    if (fieldName === 'confirm_password') {
                        const password = form.querySelector('input[name="password"]').value;
                        data.append('password', password);
                    }

                    fetch('<?php echo site_url('auth/validate_field'); ?>', {
                        method: 'POST',
                        body: data,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        const errorField = document.getElementById(`${fieldName}-error`);
                        if (data.valid) {
                            errorField.textContent = '';
                        } else {
                            errorField.textContent = data.message;
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
</body>
</html>
