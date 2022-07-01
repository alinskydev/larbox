import _ from 'lodash';

export default {
    send(context, options = {}) {
        let url = new URL(context.booted.config.http.url + '/' + options.path);

        for (let key in options.query) {
            url.searchParams.append(key, options.query[key]);
        }

        let requestOptions = _.merge({
            headers: context.booted.config.http.headers,
        }, options);

        return fetch(url, requestOptions)
            .then((response) => {
                if (response.status === 204) {
                    return {
                        ...response,
                        ...{
                            statusType: 'success',
                        },
                    };
                }

                return response.json().then((body) => {
                    let statusType;

                    switch (response.status) {
                        case 200:
                        case 201:
                        case 202:
                        case 206:
                            statusType = 'success';
                            break;

                        case 401:
                            statusType = 'unauthorized';
                            context.$router.push({
                                path: '/' + context.booted.locale + '/auth/login',
                            });
                            break;

                        case 403:
                        case 405:
                            statusType = 'notAllowed';
                            toastr.warning(body.message);
                            break;

                        case 404:
                        case 500:
                            statusType = 'error';
                            toastr.error(body.message);
                            break;

                        case 422:
                            statusType = 'validationFailed';

                            toastr.warning(body.message);

                            $('.input-error').addClass('d-none');

                            for (let key in body.errors) {
                                let error = body.errors[key].join("\n"),
                                    altKey = null;

                                if (key.includes('.')) {
                                    altKey = key.slice(0, key.lastIndexOf('.')) + '.*';
                                } else {
                                    altKey = key + '.*';
                                }

                                $('[data-error-key="' + key + '"], [data-error-key="' + altKey + '"]')
                                    .closest('.input-wrapper')
                                    .find('.input-error')
                                    .text(error)
                                    .removeClass('d-none');
                            }

                            break;
                    }

                    return {
                        ...response,
                        ...{
                            data: body,
                            statusType: statusType,
                        },
                    };
                });
            });
    },
};