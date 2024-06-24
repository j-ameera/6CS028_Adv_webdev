// assets/js/login.js
document.addEventListener('DOMContentLoaded', function () {
    const usernameField = document.getElementById('username');
    const passwordField = document.getElementById('password');
    const feedback = document.getElementById('feedback');

    usernameField.addEventListener('input', function () {
        const username = usernameField.value;
        // Real-time validation for username
        if (username.length < 5) {
            feedback.textContent = 'Username must be at least 5 characters long.';
            feedback.style.color = 'red';
        } else {
            feedback.textContent = '';
        }
        // Autocomplete
        let suggestions = JSON.parse(localStorage.getItem('usernames')) || [];
        let matches = suggestions.filter(user => user.startsWith(username));
        // Display matches
        let suggestionBox = document.getElementById('suggestions');
        suggestionBox.innerHTML = matches.map(match => `<div>${match}</div>`).join('');
    });

    passwordField.addEventListener('input', function () {
        const password = passwordField.value;
        // Real-time validation for password
        if (password.length < 8) {
            feedback.textContent = 'Password must be at least 8 characters long.';
            feedback.style.color = 'red';
        } else {
            feedback.textContent = '';
        }
    });

    // Save username to local storage on form submission
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', function () {
        let usernames = JSON.parse(localStorage.getItem('usernames')) || [];
        usernames.push(usernameField.value);
        localStorage.setItem('usernames', JSON.stringify(usernames));
    });
});
