<script setup>
import { Page } from '@/core/page';
import { CreateConfig } from '@/core/crud/config';
import model from '@/modules/box/models/tag';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/Buttons.vue';
import Create from '@/components/crud/Create.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('routeActions->create'),
                breadcrumbs: [
                    {
                        label: this.__('routes->box.tag'),
                        path: 'box/tag',
                    },
                ],
            }),
            config: new CreateConfig({
                model: model,
                http: {
                    path: 'box/tag',
                },
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
