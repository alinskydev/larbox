<script setup>
import { IndexPage } from '@/app/core/crud/page';
import model from '@/modules/box/models/tag';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import RouterLink from "@/app/components/blocks/RouterLink.vue";
import Index from '@/app/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return new IndexPage({
            context: this,
            title: this.__('Tags'),
            model: model,
            http: {
                path: 'box/tag',
            },
            actions: ['show', 'update', 'delete', 'restore'],
        });
    },
};
</script>

<template>
    <PageTitle :text="title">
        <RouterLink to="box/tag/create" class="btn btn-success">
            {{ __('Создать') }}
        </RouterLink>
    </PageTitle>

    <Index />
</template>
