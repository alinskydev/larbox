<script setup>
import { CreatePage } from '@/app/core/crud/page';
import model from '@/modules/box/models/box';

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
                    label: this.__('Boxes'),
                    path: 'box/box',
                },
            ],
            model: model,
            http: {
                method: 'POST',
                path: 'box/box',
            },
            redirectPath: 'box/box',
        });
    },
};
</script>

<template>
    <PageTitle :text="title">
        <Buttons />
    </PageTitle>

    <Create />
</template>
