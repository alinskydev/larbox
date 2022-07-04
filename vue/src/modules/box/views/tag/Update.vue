<script setup>
import { Page } from '@/app/core/page';
import { UpdateConfig } from '@/app/core/crud/config';
import model from '@/modules/box/models/tag';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import Buttons from '@/app/components/crud/form/particles/Buttons.vue';
import Update from '@/app/components/crud/Update.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('Редактирование'),
                breadcrumbs: [
                    {
                        label: this.__('Tags'),
                        path: 'box/tag',
                    },
                ],
            }),
            config: new UpdateConfig({
                model: model,
                http: {
                    path: 'box/tag/:id',
                },
                titleField: 'name',
                redirectPath: 'box/tag',
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title">
        <Buttons />
    </PageTitle>

    <Update />
</template>
