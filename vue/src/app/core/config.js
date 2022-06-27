export default {
    http: {
        url: 'http://larbox.loc/api/admin',
        headers: {
            'Accept': 'application/json',
            'Accept-Language': null,
            'Authorization': localStorage.getItem('authorization'),
        },
    },
};
