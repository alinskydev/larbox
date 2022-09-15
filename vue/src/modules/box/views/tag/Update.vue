<script setup>
import { Page } from '@/core/base/page';
import { UpdateConfig } from '@/core/base/crud/config';
import model from '@/modules/box/models/tag';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/particles/Buttons.vue';
import Update from '@/components/crud/Update.vue';
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
                title: 'name',
                http: {
                    path: 'box/tag/:id',
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

    <Update />
</template>
