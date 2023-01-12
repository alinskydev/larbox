export default {
    http: {
        url: import.meta.env.VITE_HTTP_URL,
        headers: {
            'Accept': 'application/json',
            'Accept-Language': null,
            'Authorization': localStorage.getItem('authToken') ?? '',
        },

        websiteUrl: 'http://larbox.loc',
    },
};
