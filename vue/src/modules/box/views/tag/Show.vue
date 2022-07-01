<script setup>
import { Page } from '@/app/core/page';
import { ShowConfig } from '@/app/core/crud/config';
import model from '@/modules/box/models/tag';

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
                        label: this.__('Tags'),
                        path: 'box/tag',
                    },
                ],
            }),
            config: new ShowConfig({
                model: model,
                http: {
                    path: 'box/tag/:id',
                },
                titleField: 'name',
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title" />
    <Item child="show" />
</template>
