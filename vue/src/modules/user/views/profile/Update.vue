<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/user/models/profile';
import { UpdateConfig } from '@/core/crud/configs';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Update from '@/components/crud/Update.vue';
</script>

<script>
export default {
    data() {
        return {
            title: App.t('routes->user.profile'),
            config: new UpdateConfig({
                model: Model,
                http: {
                    path: 'user/profile',
                },
                events: {
                    afterSubmit: (formData, response) => {
                        toastr.success(App.t('Сохранение прошло успешно'));

                        if (response.data.token) {
                            App.helpers.user.login(response.data.token);
                        }

                        App.components.app.refresh();
                    },
                },
            }),
        };
    },
    created() {
        Page.init({
            title: this.title,
        });
    },
};
</script>

<template>
    <PageTitle :text="title" />
    <Update :config="config" :actions="['save']" />
</template>
