<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/system/models/language';
import { IndexConfig } from '@/core/crud/configs';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Index from '@/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            title: App.t('routes->system.language'),
            config: new IndexConfig({
                model: Model,
                http: {
                    path: 'system/language',
                },
                grid: {
                    actions: ['show', 'update'],
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
