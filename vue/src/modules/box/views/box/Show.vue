<script setup>
import { Page } from '@/core/page';
import { ShowConfig } from '@/core/crud/config';
import model from '@/modules/box/models/box';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Show from '@/components/crud/Show.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('routeActions->show'),
                breadcrumbs: [
                    {
                        label: this.__('routes->box.box'),
                        path: 'box/box/index',
                    },
                ],
            }),
            config: new ShowConfig({
                model: model,
                title: 'name.:locale',
                http: {
                    path: 'box/box/:pk',
                    query: {
                        'with[0]': 'brand',
                        'with[1]': 'categories.parents',
                        'with[2]': 'tags',
                        'with[3]': 'variations',
                    },
                },
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title" />
    <Show />
</template>
