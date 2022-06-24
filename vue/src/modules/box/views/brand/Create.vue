<script setup>
import { CreatePage } from '@/app/core/pages/crud';
import model from '@/modules/box/models/brand';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import Buttons from '@/app/components/crud/form/_Buttons.vue';
import Create from '@/app/components/crud/Create.vue';
</script>

<script>
export default {
    data() {
        return new CreatePage({
            context: this,
            title: this.__('Создание'),
            breadcrumbs: [
                {
                    label: this.__('Brands'),
                    path: 'box/brand',
                },
            ],
            model: model,
            http: {
                method: 'POST',
                path: 'box/brand',
            },
            redirectPath: 'box/brand',
        });
    },
};
</script>

<template>
    <PageTitle :text="title">
        <Buttons :actions="['save']" />
    </PageTitle>

    <Create />
</template>
