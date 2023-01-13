<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/feedback/models/callback';
import { IndexConfig } from '@/core/crud/configs';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Index from '@/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            title: App.t('routes->feedback.callback'),
            config: new IndexConfig({
                model: Model,
                http: {
                    path: 'feedback/callback',
                },
                grid: {
                    actions: ['show', 'delete'],
                },
                selection: {
                    actions: ['deleteMultiple'],
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
    <Index :config="config" />
</template>
