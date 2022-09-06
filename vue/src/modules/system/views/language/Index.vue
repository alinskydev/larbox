<script setup>
import { Page } from '@/core/page';
import { IndexConfig } from '@/core/crud/config';
import model from '@/modules/system/models/language';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Index from '@/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('Языки'),
            }),
            config: new IndexConfig({
                model: model,
                http: {
                    path: 'system/language',
                },
                actions: ['show', 'update'],
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title" />
    <Index />
</template>
