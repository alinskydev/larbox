let authUsername = localStorage.getItem('auth_username') ?? '',
    authPassword = localStorage.getItem('auth_password') ?? '';

export default {
    http: {
        url: 'http://larbox.loc/api/admin',
        headers: {
            'Accept': 'application/json',
            'Accept-Language': null,
            'Authorization': 'Basic ' + window.btoa(authUsername + ':' + authPassword),
        },

        websiteUrl: 'http://larbox.loc',
    },
};
