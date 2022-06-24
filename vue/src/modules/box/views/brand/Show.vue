<script setup>
import { ShowPage } from '@/app/core/pages/crud';
import model from '@/modules/box/models/brand';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import Item from '@/app/components/crud/http/Item.vue';
</script>

<script>
export default {
    data() {
        return new ShowPage({
            context: this,
            title: this.__('Просмотр'),
            titleField: 'name',
            breadcrumbs: [
                {
                    label: this.__('Brands'),
                    path: 'box/brand',
                },
            ],
            model: model,
            http: {
                path: 'box/brand/:id',
                query: {
                    'show[0]': 'boxes_count',
                    'with[0]': 'creator',
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
