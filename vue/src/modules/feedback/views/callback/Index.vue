<script setup>
import { Page } from '@/core/page';
import { IndexConfig } from '@/core/crud/configs';
import model from '@/modules/feedback/models/callback';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Index from '@/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            title: this.__('routes->feedback.callback'),
            config: new IndexConfig({
                model: model,
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
        new Page({
            context: this,
        });
    },
};
</script>

<template>
    <PageTitle :text="title" />
    <Index :config="config" />
</template>
