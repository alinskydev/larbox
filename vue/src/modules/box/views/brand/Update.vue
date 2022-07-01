<script setup>
import { Page } from '@/app/core/page';
import { UpdateConfig } from '@/app/core/crud/config';
import model from '@/modules/box/models/brand';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import Buttons from '@/app/components/crud/form/_Buttons.vue';
import Item from '@/app/components/crud/http/Item.vue';
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
                        label: this.__('Brands'),
                        path: 'box/brand',
                    },
                ],
            }),
            config: new UpdateConfig({
                model: model,
                http: {
                    path: 'box/brand/:id',
                },
                titleField: 'name',
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

    <Item child="form" />
</template>
