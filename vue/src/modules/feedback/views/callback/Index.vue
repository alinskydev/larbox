<script setup>
import { Page } from '@/core/page';
import { IndexConfig } from '@/core/crud/config';
import model from '@/modules/feedback/models/callback';

import PageTitle from '@/components/blocks/PageTitle.vue';
import RouterLink from '@/components/blocks/RouterLink.vue';
import Index from '@/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('routes->feedback.callback'),
            }),
            config: new IndexConfig({
                model: model,
                http: {
                    path: 'feedback/callback',
                },
                filter: {
                    hasSoftDelete: true,
                },
                grid: {
                    actions: ['show', 'delete'],
                },
                selection: {
                    actions: ['deleteAll'],
                },
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title" />
    <Index />
</template>
