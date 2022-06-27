<script setup>
import { ShowPage } from '@/app/core/crud/page';
import model from '@/modules/system/models/language';

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
                    label: this.__('Языки'),
                    path: 'system/language',
                },
            ],
            model: model,
            http: {
                path: 'system/language/:id',
            },
        });
    },
};
</script>

<template>
    <PageTitle :text="title" />
    <Item child="show" />
</template>
