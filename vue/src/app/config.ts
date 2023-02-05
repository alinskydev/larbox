export default {
    http: {
        // @ts-ignore
        url: import.meta.env.VITE_HTTP_URL,
        websiteUrl: 'http://larbox.loc',
        headers: {
            'Accept': 'application/json',
            'Accept-Language': null,
            'Authorization': localStorage.getItem('authToken') ?? '',
        },
    },

    formats: {
        date: 'DD.MM.YYYY',
        datetime: 'DD.MM.YYYY HH:mm:ss',
    },
};
