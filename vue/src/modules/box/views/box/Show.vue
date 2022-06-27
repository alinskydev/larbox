<script setup>
import { ShowPage } from '@/app/core/crud/page';
import model from '@/modules/box/models/box';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import Item from '@/app/components/crud/http/Item.vue';
</script>

<script>
export default {
    data() {
        return new ShowPage({
            context: this,
            title: this.__('Просмотр'),
            titleField: 'name.:locale',
            breadcrumbs: [
                {
                    label: this.__('Boxes'),
                    path: 'box/box',
                },
            ],
            model: model,
            http: {
                path: 'box/box/:id',
                query: {
                    'with[0]': 'brand',
                    'with[1]': 'tags',
                    'with[2]': 'variations',
                },
            },
        });
    },
};
</script>

<template>
    <PageTitle :text="title" />
    <Item child="show" />
</template>
