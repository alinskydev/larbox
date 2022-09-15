<script setup>
import { Page } from '@/core/base/page';
import { ShowConfig } from '@/core/base/crud/config';
import model from '@/modules/box/models/brand';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Show from '@/components/crud/Show.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('Просмотр'),
                breadcrumbs: [
                    {
                        label: this.__('Brands'),
                        path: 'box/brand',
                    },
                ],
            }),
            config: new ShowConfig({
                model: model,
                title: 'name',
                http: {
                    path: 'box/brand/:id',
                    query: {
                        'show[0]': 'boxes_count',
                        'with[0]': 'creator',
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
