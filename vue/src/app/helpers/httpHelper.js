export default {
    send(context, options = {}) {
        let headers = {
            ...context.booted.config.http.headers,
            ...(options.headers ?? {}),
        };

        let requestOptions = {
            ...options,
            ...{
                headers: headers,
            },
        };

        let url = new URL(context.booted.config.http.url);
        url.pathname += '/' + options.path;

        for (let key in options.query) {
            url.searchParams.append(key, options.query[key]);
        }

        return fetch(url, requestOptions)
            .then((response) => {
                switch (response.status) {
                    case 200:
                    case 201:
                    case 202:
                    case 204:
                    case 206:
                        response.statusType = 'success';
                        break;
                    case 401:
                        response.statusType = 'unauthorized';
                        context.$router.push({
                            path: '/' + context.booted.locale + '/auth/login',
                        });
                        break;
                    case 403:
                    case 405:
                        response.statusType = 'notAllowed';
                        response.json().then((body) => {
                            toastr.warning(body.message);
                        });
                        break;
                    case 404:
                    case 500:
                        response.statusType = 'error';
                        response.json().then((body) => {
                            toastr.error(body.message);
                        });
                        break;
                    case 422:
                        response.statusType = 'validationFailed';
                        break;
                }

                return response;
            });
    },
};