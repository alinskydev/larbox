<script setup>
import { IndexPage } from '@/app/core/crud/page';
import model from '@/modules/box/models/box';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import RouterLink from "@/app/components/blocks/RouterLink.vue";
import Index from '@/app/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return new IndexPage({
            context: this,
            title: this.__('Boxes'),
            model: model,
            http: {
                path: 'box/box',
                query: {
                    'with[0]': 'brand',
                    'with[1]': 'tags',
                },
            },
            actions: ['show', 'update', 'delete', 'restore'],
        });
    },
};
</script>

<template>
    <PageTitle :text="title">
        <RouterLink to="box/box/create" class="btn btn-success">
            {{ __('Создать') }}
        </RouterLink>
    </PageTitle>

    <Index />
</template>
