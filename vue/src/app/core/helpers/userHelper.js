export default {
    login(context, username, password) {
        password = password === '' ? localStorage.getItem('auth_password') : password;

        context.booted.config.http.headers['Authorization'] = 'Basic ' + window.btoa(username + ':' + password);
        localStorage.setItem('auth_username', username);
        localStorage.setItem('auth_password', password);
    },
    logout(context) {
        context.booted.config.http.headers['Authorization'] = null;
        localStorage.removeItem('auth_username');
        localStorage.removeItem('auth_password');
    },
};
