<script setup>
import { IndexPage } from '@/app/core/crud/page';
import model from '@/modules/user/models/user';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import RouterLink from "@/app/components/blocks/RouterLink.vue";
import Index from '@/app/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return new IndexPage({
            context: this,
            title: this.__('Пользователи'),
            model: model,
            http: {
                path: 'user/user',
            },
            actions: ['show', 'update', 'delete', 'restore'],
        });
    },
};
</script>

<template>
    <PageTitle :text="title">
        <RouterLink to="user/user/create" class="btn btn-success">
            {{ __('Создать') }}
        </RouterLink>
    </PageTitle>

    <Index />
</template>
