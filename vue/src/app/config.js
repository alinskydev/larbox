let authToken = localStorage.getItem('authToken') ?? '';

export default {
    http: {
        url: LARBOX.http.url,
        headers: {
            'Accept': 'application/json',
            'Accept-Language': null,
            'Authorization': authToken,
        },

        websiteUrl: 'http://larbox.loc',
    },
};
