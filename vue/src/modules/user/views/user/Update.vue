<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/user/models/user';
import { UpdateConfig } from '@/core/crud/configs';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Update from '@/components/crud/Update.vue';
</script>

<script>
export default {
    data() {
        return {
            title: App.t('routeActions->update'),
            config: new UpdateConfig({
                model: Model,
                http: {
                    path: 'user/user/:pk',
                },
                events: {
                    afterResponse: (data) => {
                        this.title += ': ' + data.username;

                        Page.init({
                            title: this.title,
                            breadcrumbs: [
                                {
                                    label: App.t('routes->user.user'),
                                    path: 'user/user/index',
                                },
                            ],
                        });
                    },
                    afterSubmit: (formData, response) => {
                        toastr.success(App.t('Сохранение прошло успешно'));

                        if (response.data.token) {
                            App.helpers.user.login(response.data.token);
                        }

                        App.page.goUp();
                    },
                },
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="title" />
    <Update :config="config" />
</template>
