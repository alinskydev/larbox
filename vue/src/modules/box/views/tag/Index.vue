<script setup>
import { Page } from '@/core/page';
import { IndexConfig } from '@/core/crud/configs';
import model from '@/modules/box/models/tag';

import PageTitle from '@/components/blocks/PageTitle.vue';
import RouterLink from "@/components/blocks/RouterLink.vue";
import Index from '@/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            title: this.__('routes->box.tag'),
            config: new IndexConfig({
                model: model,
                http: {
                    path: 'box/tag',
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
    <PageTitle :text="title">
        <RouterLink to="box/tag/create" class="btn btn-success">
            {{ __('routeActions->create') }}
        </RouterLink>
    </PageTitle>

    <Index :config="config" />
</template>
