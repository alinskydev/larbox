let authUsername = localStorage.getItem('auth_username') ?? '',
    authPassword = localStorage.getItem('auth_password') ?? '';

export default {
    http: {
        url: window.__VUE_OPTIONS_API__ ? 'http://larbox.loc/admin' : 'http://larbox.loc/admin',
        headers: {
            'Accept': 'application/json',
            'Accept-Language': null,
            'Authorization': 'Basic ' + window.btoa(authUsername + ':' + authPassword),
        },

        websiteUrl: 'http://larbox.loc',
    },
};
