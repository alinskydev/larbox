<script setup>
import { ShowPage } from '@/app/core/crud/page';
import model from '@/modules/user/models/user';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import Item from '@/app/components/crud/http/Item.vue';
</script>

<script>
export default {
    data() {
        return new ShowPage({
            context: this,
            title: this.__('Просмотр'),
            titleField: 'username',
            breadcrumbs: [
                {
                    label: this.__('Пользователи'),
                    path: 'user/user',
                },
            ],
            model: model,
            http: {
                path: 'user/user/:id',
            },
        });
    },
};
</script>

<template>
    <PageTitle :text="title" />
    <Item child="show" />
</template>
