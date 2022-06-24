<script setup>
import { IndexPage } from '@/app/core/pages/crud';
import model from '@/modules/system/models/language';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import RouterLink from "@/app/components/vue/RouterLink.vue";
import Index from '@/app/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return new IndexPage({
            context: this,
            title: this.__('Языки'),
            model: model,
            http: {
                path: 'system/language',
            },
            actions: ['show', 'update'],
        });
    },
};
</script>

<template>
    <PageTitle :text="title"></PageTitle>

    <Index />
</template>
