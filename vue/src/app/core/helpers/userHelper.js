export default {
    login(context, username, password) {
        let authorization = 'Basic ' + window.btoa(username + ':' + password);

        context.booted.config.http.headers['Authorization'] = authorization;
        localStorage.setItem('authorization', authorization);
    },
    logout(context) {
        context.booted.config.http.headers['Authorization'] = null;
        localStorage.removeItem('authorization');
    },
};