<script setup>
import { UpdatePage } from '@/app/core/pages/crud';
import model from '@/modules/box/models/box';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import Buttons from '@/app/components/crud/form/_Buttons.vue';
import Item from '@/app/components/crud/http/Item.vue';
</script>

<script>
export default {
    data() {
        return new UpdatePage({
            context: this,
            title: this.__('Редактирование'),
            titleField: 'name.:locale',
            breadcrumbs: [
                {
                    label: this.__('Boxes'),
                    path: 'box/box',
                },
            ],
            model: model,
            http: {
                method: 'PATCH',
                path: 'box/box/:id',
                query: {
                    'with[0]': 'brand',
                    'with[1]': 'tags',
                    'with[2]': 'variations',
                },
            },
            redirectPath: 'box/box',
        });
    },
};
</script>

<template>
    <PageTitle :text="title">
        <Buttons :actions="['cancel', 'save']" />
    </PageTitle>

    <Item child="form" />
</template>
