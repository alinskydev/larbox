<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/box/models/tag';
import { CreateConfig } from '@/core/crud/configs';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Create from '@/components/crud/Create.vue';
</script>

<script>
export default {
    data() {
        return {
            title: App.t('routeActions->create'),
            config: new CreateConfig({
                model: Model,
                http: {
                    path: 'box/tag',
                },
            }),
        };
    },
    created() {
        Page.init({
            title: this.title,
            breadcrumbs: [
                {
                    label: App.t('routes->box.tag'),
                    path: 'box/tag/index',
                },
            ],
        });
    },
};
</script>

<template>
    <PageTitle :text="title" />
    <Create :config="config" />
</template>
