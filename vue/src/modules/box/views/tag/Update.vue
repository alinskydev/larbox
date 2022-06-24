<script setup>
import { UpdatePage } from '@/app/core/pages/crud';
import model from '@/modules/box/models/tag';

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
            titleField: 'name',
            breadcrumbs: [
                {
                    label: this.__('Tags'),
                    path: 'box/tag',
                },
            ],
            model: model,
            http: {
                method: 'PATCH',
                path: 'box/tag/:id',
            },
            redirectPath: 'box/tag',
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
