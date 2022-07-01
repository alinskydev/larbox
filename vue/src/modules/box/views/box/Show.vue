<script setup>
import { Page } from '@/app/core/page';
import { ShowConfig } from '@/app/core/crud/config';
import model from '@/modules/box/models/box';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import Item from '@/app/components/crud/http/Item.vue';
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
                        label: this.__('Boxes'),
                        path: 'box/box',
                    },
                ],
            }),
            config: new ShowConfig({
                model: model,
                http: {
                    path: 'box/box/:id',
                    query: {
                        'with[0]': 'brand',
                        'with[1]': 'tags',
                        'with[2]': 'variations',
                    },
                },
                titleField: 'name.:locale',
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title" />
    <Item child="show" />
</template>
