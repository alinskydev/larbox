<script setup>
import { Page } from '@/core/base/page';
import { IndexConfig } from '@/core/base/crud/config';
import model from '@/modules/box/models/box';

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
                title: this.__('routes->box.box'),
            }),
            config: new IndexConfig({
                model: model,
                http: {
                    path: 'box/box',
                    query: {
                        'with[0]': 'brand',
                        'with[1]': 'tags',
                    },
                },
                filter: {
                    hasSoftDelete: true,
                },
                selection: {
                    actions: ['deleteAll', 'restoreAll'],
                },
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title">
        <RouterLink to="box/box/create" class="btn btn-success">
            {{ __('routeActions->store') }}
        </RouterLink>
    </PageTitle>

    <Index />
</template>
