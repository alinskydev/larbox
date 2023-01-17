import * as Lodash from 'lodash';
import App from '@/core/app';

export default class {
    send(
        options: {
            method: string;
            path: string;
            query?: Object;
        } & RequestInit,
    ) {
        let url = new URL(App.config.http.url + '/' + options.path);

        if (options.query) {
            for (let key in options.query) {
                url.searchParams.append(key, options.query[key]);
            }
        }

        let requestOptions = Lodash.merge(
            {
                headers: App.config.http.headers,
            },
            options,
        );

        return fetch(url, requestOptions).then((response): Object => {
            if (response.status === 204) {
                return {
                    ...response,
                    ...{
                        statusType: 'success',
                    },
                };
            }

            return response.json().then((body) => {
                // @ts-ignore
                let toastrPlugin = toastr,
                    statusType;

                switch (response.status) {
                    case 200:
                    case 201:
                    case 202:
                    case 206:
                        statusType = 'success';
                        break;

                    case 401:
                        statusType = 'unauthorized';
                        App.helpers.user.logout();
                        break;

                    case 403:
                        statusType = 'forbidden';
                        toastrPlugin.warning(body.message);
                        break;

                    case 400:
                    case 405:
                    case 409:
                    case 429:
                        statusType = 'notAllowed';
                        toastrPlugin.warning(body.message);
                        break;

                    case 404:
                    case 500:
                        statusType = 'error';
                        toastrPlugin.error(body.message);
                        break;

                    case 422:
                        statusType = 'validationFailed';
                        toastrPlugin.warning(body.message);

                        $('.input-error').addClass('d-none');

                        for (let key in body.errors) {
                            let error = body.errors[key].join('\n'),
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
    }
}