<script setup>
import { Page } from '@/app/core/page';
import { IndexConfig } from '@/app/core/crud/config';
import model from '@/modules/system/models/language';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import Index from '@/app/components/crud/Index.vue';
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
