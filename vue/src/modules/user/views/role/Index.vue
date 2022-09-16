<script setup>
import { Page } from '@/core/base/page';
import { IndexConfig } from '@/core/base/crud/config';
import model from '@/modules/user/models/role';

import PageTitle from '@/components/blocks/PageTitle.vue';
import RouterLink from "@/components/blocks/RouterLink.vue";
import Index from '@/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('Роли'),
            }),
            config: new IndexConfig({
                model: model,
                http: {
                    path: 'user/role',
                },
                filter: {
                    hasSoftDelete: true,
                },
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title">
        <RouterLink to="user/role/create" class="btn btn-success">
            {{ __('Создать') }}
        </RouterLink>
    </PageTitle>

    <Index />
</template>
