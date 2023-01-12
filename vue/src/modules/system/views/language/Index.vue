<script setup>
import { Page } from '@/core/page';
import { IndexConfig } from '@/core/crud/configs';
import model from '@/modules/system/models/language';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Index from '@/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            title: this.__('routes->system.language'),
            config: new IndexConfig({
                model: model,
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
