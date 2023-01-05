let authToken = localStorage.getItem('authToken') ?? '';

export default {
    http: {
        url: import.meta.env.VITE_HTTP_URL,
        headers: {
            'Accept': 'application/json',
            'Accept-Language': null,
            'Authorization': authToken,
        },

        websiteUrl: 'http://larbox.loc',
    },
};
