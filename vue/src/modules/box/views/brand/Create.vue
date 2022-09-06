<script setup>
import { Page } from '@/core/page';
import { CreateConfig } from '@/core/crud/config';
import model from '@/modules/box/models/brand';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/particles/Buttons.vue';
import Create from '@/components/crud/Create.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('Создание'),
                breadcrumbs: [
                    {
                        label: this.__('Brands'),
                        path: 'box/brand',
                    },
                ],
            }),
            config: new CreateConfig({
                model: model,
                http: {
                    path: 'box/brand',
                },
                redirectPath: 'box/brand',
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title">
        <Buttons />
    </PageTitle>

    <Create />
</template>
