<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/core/model';
import { UpdateConfig } from '@/core/crud/configs';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/Buttons.vue';
import Update from '@/components/crud/Update.vue';
</script>

<script>
export default {
    inheritAttrs: false,
    props: {
        name: {
            type: String,
            required: true,
        },
        model: {
            type: Model,
            required: true,
        },
    },
    data() {
        return {
            title: App.t('routeActions->update') + ': ' + App.t('routes->section.' + this.name),
            config: new UpdateConfig({
                model: this.model,
                http: {
                    path: 'section/' + this.name,
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
    <PageTitle :text="title">
        <Buttons v-if="App.helpers.user.checkRoute('section/update')" :actions="['save']" />
    </PageTitle>

    <Update :config="config" />
</template>
