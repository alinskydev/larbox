<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/system/models/settings';
import { UpdateConfig } from '@/core/crud/configs';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Update from '@/components/crud/Update.vue';
</script>

<script>
export default {
    data() {
        return {
            title: App.t('routes->system.settings'),
            config: new UpdateConfig({
                model: Model,
                http: {
                    path: 'system/settings',
                },
                events: {
                    afterSubmit: (formData, response) => {
                        toastr.success(App.t('Сохранение прошло успешно'));
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
