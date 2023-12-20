function togglePasswordVisibility() {
    var passwordField = document.getElementById('password');
    var toggleButton = document.querySelector('.toggle-password');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleButton.innerHTML = '<img src="/assets/oeil/eye-off.png" alt="Toggle Password Visibility">';
    } else {
        passwordField.type = 'password';
        toggleButton.innerHTML = '<img src="/assets/oeil/eye.png" alt="Toggle Password Visibility">';
    }
}
